<?php
/**
 * SmartFlat CMS v3 - Toast Component (PHP Helper)
 *
 * Note: Toast notifications are primarily handled by JS (ui.js).
 * This file provides PHP helper functions for inline toast triggers.
 *
 * Usage in JS:
 *   toastSuccess('저장되었습니다.');
 *   toastError('오류가 발생했습니다.');
 *   toastWarning('주의가 필요합니다.');
 *   C_showToast('알림', '메시지 내용');
 */

/**
 * Output JavaScript to show a toast on page load
 *
 * @param string $type Toast type (success, error, warning, info)
 * @param string $message Toast message
 */
function showToastOnLoad($type, $message) {
    $typeFunction = match($type) {
        'success' => 'toastSuccess',
        'error' => 'toastError',
        'warning' => 'toastWarning',
        default => 'C_showToast'
    };
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if ($type === 'info'): ?>
        C_showToast('알림', <?php echo json_encode($message, JSON_UNESCAPED_UNICODE); ?>);
        <?php else: ?>
        <?php echo $typeFunction; ?>(<?php echo json_encode($message, JSON_UNESCAPED_UNICODE); ?>);
        <?php endif; ?>
    });
    </script>
    <?php
}

/**
 * Output flash toast from session
 */
function showFlashToast() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['flash_toast'])) {
        $toast = $_SESSION['flash_toast'];
        unset($_SESSION['flash_toast']);

        showToastOnLoad($toast['type'] ?? 'info', $toast['message']);
    }
}

/**
 * Set flash toast to session
 */
function setFlashToast($type, $message) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION['flash_toast'] = [
        'type' => $type,
        'message' => $message
    ];
}

/**
 * Render toast container (if not using initToastDiv from JS)
 */
function renderToastContainer() {
    ?>
    <div class="toast-container" id="toastarea"></div>
    <?php
}

/**
 * Output inline toast trigger button
 */
function toastTriggerButton($label, $type, $message, $class = 'btn btn-sm btn-light') {
    $typeFunction = match($type) {
        'success' => 'toastSuccess',
        'error' => 'toastError',
        'warning' => 'toastWarning',
        default => 'C_showToast'
    };

    $onclick = $type === 'info'
        ? "C_showToast('알림', " . json_encode($message, JSON_UNESCAPED_UNICODE) . ")"
        : "{$typeFunction}(" . json_encode($message, JSON_UNESCAPED_UNICODE) . ")";
    ?>
    <button class="<?php echo htmlspecialchars($class); ?>" onclick="<?php echo htmlspecialchars($onclick); ?>">
        <?php echo htmlspecialchars($label); ?>
    </button>
    <?php
}
?>
