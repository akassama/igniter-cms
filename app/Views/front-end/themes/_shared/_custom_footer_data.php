<?php
//chatbot
$enableChatbot = getConfigData("EnableChatbot");
$chatbotCode = getConfigData("ChatbotCode");

//payment gateway (TODO)
$enablePaymentGateway = getConfigData("EnablePaymentGateway");
$stripeAPIKey = getConfigData("StripeAPIKey");

//share this
$useShareThis = getConfigData("UseShareThis");
$ShareThisCode = getConfigData("ShareThisCode");

//google analytics
$useGoogleAnalytics = getConfigData("UseGoogleAnalytics");
$googleAnalyticsCode = getConfigData("GoogleAnalyticsCode");

//posthog analytics
$usePostHog = getConfigData("UsePostHog");
$postHogCode = getConfigData("PostHogCode");

//disqus comments
$enableDisqusCommentCount = getConfigData("EnableDisqusCommentCount");
$disqusShortName = rtrim(getConfigData("DisqusShortName"), '/');
?>

<?php
if (strtolower($enableChatbot) === "yes") {
    echo $chatbotCode;
}
?>

<?php
if (strtolower($useShareThis) === "yes") {
    echo $ShareThisCode;
}
?>

<?php
if (strtolower($useGoogleAnalytics) === "yes") {
    echo $googleAnalyticsCode;
}
?>

<?php
if (strtolower($usePostHog) === "yes") {
    echo $postHogCode;
}
?>

<?php
if (strtolower($enableDisqusCommentCount) === "yes") {
?>
    <script id="dsq-count-scr" src="<?= $disqusShortName ?>/count.js" async></script>
<?php
}
?>



