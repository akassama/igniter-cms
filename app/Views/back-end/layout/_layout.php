<?php
$session = session();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $this->renderSection('title') ?: 'Account'; ?> - <?=getConfigData("SiteName");?></title>

    <!-- Include the header assets -->
    <?= $this->include('back-end/layout/assets/header_assets.php'); ?>
</head>
<body class="sb-nav-fixed">
    
  <!-- Preloader -->
  <div id="preloader">
    <div class="loader"></div>
  </div>

<!-- Include the nav -->
<?=  $this->include('back-end/layout/back_end_nav.php'); ?>

<div id="layoutSidenav">
    <!-- Include left sidebar -->
    <?=  $this->include('back-end/layout/left_sidebar.php'); ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <!-- Include password change checker -->
                <?=  $this->include('back-end/layout/assets/password_change_checker.php'); ?>
                
                <?= $this->renderSection('content') ?>
            </div>
        </main>
        <!-- Include the footer -->
        <?=  $this->include('back-end/layout/footer.php'); ?>
    </div>
</div>
<!-- Include the footer_assets -->
<?=  $this->include('back-end/layout/assets/footer_assets.php'); ?>

<!-- Include sweet_alerts-->
<?=  $this->include('back-end/layout/assets/sweet_alerts.php'); ?>

<!--Load Plugin Helpers-->
<?=loadPlugin("admin")?>
</body>
</html>
