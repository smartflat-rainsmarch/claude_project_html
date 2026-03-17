/**
 * SmartFlat CMS v3 - Application Core
 * Main application initialization, routing, and page management
 */

'use strict';

// ============================================
// Application State
// ============================================

const V3App = {
    // Current state
    currentPage: null,
    currentProjectId: null,
    currentSection: null,

    // Page registry
    pages: {
        dashboard: { path: 'pages/dashboard/index.php', title: '대시보드' },
        project: { path: 'pages/project/index.php', title: '프로젝트' },
        content: { path: 'pages/content/index.php', title: '콘텐츠' },
        device: { path: 'pages/device/index.php', title: '기기' },
        deployment: { path: 'pages/deployment/index.php', title: '배포' },
        monitoring: { path: 'pages/monitoring/index.php', title: '모니터링' },
        version: { path: 'pages/version/index.php', title: '버전관리' },
        audit: { path: 'pages/audit/index.php', title: '감사로그' },
        settings: { path: 'pages/settings/index.php', title: '설정' }
    },

    // Sub-pages
    subPages: {
        'content/editor': { path: 'pages/content/editor.php', title: '화면 편집' },
        'content/templates': { path: 'pages/content/templates.php', title: '템플릿' },
        'content/media': { path: 'pages/content/media.php', title: '미디어' },
        'device/groups': { path: 'pages/device/groups.php', title: '기기 그룹' },
        'deployment/schedule': { path: 'pages/deployment/schedule.php', title: '배포 예약' },
        'deployment/history': { path: 'pages/deployment/history.php', title: '배포 이력' },
        'monitoring/logs': { path: 'pages/monitoring/logs.php', title: '로그' },
        'monitoring/alerts': { path: 'pages/monitoring/alerts.php', title: '알림' }
    },

    // Initialization flag
    initialized: false
};

// ============================================
// Application Initialization
// ============================================

/**
 * Initialize the application
 */
function initApp() {
    if (V3App.initialized) return;

    clog('Initializing SmartFlat CMS v3...');

    // Initialize save key for localStorage
    initSaveKey(global_id);

    // Initialize UI components
    initUI();

    // Load saved state
    loadAppState();

    // Set up event listeners
    setupEventListeners();

    // Load initial page
    const initialPage = getData('lastPage') || 'dashboard';
    loadPage(initialPage);

    // Check auth periodically
    setupAuthCheck();

    V3App.initialized = true;
    clog('SmartFlat CMS v3 initialized');
}

/**
 * Load application state from localStorage
 */
function loadAppState() {
    V3App.currentProjectId = getData('currentProjectId');
    V3App.currentSection = getData('currentSection');

    // Load sidebar state
    const sidebarCollapsed = getData('sidebarCollapsed') === 'true';
    if (sidebarCollapsed) {
        document.body.classList.add('sidebar-collapsed');
        document.querySelector('.app-sidebar')?.classList.add('collapsed');
    }
}

/**
 * Save application state to localStorage
 */
function saveAppState() {
    if (V3App.currentProjectId) {
        saveData('currentProjectId', V3App.currentProjectId);
    }
    if (V3App.currentSection) {
        saveData('currentSection', V3App.currentSection);
    }
    if (V3App.currentPage) {
        saveData('lastPage', V3App.currentPage);
    }

    const sidebarCollapsed = document.body.classList.contains('sidebar-collapsed');
    saveData('sidebarCollapsed', sidebarCollapsed.toString());
}

// ============================================
// Page Loading
// ============================================

/**
 * Load a page into the main content area
 * @param {string} pageName - Page identifier
 * @param {Object} params - Optional parameters
 * @param {Function} callback - Optional callback after load
 */
