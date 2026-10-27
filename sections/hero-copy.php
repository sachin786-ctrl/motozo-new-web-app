<?php
// Resolve current page key (e.g. 'noida', 'delhi', 'gurgaon', 'home')
$heroPageKey = !empty($districtSlug) ? $districtSlug : (!empty($pageType) ? $pageType : 'home');

// Load hero content catalog
$heroCatalog = file_exists(__DIR__ . '/../config/hero_content.php')
  ? require __DIR__ . '/../config/hero_content.php'
  : [];

// 1. Determine active hero content from config
if (!empty($heroCatalog[$heroPageKey])) {
  $activeHero = $heroCatalog[$heroPageKey];
} elseif (!empty($districtName)) {
  // Smart auto-fallback for any new district page not yet in config
  $activeHero = [
    'pill_icon'   => 'bi bi-geo-alt-fill text-accent',
    'pill_text'   => 'Authorized Scrap Partner &bull; ' . htmlspecialchars($districtName, ENT_QUOTES, 'UTF-8'),
    'pill_live'   => true,
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
    'title_line1' => 'Scrap Your Old Vehicle',
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
$flip1Json = !empty($activeHero['flip1']) ? json_encode(array_values($activeHero['flip1'])) : '["Easier.", "Smarter.", "Faster.", "Greener."]';
$flip2Json = !empty($activeHero['flip2']) ? json_encode(array_values($activeHero['flip2'])) : '["Better.", "Safer.", "Instantly.", "Higher."]';
$firstFlip1 = !empty($activeHero['flip1'][0]) ? $activeHero['flip1'][0] : 'Easier.';
$firstFlip2 = !empty($activeHero['flip2'][0]) ? $activeHero['flip2'][0] : 'Better.';
?>
<!-- ==========================================================================
     HERO & FAST VALUATION QUOTE COMPONENT (Self-Contained: HTML + CSS + JS)
     ========================================================================== -->
<section class="hero" id="get-started">
  <video id="hero-bg-video" class="hero-bg-video" autoplay muted playsinline preload="auto" aria-hidden="true" src="<?= (defined('BASE') ? rtrim(BASE, '/') . '/' : '') ?>assets/media/desktop_01.mp4"></video>
  <div class="hero-shade"></div>
  <div class="container">
    <div class="row g-4 g-lg-5 align-items-center">
      <div class="col-lg-7">
        <span class="hero-pill <?= !empty($activeHero['pill_live']) ? 'hero-pill-loc' : '' ?>">
          <?php if (!empty($activeHero['pill_live'])): ?>
            <span class="loc-live-dot" aria-hidden="true"></span>
          <?php endif; ?>
          <?php if (!empty($activeHero['pill_icon'])): ?>
            <i class="<?= htmlspecialchars($activeHero['pill_icon'], ENT_QUOTES, 'UTF-8') ?>"></i>
          <?php endif; ?>
          <?= $activeHero['pill_text'] ?>
        </span>

        <h1 class="hero-title">
          <span class="hero-line">
            <span class="hero-phrase"><?= $activeHero['title_line1'] ?></span>
            <span class="hero-flip-wrap"><span class="flip" data-flip='<?= $flip1Json ?>'><?= htmlspecialchars($firstFlip1, ENT_QUOTES, 'UTF-8') ?></span></span>
          </span>
          <span class="hero-line">
            <span class="hero-phrase"><?= $activeHero['title_line2'] ?></span>
            <span class="hero-flip-wrap"><span class="flip" data-flip='<?= $flip2Json ?>'><?= htmlspecialchars($firstFlip2, ENT_QUOTES, 'UTF-8') ?></span></span>
          </span>
        </h1>

        <p class="hero-lead"><?= $activeHero['lead'] ?></p>

        <ul class="trust">
          <?php if (!empty($activeHero['trust']) && is_array($activeHero['trust'])): ?>
            <?php foreach ($activeHero['trust'] as $tItem): ?>
              <li>
                <span class="trust-ic"><i class="bi <?= htmlspecialchars($tItem['icon'] ?? 'bi-check-circle', ENT_QUOTES, 'UTF-8') ?>"></i></span>
                <span><?= $tItem['text'] ?? '' ?></span>
              </li>
            <?php endforeach; ?>
          <?php endif; ?>
        </ul>
      </div>

      <div class="col-lg-5" id="quote">
        <?php include __DIR__ . '/quote-form.php'; ?>
      </div>
    </div>
  </div>
</section>

<style>
  /* Hero Section Styles */
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
    background: linear-gradient(90deg, rgba(7, 28, 19, .92), rgba(7, 28, 19, .6) 55%, rgba(7, 28, 19, .35));
  }

  .hero .container {
    position: relative;
    z-index: 2;
  }

  .hero-pill {
    display: inline-flex;
    align-items: center;
    gap: .45rem;
    padding: .35rem 1rem;
    border: 1px solid rgba(47, 191, 113, .55);
    background: rgba(14, 110, 62, .45);
    font-weight: 600;
    font-size: .84rem;
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.25);
  }

  .hero-title {
    font-family: var(--font-heading);
    font-size: var(--heading-size);
    font-weight: var(--heading-weight);
    line-height: var(--heading-line-height);
    margin: .85rem 0;
    color: #ffffff;
    text-shadow: 0 3px 20px rgba(0, 0, 0, 0.65);
    letter-spacing: var(--heading-letter-spacing);
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

  .hero-pill-loc {
    background: rgba(47, 191, 113, 0.22);
    border-color: rgba(47, 191, 113, 0.6);
    color: #bbf0d4;
  }

  .loc-live-dot {
    width: 8px;
    height: 8px;
    background: #2fbf71;
    border-radius: 50%;
    display: inline-block;
    box-shadow: 0 0 0 0 rgba(47, 191, 113, 0.7);
    animation: livePulse 2s infinite;
  }

  @keyframes livePulse {
    0% {
      transform: scale(0.95);
      box-shadow: 0 0 0 0 rgba(47, 191, 113, 0.7);
    }

    70% {
      transform: scale(1);
      box-shadow: 0 0 0 6px rgba(47, 191, 113, 0);
    }

    100% {
      transform: scale(0.95);
      box-shadow: 0 0 0 0 rgba(47, 191, 113, 0);
    }
  }



  .hero-title .flip {
    color: var(--accent);
    position: relative;
    display: inline-block;
    min-width: 1em;
    text-align: left;
    white-space: nowrap;
    padding-bottom: 2px;
    transition: opacity .3s ease, transform .3s ease;
  }

  .hero-title .flip::after {
    content: "";
    position: absolute;
    left: 0;
    right: 0;
    bottom: -4px;
    height: 8px;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 12' preserveAspectRatio='none'%3E%3Cpath d='M2 9 C 30 3, 70 3, 98 8' stroke='%232fbf71' stroke-width='4.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E") no-repeat center bottom / 100% 100%;
  }

  .hero-title .flip.out {
    opacity: 0;
    transform: translateY(-8px);
  }

  .hero-lead {
    font-size: 1.02rem;
    line-height: 1.55;
    max-width: 510px;
    color: rgba(255, 255, 255, 0.94);
    margin-bottom: 1.4rem;
  }

  /* Compact & Sleek Trust Badges */
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
    color: rgba(255, 255, 255, 0.95);
    background: rgba(255, 255, 255, .09);
    border: 1px solid rgba(255, 255, 255, .16);
    padding: .45rem .95rem .45rem .55rem;
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
    width: 38px;
    height: 38px;
    background: linear-gradient(135deg, var(--green-600), var(--green-800));
    color: #ffffff;
    display: grid;
    place-items: center;
    font-size: 1.1rem;
    flex-shrink: 0;
    box-shadow: 0 0 0 3px rgba(47, 191, 113, .3);
  }

  /* Note: Quote Card styling is self-contained in sections/quote-form.php */

  @media (max-width: 991px) {
    .hero {
      padding-top: calc(var(--hdr-height, 80px) + 1.4rem);
      padding-bottom: 2.8rem;
      min-height: auto;
    }

    .hero-title {
      font-size: clamp(1.75rem, 3.8vw, 2.3rem);
      margin: .75rem 0;
    }

    .hero-lead {
      font-size: .95rem;
      margin-bottom: 1.15rem;
    }

    .trust {
      gap: .65rem;
    }

    .trust li {
      padding: .38rem .75rem .38rem .48rem;
      font-size: .8rem;
      gap: .55rem;
    }

    .trust-ic {
      width: 34px;
      height: 34px;
      font-size: 1rem;
    }
  }

  @media (max-width: 575.98px) {
    .hero {
      padding-top: calc(var(--hdr-height, 68px) + 1rem);
      padding-bottom: 2.2rem;
    }

    .hero-pill {
      font-size: 0.72rem;
      padding: 0.24rem 0.65rem;
      gap: 0.35rem;
    }

    .hero-title {
      font-size: clamp(1.18rem, 4.8vw, 1.45rem);
      line-height: 1.28;
      margin: 0.55rem 0;
    }

    .hero-title .hero-line {
      display: block;
      margin-bottom: 0.2rem;
    }

    .hero-title .hero-phrase {
      display: inline;
    }

    .hero-title .hero-flip-wrap {
      display: inline-block;
    }

    .hero-title .flip {
      min-width: 1em;
    }

    .hero-lead {
      font-size: 0.84rem;
      line-height: 1.45;
      margin-bottom: 0.95rem;
    }

    .trust {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 0.4rem;
    }

    .trust li {
      padding: 0.35rem 0.25rem;
      gap: 0.35rem;
      font-size: 0.68rem;
      line-height: 1.15;
      justify-content: center;
    }

    .trust-ic {
      width: 28px;
      height: 28px;
      font-size: 0.85rem;
      box-shadow: 0 0 0 2px rgba(47, 191, 113, 0.25);
    }
  }
