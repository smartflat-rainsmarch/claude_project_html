<?php
/**
 * SmartFlat CMS v3 - Login Page
 * User authentication
 */

session_cache_expire(1440); // 24 hours
session_start();
date_default_timezone_set('Asia/Seoul');

// Include constants
require_once('./cmn_var.php');

// Check if already logged in
$isLoggedIn = isset($_SESSION['key' . DEV_REAL]) && isset($_SESSION['authgroup' . DEV_REAL]);
if ($isLoggedIn) {
    header('Location: main.php');
    exit;
}

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

$version = time();
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>로그인 - SmartFlat CMS v3</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="./img/favicon.ico">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- SmartFlat CMS v3 Styles -->
    <link href="./css/variables.css?v=<?php echo $version; ?>" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Noto Sans KR', sans-serif;
            background: linear-gradient(135deg, var(--bg-sidebar) 0%, #2d2d3a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
        }

        .login-card {
            background-color: var(--bg-card);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-xl);
            padding: 40px;
        }

        .login-logo {
            text-align: center;
            margin-bottom: 32px;
        }

        .login-logo img {
            height: 48px;
            margin-bottom: 16px;
        }

        .login-logo h1 {
            font-size: 24px;
            font-weight: 600;
            color: var(--text-dark);
            margin: 0;
        }

        .login-logo p {
            font-size: 14px;
            color: var(--text-gray);
            margin-top: 8px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            font-size: 14px;
            color: var(--text-dark);
            background-color: var(--bg-input);
            border: 1px solid transparent;
            border-radius: var(--radius-md);
            transition: all 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            background-color: var(--bg-card);
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(0, 158, 247, 0.15);
        }

        .form-control::placeholder {
            color: var(--text-muted);
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }

        .input-group .form-control {
            padding-left: 44px;
        }

        .btn-login {
            width: 100%;
            padding: 14px 24px;
            font-size: 15px;
            font-weight: 500;
            color: var(--text-white);
            background-color: var(--color-primary);
            border: none;
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-login:hover {
            background-color: var(--color-primary-hover);
        }

        .btn-login:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .login-footer {
            text-align: center;
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid var(--border-color);
        }

        .login-footer a {
            color: var(--color-primary);
            text-decoration: none;
            font-size: 14px;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 12px 16px;
            border-radius: var(--radius-md);
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-danger {
            background-color: var(--color-danger-light);
            color: var(--color-danger);
            border: 1px solid rgba(241, 65, 108, 0.2);
        }

        .version {
            text-align: center;
            margin-top: 24px;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.5);
        }

        .spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            margin-right: 8px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .btn-login.loading .spinner {
            display: inline-block;
        }

        .btn-login.loading .btn-text {
            opacity: 0.7;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-logo">
                <img src="./img/logo.png" alt="SmartFlat" onerror="this.style.display='none'">
                <h1>SmartFlat CMS</h1>
                <p>콘텐츠 관리 시스템에 로그인하세요</p>
            </div>

            <div id="error-message" class="alert alert-danger" style="display: none;"></div>

            <form id="login-form" onsubmit="return handleLogin(event)">
                <input type="hidden" id="csrf_token" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
                <div class="form-group">
                    <label class="form-label">이메일</label>
                    <div class="input-group">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="text" class="form-control" id="login-email" name="email"
                               placeholder="이메일을 입력하세요" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">비밀번호</label>
                    <div class="input-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" class="form-control" id="login-password" name="password"
                               placeholder="비밀번호를 입력하세요" required>
                    </div>
                </div>

                <button type="submit" class="btn-login" id="btn-login">
                    <span class="spinner"></span>
                    <span class="btn-text">로그인</span>
                </button>
            </form>

            <div class="login-footer">
                <a href="#">비밀번호를 잊으셨나요?</a>
            </div>
        </div>

        <div class="version">
            SmartFlat CMS v<?php echo CMS_VERSION; ?>
        </div>
    </div>

    <script src="./libs/jquery/jquery-3.5.1.min.js"></script>
    <script>
        function handleLogin(event) {
            event.preventDefault();

            const email = document.getElementById('login-email').value.trim();
            const password = document.getElementById('login-password').value;
            const csrfToken = document.getElementById('csrf_token').value;
            const btn = document.getElementById('btn-login');
            const errorDiv = document.getElementById('error-message');

            if (!email || !password) {
                showError('이메일과 비밀번호를 입력해주세요.');
                return false;
            }

            // Show loading state
            btn.classList.add('loading');
            btn.disabled = true;
            errorDiv.style.display = 'none';

            // Make login request to v3 login API
            $.ajax({
                type: 'POST',
                url: './api/login.php',
                data: { email: email, password: password, csrf_token: csrfToken },
                dataType: 'json',
                success: function(response) {
                    if (response.code === 200 || response.code === '200') {
                        window.location.href = 'main.php';
                    } else {
                        showError(response.message || '로그인에 실패했습니다.');
                        btn.classList.remove('loading');
                        btn.disabled = false;
                    }
                },
                error: function(xhr, status, error) {
                    showError('서버 연결에 실패했습니다. 잠시 후 다시 시도해주세요.');
                    btn.classList.remove('loading');
                    btn.disabled = false;
                }
            });

            return false;
        }

        function showError(message) {
            const errorDiv = document.getElementById('error-message');
            errorDiv.textContent = message;
            errorDiv.style.display = 'block';
        }

        // Enter key handling
        document.getElementById('login-password').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                handleLogin(e);
            }
        });
    </script>
</body>
</html>
