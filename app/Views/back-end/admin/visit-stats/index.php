<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?><?= lang('App.visit_stats') ?><?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = array(
    array('title' => lang('App.dashboard'), 'url' => '/account'),
    array('title' => lang('App.admin'), 'url' => '/account/admin'),
    array('title' => lang('App.visit_stats'))
);
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <!--Content-->
    <div class="col-12">
        <h3><?= lang('App.visit_stats') ?></h3>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <i class="ri-grid-line me-1"></i>
                <?= lang('App.visit_stats') ?>
                <span class="badge rounded-pill bg-dark">
                    <?= $total_stats ?>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable-export">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?= lang('App.ip_address') ?></th>
                            <th><?= lang('App.device') ?></th>
                            <th><?= lang('App.browser') ?></th>
                            <th><?= lang('App.url') ?></th>
                            <th><?= lang('App.user') ?></th>
                            <th><?= lang('App.operating_system') ?></th>
                            <th><?= lang('App.country') ?></th>
                            <th><?= lang('App.visit_date') ?></th>
                            <th><?= lang('App.actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $rowCount = 1; ?>
                        <?php if($visit_stats): ?>
                            <?php foreach($visit_stats as $visit): ?>
                                <tr>
                                    <td><?= $rowCount; ?></td>
                                    <td>
                                        <span class="me-1 small"><?=IPIdentifierLabel($visit['ip_address'])?></span>
                                        <?= esc($visit['ip_address']) ?>
                                    </td>
                                    <td><?= esc($visit['device_type']) ?></td>
                                    <td><?= esc($visit['browser_type']) ?></td>
                                    <td><?= esc($visit['page_visited_url']) ?></td>
                                    <td>
                                        <span class="text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="User ID: <?= esc($visit['user_id']) ?>">
                                            <?= getActivityBy(esc($visit['user_id'])) ?>
                                        </span>
                                    </td>
                                    <td><?= esc($visit['operating_system']) ?></td>
                                    <td>
                                        <span class="fi fi-<?= strtolower((string)esc($visit['country'])) ?>"></span>
                                        <?= esc($visit['country']) ?>
                                    </td>
                                    <td><?= esc($visit['created_at']) ?></td>
                                    <td>
                                        <div class="row text-center p-1">
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 mb-1 view-stat" href="<?=base_url('account/admin/visit-stats/view-stat/'.esc($visit['site_stat_id']))?>">
                                                    <i class="h5 ri-eye-line"></i>
                                                </a>
                                            </div>
                                            <div class="col mb-1">
                                                <a class="text-dark td-none mr-1 remove-stat" href="#!" onclick="deleteRecord('site_stats', 'site_stat_id', '<?=$visit['site_stat_id'];?>', '', 'account/admin/visit-stats')">
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
    <?php
        if($total_stats > 1000){
            ?>
                <!--Show pagination if more than 100 records-->
                <div class="col-12 text-start">
                    <p><?= lang('App.pagination') ?></p>
                    <?= $pager->links('default', 'bootstrap') ?>
                </div>
            <?php
        }
    ?>
</div>
<div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="ri-information-line me-1"></i>
                    <?= lang('App.information_key_cdn') ?>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3"><i class="ri-circle-fill text-muted"></i></dt>
                        <dd class="col-sm-9"><?= lang('App.local_device') ?></dd>

                        <dt class="col-sm-3"><i class="ri-circle-fill text-primary"></i></dt>
                        <dd class="col-sm-9"><?= lang('App.cloudflare') ?></dd>

                        <dt class="col-sm-3"><i class="ri-circle-fill text-teal"></i></dt>
                        <dd class="col-sm-9"><?= lang('App.azure_cdn') ?></dd>

                        <dt class="col-sm-3"><i class="ri-circle-fill text-orange"></i></dt>
                        <dd class="col-sm-9"><?= lang('App.google_cdn') ?></dd>

                        <dt class="col-sm-3"><i class="ri-circle-fill text-success"></i></dt>
                        <dd class="col-sm-9"><?= lang('App.fastly') ?></dd>

                        <dt class="col-sm-3"><i class="ri-circle-fill text-info"></i></dt>
                        <dd class="col-sm-9"><?= lang('App.akamai') ?></dd>

                        <dt class="col-sm-3"><i class="ri-circle-fill text-warning"></i></dt>
                        <dd class="col-sm-9"><?= lang('App.cloudfront') ?></dd>

                        <dt class="col-sm-3"><i class="ri-circle-fill text-danger"></i></dt>
                        <dd class="col-sm-9"><?= lang('App.sucuri') ?></dd>

                        <dt class="col-sm-3"><i class="ri-circle-fill text-secondary"></i></dt>
                        <dd class="col-sm-9"><?= lang('App.nitropack') ?></dd>

                        <dt class="col-sm-3"><i class="ri-checkbox-blank-circle-line text-dark"></i></i></dt>
                        <dd class="col-sm-9"><?= lang('App.unknown') ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Check for enabling or disabling AI integration (sensitive data) -->
    <?php $enableGeminiAIAnalysis = getConfigData("EnableGeminiAIAnalysis"); ?>
    <?php if(strtolower($enableGeminiAIAnalysis) === "yes" && isValidGeminiKey()):?>
        <!--AI Analysis Setion-->
        <div class="row">
            <div class="col-12 my-3">
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
                                            hx-post="<?=base_url()?>/htmx/get-visit-stats-analysis-via-ai"
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

<!-- Include the delete script -->
<?=  $this->include('back-end/layout/assets/delete_prompt_script.php'); ?>

<!-- end main content -->
<?= $this->endSection() ?>