<?php
// Resolve current page key (e.g. 'noida', 'delhi', 'gurgaon', 'home')
$heroPageKey = !empty($districtSlug) ? $districtSlug : (!empty($pageType) ? $pageType : 'home');

// Load hero content catalog
$heroCatalog = file_exists(__DIR__ . '/../config/hero_content.php')
  ? require __DIR__ . '/../config/hero_content.php'
  : [];

// 1. Determine active hero content from config
if (!empty($districtData['hero']) && is_array($districtData['hero'])) {
  $activeHero = $districtData['hero'];
} elseif (!empty($heroCatalog[$heroPageKey])) {
  $activeHero = $heroCatalog[$heroPageKey];
} elseif (!empty($districtName)) {
  // Smart auto-fallback for any new district page not yet in config
  $activeHero = [
    'pill_icon'   => 'bi bi-shield-check',
    'pill_text'   => 'Authorized Scrap Partner &bull; ' . htmlspecialchars($districtName, ENT_QUOTES, 'UTF-8'),
    'pill_live'   => false,
    'title_line1' => 'Scrap Your Old Vehicle in <span class="hero-city-name">' . htmlspecialchars($districtName, ENT_QUOTES, 'UTF-8') . '</span>',
    'flip1'       => ['Easier.', 'Smarter.', 'Faster.', 'Greener.'],
    'title_line2' => 'Sell Your Old Vehicle',
    'flip2'       => ['Better.', 'Safer.', 'Instantly.', 'Higher.'],
    'lead'        => 'Get the highest certified valuation for your vehicle in <strong>' . htmlspecialchars($districtName, ENT_QUOTES, 'UTF-8') . '</strong>. Free doorstep pickup &amp; instant payment.',
    'trust'       => [
      ['icon' => 'bi-truck',          'text' => 'Free<br>Pickup'],
      ['icon' => 'bi-cash-stack',     'text' => 'Transparent<br>Pricing'],
      ['icon' => 'bi-currency-rupee', 'text' => 'Instant<br>Payment'],
    ],
  ];
} else {
  // Global fallback
  $activeHero = $heroCatalog['home'] ?? [
    'pill_icon'   => 'bi bi-shield-check',
    'pill_text'   => "India's most trusted vehicle scrapping partner",
    'pill_live'   => false,
    'title_line1' => 'Scrap Your Old Vehicle Kumar',
    'flip1'       => ['Easier.', 'Smarter.', 'Faster.', 'Greener.'],
    'title_line2' => 'Sell Your Old Vehicle',
    'flip2'       => ['Better.', 'Safer.', 'Instantly.', 'Higher.'],
    'lead'        => 'Get a free quote for your vehicle, doorstep pickup &amp; instant payment across Delhi NCR.',
    'trust'       => [
      ['icon' => 'bi-truck',          'text' => 'Free<br>Pickup'],
      ['icon' => 'bi-cash-stack',     'text' => 'Transparent<br>Pricing'],
      ['icon' => 'bi-currency-rupee', 'text' => 'Instant<br>Payment'],
    ],
  ];
}

// 2. Allow direct page-level manual override ($heroContent defined in page before include)
if (!empty($heroContent) && is_array($heroContent)) {
  $activeHero = array_merge($activeHero, $heroContent);
}

// Safe formatting for flip words
$flip1Json  = !empty($activeHero['flip1']) ? json_encode(array_values($activeHero['flip1']), JSON_HEX_APOS | JSON_HEX_QUOT) : '["Easier.", "Smarter.", "Faster.", "Greener."]';
$flip2Json  = !empty($activeHero['flip2']) ? json_encode(array_values($activeHero['flip2']), JSON_HEX_APOS | JSON_HEX_QUOT) : '["Better.", "Safer.", "Instantly.", "Higher."]';
$firstFlip1 = !empty($activeHero['flip1'][0]) ? $activeHero['flip1'][0] : 'Easier.';
$firstFlip2 = !empty($activeHero['flip2'][0]) ? $activeHero['flip2'][0] : 'Better.';
$heroBase   = defined('BASE') ? rtrim(BASE, '/') . '/' : '';

