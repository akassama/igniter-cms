<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sitemap</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>

<div class="container">
  <h1>Sitemap</h1>
  <p>This is an XML Sitemap, meant for consumption by search engines. Please note it may not include every page on the website.</p>

  <?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

  <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
                             http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    </urlset>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>URL</th>
                <th>Last Modified</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <a href="<?= base_url() ?>" class="text-dark">
                        <?= base_url() ?>
                    </a>
                </td>
                <td>
                    <?= (new DateTime())->format('Y-m-d\TH:i:sP') ?>
                </td>
            </tr>
            <?php foreach ($sitemapData as $section => $items): ?>
                <?php foreach ($items as $item): ?>
                    <?php $pageUrl = $section === "page" ? base_url($item['slug']) : base_url($section . '/' . $item['slug']) ?>
                    <tr>
                        <td>
                            <a href="<?= $pageUrl ?>" class="text-dark">
                                <?= $pageUrl ?>
                            </a>
                        </td>
                        <td>
                            <?= !empty($item['updated_at']) ? date(DATE_W3C, strtotime($item['updated_at'])) : date(DATE_W3C, strtotime($item['created_at'])) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVFQWrvVuHdBsCTSmIJaJaMTBxGtDQAqOoHwfXqUj83hqxW/AVHC" crossorigin="anonymous"></script>

</body>
</html>