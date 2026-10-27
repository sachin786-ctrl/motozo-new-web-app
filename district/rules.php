<?php
/**
 * ============================================================================
 * DISTRICT RULES COMPONENT: district/rules.php
 * NGT & RTO Legal Scrappage Policy + Authorized vs Unauthorized Comparison
 * Self-Contained: HTML + Encapsulated CSS + JS (Bootstrap Icons required)
 * ============================================================================
 */
declare(strict_types=1);

$cityName      = $districtData['name'] ?? ($districtName ?? 'District');
$districtState = $districtData['state'] ?? 'NCR';
$districtSlug  = $districtData['slug'] ?? ($districtSlug ?? 'delhi');

$city  = htmlspecialchars((string)$cityName, ENT_QUOTES, 'UTF-8');
$state = htmlspecialchars((string)$districtState, ENT_QUOTES, 'UTF-8');

// RTO code hint
$rtoHints = [
  'delhi'     => 'DL RTO (All 14 Zones)',
  'noida'     => 'UP-16 RTO (Gautam Buddha Nagar)',
  'gurgaon'   => 'HR-26 / HR-98 RTO (Gurugram)',
  'ghaziabad' => 'UP-14 RTO (Ghaziabad)',
  'faridabad'     => 'HR-38 / HR-51 RTO (Faridabad)',
  'greater-noida' => 'UP-16 RTO (Greater Noida & Yamuna Expressway)',
  'jaipur'        => 'RJ-14 / RJ-45 RTO (Jaipur)',
  'rajasthan'     => 'All Rajasthan RTO Zones (RJ-01 to RJ-58)',
  'muzaffarnagar' => 'UP-12 RTO (Muzaffarnagar)',
];
$rtoLabel = htmlspecialchars((string)($districtData['rules']['eyebrow'] ?? ($rtoHints[$districtSlug] ?? ($cityName . ' Transport Department'))), ENT_QUOTES, 'UTF-8');
$rxTitle  = $districtData['rules']['title'] ?? 'Know The Rules. <span>Scrap Legally.</span>';
$rxSub    = $districtData['rules']['sub'] ?? ('Stay fully compliant with National Green Tribunal (NGT) and ' . $state . ' transport department regulations in ' . $city . ', and see why an authorized RVSF is the only safe way to scrap.');

/* Comparison rows: [label, icon, our value, other value] */
$compare = [
  ['Govt. Authorized RVSF',      'bi-patch-check',      'Fully Authorized',   'Unlicensed Yard'],
  ['VAHAN RC De-registration',   'bi-file-earmark-check','Certified & Done',  'Never Done'],
  ['Certificate of Deposit',     'bi-award',            'Issued (CoD)',       'Not Issued'],
  ['Road Tax Concession',        'bi-percent',          'Up to 25%',          'No Benefit'],
  ['Doorstep Flatbed Towing',    'bi-truck-flatbed',    'Free Pickup',        'Drive It Yourself'],
  ['Liability After Handover',   'bi-person-check',     'Zero Liability',     'Stays With You'],
  ['Eco-safe Disposal',          'bi-recycle',          'NGT Compliant',      'Unsafe Dumping'],
];
?>