function loadPage(pageName, params = {}, callback) {
    const pageConfig = V3App.pages[pageName] || V3App.subPages[pageName];

    if (!pageConfig) {
        cerror(`Page not found: ${pageName}`);
        loadPage('dashboard');
        return;
    }

    clog(`Loading page: ${pageName}`);
    C_ShowLoadingProgress();

    // Update state
    V3App.currentPage = pageName;
    saveAppState();

    // Update active menu item
    updateActiveMenu(pageName);

    // Update breadcrumb
    updateBreadcrumb(pageConfig.title);

    // Load page content
    const mainContent = document.getElementById('main-content');
    if (!mainContent) {
        cerror('Main content container not found');
        C_HideLoadingProgress();
        return;
    }

    // Build URL with params
    let url = pageConfig.path;
    if (Object.keys(params).length > 0) {
        const queryString = new URLSearchParams(params).toString();
        url += '?' + queryString;
    }

    // Use jQuery load for PHP include support
    $(mainContent).load(url, function(response, status, xhr) {
        C_HideLoadingProgress();

        if (status === 'error') {
            cerror(`Failed to load page: ${xhr.status} ${xhr.statusText}`);
            mainContent.innerHTML = `
                <div class="card">
                    <div class="card-body">
                        <div class="empty-state">
                            <div class="empty-state-icon"><i class="fas fa-exclamation-triangle"></i></div>
                            <h4 class="empty-state-title">페이지 로드 실패</h4>
                            <p class="empty-state-description">페이지를 불러오는 중 오류가 발생했습니다.</p>
                            <button class="btn btn-primary" onclick="loadPage('dashboard')">대시보드로 이동</button>
                        </div>
                    </div>
                </div>
            `;
            return;
        }

        // Trigger page loaded event
        const event = new CustomEvent('pageLoaded', {
            detail: { page: pageName, params }
        });
        document.dispatchEvent(event);

        if (callback && typeof callback === 'function') {
            callback();
        }
    });
}

/**
 * Update active menu item
 * @param {string} pageName
 */
function updateActiveMenu(pageName) {
    // Remove all active states
    document.querySelectorAll('.menu-link').forEach(link => {
        link.classList.remove('active');
    });

    // Find and activate current menu item
    const menuLink = document.querySelector(`[data-page="${pageName}"]`);
    if (menuLink) {
        menuLink.classList.add('active');

        // Open parent submenu if exists
        const parentMenuItem = menuLink.closest('.menu-item');
        if (parentMenuItem && parentMenuItem.querySelector('.menu-submenu')) {
            parentMenuItem.classList.add('open');
        }
    }

    // For sub-pages, also activate parent
    const basePage = pageName.split('/')[0];
    if (basePage !== pageName) {
        const parentLink = document.querySelector(`[data-page="${basePage}"]`);
        if (parentLink) {
            parentLink.classList.add('active');
        }
    }
}

/**
 * Update breadcrumb
 * @param {string} title
 */
function updateBreadcrumb(title) {
    const breadcrumb = document.querySelector('.header-breadcrumb');
    if (!breadcrumb) return;

    breadcrumb.innerHTML = `
        <a href="#" class="breadcrumb-item" onclick="loadPage('dashboard')">홈</a>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-item active">${escapeHtml(title)}</span>
    `;
}

// ============================================
// Event Listeners
// ============================================

/**
 * Set up global event listeners
 */
function setupEventListeners() {
    // Window resize
    window.addEventListener('resize', debounce(() => {
        resize_screen();
        saveAppState();
    }, 250));

    // Before unload - save state
    window.addEventListener('beforeunload', () => {
        saveAppState();
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', (e) => {
        // Ctrl+K: Quick search
        if (e.ctrlKey && e.key === 'k') {
            e.preventDefault();
            openQuickSearch();
        }

        // Escape: Close modals
        if (e.key === 'Escape') {
            closeAllDropdowns();
        }
    });

    // Menu item clicks
    document.addEventListener('click', (e) => {
        const menuLink = e.target.closest('.menu-link[data-page]');
        if (menuLink) {
            e.preventDefault();
            const page = menuLink.dataset.page;
            loadPage(page);

            // Close mobile sidebar
            if (window.innerWidth <= 991) {
                closeSidebar();
            }
        }
    });

    // Submenu toggle
    document.addEventListener('click', (e) => {
        const submenuToggle = e.target.closest('.menu-link.has-submenu');
        if (submenuToggle) {
            e.preventDefault();
            toggleSubmenu(submenuToggle);
        }
    });
}

