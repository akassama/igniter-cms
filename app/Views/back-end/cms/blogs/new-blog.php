<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>New Blog<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => lang('App.dashboard'), 'url' => '/account'),
    array('title' => 'CMS', 'url' => '/account/cms'),
    array('title' => 'Blogs', 'url' => '/account/cms/blogs'),
    array('title' => 'New Blog')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>New Blog</h3>
    </div>
    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <?php echo form_open(base_url('account/cms/blogs/new-blog'), 'method="post" class="row g-3 needs-validation save-changes" enctype="multipart/form-data" novalidate'); ?>
        <div class="row">
            <div class="col-sm-12 col-md-12 mb-3">
                <label for="title" class="form-label"><?= lang('App.title') ?></label>
                <input type="text" class="form-control title-text" id="title" name="title" data-show-err="true" maxlength="250" value="<?= set_value('title') ?>" required
                    hx-post="<?=base_url()?>/htmx/get-blog-title-slug"
                    hx-trigger="keyup, changed delay:250ms"
                    hx-target="#slug-div"
                    hx-swap="innerHTML">
                <!-- Error -->
                <?php if($validation->getError('title')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('title'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide title
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <label for="slug" class="form-label"><?= lang('App.slug') ?></label>
                <div class="input-group mb-3" id="slug-div">
                    <span class="input-group-text"><?= base_url('/blog/'); ?></span>
                    <input type="text" class="form-control" id="slug" name="slug" value="<?= set_value('slug') ?>" required>
                    <div class="invalid-feedback">
                        Please provide slug
                    </div>
                </div>
                <!-- Error -->
                <?php if($validation->getError('slug')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('slug'); ?>
                    </div>
                <?php }?>
            </div>

            <div class="col-12">
                <div class="row">
                    <div class="col-12" id="display-preview-image">
                        <div class="float-end">         
                            <img loading="lazy" src="<?= base_url(getDefaultImagePath())?>" class="img-thumbnail" alt="Featured image" width="150" height="150"> 
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 mb-3">
                        <label for="featured_image" class="form-label">Featured Image</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="featured_image" name="featured_image" placeholder="select featured image" value="<?= set_value('featured_image') ?>"
                            hx-post="<?=base_url()?>/htmx/set-image-display"
                            hx-trigger="keyup, changed delay:250ms"
                            hx-target="#display-preview-image"
                            hx-swap="innerHTML">
                            <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#ciFileManagerModal">
                                <i class="ri-image-fill"></i>
                            </button>
                            <div class="invalid-feedback">
                                Please provide featured image
                            </div>
                        </div>
                        <!-- Error -->
                        <?php if($validation->getError('featured_image')) {?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('featured_image'); ?>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <label for="content" class="form-label">Content</label>
                    <button type="button" class="btn btn-secondary btn-sm mb-1 use-ai-btn" data-bs-toggle="modal" data-bs-target="#blogPromptModal">
                        <i class="ri-robot-2-fill"></i> Write With AI
                    </button>
                </div>
                <textarea rows="1" class="form-control content-editor" id="content" name="content" required><?= set_value('content') ?></textarea>
                <!-- Error -->
                <?php if($validation->getError('content')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('content'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide content
                </div>
            </div>

            <div class="col-sm-12 col-md-12 mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <label for="excerpt" class="form-label">Excerpt</label>
                        <button type="button" class="btn btn-secondary btn-sm mb-1 use-ai-btn"
                        hx-post="<?=base_url()?>/htmx/get-excerpt-via-ai"
                        hx-trigger="click delay:250ms"
                        hx-target="#excerpt-div"
                        hx-swap="innerHTML"><i class="ri-robot-2-fill"></i> Use AI</button>
                </div>
                <div id="excerpt-div">
                    <textarea class="form-control" id="excerpt" name="excerpt" ><?= set_value('excerpt') ?></textarea>
                </div>
                <!-- Error -->
                <?php if($validation->getError('excerpt')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('excerpt'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide excerpt
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="category" class="form-label"><?= lang('App.category') ?></label>
                <select class="form-select" id="category" name="category" required>
                    <option value="">Select category</option>
                    <?= getBlogCategorySelectOptions() ?>
                </select>
                <!-- Error -->
                <?php if($validation->getError('category')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('category'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide category
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <div class="d-flex justify-content-between align-items-center">
                <label for="tags" class="form-label">Tags</label>
                    <button type="button" class="btn btn-secondary btn-sm mb-1 use-ai-btn"
                    hx-post="<?=base_url()?>/htmx/get-tags-via-ai"
                    hx-trigger="click delay:250ms"
                    hx-target="#tags-div"
                    hx-swap="innerHTML"><i class="ri-robot-2-fill"></i> Use AI</button>
                </div>
                <div id="tags-div" hx-on:htmx:after-settle="setTagsInput('tags')">
                    <textarea rows="1" class="form-control tags-input" id="tags" name="tags" required><?= set_value('tags') ?></textarea>
                </div>
                <!-- Error -->
                <?php if($validation->getError('tags')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('tags'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide tags
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="">Select status</option>
                    <option value="0">Unpublished</option>
                    <option value="1">Published</option>
                    <option value="2">Schedule</option>
                </select>
                <!-- Error -->
                <?php if($validation->getError('status')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('status'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide status
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="author" class="form-label"><?= lang('App.author') ?></label>
                <select class="form-select" id="author" name="author" required>
                    <option value="">Select author</option>
                    <?= getUserSelectOptions() ?>
                </select>
                <!-- Error -->
                <?php if($validation->getError('author')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('author'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide author
                </div>
            </div>

            <div class="col-12 mb-3" id="schedule-date" style="display:none">
                <label for="scheduled_date_time" class="form-label">Scheduled Date</label>
                <input type="text" class="form-control tempus-datetime-picker" id="scheduled_date_time" name="scheduled_date_time" maxlength="250" value="<?= date('Y-m-d H:i:s', strtotime("+1 day")) ?>">
                <!-- Error -->
                <?php if($validation->getError('scheduled_date_time')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('scheduled_date_time'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide scheduled_date_time
                </div>
            </div>
            <script>
                document.getElementById('status').addEventListener('change', function() {
                    var scheduleDateDiv = document.getElementById('schedule-date');
                    var scheduledDateInput = document.getElementById('scheduled_date_time');
                    
                    if (this.value === '2') {
                        scheduleDateDiv.style.display = 'block';
                        scheduledDateInput.setAttribute('required', 'required');
                    } else {
                        scheduleDateDiv.style.display = 'none';
                        scheduledDateInput.removeAttribute('required');
                    }
                });
            </script>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="is_featured" class="form-label">Featured</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1">
                    <label class="form-check-label small" for="is_featured">Toggle to set as featured</label>
                </div>
                <!-- Error -->
                <?php if($validation->getError('is_featured')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('is_featured'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide is_featured
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <label for="is_breaking" class="form-label">Breaking</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="is_breaking" name="is_breaking" value="1">
                    <label class="form-check-label small" for="is_breaking">Toggle to set as breaking</label>
                </div>
                <!-- Error -->
                <?php if($validation->getError('is_breaking')) {?>
                    <div class='text-danger mt-2'>
                        <?= $error = $validation->getError('is_breaking'); ?>
                    </div>
                <?php }?>
                <div class="invalid-feedback">
                    Please provide is_breaking
                </div>
            </div>

            <div class="col-12 mb-3">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                SEO Data
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <label for="meta_title" class="form-label"><?= lang('App.meta_title') ?></label>
                                            <button type="button" class="btn btn-secondary btn-sm mb-1 use-ai-btn" data-target="meta_title"
                                            hx-post="<?=base_url()?>/htmx/set-meta-title-via-ai"
                                            hx-trigger="click delay:250ms"
                                            hx-target="#meta-title-div"
                                            hx-swap="innerHTML"><i class="ri-robot-2-fill"></i> Use AI</button>
                                        </div>
                                        <div id="meta-title-div">
                                            <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?= set_value('meta_title') ?>">
                                        </div>
                                        <?php if($validation->getError('meta_title')) {?>
                                            <div class='text-danger mt-2'>
                                                <?= $error = $validation->getError('meta_title'); ?>
                                            </div>
                                        <?php }?>
                                        <div class="invalid-feedback">
                                            Please provide meta_title
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <label for="meta_description" class="form-label"><?= lang('App.meta_description') ?></label>
                                            <button type="button" class="btn btn-secondary btn-sm mb-1 use-ai-btn" data-target="meta_description"
                                            hx-post="<?=base_url()?>/htmx/set-meta-description-via-ai"
                                            hx-trigger="click delay:250ms"
                                            hx-target="#meta-description-div"
                                            hx-swap="innerHTML"><i class="ri-robot-2-fill"></i> Use AI</button>
                                        </div>
                                        <div id="meta-description-div">
                                            <textarea class="form-control" id="meta_description" name="meta_description" ><?= set_value('meta_description') ?></textarea>
                                        </div>
                                        <?php if($validation->getError('meta_description')) {?>
                                            <div class='text-danger mt-2'>
                                                <?= $error = $validation->getError('meta_description'); ?>
                                            </div>
                                        <?php }?>
                                        <div class="invalid-feedback">
                                            Please provide meta_description
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <label for="meta_keywords" class="form-label"><?= lang('App.meta_keywords') ?></label>
                                            <button type="button" class="btn btn-secondary btn-sm mb-1 use-ai-btn" data-target="meta_keywords"
                                            hx-post="<?=base_url()?>/htmx/set-meta-keywords-via-ai"
                                            hx-trigger="click delay:250ms"
                                            hx-target="#meta-keywords-div"
                                            hx-swap="innerHTML"><i class="ri-robot-2-fill"></i> Use AI</button>
                                        </div>
                                        <div id="meta-keywords-div" hx-on:htmx:after-settle="setTagsInput('meta_keywords')">
                                            <textarea rows="1" class="form-control tags-input" id="meta_keywords" name="meta_keywords"><?= set_value('meta_keywords') ?></textarea>
                                        </div>
                                        <?php if($validation->getError('meta_keywords')) {?>
                                            <div class='text-danger mt-2'>
                                                <?= $error = $validation->getError('meta_keywords'); ?>
                                            </div>
                                        <?php }?>
                                        <div class="invalid-feedback">
                                            Please provide meta_keywords
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3 mt-3">
                <a href="<?= base_url('/account/cms/blogs') ?>" class="btn btn-outline-danger">
                    <i class="ri-arrow-left-fill"></i>
                    <?= lang('App.back') ?>
                </a>
                <?= $this->include('back-end/_shared/_submit_buttons.php'); ?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<!-- Include the files modal -->
<?=  $this->include('back-end/layout/modals/_files_modal.php'); ?>

<script>
    // Initialize tags input
    function setTagsInput(inputId){
        $('#'+inputId).tagsInput();
        $('#'+inputId).css('width', '100%');
    }
</script>

<!-- Prompt Modal -->
<div class="modal fade" id="blogPromptModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">AI Blog Generator</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="blogGeneratorForm">
                    <div class="mb-3">
                        <label for="blog_description" class="form-label">Describe your blog topic</label>
                        <textarea class="form-control" id="blog_description" name="blog_description" rows="4" 
                                  placeholder="e.g. A travel guide about the hidden gems in Kyoto..."
                                  oninput="validateInput()"></textarea>
                        <div id="char-count" class="form-text text-danger">Minimum 10 characters required.</div>
                    </div>

                    <button type="button" class="btn btn-primary w-100 mb-4 use-ai-btn" id="generate-blog-button"
                            hx-post="<?=base_url()?>/htmx/get-content-via-ai"
                            hx-trigger="click delay:250ms"
                            hx-target="#content-div"
                            hx-include="#blog_description"
                            hx-swap="innerHTML" hx-indicator="#spinner" disabled>
                        <i class="ri-robot-2-fill"></i> Generate Blog
                    </button>
                </form>

                <hr>

                <div class="position-relative p-3 border rounded bg-light" style="min-height: 200px;">
                    <label class="text-muted small fw-bold">Generated Content:</label>
                    
                    <button type="button" 
                            class="btn btn-sm btn-outline-secondary position-absolute top-0 end-0 m-2" 
                            onclick="copyGeneratedContent()" 
                            title="Copy to clipboard">
                        <i class="ri-file-copy-line"></i>
                    </button>

                    <div id="content-div" class="mt-2 text-dark">
                        Your generated blog post will appear here...
                        <img  id="spinner" class="htmx-indicator" src="<?=base_url('public/uploads/default/loading.gif')?>" style="height: 75px"/>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>

    <script>
        /**
         * Disables/Enables button based on input length
         */
        function validateInput() {
            const textarea = document.getElementById('blog_description');
            const btn = document.getElementById('generate-blog-button');
            const hint = document.getElementById('char-count');
            
            if (textarea.value.trim().length >= 10) {
                btn.disabled = false;
                hint.classList.add('d-none');
            } else {
                btn.disabled = true;
                hint.classList.remove('d-none');
            }
        }

        /**
         * Copies content from #content-div (Fixed ID mapping)
         */
        function copyGeneratedContent() {
            const outputDiv = document.getElementById('content-div');
            const copyBtn = document.querySelector('[onclick="copyGeneratedContent()"]');
            const icon = copyBtn.querySelector('i');
            
            const textToCopy = outputDiv.innerText || outputDiv.textContent;

            navigator.clipboard.writeText(textToCopy).then(() => {
                const originalClass = icon.className;
                icon.className = 'ri-check-line text-success';
                
                setTimeout(() => {
                    icon.className = originalClass;
                }, 2000);
            }).catch(err => {
                console.error('Copy failed', err);
            });
        }
    </script>
</div>

<!-- end main content -->
<?= $this->endSection() ?>
