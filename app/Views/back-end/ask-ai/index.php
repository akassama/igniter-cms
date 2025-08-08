<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>ASK AI<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Ask AI')
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3>Ask AI</h3>
    </div>

    <div class="col-12 bg-light rounded p-4">
        <?php $validation = \Config\Services::validation(); ?>
        <form action="#!" method="post" class="row g-3 needs-validation save-changes">        
            <div class="row">
                <!-- Question Input -->
                <div class="col-md-9 mb-3">
                    <label for="ai_question" class="form-label">Your Question</label>
                    <textarea class="form-control" id="ai_question" name="ai_question" rows="2" 
                        placeholder="Ask me anything about your CMS, configurations, or technical issues..." required></textarea>
                    <div class="invalid-feedback">
                        Please enter your question.
                    </div>
                </div>
                
                <div class="col-md-3 d-flex align-items-end mb-3">
                    <button type="button" class="btn btn-primary w-100 py-3 use-ai-btn"
                        hx-post="<?=base_url()?>/htmx/get-ai-help-answer"
                        hx-trigger="click delay:250ms"
                        hx-target="#ai-help-response-div"
                        hx-swap="innerHTML" hx-indicator="#spinner">
                        <i class="ri-send-plane-2-line"></i> Ask AI
                    </button>
                </div>
                
                <!-- AI Response Section -->
                <div class="col-12 mt-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white d-flex align-items-center justify-content-between">
                            <div>
                                <i class="fas fa-robot text-primary me-2"></i>
                                <h5 class="mb-0 d-inline">AI Response</h5>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-dark copy-response" title="Copy to clipboard">
                                <i class="ri-file-copy-line"></i> Copy
                            </button>
                        </div>
                        <div class="card-body" id="ai-help-response-div">
                            <div class="ai-response-placeholder text-muted">
                                <p class="mb-0">Your AI response will appear here after you ask a question.</p>
                                <img  id="spinner" class="htmx-indicator" src="<?=base_url('https://ignitercms.com/assets/img/default/loading.gif')?>" style="height: 75px"/>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Copy to clipboard functionality
    document.querySelectorAll('.copy-response').forEach(button => {
        button.addEventListener('click', function() {
            const responseText = this.closest('.card').querySelector('.response-text').innerText;
            navigator.clipboard.writeText(responseText).then(() => {
                // Change button temporarily to show success
                const originalHTML = this.innerHTML;
                this.innerHTML = '<i class="ri-checkbox-multiple-fill"></i> Copied!';
                setTimeout(() => {
                    this.innerHTML = originalHTML;
                }, 2000);
            });
        });
    });
});
</script>



<!-- end main content -->
<?= $this->endSection() ?>