// ============================================
// Authentication Check
// ============================================

/**
 * Set up periodic auth check
 */
function setupAuthCheck() {
    // Check auth every 5 minutes
    setInterval(() => {
        checkAuthStatus();
    }, 5 * 60 * 1000);
}

/**
 * Check authentication status
 */
function checkAuthStatus() {
    // Simple ping to check session
    $.ajax({
        url: 'common.php',
        type: 'HEAD',
        success: function() {
            // Session valid
        },
        error: function(xhr) {
            if (xhr.status === 401 || xhr.status === 403) {
                alertMsg('세션이 만료되었습니다. 다시 로그인해 주세요.', () => {
                    window.location.href = PAGE_ADMIN_LOGIN;
                });
            }
        }
    });
}

// ============================================
// Quick Search
// ============================================

/**
 * Open quick search modal
 */
function openQuickSearch() {
    const searchHtml = `
        <div class="form-group">
            <input type="text" class="form-control" id="quick-search-input"
                   placeholder="페이지, 프로젝트, 기기 검색..." autofocus>
        </div>
        <div id="quick-search-results"></div>
    `;

    showModalDialog(document.body, '빠른 검색', searchHtml, '닫기', null, () => {
        hideModalDialog();
    }, null, { size: { width: '500px' }, allowHtml: true }, () => {
        // Focus input after modal shown
        setTimeout(() => {
            document.getElementById('quick-search-input')?.focus();
        }, 100);

        // Set up search handler
        const searchInput = document.getElementById('quick-search-input');
        if (searchInput) {
            searchInput.addEventListener('input', debounce((e) => {
                performQuickSearch(e.target.value);
            }, 300));
        }
    });
}

/**
 * Perform quick search
 * @param {string} query
 */
function performQuickSearch(query) {
    const resultsContainer = document.getElementById('quick-search-results');
    if (!resultsContainer) return;

    if (!query || query.length < 2) {
        resultsContainer.innerHTML = '';
        return;
    }

    // Search pages
    const pageResults = Object.entries(V3App.pages)
        .filter(([key, page]) => page.title.toLowerCase().includes(query.toLowerCase()))
        .map(([key, page]) => ({
            type: 'page',
            key,
            title: page.title,
            icon: 'fa-file'
        }));

    // Display results
    if (pageResults.length === 0) {
        resultsContainer.innerHTML = '<p class="text-muted" style="padding: 16px;">검색 결과가 없습니다.</p>';
        return;
    }

    resultsContainer.innerHTML = pageResults.map(result => `
        <div class="dropdown-item" onclick="loadPage('${result.key}'); hideModalDialog();">
            <i class="fas ${result.icon}"></i>
            <span>${escapeHtml(result.title)}</span>
        </div>
    `).join('');
}

// ============================================
// Sidebar Toggle Export
// ============================================

/**
 * Toggle sidebar - exposed for global access
 */
V3App.toggleSidebar = function() {
    toggleSidebar();
    saveAppState();
};

/**
 * Load page - exposed for global access
 */
V3App.loadPage = loadPage;

// ============================================
// Legacy Compatibility
// ============================================

/**
 * Legacy loadMainDiv compatibility
 * @param {number} id
 * @param {any} value
 * @param {Function} callback
 */
function loadMainDiv(id, value, callback) {
    const pageMap = {
        0: 'dashboard',
        1: 'project',
        2: 'content',
        3: 'device',
        4: 'deployment',
        5: 'monitoring'
    };

    const page = pageMap[id] || 'dashboard';
    loadPage(page, value ? { value } : {}, callback);
}

/**
 * Legacy uiinit compatibility
 * @param {string} session
 * @param {string} username
 */
function uiinit(session, username) {
    clog('UI initialized for user:', username);

    // Update user display
    const userNameEl = document.querySelector('.user-name');
    if (userNameEl) {
        userNameEl.textContent = username;
    }
}

// ============================================
// Document Ready
// ============================================

$(document).ready(function() {
    initApp();
});

// ============================================
// Export for module usage
// ============================================

if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        V3App,
        initApp,
        loadPage,
        loadMainDiv,
        uiinit
    };
}
