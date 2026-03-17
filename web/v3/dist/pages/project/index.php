<!-- SmartFlat CMS v3 - Project Management Page -->
<?php
require_once(__DIR__ . '/../../components/breadcrumb.php');
require_once(__DIR__ . '/../../components/status-badge.php');
require_once(__DIR__ . '/../../components/filter-panel.php');
?>

<?php
renderPageHeader('프로젝트 관리', [
    ['label' => '홈', 'link' => 'dashboard'],
    ['label' => '프로젝트 관리']
], '프로젝트를 생성하고 관리합니다', [
    [
        'label' => '새 프로젝트',
        'icon' => 'fa-plus',
        'class' => 'btn btn-primary',
        'onclick' => 'showProjectForm()'
    ]
]);
?>

<!-- Filter Panel -->
<div class="card" style="margin-bottom: 16px;">
    <div class="card-body" style="padding: 16px;">
        <div class="filter-inline">
            <div class="filter-row">
                <div class="filter-field">
                    <label class="filter-label">상태</label>
                    <select class="form-control form-control-sm" id="filter-status" onchange="applyProjectFilters()">
                        <option value="">전체</option>
                        <option value="active">운영중</option>
                        <option value="paused">일시정지</option>
                        <option value="archived">보관</option>
                    </select>
                </div>
                <div class="filter-field">
                    <label class="filter-label">지역</label>
                    <select class="form-control form-control-sm" id="filter-region" onchange="applyProjectFilters()">
                        <option value="">전체</option>
                    </select>
                </div>
                <div class="filter-field">
                    <label class="filter-label">카테고리</label>
                    <select class="form-control form-control-sm" id="filter-category" onchange="applyProjectFilters()">
                        <option value="">전체</option>
                    </select>
                </div>
                <div class="filter-field" style="flex: 2;">
                    <label class="filter-label">검색</label>
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm" id="filter-search"
                               placeholder="프로젝트명, 키 검색..." onkeyup="debounceSearch(this.value)">
                        <button class="btn btn-primary btn-sm" onclick="applyProjectFilters()">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Project Table -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">프로젝트 목록</h3>
        <div class="card-toolbar">
            <button class="btn btn-light btn-sm" onclick="projectTable?.refresh()">
                <i class="fas fa-sync"></i> 새로고침
            </button>
        </div>
    </div>
    <div class="card-body" style="padding: 0;">
        <div class="data-table-wrapper" id="project-table_wrapper">
            <div class="table-container">
                <table class="table" id="project-table">
                    <thead>
                        <tr>
                            <th class="sortable" onclick="projectTable?.sort('name')">
                                프로젝트명 <i class="fas fa-sort sort-icon"></i>
                            </th>
                            <th>카테고리</th>
                            <th>지역</th>
                            <th>기기</th>
                            <th>상태</th>
                            <th>최근 배포</th>
                            <th style="width: 120px;">관리</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="7" class="table-loading">
                                <div class="spinner"></div>
                                <div class="loading-text">데이터 로딩 중...</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="data-table-footer">
                <div class="table-info" id="project-table_info">
                    총 <span class="total-count">0</span>건
                </div>
                <div class="table-pagination" id="project-table_pagination"></div>
            </div>
        </div>
    </div>
</div>

<!-- Project Form Modal Template -->
<div id="project-form-template" style="display: none;">
    <form id="project-form" onsubmit="return saveProject(event)">
        <input type="hidden" id="project-id" name="id">

        <div class="row">
            <div class="col col-md-6">
                <div class="form-group">
                    <label class="form-label">프로젝트 키 <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="project-key" name="project_key"
                           placeholder="영문, 숫자, 언더스코어만" pattern="[a-zA-Z0-9_-]+" required>
                    <small class="form-text text-muted">고유 식별자 (영문/숫자만)</small>
                </div>
            </div>
            <div class="col col-md-6">
                <div class="form-group">
                    <label class="form-label">프로젝트명 <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="project-name" name="name" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">설명</label>
            <textarea class="form-control" id="project-description" name="description" rows="2"></textarea>
        </div>

        <div class="row">
            <div class="col col-md-4">
                <div class="form-group">
                    <label class="form-label">카테고리</label>
                    <select class="form-control" id="project-category" name="category">
                        <option value="">선택하세요</option>
                    </select>
                </div>
            </div>
            <div class="col col-md-4">
                <div class="form-group">
                    <label class="form-label">지역</label>
                    <select class="form-control" id="project-region" name="region">
                        <option value="">선택하세요</option>
                    </select>
                </div>
            </div>
            <div class="col col-md-4">
                <div class="form-group">
                    <label class="form-label">상태</label>
                    <select class="form-control" id="project-status" name="status">
                        <option value="active">운영중</option>
                        <option value="paused">일시정지</option>
                        <option value="archived">보관</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col col-md-4">
                <div class="form-group">
                    <label class="form-label">화면 방향</label>
                    <select class="form-control" id="project-orientation" name="orientation">
                        <option value="P">세로 (Portrait)</option>
                        <option value="L">가로 (Landscape)</option>
                    </select>
                </div>
            </div>
            <div class="col col-md-4">
                <div class="form-group">
                    <label class="form-label">가로 픽셀</label>
                    <input type="number" class="form-control" id="project-width" name="width" value="1080">
                </div>
            </div>
            <div class="col col-md-4">
                <div class="form-group">
                    <label class="form-label">세로 픽셀</label>
                    <input type="number" class="form-control" id="project-height" name="height" value="1920">
                </div>
            </div>
        </div>
    </form>
