/**
 * SmartFlat CMS v3 - UI Components
 * Toast, Modal, Loading, Alert and other UI utilities
 */

'use strict';

// ============================================
// Global UI State
// ============================================

const V3UI = {
    isShowLoadingProgress: false,
    modalIds: []
};

// ============================================
// Toast Notifications
// ============================================

/**
 * Initialize toast container
 */
function initToastDiv() {
    if (document.getElementById('toastarea')) return;

    const container = document.createElement('div');
    container.className = 'toast-container';
    container.id = 'toastarea';
    document.body.appendChild(container);
}

/**
 * Show toast notification - compatible with v1 C_showToast
 * @param {string} title - Toast title
 * @param {string} message - Toast message
 * @param {Function} callback - Optional callback
 * @param {number} delay - Auto-hide delay (default: 3000ms)
 * @param {Object} style - Optional style overrides
 */
function C_showToast(title, message, callback, delay = 3000, style = {}) {
    initToastDiv();

    const id = random_string();
    const toastArea = document.getElementById('toastarea');

    const toast = document.createElement('div');
    toast.className = 'toast';
    toast.id = id;

    toast.innerHTML = `
        <div class="toast-header">
            <span class="toast-title">${escapeHtml(title)}</span>
            <button class="toast-close" onclick="hideToast('${id}')">&times;</button>
        </div>
        <div class="toast-body">${escapeHtml(message)}</div>
    `;

    // Apply custom styles
    if (style.bgcolor_body) {
        toast.style.backgroundColor = style.bgcolor_body;
    }

    toastArea.appendChild(toast);

    // Auto-hide
    setTimeout(() => {
        hideToast(id, callback);
    }, delay);
}

/**
 * Hide toast notification
 * @param {string} id - Toast ID
 * @param {Function} callback - Optional callback
 */
function hideToast(id, callback) {
    const toast = document.getElementById(id);
    if (toast) {
        toast.classList.add('hiding');
        setTimeout(() => {
            toast.remove();
            if (callback && typeof callback === 'function') {
                callback();
            }
        }, 250);
    }
}

/**
 * Show success toast
 * @param {string} message
 */
function toastSuccess(message) {
    C_showToast('성공', message, null, 3000, {
        bgcolor_body: '#50cd89'
    });
}

/**
 * Show error toast
 * @param {string} message
 */
function toastError(message) {
    C_showToast('오류', message, null, 4000, {
        bgcolor_body: '#f1416c'
    });
}

/**
 * Show warning toast
 * @param {string} message
 */
function toastWarning(message) {
    C_showToast('경고', message, null, 3500, {
        bgcolor_body: '#ffc700'
    });
}

// ============================================
// Loading Progress
// ============================================

/**
 * Show loading overlay - compatible with v1
 */
function C_ShowLoadingProgress() {
    let overlay = document.getElementById('div_loading_progress');

    if (!overlay) {
        overlay = document.createElement('div');
        overlay.id = 'div_loading_progress';
        overlay.className = 'loading-overlay';
        overlay.innerHTML = `
            <div class="loading-content">
                <div class="spinner spinner-lg"></div>
                <div class="loading-text">로딩 중...</div>
            </div>
        `;
        document.body.appendChild(overlay);
    }

    overlay.style.display = 'flex';
    V3UI.isShowLoadingProgress = true;
}

/**
 * Hide loading overlay - compatible with v1
 */
function C_HideLoadingProgress() {
    const overlay = document.getElementById('div_loading_progress');
    if (overlay) {
        overlay.style.display = 'none';
    }
    V3UI.isShowLoadingProgress = false;
}

// ============================================
// Modal Dialog
// ============================================

/**
 * Show modal dialog - compatible with v1 showModalDialog
 * @param {HTMLElement} parent - Parent element (not used in v3, for compatibility)
 * @param {string|Node} title - Modal title
 * @param {string|Node} message - Modal body content (escaped by default for security)
 * @param {string} okText - OK button text
 * @param {string} cancelText - Cancel button text (optional)
 * @param {Function} okCallback - OK button callback
 * @param {Function} cancelCallback - Cancel button callback
 * @param {Object} style - Style options
 * @param {boolean} style.allowHtml - Set to true to allow HTML in message (use only with trusted content)
 * @param {string} style.bodycolor - Background color for modal body
 * @param {Object} style.size - Size options (width, height)
 * @param {Function} onShowCallback - Called when modal is shown
 * @returns {string} Modal ID
 */
