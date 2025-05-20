<?php
$session = session();
// Get session data
$sessionName = $session->get('first_name') . ' ' . $session->get('last_name');
$sessionEmail = $session->get('email');
$userRole = getUserRole($sessionEmail);
?>

<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>View Log<?= $this->endSection() ?>

    <!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => 'Dashboard', 'url' => '/account'),
    array('title' => 'Admin', 'url' => '/account/admin'),
    array('title' => 'Logs', 'url' => '/account/admin/logs'),
    array('title' => 'View Log')
);
echo generateBreadcrumb($breadcrumb_links);
?>

    <div class="row">
        <!--Content-->
        <div class="col-12">
            <h3>View Log: <?= esc($filename) ?></h3>
        </div>
        <div class="col-12 bg-light rounded p-4">
            <div class="row">
                <div class="mb-3 mt-3">
                    <a href="<?= base_url('/account/admin/logs') ?>" class="btn btn-outline-danger">
                        <i class="ri-arrow-left-fill"></i>
                        Back
                    </a>
                </div>
            </div>

            <!-- Display log entries -->
            <div class="mt-4">
                <?php $erroLogData = "";?>
                <pre style="background: #f8f9fa; padding: 15px; border-radius: 5px; max-height: 500px; overflow-y: auto;">
                    <?php foreach ($logEntries as $entry): ?>
                        <?php $erroLogData .= esc($entry) ?>
                        <?= esc($entry) ?><br>
                    <?php endforeach; ?>
                </pre>
            </div>
        </div>
    </div>

    <!-- Check for enabling or disabling AI integration (sensitive data) -->
    <?php $enableGeminiAIAnalysis = getConfigData("EnableGeminiAIAnalysis"); ?>
    <?php if(strtolower($enableGeminiAIAnalysis) === "yes"):?>
        <!--AI Analysis Setion-->
        <div class="row">
            <div class="col-12 mt-3">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <i class="ri-cpu-line"></i> AI Analysis
                        </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p><strong>Analyze this data with AI</strong> - This would use the log data for the analysis</p>
                                <div class="row">
                                    <div class="col-12">
                                        <form action="#!">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <button type="button" class="btn btn-dark btn-sm mb-1 use-ai-btn"
                                                hx-post="<?=base_url()?>/htmx/get-error-logs-analysis-via-ai"
                                                hx-trigger="click delay:250ms"
                                                hx-target="#analysis-div"
                                                hx-swap="innerHTML"><i class="ri-robot-2-fill"></i> Analize With AI</button>
                                            </div>
                                            <div class="row">
                                                <input type="hidden" name="error_log" id="error_log" class="form-control" readonly value="<?=$erroLogData?>" />
                                            </div>
                                            <div id="analysis-div">

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;?>
    <!-- end main content -->
<?= $this->endSection() ?>