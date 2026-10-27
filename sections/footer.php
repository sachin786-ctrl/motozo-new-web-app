<?php
/**
 * ==========================================================================
 * FOOTER & FLOATING ACTIONS (Self-Contained: HTML + CSS + JS)
 * Fully responsive, optimized, with dynamic routing and clean styling.
 * ==========================================================================
 */

$isHome = (isset($pageType) && $pageType === 'home');
$baseUri = defined('BASE') ? BASE : '/';
$homePrefix = $isHome ? '' : ($baseUri . 'index.php');
$homeUrl = $baseUri . 'index.php?home=1';
$waQuoteUrl = 'https://wa.me/919711941108?text=' . rawurlencode('Hello Motozo Team, I want to scrap/sell my vehicle. Please assist me with an instant fair valuation.');
?>

<footer class="site-footer">
  <div class="container">
    <!-- Main Footer Navigation Grid -->
    <div class="row g-4 g-lg-5 footer-main-grid">

      <!-- Column 1: Brand & Overview -->
      <div class="col-12 col-md-6 col-lg-4 col-xl-3">
        <a href="<?= $homeUrl ?>" class="logo text-decoration-none d-inline-flex align-items-center" aria-label="Motozo Home" onclick="try{sessionStorage.setItem('motozo_home_stay','1');}catch(e){}">
          <img src="<?= $baseUri ?>assets/media/footer_logo.webp" alt="Motozo.in" class="logo-img" width="150" height="38">
        </a>
        <p class="mt-3 brand-desc">
          India's trusted marketplace connecting vehicle owners and scrap sellers with authorized Registered Vehicle Scrapping Facilities (RVSF) for guaranteed fair value, free doorstep towing, and official VAHAN de-registration.
        </p>
        <div class="socials mt-3">
          <a href="https://www.linkedin.com/company/motozoofficial" target="_blank" rel="noopener noreferrer" aria-label="Follow Motozo on LinkedIn"><i class="bi bi-linkedin"></i></a>
          <a href="https://www.instagram.com/motozoofficial" target="_blank" rel="noopener noreferrer" aria-label="Follow Motozo on Instagram"><i class="bi bi-instagram"></i></a>
          <a href="https://www.facebook.com/motozoofficial" target="_blank" rel="noopener noreferrer" aria-label="Follow Motozo on Facebook"><i class="bi bi-facebook"></i></a>
          <a href="<?= $waQuoteUrl ?>" target="_blank" rel="noopener noreferrer" aria-label="Chat with Motozo on WhatsApp"><i class="bi bi-whatsapp"></i></a>
        </div>
      </div>

      <!-- Column 2: Scrappage Services -->
      <div class="col-6 col-md-3 col-lg-2">
        <h4>Services</h4>
        <ul>
          <li><a href="<?= $homePrefix ?>#quote">Car Scrapping</a></li>
          <li><a href="<?= $homePrefix ?>#quote">10-Yr Diesel Scrap</a></li>
          <li><a href="<?= $homePrefix ?>#quote">15-Yr Petrol Scrap</a></li>
          <li><a href="<?= $homePrefix ?>#list-lot">Commercial &amp; Fleets</a></li>
          <li><a href="<?= $homePrefix ?>#contact">Accidental / Total Loss</a></li>
          <li><a href="<?= $homePrefix ?>#contact">Two-Wheeler Scrap</a></li>
          <li><a href="<?= $homePrefix ?>#how-it-works">Certificate of Deposit</a></li>
        </ul>
      </div>

      <!-- Column 3: Platform -->
      <div class="col-6 col-md-3 col-lg-2">
        <h4>Platform</h4>
        <ul>
          <li><a href="<?= $homePrefix ?>#quote">Get Free Quote</a></li>
          <li><a href="<?= $homePrefix ?>#how-it-works">How It Works</a></li>
          <li><a href="<?= $homePrefix ?>#why-motozo">Why Motozo</a></li>
          <li><a href="<?= $homePrefix ?>#categories">Vehicles &amp; Scrap</a></li>
          <li><a href="<?= $homePrefix ?>#list-lot">List Bulk Scrap Lot</a></li>
          <li><a href="<?= $homePrefix ?>#faq">FAQs &amp; Guidance</a></li>
          <li><a href="<?= $baseUri ?>contact.php">Contact Us</a></li>
        </ul>
      </div>

      <!-- Column 4: Scrap Centers (Delhi-NCR) -->
      <div class="col-6 col-md-4 col-lg-2">
        <h4>Scrap Centers</h4>
        <ul>
          <li><a href="<?= $baseUri ?>car-scrap-dealer-delhi.php">Delhi </a></li>
          <li><a href="<?= $baseUri ?>car-scrap-dealer-noida.php">Noida </a></li>
          <li><a href="<?= $baseUri ?>car-scrap-dealer-greater-noida.php">Greater Noida </a></li>
          <li><a href="<?= $baseUri ?>car-scrap-dealer-gurgaon.php">Gurgaon </a></li>
          <li><a href="<?= $baseUri ?>car-scrap-dealer-ghaziabad.php">Ghaziabad </a></li>
          <li><a href="<?= $baseUri ?>car-scrap-dealer-faridabad.php">Faridabad </a></li>
          <li><a href="<?= $baseUri ?>car-scrap-dealer-jaipur.php">Jaipur </a></li>
          <li><a href="<?= $baseUri ?>car-scrap-dealer-rajasthan.php">Rajasthan </a></li>
          <li><a href="<?= $baseUri ?>car-scrap-dealer-muzaffarnagar.php">Muzaffarnagar </a></li>
        </ul>
      </div>

      <!-- Column 5: Official Contact & Desk -->
      <div class="col-12 col-md-8 col-lg-4 col-xl-3">
        <h4>Contact &amp; Support</h4>
        <ul class="contact-list">
          <!-- Direct Phone -->
          <li>
            <i class="bi bi-telephone-fill"></i>
            <div>
              <a href="tel:+919711941108" class="contact-main-link">+91 9711 9411 08</a>
              <span class="contact-note">Mon – Sun: 9:00 AM – 8:00 PM</span>
            </div>
          </li>

          <!-- WhatsApp Chat -->
          <li>
            <i class="bi bi-whatsapp"></i>
            <div>
              <a href="<?= $waQuoteUrl ?>" target="_blank" rel="noopener noreferrer" class="contact-main-link">Chat on WhatsApp</a>
            </div>
          </li>

          <!-- Email -->
          <li>
            <i class="bi bi-envelope-fill"></i>
            <div>
              <a href="https://mail.google.com/mail/?view=cm&fs=1&to=info@motozo.in" target="_blank" rel="noopener noreferrer" class="contact-main-link">info@motozo.in</a>
            </div>
          </li>

          <!-- Office Address -->
          <li>
            <i class="bi bi-geo-alt-fill"></i>
            <div>
              <a href="https://maps.app.goo.gl/rurUfDgriS5A2NtWA" target="_blank" rel="noopener noreferrer" class="contact-main-link">B-10, Sector 2, Noida</a>
            </div>
          </li>
        </ul>
      </div>

    </div>

    <!-- Footer Bottom Bar -->
    <div class="footer-bottom">
      <div class="bottom-copy">
        <span>&copy; <?= date('Y') ?> Motozo.in | All rights reserved.</span>
      </div>
      <div class="bottom-links">
        <a href="<?= $baseUri ?>terms.php">Terms &amp; Conditions</a>
        <span class="sep">&bull;</span>
        <a href="<?= $baseUri ?>privacy.php">Privacy Policy</a>
      </div>
    </div>

  </div>
