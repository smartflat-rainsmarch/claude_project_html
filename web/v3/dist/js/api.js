/**
 * SmartFlat CMS v3 - API Module
 * AJAX communication wrapper and API utilities
 */

'use strict';

// ============================================
// API Configuration
// ============================================

const V3Api = {
    // API Endpoints (legacy v1 compatible)
    endpoints: {
        adm_get: '../../../ssapi/adm_get.php',
        login: '../../../ssapi/login_web.php',
        logout: '../../../ssapi/logout_web.php',
        getdata: '../../../ssapi/getdata.php',
        push_message: '../../../ssapi/push_message.php',
        upload: '../../../ssapi/adm_get.php'
    },

    // v3 REST API base URL
    baseUrl: './api/v3',

    // Default timeout (ms)
    timeout: 30000,

    // Request counter for debugging
    requestCounter: 0,

    /**
     * Get CSRF token from meta tag or global variable
     * @returns {string}
     */
    getCsrfToken() {
        // Try meta tag first
        const metaTag = document.querySelector('meta[name="csrf-token"]');
        if (metaTag) {
            return metaTag.getAttribute('content');
        }
        // Fallback to global variable (set by PHP)
        if (typeof csrfToken !== 'undefined') {
            return csrfToken;
        }
        return '';
    },

    /**
     * GET request to v3 REST API
     * @param {string} path - API path (e.g., '/dashboard', '/projects')
     * @param {Object} params - Query parameters
     * @returns {Promise<Object>}
     */
    async get(path, params = {}) {
        const url = new URL(this.baseUrl + path, window.location.origin + window.location.pathname);
        Object.keys(params).forEach(key => {
            if (params[key] !== undefined && params[key] !== null) {
                url.searchParams.append(key, params[key]);
            }
        });

        const requestId = ++this.requestCounter;
        clog(`[V3Api ${requestId}] GET:`, url.toString());

        try {
            const response = await fetch(url.toString(), {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin'
            });

            const data = await response.json();
            clog(`[V3Api ${requestId}] Response:`, data);
            return data;
        } catch (error) {
            cerror(`[V3Api ${requestId}] Error:`, error);
            throw error;
        }
    },

    /**
     * POST request to v3 REST API
     * @param {string} path - API path
     * @param {Object} body - Request body
     * @returns {Promise<Object>}
     */
    async post(path, body = {}) {
        const requestId = ++this.requestCounter;
        clog(`[V3Api ${requestId}] POST:`, this.baseUrl + path, body);

        try {
            const response = await fetch(this.baseUrl + path, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-Token': this.getCsrfToken()
                },
                credentials: 'same-origin',
                body: JSON.stringify(body)
            });

            const data = await response.json();
            clog(`[V3Api ${requestId}] Response:`, data);
            return data;
        } catch (error) {
            cerror(`[V3Api ${requestId}] Error:`, error);
            throw error;
        }
    },

    /**
     * PUT request to v3 REST API
     * @param {string} path - API path
     * @param {Object} body - Request body
     * @returns {Promise<Object>}
     */
    async put(path, body = {}) {
        const requestId = ++this.requestCounter;
        clog(`[V3Api ${requestId}] PUT:`, this.baseUrl + path, body);

        try {
            const response = await fetch(this.baseUrl + path, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-Token': this.getCsrfToken()
                },
                credentials: 'same-origin',
                body: JSON.stringify(body)
            });

            const data = await response.json();
            clog(`[V3Api ${requestId}] Response:`, data);
            return data;
        } catch (error) {
            cerror(`[V3Api ${requestId}] Error:`, error);
            throw error;
        }
    },

    /**
     * DELETE request to v3 REST API
     * @param {string} path - API path
     * @returns {Promise<Object>}
     */
    async delete(path) {
        const requestId = ++this.requestCounter;
        clog(`[V3Api ${requestId}] DELETE:`, this.baseUrl + path);

        try {
            const response = await fetch(this.baseUrl + path, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-Token': this.getCsrfToken()
                },
                credentials: 'same-origin'
            });

            const data = await response.json();
            clog(`[V3Api ${requestId}] Response:`, data);
            return data;
        } catch (error) {
            cerror(`[V3Api ${requestId}] Error:`, error);
            throw error;
        }
    }
};

