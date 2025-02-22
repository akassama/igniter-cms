<?php
//cookie concent
$useCookieConcent = getConfigData("UseCookieConcent");
$cookieConcentCode = getConfigData("CookieConcentCode");

//facebook pixel settings
$useFacebookPixel = getConfigData("UseFacebookPixel");
$facebookPixelCode = getConfigData("FacebookPixelCode");

//google translate
$enableGoogleTranslate = getConfigData("EnableGoogleTranslate");
?>

<?php
if (strtolower($useCookieConcent) === "yes") {
    echo $cookieConcentCode;
}
?>

<?php
if (strtolower($useFacebookPixel) === "yes") {
    echo $facebookPixelCode;
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

