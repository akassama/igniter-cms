<?php
// This is to get current impact
$theme = getCurrentTheme();

//page settings
$currentPage = "home";
$popUpWhereClause = ['status' => 1];

$enableHomeSeo = getTableData('plugin_configs', ['plugin_slug' => 'seo-master', 'config_key' => 'enable_home_seo'], 'config_value');
?>

<!-- include theme layout -->
<?= $this->extend('front-end/themes/'.$theme.'/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>
  <!-- ////// BEGIN Get Home Pages ///// -->
  <h1><?=$enableHomeSeo?></h1>
  <!-- ////// END Home Pages ///// -->


<!-- end main content -->
<?= $this->endSection() ?>


