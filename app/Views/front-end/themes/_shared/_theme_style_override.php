<?php
// Get current theme
$theme = getCurrentTheme();

// Get theme data
$themeData = [
    'customCSS' => getTableData('codes', ['code_for' => 'CSS'], 'code'),
    'customJSTop' => getTableData('codes', ['code_for' => 'HeaderJS'], 'code'),
    'customJSFooter' => getTableData('codes', ['code_for' => 'FooterJS'], 'code'),
    'primaryColor' => getThemeData($theme, "primary_color"),
    'secondaryColor' => getThemeData($theme, "secondary_color"),
    'backgroundColor' => getThemeData($theme, "background_color"),
];

?>

<?php
// Theme color variables
$primaryColor = $themeData['primaryColor'];  
$secondaryColor = $themeData['secondaryColor'];
$backgroundColor = $themeData['backgroundColor'];
?>

<style>
/* Override Bootstrap 5 CSS Custom Properties */
:root {
    --bs-primary: <?php echo $primaryColor; ?>;
    --bs-primary-rgb: <?php echo implode(',', hexToRgb($primaryColor)); ?>;
    --bs-secondary: <?php echo $secondaryColor; ?>;
    --bs-secondary-rgb: <?php echo implode(',', hexToRgb($secondaryColor)); ?>;
    --bs-body-bg: <?php echo $backgroundColor; ?>;
    --bs-body-bg-rgb: <?php echo implode(',', hexToRgb($backgroundColor)); ?>;
}

/* Primary Elements */
.btn-primary {
    background-color: <?php echo $primaryColor; ?> !important;
    border-color: <?php echo $primaryColor; ?> !important;
}

.btn-primary:hover, .btn-primary:focus, .btn-primary:active {
    background-color: <?php echo adjustBrightness($primaryColor, -15); ?> !important;
    border-color: <?php echo adjustBrightness($primaryColor, -15); ?> !important;
}

.btn-outline-primary {
    color: <?php echo $primaryColor; ?> !important;
    border-color: <?php echo $primaryColor; ?> !important;
}

.btn-outline-primary:hover, .btn-outline-primary:focus, .btn-outline-primary:active {
    background-color: <?php echo $primaryColor; ?> !important;
    border-color: <?php echo $primaryColor; ?> !important;
}

/* Secondary Elements */
.btn-secondary {
    background-color: <?php echo $secondaryColor; ?> !important;
    border-color: <?php echo $secondaryColor; ?> !important;
}

.btn-secondary:hover, .btn-secondary:focus, .btn-secondary:active {
    background-color: <?php echo adjustBrightness($secondaryColor, -15); ?> !important;
    border-color: <?php echo adjustBrightness($secondaryColor, -15); ?> !important;
}

/* Background */
body {
    background-color: <?php echo $backgroundColor; ?> !important;
}

/* Navigation */
.navbar-brand {
    color: <?php echo $primaryColor; ?> !important;
}

.bg-primary {
    background-color: <?php echo $primaryColor; ?> !important;
}

.bg-secondary {
    background-color: <?php echo $secondaryColor; ?> !important;
}

/* Links */
.link-primary {
    color: <?php echo $primaryColor; ?> !important;
}

.link-primary:hover, .link-primary:focus {
    color: <?php echo adjustBrightness($primaryColor, -15); ?> !important;
}

.link-secondary {
    color: <?php echo $secondaryColor; ?> !important;
}

/* Text Colors */
.text-primary {
    color: <?php echo $primaryColor; ?> !important;
}

.text-secondary {
    color: <?php echo $secondaryColor; ?> !important;
}

/* Borders */
.border-primary {
    border-color: <?php echo $primaryColor; ?> !important;
}

.border-secondary {
    border-color: <?php echo $secondaryColor; ?> !important;
}

/* Form Controls */
.form-control:focus, .form-select:focus {
    border-color: <?php echo lightenColor($primaryColor, 25); ?> !important;
    box-shadow: 0 0 0 0.25rem <?php echo hexToRgba($primaryColor, 0.25); ?> !important;
}

.form-check-input:checked {
    background-color: <?php echo $primaryColor; ?> !important;
    border-color: <?php echo $primaryColor; ?> !important;
}

/* Progress Bars */
.progress-bar {
    background-color: <?php echo $primaryColor; ?> !important;
}

.progress-bar-striped {
    background-color: <?php echo $primaryColor; ?> !important;
}

/* Badges */
.badge.bg-primary {
    background-color: <?php echo $primaryColor; ?> !important;
}

