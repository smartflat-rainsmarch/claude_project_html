<!-- SmartFlat CMS v3 - Content Management Page -->
<?php
require_once(__DIR__ . '/../../components/breadcrumb.php');
require_once(__DIR__ . '/../../components/status-badge.php');

$projectId = isset($_GET['project_id']) ? (int)$_GET['project_id'] : 0;
?>

<?php
renderPageHeader('콘텐츠 관리', [
    ['label' => '홈', 'link' => 'dashboard'],
    ['label' => '콘텐츠 관리']
], '콘텐츠를 생성하고 관리합니다', [
    [
        'label' => '새 콘텐츠',
        'icon' => 'fa-plus',
        'class' => 'btn btn-primary',
        'onclick' => 'showContentForm()'
    ]
]);
?>

<!-- Filter Panel -->
<div class="card" style="margin-bottom: 16px;">
    <div class="card-body" style="padding: 16px;">
        <div class="filter-inline">
            <div class="filter-row">
                <div class="filter-field">
                    <label class="filter-label">프로젝트</label>
                    <select class="form-control form-control-sm" id="filter-project" onchange="applyContentFilters()">
                        <option value="">전체</option>
                    </select>
                </div>
                <div class="filter-field">
                    <label class="filter-label">타입</label>
                    <select class="form-control form-control-sm" id="filter-type" onchange="applyContentFilters()">
                        <option value="">전체</option>
                    </select>
                </div>
                <div class="filter-field">
                    <label class="filter-label">상태</label>
                    <select class="form-control form-control-sm" id="filter-status" onchange="applyContentFilters()">
                        <option value="">전체</option>
                        <option value="draft">초안</option>
                        <option value="published">게시중</option>
                        <option value="archived">보관</option>
                    </select>
                </div>
                <div class="filter-field" style="flex: 2;">
                    <label class="filter-label">검색</label>
                    <input type="text" class="form-control form-control-sm" id="filter-search"
                           placeholder="콘텐츠명 검색..." onkeyup="debounceSearch(this.value)">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Table -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">콘텐츠 목록</h3>
        <div class="card-toolbar">
            <button class="btn btn-light btn-sm" onclick="contentTable?.refresh()">
                <i class="fas fa-sync"></i> 새로고침
            </button>
        </div>
    </div>
    <div class="card-body" style="padding: 0;">
        <div class="data-table-wrapper" id="content-table_wrapper">
            <div class="table-container">
                <table class="table" id="content-table">
                    <thead>
                        <tr>
                            <th>콘텐츠명</th>
                            <th>프로젝트</th>
                            <th>타입</th>
                            <th>상태</th>
                            <th>버전</th>
                            <th>수정일</th>
                            <th style="width: 140px;">관리</th>
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
                <div class="table-info" id="content-table_info">
                    총 <span class="total-count">0</span>건
                </div>
                <div class="table-pagination" id="content-table_pagination"></div>
            </div>
        </div>
    </div>
</div>

<!-- Content Form Modal Template -->
<div id="content-form-template" style="display: none;">
    <form id="content-form" onsubmit="return saveContent(event)">
        <input type="hidden" id="content-id" name="id">

        <div class="row">
            <div class="col col-md-6">
                <div class="form-group">
                    <label class="form-label">프로젝트 <span class="text-danger">*</span></label>
                    <select class="form-control" id="content-project" name="project_id" required>
                        <option value="">선택하세요</option>
                    </select>
                </div>
            </div>
            <div class="col col-md-6">
                <div class="form-group">
                    <label class="form-label">콘텐츠 키 <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="content-key" name="content_key"
                           placeholder="영문, 숫자만" pattern="[a-zA-Z0-9_-]+" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col col-md-6">
                <div class="form-group">
                    <label class="form-label">콘텐츠명 <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="content-name" name="name" required>
                </div>
            </div>
            <div class="col col-md-6">
                <div class="form-group">
                    <label class="form-label">타입 <span class="text-danger">*</span></label>
                    <select class="form-control" id="content-type" name="content_type" required onchange="updateConfigForm()">
                        <option value="">선택하세요</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Dynamic Config Form -->
        <div id="config-form-area">
            <!-- Config fields will be rendered here based on content type -->
        </div>

        <div class="row">
            <div class="col col-md-6">
                <div class="form-group">
                    <label class="form-label">표시 순서</label>
                    <input type="number" class="form-control" id="content-order" name="display_order" value="0">
                </div>
            </div>
            <div class="col col-md-6">
                <div class="form-group">
                    <label class="form-label">상태</label>
                    <select class="form-control" id="content-status" name="status">
                        <option value="draft">초안</option>
                        <option value="published">게시</option>
                    </select>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