function showModalDialog(parent, title, message, okText, cancelText, okCallback, cancelCallback, style, onShowCallback) {
    const id = random_string();
    V3UI.modalIds.push(id);

    // Create backdrop
    const backdrop = document.createElement('div');
    backdrop.className = 'modal-backdrop';
    backdrop.id = `${id}_backdrop`;
    document.body.appendChild(backdrop);

    // Create modal
    const modal = document.createElement('div');
    modal.className = 'modal';
    modal.id = id;

    // Determine modal size
    let sizeClass = '';
    if (style && style.size) {
        if (style.size.width && parseInt(style.size.width) > 800) {
            sizeClass = 'modal-xl';
        } else if (style.size.width && parseInt(style.size.width) > 500) {
            sizeClass = 'modal-lg';
        }
    }
    if (sizeClass) {
        modal.classList.add(sizeClass);
    }

    // Build modal HTML
    let footerHtml = `<button class="btn btn-primary" id="${id}_ok">${escapeHtml(okText)}</button>`;
    if (cancelText) {
        footerHtml = `<button class="btn btn-light" id="${id}_cancel">${escapeHtml(cancelText)}</button>` + footerHtml;
    }

    // Determine if message should be treated as HTML (opt-in for trusted content)
    const allowHtml = style && style.allowHtml === true;
    const safeMessage = typeof message === 'string'
        ? (allowHtml ? message : escapeHtml(message))
        : '';

    modal.innerHTML = `
        <div class="modal-dialog">
            <div class="modal-header">
                <h5 class="modal-title" id="${id}_title">${typeof title === 'string' ? escapeHtml(title) : ''}</h5>
                <button class="modal-close" onclick="hideModalDialog()">&times;</button>
            </div>
            <div class="modal-body" id="${id}_body">
                ${safeMessage}
            </div>
            <div class="modal-footer" id="${id}_footer">
                ${footerHtml}
            </div>
        </div>
    `;

    document.body.appendChild(modal);

    // Apply body color safely via DOM API (prevents CSS injection)
    if (style && style.bodycolor) {
        const bodyEl = document.getElementById(`${id}_body`);
        if (bodyEl) {
            bodyEl.style.backgroundColor = style.bodycolor;
        }
    }

    // Handle DOM element title/message
    if (typeof title === 'object' && title instanceof Node) {
        document.getElementById(`${id}_title`).innerHTML = '';
        document.getElementById(`${id}_title`).appendChild(title);
    }
    if (typeof message === 'object' && message instanceof Node) {
        document.getElementById(`${id}_body`).innerHTML = '';
        document.getElementById(`${id}_body`).appendChild(message);
    }

    // Show modal with animation
    setTimeout(() => {
        backdrop.classList.add('show');
        modal.classList.add('show');
    }, 10);

    // Event handlers
    document.getElementById(`${id}_ok`).addEventListener('click', () => {
        if (okCallback && typeof okCallback === 'function') {
            okCallback();
        }
    });

    if (cancelText) {
        document.getElementById(`${id}_cancel`).addEventListener('click', () => {
            if (cancelCallback && typeof cancelCallback === 'function') {
                cancelCallback();
            } else {
                hideModalDialog();
            }
        });
    }

    // Escape key to close
    const escHandler = (e) => {
        if (e.key === 'Escape') {
            hideModalDialog();
            document.removeEventListener('keydown', escHandler);
        }
    };
    document.addEventListener('keydown', escHandler);

    // Callback when shown
    if (onShowCallback && typeof onShowCallback === 'function') {
        onShowCallback(id);
    }

    return id;
}

/**
 * Hide modal dialog - compatible with v1
 */
function hideModalDialog() {
    const id = V3UI.modalIds.pop();
    if (!id) return;

    const modal = document.getElementById(id);
    const backdrop = document.getElementById(`${id}_backdrop`);

    if (modal) {
        modal.classList.remove('show');
    }
    if (backdrop) {
        backdrop.classList.remove('show');
    }

    setTimeout(() => {
        if (modal) modal.remove();
        if (backdrop) backdrop.remove();
    }, 250);
}

/**
 * Hide all modals
 */
function hideAllModals() {
    while (V3UI.modalIds.length > 0) {
        hideModalDialog();
    }
}

// ============================================
// Alert Dialog
// ============================================

/**
 * Show alert message - compatible with v1 alertMsg
 * @param {string} message
 * @param {Function} callback
 */
function alertMsg(message, callback) {
    if (!message) return;
    showModalDialog(document.body, '알림', message, '확인', null, function() {
        hideModalDialog();
        if (callback && typeof callback === 'function') {
            callback();
        }
    }, null);
}

/**
 * Show confirm dialog
 * @param {string} message
 * @param {Function} onConfirm
 * @param {Function} onCancel
 */
