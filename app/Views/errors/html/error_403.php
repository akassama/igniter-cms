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
    400,
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>403 - Forbidden</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .error-container {
            margin-top: 10%;
        }
        .headline {
            font-size: 4rem;
            font-weight: bold;
            color: #dc3545;
        }
        .lead {
            font-size: 1.5rem;
            color: #6c757d;
        }
    </style>
</head>
<body>

<div class="container text-center error-container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <h1 class="headline">403 - FORBIDDEN!</h1>
            <p class="lead">You don't have permission to access this resource.</p>
            <p class="lead">Perhaps you are trying to access a page you don't have the necessary credentials for or your session has timed out.</p>
            
            <a href="<?= base_url()?>" class="btn btn-primary btn-lg mt-4">Go Back to Home</a>
        </div>
    </div>
    <div class="row text-center mt-5">
        <div class="text-danger">
            <?php if (ENVIRONMENT !== 'production') : ?>
                <?= nl2br(esc($message)) ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script async src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

