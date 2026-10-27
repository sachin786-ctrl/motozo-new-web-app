<?php
$pageType = 'contact';
require __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'Contact Us | Motozo — Get in Touch with Vehicle Scrappage Specialists';
$pageDesc  = 'Have questions about vehicle scrapping, valuation, free doorstep pickup, or Govt. Certificate of Deposit (COD)? Contact the Motozo support team.';
$canonical = (defined('BASE') ? rtrim(BASE, '/') : '') . '/contact.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/includes/head.php'; ?>
<body>
  <a class="skip-link" href="#main">Skip to content</a>
  <?php include __DIR__ . '/sections/header.php'; ?>
  <main id="main">
    <?php include __DIR__ . '/sections/contact.php'; ?>
  </main>
  <?php include __DIR__ . '/sections/footer.php'; ?>
  <?php include __DIR__ . '/includes/scripts.php'; ?>
</body>
</html>
