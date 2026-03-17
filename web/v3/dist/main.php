<?php
/**
 * SmartFlat CMS v3 - Main Layout
 * Main application layout with header, sidebar, and content area
 */

include('./common.php');
$version = time();
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="SmartFlat CMS - Content Management System">
    <meta name="author" content="SmartFlat Inc.">

    <title>SmartFlat CMS v3</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="./img/favicon.ico">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- SmartFlat CMS v3 Styles -->
    <link href="./css/variables.css?v=<?php echo $version; ?>" rel="stylesheet">
    <link href="./css/layout.css?v=<?php echo $version; ?>" rel="stylesheet">
    <link href="./css/components.css?v=<?php echo $version; ?>" rel="stylesheet">
    <link href="./css/responsive.css?v=<?php echo $version; ?>" rel="stylesheet">

    <!-- Libraries (from v1) -->
    <link href="./libs/tables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>
        /* Page-specific overrides can go here */
    </style>
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <?php include('./sidebar.php'); ?>

        <!-- Main Content Wrapper -->
        <div class="app-main">
            <!-- Header -->
            <?php include('./header.php'); ?>

            <!-- Main Content Area -->
            <main class="app-content">
                <div class="content-wrapper">
                    <div id="main-content">
                        <!-- Page content will be loaded here -->
                        <div class="card">
                            <div class="card-body">
                                <div class="loading-content" style="text-align: center; padding: 48px;">
                                    <div class="spinner spinner-lg"></div>
                                    <div class="loading-text" style="margin-top: 16px;">로딩 중...</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="app-footer">
                <div class="footer-content">
                    <div>
                        Copyright &copy; <?php echo date('Y'); ?> <strong>SmartFlat Inc.</strong> All rights reserved.
                        <br>
                        <small style="color: var(--text-muted);">
                            사업자번호: 177-86-00018 | 통신판매업신고번호: 제2015-서울서초-1646호
                        </small>
                    </div>
                    <div class="footer-links">
                        <a href="#" onclick="showTerms('termsofservice')">이용약관</a>
                        <a href="#" onclick="showTerms('privacy_policy')">개인정보처리방침</a>
                        <span style="color: var(--text-muted);">v<?php echo CMS_VERSION; ?></span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="div_loading_progress" class="loading-overlay" style="display: none;">
        <div class="loading-content">
            <div class="spinner spinner-lg"></div>
            <div class="loading-text">로딩 중...</div>
        </div>
    </div>

    <!-- Scripts -->
    <!-- jQuery (from libs) -->
    <script src="./libs/jquery/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables -->
    <script src="./libs/tables/jquery.dataTables.min.js"></script>
    <script src="./libs/tables/dataTables.bootstrap4.min.js"></script>

    <!-- Chart.js -->
    <script src="./libs/chart/chart.min.js"></script>

    <!-- SmartFlat CMS v3 Scripts -->
    <script src="./js/core.js?v=<?php echo $version; ?>"></script>
    <script src="./js/api.js?v=<?php echo $version; ?>"></script>
    <script src="./js/ui.js?v=<?php echo $version; ?>"></script>
    <script src="./js/components/data-table.js?v=<?php echo $version; ?>"></script>
    <script src="./js/app.js?v=<?php echo $version; ?>"></script>

    <script>
        /**
         * Show terms modal
         * @param {string} type
         */
        function showTerms(type) {
            const title = type === 'termsofservice' ? '이용약관' : '개인정보처리방침';
            const content = '<div style="padding: 20px; text-align: center;"><p>준비 중입니다.</p></div>';

            showModalDialog(document.body, title, content, '닫기', null, function() {
                hideModalDialog();
            }, null, { allowHtml: true });
        }

        // Debug info in console (only in debug mode)
        if (typeof V3_DEBUG !== 'undefined' && V3_DEBUG) {
            console.log('%c SmartFlat CMS v3 ', 'background: #009ef7; color: white; padding: 4px 8px; border-radius: 4px;');
            console.log('Version:', CMS_VERSION);
            console.log('User:', usernamedesc);
            console.log('Auth Level:', auth);
        }
    </script>
</body>
</html>
