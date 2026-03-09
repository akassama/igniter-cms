<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Manage Content Blocks<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => lang('App.dashboard'), 'url' => '/account'),
    array('title' => 'Content Blocks')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Manage Content Blocks</h3>
    </div>
    <div class="col-12 d-flex justify-content-end mb-2">
        <a href="<?=base_url('/account/content-blocks/new-content-block')?>" class="btn btn-outline-dark mx-1">
            <i class="ri-add-fill"></i> <?= lang('App.new_content_block') ?>
        </a>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                <?= lang('App.content_blocks') ?>
                <span class="badge rounded-pill bg-dark">
                    <?= $total_content_blocks ?>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <!--Content-->
                    <table class="table table-bordered datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?= lang('App.identifier') ?></th>
                            <th><?= lang('App.title') ?></th>
                            <th><?= lang('App.description') ?></th>
                            <th><?= lang('App.author') ?></th>
                            <th><?= lang('App.order') ?></th>
                            <th><?= lang('App.icon') ?></th>
                            <th><?= lang('App.link') ?></th>
                            <th><?= lang('App.actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($content_blocks): ?>
                            <?php foreach($content_blocks as $content): ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td><?= $content['identifier']; ?></td>
                                    <td><?= $content['title']; ?></td>
                                    <td><?= $content['description']; ?></td>
                                    <td>
                                        <span class="text-primary">
                                            <?= getActivityBy(esc($content['author'])) ?>
                                        </span>
                                    </td>
                                    <td><?= $content['order']; ?></td>
                                    <td><?= $content['icon']; ?></td>
                                    <td><?= $content['link']; ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 view-content" href="<?=base_url('account/content-blocks/view-content-block/'.$content['content_id'])?>">
                                                    <i class="h5 ri-eye-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 edit-content-block" href="<?=base_url('account/content-blocks/edit-content-block/'.$content['content_id'])?>">
                                                    <i class="h5 ri-edit-box-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 remove-content-block" href="#!" onclick="deleteRecord('content_blocks', 'content_id ', '<?=$content['content_id'];?>', '', 'account/content-blocks')">
                                                    <i class="h5 ri-close-circle-fill"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php $rowCount++; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include the delete script -->
<?=  $this->include('back-end/layout/assets/delete_prompt_script.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>