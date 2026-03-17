/**
 * SmartFlat CMS v3 - Data Table Component
 *
 * A reusable data table with pagination, sorting, filtering, and search.
 *
 * Usage:
 *   const table = new SFDataTable('my-table', {
 *       apiUrl: '/api/v3/projects',
 *       columns: [
 *           { key: 'name', label: '이름', sortable: true },
 *           { key: 'status', label: '상태', render: (row) => `<span class="badge">${row.status}</span>` }
 *       ],
 *       pageSize: 20,
 *       onRowClick: (row) => console.log(row)
 *   });
 */

'use strict';

class SFDataTable {
    constructor(tableId, options = {}) {
        this.tableId = tableId;
        this.options = {
            apiUrl: '',
            columns: [],
            pageSize: 20,
            searchable: true,
            sortable: true,
            selectable: false,
            filters: {},
            onRowClick: null,
            onLoad: null,
            onError: null,
            emptyMessage: '데이터가 없습니다.',
            loadingMessage: '데이터 로딩 중...',
            ...options
        };

        this.data = [];
        this.pagination = { page: 1, total: 0, totalPages: 0 };
        this.currentPage = 1;
        this.sortKey = '';
        this.sortDir = 'asc';
        this.searchTerm = '';
        this.isLoading = false;
        this.selectedIds = new Set();

        this.init();
    }

    init() {
        this.tableEl = document.getElementById(this.tableId);
        this.wrapperEl = document.getElementById(`${this.tableId}_wrapper`);
        this.tbodyEl = this.tableEl?.querySelector('tbody');
        this.infoEl = document.getElementById(`${this.tableId}_info`);
        this.paginationEl = document.getElementById(`${this.tableId}_pagination`);

        if (!this.tableEl) {
            cerror(`SFDataTable: Table element #${this.tableId} not found`);
            return;
        }

        this.loadData();
    }

