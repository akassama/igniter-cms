<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?><?= lang('App.activity_logs') ?><?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => lang('App.dashboard'), 'url' => '/account'),
    array('title' => lang('App.admin'), 'url' => '/account/admin'),
    array('title' => lang('App.activity_logs'))
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3><?= lang('App.activity_logs') ?></h3>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                <?= lang('App.activities') ?>
                <span class="badge rounded-pill bg-dark">
                    <?= $total_activities ?>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable-1000">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?= lang('App.activity_by') ?></th>
                            <th><?= lang('App.activity_type') ?></th>
                            <th><?= lang('App.activity') ?></th>
                            <th><?= lang('App.ip_address') ?></th>
                            <th><?= lang('App.device') ?></th>
                            <th><?= lang('App.country') ?></th>
                            <th><?= lang('App.date_or_time') ?></th>
                            <th><?= lang('App.actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($activity_logs): ?>
                            <?php foreach($activity_logs as $activity): ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td>
                                        <span class="text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="User ID: <?= esc($activity['activity_by']) ?>">
                                            <?= getActivityBy(esc($activity['activity_by'])) ?>
                                        </span>
                                    </td>
                                    <td><?= esc($activity['activity_type']) ?></td>
                                    <td><?= esc($activity['activity']) ?></td>
                                    <td><?= esc($activity['ip_address']) ?></td>
                                    <td><?= esc($activity['device']) ?></td>
                                    <td>
                                        <span class="fi fi-<?= strtolower((string)esc($activity['country'])) ?>"></span>
                                        <?= esc($activity['country']) ?>
                                    </td>
                                    <td><?= esc($activity['created_at']) ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 view-activity" href="<?=base_url('account/admin/activity-logs/view-activity/'.esc($activity['activity_id']))?>">
                                                    <i class="h5 ri-eye-line"></i>
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
    <?php
        if($total_activities > 1000){
            ?>
                <!--Show pagination if more than 1000 records-->
                <div class="col-12 text-start">
                    <p><?= lang('App.pagination') ?></p>
                    <?= $pager->links('default', 'bootstrap') ?>
                </div>
            <?php
        }
    ?>

<!-- Check for enabling or disabling AI integration (sensitive data) -->
<?php $enableGeminiAIAnalysis = getConfigData("EnableGeminiAIAnalysis"); ?>
<?php if(strtolower($enableGeminiAIAnalysis) === "yes" && isValidAIKey()):?>
    <!--AI Analysis Setion-->
    <div class="row">
        <div class="col-12 mt-3">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <i class="ri-cpu-line"></i> <?= lang('App.ai_analysis') ?>
                    </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p><?= lang('App.ai_analysis_hint') ?></p>
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <button type="button" class="btn btn-dark btn-sm mb-1 use-ai-btn"
                                        hx-post="<?=base_url()?>/htmx/get-activity-logs-analysis-via-ai"
                                        hx-trigger="click delay:250ms"
                                        hx-target="#analysis-div"
                                        hx-swap="innerHTML" hx-indicator="#spinner"><i class="ri-robot-2-fill"></i> <?= lang('App.analyze_with_ai') ?></button>
                                    </div>
                                    <div id="analysis-div">
                                        <img  id="spinner" class="htmx-indicator" src="<?=base_url('public/uploads/default/loading.gif')?>" style="height: 75px"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif;?>

</div>

<!-- end main content -->
<?= $this->endSection() ?>