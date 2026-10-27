<?php
$pageType = 'terms';
require __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'Terms & Conditions | Motozo — Official Scrapping Terms of Service';
$pageDesc  = 'Read the terms and conditions for using Motozo\'s vehicle valuation, doorstep pickup, and authorized RVSF vehicle scrapping services.';
$canonical = (defined('BASE') ? rtrim(BASE, '/') : '') . '/terms.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/includes/head.php'; ?>
<body>
  <a class="skip-link" href="#main">Skip to content</a>
  <?php include __DIR__ . '/sections/header.php'; ?>
  <main id="main">
    <?php include __DIR__ . '/sections/terms.php'; ?>
  </main>
  <?php include __DIR__ . '/sections/footer.php'; ?>
  <?php include __DIR__ . '/includes/scripts.php'; ?>
</body>
</html>
