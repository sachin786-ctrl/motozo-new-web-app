<?php
$pageType = 'privacy';
require __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'Privacy Policy | Motozo — Transparent & Legal Vehicle Scrapping';
$pageDesc  = 'Learn how Motozo protects your privacy, personal information, and vehicle documents in full compliance with Government of India vehicle scrapping policies.';
$canonical = (defined('BASE') ? rtrim(BASE, '/') : '') . '/privacy.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/includes/head.php'; ?>
<body>
  <a class="skip-link" href="#main">Skip to content</a>
  <?php include __DIR__ . '/sections/header.php'; ?>
  <main id="main">
    <?php include __DIR__ . '/sections/privacy.php'; ?>
  </main>
  <?php include __DIR__ . '/sections/footer.php'; ?>
  <?php include __DIR__ . '/includes/scripts.php'; ?>
</body>
</html>
