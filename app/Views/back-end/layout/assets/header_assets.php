<?php
    //get site config values
    $siteName = getConfigData("SiteName");
    $backendFaviconLink = getConfigData("BackendFaviconLink");
    $backendLogoLink = getConfigData("BackendLogoLink");
?>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<!--bootstrap cdn-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<!--datatables css-->
<link rel="stylesheet" href="https://cdn.datatables.net/2.2.0/css/dataTables.bootstrap5.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.bootstrap5.css">

<!-- SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.min.css">

<!--toastr css-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css">

<!--style css-->
<link href="<?= base_url('public/back-end/assets/css/style.css')?>" rel="stylesheet" />

<!--summernote css-->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

<!-- cropper css -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">

<!-- jQuery-Tags-Input css cdn -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.css" />

<!-- jqueryui css cdn -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.0/themes/base/jquery-ui.min.css">

<!-- include libraries (CodeMirror, Dracula theme) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/theme/dracula.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/codemirror.min.css" rel="stylesheet">

<!--remix icons-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">

<!--flag-icon-css-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css"/>

<!--select2 css-->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Chart.js CDN -->
<script async src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css">

<!-- jquery.timepicker CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

<!-- Tempus Dominus CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.7.7/dist/css/tempus-dominus.min.css">

<!--Syntax JS CSS-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/williamtroup/Syntax.js@3.1.0/dist/syntax.js.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/williamtroup/Syntax.js@3.1.0/dist/themes/syntax.js.dark.theme.css" />

<!--custom css-->
<link href="<?= base_url('public/back-end/assets/css/custom.css')?>" rel="stylesheet" />

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!--favicon-->
<?php if (!empty($backendFaviconLink)): ?>
    <link rel="icon" href="<?= getImageUrl($backendFaviconLink ?? getDefaultImagePath()) ?>" type="image/x-icon">
<?php endif; ?>

<!--favicon [https://realfavicongenerator.net/]-->
<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('public/back-end/assets/img/favicon/apple-touch-icon.png')?>">
<link rel="icon" type="image/png" sizes="48x48" href="<?= base_url('public/back-end/assets/img/favicon/favicon-48x48.png')?>">
<link rel="icon" type="image/svg+xml" href="<?= base_url('public/back-end/assets/img/favicon/favicon.svg')?>" />
<link rel="shortcut icon" href="<?= base_url('public/back-end/assets/img/favicon/favicon.ico')?>" />
<link rel="manifest" href="<?= base_url('public/back-end/assets/img/favicon/site.webmanifest')?>" />