<!-- include layout -->
<?= $this->extend('back-end/layout/_layout') ?>

<!-- page title -->
<?= $this->section('title') ?>
    <?= lang('App.language') ?>
<?= $this->endSection() ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<?php
// Breadcrumbs
$breadcrumb_links = [
    ['title' => lang('App.dashboard'), 'url' => '/account'],
    ['title' => lang('App.settings'), 'url' => '/account/settings'],
    ['title' => lang('App.language')],
];
echo generateBreadcrumb($breadcrumb_links);
?>

<div class="row">
    <div class="col-12 mb-4">
        <h3 class="mb-0"><?= lang('App.language') ?></h3>
        <p class="text-muted"><?= lang('App.switch_language') ?></p>
    </div>

    <div class="col-12 bg-light rounded p-4 shadow-sm">
        <div class="row align-items-center mb-4">
            <?php
            $config = config('App');
            $currentLocale = getCurrentLocale();
            $supportedLocales = $config->supportedLocales;
            ?>
            <div class="col-auto">
                <span class="text-muted me-2"><?= lang('App.current_locale') ?>:</span>
                <span class="fw-bold text-primary">
                    <i class="fi <?= getLocaleFlagClass($currentLocale) ?> me-1"></i>
                    <?= getLocaleDisplayName($currentLocale) ?>
                </span>
            </div>

            <div class="col-auto ms-auto">
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ri-global-line me-2"></i>
                        <?= lang('App.select_language') ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                        <?php foreach ($supportedLocales as $locale): ?>
                            <li>
                                <a class="dropdown-item d-flex align-items-center <?= ($locale == $currentLocale) ? 'active' : '' ?>"
                                   href="<?= base_url('language/switch/' . $locale) ?>">
                                    <i class="fi <?= getLocaleFlagClass($locale) ?> me-2"></i>
                                    <span><?= getLocaleDisplayName($locale) ?></span>
                                    <?php if ($locale == $currentLocale): ?>
                                        <i class="ri-check-line ms-auto"></i>
                                    <?php endif; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

        </div>

        <hr class="my-4">

        <div class="d-flex justify-content-between align-items-center">
            <a href="<?= base_url('/account/settings') ?>" class="btn btn-outline-secondary">
                <i class="ri-arrow-left-fill me-1"></i>
                <?= lang('App.back') ?>
            </a>
        </div>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>