/**
 * SmartFlat CMS v3 - Core Utilities
 * Essential utility functions extracted and modernized from v1
 */

'use strict';

// ============================================
// Debug Configuration
// ============================================

/**
 * Debug mode flag - set to false in production
 * Can be overridden via localStorage: localStorage.setItem('V3_DEBUG', 'true')
 */
const V3_DEBUG = (function() {
    try {
        return localStorage.getItem('V3_DEBUG') === 'true' ||
               window.location.hostname === 'localhost' ||
               window.location.pathname.includes('/dev/');
    } catch (e) {
        return false;
    }
})();

// ============================================
// Module-level State
// ============================================

let savekey = null;

// ============================================
// Random String Generation
// ============================================

/**
 * Generate a random string
 * @param {number} len - Length of the string (default: 16)
 * @returns {string}
 */
function random_string(len = 16) {
    const possible = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_';
    const values = new Uint32Array(len);
    crypto.getRandomValues(values);
    let text = '';
    for (let i = 0; i < len; i++) {
        text += possible.charAt(values[i] % possible.length);
    }
    return text;
}

// ============================================
// Local Storage Management
// ============================================

/**
 * Initialize save key for localStorage
 * @param {string} key - The key to use
 */
function initSaveKey(key) {
    savekey = key;
}

/**
 * Get storage key prefix based on environment
 * @returns {string}
 */
function getStoragePrefix() {
    const htype = window.location.hostname.includes('localhost') ? 'localhost' : 'smartflat';
    const drtype = window.location.pathname.includes('dev') ? 'dev' : 'real';
    return `${htype}_${drtype}_${savekey}_`;
}

/**
 * Save data to localStorage
 * @param {string} key - Storage key
 * @param {string} value - Value to store
 */
function saveData(key, value) {
    if (savekey === null) return;
    const skey = getStoragePrefix() + key;
    localStorage.setItem(skey, value);
}

/**
 * Get data from localStorage
 * @param {string} key - Storage key
 * @returns {string|null}
 */
function getData(key) {
    if (savekey === null) return null;
    const skey = getStoragePrefix() + key;
    return localStorage.getItem(skey);
}

/**
 * Remove data from localStorage
 * @param {string} key - Storage key
 */
function removeData(key) {
    if (savekey === null) return;
    const skey = getStoragePrefix() + key;
    localStorage.removeItem(skey);
}

// ============================================
// Console Logging
// ============================================

/**
 * Console log wrapper (for debugging)
 * Only logs in debug mode (localhost, dev, or V3_DEBUG=true)
 * @param {...any} args
 */
function clog(...args) {
    if (V3_DEBUG && typeof console !== 'undefined') {
        console.log('[SmartFlat]', ...args);
    }
}

/**
 * Console error wrapper
 * Always logs errors (important for debugging production issues)
 * @param {...any} args
 */
function cerror(...args) {
    if (typeof console !== 'undefined') {
        console.error('[SmartFlat Error]', ...args);
    }
}

// ============================================
// Date & Time Utilities
// ============================================

/**
 * Get today's date in YYYY-MM-DD format
 * @returns {string}
 */
function getToday() {
    const date = new Date();
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
}

/**
 * Get current time in HH:MM format
 * @returns {string}
 */
function getNowHHMM() {
    const date = new Date();
    const hours = String(date.getHours()).padStart(2, '0');
    const minutes = String(date.getMinutes()).padStart(2, '0');
    return `${hours}:${minutes}`;
}

/**
 * Get current time in HH:MM:SS format
 * @returns {string}
 */
function getNowHHMMSS() {
    const date = new Date();
    const hours = String(date.getHours()).padStart(2, '0');
    const minutes = String(date.getMinutes()).padStart(2, '0');
    const seconds = String(date.getSeconds()).padStart(2, '0');
    return `${hours}:${minutes}:${seconds}`;
}

/**
 * Get current datetime in YYYY-MM-DD HH:MM:SS format
 * @returns {string}
 */
function getNowDateTime() {
    return `${getToday()} ${getNowHHMMSS()}`;
}

/**
 * Compare two dates
 * @param {string} date1 - First date
 * @param {string} date2 - Second date
 * @returns {number} -1, 0, or 1
 */
function compare_date(date1, date2) {
    const d1 = new Date(date1);
    const d2 = new Date(date2);
    if (d1 < d2) return -1;
    if (d1 > d2) return 1;
    return 0;
}

/**
 * Format date to localized string
 * @param {string|Date} date
 * @param {string} format - 'full', 'date', 'time'
 * @returns {string}
 */
