<?php
/**
 * SmartFlat CMS v3 - Status Badge Component
 *
 * Usage:
 *   renderStatusBadge('active', 'project');
 *   renderStatusBadge('online', 'device');
 *   renderStatusBadge('success', 'deploy');
 */

// Status configurations
$STATUS_CONFIGS = [
    'project' => [
        'active' => ['class' => 'badge-success', 'label' => '운영중', 'icon' => 'fa-check-circle'],
        'paused' => ['class' => 'badge-warning', 'label' => '일시정지', 'icon' => 'fa-pause-circle'],
        'archived' => ['class' => 'badge-secondary', 'label' => '보관', 'icon' => 'fa-archive']
    ],
    'device' => [
        'online' => ['class' => 'badge-success', 'label' => '온라인', 'icon' => 'fa-circle'],
        'offline' => ['class' => 'badge-danger', 'label' => '오프라인', 'icon' => 'fa-circle'],
        'warning' => ['class' => 'badge-warning', 'label' => '점검', 'icon' => 'fa-exclamation-circle'],
        'unknown' => ['class' => 'badge-secondary', 'label' => '알수없음', 'icon' => 'fa-question-circle']
    ],
    'content' => [
        'draft' => ['class' => 'badge-secondary', 'label' => '초안', 'icon' => 'fa-pencil-alt'],
        'published' => ['class' => 'badge-success', 'label' => '게시중', 'icon' => 'fa-check'],
        'archived' => ['class' => 'badge-dark', 'label' => '보관', 'icon' => 'fa-archive']
    ],
    'deploy' => [
        'created' => ['class' => 'badge-info', 'label' => '생성됨', 'icon' => 'fa-plus'],
        'queued' => ['class' => 'badge-info', 'label' => '대기중', 'icon' => 'fa-clock'],
        'running' => ['class' => 'badge-primary', 'label' => '진행중', 'icon' => 'fa-sync fa-spin'],
        'success' => ['class' => 'badge-success', 'label' => '성공', 'icon' => 'fa-check'],
        'partial_fail' => ['class' => 'badge-warning', 'label' => '부분실패', 'icon' => 'fa-exclamation-triangle'],
        'failed' => ['class' => 'badge-danger', 'label' => '실패', 'icon' => 'fa-times'],
        'cancelled' => ['class' => 'badge-secondary', 'label' => '취소', 'icon' => 'fa-ban'],
        'rollback' => ['class' => 'badge-dark', 'label' => '롤백', 'icon' => 'fa-undo']
    ],
    'alert' => [
        'info' => ['class' => 'badge-info', 'label' => '정보', 'icon' => 'fa-info-circle'],
        'warning' => ['class' => 'badge-warning', 'label' => '경고', 'icon' => 'fa-exclamation-triangle'],
        'error' => ['class' => 'badge-danger', 'label' => '오류', 'icon' => 'fa-times-circle'],
        'critical' => ['class' => 'badge-danger badge-critical', 'label' => '심각', 'icon' => 'fa-skull-crossbones']
    ]
];

/**
 * Render a status badge
 *
 * @param string $status Status value
 * @param string $type Status type (project, device, content, deploy, alert)
 * @param bool $showIcon Show icon before label
 * @param bool $showLabel Show text label
 */
function renderStatusBadge($status, $type = 'default', $showIcon = false, $showLabel = true) {
    global $STATUS_CONFIGS;

    $config = $STATUS_CONFIGS[$type][$status] ?? ['class' => 'badge-secondary', 'label' => $status, 'icon' => ''];

    $class = $config['class'];
    $label = $config['label'];
    $icon = $config['icon'];
    ?>
    <span class="badge <?php echo htmlspecialchars($class); ?>">
        <?php if ($showIcon && $icon): ?>
        <i class="fas <?php echo htmlspecialchars($icon); ?>"></i>
        <?php endif; ?>
        <?php if ($showLabel): ?>
        <?php echo htmlspecialchars($label); ?>
        <?php endif; ?>
    </span>
    <?php
}

/**
 * Render a status dot (smaller indicator)
 */
function renderStatusDot($status, $type = 'device') {
    global $STATUS_CONFIGS;

    $config = $STATUS_CONFIGS[$type][$status] ?? ['class' => 'badge-secondary', 'label' => $status];
    $colorClass = str_replace('badge-', 'dot-', $config['class']);
    ?>
    <span class="status-dot <?php echo htmlspecialchars($colorClass); ?>" title="<?php echo htmlspecialchars($config['label']); ?>"></span>
    <?php
}

/**
 * Get status config
 */
function getStatusConfig($status, $type) {
    global $STATUS_CONFIGS;
    return $STATUS_CONFIGS[$type][$status] ?? ['class' => 'badge-secondary', 'label' => $status, 'icon' => ''];
}
?>