</div>

<script>
/**
 * Project List Page
 */

let projectTable = null;
let commonCodes = {};
let searchDebounceTimer = null;

// Initialize on load
(function() {
    clog('Project page loaded');
    loadCommonCodes();
    initProjectTable();
})();

/**
 * Load common codes for dropdowns
 */
async function loadCommonCodes() {
    try {
        const response = await fetch('/web/v3/dist/api/v3/router.php?route=common-codes', {
            credentials: 'same-origin'
        });
        const result = await response.json();

        if (result.code === 100) {
            commonCodes = result.data;
            populateDropdowns();
        }
    } catch (error) {
        cerror('Failed to load common codes:', error);
    }
}

/**
 * Populate dropdown options
 */
function populateDropdowns() {
    // Regions
    const regionSelects = document.querySelectorAll('#filter-region, #project-region');
    regionSelects.forEach(select => {
        (commonCodes.region || []).forEach(item => {
            const option = document.createElement('option');
            option.value = item.code_value;
            option.textContent = item.code_label;
            select.appendChild(option);
        });
    });

    // Categories
    const categorySelects = document.querySelectorAll('#filter-category, #project-category');
    categorySelects.forEach(select => {
        (commonCodes.project_category || []).forEach(item => {
            const option = document.createElement('option');
            option.value = item.code_value;
            option.textContent = item.code_label;
            select.appendChild(option);
        });
    });
}

/**
 * Initialize project data table
 */
function initProjectTable() {
    projectTable = new SFDataTable('project-table', {
        apiUrl: '/web/v3/dist/api/v3/router.php?route=projects',
        pageSize: 20,
        columns: [
            { key: 'name', label: '프로젝트명', sortable: true },
            { key: 'category', label: '카테고리' },
            { key: 'region', label: '지역' },
            { key: 'device_count', label: '기기' },
            { key: 'status', label: '상태' },
            { key: 'last_deploy_at', label: '최근 배포' },
            { key: 'actions', label: '관리' }
        ],
        onRowClick: (row) => {
            loadPage('project/detail', { id: row.id });
        }
    });

    // Override renderRow for custom rendering
    projectTable.renderRow = function(row) {
        const statusBadge = getStatusBadgeHtml(row.status, 'project');
        const lastDeploy = row.last_deploy_at ? formatRelativeTime(row.last_deploy_at) : '-';
        const categoryLabel = getCategoryLabel(row.category);
        const regionLabel = getRegionLabel(row.region);

        return `
            <tr data-id="${escapeHtml(String(row.id))}">
                <td>
                    <div class="project-name">
                        <strong>${escapeHtml(row.name)}</strong>
                        <small class="text-muted d-block">${escapeHtml(row.project_key)}</small>
                    </div>
                </td>
                <td>${escapeHtml(categoryLabel)}</td>
                <td>${escapeHtml(regionLabel)}</td>
                <td>
                    <span class="badge badge-light">${row.device_count || 0}대</span>
                </td>
                <td>${statusBadge}</td>
                <td>${escapeHtml(lastDeploy)}</td>
                <td class="no-row-click">
                    <div class="btn-group">
                        <button class="btn btn-sm btn-light" onclick="editProject(${row.id})" title="수정">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-light" onclick="viewProjectDetail(${row.id})" title="상세">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-light text-danger" onclick="deleteProject(${row.id}, '${escapeHtml(row.name)}')" title="삭제">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `;
    };
}

/**
 * Apply filters to table
 */
function applyProjectFilters() {
    const filters = {
        status: document.getElementById('filter-status').value,
        region: document.getElementById('filter-region').value,
        category: document.getElementById('filter-category').value,
        search: document.getElementById('filter-search').value
    };

    projectTable?.setFilters(filters);
}

/**
 * Debounced search
 */
function debounceSearch(value) {
    clearTimeout(searchDebounceTimer);
    searchDebounceTimer = setTimeout(() => {
        applyProjectFilters();
    }, 300);
}

/**
 * Show project form modal
 */
function showProjectForm(projectId = null) {
    const isEdit = !!projectId;
    const title = isEdit ? '프로젝트 수정' : '새 프로젝트';

    // Reset form
    document.getElementById('project-form').reset();
    document.getElementById('project-id').value = '';
    document.getElementById('project-key').disabled = false;

    if (isEdit) {
        loadProjectForEdit(projectId);
    }

    const formHtml = document.getElementById('project-form-template').innerHTML;

    showModalDialog(document.body, title, formHtml, '저장', '취소',
        function() {
            document.getElementById('project-form').dispatchEvent(new Event('submit'));
        },
        function() {
            hideModalDialog();
        },
        { size: { width: 700 }, allowHtml: true }
    );

    // Re-populate dropdowns in modal
    setTimeout(() => populateDropdowns(), 100);
}

