<?php
$pageType = 'home';
require __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'Motozo — Scrap & Sell Your Old Vehicle at the Best Price';
?>
<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . '/includes/head.php'; ?>
<body>
  <a class="skip-link" href="#main">Skip to content</a>
  <?php include __DIR__ . '/sections/header.php'; ?>
  <main id="main">
    <?php include __DIR__ . '/sections/hero.php'; ?>
    <?php include __DIR__ . '/sections/stats.php'; ?>
    <?php include __DIR__ . '/sections/marquee.php'; ?>
    <?php include __DIR__ . '/sections/manifesto.php'; ?>
    <?php include __DIR__ . '/sections/how-it-works.php'; ?>
    <?php include __DIR__ . '/sections/why-motozo.php'; ?>
    <?php include __DIR__ . '/sections/materials.php'; ?>
    <?php include __DIR__ . '/sections/lot-form.php'; ?>
    <?php include __DIR__ . '/sections/faq.php'; ?>
    <?php include __DIR__ . '/sections/cta.php'; ?>
  </main>
  <?php include __DIR__ . '/sections/footer.php'; ?>
  <?php include __DIR__ . '/includes/scripts.php'; ?>
</body>
</html>