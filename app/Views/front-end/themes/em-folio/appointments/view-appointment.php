<?php
// Get current theme impact
$theme = getCurrentTheme();

//popup settings
$currentPage = "appointments";
$popUpWhereClause = ['status' => 1];
$showOnPages = getTableData('announcement_popups', $popUpWhereClause, 'show_on_pages');
$enablePopupAds = getConfigData("EnablePopupAds");

//update view count
updateTotalViewCount("appointments", "appointment_id", $appointment_data['appointment_id']);
?>
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<?= $this->section('content') ?>

<section id="post-details" class="section">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?=base_url('/appointments')?>">Appointments</a></li>
                <li class="breadcrumb-item active" aria-current="page">Appointment Details</li>
            </ol>
        </nav>

        <div class="row gx-5">
            <div class="col-12">
                <article>
                    <header class="mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h1 class="fw-bolder mb-1"><?= esc($appointment_data['title']) ?></h1>
                            <a href="javascript:location.reload()" class="btn btn-outline-secondary btn-sm d-flex align-items-center">
                                <i class="ri-refresh-line me-1"></i> Reload Page
                            </a>
                        </div>
                        <?php if (!empty($appointment_data['description'])): ?>
                            <p class="lead text-muted mb-4"><?= esc($appointment_data['description']) ?></p>
                        <?php endif; ?>
                        <div class="badge bg-primary bg-gradient rounded-pill mb-2">
                            Powered by <?= esc(ucfirst($appointment_data['appointment_type'])); ?>
                        </div>
                    </header>

                    <section class="mb-5">
                        <?php
                        // Hardcoded height and min-width for the widget
                        $widgetRenderHeight   = '900px';
                        $widgetRenderMinWidth = '320px';

                        // Get widget parameters from $appointment_data
                        $type           = $appointment_data['appointment_type'];
                        $embedUrl       = esc($appointment_data['embed_url']);
                        $embedScript    = $appointment_data['embed_script']; // Not escaped as it's raw HTML/JS
                        $languageCode   = esc($appointment_data['language_code'] ?? 'en'); // Still using language_code if available
                        ?>

                        <div class="embed-responsive embed-responsive-16by9" style="position: relative; height: <?= $widgetRenderHeight ?>; min-width: <?= $widgetRenderMinWidth ?>; overflow: auto;">
                            <?php
                            switch ($type) {
                                case 'calendly':
                                    ?>
                                    <div class="calendly-inline-widget" data-url="<?= $embedUrl ?>" style="min-width:<?= $widgetRenderMinWidth ?>;height:<?= $widgetRenderHeight ?>;"></div>
                                    <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js"></script>
                                    <link href="https://assets.calendly.com/assets/external/widget.css" rel="stylesheet">
                                    <?php
                                    break;
                                //TODO implement other calendars
                                default:
                                    // Fallback for unsupported types or if no embed code is provided
                                    ?>
                                    <div class="alert alert-warning" role="alert">
                                        Booking widget for type '<?= esc($type) ?>' is not configured or supported.
                                        Please contact us or try again later.
                                    </div>
                                    <?php
                                    // If embed_script is provided for 'other' types, render it.
                                    if (!empty($embedScript)) {
                                        // This is raw HTML/JS output. Ensure its source is trusted.
                                        echo $embedScript;
                                    } else {
                                        echo '<p class="text-center">No embed code available for this appointment type.</p>';
                                    }
                                    break;
                            }
                            ?>
                        </div>
                    </section>
                </article>
            </div>
        </div>
    </div>
</section>


<?php
// Check if popups should be shown
if (strtolower($enablePopupAds) === "yes" && in_array($currentPage, explode(',', $showOnPages))) {
    ?>
        <?= $this->include('front-end/themes/_shared/_advert_popups.php'); ?>
    <?php
}
?>

<?= $this->endSection() ?>