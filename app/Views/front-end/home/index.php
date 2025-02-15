<!-- include layout -->
<?= $this->extend('front-end/layout/_layout') ?>

<!-- begin main content -->
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12 mb-4 text-center">
        <h1>About this page</h1>

        <p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

        <p>If you would like to edit this page you will find it located at:</p>

        <pre><code>app/Views/FrontEnd/Home/index.php</code></pre>

        <p>The corresponding controller for this page can be found at:</p>

        <pre><code>app/Controllers/HomeController.php</code></pre>
    </div>
</div>

<!-- end main content -->
<?= $this->endSection() ?>