    async loadData() {
        if (this.isLoading) return;

        this.isLoading = true;
        this.showLoading();

        try {
            const params = new URLSearchParams({
                page: this.currentPage,
                limit: this.options.pageSize,
                ...this.options.filters
            });

            if (this.searchTerm) {
                params.set('search', this.searchTerm);
            }

            if (this.sortKey) {
                params.set('sort', this.sortKey);
                params.set('order', this.sortDir);
            }

            const response = await fetch(`${this.options.apiUrl}?${params}`, {
                headers: {
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            });

            if (!response.ok) {
                throw new Error(`HTTP error: ${response.status}`);
            }

            const result = await response.json();

            if (result.code === 100) {
                this.data = result.data.items || result.data || [];
                this.pagination = result.data.pagination || {
                    page: this.currentPage,
                    total: this.data.length,
                    totalPages: 1
                };

                this.renderRows();
                this.renderPagination();
                this.updateInfo();

                if (this.options.onLoad) {
                    this.options.onLoad(this.data, this.pagination);
                }
            } else {
                throw new Error(result.message || 'Unknown error');
            }
        } catch (error) {
            cerror('SFDataTable load error:', error);
            this.showError(error.message);

            if (this.options.onError) {
                this.options.onError(error);
            }
        } finally {
            this.isLoading = false;
        }
    }

    showLoading() {
        if (!this.tbodyEl) return;

        const colCount = this.options.columns.length + (this.options.selectable ? 1 : 0);
        this.tbodyEl.innerHTML = `
            <tr>
                <td colspan="${colCount}" class="table-loading">
                    <div class="spinner"></div>
                    <div class="loading-text">${escapeHtml(this.options.loadingMessage)}</div>
                </td>
            </tr>
        `;
    }

    showError(message) {
        if (!this.tbodyEl) return;

        const colCount = this.options.columns.length + (this.options.selectable ? 1 : 0);
        this.tbodyEl.innerHTML = `
            <tr>
                <td colspan="${colCount}" class="table-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>${escapeHtml(message)}</div>
                </td>
            </tr>
        `;
    }

    renderRows() {
        if (!this.tbodyEl) return;

        if (this.data.length === 0) {
            const colCount = this.options.columns.length + (this.options.selectable ? 1 : 0);
            this.tbodyEl.innerHTML = `
                <tr>
                    <td colspan="${colCount}" class="table-empty">
                        <i class="fas fa-inbox"></i>
                        <div>${escapeHtml(this.options.emptyMessage)}</div>
                    </td>
                </tr>
            `;
            return;
        }

        this.tbodyEl.innerHTML = this.data.map(row => this.renderRow(row)).join('');

        // Add checkbox change handlers (using addEventListener instead of inline handlers)
        if (this.options.selectable) {
            this.tbodyEl.querySelectorAll('.row-select').forEach(cb => {
                cb.addEventListener('change', () => {
                    const rowId = cb.dataset.id;
                    const tableId = cb.dataset.tableId;
                    if (window.sfTables && window.sfTables[tableId]) {
                        window.sfTables[tableId].toggleSelect(rowId, cb.checked);
                    }
                });
            });
        }

        // Add row click handlers
        if (this.options.onRowClick) {
            this.tbodyEl.querySelectorAll('tr[data-id]').forEach(tr => {
                tr.style.cursor = 'pointer';
                tr.addEventListener('click', (e) => {
                    if (e.target.closest('button, a, input, .no-row-click')) return;
                    const id = tr.dataset.id;
                    const row = this.data.find(r => String(r.id) === String(id));
                    if (row) this.options.onRowClick(row);
                });
            });
        }
    }

    renderRow(row) {
        const id = row.id || '';
        let html = `<tr data-id="${escapeHtml(String(id))}">`;

        if (this.options.selectable) {
            const checked = this.selectedIds.has(id) ? 'checked' : '';
            const safeId = escapeHtml(String(id));
            const safeTableId = escapeHtml(String(this.tableId));
            html += `<td class="td-checkbox">
                <input type="checkbox" class="form-check-input row-select" data-id="${safeId}" data-table-id="${safeTableId}" ${checked}>
            </td>`;
        }

        this.options.columns.forEach(col => {
            let value = row[col.key] ?? '';
            let cellHtml = '';

            if (col.render && typeof col.render === 'function') {
                cellHtml = col.render(row);
            } else if (col.type === 'badge') {
                cellHtml = `<span class="badge badge-secondary">${escapeHtml(value)}</span>`;
            } else if (col.type === 'date') {
                cellHtml = value ? escapeHtml(formatDate(value)) : '-';
            } else if (col.type === 'datetime') {
                cellHtml = value ? escapeHtml(formatDateTime(value)) : '-';
            } else {
                cellHtml = escapeHtml(String(value));
            }

            html += `<td>${cellHtml}</td>`;
        });

        html += '</tr>';
        return html;
    }

    renderPagination() {
        if (!this.paginationEl) return;

        const { page, totalPages } = this.pagination;

        if (totalPages <= 1) {
            this.paginationEl.innerHTML = '';
            return;
        }

        let html = '<nav class="pagination">';

        // Previous button
        html += `<button class="page-btn" ${page <= 1 ? 'disabled' : ''} data-page="${page - 1}">
            <i class="fas fa-chevron-left"></i>
        </button>`;

        // Page numbers
        const startPage = Math.max(1, page - 2);
        const endPage = Math.min(totalPages, page + 2);

        if (startPage > 1) {
            html += `<button class="page-btn" data-page="1">1</button>`;
            if (startPage > 2) {
                html += '<span class="page-ellipsis">...</span>';
            }
        }

        for (let i = startPage; i <= endPage; i++) {
            html += `<button class="page-btn ${i === page ? 'active' : ''}" data-page="${i}">${i}</button>`;
        }

        if (endPage < totalPages) {
            if (endPage < totalPages - 1) {
                html += '<span class="page-ellipsis">...</span>';
            }
            html += `<button class="page-btn" data-page="${totalPages}">${totalPages}</button>`;
        }

        // Next button
        html += `<button class="page-btn" ${page >= totalPages ? 'disabled' : ''} data-page="${page + 1}">
            <i class="fas fa-chevron-right"></i>
        </button>`;

        html += '</nav>';
        this.paginationEl.innerHTML = html;

        // Attach click handlers via event delegation
        this.paginationEl.querySelectorAll('.page-btn[data-page]').forEach(btn => {
            btn.addEventListener('click', () => {
                const targetPage = parseInt(btn.dataset.page, 10);
                this.goToPage(targetPage);
            });
        });
    }

    updateInfo() {
        if (!this.infoEl) return;

        const totalEl = this.infoEl.querySelector('.total-count');
        if (totalEl) {
            totalEl.textContent = this.pagination.total.toLocaleString();
        }
    }

    // Public methods
    goToPage(page) {
        if (page < 1 || page > this.pagination.totalPages) return;
        this.currentPage = page;
        this.loadData();
    }

    search(term) {
        this.searchTerm = term;
        this.currentPage = 1;
        this.loadData();
    }

    sort(key) {
        if (this.sortKey === key) {
            this.sortDir = this.sortDir === 'asc' ? 'desc' : 'asc';
        } else {
            this.sortKey = key;
            this.sortDir = 'asc';
        }

        this.updateSortIcons();
        this.currentPage = 1;
        this.loadData();
    }

    updateSortIcons() {
        if (!this.tableEl) return;

        this.tableEl.querySelectorAll('th.sortable').forEach(th => {
            const icon = th.querySelector('.sort-icon');
            if (icon) {
                icon.className = 'fas fa-sort sort-icon';
            }
        });

        // Update active sort column
        // This would need column key mapping to work properly
    }

    setFilter(key, value) {
        if (value === '' || value === null || value === undefined) {
            delete this.options.filters[key];
        } else {
            this.options.filters[key] = value;
        }
        this.currentPage = 1;
        this.loadData();
    }

    setFilters(filters) {
        this.options.filters = { ...this.options.filters, ...filters };
        this.currentPage = 1;
        this.loadData();
    }

    clearFilters() {
        this.options.filters = {};
        this.searchTerm = '';
        this.currentPage = 1;
        this.loadData();
    }

    refresh() {
        this.loadData();
    }

    toggleSelect(id, checked) {
        if (checked) {
            this.selectedIds.add(id);
        } else {
            this.selectedIds.delete(id);
        }

        // Update select all checkbox
        const selectAllEl = document.getElementById(`${this.tableId}_selectAll`);
        if (selectAllEl) {
            selectAllEl.checked = this.selectedIds.size === this.data.length;
            selectAllEl.indeterminate = this.selectedIds.size > 0 && this.selectedIds.size < this.data.length;
        }
    }

    selectAll(checked) {
        if (checked) {
            this.data.forEach(row => this.selectedIds.add(row.id));
        } else {
            this.selectedIds.clear();
        }

        // Update row checkboxes
        this.tbodyEl?.querySelectorAll('.row-select').forEach(cb => {
            cb.checked = checked;
        });
    }

    getSelectedIds() {
        return Array.from(this.selectedIds);
    }

    getSelectedRows() {
        return this.data.filter(row => this.selectedIds.has(row.id));
    }

    export(format = 'csv') {
        if (format === 'csv') {
            this.exportCsv();
        }
    }

    exportCsv() {
        const headers = this.options.columns
            .filter(col => col.type !== 'actions')
            .map(col => col.label);

        const rows = this.data.map(row => {
            return this.options.columns
                .filter(col => col.type !== 'actions')
                .map(col => {
                    const value = row[col.key] ?? '';
                    return `"${String(value).replace(/"/g, '""')}"`;
                })
                .join(',');
        });

        const csv = [headers.join(','), ...rows].join('\n');
        const blob = new Blob(['\uFEFF' + csv], { type: 'text/csv;charset=utf-8;' });
        const url = URL.createObjectURL(blob);

        const link = document.createElement('a');
        link.href = url;
        link.download = `export_${new Date().toISOString().slice(0, 10)}.csv`;
        link.click();

        URL.revokeObjectURL(url);
    }
}

// Helper functions
function formatDate(dateStr) {
    if (!dateStr) return '';
    const date = new Date(dateStr);
    return date.toLocaleDateString('ko-KR');
}

function formatDateTime(dateStr) {
    if (!dateStr) return '';
    const date = new Date(dateStr);
    return date.toLocaleString('ko-KR');
}

// Export for module usage
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { SFDataTable };
}