<section class="d-rx" id="rules" aria-labelledby="d-rx-heading">
  <div class="container">

    <!-- ===== Header ===== -->
    <header class="d-rx-head" data-rx-reveal>
      <span class="d-rx-eyebrow"><i class="bi bi-shield-exclamation" aria-hidden="true"></i> <?= $rtoLabel ?></span>
      <h2 class="d-rx-title" id="d-rx-heading">
        <?= $rxTitle ?>
      </h2>
      <span class="d-rx-bar" aria-hidden="true"></span>
      <p class="d-rx-sub">
        <?= $rxSub ?>
      </p>
    </header>

    <!-- ===== Comparison table ===== -->
    <div class="d-rx-table-wrap" data-rx-reveal>
      <div class="d-rx-table" role="table" aria-label="Authorized RVSF versus unauthorized scrapyard comparison">
        <div class="d-rx-hl" aria-hidden="true"></div>

        <div class="d-rx-row d-rx-row--head" role="row">
          <div class="d-rx-cell d-rx-feat" role="columnheader">Features</div>
          <div class="d-rx-cell d-rx-us" role="columnheader">
            <span class="d-rx-brand">Motozo</span>
            <span class="d-rx-brand-sub">Authorized RVSF</span>
          </div>
          <div class="d-rx-cell d-rx-them" role="columnheader">
            <span class="d-rx-brand d-rx-brand--muted">Unauthorized</span>
            <span class="d-rx-brand-sub">Local Scrapyard</span>
          </div>
        </div>

        <?php foreach ($compare as $i => $r): ?>
          <div class="d-rx-row" role="row" style="--i:<?= $i ?>">
            <div class="d-rx-cell d-rx-feat" role="cell">
              <i class="bi <?= $r[1] ?>" aria-hidden="true"></i>
              <span><?= htmlspecialchars($r[0], ENT_QUOTES, 'UTF-8') ?></span>
            </div>
            <div class="d-rx-cell d-rx-us" role="cell">
              <i class="bi bi-check-circle-fill" aria-label="Yes"></i>
              <span><?= htmlspecialchars($r[2], ENT_QUOTES, 'UTF-8') ?></span>
            </div>
            <div class="d-rx-cell d-rx-them" role="cell">
              <i class="bi bi-x-circle-fill" aria-label="No"></i>
              <span><?= htmlspecialchars($r[3], ENT_QUOTES, 'UTF-8') ?></span>
            </div>
          </div>
        <?php endforeach; ?>

        <div class="d-rx-row d-rx-row--total" role="row">
          <div class="d-rx-cell d-rx-feat" role="cell"><span>Overall Outcome</span></div>
          <div class="d-rx-cell d-rx-us" role="cell"><b class="d-rx-pill d-rx-pill--ok">100% Protected</b></div>
          <div class="d-rx-cell d-rx-them" role="cell"><b class="d-rx-pill d-rx-pill--bad">High Legal Risk</b></div>
        </div>
      </div>
        </div>

  </div>
</section>

