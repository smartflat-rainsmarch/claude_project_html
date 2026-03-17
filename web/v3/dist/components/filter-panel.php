<?php
/**
 * SmartFlat CMS v3 - Filter Panel Component
 *
 * Usage:
 *   renderFilterPanel('project-filters', [
 *       ['key' => 'status', 'label' => '상태', 'type' => 'select', 'options' => [...]],
 *       ['key' => 'region', 'label' => '지역', 'type' => 'select', 'options' => [...]],
 *       ['key' => 'date_range', 'label' => '기간', 'type' => 'daterange']
 *   ], [
 *       'onFilter' => 'handleFilter',
 *       'collapsed' => false
 *   ]);
 */

/**
 * Render filter panel
 *
 * @param string $id Panel ID
 * @param array $filters Filter definitions
 * @param array $options Panel options
 */
function renderFilterPanel($id, $filters, $options = []) {
    $collapsed = $options['collapsed'] ?? false;
    $onFilter = $options['onFilter'] ?? 'console.log';
    $inline = $options['inline'] ?? false;
    ?>
    <div class="filter-panel<?php echo $collapsed ? ' collapsed' : ''; ?><?php echo $inline ? ' filter-inline' : ''; ?>" id="<?php echo htmlspecialchars($id); ?>">
        <?php if (!$inline): ?>
        <div class="filter-header" onclick="toggleFilterPanel('<?php echo htmlspecialchars($id); ?>')">
            <span class="filter-title">
                <i class="fas fa-filter"></i> 필터
            </span>
            <span class="filter-toggle">
                <i class="fas fa-chevron-down"></i>
            </span>
        </div>
        <?php endif; ?>

        <div class="filter-body">
            <div class="filter-row">
                <?php foreach ($filters as $filter): ?>
                <?php renderFilterField($id, $filter); ?>
                <?php endforeach; ?>
            </div>

            <div class="filter-actions">
                <button class="btn btn-primary btn-sm" onclick="applyFilters('<?php echo htmlspecialchars($id); ?>', <?php echo htmlspecialchars($onFilter); ?>)">
                    <i class="fas fa-search"></i> 검색
                </button>
                <button class="btn btn-light btn-sm" onclick="resetFilters('<?php echo htmlspecialchars($id); ?>')">
                    <i class="fas fa-redo"></i> 초기화
                </button>
            </div>
        </div>
    </div>

    <script>
    function toggleFilterPanel(id) {
        document.getElementById(id)?.classList.toggle('collapsed');
    }

    function applyFilters(id, callback) {
        const panel = document.getElementById(id);
        if (!panel) return;

        const filters = {};
        panel.querySelectorAll('[data-filter-key]').forEach(el => {
            const key = el.dataset.filterKey;
            filters[key] = el.value;
        });

        if (typeof callback === 'function') {
            callback(filters);
        }
    }

    function resetFilters(id) {
        const panel = document.getElementById(id);
        if (!panel) return;

        panel.querySelectorAll('[data-filter-key]').forEach(el => {
            if (el.tagName === 'SELECT') {
                el.selectedIndex = 0;
            } else {
                el.value = '';
            }
        });
    }
    </script>
    <?php
}

/**
 * Render individual filter field
 */
function renderFilterField($panelId, $filter) {
    $key = $filter['key'];
    $label = $filter['label'];
    $type = $filter['type'] ?? 'text';
    $options = $filter['options'] ?? [];
    $placeholder = $filter['placeholder'] ?? '';
    $defaultValue = $filter['default'] ?? '';
    ?>
    <div class="filter-field">
        <label class="filter-label"><?php echo htmlspecialchars($label); ?></label>

        <?php if ($type === 'select'): ?>
        <select class="form-control form-control-sm" data-filter-key="<?php echo htmlspecialchars($key); ?>">
            <option value="">전체</option>
            <?php foreach ($options as $opt): ?>
            <option value="<?php echo htmlspecialchars($opt['value']); ?>"
                    <?php echo $opt['value'] == $defaultValue ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($opt['label']); ?>
            </option>
            <?php endforeach; ?>
        </select>

        <?php elseif ($type === 'date'): ?>
        <input type="date" class="form-control form-control-sm" data-filter-key="<?php echo htmlspecialchars($key); ?>"
               value="<?php echo htmlspecialchars($defaultValue); ?>">

        <?php elseif ($type === 'daterange'): ?>
        <div class="date-range">
            <input type="date" class="form-control form-control-sm" data-filter-key="<?php echo htmlspecialchars($key); ?>_start">
            <span class="date-separator">~</span>
            <input type="date" class="form-control form-control-sm" data-filter-key="<?php echo htmlspecialchars($key); ?>_end">
        </div>

        <?php else: ?>
        <input type="text" class="form-control form-control-sm" data-filter-key="<?php echo htmlspecialchars($key); ?>"
               placeholder="<?php echo htmlspecialchars($placeholder); ?>"
               value="<?php echo htmlspecialchars($defaultValue); ?>">
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Render quick filter buttons
 */
function renderQuickFilters($filters, $activeKey = null) {
    ?>
    <div class="quick-filters">
        <?php foreach ($filters as $filter): ?>
        <button class="btn btn-sm <?php echo ($filter['key'] === $activeKey) ? 'btn-primary' : 'btn-light'; ?>"
                onclick="<?php echo htmlspecialchars($filter['onclick'] ?? ''); ?>">
            <?php if (!empty($filter['icon'])): ?>
            <i class="fas <?php echo htmlspecialchars($filter['icon']); ?>"></i>
            <?php endif; ?>
            <?php echo htmlspecialchars($filter['label']); ?>
            <?php if (isset($filter['count'])): ?>
            <span class="badge badge-light"><?php echo (int)$filter['count']; ?></span>
            <?php endif; ?>
        </button>
        <?php endforeach; ?>
    </div>
    <?php
}
?>
