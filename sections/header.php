<!-- ==========================================================================
     HEADER COMPONENT (Self-Contained: HTML + CSS + JS)
     ========================================================================== -->

<header class="site-header">
  <div class="container d-flex align-items-center justify-content-between">
    <button class="btn d-lg-none" id="menuBtn" aria-label="Toggle navigation menu" aria-expanded="false">
      <i class="bi bi-list"></i>
    </button>

    <?php
    $isHome = ($pageType === 'home');
    $homePrefix = $isHome ? '' : ((defined('BASE') ? BASE : '/') . 'index.php');
    $homeUrl = (defined('BASE') ? BASE : '/') . 'index.php?home=1';
    ?>
    <a href="<?= $homeUrl ?>" class="logo" aria-label="Motozo home" onclick="try{sessionStorage.setItem('motozo_home_stay','1');}catch(e){}">
      <img src="<?= defined('BASE') ? BASE : '/' ?>assets/media/logo.webp" alt="Motozo.in" class="logo-img">
    </a>

    <nav class="d-none d-lg-flex" aria-label="Primary" id="mainNav">
      <a href="<?= $isHome ? '#main' : $homeUrl ?>" class="nav-link-s <?= $isHome ? 'active' : '' ?>"><span data-text="Home">Home</span></a>
      <a href="<?= $homePrefix ?>#how-it-works" class="nav-link-s"><span data-text="How It Works">How It Works</span></a>
      <a href="<?= $homePrefix ?>#why-motozo" class="nav-link-s"><span data-text="Why Motozo">Why Motozo</span></a>
      <a href="<?= $homePrefix ?>#list-lot" class="nav-link-s"><span data-text="Instant Valuation">Instant Valuation</span></a>
      <a href="<?= $homePrefix ?>#faq" class="nav-link-s"><span data-text="FAQ">FAQ</span></a>
      <a href="<?= (defined('BASE') ? BASE : '/') ?>contact.php" class="nav-link-s <?= (isset($pageType) && $pageType === 'contact') ? 'active' : '' ?>"><span data-text="Contact">Contact</span></a>
      <!-- Sliding active indicator -->
      <span class="nav-indicator" id="navIndicator" aria-hidden="true"></span>
    </nav>

    <div class="d-flex align-items-center gap-2">
      <a href="<?= $homePrefix ?>#quote" class="btn btn-primary header-cta-btn">Get Free Quote</a>
    </div>
  </div>
  <span class="progress-top" id="prog"></span>
</header>

<div class="mobile-menu-backdrop" id="mobileMenuBackdrop"></div>
<nav class="mobile-menu" id="mobileMenu" aria-label="Mobile">
  <a href="<?= $isHome ? '#main' : $homeUrl ?>">Home</a>
  <a href="<?= $homePrefix ?>#how-it-works">How It Works</a>
  <a href="<?= $homePrefix ?>#why-motozo">Why Motozo</a>
  <a href="<?= $homePrefix ?>#list-lot">Instant Valuation</a>
  <a href="<?= $homePrefix ?>#faq">FAQ</a>
  <a href="<?= (defined('BASE') ? BASE : '/') ?>contact.php" class="<?= (isset($pageType) && $pageType === 'contact') ? 'active' : '' ?>">Contact</a>
  <a href="<?= $homePrefix ?>#quote" class="btn btn-primary mobile-cta-btn">Get Free Quote</a>
</nav>

