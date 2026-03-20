/**
 * SmartFlat CMS v3 - AI Prompt Bar
 * Claude Code 스타일 AI 입력창
 */

'use strict';

var aiPrompt = {
    history: [],
    historyIdx: -1,
    isProcessing: false,
    conversationMessages: [],

    // =========================================
    // Input Handling
    // =========================================

    onKeyDown: function(e) {
        // Enter = 전송, Shift+Enter = 줄바꿈
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            this.send();
        }
        // ↑ = 이전 프롬프트 (빈 입력창에서)
        if (e.key === 'ArrowUp' && !e.target.value.trim()) {
            e.preventDefault();
            if (this.history.length > 0) {
                this.historyIdx = Math.max(0, this.historyIdx - 1);
                if (this.historyIdx < 0) this.historyIdx = this.history.length - 1;
                e.target.value = this.history[this.historyIdx];
                this.autoResize(e.target);
            }
        }
        // Escape = 응답 영역 닫기
        if (e.key === 'Escape') {
            this.hideResponse();
        }
    },

    autoResize: function(el) {
        el.style.height = 'auto';
        el.style.height = Math.min(el.scrollHeight, 120) + 'px';
    },

    setPrompt: function(text) {
        var input = document.getElementById('ai-input');
        if (input) {
            input.value = text;
            input.focus();
            this.autoResize(input);
        }
    },

    // =========================================
    // Send
    // =========================================

    send: async function() {
        var input = document.getElementById('ai-input');
        var prompt = input ? input.value.trim() : '';
        if (!prompt || this.isProcessing) return;

        this.isProcessing = true;
        this.history.push(prompt);
        this.historyIdx = this.history.length;
        input.value = '';
        this.autoResize(input);

        // UI 업데이트
        this.showResponse();
        this.addUserMessage(prompt);
        this.addTypingIndicator();
        this.setSendBtnState(true);

        // 퀵 칩 숨기기
        var chips = document.getElementById('ai-quick-chips');
        if (chips) chips.style.display = 'none';

        // 컨텍스트 수집
        var context = {
            current_hm_idx: typeof getGlobalProjectHmIdx === 'function' ? getGlobalProjectHmIdx() : '',
            current_page: (typeof V3App !== 'undefined') ? V3App.currentPage : '',
            user_language: 'KO'
        };

        // 대화 메시지에 추가
        this.conversationMessages.push({ role: 'user', content: prompt });

        try {
            var res = await V3Api.post('/ai', {
                prompt: prompt,
                context: context,
                messages: this.conversationMessages
            });

            this.removeTypingIndicator();

            if (res.code === 100 && res.data) {
                this.handleResponse(res.data);
                // AI 응답을 대화 히스토리에 추가
                this.conversationMessages.push({ role: 'assistant', content: res.data.message || '' });
            } else {
                this.addAIMessage('오류: ' + (res.message || '처리에 실패했습니다.'), 'error');
            }
        } catch (err) {
            this.removeTypingIndicator();
            this.addAIMessage('요청 처리 중 에러가 발생했습니다. 네트워크를 확인해주세요.', 'error');
            cerror('AI request failed:', err);
        }

        this.isProcessing = false;
        this.setSendBtnState(false);
    },

    // =========================================
    // Response Handling
    // =========================================

    handleResponse: function(data) {
        // 액션 단계 표시
        if (data.actions && data.actions.length > 0) {
            var stepsHtml = data.actions.map(function(action) {
                return '<div class="ai-step done"><i class="fas fa-check-circle"></i> ' + escapeHtml(action.description || action.type) + '</div>';
            }).join('');
            this.addAIMessage(stepsHtml, 'html');
        }

        // 메인 메시지
        if (data.message) {
            this.addAIMessage(data.message);
        }

        // 프로젝트 생성/수정 시 갱신
        if (data.project_hm_idx) {
            // 프로젝트 목록 갱신
            if (typeof loadGlobalProjects === 'function') {
                var globalSel = document.getElementById('global-project-select');
                if (globalSel) {
                    // 옵션 초기화 후 재로드
                    globalSel.innerHTML = '<option value="">프로젝트를 선택하세요</option>';
                    loadGlobalProjects().then(function() {
                        globalSel.value = String(data.project_hm_idx);
                        if (typeof onGlobalProjectChange === 'function') {
                            onGlobalProjectChange(String(data.project_hm_idx));
                        }
                    });
                }
            }
        }

        // 현재 프로젝트 데이터 변경 시 미리보기 갱신
        if (data.data_updated && typeof channelEditor !== 'undefined' && channelEditor.hmIdx) {
            channelEditor.onProjectChange(channelEditor.hmIdx);
        }
    },

    // =========================================
    // UI Helpers
    // =========================================

    showResponse: function() {
        var area = document.getElementById('ai-response-area');
        if (area) area.style.display = 'block';
    },

    hideResponse: function() {
        var area = document.getElementById('ai-response-area');
        if (area) area.style.display = 'none';
    },

    toggleResponse: function() {
        var area = document.getElementById('ai-response-area');
        if (area) area.style.display = area.style.display === 'none' ? 'block' : 'none';
    },

    addUserMessage: function(text) {
        var content = document.getElementById('ai-response-content');
        if (!content) return;
        var div = document.createElement('div');
        div.className = 'ai-msg ai-msg-user';
        div.innerHTML = '<div class="ai-bubble">' + escapeHtml(text) + '</div>';
        content.appendChild(div);
        this.scrollToBottom();
    },

    addAIMessage: function(text, type) {
        var content = document.getElementById('ai-response-content');
        if (!content) return;
        var div = document.createElement('div');
        div.className = 'ai-msg ai-msg-ai';
        if (type === 'html') {
            // steps HTML은 내부에서 escapeHtml 처리된 것만 허용
            var bubble = document.createElement('div');
            bubble.className = 'ai-bubble';
            bubble.innerHTML = text; // ai-step은 내부에서 escapeHtml 적용됨
            div.appendChild(bubble);
        } else if (type === 'error') {
            div.innerHTML = '<div class="ai-bubble" style="border-color:var(--color-danger);color:var(--color-danger);"><i class="fas fa-exclamation-triangle"></i> ' + escapeHtml(text) + '</div>';
        } else {
            div.innerHTML = '<div class="ai-bubble">' + escapeHtml(text).replace(/\n/g, '<br>') + '</div>';
        }
        content.appendChild(div);
        this.scrollToBottom();
    },

    addTypingIndicator: function() {
        var content = document.getElementById('ai-response-content');
        if (!content) return;
        var div = document.createElement('div');
        div.className = 'ai-msg ai-msg-ai';
        div.id = 'ai-typing';
        div.innerHTML = '<div class="ai-bubble"><div class="ai-typing"><span></span><span></span><span></span></div></div>';
        content.appendChild(div);
        this.scrollToBottom();
    },

    removeTypingIndicator: function() {
        var el = document.getElementById('ai-typing');
        if (el) el.remove();
    },

    scrollToBottom: function() {
        var area = document.getElementById('ai-response-area');
        if (area) area.scrollTop = area.scrollHeight;
    },

    setSendBtnState: function(processing) {
        var btn = document.getElementById('ai-send-btn');
        if (btn) {
            btn.disabled = processing;
            btn.innerHTML = processing
                ? '<i class="fas fa-circle-notch fa-spin"></i>'
                : '<i class="fas fa-paper-plane"></i>';
        }
    }
};

// Ctrl+/ 단축키: AI 입력창 포커스
document.addEventListener('keydown', function(e) {
    if (e.ctrlKey && e.key === '/') {
        e.preventDefault();
        var input = document.getElementById('ai-input');
        if (input) input.focus();
    }
});