</footer>

<!-- Floating WhatsApp & Back-to-Top Actions -->
<a class="fab fab-wa" href="<?= $waQuoteUrl ?>" target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp with Motozo">
  <i class="bi bi-whatsapp"></i>
  <span class="fab-wa-badge">Instant Quote</span>
</a>

<!-- Clockwise Progress Animated Back-to-Top -->
<button class="fab fab-up" id="toTop" aria-label="Back to top" title="Scroll to top">
  <svg class="progress-ring" viewBox="0 0 48 48">
    <circle class="ring-bg" cx="24" cy="24" r="21"></circle>
    <circle class="ring-bar" id="progressCircle" cx="24" cy="24" r="21"></circle>
  </svg>
  <i class="bi bi-arrow-up"></i>
</button>

<style>
  /* ==========================================================================
     FOOTER STYLES (Self-Contained & Clean)
     ========================================================================== */
  .site-footer {
    background: #1f2322;
    color: var(--color-footer-text, #FCFCF7);
    padding: 3.5rem 0 1.5rem;
    position: relative;
    z-index: 2;
    font-family: var(--font-body, "Poppins", sans-serif);
    border-top: 1px solid rgba(255, 255, 255, 0.08);
  }

  .footer-main-grid {
    margin-bottom: 2rem;
  }

  .site-footer .logo-img {
    background: transparent;
    height: 38px;
    width: auto;
    object-fit: contain;
  }

  .site-footer .brand-desc {
    color: rgba(252, 252, 247, 0.78);
    font-size: 0.88rem;
    line-height: 1.6;
    margin-bottom: 1.25rem;
  }

  /* Headings & Lists */
  .site-footer h4 {
    color: #ffffff;
    font-size: 1.02rem;
    font-weight: 700;
    letter-spacing: -0.01em;
    margin-bottom: 1.15rem;
    position: relative;
    padding-bottom: 0.5rem;
  }

  .site-footer h4::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 24px;
    height: 2px;
    background: var(--accent, #2fbf71);
    border-radius: 2px;
  }

  .site-footer ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .site-footer li {
    margin: 0.55rem 0;
    font-size: 0.88rem;
  }

  .site-footer a {
    color: rgba(252, 252, 247, 0.75);
    text-decoration: none;
    transition: color 0.2s ease, transform 0.2s ease;
    display: inline-block;
  }

  .site-footer a:hover {
    color: #ffffff;
    transform: translateX(2px);
  }

  /* Social Icons */
  .socials {
    display: flex;
    gap: 0.6rem;
    margin-top: 1rem;
  }

  .socials a {
    width: 38px;
    height: 38px;
    background: rgba(255, 255, 255, 0.07);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    display: grid;
    place-items: center;
    color: #fff;
    font-size: 1.05rem;
    transition: all 0.2s ease;
    transform: none;
  }

  .socials a:hover {
    background: var(--green-700, #1B692C);
    border-color: var(--green-700, #1B692C);
    color: #ffffff;
    transform: translateY(-3px);
  }

  /* Contact List Details */
  .contact-list li {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    margin-bottom: 0.85rem;
  }

  .contact-list i {
    color: var(--accent, #2fbf71);
    font-size: 1.05rem;
    line-height: 1.4;
    flex-shrink: 0;
  }

  .contact-main-link {
    font-weight: 600;
    color: #ffffff !important;
    display: block;
    line-height: 1.4;
  }

  .contact-main-link:hover {
    color: var(--accent, #2fbf71) !important;
  }

  .contact-note {
    display: block;
    font-size: 0.76rem;
    color: rgba(252, 252, 247, 0.65);
    margin-top: 2px;
  }

  /* Footer Bottom Bar */
  .footer-bottom {
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    padding-top: 1.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 1rem;
    font-size: 0.84rem;
    color: rgba(252, 252, 247, 0.68);
  }

  .bottom-copy {
    display: flex;
    align-items: center;
    gap: 1.25rem;
  }

  .bottom-links {
    display: flex;
    align-items: center;
    gap: 0.65rem;
  }

  .bottom-links a {
    color: rgba(252, 252, 247, 0.75);
    text-decoration: none;
    transition: color 0.2s ease;
  }

  .bottom-links a:hover {
    color: #ffffff;
  }

  .bottom-links .sep {
    color: rgba(255, 255, 255, 0.25);
    font-size: 0.7rem;
  }

  /* ==========================================================================
     FLOATING ACTIONS (WhatsApp & Back-to-Top)
     ========================================================================== */
  .fab {
    position: fixed;
    right: 24px;
    z-index: 1050;
    width: 56px;
    height: 56px;
    border-radius: 50%;
    display: grid;
    place-items: center;
    color: #ffffff;
    font-size: 1.45rem;
    border: 0;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
    cursor: pointer;
    text-decoration: none;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    transform: translateZ(0);
    transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.25s ease, background-color 0.2s ease;
  }

  .fab:hover {
    color: #ffffff;
    transform: scale(1.08) translateZ(0);
  }

  /* WhatsApp Floating Button */
  .fab-wa {
    bottom: 24px;
    background: #25D366;
    box-shadow: 0 8px 24px rgba(37, 211, 102, 0.45);
    isolation: isolate;
  }

  .fab-wa:hover {
    background: #20ba5a;
    box-shadow: 0 12px 30px rgba(37, 211, 102, 0.6);
  }

  .fab-wa i {
    position: relative;
    z-index: 2;
    font-size: 1.8rem;
    line-height: 1;
    color: #ffffff;
    transition: transform 0.3s ease;
  }

  .fab-wa:hover i {
    transform: scale(1.08) rotate(-4deg);
  }

  .fab-wa-badge {
    position: absolute;
    right: calc(100% + 12px);
    top: 50%;
    transform: translateY(-50%);
    background: #1f2322;
    color: #ffffff;
    font-size: 0.78rem;
    font-weight: 600;
    padding: 0.35rem 0.75rem;
    border-radius: 20px;
    white-space: nowrap;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.2);
    border: 1px solid rgba(37, 211, 102, 0.3);
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transition: opacity 0.25s ease, visibility 0.25s ease, transform 0.25s ease;
  }

  .fab-wa-badge::after {
    content: "";
    position: absolute;
    left: 100%;
    top: 50%;
    transform: translateY(-50%);
    border-width: 5px;
    border-style: solid;
    border-color: transparent transparent transparent #1f2322;
  }

  .fab-wa:hover .fab-wa-badge {
    opacity: 1;
    visibility: visible;
    transform: translateY(-50%) translateX(-4px);
  }

  /* Expanding Wave Rings */
  .fab-wa::before,
  .fab-wa::after {
    content: "";
    position: absolute;
    inset: 0;
    border-radius: 50%;
    background: #25D366;
    opacity: 0.7;
    z-index: 0;
    pointer-events: none;
    box-shadow: 0 0 18px rgba(37, 211, 102, 0.45);
    animation: waWavePulse 2.4s cubic-bezier(0.1, 0.6, 0.2, 1) infinite;
  }

  .fab-wa::after {
    animation-delay: 1.2s;
  }

  @keyframes waWavePulse {
    0% {
      transform: scale(1);
      opacity: 0.75;
    }
    50% {
      opacity: 0.35;
    }
    100% {
      transform: scale(1.95);
      opacity: 0;
    }
  }

  /* Back-to-Top with Progress Ring */
  .fab-up {
    bottom: 96px;
    background: #ffffff;
    color: var(--green-700, #1B692C);
    border: none;
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transform: translateY(15px) scale(0.9);
    transition: opacity 0.3s ease, transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.3s ease, background-color 0.2s ease;
  }

  .fab-up.show {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
    transform: translateY(0) scale(1);
  }

  .fab-up.show:hover {
    background: var(--green-700, #1B692C);
    color: #ffffff;
    transform: translateY(-3px) scale(1.08);
  }

  .progress-ring {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    transform: rotate(-90deg);
    pointer-events: none;
  }

  .ring-bg {
    fill: none;
    stroke: rgba(27, 105, 44, 0.15);
    stroke-width: 3;
  }

  .ring-bar {
    fill: none;
    stroke: var(--green-700, #1B692C);
    stroke-width: 3;
    stroke-linecap: round;
    transition: stroke-dashoffset 0.08s linear;
  }

  .fab-up i {
    position: relative;
    z-index: 2;
    font-size: 1.25rem;
  }

  /* ==========================================================================
     RESPONSIVE BREAKPOINTS
     ========================================================================== */
  @media (max-width: 991.98px) {
    .site-footer {
      padding: 3rem 0 1.5rem;
    }
  }

  @media (max-width: 575.98px) {
    .site-footer {
      padding: 2.5rem 0 1.25rem;
      overflow-x: clip;
    }

    .footer-bottom {
      flex-direction: column;
      text-align: center;
      gap: 0.75rem;
      margin-top: 1.5rem;
    }

    .bottom-copy {
      justify-content: center;
    }

    .bottom-links {
      justify-content: center;
      flex-wrap: wrap;
    }

    .fab {
      width: 48px;
      height: 48px;
      font-size: 1.25rem;
      right: 16px;
    }

    .fab-wa {
      bottom: 16px;
    }

    .fab-wa i {
      font-size: 1.5rem;
    }

    .fab-wa-badge {
      display: none;
    }

    .fab-up {
      bottom: 76px;
      right: 16px;
    }
  }
</style>

<script>
  (function() {
    const toTop = document.getElementById('toTop');
    const progressCircle = document.getElementById('progressCircle');

    if (toTop && progressCircle) {
      const radius = 21;
      const circumference = 2 * Math.PI * radius; // ~131.95

      progressCircle.style.strokeDasharray = `${circumference}`;
      progressCircle.style.strokeDashoffset = `${circumference}`;

      const updateProgress = () => {
        const scrollTop = window.scrollY;
        const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;

        if (scrollHeight > 0) {
          const scrollPercent = Math.min(Math.max(scrollTop / scrollHeight, 0), 1);
          const offset = circumference - (scrollPercent * circumference);
          progressCircle.style.strokeDashoffset = offset;
        }

        toTop.classList.toggle('show', scrollTop > 150);
      };

      toTop.addEventListener('click', () => {
        window.scrollTo({
          top: 0,
          behavior: 'smooth'
        });
      });

      window.addEventListener('scroll', updateProgress, {
        passive: true
      });
      updateProgress();
    }
  })();
</script>