// ============================================
// Core AJAX Handler
// ============================================

/**
 * Main API call handler - compatible with v1 CallHandler
 * @param {string} type - API type (adm_get, login, etc.)
 * @param {Object} data - Request data
 * @param {Function} success - Success callback
 * @param {Function} error - Error callback
 * @param {boolean} showLoading - Show loading indicator
 */
function CallHandler(type, data, success, error, showLoading = false) {
    // Validate API type
    if (!type || typeof type !== 'string') {
        cerror('CallHandler: Invalid API type');
        if (error) error({ status: 'error', message: 'Invalid API type' });
        return;
    }

    // Use known endpoint or default to adm_get
    const url = Object.prototype.hasOwnProperty.call(V3Api.endpoints, type)
        ? V3Api.endpoints[type]
        : V3Api.endpoints.adm_get;

    const requestId = ++V3Api.requestCounter;

    clog(`[API ${requestId}] Request:`, type, data);

    if (showLoading) {
        C_ShowLoadingProgress();
    }

    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        dataType: 'json',
        timeout: V3Api.timeout,
        success: function(response) {
            clog(`[API ${requestId}] Response:`, response);
            if (showLoading) {
                C_HideLoadingProgress();
            }
            if (success && typeof success === 'function') {
                success(response);
            }
        },
        error: function(xhr, status, errorMsg) {
            cerror(`[API ${requestId}] Error:`, status, errorMsg);
            if (showLoading) {
                C_HideLoadingProgress();
            }
            if (error && typeof error === 'function') {
                error({ xhr, status, message: errorMsg });
            }
        }
    });
}

/**
 * Admin GET API call - wrapper for common admin operations
 * @param {string} type - Operation type from ADM_TYPE
 * @param {Object} data - Request data
 * @param {Function} success - Success callback
 * @param {Function} error - Error callback
 */
function AJAX_AdmGet(type, data, success, error) {
    const senddata = {
        type: type,
        value: data
    };

    CallHandler('adm_get', senddata, function(res) {
        if (success) success(res);
    }, function(err) {
        if (error) error(err);
        cerror('AJAX_AdmGet error:', err);
    }, true);
}

// ============================================
// Modern Fetch API Wrapper
// ============================================

/**
 * Modern fetch-based API call
 * @param {string} endpoint - API endpoint
 * @param {Object} options - Fetch options
 * @returns {Promise}
 */
async function fetchApi(endpoint, options = {}) {
    const { data: bodyData, headers: customHeaders, ...restOptions } = options;

    const defaultOptions = {
        method: 'POST',
        ...restOptions,
        headers: {
            'Content-Type': 'application/json',
            ...customHeaders
        }
    };

    if (bodyData) {
        defaultOptions.body = JSON.stringify(bodyData);
    }

    try {
        const response = await fetch(endpoint, defaultOptions);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return await response.json();
    } catch (error) {
        cerror('Fetch API error:', error);
        throw error;
    }
}

// ============================================
// File Upload
// ============================================

/**
 * Upload file with progress tracking
 * @param {string} type - Upload type
 * @param {Object} data - Form data
 * @param {File[]} files - Array of files to upload
 * @param {Object} options - Options with onProgress callback
 * @returns {Promise}
 */
function uploadFile(type, data, files, options = {}) {
    return new Promise((resolve, reject) => {
        const formData = new FormData();

        // Add form data
        formData.append('type', type);
        formData.append('value', JSON.stringify(data));

        // Add files
        if (files && files.length > 0) {
            files.forEach(file => {
                formData.append('files[]', file);
            });
        }

        const xhr = new XMLHttpRequest();
        xhr.open('POST', V3Api.endpoints.upload, true);

        // Progress tracking
        if (options.onProgress) {
            xhr.upload.onprogress = function(event) {
                if (event.lengthComputable) {
                    const percentComplete = Math.round((event.loaded / event.total) * 100);
                    options.onProgress(percentComplete);
                }
            };
        }

        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    resolve(response);
                } catch (e) {
                    reject(new Error('Invalid JSON response'));
                }
            } else {
                reject(new Error(`Upload failed: ${xhr.status}`));
            }
        };

        xhr.onerror = function() {
            reject(new Error('Upload network error'));
        };

        xhr.send(formData);
    });
}