// Bootstrap Icons mapping (config ke naam -> bi class)
$heroBiIcons = [
  'truck'  => 'bi-truck',
  'cash'   => 'bi-shield-check',
  'shield' => 'bi-shield-check',
  'rupee'  => 'bi-currency-rupee',
  'money'  => 'bi-currency-rupee',
];

if (!function_exists('heroResolveIcon')) {
  function heroResolveIcon(string $key, array $map, string $default): string
  {
    $k = strtolower(trim($key));
    foreach ($map as $needle => $cls) {
      if (strpos($k, $needle) !== false) return '<i class="bi ' . $cls . '" aria-hidden="true"></i>';
    }
    return '<i class="bi ' . $default . '" aria-hidden="true"></i>';
  }
}

?>
<!-- ==========================================================================
     HERO & FAST VALUATION QUOTE COMPONENT (Self-Contained: HTML + CSS + JS)
     ========================================================================== -->
<section class="hero" id="get-started">
  <video id="hero-bg-video" class="hero-bg-video" autoplay muted playsinline preload="metadata" aria-hidden="true" src="<?= $heroBase ?>assets/media/desktop_01.mp4"></video>
  <div class="hero-shade"></div>
  <div class="container">
    <div class="row g-4 g-lg-5 align-items-center ">
      <div class="col-lg-7">
        <span class="hero-pill hero-anim <?= !empty($activeHero['pill_live']) ? 'hero-pill-loc' : '' ?>" style="--d:.05s">
          <?php if (!empty($activeHero['pill_live'])): ?>
            <span class="loc-live-dot" aria-hidden="true"></span>
          <?php endif; ?>
          <?php if (!empty($activeHero['pill_icon'])): ?>
            <i class="<?= htmlspecialchars($activeHero['pill_icon'], ENT_QUOTES, 'UTF-8') ?>"></i>
          <?php endif; ?>
          <span><?= $activeHero['pill_text'] ?></span>
        </span>

        <h1 class="hero-title">
          <span class="hero-line hero-anim" style="--d:.15s">
            <span class="hero-phrase"><?= $activeHero['title_line1'] ?></span>
            <span class="hero-flip-wrap"><span class="flip" data-flip='<?= $flip1Json ?>'><?= htmlspecialchars($firstFlip1, ENT_QUOTES, 'UTF-8') ?></span></span>
          </span>
          <span class="hero-line hero-anim" style="--d:.28s">
            <span class="hero-phrase"><?= $activeHero['title_line2'] ?></span>
            <span class="hero-flip-wrap"><span class="flip" data-flip='<?= $flip2Json ?>'><?= htmlspecialchars($firstFlip2, ENT_QUOTES, 'UTF-8') ?></span></span>
          </span>
        </h1>

        <p class="hero-lead hero-anim" style="--d:.42s"><?= $activeHero['lead'] ?></p>

        <ul class="trust hero-anim" style="--d:.55s">
          <?php if (!empty($activeHero['trust']) && is_array($activeHero['trust'])): ?>
            <?php foreach ($activeHero['trust'] as $tItem): ?>
              <li>
                <span class="trust-ic">
                  <?= heroResolveIcon($tItem['icon'] ?? '', $heroBiIcons, 'bi-shield-check') ?>
                </span>
                <span class="trust-tx"><?= $tItem['text'] ?? '' ?></span>
              </li>
            <?php endforeach; ?>
          <?php endif; ?>
        </ul>
      </div>

      <div class="col-lg-5 hero-anim" id="quote" style="--d:.4s">
        <?php include __DIR__ . '/quote-form.php'; ?>
      </div>
    </div>
  </div>
</section>

