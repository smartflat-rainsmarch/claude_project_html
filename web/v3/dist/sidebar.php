<!-- SmartFlat CMS v3 - Sidebar Component -->
<aside class="app-sidebar">
    <!-- Logo -->
    <div class="sidebar-logo">
        <img src="./img/logo.png" alt="SmartFlat" onerror="this.style.display='none'">
        <span class="logo-text">SmartFlat CMS</span>
    </div>

    <!-- Menu -->
    <nav class="sidebar-menu">
        <!-- Dashboard Section -->
        <div class="menu-section">
            <div class="menu-section-title">메인</div>
            <div class="menu-item">
                <a class="menu-link active" href="#" data-page="dashboard">
                    <span class="menu-icon"><i class="fas fa-chart-pie"></i></span>
                    <span class="menu-text">대시보드</span>
                </a>
            </div>
        </div>

        <!-- Project Section -->
        <div class="menu-section">
            <div class="menu-section-title">프로젝트</div>
            <div class="menu-item">
                <a class="menu-link" href="#" data-page="project">
                    <span class="menu-icon"><i class="fas fa-folder-open"></i></span>
                    <span class="menu-text">프로젝트 관리</span>
                </a>
            </div>
        </div>

        <!-- Content Section -->
        <div class="menu-section">
            <div class="menu-section-title">콘텐츠</div>
            <div class="menu-item">
                <a class="menu-link has-submenu" href="#">
                    <span class="menu-icon"><i class="fas fa-desktop"></i></span>
                    <span class="menu-text">화면 수정</span>
                    <span class="menu-arrow"><i class="fas fa-chevron-right"></i></span>
                </a>
                <div class="menu-submenu">
                    <a class="submenu-link" href="#" data-page="channel">
                        <span class="submenu-bullet"></span>
                        <span>테이블 편집</span>
                    </a>
                    <a class="submenu-link" href="#" data-page="channel/editor">
                        <span class="submenu-bullet"></span>
                        <span>비주얼 에디터</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- System Section -->
        <div class="menu-section">
            <div class="menu-section-title">시스템</div>
            <div class="menu-item">
                <a class="menu-link" href="#" data-page="settings">
                    <span class="menu-icon"><i class="fas fa-cog"></i></span>
                    <span class="menu-text">설정</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Footer Info -->
    <div style="padding: 16px; border-top: 1px solid rgba(255,255,255,0.05); margin-top: auto;">
        <div style="display: flex; align-items: center; gap: 8px;">
            <span style="width: 8px; height: 8px; background-color: var(--color-success); border-radius: 50%;"></span>
            <span style="color: var(--text-sidebar); font-size: 12px;">시스템 정상</span>
        </div>
        <div style="color: var(--text-muted); font-size: 11px; margin-top: 8px;">
            v<?php echo CMS_VERSION; ?>
        </div>
    </div>
</aside>

<!-- Sidebar Overlay for Mobile -->
<div class="sidebar-overlay" onclick="closeSidebar()"></div>