/**
 * Content List Page
 */

let contentTable = null;
let commonCodes = {};
let projects = [];
let searchDebounceTimer = null;
const initialProjectId = <?php echo $projectId ?: 'null'; ?>;

// Initialize on load
(function() {
    clog('Content page loaded');
    loadInitialData();
})();

/**
 * Load initial data
 */
async function loadInitialData() {
    try {
        // Load common codes
        const codesResponse = await fetch('/web/v3/dist/api/v3/router.php?route=common-codes', {
            credentials: 'same-origin'
        });
        const codesResult = await codesResponse.json();
        if (codesResult.code === 100) {
            commonCodes = codesResult.data;
        }

        // Load projects
        const projectsResponse = await fetch('/web/v3/dist/api/v3/router.php?route=projects&limit=100', {
            credentials: 'same-origin'
        });
        const projectsResult = await projectsResponse.json();
        if (projectsResult.code === 100) {
            projects = projectsResult.data.items || [];
        }

        populateDropdowns();
        initContentTable();

        // Apply initial project filter
        if (initialProjectId) {
            document.getElementById('filter-project').value = initialProjectId;
            applyContentFilters();
        }
    } catch (error) {
        cerror('Failed to load initial data:', error);
    }
}

/**
 * Populate dropdown options
 */
function populateDropdowns() {
    // Projects
    const projectSelects = document.querySelectorAll('#filter-project, #content-project');
    projectSelects.forEach(select => {
        // Clear existing options except first
        while (select.options.length > 1) {
            select.remove(1);
        }
        projects.forEach(project => {
            const option = document.createElement('option');
            option.value = project.id;
            option.textContent = project.name;
            select.appendChild(option);
        });
    });

    // Content Types
    const typeSelects = document.querySelectorAll('#filter-type, #content-type');
    typeSelects.forEach(select => {
        while (select.options.length > 1) {
            select.remove(1);
        }
        (commonCodes.content_type || []).forEach(item => {
            const option = document.createElement('option');
            option.value = item.code_value;
            option.textContent = item.code_label;
            select.appendChild(option);
        });
    });
}

/**
 * Initialize content data table
 */
