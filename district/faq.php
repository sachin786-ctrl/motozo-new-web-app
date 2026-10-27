<?php
/**
 * ============================================================================
 * DISTRICT FAQ COMPONENT (Outside sections/ directory)
 * Exact 100% clone of sections/faq.php (HTML + CSS + JS) with District Content
 * ============================================================================
 */
declare(strict_types=1);

$cityName = $districtData['name'] ?? ($districtName ?? 'District');
$faqs = $districtData['faqs'] ?? [];
?>
<!-- ==========================================================================
     FAQ COMPONENT (Self-Contained: HTML + CSS + JS)
     ========================================================================== -->
<section class="section-faq" id="faq">
  <div class="container">
    <div class="faq-header text-center reveal">
      <span class="faq-eyebrow"><i class="bi bi-question-circle-fill"></i> FAQ</span>
      <h2 class="faq-title">Got Questions About Scrapping in <?= htmlspecialchars($cityName, ENT_QUOTES, 'UTF-8') ?>?</h2>
      <p class="faq-subtitle">
        Everything you need to know about scrapping your vehicle legally in <strong><?= htmlspecialchars($cityName, ENT_QUOTES, 'UTF-8') ?></strong>, getting the best price, and receiving your Govt. COD certificate.
      </p>

      <div class="faq-filter-pills" role="group" aria-label="FAQ categories">
        <button class="faq-pill active" data-filter="all" type="button">All Questions</button>
        <button class="faq-pill" data-filter="dealers" type="button">Authorised Dealer</button>
        <button class="faq-pill" data-filter="documents" type="button">Legal &amp; COD Documents</button>
        <button class="faq-pill" data-filter="pickup" type="button">Pickup &amp; Vehicles</button>
        <button class="faq-pill" data-filter="motozo" type="button">About Motozo</button>
      </div>
    </div>

    <div class="faq-container reveal">
      <?php foreach ($faqs as $idx => $f): 
        $cat = $f['category'] ?? 'dealers';
        $isOpen = ($idx === 0);
        $qid = 'faq-q' . ($idx + 1);
        $aid = 'faq-a' . ($idx + 1);
      ?>
        <div class="faq-item <?= $isOpen ? 'is-open' : '' ?>" data-category="<?= htmlspecialchars($cat, ENT_QUOTES, 'UTF-8') ?>">
          <button class="faq-summary" type="button" aria-expanded="<?= $isOpen ? 'true' : 'false' ?>" aria-controls="<?= $aid ?>" id="<?= $qid ?>">
            <span class="faq-summary-left">
              <span class="faq-question-text"><?= htmlspecialchars($f['q'], ENT_QUOTES, 'UTF-8') ?></span>
            </span>
            <span class="faq-icon-box" aria-hidden="true">
              <svg viewBox="0 0 24 24" width="18" height="18"><path d="M6 9l6 6 6-6" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </span>
          </button>
          <div class="faq-panel" id="<?= $aid ?>" role="region" aria-labelledby="<?= $qid ?>">
            <div class="faq-panel-inner">
              <p class="faq-content"><?= $f['a'] ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<style>
  .section-faq {
    --faq-green-900: var(--green-900, #093722);
    --faq-green-800: var(--green-800, #0b5a33);
    --faq-green-700: var(--green-700, #1B692C);
    --faq-green-600: var(--green-600, #12824a);
    --faq-green-100: var(--green-100, #d9ede2);
    --faq-green-50:  var(--green-50, #eef7f1);
    --faq-line: var(--line, #e3ebe7);
    --faq-ink: var(--ink, #12231a);
    --faq-muted: var(--muted, #5b6b62);
    padding: 5.5rem 0 4.5rem;
    background: var(--section-bg-white);
  }

  /* Header */
  .faq-header { max-width: 820px; margin: 0 auto 3rem; }

  .faq-eyebrow {
    display: inline-flex; align-items: center; gap: .5rem;
    padding: .35rem .95rem;
    background: var(--faq-green-50);
    border: 1px solid var(--faq-green-100);
    border-radius: 999px;
    color: var(--faq-green-700);
    font-size: .78rem; font-weight: 700; letter-spacing: .12em; text-transform: uppercase;
    margin-bottom: 1rem;
  }

  .faq-title {
    font-family: var(--font-heading, inherit);
    font-size: var(--heading-size, clamp(1.8rem, 3.4vw, 2.5rem));
    font-weight: var(--heading-weight, 800);
    line-height: var(--heading-line-height, 1.2);
    letter-spacing: var(--heading-letter-spacing, -0.02em);
    color: var(--heading-color, var(--faq-ink));
    margin-bottom: .8rem;
  }

  .faq-subtitle {
    font-size: clamp(.95rem, 1.4vw, 1.05rem);
    color: var(--faq-muted);
    line-height: 1.6;
    margin: 0 auto 1.8rem;
    max-width: 660px;
  }

  /* Filter pills */
  .faq-filter-pills { display: flex; justify-content: center; gap: .6rem; flex-wrap: wrap; }

  .faq-pill {
    padding: .5rem 1.15rem;
    border-radius: 999px;
    background: #fff;
    border: 1px solid var(--faq-line);
    color: var(--faq-muted);
    font-size: .86rem; font-weight: 600;
    cursor: pointer;
    transition: background .25s, color .25s, border-color .25s, box-shadow .25s;
  }
  .faq-pill:hover { background: var(--faq-green-50); color: var(--faq-green-800); border-color: var(--faq-green-600); }
  .faq-pill.active {
    background: var(--faq-green-700); color: #fff; border-color: var(--faq-green-700);
    box-shadow: 0 4px 14px rgba(27, 105, 44, .25);
  }

  /* Accordion */
  .faq-container { max-width: 900px; margin: 0 auto; }

  .faq-item {
    background: #fff;
    border-bottom: 1px solid var(--faq-line);
    margin-bottom: .9rem;
    transition: border-color .3s, box-shadow .3s;
  }
  .faq-item[hidden] { display: none; }
  .faq-item:hover { border-color: rgba(18, 130, 74, .4); box-shadow: 0 6px 20px rgba(0, 0, 0, .04); }
  .faq-item.is-open {
    box-shadow: 0 12px 28px -12px rgba(14, 110, 62, .22);
  }

  .faq-summary {
    width: 100%;
    display: flex; align-items: center; justify-content: space-between; gap: 1rem;
    padding: 1.2rem 1.4rem;
    background: none; border: 0; border-radius: 14px;
    text-align: left; font: inherit; color: inherit;
    cursor: pointer;
    -webkit-tap-highlight-color: transparent;
  }
  .faq-summary:focus-visible { outline: 2px solid var(--faq-green-600); outline-offset: 2px; }

  .faq-summary-left { display: flex; align-items: center; gap: .9rem; flex: 1; min-width: 0; }

  .faq-badge {
    flex-shrink: 0;
    padding: .24rem .65rem;
    background: var(--faq-green-50);
    border: 1px solid rgba(14, 110, 62, .15);
    border-radius: 6px;
    color: var(--faq-green-800);
    font-size: .7rem; font-weight: 800; letter-spacing: .05em; text-transform: uppercase;
    white-space: nowrap;
  }

  .faq-question-text {
    font-family: var(--font-heading, inherit);
    font-size: 1.05rem; font-weight: 700; line-height: 1.4;
    letter-spacing: -.01em;
    color: var(--faq-ink);
    transition: color .25s;
  }
  .faq-item:hover .faq-question-text,
  .faq-item.is-open .faq-question-text { color: var(--faq-green-800); }

  /* Icon */
  .faq-icon-box {
    flex-shrink: 0;
    width: 36px; height: 36px;
    display: grid; place-items: center;
    border-radius: 50%;
    background: var(--faq-green-50);
    border: 1.5px solid var(--faq-green-700);
    color: var(--faq-green-700);
    transition: background .3s, color .3s, box-shadow .3s;
  }
  .faq-icon-box svg { display: block; transition: transform .35s cubic-bezier(.4, 0, .2, 1); }
  .faq-item.is-open .faq-icon-box {
    background: var(--faq-green-700); color: #fff;
    box-shadow: 0 4px 12px rgba(27, 105, 44, .28);
  }
  .faq-item.is-open .faq-icon-box svg { transform: rotate(180deg); }

  /* Smooth open/close (no JS height math) */
  .faq-panel {
    display: grid;
    grid-template-rows: 0fr;
    transition: grid-template-rows .38s cubic-bezier(.4, 0, .2, 1);
  }
  .faq-item.is-open .faq-panel { grid-template-rows: 1fr; }

  .faq-panel-inner { overflow: hidden; min-height: 0; }

  .faq-content {
    margin: 0 1.4rem;
    padding: 1.1rem 0 1.4rem;
    color: #3f4e46;
    font-size: .95rem; line-height: 1.7;
    opacity: 0;
    transform: translateY(-6px);
    transition: opacity .3s ease, transform .38s cubic-bezier(.4, 0, .2, 1);
  }
  .faq-item.is-open .faq-content { opacity: 1; transform: none; transition-delay: .08s; }

  /* Mobile */
  @media (max-width: 767.98px) {
    .section-faq { padding: 3rem 0 2.5rem; }
    .faq-header { margin-bottom: 1.75rem; }
    .faq-eyebrow { font-size: .7rem; padding: .3rem .75rem; margin-bottom: .65rem; }
    .faq-title { font-size: clamp(1.35rem, 5.8vw, 1.75rem); line-height: 1.25; margin-bottom: .6rem; }
    .faq-subtitle { font-size: .86rem; line-height: 1.5; margin-bottom: 1.25rem; }
    .faq-filter-pills { gap: .35rem; }
    .faq-pill { font-size: .74rem; padding: .35rem .75rem; }
    .faq-summary { padding: .95rem 1rem; align-items: center; gap: .75rem; }
    .faq-summary-left { flex-direction: row; align-items: center; gap: .6rem; }
    .faq-question-text { font-size: .9rem; line-height: 1.35; }
    .faq-content { margin: 0 1rem; padding: .85rem 0 1.1rem; font-size: .86rem; line-height: 1.55; }
  }
  @media (max-width: 480px) {
    .faq-summary { padding: .85rem .9rem; }
    .faq-pill { font-size: .7rem; padding: .3rem .65rem; }
    .faq-icon-box { width: 28px; height: 28px; }
    .faq-icon-box svg { width: 14px; height: 14px; }
  }

  @media (prefers-reduced-motion: reduce) {
    .faq-panel, .faq-content, .faq-icon-box svg { transition: none; }
  }
</style>

<script>
  (function () {
    var root = document.getElementById('faq');
    if (!root) return;

    var items = Array.prototype.slice.call(root.querySelectorAll('.faq-item'));
    var pills = Array.prototype.slice.call(root.querySelectorAll('.faq-pill'));

    function setOpen(item, open) {
      item.classList.toggle('is-open', open);
      item.querySelector('.faq-summary').setAttribute('aria-expanded', open ? 'true' : 'false');
    }

    // Accordion: one open at a time
    items.forEach(function (item) {
      item.querySelector('.faq-summary').addEventListener('click', function () {
        var willOpen = !item.classList.contains('is-open');
        items.forEach(function (i) { setOpen(i, false); });
        setOpen(item, willOpen);
      });
    });

    // Category filter
    pills.forEach(function (pill) {
      pill.addEventListener('click', function () {
        pills.forEach(function (p) { p.classList.remove('active'); });
        pill.classList.add('active');

        var filter = pill.getAttribute('data-filter');
        var first = true;

        items.forEach(function (item) {
          var show = filter === 'all' || item.getAttribute('data-category') === filter;
          item.hidden = !show;
          setOpen(item, show && first);
          if (show) first = false;
        });
      });
    });
  })();
</script>