</style>

<script>
  (function() {
    /* Seamless Hero Background Video Playlist (4 Videos in Strict Natural Sequence) */
    const heroVid = document.getElementById('hero-bg-video');
    if (!heroVid) return;

    const base = '<?= (defined('BASE') ? rtrim(BASE, '/') . '/' : '') ?>';

    // 1. Desktop Playlist (4 Videos in sequence: Screen width >= 768px)
    const DESKTOP_VIDEOS = [
      base + 'assets/media/desktop_01.mp4',
      base + 'assets/media/desktop_02.mp4',
    ];

    // 2. Mobile Playlist (4 Videos in sequence: Screen width < 768px)
    const MOBILE_VIDEOS = [
      base + 'assets/media/desktop_01.mp4', 
      base + 'assets/media/desktop_02.mp4',
    ];

    // Browser Autoplay Policy requirements: must be muted & playsinline
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
          heroVid.addEventListener('canplay', function onCanPlay() {
            heroVid.removeEventListener('canplay', onCanPlay);
            heroVid.play().catch(function() {});
          }, {
            once: true
          });
        });
      }
    }

    function playNext() {
      idx = (idx + 1) % list.length;
      heroVid.src = list[idx];
      heroVid.load();
      playCurrent();
    }

    // Video natural completion triggers next video in sequence
    heroVid.addEventListener('ended', playNext);

    // If a video fails to play, skip to next video
    heroVid.addEventListener('error', function() {
      setTimeout(playNext, 1000);
    });

    // Screen resize / orientation change (Desktop <-> Mobile)
    function onBreakpoint(e) {
      const isMobile = e.matches;
      list = isMobile ? MOBILE_VIDEOS : DESKTOP_VIDEOS;
      idx = 0;
      heroVid.src = list[0];
      playCurrent();
    }

    if (mql.addEventListener) {
      mql.addEventListener('change', onBreakpoint);
    } else if (mql.addListener) {
      mql.addListener(onBreakpoint);
    }

    // On mobile load, switch to mobile video #1
    if (mql.matches) {
      idx = 0;
      heroVid.src = MOBILE_VIDEOS[0];
    }
    playCurrent();

    // Mobile gesture unlock (in case browser paused on initial load)
    document.addEventListener('touchstart', playCurrent, {
      once: true,
      passive: true
    });
    document.addEventListener('click', playCurrent, {
      once: true
    });

    // Resume playback when user returns to tab
    document.addEventListener('visibilitychange', function() {
      if (!document.hidden && heroVid.paused) {
        playCurrent();
      }
    });
  })();

  /* Flip Words */
  const rm = matchMedia('(prefers-reduced-motion:reduce)').matches;
  document.querySelectorAll('.hero-title [data-flip]').forEach((el, k) => {
    try {
      const w = JSON.parse(el.dataset.flip);
      if (!Array.isArray(w) || rm) return;
      let i = 0;
      setInterval(() => {
        el.classList.add('out');
        setTimeout(() => {
          i = (i + 1) % w.length;
          el.textContent = w[i];
          el.classList.remove('out');
        }, 300);
      }, 2800 + k * 450);
    } catch (e) {}
  });


  /* Smart Location Detection & Auto-Routing */
  (function initGeoDetection() {
    const urlParams = new URLSearchParams(window.location.search);
    const isHomeExplicit = urlParams.has('home') || (sessionStorage.getItem('motozo_home_stay') === '1');
    if (urlParams.has('home')) {
      try {
        sessionStorage.setItem('motozo_home_stay', '1');
      } catch (e) {}
    }

    const cityInput = document.getElementById('quote-user-city');
    const isDistrictPage = <?= !empty($districtSlug) ? 'true' : 'false' ?>;

    // If already on district page, nothing to route
    if (isDistrictPage) return;

    const cachedCity = sessionStorage.getItem('motozo_geo_detected');
    if (cachedCity) {
      if (cityInput && !cityInput.value && cachedCity !== 'unknown') {
        cityInput.value = cachedCity;
      }
      return;
    }

    fetch('https://ipapi.co/json/')
      .then(res => res.json())
      .then(data => {
        if (!data || !data.city) return;
        const detectedCity = (data.city || '').toLowerCase();
        const region = (data.region || '').toLowerCase();

        let targetPage = '';
        let cityName = '';
        if (detectedCity.includes('delhi') || region.includes('delhi')) {
          targetPage = '<?= (defined("BASE") ? BASE : "/") ?>car-scrap-dealer-delhi.php';
          cityName = 'Delhi';
        } else if (detectedCity.includes('noida') || detectedCity.includes('gautam') || region.includes('noida')) {
          targetPage = '<?= (defined("BASE") ? BASE : "/") ?>car-scrap-dealer-noida.php';
          cityName = 'Noida';
        }

        if (cityName) {
          try {
            sessionStorage.setItem('motozo_geo_detected', cityName);
          } catch (e) {}
          if (cityInput && !cityInput.value) {
            cityInput.value = cityName;
          }
          if (!isHomeExplicit && targetPage) {
            window.location.replace(targetPage);
          }
        } else {
          try {
            sessionStorage.setItem('motozo_geo_detected', data.city || 'unknown');
          } catch (e) {}
          if (cityInput && !cityInput.value && data.city) {
            cityInput.value = data.city;
          }
        }
      })
      .catch(() => {
        try {
          sessionStorage.setItem('motozo_geo_detected', 'unknown');
        } catch (e) {}
      });
  })();
</script>