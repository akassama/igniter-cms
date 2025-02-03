<?php
//log error
log_message('error', $message);

//log visit
$currentUrl = current_url();
logSiteStatistic(
    getDeviceIP(),
    getDeviceType(),
    getBrowserName(),
    getPageType($currentUrl),
    getPageId($currentUrl),
    $currentUrl,
    getReferrer(),
    404,
    getLoggedInUserId(),
    session_id(),
    getReguestMethod(),
    getOperatingSystem(),
    getCountry(),
    getScreenResolution(),
    getUserAgent(),
    null
)
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= lang('Errors.pageNotFound') ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/livecanvas-team/ninjabootstrap/dist/css/bootstrap.min.css" media="all">
</head>

<body>
<section class="d-flex align-items-center min-vh-100 py-5">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-md-6 order-md-2">
                <div class="lc-block">
                    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                    <lottie-player src="https://assets9.lottiefiles.com/packages/lf20_kcsr6fcp.json" background="transparent" speed="1" loop="" autoplay=""></lottie-player>
                </div><!-- /lc-block -->
            </div><!-- /col -->
            <div class="col-md-6 text-center text-md-start ">
                <div class="lc-block mb-3">
                    <div editable="rich">
                        <h1 class="fw-bold h4">PAGE NOT FOUND!<br></h1>
                    </div>
                </div>
                <div class="lc-block mb-3">
                    <div editable="rich">
                        <h1 class="display-1 fw-bold text-danger">Error 404</h1>

                    </div>
                </div><!-- /lc-block -->
                <div class="lc-block mb-5">
                    <div editable="rich">
                        <p class="rfs-11 fw-light"> The page you are looking for was moved, removed or might never existed.</p>
                    </div>
                </div>
                <!-- /lc-block -->
                <div class="lc-block">
                    <a class="btn btn-lg btn-primary" href="<?= base_url('/'); ?>" role="button">Back to homepage</a>
                </div>
                <!-- /lc-block -->
            </div><!-- /col -->
        </div>
        <div class="row text-center mt-5">
            <div class="text-danger">
                <?php if (ENVIRONMENT !== 'production') : ?>
                    <?= nl2br(esc($message)) ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