function formatDate(date, format = 'full') {
    const d = new Date(date);
    const options = {
        full: { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit' },
        date: { year: 'numeric', month: '2-digit', day: '2-digit' },
        time: { hour: '2-digit', minute: '2-digit' }
    };
    return d.toLocaleString('ko-KR', options[format] || options.full);
}

// ============================================
// Number Formatting
// ============================================

/**
 * Add commas to number string
 * @param {number|string} num
 * @returns {string}
 */
function CommaString(num) {
    if (num === null || num === undefined) return '0';
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

/**
 * Parse comma-separated number string to integer
 * @param {string} str
 * @returns {number}
 */
function parseCommaInt(str) {
    if (!str) return 0;
    return parseInt(str.toString().replace(/,/g, ''), 10) || 0;
}

/**
 * Parse comma-separated number string to float
 * @param {string} str
 * @returns {number}
 */
function parseCommaFloat(str) {
    if (!str) return 0;
    return parseFloat(str.toString().replace(/,/g, '')) || 0;
}

// ============================================
// String Utilities
// ============================================

/**
 * Truncate string with ellipsis
 * @param {string} str
 * @param {number} maxLength
 * @returns {string}
 */
function truncateString(str, maxLength) {
    if (!str) return '';
    if (str.length <= maxLength) return str;
    return str.substring(0, maxLength) + '...';
}

/**
 * Escape HTML special characters
 * @param {string} str
 * @returns {string}
 */
function escapeHtml(str) {
    if (!str) return '';
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
}

/**
 * Check if string is empty or whitespace
 * @param {string} str
 * @returns {boolean}
 */
function isEmpty(str) {
    return !str || str.trim().length === 0;
}

// ============================================
// Validation Utilities
// ============================================

/**
 * Validate email format
 * @param {string} email
 * @returns {boolean}
 */
function isValidEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

/**
 * Validate phone number format (Korean)
 * @param {string} phone
 * @returns {boolean}
 */
function isValidPhone(phone) {
    const re = /^01[016789]-?\d{3,4}-?\d{4}$/;
    return re.test(phone.replace(/-/g, ''));
}

/**
 * Validate URL format
 * @param {string} url
 * @returns {boolean}
 */
function isValidUrl(url) {
    try {
        new URL(url);
        return true;
    } catch {
        return false;
    }
}

// ============================================
// DOM Utilities
// ============================================

/**
 * Get element by ID (named byId to avoid conflict with jQuery's $)
 * @param {string} id
 * @returns {HTMLElement|null}
 */
function byId(id) {
    return document.getElementById(id);
}

/**
 * Query selector shorthand
 * @param {string} selector
 * @param {HTMLElement} parent
 * @returns {HTMLElement|null}
 */
function $$(selector, parent = document) {
    return parent.querySelector(selector);
}

/**
 * Query selector all shorthand
 * @param {string} selector
 * @param {HTMLElement} parent
 * @returns {NodeList}
 */
function $$$(selector, parent = document) {
    return parent.querySelectorAll(selector);
}

/**
 * Create element with attributes
 * @param {string} tag
 * @param {Object} attrs
 * @param {string} innerHTML
 * @returns {HTMLElement}
 */
function createElement(tag, attrs = {}, innerHTML = '') {
    const el = document.createElement(tag);
    Object.keys(attrs).forEach(key => {
        if (key === 'className') {
            el.className = attrs[key];
        } else if (key === 'style' && typeof attrs[key] === 'object') {
            Object.assign(el.style, attrs[key]);
        } else {
            el.setAttribute(key, attrs[key]);
        }
    });
    if (innerHTML) {
        el.innerHTML = innerHTML;
    }
    return el;
}

/**
 * Add event listener shorthand
 * @param {HTMLElement|string} el
 * @param {string} event
 * @param {Function} handler
 */
function on(el, event, handler) {
    const element = typeof el === 'string' ? byId(el) : el;
    if (element) {
        element.addEventListener(event, handler);
    }
}

/**
 * Remove event listener shorthand
 * @param {HTMLElement|string} el
 * @param {string} event
 * @param {Function} handler
 */
function off(el, event, handler) {
    const element = typeof el === 'string' ? byId(el) : el;
    if (element) {
        element.removeEventListener(event, handler);
    }
}

// ============================================
// File Utilities
// ============================================

/**
 * Get file extension
 * @param {string} filename
 * @returns {string}
 */
function getFileExtension(filename) {
    return filename.slice((filename.lastIndexOf('.') - 1 >>> 0) + 2).toLowerCase();
}

/**
 * Get filename from path
 * @param {string} path
 * @returns {string}
 */
function getFilename(path) {
    return path.split('/').pop();
}

/**
 * Format file size
 * @param {number} bytes
 * @returns {string}
 */
function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

/**
 * Check if file type is allowed
 * @param {string} filename
 * @param {string[]} allowedTypes
 * @returns {boolean}
 */
function isAllowedFileType(filename, allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'pdf']) {
    const ext = getFileExtension(filename);
    return allowedTypes.includes(ext);
}

// ============================================
// Debounce & Throttle
// ============================================

/**
 * Debounce function
 * @param {Function} func
 * @param {number} wait
 * @returns {Function}
 */
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

/**
 * Throttle function
 * @param {Function} func
 * @param {number} limit
 * @returns {Function}
 */
function throttle(func, limit) {
    let inThrottle;
    return function(...args) {
        if (!inThrottle) {
            func.apply(this, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

// ============================================
// Export for module usage
// ============================================

if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        random_string,
        initSaveKey,
        saveData,
        getData,
        removeData,
        clog,
        cerror,
        getToday,
        getNowHHMM,
        getNowHHMMSS,
        getNowDateTime,
        compare_date,
        formatDate,
        CommaString,
        parseCommaInt,
        parseCommaFloat,
        truncateString,
        escapeHtml,
        isEmpty,
        isValidEmail,
        isValidPhone,
        isValidUrl,
        byId,
        createElement,
        getFileExtension,
        getFilename,
        formatFileSize,
        isAllowedFileType,
        debounce,
        throttle
    };
}