function initContentTable() {
    contentTable = new SFDataTable('content-table', {
        apiUrl: '/web/v3/dist/api/v3/router.php?route=contents',
        pageSize: 20,
        columns: [
            { key: 'name', label: '콘텐츠명' },
            { key: 'project_name', label: '프로젝트' },
            { key: 'content_type', label: '타입' },
            { key: 'status', label: '상태' },
            { key: 'current_version', label: '버전' },
            { key: 'updated_at', label: '수정일' },
            { key: 'actions', label: '관리' }
        ],
        onRowClick: (row) => {
            editContent(row.id);
        }
    });

    contentTable.renderRow = function(row) {
        const statusBadge = getStatusBadgeHtml(row.status, 'content');
        const typeIcon = getContentTypeIcon(row.content_type);
        const typeLabel = getContentTypeLabel(row.content_type);
        const updatedAt = formatDateTime(row.updated_at);

        return `
            <tr data-id="${escapeHtml(String(row.id))}">
                <td>
                    <i class="fas ${typeIcon}" style="margin-right: 8px; color: var(--text-muted);"></i>
                    <strong>${escapeHtml(row.name)}</strong>
                    <small class="text-muted d-block">${escapeHtml(row.content_key)}</small>
                </td>
                <td>${escapeHtml(row.project_name || '-')}</td>
                <td>${escapeHtml(typeLabel)}</td>
                <td>${statusBadge}</td>
                <td>v${row.current_version || 1}</td>
                <td>${escapeHtml(updatedAt)}</td>
                <td class="no-row-click">
                    <div class="btn-group">
                        <button class="btn btn-sm btn-light" onclick="editContent(${row.id})" title="수정">
                            <i class="fas fa-edit"></i>
                        </button>
                        ${row.status === 'draft' ? `
                        <button class="btn btn-sm btn-success" onclick="publishContent(${row.id})" title="게시">
                            <i class="fas fa-check"></i>
                        </button>
                        ` : ''}
                        <button class="btn btn-sm btn-light text-danger" onclick="deleteContent(${row.id}, '${escapeHtml(row.name)}')" title="삭제">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `;
    };
}

/**
 * Apply filters
 */
function applyContentFilters() {
    const filters = {
        project_id: document.getElementById('filter-project').value,
        content_type: document.getElementById('filter-type').value,
        status: document.getElementById('filter-status').value,
        search: document.getElementById('filter-search').value
    };

    contentTable?.setFilters(filters);
}

function debounceSearch(value) {
    clearTimeout(searchDebounceTimer);
    searchDebounceTimer = setTimeout(() => applyContentFilters(), 300);
}

/**
 * Show content form
 */
function showContentForm(contentId = null) {
    const isEdit = !!contentId;
    const title = isEdit ? '콘텐츠 수정' : '새 콘텐츠';

    const formHtml = document.getElementById('content-form-template').innerHTML;

    showModalDialog(document.body, title, formHtml, '저장', '취소',
        function() {
            saveContent();
        },
        function() {
            hideModalDialog();
        },
        { size: { width: 700 }, allowHtml: true }
    );

    setTimeout(() => {
        populateDropdowns();
        if (isEdit) {
            loadContentForEdit(contentId);
        }
    }, 100);
}

/**
 * Load content for editing
 */
async function loadContentForEdit(contentId) {
    try {
        const response = await fetch(`/web/v3/dist/api/v3/router.php?route=contents/${contentId}`, {
            credentials: 'same-origin'
        });
        const result = await response.json();

        if (result.code === 100) {
            const content = result.data;
            document.getElementById('content-id').value = content.id;
            document.getElementById('content-project').value = content.project_id;
            document.getElementById('content-key').value = content.content_key;
            document.getElementById('content-key').disabled = true;
            document.getElementById('content-name').value = content.name;
            document.getElementById('content-type').value = content.content_type;
            document.getElementById('content-order').value = content.display_order || 0;
            document.getElementById('content-status').value = content.status;

            updateConfigForm(content.config);
        }
    } catch (error) {
        cerror('Failed to load content:', error);
        toastError('콘텐츠 정보를 불러오는데 실패했습니다.');
    }
}

function editContent(contentId) {
    showContentForm(contentId);
}

/**
 * Update config form based on content type
 */
