<?php 
$demoMode = boolval(env('DEMO_MODE', "false"));
$submitLabel = $submitLabel ?? 'Submit'; // Fallback to 'Submit' if not passed
?>

<?php if ($demoMode): ?>
    <button type="button" class="btn btn-outline-primary float-end demo-submit-btn" id="submit-btn">
        <i class="ri-send-plane-fill"></i>
        <?= esc($submitLabel) ?>
    </button>
<?php else: ?>
    <button type="submit" class="btn btn-outline-primary float-end" id="submit-btn">
        <i class="ri-send-plane-fill"></i>
        <?= esc($submitLabel) ?>
    </button>
<?php endif; ?>
