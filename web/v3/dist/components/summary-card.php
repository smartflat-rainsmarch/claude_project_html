<?php
/**
 * SmartFlat CMS v3 - Summary Card Component
 *
 * Usage:
 *   renderSummaryCard('전체 프로젝트', 12, 'fa-folder-open', 'primary');
 *   renderSummaryCard('활성 기기', 48, 'fa-tv', 'success', 'javascript:loadPage("device")');
 */

/**
 * Render a summary/stat card
 *
 * @param string $title Card title
 * @param mixed $value Card value (number or string)
 * @param string $icon FontAwesome icon class (e.g., 'fa-folder-open')
 * @param string $color Color variant (primary, success, warning, danger, info)
 * @param string|null $link Optional click link
 * @param string|null $subtitle Optional subtitle text
 * @param string|null $trend Optional trend indicator (+5%, -2%, etc.)
 */
function renderSummaryCard($title, $value, $icon = 'fa-chart-bar', $color = 'primary', $link = null, $subtitle = null, $trend = null) {
    $colorClasses = [
        'primary' => 'stats-icon primary',
        'success' => 'stats-icon success',
        'warning' => 'stats-icon warning',
        'danger' => 'stats-icon danger',
        'info' => 'stats-icon info'
    ];

    $iconClass = $colorClasses[$color] ?? $colorClasses['primary'];
    $trendClass = '';
    $trendIcon = '';

    if ($trend) {
        if (strpos($trend, '+') === 0 || strpos($trend, '-') === false) {
            $trendClass = 'text-success';
            $trendIcon = 'fa-arrow-up';
        } else {
            $trendClass = 'text-danger';
            $trendIcon = 'fa-arrow-down';
        }
    }
    ?>
    <div class="card<?php echo $link ? ' clickable' : ''; ?>"<?php echo $link ? ' onclick="' . htmlspecialchars($link, ENT_QUOTES) . '"' : ''; ?>>
        <div class="card-body">
            <div class="stats-card">
                <div class="<?php echo $iconClass; ?>">
                    <i class="fas <?php echo htmlspecialchars($icon); ?>"></i>
                </div>
                <div class="stats-content">
                    <div class="stats-value">
                        <?php echo htmlspecialchars($value); ?>
                        <?php if ($trend): ?>
                        <span class="stats-trend <?php echo $trendClass; ?>">
                            <i class="fas <?php echo $trendIcon; ?>"></i>
                            <?php echo htmlspecialchars($trend); ?>
                        </span>
                        <?php endif; ?>
                    </div>
                    <div class="stats-label"><?php echo htmlspecialchars($title); ?></div>
                    <?php if ($subtitle): ?>
                    <div class="stats-subtitle"><?php echo htmlspecialchars($subtitle); ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Render a mini summary card (smaller version)
 */
function renderMiniSummaryCard($title, $value, $icon = 'fa-chart-bar', $color = 'primary') {
    ?>
    <div class="mini-stat-card">
        <div class="mini-stat-icon <?php echo htmlspecialchars($color); ?>">
            <i class="fas <?php echo htmlspecialchars($icon); ?>"></i>
        </div>
        <div class="mini-stat-content">
            <div class="mini-stat-value"><?php echo htmlspecialchars($value); ?></div>
            <div class="mini-stat-label"><?php echo htmlspecialchars($title); ?></div>
        </div>
    </div>
    <?php
}
?>
