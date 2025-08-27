<?php
$session = session();
// Get session data
$sessionName = $session->get('first_name').' '.$session->get('last_name');
$sessionEmail = $session->get('email');
$userRole = getUserRole($sessionEmail);
?>

<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Manage Themes<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Appearance')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="container-fluid">
    <div class="col-12">
        <h3>Manage Themes</h3>
    </div>
    <div class="col-12 d-flex justify-content-end mb-2">
        <a href="<?=base_url('/account/appearance/themes/upload-theme')?>" class="btn btn-outline-success mx-1">
            <i class="ri-upload-2-fill"></i> Upload Theme
        </a>
        <a href="<?=base_url('/account/appearance/themes/install-themes')?>" class="btn btn-outline-dark mx-1">
            <i class="ri-add-fill"></i> Add Theme
        </a>
    </div>
    
    <?php
        $whereClause = ['selected' => '1'];
        $tableData = getTableData("themes", $whereClause, "selected");
        if(empty($tableData)){
            ?>
                <div class="alert alert-warning">
                    No active theme selected. Your site will not display properly until you activate a theme.
                </div>
            <?php
        }
    ?>
    
    <div class="row">
        <?php if($themes): ?>
            <?php foreach($themes as $theme): ?>
            <div class="col-md-3 mb-4">
                <div class="card h-100 border border-2 border-<?= $theme['selected'] == "1" ? 'success' : 'light' ?>">
                    <div class="card-img-top ratio ratio-4x3 bg-light overflow-hidden border-bottom">
                        <a href="<?= $theme['theme_url']; ?>" target="_blank">
                            <img loading="lazy" src="<?= base_url('/public/front-end/themes/'.$theme['path'].'/assets/images/preview.png'); ?>" 
                                alt="<?= $theme['name']; ?>" class="img-fluid w-100 h-100 object-fit-cover">
                        </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php if($theme['selected'] == "1"): ?>
                                <span class="text-muted">Active:</span> 
                            <?php endif; ?>
                            <?= $theme['name']; ?>
                        </h5>
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <?php if($theme['selected'] != "1"): ?>
                                <a href="<?=base_url('account/appearance/themes/activate/'.$theme['theme_id'])?>" 
                                class="btn btn-sm btn-primary">Activate</a>
                            <?php else: ?>
                                <span class="btn btn-sm btn-success disabled">Active</span>
                            <?php endif; ?>
                            
                            <a href="<?=base_url('account/appearance/themes/edit-theme/'.$theme['theme_id'])?>" 
                            class="btn btn-sm btn-outline-secondary">Customize</a>
                            
                            <?php if ($theme['deletable'] == 1 && $theme['selected'] !== "1"): ?>
                                <a href="#!" 
                                onclick="deleteTheme('<?=$theme['path']?>', '<?= $theme['theme_id'] ?>')" 
                                class="btn btn-sm btn-outline-danger ms-auto">Delete</a>
                            <?php endif; ?>
                        </div>
                        
                        <div class="text-muted small">
                            <div class="mb-1">
                                <span class="me-2"><i class="ri-price-tag-3-line"></i> <?= $theme['category']; ?></span>
                                <span class="me-2"><i class="ri-user-line"></i> By <?= getActivityBy(esc($theme['created_by']), ""); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info">
                    No themes found. <a href="<?=base_url('/account/appearance/themes/install-themes')?>" class="alert-link">Add your first theme</a>.
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    function deleteTheme(themePath, themeId) {
        Swal.fire({
            title: 'Are you sure you want to remove this theme?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                // Create the form element
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `<?= base_url('/account/appearance/themes/remove-theme') ?>`;

                // Add hidden input fields
                const themePathInput = document.createElement('input');
                themePathInput.type = 'hidden';
                themePathInput.name = 'theme_path';
                themePathInput.value = themePath;
                form.appendChild(themePathInput);

                const themeIdInput = document.createElement('input');
                themeIdInput.type = 'hidden';
                themeIdInput.name = 'theme_id';
                themeIdInput.value = themeId;
                form.appendChild(themeIdInput);

                // Append the form to the body and submit it
                document.body.appendChild(form);
                form.submit();

                // Remove the form from the body after submit (optional)
                document.body.removeChild(form);
            }
        });
    }
</script>

<style>
    /* Minimal custom CSS */
    .object-fit-cover {
        object-fit: cover;
    }
</style>

<!-- end main content -->
<?= $this->endSection() ?>