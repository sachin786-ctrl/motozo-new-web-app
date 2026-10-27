<?php
declare(strict_types=1);

$districtSlug = 'delhi';
$pageType     = 'district';

require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/config/district_pages.php';

$districtData = getDistrictPageData($districtSlug);
$districtName = $districtData['name'];
$pageTitle    = $districtData['meta_title'];
$pageDesc     = $districtData['meta_desc'];
$canonical    = (defined('BASE') ? rtrim(BASE, '/') : '') . '/car-scrap-dealer-' . $districtSlug . '.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/includes/head.php'; ?>
<body>
  <a class="skip-link" href="#main">Skip to content</a>
  <?php include __DIR__ . '/sections/header.php'; ?>

  <main id="main">
    <?php include __DIR__ . '/sections/hero.php'; ?>
    <?php include __DIR__ . '/district/stats.php'; ?>
    <?php include __DIR__ . '/district/process.php'; ?>
    <?php include __DIR__ . '/district/rules.php'; ?>
    <?php include __DIR__ . '/district/coverage.php'; ?>
    <?php include __DIR__ . '/district/faq.php'; ?>
  </main>

  <?php include __DIR__ . '/sections/footer.php'; ?>
  <?php include __DIR__ . '/includes/scripts.php'; ?>
</body>
</html>
