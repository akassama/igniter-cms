<?php
//cookie concent
$useCookieConcent = getConfigData("UseCookieConcent");
$cookieConcentCode = getConfigData("CookieConcentCode");

//chatbot
$enableChatbot = getConfigData("EnableChatbot");
$chatbotCode = getConfigData("ChatbotCode");

//payment gateway
$enablePaymentGateway = getConfigData("EnablePaymentGateway");
$stripeAPIKey = getConfigData("StripeAPIKey");

//share this
$useShareThis = getConfigData("UseShareThis");
$ShareThisCode = getConfigData("ShareThisCode");

//google analytics
$useGoogleAnalytics = getConfigData("UseGoogleAnalytics");
$googleTagManagerHead = getConfigData("GoogleTagManagerHead");
$googleTagManagerBody = getConfigData("GoogleTagManagerBody");

//cookie concent
$enableSocialAutoPosting = getConfigData("EnableSocialAutoPosting");
$useFacebookPixel = getConfigData("UseFacebookPixel");
$facebookPixelCode = getConfigData("FacebookPixelCode");
$facebookPageAccessToken = getConfigData("FacebookPageAccessToken");

//twitter feed
$useTwitterFeed = getConfigData("UseTwitterFeed");
$twitterFeedCode = getConfigData("TwitterFeedCode");

//payment gateway
$enablePaymentGateway = getConfigData("EnablePaymentGateway");
$stripeAPIKey = getConfigData("StripeAPIKey");

//chatbot
$enableChatbot = getConfigData("EnableChatbot");
$chatbotAPIKey = getConfigData("ChatbotAPIKey");

//google translate
$enableGoogleTranslate = getConfigData("EnableGoogleTranslate");
?>

<?php
if (strtolower($useCookieConcent) === "yes") {
    echo $cookieConcentCode;
}
?>

<?php
if (strtolower($useShareThis) === "yes") {
    echo $ShareThisCode;
}
?>


<?php
if (strtolower($enableGoogleTranslate) === "yes" && !empty(getLanguagesList())) {
?>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages : '<?= getLanguagesList() ?>'}, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<?php
}
?>

