<?php
//cookie concent
$useCookieConcent = getConfigData("UseCookieConcent");
$cookieConcentCode = getConfigData("CookieConcentCode");

//google translate
$enableGoogleTranslate = getConfigData("EnableGoogleTranslate");
?>

<?php
if (strtolower($useCookieConcent) === "yes") {
    echo $cookieConcentCode;
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

