<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title><?= lang('Errors.whoops') ?></title>
    
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
            <h1 class="headline"><?= lang('Errors.whoops') ?></h1>
            <p class="lead"><?= lang('Errors.weHitASnag') ?></p>
            
            <a href="<?= base_url()?>" class="btn btn-primary btn-lg mt-4">Go Back to Home</a>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script async src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>