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
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Themes')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Themes</h1>
        <a href="<?=base_url('/account/themes/new-theme')?>" class="btn btn-primary">
            <i class="ri-add-fill"></i> Add New
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
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-<?= $theme['selected'] == "1" ? 'primary border-start border-3' : 'light' ?>">
                        <div class="card-img-top ratio ratio-16x9 bg-light overflow-hidden">
                            <a href="<?= $theme['theme_url']; ?>" target="_blank">
                                <img loading="lazy" src="<?= getImageUrl($theme['image'] ?? getDefaultImagePath()); ?>" 
                                     alt="<?= $theme['name']; ?>" class="img-fluid h-100 w-100 object-fit-cover">
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
                                    <a href="<?=base_url('account/themes/activate/'.$theme['theme_id'])?>" 
                                       class="btn btn-sm btn-primary">Activate</a>
                                <?php else: ?>
                                    <span class="btn btn-sm btn-success disabled">Active</span>
                                <?php endif; ?>
                                
                                <a href="<?=base_url('account/themes/edit-theme/'.$theme['theme_id'])?>" 
                                   class="btn btn-sm btn-outline-secondary">Customize</a>
                                
                                <?php if ($theme['deletable'] == 1 && $theme['selected'] !== "1"): ?>
                                    <a href="javascript:void(0)" 
                                       onclick="deleteRecord('themes', 'theme_id', '<?= $theme['theme_id'] ?>', '', 'account/themes')" 
                                       class="btn btn-sm btn-outline-danger ms-auto">Delete</a>
                                <?php endif; ?>
                            </div>
                            
                            <div class="text-muted small">
                                <div class="mb-1">
                                    <i class="ri-price-tag-3-line"></i> <?= $theme['category']; ?>
                                </div>
                                <div class="mb-1">
                                    <i class="ri-history-line"></i> Updated: <?= date('M j, Y', strtotime($theme['updated_at'])); ?>
                                </div>
                                <div>
                                    <i class="ri-user-line"></i> By <?= getActivityBy(esc($theme['created_by']), ""); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info">
                    No themes found. <a href="<?=base_url('/account/themes/new-theme')?>" class="alert-link">Add your first theme</a>.
                </div>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="alert alert-info mt-4">
        <p class="mb-1"><strong>Note:</strong> Remember to enable/disable sections in the homepage that may not be needed for your theme.
        You can set it <a href="<?=base_url('/account/cms/home-page')?>" class="alert-link">here</a>.</p>
        <p class="mb-0">You can also enable or disable specific pages via the <a href="<?=base_url('account/admin/configurations')?>" class="alert-link">configuration</a></p>
    </div>
</div>

<!-- Include the delete script -->
<?= $this->include('back-end/layout/assets/delete_prompt_script'); ?>

<style>
    /* Minimal custom CSS */
    .object-fit-cover {
        object-fit: cover;
    }
</style>

<!-- end main content -->
<?= $this->endSection() ?>