/**
 * Load project data for editing
 */
async function loadProjectForEdit(projectId) {
    try {
        const response = await fetch(`/web/v3/dist/api/v3/router.php?route=projects/${projectId}`, {
            credentials: 'same-origin'
        });
        const result = await response.json();

        if (result.code === 100) {
            const project = result.data;
            document.getElementById('project-id').value = project.id;
            document.getElementById('project-key').value = project.project_key;
            document.getElementById('project-key').disabled = true;
            document.getElementById('project-name').value = project.name;
            document.getElementById('project-description').value = project.description || '';
            document.getElementById('project-category').value = project.category || '';
            document.getElementById('project-region').value = project.region || '';
            document.getElementById('project-status').value = project.status;
            document.getElementById('project-orientation').value = project.orientation;
            document.getElementById('project-width').value = project.width;
            document.getElementById('project-height').value = project.height;
        }
    } catch (error) {
        cerror('Failed to load project:', error);
        toastError('프로젝트 정보를 불러오는데 실패했습니다.');
    }
}

/**
 * Edit project
 */
function editProject(projectId) {
    showProjectForm(projectId);
}

/**
 * View project detail
 */
function viewProjectDetail(projectId) {
    loadPage('project/detail', { id: projectId });
}

/**
 * Save project
 */
async function saveProject(event) {
    event.preventDefault();

    const form = document.getElementById('project-form');
    const formData = new FormData(form);
    const data = Object.fromEntries(formData.entries());
    const isEdit = !!data.id;

    C_ShowLoadingProgress();

    try {
        const url = isEdit
            ? `/web/v3/dist/api/v3/router.php?route=projects/${data.id}`
            : '/web/v3/dist/api/v3/router.php?route=projects';

        const response = await fetch(url, {
            method: isEdit ? 'PUT' : 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': '<?php echo $_SESSION['csrf_token'] ?? ''; ?>'
            },
            body: JSON.stringify(data),
            credentials: 'same-origin'
        });

        const result = await response.json();

        if (result.code === 100) {
            hideModalDialog();
            toastSuccess(isEdit ? '프로젝트가 수정되었습니다.' : '프로젝트가 생성되었습니다.');
            projectTable?.refresh();
        } else {
            toastError(result.message || '저장에 실패했습니다.');
        }
    } catch (error) {
        cerror('Failed to save project:', error);
        toastError('저장 중 오류가 발생했습니다.');
    } finally {
        C_HideLoadingProgress();
    }

    return false;
}

/**
 * Delete project
 */
function deleteProject(projectId, projectName) {
    confirmMsg(`"${projectName}" 프로젝트를 삭제하시겠습니까?\n\n연결된 콘텐츠와 배포 이력이 모두 삭제됩니다.`, async function() {
        C_ShowLoadingProgress();

        try {
            const response = await fetch(`/web/v3/dist/api/v3/router.php?route=projects/${projectId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-Token': '<?php echo $_SESSION['csrf_token'] ?? ''; ?>'
                },
                credentials: 'same-origin'
            });

            const result = await response.json();

            if (result.code === 100) {
                toastSuccess('프로젝트가 삭제되었습니다.');
                projectTable?.refresh();
            } else {
                toastError(result.message || '삭제에 실패했습니다.');
            }
        } catch (error) {
            cerror('Failed to delete project:', error);
            toastError('삭제 중 오류가 발생했습니다.');
        } finally {
            C_HideLoadingProgress();
        }
    });
}

// Helper functions
function getStatusBadgeHtml(status, type) {
    const configs = {
        project: {
            active: { class: 'badge-success', label: '운영중' },
            paused: { class: 'badge-warning', label: '일시정지' },
            archived: { class: 'badge-secondary', label: '보관' }
        }
    };

    const config = configs[type]?.[status] || { class: 'badge-secondary', label: status };
    return `<span class="badge ${config.class}">${escapeHtml(config.label)}</span>`;
}

function getCategoryLabel(code) {
    const item = (commonCodes.project_category || []).find(c => c.code_value === code);
    return item?.code_label || code || '-';
}

function getRegionLabel(code) {
    const item = (commonCodes.region || []).find(c => c.code_value === code);
    return item?.code_label || code || '-';
}

function formatRelativeTime(dateStr) {
    if (!dateStr) return '-';
    const date = new Date(dateStr);
    const now = new Date();
    const diffMs = now - date;
    const diffMins = Math.floor(diffMs / 60000);
    const diffHours = Math.floor(diffMs / 3600000);
    const diffDays = Math.floor(diffMs / 86400000);

    if (diffMins < 1) return '방금 전';
    if (diffMins < 60) return `${diffMins}분 전`;
    if (diffHours < 24) return `${diffHours}시간 전`;
    if (diffDays < 7) return `${diffDays}일 전`;
    return date.toLocaleDateString('ko-KR');
}
</script>
