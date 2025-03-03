<?php
use App\Constants\ActivityTypes;

//log error
log_message('error', $message);

//log visit
$currentUrl = current_url();
$ipAddress = getDeviceIP();
$country = getCountry();
logSiteStatistic(
    $ipAddress,
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
    $country,
    getScreenResolution(),
    getUserAgent(),
    null
);

//check if suspicius activity and add to block ip
if(isBlockedRoute($currentUrl)){
    //log ip as black listed
    $reason = ActivityTypes::BLOCKED_IP_SUSPICIOUS_ACTIVITY;
    $blockEndTime = date('Y-m-d H:i:s', strtotime(getConfigData("BlockedIPSuspensionPeriod")));
    addBlockedIPAdress($ipAddress, $country, $currentUrl, $blockEndTime, $reason);

    //log activity
    logActivity("User IP: ".$ipAddress , $reason, 'Suspicious user activity with IP: ' . $ipAddress);
}

//check if blocked ip
if(isBlockedIP($ipAddress)){
    echo 'Your IP address has been blocked.';
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title><?= lang('Errors.pageNotFound') ?></title>
    
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
            <h1 class="headline">404 - PAGE NOT FOUND!</h1>
            <p class="lead">The page you are looking for was moved, removed or might never existed.</p>
            
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