<style>
  /* ---------- Hero base ---------- */
  .hero {
    position: relative;
    color: #fff;
    min-height: 95vh;
    width: 100%;
    max-width: 100%;
    display: flex;
    align-items: center;
    padding: calc(var(--hdr-height, 80px) + 1.25rem) 0 3.25rem;
    background: #0b2218;
    overflow: hidden;
  }

  .hero-bg-video {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 0;
    pointer-events: none;
  }

  .hero-shade {
    position: absolute;
    inset: 0;
    z-index: 1;
    background: linear-gradient(180deg, rgba(7, 28, 19, .62) 0%, rgba(7, 28, 19, .48) 55%, rgba(7, 28, 19, .66) 100%);
  }

  .hero .container {
    position: relative;
    z-index: 2;
  }

  /* ---------- Entrance animation ---------- */
  .hero-anim {
    animation: heroUp .8s cubic-bezier(.22, 1, .36, 1) both;
    animation-delay: var(--d, 0s);
  }

  @keyframes heroUp {
    from {
      opacity: 0;
      transform: translateY(22px);
    }

    to {
      opacity: 1;
      transform: none;
    }
  }

  /* ---------- Pill ---------- */
  .hero-pill {
    display: inline-flex;
    align-items: center;
    gap: .45rem;
    max-width: 100%;
    padding: .35rem 1rem;
    border: 1px solid rgba(47, 191, 113, .55);
    background: rgba(14, 110, 62, .45);
    font-weight: 600;
    font-size: .84rem;
    line-height: 1.3;
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    box-shadow: 0 4px 16px rgba(0, 0, 0, .25);
  }

  .hero-pill-loc {
    background: rgba(14, 110, 62, .45);
    border: 1px solid rgba(47, 191, 113, .55);
    color: #ffffff;
  }

  .loc-live-dot {
    width: 8px;
    height: 8px;
    flex-shrink: 0;
    background: #2fbf71;
    border-radius: 50%;
    display: inline-block;
    animation: livePulse 2s infinite;
  }

  @keyframes livePulse {
    0% {
      transform: scale(.95);
      box-shadow: 0 0 0 0 rgba(47, 191, 113, .7);
    }

    70% {
      transform: scale(1);
      box-shadow: 0 0 0 6px rgba(47, 191, 113, 0);
    }

    100% {
      transform: scale(.95);
      box-shadow: 0 0 0 0 rgba(47, 191, 113, 0);
    }
  }

  /* ---------- Title ---------- */
  .hero-title {
    font-family: var(--font-heading);
    font-size: var(--heading-size);
    font-weight: var(--heading-weight);
    line-height: var(--heading-line-height);
    margin: .85rem 0;
    color: #fff;
    text-shadow: 0 3px 20px rgba(0, 0, 0, .65);
    letter-spacing: var(--heading-letter-spacing);
    overflow-wrap: break-word;
  }

  .hero-title .hero-line {
    display: block;
  }

  .hero-title .hero-phrase {
    display: inline;
  }

  .hero-title .hero-flip-wrap {
    display: inline-block;
    white-space: nowrap;
  }

  .hero-city-name {
    color: var(--accent);
    text-decoration: underline;
    text-decoration-thickness: 3px;
    text-underline-offset: 6px;
  }

  /* ---------- Flip word animation ---------- */
  .hero-title .flip {
    color: var(--accent);
    position: relative;
    display: inline-block;
    text-align: left;
    white-space: nowrap;
    padding-bottom: 6px;
  }

  .hero-title .flip::after {
    content: "";
    position: absolute;
    left: 0;
    right: 0;
    bottom: -1px;
    height: 8px;
    transform-origin: left center;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 12' preserveAspectRatio='none'%3E%3Cpath d='M2 9 C 30 3, 70 3, 98 8' stroke='%232fbf71' stroke-width='4.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E") no-repeat center bottom / 100% 100%;
  }

  .hero-title .flip.pop::after {
    animation: ulDraw .7s cubic-bezier(.22, 1, .36, 1) .25s both;
  }

  @keyframes ulDraw {
    from {
      transform: scaleX(0);
    }

    to {
      transform: scaleX(1);
    }
  }

  /* each letter pops in with a springy bounce */
  .hero-title .flip .ch {
    display: inline-block;
    animation: chPop .65s cubic-bezier(.34, 1.56, .64, 1) both;
    animation-delay: calc(var(--i) * 55ms);
    will-change: transform, opacity;
  }

  @keyframes chPop {
    0% {
      opacity: 0;
      transform: translateY(70%) scale(.3) rotate(-14deg);
      filter: blur(3px);
    }

    60% {
      opacity: 1;
      transform: translateY(-14%) scale(1.25) rotate(4deg);
      filter: none;
      text-shadow: 0 0 18px rgba(47, 191, 113, .95), 0 0 34px rgba(255, 213, 74, .55);
    }

    100% {
      opacity: 1;
      transform: none;
      text-shadow: none;
    }
  }

  /* old word flies away letter by letter */
  .hero-title .flip.out .ch {
    animation: chOut .3s ease-in both;
    animation-delay: calc(var(--i) * 22ms);
  }

  .hero-title .flip.out::after {
    transform: scaleX(0);
    transition: transform .25s ease;
  }

  @keyframes chOut {
    to {
      opacity: 0;
      transform: translateY(-65%) scale(.5) rotate(10deg);
      filter: blur(3px);
    }
  }

  /* ---------- Lead ---------- */
  .hero-lead {
    font-size: 1.02rem;
    line-height: 1.6;
    max-width: 510px;
    color: rgba(255, 255, 255, .94);
    text-shadow: 0 2px 12px rgba(0, 0, 0, .5);
    margin-bottom: 1.4rem;
  }

  /* ---------- Trust badges ---------- */
  .trust {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    gap: .75rem;
    flex-wrap: wrap;
  }

  .trust li {
    display: inline-flex;
    align-items: center;
    gap: .65rem;
    font-weight: 600;
    font-size: .85rem;
    line-height: 1.25;
    color: rgba(255, 255, 255, .95);
    background: rgba(255, 255, 255, .09);
    border: 1px solid rgba(255, 255, 255, .16);
    padding: 5px; 
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    box-shadow: 0 6px 18px rgba(0, 0, 0, .28);
    transition: transform .2s ease, border-color .2s ease, background-color .2s ease;
  }

  .trust li:hover {
    transform: translateY(-2px);
    border-color: rgba(47, 191, 113, .65);
    background: rgba(255, 255, 255, .14);
  }

  .trust-ic {
    width: 50px;
    height: 50px;
    display: grid;
    place-items: center;
    flex-shrink: 0;
    font-size: 1.7rem;
    color: #fff;
    border: 1.5px solid rgba(47, 191, 113, .7);
    background: radial-gradient(circle at 30% 25%, rgba(47, 191, 113, .35), rgba(8, 40, 25, .85) 70%);
    box-shadow: 0 0 18px rgba(47, 191, 113, .45), inset 0 0 14px rgba(47, 191, 113, .25);
  }

  .trust-ic i {
    display: block;
    font-size: 1.5rem;
    line-height: 1;
  }

  /* ---------- Tablet ---------- */
  @media (max-width: 991.98px) {
    .hero {
      padding-top: calc(var(--hdr-height, 80px) + 2rem);
      padding-bottom: 3.5rem;
      min-height: auto;
    }

    /* more vertical space between text block and quote form */
    .hero .row {
      --bs-gutter-y: 2.5rem;
    }

    .hero-title {
      font-size: clamp(1.9rem, 5vw, 2.5rem);
      line-height: 1.25;
      margin: 1.1rem 0 1rem;
    }

    .hero-title .hero-line {
      margin-bottom: .6rem;
    }

    .hero-lead {
      font-size: .98rem;
      max-width: 100%;
      margin-bottom: 1.6rem;
    }
  }

  /* ---------- Mobile ---------- */
  @media (max-width: 575.98px) {
    .hero {
      padding-top: calc(var(--hdr-height, 68px) + 1.75rem);
      padding-bottom: 3rem;
    }

    .hero .row {
      --bs-gutter-y: 1rem;
    }

    /* pill: full width, rounded, green glow */
    .hero-pill {
      display: flex;
      width: 100%;
      justify-content: flex-start;
      font-size: .72rem;
      padding: .45rem .75rem;
      gap: .45rem;
      border-radius: 10px;
      border: 1px solid rgba(47, 191, 113, .55);
      background: rgba(8, 40, 25, .55);
      box-shadow: 0 0 14px rgba(47, 191, 113, .22), inset 0 0 10px rgba(47, 191, 113, .1);
    }

    .hero-pill i {
      color: #7be3a8;
      font-size: .88rem;
    }

    .hero-title {
      font-size: clamp(1.35rem, 5.8vw, 1.75rem);
      line-height: 1.25;
      letter-spacing: -.01em;
      margin: 1rem 0 .75rem;
    }

    .hero-title .hero-line {
      margin-bottom: .5rem;
    }

    .hero-title .hero-line:last-child {
      margin-bottom: 0;
    }

    .hero-lead {
      font-size: .88rem;
      line-height: 1.5;
      max-width: 100%;
      margin-bottom: 1.25rem;
    }

    /* badges: 3 columns, clean round glowing icon, text below */
    .trust {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: .4rem;
    }

    .trust li {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      text-align: center;
      gap: .4rem;
      padding: 0;
      background: none;
      border: 0;
      box-shadow: none;
      backdrop-filter: none;
      -webkit-backdrop-filter: none;
      font-size: .72rem;
      line-height: 1.2;
    }

    .trust li:hover {
      transform: none;
      background: none;
      border: 0;
    }

    .trust-ic {
      width: 46px;
      height: 46px;
      display: grid;
      place-items: center;
      flex-shrink: 0;
      color: #fff;
      border-radius: 50%;
      border: 1.5px solid rgba(47, 191, 113, .7);
      background: radial-gradient(circle at 30% 25%, rgba(47, 191, 113, .35), rgba(8, 40, 25, .85) 70%);
      box-shadow: 0 0 14px rgba(47, 191, 113, .4), inset 0 0 10px rgba(47, 191, 113, .2);
    }

    .trust-ic i {
      font-size: 1.25rem;
    }
  }