.badge.bg-secondary {
    background-color: <?php echo $secondaryColor; ?> !important;
}

/* Alerts */
.alert-primary {
    color: <?php echo darkenColor($primaryColor, 30); ?> !important;
    background-color: <?php echo lightenColor($primaryColor, 40); ?> !important;
    border-color: <?php echo lightenColor($primaryColor, 25); ?> !important;
}

/* Pagination */
.pagination .page-link {
    color: <?php echo $primaryColor; ?> !important;
}

.pagination .page-item.active .page-link {
    background-color: <?php echo $primaryColor; ?> !important;
    border-color: <?php echo $primaryColor; ?> !important;
}

.pagination .page-link:hover {
    color: <?php echo adjustBrightness($primaryColor, -15); ?> !important;
}

/* Dropdown */
.dropdown-item:active {
    background-color: <?php echo $primaryColor; ?> !important;
}

/* List Groups */
.list-group-item.active {
    background-color: <?php echo $primaryColor; ?> !important;
    border-color: <?php echo $primaryColor; ?> !important;
}

/* Nav Pills/Tabs */
.nav-pills .nav-link.active {
    background-color: <?php echo $primaryColor; ?> !important;
}

.nav-tabs .nav-link.active {
    color: <?php echo $primaryColor; ?> !important;
}

/* Accordion */
.accordion-button:not(.collapsed) {
    color: <?php echo $primaryColor; ?> !important;
    background-color: <?php echo lightenColor($primaryColor, 45); ?> !important;
}

.accordion-button:focus {
    border-color: <?php echo lightenColor($primaryColor, 25); ?> !important;
    box-shadow: 0 0 0 0.25rem <?php echo hexToRgba($primaryColor, 0.25); ?> !important;
}

/* Icon Colors and Visibility */
.btn-primary i, .btn-primary .fa, .btn-primary .fas, .btn-primary .far, .btn-primary .fab,
.bg-primary i, .bg-primary .fa, .bg-primary .fas, .bg-primary .far, .bg-primary .fab {
    color: <?php echo getContrastColor($primaryColor); ?> !important;
}

.btn-secondary i, .btn-secondary .fa, .btn-secondary .fas, .btn-secondary .far, .btn-secondary .fab,
.bg-secondary i, .bg-secondary .fa, .bg-secondary .fas, .bg-secondary .far, .bg-secondary .fab {
    color: <?php echo getContrastColor($secondaryColor); ?> !important;
}

/* Bootstrap Icons */
.bi {
    color: inherit !important;
}

.text-primary .bi, .link-primary .bi {
    color: <?php echo $primaryColor; ?> !important;
}

.text-secondary .bi, .link-secondary .bi {
    color: <?php echo $secondaryColor; ?> !important;
}

/* Icon buttons and links */
.btn-outline-primary:hover i, .btn-outline-primary:hover .fa, .btn-outline-primary:hover .bi {
    color: <?php echo getContrastColor($primaryColor); ?> !important;
}

.btn-outline-secondary:hover i, .btn-outline-secondary:hover .fa, .btn-outline-secondary:hover .bi {
    color: <?php echo getContrastColor($secondaryColor); ?> !important;
}
</style>

<?php
// Helper functions for color manipulation
function hexToRgb($hex) {
    $hex = ltrim($hex, '#');
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
    }
    return [
        hexdec(substr($hex, 0, 2)),
        hexdec(substr($hex, 2, 2)),
        hexdec(substr($hex, 4, 2))
    ];
}

function rgbToHex($r, $g, $b) {
    return sprintf("#%02x%02x%02x", $r, $g, $b);
}

function hexToRgba($hex, $alpha) {
    $rgb = hexToRgb($hex);
    return "rgba({$rgb[0]}, {$rgb[1]}, {$rgb[2]}, $alpha)";
}

function adjustBrightness($hex, $percent) {
    $rgb = hexToRgb($hex);
    foreach ($rgb as &$color) {
        $color = max(0, min(255, $color + ($color * $percent / 100)));
    }
    return rgbToHex($rgb[0], $rgb[1], $rgb[2]);
}

function lightenColor($hex, $percent) {
    return adjustBrightness($hex, $percent);
}

function darkenColor($hex, $percent) {
    return adjustBrightness($hex, -$percent);
}

function getContrastColor($hex) {
    $rgb = hexToRgb($hex);
    $brightness = ($rgb[0] * 299 + $rgb[1] * 587 + $rgb[2] * 114) / 1000;
    return $brightness > 128 ? '#000000' : '#ffffff';
}
?>