<style>
  /* Force header font to use style.css main body font token */
  .site-header,
  .site-header *,
  .mobile-menu,
  .mobile-menu * {
    font-family: var(--font-body) !important;
  }

  /* Header & Desktop Nav Styles - White Header, Transparent Nav Links */
  .site-header {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    width: 100%;
    max-width: 100%;
    overflow: hidden;
    z-index: 1030;
    background: #ffffff !important;
    border: none !important;
    border-bottom: none !important;
    box-shadow: 0 2px 14px rgba(0, 0, 0, 0.06) !important;
    height: var(--hdr-height, 80px);
    min-height: var(--hdr-height, 80px);
    display: flex;
    align-items: center;
    font-family: var(--font-body);
    transition: background 0.3s ease, box-shadow 0.3s ease;
  }

  .site-header.solid,
  .site-header.scrolled {
    background: #ffffff !important;
    box-shadow: 0 4px 20px -8px rgba(0, 0, 0, 0.1) !important;
    border: none !important;
    border-bottom: none !important;
  }

  .site-header .container {
    height: 100%;
    width: 100%;
    max-width: 1600px;
    margin-left: auto;
    margin-right: auto;
    padding-left: clamp(14px, 2vw, 24px);
    padding-right: clamp(14px, 2vw, 24px);
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: nowrap;
  }

  .site-header .logo {
    display: inline-flex;
    align-items: center;
    line-height: 1;
    text-decoration: none;
    flex-shrink: 0;
  }

  .site-header .logo-img {
    height: var(--hdr-logo-h, 38px);
    max-height: var(--hdr-logo-h, 38px);
    width: auto;
    object-fit: contain;
    display: block;
    filter: none !important;
    transition: transform 0.25s ease;
    transform: scale(var(--hdr-logo-scale, 1.03));
  }

  /* ---------- Desktop nav ---------- */
  #mainNav {
    position: relative;
    display: flex;
    align-items: center;
    gap: 1.6rem;
    margin: 0;
    padding: 0;
  }

  .nav-link-s {
    display: inline-flex;
    align-items: center;
    color: var(--hdr-nav-color, #3b4a5c) !important;
    font-family: var(--font-body);
    font-size: var(--hdr-nav-font-size, 0.95rem);
    font-weight: 600;
    letter-spacing: -0.01em;
    padding: 0.45rem 0.25rem;
    background: transparent !important;
    border: none !important;
    position: relative;
    text-decoration: none;
    white-space: nowrap;
    transition: color 0.25s ease;
  }

  /* Reserve the bold width up front: bold on active never moves neighbours */
  .nav-link-s>span {
    display: inline-flex;
    flex-direction: column;
    align-items: center;
  }

  .nav-link-s>span::after {
    content: attr(data-text);
    font-weight: 600;
    height: 0;
    overflow: hidden;
    visibility: hidden;
    pointer-events: none;
    user-select: none;
  }

  /* Hover preview underline (soft, slides in from left, leaves to right) */
  .nav-link-s::after {
    content: "";
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    height: 2px;
    border-radius: 2px;
    background: var(--green-700, #1B692C);
    opacity: 0.35;
    transform: scaleX(0);
    transform-origin: right center;
    transition: transform 0.35s cubic-bezier(0.65, 0, 0.35, 1);
    pointer-events: none;
  }

  .nav-link-s:hover {
    color: var(--hdr-nav-hover-color, var(--green-700)) !important;
    background: transparent !important;
  }

  .nav-link-s:hover::after,
  .nav-link-s:focus-visible::after {
    transform: scaleX(1);
    transform-origin: left center;
  }

  .nav-link-s:focus-visible {
    outline: none;
  }

  /* Active link: color only. The underline is drawn by .nav-indicator */
  .nav-link-s.active {
    color: var(--hdr-nav-active-color, var(--green-700)) !important;
    background: transparent !important;
    border: none !important;
    font-weight: 600;
  }

  .nav-link-s.active::after {
    opacity: 0;
    transform: scaleX(0);
  }

  /* Sliding indicator */
  .nav-indicator {
    position: absolute;
    left: 0;
    bottom: 0;
    height: 2px;
    width: 0;
    border-radius: 2px;
    background: linear-gradient(90deg, var(--green-700, #1B692C), #2f9e4a);
    transform: translateX(0);
    transition:
      transform 0.45s cubic-bezier(0.65, 0, 0.35, 1),
      width 0.45s cubic-bezier(0.65, 0, 0.35, 1),
      opacity 0.25s ease;
    opacity: 0;
    pointer-events: none;
    will-change: transform, width;
  }

  .nav-indicator.is-visible {
    opacity: 1;
  }

  @media (prefers-reduced-motion: reduce) {

    .nav-link-s,
    .nav-link-s::after,
    .nav-indicator {
      transition: none !important;
    }
  }

  /* ---------- CTA button ---------- */
  .header-cta-btn,
  .site-header .btn-primary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: var(--color-primary, #1B692C) !important;
    border: 1px solid var(--color-primary, #1B692C) !important;
    color: #ffffff !important;
    font-family: var(--font-body);
    font-size: var(--hdr-btn-font-size, 0.92rem) !important;
    font-weight: 700 !important;
    padding: var(--hdr-btn-py, 0.58rem) var(--hdr-btn-px, 1.35rem) !important;
    border-radius: 0 !important;
    box-shadow: 0 4px 14px -3px rgba(27, 105, 44, 0.45) !important;
    text-decoration: none;
    white-space: nowrap;
    flex-shrink: 0;
    transition: all 0.25s ease;
  }

  .header-cta-btn:hover,
  .site-header .btn-primary:hover {
    background: #145222 !important;
    border-color: #145222 !important;
    color: #ffffff !important;
    box-shadow: 0 8px 20px -2px rgba(27, 105, 44, 0.55) !important;
    transform: translateY(-2px);
  }

  #menuBtn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: var(--hdr-toggle-size, 40px);
    height: var(--hdr-toggle-size, 40px);
    font-size: var(--hdr-toggle-font-size, 1.3rem);
    padding: 0 !important;
    cursor: pointer;
    line-height: 1;
    color: var(--green-900) !important;
    transition: background 0.2s ease, color 0.2s ease;
  }

  #menuBtn:hover {
    /* background: var(--green-50) !important; */
    color: var(--green-700) !important;
  }

  .progress-top {
    position: absolute;
    left: 0;
    bottom: 0;
    height: var(--hdr-prog-h);
    background: var(--hdr-prog-gradient);
    width: 0;
    z-index: 1031;
    transition: width 0.1s linear;
  }

  /* ---------- Mobile Drawer & Backdrop ---------- */
  .mobile-menu-backdrop {
    position: fixed;
    inset: 0;
    top: var(--hdr-height);
    background: var(--mob-backdrop-bg);
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    z-index: 1028;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s ease;
  }

  .mobile-menu-backdrop.open {
    opacity: 1;
    pointer-events: auto;
  }

  .mobile-menu {
    display: flex;
    flex-direction: column;
    gap: var(--mob-menu-gap);
    position: fixed;
    top: var(--hdr-height);
    bottom: 0;
    left: 0;
    width: var(--mob-menu-width);
    max-width: 85vw;
    background: var(--mob-menu-bg);
    border-right: var(--mob-menu-border);
    box-shadow: var(--mob-menu-shadow);
    padding: var(--mob-menu-padding);
    font-family: var(--font-body);
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
    z-index: 1029;
    transform: translateX(-100%);
    transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    visibility: hidden;
  }

  .mobile-menu.open {
    transform: translateX(0);
    visibility: visible;
  }

  .mobile-menu a:not(.btn) {
    display: flex;
    align-items: center;
    color: var(--mob-menu-link-color, #3b4a5c);
    font-family: var(--font-body);
    font-size: var(--mob-menu-link-font-size);
    font-weight: var(--mob-menu-link-font-weight);
    padding: var(--mob-menu-link-py) var(--mob-menu-link-px);
    border-bottom: var(--mob-menu-link-divider);
    text-decoration: none;
    transition: background 0.2s ease, color 0.2s ease, padding-left 0.2s ease;
  }

  .mobile-menu a:not(.btn):hover {
    color: var(--mob-menu-link-hover-color);
    background: var(--mob-menu-link-hover-bg);
    padding-left: calc(var(--mob-menu-link-px) + 4px);
  }

  .mobile-menu .btn,
  .mobile-cta-btn {
    margin-top: 0.75rem;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--hdr-btn-bg) !important;
    border: 1px solid var(--hdr-btn-bg) !important;
    color: var(--hdr-btn-color) !important;
    font-family: var(--font-body);
    font-size: var(--hdr-btn-font-size) !important;
    font-weight: var(--hdr-btn-font-weight) !important;
    padding: var(--hdr-btn-py) var(--hdr-btn-px) !important;
    box-shadow: var(--hdr-btn-shadow) !important;
    text-decoration: none;
  }

  @media (max-width: 575.98px) {
    .site-header {
      height: 64px !important;
      min-height: 64px !important;
    }

    .site-header .container {
      padding-left: 12px !important;
      padding-right: 12px !important;
      gap: 8px;
    }

    .site-header .logo {
      min-width: 0;
      flex-shrink: 1;
    }

    .site-header .logo-img {
      height: 28px !important;
      max-height: 28px !important;
      max-width: 130px;
    }

    .header-cta-btn {
      font-size: 0.78rem !important;
      padding: 0.38rem 0.65rem !important;
      white-space: nowrap;
    }

    #menuBtn {
      width: 36px !important;
      height: 36px !important;
      font-size: 1.2rem !important;
      flex-shrink: 0;
    }

    .mobile-menu,
    .mobile-menu-backdrop {
      top: 64px !important;
    }

    .mobile-menu {
      width: 280px !important;
      max-width: 84vw !important;
    }
  }

  @media (max-width: 375.98px) {
    .site-header .container {
      padding-left: 8px !important;
      padding-right: 8px !important;
      gap: 6px;
    }

    .site-header .logo-img {
      height: 25px !important;
      max-height: 25px !important;
      max-width: 105px;
    }

    .header-cta-btn {
      font-size: 0.72rem !important;
      padding: 0.32rem 0.48rem !important;
    }
  }

  @media (min-width: 992px) {

    .mobile-menu,
    .mobile-menu-backdrop {
      display: none !important;
    }
  }
</style>

<script>
  (function() {
    const IS_HOME = <?= $isHome ? 'true' : 'false' ?>;

    const mm = document.getElementById('mobileMenu'),
      mb = document.getElementById('menuBtn'),
      mbd = document.getElementById('mobileMenuBackdrop'),
      hd = document.querySelector('.site-header'),
      prog = document.getElementById('prog'),
      nav = document.getElementById('mainNav'),
      indicator = document.getElementById('navIndicator');

    /* ---------- Sliding nav indicator ---------- */
    function moveIndicator(instant) {
      if (!nav || !indicator) return;
      const active = nav.querySelector('.nav-link-s.active');

      if (!active) {
        indicator.classList.remove('is-visible');
        return;
      }

      if (instant) indicator.style.transition = 'none';

      indicator.style.width = active.offsetWidth + 'px';
      indicator.style.transform = 'translateX(' + active.offsetLeft + 'px)';
      indicator.classList.add('is-visible');

      if (instant) {
        void indicator.offsetWidth; // force reflow so next change animates
        indicator.style.transition = '';
      }
    }

    // First placement without sliding in from 0
    moveIndicator(true);
    window.addEventListener('load', () => moveIndicator(true));
    window.addEventListener('resize', () => moveIndicator(true));
    if (document.fonts && document.fonts.ready) {
      document.fonts.ready.then(() => moveIndicator(true));
    }

    /* ---------- Mobile menu ---------- */
    const toggleMenu = (open) => {
      if (!mm) return;
      const isOpen = open !== undefined ? open : !mm.classList.contains('open');
      mm.classList.toggle('open', isOpen);
      if (mbd) mbd.classList.toggle('open', isOpen);
      if (mb) {
        mb.setAttribute('aria-expanded', isOpen);
        const icon = mb.querySelector('i');
        if (icon) {
          icon.className = isOpen ? 'bi bi-x-lg' : 'bi bi-list';
        }
      }
    };

    if (mb) mb.addEventListener('click', (e) => {
      e.stopPropagation();
      toggleMenu();
    });
    if (mbd) mbd.addEventListener('click', () => toggleMenu(false));
    document.querySelectorAll('#mobileMenu a').forEach(a => a.addEventListener('click', () => toggleMenu(false)));
    document.addEventListener('click', (e) => {
      if (mm && mm.classList.contains('open') && !mm.contains(e.target) && mb && !mb.contains(e.target)) {
        toggleMenu(false);
      }
    });

    /* ---------- Scroll state: header, progress bar, scrollspy ---------- */
    const links = document.querySelectorAll('#mainNav a'),
      mobLinks = document.querySelectorAll('#mobileMenu a:not(.btn)'),
      trackedSecIds = ['how-it-works', 'why-motozo', 'list-lot', 'faq', 'contact'];

    let lastActiveKey = null;
    let spyLocked = false;
    let spyTimer = null;

    const setActive = (activeSectionId) => {
      // Only touch the DOM when the active section actually changes
      if (activeSectionId === lastActiveKey) return;
      lastActiveKey = activeSectionId;

      const updateLinkActive = (l) => {
        const href = (l.getAttribute('href') || '').trim();
        if (!activeSectionId) {
          l.classList.toggle('active', href === 'index.php' || href === '#' || href === '#main' || href === '#get-started' || href.includes('home=1'));
        } else {
          l.classList.toggle('active', href.endsWith('#' + activeSectionId));
        }
      };

      links.forEach(updateLinkActive);
      mobLinks.forEach(updateLinkActive);
      moveIndicator(false);
    };

    // After a nav click, ignore scrollspy until the smooth scroll has finished
    const lockSpy = () => {
      spyLocked = true;
      clearTimeout(spyTimer);
      spyTimer = setTimeout(() => {
        spyLocked = false;
      }, 900);
    };

    window.addEventListener('scroll', () => {
      const h = document.documentElement,
        scrollHeight = h.scrollHeight - window.innerHeight;
      const p = scrollHeight > 0 ? Math.min(1, Math.max(0, window.scrollY / scrollHeight)) : 0;
      if (prog) prog.style.width = (p * 100) + '%';
      if (hd) {
        const isScrolled = window.scrollY > 20;
        hd.classList.toggle('solid', isScrolled);
        hd.classList.toggle('scrolled', isScrolled);
      }

      // Scrollspy only makes sense on the home page
      if (!IS_HOME) return;

      // Clicked link stays active while the page is smooth-scrolling
      if (spyLocked) {
        lockSpy();
        return;
      }

      let activeSectionId = '';
      if (window.scrollY > 120) {
        trackedSecIds.forEach((id) => {
          const el = document.getElementById(id);
          if (el && el.getBoundingClientRect().top < window.innerHeight * 0.45) {
            activeSectionId = id;
          }
        });
      }

      setActive(activeSectionId);
    }, {
      passive: true
    });

    /* ---------- Smooth anchor navigation with fixed header offset ---------- */
    document.addEventListener('click', (e) => {
      const anchor = e.target.closest('a');
      if (!anchor) return;
      const href = (anchor.getAttribute('href') || '').trim();
      if (!href) return;

      const currentFile = window.location.pathname.split('/').pop() || 'index.php';
      const isHomeUrl = (currentFile === '' || currentFile === 'index.php');

      // Scroll to top for Home links on home page
      if ((href === '#' || href === '#main' || href === 'index.php' || href === 'index.php?home=1' || href === './') && isHomeUrl) {
        e.preventDefault();
        toggleMenu(false);
        if (IS_HOME) {
          lockSpy();
          setActive('');
        }
        window.scrollTo({
          top: 0,
          behavior: 'smooth'
        });
        if (history.pushState) {
          history.pushState(null, null, window.location.pathname);
        }
        return;
      }

      // Anchor links with hash
      const hashIdx = href.indexOf('#');
      if (hashIdx === -1) return;

      const pathPart = href.substring(0, hashIdx).split('?')[0].split('/').pop();
      const hashPart = href.substring(hashIdx + 1);
      if (!hashPart || hashPart === '!') return;

      if (!pathPart || pathPart === currentFile || (isHomeUrl && pathPart === 'index.php')) {
        const targetEl = document.getElementById(hashPart);
        if (targetEl) {
          e.preventDefault();
          toggleMenu(false);

          if (IS_HOME && trackedSecIds.indexOf(hashPart) !== -1) {
            lockSpy();
            setActive(hashPart);
          }

          const headerEl = document.querySelector('.site-header');
          const headerHeight = headerEl ? headerEl.offsetHeight : 80;
          const targetRect = targetEl.getBoundingClientRect();
          const targetTop = targetRect.top + window.pageYOffset - headerHeight - 18;

          window.scrollTo({
            top: Math.max(0, targetTop),
            behavior: 'smooth'
          });

          if (history.pushState) {
            history.pushState(null, null, '#' + hashPart);
          }
        }
      }
    });
  })();
</script>