function confirmMsg(message, onConfirm, onCancel) {
    showModalDialog(document.body, '확인', message, '확인', '취소', function() {
        hideModalDialog();
        if (onConfirm && typeof onConfirm === 'function') {
            onConfirm();
        }
    }, function() {
        hideModalDialog();
        if (onCancel && typeof onCancel === 'function') {
            onCancel();
        }
    });
}

// ============================================
// Screen Resize Handler
// ============================================

let screen_zoom = 100;

/**
 * Handle screen resize
 */
function resize_screen() {
    const width = window.innerWidth;

    // Adjust zoom based on screen width
    if (width < 768) {
        screen_zoom = 90;
    } else if (width < 992) {
        screen_zoom = 95;
    } else {
        screen_zoom = 100;
    }

    // Trigger custom event
    const event = new CustomEvent('screenResize', {
        detail: { width, zoom: screen_zoom }
    });
    document.dispatchEvent(event);
}

// ============================================
// Dropdown Component
// ============================================

/**
 * Toggle dropdown
 * @param {HTMLElement|string} element
 */
function toggleDropdown(element) {
    const dropdown = typeof element === 'string' ? document.getElementById(element) : element.closest('.dropdown');
    if (dropdown) {
        dropdown.classList.toggle('open');
    }
}

/**
 * Close all dropdowns
 */
function closeAllDropdowns() {
    document.querySelectorAll('.dropdown.open').forEach(dropdown => {
        dropdown.classList.remove('open');
    });
}

// Close dropdowns when clicking outside
document.addEventListener('click', (e) => {
    if (!e.target.closest('.dropdown')) {
        closeAllDropdowns();
    }
});

// ============================================
// Tab Component
// ============================================

/**
 * Switch tab
 * @param {string} tabId
 * @param {string} contentId
 */
function switchTab(tabId, contentId) {
    // Update tab items
    document.querySelectorAll('.tab-item').forEach(tab => {
        tab.classList.remove('active');
    });
    document.getElementById(tabId)?.classList.add('active');

    // Update tab content
    document.querySelectorAll('.tab-content').forEach(content => {
        content.style.display = 'none';
    });
    document.getElementById(contentId).style.display = 'block';
}

// ============================================
// Sidebar Toggle
// ============================================

/**
 * Toggle sidebar collapsed state
 */
function toggleSidebar() {
    const sidebar = document.querySelector('.app-sidebar');
    const overlay = document.querySelector('.sidebar-overlay');

    if (window.innerWidth <= 991) {
        // Mobile: show/hide sidebar
        sidebar?.classList.toggle('show');
        overlay?.classList.toggle('show');
    } else {
        // Desktop: collapse/expand sidebar
        document.body.classList.toggle('sidebar-collapsed');
        sidebar?.classList.toggle('collapsed');
    }
}

/**
 * Close sidebar (mobile)
 */
function closeSidebar() {
    const sidebar = document.querySelector('.app-sidebar');
    const overlay = document.querySelector('.sidebar-overlay');
    sidebar?.classList.remove('show');
    overlay?.classList.remove('show');
}

// ============================================
// Menu Toggle
// ============================================

/**
 * Toggle submenu
 * @param {HTMLElement} element
 */
function toggleSubmenu(element) {
    const menuItem = element.closest('.menu-item');
    if (menuItem) {
        menuItem.classList.toggle('open');
    }
}

// ============================================
// Initialize UI
// ============================================

/**
 * Initialize UI components
 */
function initUI() {
    // Initialize toast container
    initToastDiv();

    // Run initial resize calculation (listener is set up in app.js setupEventListeners)
    resize_screen();

    // Create sidebar overlay for mobile
    if (!document.querySelector('.sidebar-overlay')) {
        const overlay = document.createElement('div');
        overlay.className = 'sidebar-overlay';
        overlay.onclick = closeSidebar;
        document.body.appendChild(overlay);
    }
}

// Auto-initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initUI);
} else {
    initUI();
}

// ============================================
// Export for module usage
// ============================================

if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        V3UI,
        initToastDiv,
        C_showToast,
        hideToast,
        toastSuccess,
        toastError,
        toastWarning,
        C_ShowLoadingProgress,
        C_HideLoadingProgress,
        showModalDialog,
        hideModalDialog,
        hideAllModals,
        alertMsg,
        confirmMsg,
        resize_screen,
        toggleDropdown,
        closeAllDropdowns,
        switchTab,
        toggleSidebar,
        closeSidebar,
        toggleSubmenu,
        initUI
    };
}
