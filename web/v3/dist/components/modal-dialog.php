<?php
/**
 * SmartFlat CMS v3 - Modal Dialog Component (PHP Templates)
 *
 * Note: Most modal functionality is handled by JS (ui.js).
 * This file provides PHP helper functions for rendering modal templates.
 *
 * Usage:
 *   renderModalTemplate('confirm-delete', [
 *       'title' => '삭제 확인',
 *       'message' => '정말 삭제하시겠습니까?'
 *   ]);
 */

/**
 * Render a form modal template
 *
 * @param string $id Modal ID
 * @param string $title Modal title
 * @param string $formContent Form HTML content
 * @param array $options Modal options
 */
function renderFormModal($id, $title, $formContent, $options = []) {
    $size = $options['size'] ?? 'md'; // sm, md, lg, xl
    $submitText = $options['submitText'] ?? '저장';
    $cancelText = $options['cancelText'] ?? '취소';
    $onSubmit = $options['onSubmit'] ?? 'return false';
    ?>
    <div class="modal-template" id="<?php echo htmlspecialchars($id); ?>_template" style="display: none;">
        <div class="modal modal-<?php echo htmlspecialchars($size); ?>">
            <div class="modal-dialog">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo htmlspecialchars($title); ?></h5>
                    <button class="modal-close" onclick="hideModalDialog()">&times;</button>
                </div>
                <form onsubmit="<?php echo htmlspecialchars($onSubmit); ?>">
                    <div class="modal-body">
                        <?php echo $formContent; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" onclick="hideModalDialog()">
                            <?php echo htmlspecialchars($cancelText); ?>
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <?php echo htmlspecialchars($submitText); ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Render a confirmation modal template
 */
function renderConfirmModal($id, $title, $message, $options = []) {
    $confirmText = $options['confirmText'] ?? '확인';
    $cancelText = $options['cancelText'] ?? '취소';
    $confirmClass = $options['confirmClass'] ?? 'btn-primary';
    ?>
    <div class="modal-template" id="<?php echo htmlspecialchars($id); ?>_template" style="display: none;">
        <div class="modal">
            <div class="modal-dialog">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo htmlspecialchars($title); ?></h5>
                    <button class="modal-close" onclick="hideModalDialog()">&times;</button>
                </div>
                <div class="modal-body">
                    <p><?php echo htmlspecialchars($message); ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" onclick="hideModalDialog()">
                        <?php echo htmlspecialchars($cancelText); ?>
                    </button>
                    <button type="button" class="btn <?php echo htmlspecialchars($confirmClass); ?>" id="<?php echo htmlspecialchars($id); ?>_confirm">
                        <?php echo htmlspecialchars($confirmText); ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Show modal from template via JS
 */
function getShowModalScript($templateId, $onConfirm = null) {
    ?>
    <script>
    function show<?php echo ucfirst($templateId); ?>Modal(data, onConfirm) {
        const template = document.getElementById('<?php echo htmlspecialchars($templateId); ?>_template');
        if (!template) return;

        const html = template.innerHTML;
        const modalId = showModalDialog(document.body, '', html, '확인', '취소',
            function() {
                if (onConfirm) onConfirm(data);
                hideModalDialog();
            },
            function() {
                hideModalDialog();
            },
            { allowHtml: true }
        );
    }
    </script>
    <?php
}

/**
 * Generate form field HTML
 */
function formField($name, $label, $type = 'text', $options = []) {
    $required = $options['required'] ?? false;
    $placeholder = $options['placeholder'] ?? '';
    $value = $options['value'] ?? '';
    $hint = $options['hint'] ?? '';
    $selectOptions = $options['options'] ?? [];

    ob_start();
    ?>
    <div class="form-group">
        <label class="form-label">
            <?php echo htmlspecialchars($label); ?>
            <?php if ($required): ?>
            <span class="text-danger">*</span>
            <?php endif; ?>
        </label>

        <?php if ($type === 'select'): ?>
        <select class="form-control" name="<?php echo htmlspecialchars($name); ?>" <?php echo $required ? 'required' : ''; ?>>
            <option value="">선택하세요</option>
            <?php foreach ($selectOptions as $opt): ?>
            <option value="<?php echo htmlspecialchars($opt['value']); ?>"
                    <?php echo $opt['value'] == $value ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($opt['label']); ?>
            </option>
            <?php endforeach; ?>
        </select>

        <?php elseif ($type === 'textarea'): ?>
        <textarea class="form-control" name="<?php echo htmlspecialchars($name); ?>"
                  placeholder="<?php echo htmlspecialchars($placeholder); ?>"
                  rows="<?php echo $options['rows'] ?? 3; ?>"
                  <?php echo $required ? 'required' : ''; ?>><?php echo htmlspecialchars($value); ?></textarea>

        <?php elseif ($type === 'checkbox'): ?>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="<?php echo htmlspecialchars($name); ?>" id="<?php echo htmlspecialchars($name); ?>"
                   <?php echo $value ? 'checked' : ''; ?>>
            <label class="form-check-label" for="<?php echo htmlspecialchars($name); ?>">
                <?php echo htmlspecialchars($hint); ?>
            </label>
        </div>
        <?php $hint = ''; // Already shown ?>

        <?php else: ?>
        <input type="<?php echo htmlspecialchars($type); ?>" class="form-control" name="<?php echo htmlspecialchars($name); ?>"
               placeholder="<?php echo htmlspecialchars($placeholder); ?>"
               value="<?php echo htmlspecialchars($value); ?>"
               <?php echo $required ? 'required' : ''; ?>>
        <?php endif; ?>

        <?php if ($hint): ?>
        <small class="form-text text-muted"><?php echo htmlspecialchars($hint); ?></small>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
?>