function updateConfigForm(existingConfig = null) {
    const type = document.getElementById('content-type')?.value;
    const area = document.getElementById('config-form-area');

    if (!type || !area) return;

    let configHtml = '<hr style="margin: 16px 0;"><h6>콘텐츠 설정</h6>';

    switch (type) {
        case 'image':
        case 'slideshow':
            configHtml += `
                <div class="form-group">
                    <label class="form-label">이미지 URL (줄바꿈으로 구분)</label>
                    <textarea class="form-control" id="config-images" rows="3">${existingConfig?.images?.map(i => i.url).join('\n') || ''}</textarea>
                </div>
                <div class="row">
                    <div class="col col-md-6">
                        <div class="form-group">
                            <label class="form-label">자동재생</label>
                            <select class="form-control" id="config-autoplay">
                                <option value="true" ${existingConfig?.autoplay !== false ? 'selected' : ''}>예</option>
                                <option value="false" ${existingConfig?.autoplay === false ? 'selected' : ''}>아니오</option>
                            </select>
                        </div>
                    </div>
                    <div class="col col-md-6">
                        <div class="form-group">
                            <label class="form-label">전환 간격 (ms)</label>
                            <input type="number" class="form-control" id="config-interval" value="${existingConfig?.interval || 5000}">
                        </div>
                    </div>
                </div>
            `;
            break;

        case 'video':
            configHtml += `
                <div class="form-group">
                    <label class="form-label">비디오 URL</label>
                    <input type="text" class="form-control" id="config-videoUrl" value="${existingConfig?.videoUrl || ''}">
                </div>
                <div class="row">
                    <div class="col col-md-4">
                        <div class="form-group">
                            <label class="form-label">자동재생</label>
                            <select class="form-control" id="config-autoplay">
                                <option value="true" ${existingConfig?.autoplay !== false ? 'selected' : ''}>예</option>
                                <option value="false" ${existingConfig?.autoplay === false ? 'selected' : ''}>아니오</option>
                            </select>
                        </div>
                    </div>
                    <div class="col col-md-4">
                        <div class="form-group">
                            <label class="form-label">반복</label>
                            <select class="form-control" id="config-loop">
                                <option value="true" ${existingConfig?.loop !== false ? 'selected' : ''}>예</option>
                                <option value="false" ${existingConfig?.loop === false ? 'selected' : ''}>아니오</option>
                            </select>
                        </div>
                    </div>
                    <div class="col col-md-4">
                        <div class="form-group">
                            <label class="form-label">음소거</label>
                            <select class="form-control" id="config-muted">
                                <option value="false" ${existingConfig?.muted !== true ? 'selected' : ''}>아니오</option>
                                <option value="true" ${existingConfig?.muted === true ? 'selected' : ''}>예</option>
                            </select>
                        </div>
                    </div>
                </div>
            `;
            break;

        case 'html':
        case 'iframe':
            configHtml += `
                <div class="form-group">
                    <label class="form-label">URL</label>
                    <input type="text" class="form-control" id="config-url" value="${existingConfig?.url || ''}" placeholder="https://...">
                </div>
            `;
            break;

        default:
            configHtml = '';
    }

    area.innerHTML = configHtml;
}

/**
 * Save content
 */
async function saveContent() {
    const data = {
        id: document.getElementById('content-id')?.value || null,
        project_id: document.getElementById('content-project')?.value,
        content_key: document.getElementById('content-key')?.value,
        name: document.getElementById('content-name')?.value,
        content_type: document.getElementById('content-type')?.value,
        display_order: document.getElementById('content-order')?.value || 0,
        status: document.getElementById('content-status')?.value || 'draft',
        config: buildConfigObject(document.getElementById('content-type')?.value)
    };

    const isEdit = !!data.id;

    C_ShowLoadingProgress();

    try {
        const url = isEdit
            ? `/web/v3/dist/api/v3/router.php?route=contents/${data.id}`
            : '/web/v3/dist/api/v3/router.php?route=contents';

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
            toastSuccess(isEdit ? '콘텐츠가 수정되었습니다.' : '콘텐츠가 생성되었습니다.');
            contentTable?.refresh();
        } else {
            toastError(result.message || '저장에 실패했습니다.');
        }
    } catch (error) {
        cerror('Failed to save content:', error);
        toastError('저장 중 오류가 발생했습니다.');
    } finally {
        C_HideLoadingProgress();
    }
}