</style>

<script>
  (function() {

    /* ===== Background video playlist ===== */
    const heroVid = document.getElementById('hero-bg-video');
    if (heroVid) {
      const base = '<?= $heroBase ?>';

      // Tip: use smaller/compressed videos for mobile (e.g. mobile_01.mp4)
      const DESKTOP_VIDEOS = [base + 'assets/media/desktop_01.mp4', base + 'assets/media/desktop_02.mp4'];
      const MOBILE_VIDEOS = [base + 'assets/media/desktop_01.mp4', base + 'assets/media/desktop_02.mp4'];

      heroVid.muted = true;
      heroVid.defaultMuted = true;
      heroVid.playsInline = true;

      const mql = window.matchMedia('(max-width: 767.98px)');
      let list = mql.matches ? MOBILE_VIDEOS : DESKTOP_VIDEOS;
      let idx = 0;

      function playCurrent() {
        const p = heroVid.play();
        if (p !== undefined) {
          p.catch(function() {
            heroVid.addEventListener('canplay', function() {
              heroVid.play().catch(function() {});
            }, {
              once: true
            });
          });
        }
      }

      function setSrc(url) {
        // avoid needless reload if same file is already loaded
        if (heroVid.getAttribute('src') === url) return;
        heroVid.src = url;
        heroVid.load();
      }

      function playNext() {
        idx = (idx + 1) % list.length;
        setSrc(list[idx]);
        playCurrent();
      }

      heroVid.addEventListener('ended', playNext);
      heroVid.addEventListener('error', function() {
        setTimeout(playNext, 1000);
      });

      function onBreakpoint(e) {
        list = e.matches ? MOBILE_VIDEOS : DESKTOP_VIDEOS;
        idx = 0;
        setSrc(list[0]);
        playCurrent();
      }
      if (mql.addEventListener) mql.addEventListener('change', onBreakpoint);
      else if (mql.addListener) mql.addListener(onBreakpoint);

      setSrc(list[0]);
      playCurrent();

      document.addEventListener('touchstart', playCurrent, {
        once: true,
        passive: true
      });
      document.addEventListener('click', playCurrent, {
        once: true
      });
      document.addEventListener('visibilitychange', function() {
        if (!document.hidden && heroVid.paused) playCurrent();
      });
    }

    /* ===== Flip words: smooth letter-by-letter pop ===== */
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function renderWord(el, word) {
      el.setAttribute('aria-label', word);
      el.textContent = '';
      Array.from(word).forEach(function(c, i) {
        const s = document.createElement('span');
        s.className = 'ch';
        s.setAttribute('aria-hidden', 'true');
        s.style.setProperty('--i', i);
        s.textContent = c === ' ' ? '\u00a0' : c;
        el.appendChild(s);
      });
      el.classList.remove('pop');
      void el.offsetWidth;
      el.classList.add('pop');
    }

    if (!reduceMotion) {
      document.querySelectorAll('.hero-title [data-flip]').forEach(function(el, k) {
        let words;
        try {
          words = JSON.parse(el.dataset.flip);
        } catch (e) {
          return;
        }
        if (!Array.isArray(words) || words.length < 2) return;

        let i = 0;
        renderWord(el, words[0]);

        function swap() {
          if (document.hidden) return;
          el.classList.add('out');
          setTimeout(function() {
            i = (i + 1) % words.length;
            el.classList.remove('out');
            renderWord(el, words[i]);
          }, 420);
        }

        setTimeout(function() {
          setInterval(swap, 3200);
        }, 2000 + k * 1000);
      });
    }

    /* ===== Smart location detection & auto-routing ===== */
    (function initGeoDetection() {
      const urlParams = new URLSearchParams(window.location.search);
      let homeStay = false;
      try {
        homeStay = sessionStorage.getItem('motozo_home_stay') === '1';
        if (urlParams.has('home')) sessionStorage.setItem('motozo_home_stay', '1');
      } catch (e) {}
      const isHomeExplicit = urlParams.has('home') || homeStay;

      const cityInput = document.getElementById('quote-loc-input') || document.getElementById('quote-user-city');
      const isDistrictPage = <?= !empty($districtSlug) ? 'true' : 'false' ?>;
      if (isDistrictPage) return;

      let cachedCity = null;
      try {
        cachedCity = sessionStorage.getItem('motozo_geo_detected');
      } catch (e) {}
      if (cachedCity) {
        if (cityInput && !cityInput.value && cachedCity !== 'unknown') cityInput.value = cachedCity;
        return;
      }

      fetch('https://ipapi.co/json/')
        .then(function(res) {
          return res.json();
        })
        .then(function(data) {
          if (!data || !data.city) return;
          const detectedCity = (data.city || '').toLowerCase();
          const region = (data.region || '').toLowerCase();

          let targetPage = '';
          let cityName = '';
          if (detectedCity.includes('delhi') || region.includes('delhi')) {
            targetPage = '<?= defined("BASE") ? BASE : "/" ?>car-scrap-dealer-delhi.php';
            cityName = 'Delhi';
          } else if (detectedCity.includes('noida') || detectedCity.includes('gautam') || region.includes('noida')) {
            targetPage = '<?= defined("BASE") ? BASE : "/" ?>car-scrap-dealer-noida.php';
            cityName = 'Noida';
          }

          try {
            sessionStorage.setItem('motozo_geo_detected', cityName || data.city || 'unknown');
          } catch (e) {}
          if (cityInput && !cityInput.value) cityInput.value = cityName || data.city;
          if (cityName && !isHomeExplicit && targetPage) window.location.replace(targetPage);
        })
        .catch(function() {
          try {
            sessionStorage.setItem('motozo_geo_detected', 'unknown');
          } catch (e) {}
        });
    })();

  })();
</script>