<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/../config/district_pages.php';

$districts = require __DIR__ . '/../config/districts.php';
$slug = strtolower(trim((string)($_GET['district'] ?? '')));

if (!preg_match('/^[a-z0-9-]+$/', $slug) || !isset($districts[$slug])) {
    http_response_code(404);
    exit('Page not found');
}

$pageType     = 'district';
$districtSlug = $slug;
$districtData = getDistrictPageData($districtSlug);
$districtName = $districtData['name'];
$pageTitle    = $districtData['meta_title'];
$pageDesc     = $districtData['meta_desc'];
$canonical    = (defined('BASE') ? rtrim(BASE, '/') : '') . '/car-scrap-dealer-' . $slug . '.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/../includes/head.php'; ?>
<body>
  <a class="skip-link" href="#main">Skip to content</a>
  <?php include __DIR__ . '/../sections/header.php'; ?>

  <main id="main">
    <?php include __DIR__ . '/../sections/hero.php'; ?>
    <?php include __DIR__ . '/../district/stats.php'; ?>
    <?php include __DIR__ . '/../district/process.php'; ?>
    <?php include __DIR__ . '/../district/rules.php'; ?>
    <?php include __DIR__ . '/../district/coverage.php'; ?>
    <?php include __DIR__ . '/../district/faq.php'; ?>
  </main>

  <?php include __DIR__ . '/../sections/footer.php'; ?>
  <?php include __DIR__ . '/../includes/scripts.php'; ?>
</body>
</html>