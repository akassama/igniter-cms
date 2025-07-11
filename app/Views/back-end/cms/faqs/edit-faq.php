<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>Edit FAQ<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'FAQS', 'url' => '/account/cms/faqs'),
    array('title' => 'Edit FAQ')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Edit FAQ</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/cms/faqs/edit-faq'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="question" class="form-label">Question</label>
                <input type="text" class="form-control" id="question" name="question" maxlength="250" value="<?= $faq_data['question'] ?>" required>
                <!-- Error -->
                <?php if($validation->getError('question')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('question'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide question
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="answer" class="form-label">Answer</label>
                <textarea rows="1" class="form-control" id="answer" name="answer" maxlength="1000" required><?= $faq_data['answer'] ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('answer')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('answer'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide answer
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="order" class="form-label">Order</label>
                <input type="text" class="form-control integer-plus-only" id="order" name="order" data-show-err="true" value="<?= $faq_data['order'] ?>" required>
                <!-- Error -->
                <?php if($validation->getError('order')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('order'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide order
                </div>
            </div>

            <!--hidden inputs -->
            <div class="col-12">
                <input type="hidden" class="form-control" id="faq_id" name="faq_id" value="<?= $faq_data['faq_id']; ?>" />
                <input type="hidden" class="form-control" id="created_by" name="created_by" value="<?= $faq_data['created_by']; ?>" />
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/cms/faqs') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    Back
                </a>
                <?= $this->include('back-end/_shared/_edit_buttons.php'); ?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<!-- Include the files modal -->
<?=  $this->include('back-end/layout/modals/files_modal.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>
