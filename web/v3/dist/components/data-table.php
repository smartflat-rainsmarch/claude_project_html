<?php
/**
 * SmartFlat CMS v3 - Data Table Component
 *
 * Usage:
 *   renderDataTable('projects-table', [
 *       ['key' => 'name', 'label' => '프로젝트명', 'sortable' => true],
 *       ['key' => 'status', 'label' => '상태', 'type' => 'badge'],
 *       ['key' => 'actions', 'label' => '', 'type' => 'actions']
 *   ], [
 *       'apiUrl' => '/api/v3/projects',
 *       'pageSize' => 20,
 *       'searchable' => true
 *   ]);
 */

/**
 * Render data table container
 *
 * @param string $id Table ID
 * @param array $columns Column definitions
 * @param array $options Table options
 */
function renderDataTable($id, $columns, $options = []) {
    $searchable = $options['searchable'] ?? false;
    $exportable = $options['exportable'] ?? false;
    $selectable = $options['selectable'] ?? false;

    ?>
    <div class="data-table-wrapper" id="<?php echo htmlspecialchars($id); ?>_wrapper">
        <?php if ($searchable || $exportable): ?>
        <div class="data-table-toolbar">
            <?php if ($searchable): ?>
            <div class="table-search">
                <input type="text" class="form-control" placeholder="검색..."
                       id="<?php echo htmlspecialchars($id); ?>_search"
                       onkeyup="window.sfTables['<?php echo htmlspecialchars($id); ?>']?.search(this.value)">
                <i class="fas fa-search"></i>
            </div>
            <?php endif; ?>

            <div class="table-actions">
                <?php if ($exportable): ?>
                <button class="btn btn-light btn-sm" onclick="window.sfTables['<?php echo htmlspecialchars($id); ?>']?.export('csv')">
                    <i class="fas fa-download"></i> 내보내기
                </button>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="table-container">
            <table class="table" id="<?php echo htmlspecialchars($id); ?>">
                <thead>
                    <tr>
                        <?php if ($selectable): ?>
                        <th class="th-checkbox">
                            <input type="checkbox" class="form-check-input" id="<?php echo htmlspecialchars($id); ?>_selectAll"
                                   onchange="window.sfTables['<?php echo htmlspecialchars($id); ?>']?.selectAll(this.checked)">
                        </th>
                        <?php endif; ?>
                        <?php foreach ($columns as $col): ?>
                        <th class="<?php echo ($col['sortable'] ?? false) ? 'sortable' : ''; ?>"
                            <?php echo ($col['sortable'] ?? false) ? 'onclick="window.sfTables[\'' . htmlspecialchars($id) . '\']?.sort(\'' . htmlspecialchars($col['key']) . '\')"' : ''; ?>
                            <?php echo !empty($col['width']) ? 'style="width:' . htmlspecialchars($col['width']) . '"' : ''; ?>>
                            <?php echo htmlspecialchars($col['label']); ?>
                            <?php if ($col['sortable'] ?? false): ?>
                            <i class="fas fa-sort sort-icon"></i>
                            <?php endif; ?>
                        </th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="<?php echo count($columns) + ($selectable ? 1 : 0); ?>" class="table-loading">
                            <div class="spinner"></div>
                            <div class="loading-text">데이터 로딩 중...</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="data-table-footer">
            <div class="table-info" id="<?php echo htmlspecialchars($id); ?>_info">
                총 <span class="total-count">0</span>건
            </div>
            <div class="table-pagination" id="<?php echo htmlspecialchars($id); ?>_pagination">
                <!-- Pagination will be rendered by JS -->
            </div>
        </div>
    </div>

    <script>
    (function() {
        // Initialize table when DOM is ready
        if (!window.sfTables) window.sfTables = {};

        const options = <?php echo json_encode($options, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP); ?>;
        const columns = <?php echo json_encode($columns, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP); ?>;

        if (typeof SFDataTable !== 'undefined') {
            window.sfTables['<?php echo htmlspecialchars($id); ?>'] = new SFDataTable('<?php echo htmlspecialchars($id); ?>', {
                ...options,
                columns: columns
            });
        }
    })();
    </script>
    <?php
}

/**
 * Render a simple static table
 */
function renderSimpleTable($id, $columns, $data, $options = []) {
    ?>
    <div class="table-container">
        <table class="table" id="<?php echo htmlspecialchars($id); ?>">
            <thead>
                <tr>
                    <?php foreach ($columns as $col): ?>
                    <th><?php echo htmlspecialchars($col['label']); ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data)): ?>
                <tr>
                    <td colspan="<?php echo count($columns); ?>" class="text-center text-muted" style="padding: 40px;">
                        데이터가 없습니다.
                    </td>
                </tr>
                <?php else: ?>
                <?php foreach ($data as $row): ?>
                <tr>
                    <?php foreach ($columns as $col): ?>
                    <td>
                        <?php
                        $value = $row[$col['key']] ?? '';
                        if (!empty($col['render']) && is_callable($col['render'])) {
                            echo $col['render']($row);
                        } else {
                            echo htmlspecialchars($value);
                        }
                        ?>
                    </td>
                    <?php endforeach; ?>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}
?>
