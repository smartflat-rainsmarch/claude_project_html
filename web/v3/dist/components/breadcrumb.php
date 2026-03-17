<?php
/**
 * SmartFlat CMS v3 - Breadcrumb Component
 *
 * Usage:
 *   renderBreadcrumb([
 *       ['label' => '홈', 'link' => 'dashboard'],
 *       ['label' => '프로젝트', 'link' => 'project'],
 *       ['label' => '프로젝트 상세']  // Active (no link)
 *   ]);
 */

/**
 * Render breadcrumb navigation
 *
 * @param array $items Breadcrumb items [['label' => '...', 'link' => '...']]
 * @param bool $showHome Automatically prepend home link
 */
function renderBreadcrumb($items, $showHome = true) {
    if ($showHome && (empty($items) || $items[0]['label'] !== '홈')) {
        array_unshift($items, ['label' => '홈', 'link' => 'dashboard']);
    }
    ?>
    <nav class="breadcrumb-nav" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <?php foreach ($items as $index => $item): ?>
            <?php
                $isLast = ($index === count($items) - 1);
                $hasLink = !$isLast && !empty($item['link']);
            ?>
            <li class="breadcrumb-item<?php echo $isLast ? ' active' : ''; ?>">
                <?php if ($hasLink): ?>
                <a href="#" onclick="loadPage('<?php echo htmlspecialchars($item['link']); ?>'); return false;">
                    <?php if ($index === 0 && $item['label'] === '홈'): ?>
                    <i class="fas fa-home"></i>
                    <?php else: ?>
                    <?php echo htmlspecialchars($item['label']); ?>
                    <?php endif; ?>
                </a>
                <?php else: ?>
                <?php echo htmlspecialchars($item['label']); ?>
                <?php endif; ?>
            </li>
            <?php endforeach; ?>
        </ol>
    </nav>
    <?php
}

/**
 * Render page header with breadcrumb
 *
 * @param string $title Page title
 * @param array $breadcrumbs Breadcrumb items
 * @param string|null $description Optional page description
 * @param array $actions Optional action buttons
 */
function renderPageHeader($title, $breadcrumbs = [], $description = null, $actions = []) {
    ?>
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-header-left">
                <?php if (!empty($breadcrumbs)): ?>
                <?php renderBreadcrumb($breadcrumbs); ?>
                <?php endif; ?>
                <h1 class="page-title"><?php echo htmlspecialchars($title); ?></h1>
                <?php if ($description): ?>
                <p class="page-description"><?php echo htmlspecialchars($description); ?></p>
                <?php endif; ?>
            </div>
            <?php if (!empty($actions)): ?>
            <div class="page-header-actions">
                <?php foreach ($actions as $action): ?>
                <button class="btn <?php echo htmlspecialchars($action['class'] ?? 'btn-primary'); ?>"
                        onclick="<?php echo htmlspecialchars($action['onclick'] ?? ''); ?>">
                    <?php if (!empty($action['icon'])): ?>
                    <i class="fas <?php echo htmlspecialchars($action['icon']); ?>"></i>
                    <?php endif; ?>
                    <?php echo htmlspecialchars($action['label']); ?>
                </button>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php
}
?>