function buildConfigObject(type) {
    const config = {};

    switch (type) {
        case 'image':
        case 'slideshow':
            const imagesText = document.getElementById('config-images')?.value || '';
            config.images = imagesText.split('\n').filter(u => u.trim()).map((url, i) => ({ url: url.trim(), order: i + 1 }));
            config.autoplay = document.getElementById('config-autoplay')?.value === 'true';
            config.interval = parseInt(document.getElementById('config-interval')?.value) || 5000;
            break;

        case 'video':
            config.videoUrl = document.getElementById('config-videoUrl')?.value || '';
            config.autoplay = document.getElementById('config-autoplay')?.value === 'true';
            config.loop = document.getElementById('config-loop')?.value === 'true';
            config.muted = document.getElementById('config-muted')?.value === 'true';
            break;

        case 'html':
        case 'iframe':
            config.url = document.getElementById('config-url')?.value || '';
            break;
    }

    return config;
}

/**
 * Publish content
 */
async function publishContent(contentId) {
    confirmMsg('콘텐츠를 게시하시겠습니까?', async function() {
        C_ShowLoadingProgress();

        try {
            const response = await fetch(`/web/v3/dist/api/v3/router.php?route=contents/${contentId}/publish`, {
                method: 'POST',
                headers: {
                    'X-CSRF-Token': '<?php echo $_SESSION['csrf_token'] ?? ''; ?>'
                },
                credentials: 'same-origin'
            });

            const result = await response.json();

            if (result.code === 100) {
                toastSuccess('콘텐츠가 게시되었습니다.');
                contentTable?.refresh();
            } else {
                toastError(result.message || '게시에 실패했습니다.');
            }
        } catch (error) {
            cerror('Failed to publish:', error);
            toastError('게시 중 오류가 발생했습니다.');
        } finally {
            C_HideLoadingProgress();
        }
    });
}

/**
 * Delete content
 */
function deleteContent(contentId, contentName) {
    confirmMsg(`"${contentName}" 콘텐츠를 삭제하시겠습니까?`, async function() {
        C_ShowLoadingProgress();

        try {
            const response = await fetch(`/web/v3/dist/api/v3/router.php?route=contents/${contentId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-Token': '<?php echo $_SESSION['csrf_token'] ?? ''; ?>'
                },
                credentials: 'same-origin'
            });

            const result = await response.json();

            if (result.code === 100) {
                toastSuccess('콘텐츠가 삭제되었습니다.');
                contentTable?.refresh();
            } else {
                toastError(result.message || '삭제에 실패했습니다.');
            }
        } catch (error) {
            cerror('Failed to delete:', error);
            toastError('삭제 중 오류가 발생했습니다.');
        } finally {
            C_HideLoadingProgress();
        }
    });
}

// Helper functions
function getStatusBadgeHtml(status, type) {
    const configs = {
        content: {
            draft: { class: 'badge-secondary', label: '초안' },
            published: { class: 'badge-success', label: '게시중' },
            archived: { class: 'badge-dark', label: '보관' }
        }
    };

    const config = configs[type]?.[status] || { class: 'badge-secondary', label: status };
    return `<span class="badge ${config.class}">${escapeHtml(config.label)}</span>`;
}

function getContentTypeIcon(type) {
    const icons = {
        image: 'fa-image',
        video: 'fa-video',
        pdf: 'fa-file-pdf',
        html: 'fa-code',
        survey: 'fa-poll',
        slideshow: 'fa-images',
        weather: 'fa-cloud-sun',
        clock: 'fa-clock',
        text: 'fa-font',
        iframe: 'fa-globe'
    };
    return icons[type] || 'fa-file';
}

function getContentTypeLabel(type) {
    const item = (commonCodes.content_type || []).find(c => c.code_value === type);
    return item?.code_label || type || '-';
}

function formatDateTime(dateStr) {
    if (!dateStr) return '-';
    return new Date(dateStr).toLocaleString('ko-KR');
}
</script>
