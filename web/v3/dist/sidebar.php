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

            <!-- Dashboard -->
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

            <!-- Project Management -->
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

            <!-- Screen Editor (화면 수정) -->
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

            <!-- Content Management -->
            <div class="menu-item">
                <a class="menu-link has-submenu" href="#">
                    <span class="menu-icon"><i class="fas fa-edit"></i></span>
                    <span class="menu-text">콘텐츠 관리</span>
                    <span class="menu-arrow"><i class="fas fa-chevron-right"></i></span>
                </a>
                <div class="menu-submenu">
                    <a class="submenu-link" href="#" data-page="content">
                        <span class="submenu-bullet"></span>
                        <span>콘텐츠 목록</span>
                    </a>
                    <a class="submenu-link" href="#" data-page="content/templates">
                        <span class="submenu-bullet"></span>
                        <span>템플릿</span>
                    </a>
                    <a class="submenu-link" href="#" data-page="content/media">
                        <span class="submenu-bullet"></span>
                        <span>미디어</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Device Section -->
        <div class="menu-section">
            <div class="menu-section-title">기기</div>

            <!-- Device Management -->
            <div class="menu-item">
                <a class="menu-link has-submenu" href="#">
                    <span class="menu-icon"><i class="fas fa-tv"></i></span>
                    <span class="menu-text">기기 관리</span>
                    <span class="menu-arrow"><i class="fas fa-chevron-right"></i></span>
                </a>
                <div class="menu-submenu">
                    <a class="submenu-link" href="#" data-page="device">
                        <span class="submenu-bullet"></span>
                        <span>기기 목록</span>
                    </a>
                    <a class="submenu-link" href="#" data-page="device/groups">
                        <span class="submenu-bullet"></span>
                        <span>기기 그룹</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Deployment Section -->
        <div class="menu-section">
            <div class="menu-section-title">배포</div>

            <!-- Deployment -->
            <div class="menu-item">
                <a class="menu-link has-submenu" href="#">
                    <span class="menu-icon"><i class="fas fa-paper-plane"></i></span>
                    <span class="menu-text">배포 관리</span>
                    <span class="menu-arrow"><i class="fas fa-chevron-right"></i></span>
                </a>
                <div class="menu-submenu">
                    <a class="submenu-link" href="#" data-page="deployment">
                        <span class="submenu-bullet"></span>
                        <span>배포하기</span>
                    </a>
                    <a class="submenu-link" href="#" data-page="deployment/schedule">
                        <span class="submenu-bullet"></span>
                        <span>예약 배포</span>
                    </a>
                    <a class="submenu-link" href="#" data-page="deployment/history">
                        <span class="submenu-bullet"></span>
                        <span>배포 이력</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Monitoring Section -->
        <div class="menu-section">
            <div class="menu-section-title">모니터링</div>

            <!-- Monitoring -->
            <div class="menu-item">
                <a class="menu-link has-submenu" href="#">
                    <span class="menu-icon"><i class="fas fa-desktop"></i></span>
                    <span class="menu-text">모니터링</span>
                    <span class="menu-arrow"><i class="fas fa-chevron-right"></i></span>
                </a>
                <div class="menu-submenu">
                    <a class="submenu-link" href="#" data-page="monitoring">
                        <span class="submenu-bullet"></span>
                        <span>상태 대시보드</span>
                    </a>
                    <a class="submenu-link" href="#" data-page="monitoring/logs">
                        <span class="submenu-bullet"></span>
                        <span>로그</span>
                    </a>
                    <a class="submenu-link" href="#" data-page="monitoring/alerts">
                        <span class="submenu-bullet"></span>
                        <span>알림 설정</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- System Section -->
        <div class="menu-section">
            <div class="menu-section-title">시스템</div>

            <!-- Version Control -->
            <div class="menu-item">
                <a class="menu-link" href="#" data-page="version">
                    <span class="menu-icon"><i class="fas fa-code-branch"></i></span>
                    <span class="menu-text">버전 관리</span>
                </a>
            </div>

            <!-- Audit Log -->
            <div class="menu-item">
                <a class="menu-link" href="#" data-page="audit">
                    <span class="menu-icon"><i class="fas fa-history"></i></span>
                    <span class="menu-text">감사 로그</span>
                </a>
            </div>

            <!-- Settings -->
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