// ============================================
// API Helper Functions
// ============================================

/**
 * Get project IDs
 * @param {Function} callback
 */
function getProjectIds(callback) {
    AJAX_AdmGet(ADM_TYPE.GET_PROJECTIDS, {
        groupidx: session_groupidx
    }, function(res) {
        if (callback) callback(res);
    });
}

/**
 * Get home/dashboard data
 * @param {string} projectId
 * @param {Function} callback
 */
function getHomeData(projectId, callback) {
    AJAX_AdmGet(ADM_TYPE.GET_HOME_DATA, {
        projectid: projectId,
        groupidx: session_groupidx
    }, function(res) {
        if (callback) callback(res);
    });
}

/**
 * Get main content data
 * @param {string} projectId
 * @param {Function} callback
 */
function getMainData(projectId, callback) {
    AJAX_AdmGet(ADM_TYPE.GET_MAIN_DATA, {
        projectid: projectId
    }, function(res) {
        if (callback) callback(res);
    });
}

/**
 * Update content data
 * @param {Object} data
 * @param {Function} callback
 */
function updateContentData(data, callback) {
    AJAX_AdmGet(ADM_TYPE.UPDATE_CONTENT_DATA, data, function(res) {
        if (callback) callback(res);
    });
}

/**
 * Send push notification
 * @param {Object} pushData
 * @param {Function} callback
 */
function sendPush(pushData, callback) {
    const senddata = {
        type: ADM_TYPE.PUSH,
        value: pushData
    };

    CallHandler('adm_get', senddata, function(res) {
        if (callback) callback(res);
    }, function(err) {
        cerror('Push error:', err);
        if (callback) callback({ code: -1, message: 'Push failed' });
    });
}

// ============================================
// Response Code Handler
// ============================================

/**
 * Handle common API response codes
 * @param {Object} response - API response
 * @param {Object} handlers - Custom handlers for specific codes
 */
function handleResponse(response, handlers = {}) {
    const code = parseInt(response.code, 10);

    // Default handlers
    const defaultHandlers = {
        200: () => {
            // Success - do nothing, let caller handle
        },
        401: () => {
            alertMsg('세션이 만료되었습니다. 다시 로그인해 주세요.', () => {
                window.location.href = PAGE_ADMIN_LOGIN;
            });
        },
        403: () => {
            alertMsg('접근 권한이 없습니다.');
        },
        404: () => {
            alertMsg('요청한 데이터를 찾을 수 없습니다.');
        },
        500: () => {
            alertMsg('서버 오류가 발생했습니다. 잠시 후 다시 시도해 주세요.');
        }
    };

    const handler = handlers[code] || defaultHandlers[code];
    if (handler) {
        handler(response);
    }

    return code;
}

// ============================================
// Retry Logic
// ============================================

/**
 * Retry API call with exponential backoff
 * @param {Function} apiCall - API call function
 * @param {number} maxRetries - Maximum retry attempts
 * @param {number} delay - Initial delay in ms
 * @returns {Promise}
 */
async function retryApiCall(apiCall, maxRetries = 3, delay = 1000) {
    for (let i = 0; i < maxRetries; i++) {
        try {
            return await apiCall();
        } catch (error) {
            if (i === maxRetries - 1) {
                throw error;
            }
            await new Promise(resolve => setTimeout(resolve, delay * Math.pow(2, i)));
        }
    }
}

// ============================================
// Export for module usage
// ============================================

if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        V3Api,
        CallHandler,
        AJAX_AdmGet,
        fetchApi,
        uploadFile,
        getProjectIds,
        getHomeData,
        getMainData,
        updateContentData,
        sendPush,
        handleResponse,
        retryApiCall
    };
}