<style>
  .d-rx {
    --rx-green: var(--green-700, #1B692C);
    --rx-green-mid: #2b8a45;
    --rx-dark: #2b3a31;
    --rx-border: #d3e5d9;
    --rx-ink: var(--heading-color, #172319);
    --rx-text: var(--muted, #52645a);
    --rx-ease: cubic-bezier(.22, .8, .24, 1);
    /* column ratio: feature | motozo | other */
    --rx-c1: 1.25fr; --rx-c2: 1fr; --rx-c3: 1fr;

    padding: 5.5rem 0 5rem;
    background: var(#FCFCF7);
    border-top: 1px solid var(--section-border, rgba(27, 105, 44, .1));
    border-bottom: 1px solid var(--section-border, rgba(27, 105, 44, .1));
    overflow: hidden;
  }

  /* ---------- Reveal ---------- */
  .d-rx.is-js [data-rx-reveal] {
    opacity: 0; transform: translateY(28px);
    transition: opacity .8s var(--rx-ease), transform .9s var(--rx-ease);
    transition-delay: var(--d, 0s);
  }
  .d-rx.is-js [data-rx-reveal].is-in { opacity: 1; transform: none; }

  /* ---------- Header ---------- */
  .d-rx-head { max-width: 800px; margin: 0 auto 3.5rem; text-align: center; }
  .d-rx-eyebrow {
    display: inline-flex; align-items: center; gap: .5rem;
    padding: .4rem 1rem; margin-bottom: 1.1rem;
    background: #fff; border: 1px solid var(--green-100, #cfeedd); border-radius: 999px;
    color: var(--rx-green); font-size: .78rem; font-weight: 700;
    letter-spacing: .12em; text-transform: uppercase;
    box-shadow: 0 2px 8px rgba(27, 105, 44, .06);
  }
  .d-rx-title {
    font-family: var(--font-heading, inherit);
    font-size: clamp(2rem, 3.2vw, 3rem); font-weight: 800;
    line-height: 1.15; letter-spacing: -.02em; color: var(--rx-ink); margin: 0 0 1rem;
  }
  .d-rx-title span { color: var(--rx-green); }
  .d-rx-bar { display: block; width: 84px; height: 5px; border-radius: 5px; background: var(--rx-green); margin: 0 auto 1.25rem; transform-origin: center; }
  .d-rx.is-js .d-rx-head .d-rx-bar { transform: scaleX(0); transition: transform .9s var(--rx-ease) .5s; }
  .d-rx.is-js .d-rx-head.is-in .d-rx-bar { transform: scaleX(1); }
  .d-rx-sub { font-family: var(--font-body, inherit); font-size: 1.05rem; line-height: 1.65; color: var(--rx-text); margin: 0; }

  /* ---------- Comparison table ---------- */
  .d-rx-table-wrap { max-width: 920px; margin: 0 auto 4.5rem; padding: 20px 0; }

  .d-rx-table {
    position: relative;
    background: #fff; border: 1px solid var(--rx-border); border-radius: 24px;
    box-shadow: 0 16px 44px rgba(27, 105, 44, .08);
  }

  /* Highlight column that pops above & below the card */
  .d-rx-hl {
    position: absolute; z-index: 0;
    top: -20px; bottom: -20px;
    left: calc(100% * 1.25 / 3.25);
    width: calc(100% / 3.25);
    border-radius: 22px;
    background: linear-gradient(180deg, #46b062 0%, var(--rx-green-mid) 40%, var(--rx-green) 100%);
    box-shadow: 0 24px 50px rgba(27, 105, 44, .32);
    transform-origin: top center;
  }
  .d-rx.is-js .d-rx-hl { transform: scaleY(.2); opacity: 0; transition: transform 1s var(--rx-ease) .2s, opacity .6s ease .2s; }
  .d-rx.is-js .d-rx-table-wrap.is-in .d-rx-hl { transform: scaleY(1); opacity: 1; }

  .d-rx-row {
    position: relative; z-index: 1;
    display: grid; grid-template-columns: var(--rx-c1) var(--rx-c2) var(--rx-c3);
    align-items: stretch;
  }
  .d-rx-cell {
    display: flex; align-items: center; gap: .65rem;
    padding: 1.05rem 1.25rem; min-width: 0;
    font-size: .93rem; line-height: 1.35;
    border-bottom: 1px solid #e7f0ea;
    transition: background-color .3s ease;
  }
  .d-rx-us { justify-content: center; text-align: center; color: #fff; font-weight: 600; border-bottom-color: rgba(255, 255, 255, .22); }
  .d-rx-them { justify-content: center; text-align: center; color: #6b4a4a; font-weight: 600; }
  .d-rx-feat { font-weight: 600; color: var(--rx-ink); }
  .d-rx-feat i { color: var(--rx-green); font-size: 1.15rem; flex: 0 0 auto; }
  .d-rx-us i   { color: #c8f5d3; font-size: 1.1rem; flex: 0 0 auto; }
  .d-rx-them i { color: #d95b5b; font-size: 1.1rem; flex: 0 0 auto; }

  /* Row hover */
  .d-rx-row:not(.d-rx-row--head):not(.d-rx-row--total):hover .d-rx-feat,
  .d-rx-row:not(.d-rx-row--head):not(.d-rx-row--total):hover .d-rx-them { background: var(--green-50, #f1f8f3); }
  .d-rx-row:not(.d-rx-row--head):not(.d-rx-row--total):hover .d-rx-us { background: rgba(255, 255, 255, .1); }

  /* Row stagger */
  .d-rx.is-js .d-rx-row:not(.d-rx-row--head):not(.d-rx-row--total) .d-rx-cell {
    opacity: 0; transform: translateX(-12px);
  }
  .d-rx.is-js .d-rx-table-wrap.is-in .d-rx-row:not(.d-rx-row--head):not(.d-rx-row--total) .d-rx-cell {
    opacity: 1; transform: none;
    transition: opacity .6s ease, transform .7s var(--rx-ease), background-color .3s ease;
    transition-delay: calc(.45s + var(--i) * .08s), calc(.45s + var(--i) * .08s), 0s;
  }

  /* Head row */
  .d-rx-row--head .d-rx-cell { flex-direction: column; justify-content: center; padding: 1.6rem 1rem 1.2rem; border-bottom: 1px solid #e7f0ea; gap: .15rem; }
  .d-rx-row--head .d-rx-feat { align-items: flex-start; font-size: .8rem; font-weight: 800; letter-spacing: .14em; text-transform: uppercase; color: var(--rx-green); }
  .d-rx-row--head .d-rx-us { border-bottom-color: rgba(255, 255, 255, .22); }
  .d-rx-brand { font-family: var(--font-heading, inherit); font-size: 1.35rem; font-weight: 800; letter-spacing: .04em; text-transform: uppercase; color: #fff; line-height: 1.1; }
  .d-rx-brand--muted { color: var(--rx-ink); font-size: 1.05rem; }
  .d-rx-brand-sub { font-size: .72rem; font-weight: 600; letter-spacing: .06em; text-transform: uppercase; opacity: .8; }

  /* Total row */
  .d-rx-row--total { margin: 0; }
  .d-rx-row--total .d-rx-cell { border-bottom: 0; padding: 1.25rem 1.25rem; }
  .d-rx-row--total .d-rx-feat {
    background: var(--rx-dark); color: #fff; font-weight: 800; letter-spacing: .04em;
    border-radius: 0 0 0 24px;
  }
  .d-rx-row--total .d-rx-us { background: var(--rx-dark); }
  .d-rx-row--total .d-rx-them { background: var(--rx-dark); border-radius: 0 0 24px 0; }

  .d-rx-pill { display: inline-block; padding: .45rem 1rem; border-radius: 999px; font-size: .82rem; font-weight: 800; letter-spacing: .02em; white-space: nowrap; }
  .d-rx-pill--ok { background: #e9fbef; color: var(--rx-green); box-shadow: 0 6px 16px rgba(0, 0, 0, .18); }
  .d-rx-pill--bad { background: transparent; color: #ff9c9c; border: 1px solid rgba(255, 156, 156, .5); }

   
  /* ---------- Callout ---------- */
  .d-rx-callout {
    display: flex; align-items: center; justify-content: space-between; gap: 1.5rem;
    margin-top: 1.75rem; padding: 1.35rem 1.75rem;
    background: var(--rx-dark); border-radius: 20px; color: #fff;
    box-shadow: 0 18px 40px rgba(43, 58, 49, .25);
  }
  .d-rx-callout-text { display: flex; flex-direction: column; gap: .3rem; }
  .d-rx-callout-text strong { font-size: 1.05rem; }
  .d-rx-callout-text strong i { color: #7ddc96; margin-right: .5rem; }
  .d-rx-callout-text span { font-size: .9rem; color: rgba(255, 255, 255, .75); line-height: 1.5; }

  .d-rx-btn {
    display: inline-flex; align-items: center; gap: .55rem; flex: 0 0 auto;
    padding: .8rem 1.5rem; border-radius: 999px;
    background: #fff; color: var(--rx-green); font-weight: 700; font-size: .92rem; text-decoration: none; white-space: nowrap;
    transition: transform .35s var(--rx-ease), box-shadow .35s ease, background-color .25s ease, color .25s ease;
  }
  .d-rx-btn i { transition: transform .35s var(--rx-ease); }
  .d-rx-btn:hover { background: #7ddc96; color: #0f3a1b; transform: translateY(-2px); box-shadow: 0 10px 22px rgba(0, 0, 0, .25); }
  .d-rx-btn:hover i { transform: translateX(4px); }
  .d-rx-btn:focus-visible { outline: 3px solid rgba(125, 220, 150, .6); outline-offset: 3px; }

  /* ---------- Responsive ---------- */
  @media (max-width: 991.98px) {
    .d-rx { padding: 4rem 0 3.5rem; }
    .d-rx-grid { grid-template-columns: 1fr; gap: 1.25rem; }
    .d-rx-callout { flex-direction: column; align-items: flex-start; }
    .d-rx-btn { width: 100%; justify-content: center; }
  }

  @media (max-width: 640px) {
    .d-rx { padding: 3rem 0 2.5rem; --rx-c1: 1.15fr; }
    .d-rx-head { margin-bottom: 1.75rem; }
    .d-rx-eyebrow { font-size: .7rem; padding: .3rem .75rem; margin-bottom: .75rem; }
    .d-rx-title { font-size: clamp(1.35rem, 5.8vw, 1.75rem); line-height: 1.25; margin-bottom: .6rem; }
    .d-rx-bar { width: 60px; height: 4px; margin-bottom: .85rem; }
    .d-rx-sub { font-size: .86rem; line-height: 1.5; }
    .d-rx-table-wrap { padding: 8px 0; margin-bottom: 2rem; }
    .d-rx-hl { left: calc(100% * 1.15 / 3.15); width: calc(100% / 3.15); top: -14px; bottom: -14px; border-radius: 16px; }
    .d-rx-table { border-radius: 18px; }
    .d-rx-cell { padding: .7rem .4rem; font-size: .74rem; gap: .35rem; }
    .d-rx-feat { padding-left: .65rem; }
    .d-rx-feat i { display: none; }
    .d-rx-us, .d-rx-them { flex-direction: column; gap: .25rem; }
    .d-rx-brand { font-size: .95rem; }
    .d-rx-brand--muted { font-size: .8rem; }
    .d-rx-brand-sub { font-size: .58rem; }
    .d-rx-row--head .d-rx-cell { padding: 1rem .35rem .8rem; }
    .d-rx-row--total .d-rx-feat { border-radius: 0 0 0 18px; }
    .d-rx-row--total .d-rx-them { border-radius: 0 0 18px 0; }
    .d-rx-pill { padding: .3rem .45rem; font-size: .64rem; white-space: normal; }
    .d-rx-card { flex-direction: column; gap: 1rem; padding: 1.25rem 1rem; }
  }

  @media (prefers-reduced-motion: reduce) {
    .d-rx *, .d-rx *::before, .d-rx *::after { transition-duration: .01ms !important; transition-delay: 0s !important; }
    .d-rx.is-js [data-rx-reveal],
    .d-rx.is-js .d-rx-hl,
    .d-rx.is-js .d-rx-cell { opacity: 1 !important; transform: none !important; }
    .d-rx.is-js .d-rx-head .d-rx-bar { transform: none; }
  }
</style>

<script>
(function () {
  var root = document.getElementById('rules');
  if (!root || root.dataset.rxInit) return;
  root.dataset.rxInit = '1';
  root.classList.add('is-js');

  var items = root.querySelectorAll('[data-rx-reveal]');
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (en.isIntersecting) { en.target.classList.add('is-in'); io.unobserve(en.target); }
      });
    }, { threshold: .15, rootMargin: '0px 0px -40px 0px' });
    items.forEach(function (el) { io.observe(el); });
  } else {
    items.forEach(function (el) { el.classList.add('is-in'); });
  }
})();
</script>