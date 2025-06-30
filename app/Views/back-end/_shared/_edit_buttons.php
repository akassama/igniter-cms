
<?php 
$demoMode = boolval(env('DEMO_MODE', "false"));
?>

<?php if($demoMode): ?>
    <button type="button" class="btn btn-outline-primary float-end demo-submit-btn" id="submit-btn">
        <i class="ri-edit-box-line"></i>
        Update
    </button>
<?php else: ?>
    <button type="submit" class="btn btn-outline-primary float-end" id="submit-btn">
        <i class="ri-edit-box-line"></i>
        Update
    </button>
<?php endif; ?>