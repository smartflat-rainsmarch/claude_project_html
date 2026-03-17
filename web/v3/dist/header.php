<!-- SmartFlat CMS v3 - Header Component -->
<header class="app-header">
    <!-- Left Section -->
    <div class="header-left">
        <!-- Sidebar Toggle -->
        <button class="sidebar-toggle" onclick="V3App.toggleSidebar()" title="사이드바 토글">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Breadcrumb -->
        <nav class="header-breadcrumb">
            <a href="#" class="breadcrumb-item" onclick="loadPage('dashboard')">홈</a>
            <span class="breadcrumb-separator">/</span>
            <span class="breadcrumb-item active">대시보드</span>
        </nav>
    </div>

    <!-- Right Section -->
    <div class="header-right">
        <!-- Search -->
        <div class="header-toolbar-item d-none d-md-block">
            <button class="toolbar-btn" onclick="openQuickSearch()" title="검색 (Ctrl+K)">
                <i class="fas fa-search"></i>
            </button>
        </div>

        <!-- Notifications -->
        <div class="header-toolbar-item">
            <button class="toolbar-btn" onclick="toggleDropdown(this)" title="알림">
                <i class="fas fa-bell"></i>
                <span class="toolbar-badge" id="notification-count" style="display: none;">0</span>
            </button>
            <div class="dropdown-menu" style="width: 320px;">
                <div style="padding: 12px 16px; border-bottom: 1px solid var(--border-color);">
                    <strong>알림</strong>
                </div>
                <div id="notification-list" style="max-height: 300px; overflow-y: auto;">
                    <div class="empty-state" style="padding: 24px;">
                        <i class="fas fa-bell-slash" style="font-size: 24px; color: var(--text-muted);"></i>
                        <p style="margin-top: 8px; color: var(--text-muted); font-size: 13px;">새로운 알림이 없습니다</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Menu -->
        <div class="header-toolbar-item dropdown">
            <div class="user-menu" onclick="toggleDropdown(this)">
                <div class="user-avatar">
                    <?php echo safe_mb_substr($usernamedesc ?? 'U', 0, 1); ?>
                </div>
                <div class="user-info d-none d-lg-block">
                    <span class="user-name"><?php echo htmlspecialchars($usernamedesc ?? ''); ?></span>
                    <span class="user-role">
                        <?php
                        $roleNames = [
                            AUTH_SYSTEMOWNER => '시스템 관리자',
                            AUTH_OWNER => '운영자',
                            AUTH_OPERATOR => '점장',
                            AUTH_MANAGER => '관리자',
                            AUTH_TRANER => '트레이너',
                            AUTH_CUSTOMER => '고객'
                        ];
                        echo $roleNames[$auth] ?? '사용자';
                        ?>
                    </span>
                </div>
                <i class="fas fa-chevron-down d-none d-lg-block" style="margin-left: 8px; font-size: 10px; color: var(--text-muted);"></i>
            </div>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#" onclick="loadPage('settings')">
                    <i class="fas fa-cog"></i>
                    <span>설정</span>
                </a>
                <a class="dropdown-item" href="#" onclick="showProfile()">
                    <i class="fas fa-user"></i>
                    <span>프로필</span>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" onclick="logout()">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>로그아웃</span>
                </a>
            </div>
        </div>
    </div>
</header>

<script>
/**
 * Show user profile modal
 */
function showProfile() {
    const profileHtml = `
        <div class="text-center" style="padding: 20px;">
            <div class="user-avatar" style="width: 80px; height: 80px; font-size: 32px; margin: 0 auto 16px;">
                ${escapeHtml('<?php echo safe_mb_substr($usernamedesc ?? "U", 0, 1); ?>')}
            </div>
            <h4 style="margin-bottom: 4px;"><?php echo htmlspecialchars($usernamedesc ?? ''); ?></h4>
            <p style="color: var(--text-muted); margin-bottom: 16px;"><?php echo htmlspecialchars($email ?? ''); ?></p>
            <div class="badge badge-primary"><?php echo $roleNames[$auth] ?? '사용자'; ?></div>
        </div>
        <div style="border-top: 1px solid var(--border-color); padding: 16px;">
            <div class="form-group">
                <label class="form-label">그룹</label>
                <p style="margin: 0; color: var(--text-gray);"><?php echo htmlspecialchars($mygroupname ?? '-'); ?></p>
            </div>
            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label">프로젝트 ID</label>
                <p style="margin: 0; color: var(--text-gray);"><?php echo htmlspecialchars($projectids ?? '-'); ?></p>
            </div>
        </div>
    `;

    showModalDialog(document.body, '프로필', profileHtml, '닫기', null, function() {
        hideModalDialog();
    }, null, { allowHtml: true });
}

/**
 * Logout user
 */
function logout() {
    confirmMsg('로그아웃 하시겠습니까?', function() {
        window.location.href = 'logout.php';
    });
}

/**
 * Update notification badge
 * @param {number} count
 */
function updateNotificationBadge(count) {
    const badge = document.getElementById('notification-count');
    if (badge) {
        if (count > 0) {
            badge.textContent = count > 99 ? '99+' : count;
            badge.style.display = 'flex';
        } else {
            badge.style.display = 'none';
        }
    }
}
</script>
