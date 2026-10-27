<?php

/**
 * Fast Valuation Quote Form Component
 * Reusable across Hero, District landing pages (Delhi, Noida, etc.), Modals, and standalone sections.
 */
if (session_status() !== PHP_SESSION_ACTIVE && file_exists(__DIR__ . '/../includes/bootstrap.php')) {
  require_once __DIR__ . '/../includes/bootstrap.php';
}

$csrfToken   = $_SESSION['csrf'] ?? '';
$currentSlug = $districtSlug ?? '';
$currentCity = $districtName ?? '';
$actionUrl   = (defined('BASE') ? BASE : '/') . 'send-mail.php';
?>

<div class="quote-card">
  <form id="contact-form" novalidate>
<?php
$quoteBadgeText = $districtData['quote']['badge'] ?? (!empty($currentCity) ? $currentCity . ' Fast Valuation' : 'Fast Valuation');
$quoteSubtitleText = $districtData['quote']['subtitle'] ?? (!empty($currentCity) ? 'Enter vehicle details for instant scrap value in <strong>' . htmlspecialchars($currentCity, ENT_QUOTES, 'UTF-8') . '</strong>.' : 'Enter vehicle details to get instant scrap value.');
?>
    <div class="quote-header text-start">
      <span class="quote-badge">
        <?php if (!empty($currentCity)): ?>
          <i class="bi bi-geo-alt-fill text-success"></i> <?= htmlspecialchars($quoteBadgeText, ENT_QUOTES, 'UTF-8') ?>
        <?php else: ?>
          <i class="bi bi-lightning-charge-fill"></i> <?= htmlspecialchars($quoteBadgeText, ENT_QUOTES, 'UTF-8') ?>
        <?php endif; ?>
      </span>
      <h2 class="text-start"><span class="quote-static">Get Quote</span> <span class="flip" data-flip='["Instantly", "Now"]'>Instantly</span></h2>
      <p class="quote-subtitle text-start"><?= $quoteSubtitleText ?></p>
    </div>

    <!-- Anti-spam Honeypot -->
    <input type="text" name="website" class="d-none" tabindex="-1" autocomplete="off" aria-hidden="true">

    <!-- Security CSRF Token -->
    <?php if (!empty($csrfToken)): ?>
      <input type="hidden" name="csrf" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
    <?php endif; ?>

    <!-- Dynamic District / Source Tracking -->
    <?php if (!empty($currentSlug)): ?>
      <input type="hidden" name="source_slug" value="<?= htmlspecialchars($currentSlug, ENT_QUOTES, 'UTF-8') ?>">
    <?php endif; ?>

    <div class="row g-2">
      <div class="col-6">
        <input type="text" name="user_name" class="form-control" placeholder="Full Name" required>
      </div>

      <div class="col-6">
        <input type="tel" name="user_phone" class="form-control" maxlength="10" pattern="[0-9]{10}" oninput="this.value=this.value.replace(/[^0-9]/g,'')" placeholder="Phone Number" autocomplete="tel" required>
      </div>

      <div class="col-12">
        <input type="email" name="user_email" class="form-control" placeholder="Email Address" required>
      </div>

      <div class="col-6">
        <select name="vehicle_type" class="form-select" required>
          <option value="" disabled selected>Vehicle Type</option>
          <option value="Car">Car</option>
          <option value="Bike">Bike</option>
          <option value="Bus">Bus</option>
          <option value="Truck">Truck</option>
          <option value="Commercial Vehicle">Commercial Vehicle</option>
          <option value="Other">Other</option>
        </select>
      </div>

      <div class="col-6">
        <select name="service_type" class="form-select" required>
          <option value="" disabled selected>Vehicle Condition</option>
          <option value="Scrap Vehicle">Scrap Vehicle</option>
          <option value="Sell Old Vehicle">Sell Old Vehicle</option>
          <option value="Purchase COD">Purchase COD</option>
          <option value="Sale COD">Sale COD</option>
        </select>
      </div>

      <div class="col-12">
        <input type="text" id="quote-loc-input" name="user_city" class="form-control" value=""
               placeholder="City / RTO Location / PIN Code" autocomplete="off" required>
        <input type="hidden" name="user_pincode" id="quote-pincode">
        <input type="hidden" name="user_location_verified" id="quote-loc-verified" value="0">
        <div id="loc-status" class="loc-status" aria-live="polite"></div>
      </div>

      <div class="col-12 mt-2">
        <button type="submit" id="submit-btn" class="btn btn-brand fw-bold w-100 py-2 d-flex align-items-center justify-content-center gap-2 shadow-sm">
          <span id="btn-spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
          <span id="btn-text">Get Quote Instantly →</span>
        </button>
      </div>
    </div>

    <div id="form-msg" class="small fw-semibold mt-2 text-center" role="alert" aria-live="polite"></div>

    <div class="text-center text-muted small mt-2 d-flex align-items-center justify-content-center gap-1" style="font-size: 0.76rem;">
      <i class="bi bi-shield-check text-success fs-6"></i> 100% Secure &amp; Confidential. Response within 30 mins.
    </div>
  </form>
</div>

<style>
  /* Self-Contained Quote Card Styles */
  .quote-card {
    background: #ffffff;
    color: var(--ink, #1f2937);
    padding: 1.65rem 1.75rem 1.4rem;
    max-width: 400px;
    width: 100%;
    margin-left: auto;
    margin-right: 0;
    box-shadow: 0 25px 60px -15px rgba(0, 0, 0, .55), 0 0 0 1px rgba(255, 255, 255, .9);
    position: relative;
    z-index: 2;
  }

  .quote-card .quote-header {
    text-align: left;
    margin-bottom: 1rem;
  }

  .quote-card .quote-badge {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
    background: var(--green-50, #EEF7F1);
    color: var(--green-700, #1B692C);
    font-size: .72rem;
    font-weight: 700;
    letter-spacing: .05em;
    text-transform: uppercase;
    padding: .22rem .65rem;
    margin-bottom: .35rem;
  }

  .quote-card h2 {
    font-family: var(--font-heading, var(--font-serif)) !important;
    font-size: 1.45rem !important;
    font-weight: 800 !important;
    margin-bottom: .22rem !important;
    color: #0b1f17 !important;
    letter-spacing: -.01em !important;
    display: flex !important;
    align-items: center !important;
    justify-content: flex-start !important;
    text-align: left !important;
    gap: .35rem !important;
    line-height: 1.25 !important;
  }

  .quote-card h2.text-start {
    justify-content: flex-start;
    text-align: left;
  }

  .quote-card h2 .quote-static {
    white-space: nowrap;
    flex-shrink: 0;
  }

  /* ---------- Flip word: letter-by-letter pop (same as hero) ---------- */
  .quote-card h2 .flip {
    color: var(--green-700, #1B692C);
    position: relative;
    display: inline-flex;
    align-items: start;
    justify-content: start;
    text-align: center;
    min-width: 88px;
    white-space: nowrap;
    flex-shrink: 0;
  }

  /* each letter pops in with a springy bounce */
  .quote-card h2 .flip .ch {
    display: inline-block;
    animation: qcPop .65s cubic-bezier(.34, 1.56, .64, 1) both;
    animation-delay: calc(var(--i) * 55ms);
    will-change: transform, opacity;
  }

  @keyframes qcPop {
    0% {
      opacity: 0;
      transform: translateY(70%) scale(.3) rotate(-14deg);
      filter: blur(3px);
    }

    60% {
      opacity: 1;
      transform: translateY(-14%) scale(1.25) rotate(4deg);
      filter: none;
      text-shadow: 0 0 14px rgba(27, 105, 44, .45), 0 0 26px rgba(47, 191, 113, .35);
    }

    100% {
      opacity: 1;
      transform: none;
      text-shadow: none;
    }
  }

  /* old word flies away letter by letter */
  .quote-card h2 .flip.out .ch {
    animation: qcOut .3s ease-in both;
    animation-delay: calc(var(--i) * 22ms);
  }

  @keyframes qcOut {
    to {
      opacity: 0;
      transform: translateY(-65%) scale(.5) rotate(10deg);
      filter: blur(3px);
    }
  }

  .quote-card .quote-subtitle {
    font-size: .82rem;
    color: var(--muted, #5f756b);
    margin: 0;
    line-height: 1.35;
    text-align: left;
  }

  .quote-card .form-control,
  .quote-card .form-select {
    height: 42px;
    font-size: .86rem;
    padding: .45rem .75rem;
    border: 1.5px solid #d4ded8;
    background-color: #ffffff;
    transition: all .2s ease;
    border-radius: 0 !important;
  }

  .quote-card .form-control:focus,
  .quote-card .form-select:focus {
    border-color: var(--color-primary, #1B692C);
    background-color: #ffffff;
    box-shadow: 0 0 0 3px rgba(27, 105, 44, .18);
  }

  /* City / PIN verification status */
  .quote-card .loc-status {
    font-size: .74rem;
    font-weight: 600;
    margin-top: .25rem;
    min-height: 0;
  }

  .quote-card .loc-status:empty {
    display: none;
  }

  .quote-card .loc-status.ok {
    color: #1B692C;
  }

  .quote-card .loc-status.bad {
    color: #dc3545;
  }

  .quote-card .loc-status.checking {
    color: #5f756b;
  }

  .quote-card .btn-brand {
    background: var(--color-primary, #1B692C) !important;
    color: #ffffff !important;
    border: 1px solid var(--color-primary, #1B692C) !important;
    height: 44px;
    font-size: .94rem;
    padding: .55rem 1rem;
    letter-spacing: -0.01em;
    border-radius: 0 !important;
    box-shadow: 0 4px 14px -2px rgba(27, 105, 44, 0.4) !important;
    transition: all .25s ease;
  }

  .quote-card .btn-brand:hover {
    background: #145222 !important;
    border-color: #145222 !important;
    color: #ffffff !important;
    transform: translateY(-2px);
    box-shadow: 0 8px 22px -2px rgba(27, 105, 44, 0.55) !important;
  }

  #form-msg.ok {
    color: var(--color-primary, #1B692C);
    background: var(--color-primary-soft, #EEF7F1);
    border: 1px solid #cfeedd;
    border-radius: 8px;
    padding: .5rem .75rem;
  }

  #form-msg.bad {
    color: #dc3545;
    background: #fff0f0;
    border: 1px solid #ffd1d1;
    padding: .5rem .75rem;
  }

  /* Animated send icon */
  .sending-icon {
    display: inline-block;
    font-size: 1rem;
    animation: send-slide 0.8s ease-in-out infinite alternate;
  }

  @keyframes send-slide {
    from {
      transform: translateX(0);
    }

    to {
      transform: translateX(5px);
    }
  }

  @media (prefers-reduced-motion: reduce) {
    .sending-icon {
      animation: none;
    }

    .quote-card h2 .flip .ch,
    .quote-card h2 .flip.pop::after {
      animation: none;
      opacity: 1;
    }
  }

  /* Three-dot sending animation */
  .btn-loader {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 4px;
  }

  .btn-loader.d-none {
    display: none !important;
  }

  .btn-loader span {
    width: 5px;
    height: 5px;
    border-radius: 50%;
    background: #ffffff;
    animation: qc-dots 0.8s ease-in-out infinite;
  }

  .btn-loader span:nth-child(2) {
    animation-delay: 0.15s;
  }

  .btn-loader span:nth-child(3) {
    animation-delay: 0.3s;
  }

  @keyframes qc-dots {

    0%,
    60%,
    100% {
      transform: translateY(0);
      opacity: 0.5;
    }

    30% {
      transform: translateY(-5px);
      opacity: 1;
    }
  }

  @media (prefers-reduced-motion: reduce) {
    .btn-loader span {
      animation: none;
    }
  }

  @media (max-width: 991px) {
    .quote-card {
      max-width: 440px;
      margin-top: 1.4rem;
      margin-left: auto;
      margin-right: auto;
      padding: 1.35rem 1.4rem 1.15rem;
    }

    .quote-card h2 {
      font-size: 1.25rem;
    }

    .quote-card h2 .flip {
      min-width: 82px;
      justify-content: center;
      text-align: center;
    }

    .quote-card .form-control,
    .quote-card .form-select {
      height: 39px;
      font-size: .85rem;
    }

    .quote-card .btn-brand {
      height: 42px;
      font-size: .88rem;
    }
  }

  @media (max-width: 575.98px) {
    .quote-card {
      padding: 1.1rem 0.95rem 0.95rem;
      margin-top: 1.1rem;
    }

    .quote-card h2 {
      font-size: 1.12rem;
    }

    .quote-card h2 .flip {
      min-width: 72px;
      justify-content: center;
      text-align: center;
    }

    .quote-card .form-control,
    .quote-card .form-select {
      height: 38px;
      font-size: 0.83rem;
      padding: 0.38rem 0.55rem;
    }

    #submit-btn {
      height: 40px;
      font-size: 0.84rem;
      padding: 0.48rem 0.75rem;
    }
  }

  /* XL se chhoti screens par Quote Form ki width badhao */
  @media (max-width: 1199.98px) {
    .quote-card {
      max-width: 100%;
      width: 100%;
      margin-left: auto;
      margin-right: auto;
    }
  }

  /* Tablet aur medium screens */
  @media (min-width: 576px) and (max-width: 991.98px) {
    .quote-card {
      padding: 1.5rem;
    }
  }

  /* Mobile screens */
  @media (max-width: 575.98px) {
    .quote-card {
      width: 100%;
      max-width: 100%;
      padding: 1.1rem 0.95rem;
    }
  }

  /* Quote form ke baad next section spacing */
  @media (max-width: 991.98px) {
    .quote-card {
      margin-bottom: 2rem;
    }
  }

  .contact-us-link {
    color: var(--green-700, #0e6e3e);
    font-weight: 700;
    text-decoration: underline;
    white-space: nowrap;
  }

  .contact-us-link:hover {
    color: var(--green-800, #094728);
  }
</style>

<script>
  (function() {
    const cf = document.getElementById('contact-form');
    if (!cf || cf.dataset.bound === 'true') return;
    cf.dataset.bound = 'true';

    // ---------- City / PIN verification ----------
    const locInput = document.getElementById('quote-loc-input'),
      locStatus = document.getElementById('loc-status'),
      pinHidden = document.getElementById('quote-pincode'),
      verHidden = document.getElementById('quote-loc-verified');
    let locTimer, locReq = 0, locState = 'idle';

    // Field hamesha khali se start ho (koi script/browser prefill kare to bhi clear)
    function clearLoc() {
      locInput.value = '';
      pinHidden.value = '';
      verHidden.value = '0';
      locStatus.className = 'loc-status';
      locStatus.textContent = '';
      locState = 'idle';
    }
    clearLoc();
    setTimeout(clearLoc, 300);
    window.addEventListener('pageshow', function(ev) {
      if (ev.persisted) clearLoc();
    });

    function setLoc(state, text) {
      locState = state;
      verHidden.value = state === 'ok' ? '1' : '0';
      locStatus.className = 'loc-status ' + state;
      locStatus.textContent = text || '';
    }

    async function verifyLocation() {
      const v = locInput.value.trim();
      pinHidden.value = '';
      if (!v) return setLoc('idle', '');
      const isPin = /^\d+$/.test(v);
      if (isPin && v.length < 6) return setLoc('idle', '');
      if (isPin && v.length > 6) return setLoc('idle', '');
      if (!isPin && v.length < 3) return setLoc('idle', '');

      const id = ++locReq;
      setLoc('checking', 'Checking...');
      try {
        const url = isPin ?
          'https://api.postalpincode.in/pincode/' + v :
          'https://api.postalpincode.in/postoffice/' + encodeURIComponent(v);
        const r = await fetch(url);
        const j = await r.json();
        if (id !== locReq) return; // purani request ignore
        const d = j && j[0];
        if (d && d.Status === 'Success' && d.PostOffice && d.PostOffice.length) {
          const po = d.PostOffice[0];
          if (isPin) {
            pinHidden.value = v;
            setLoc('ok', '✓ ' + po.District + ', ' + po.State + ' (' + v + ')');
          } else {
            setLoc('ok', '✓ ' + po.District + ', ' + po.State);
          }
        } else {
          // If not found in directory, don't show red error or text underneath; accept user input
          setLoc('idle', '');
        }
      } catch (err) {
        if (id !== locReq) return;
        setLoc('idle', '');
      }
    }

    locInput.addEventListener('input', function() {
      clearTimeout(locTimer);
      locTimer = setTimeout(verifyLocation, 500);
    });
    locInput.addEventListener('blur', verifyLocation);

    // ---------- Form submit ----------
    const msg = document.getElementById('form-msg'),
      btn = document.getElementById('submit-btn'),
      spinner = document.getElementById('btn-spinner'),
      btnText = document.getElementById('btn-text');

    cf.addEventListener('submit', async function(e) {
      e.preventDefault();
      if (msg) {
        msg.className = 'small fw-semibold mt-2 text-center';
        msg.textContent = '';
      }
      if (!cf.checkValidity()) {
        cf.reportValidity();
        return;
      }

      // City / PIN check: accept any location entered by user
      const locVal = locInput.value.trim();
      if (!locVal) {
        if (msg) {
          msg.classList.add('bad');
          msg.textContent = 'Please enter your city or PIN code.';
        }
        locInput.focus();
        return;
      }

      if (btn) btn.disabled = true;
      if (spinner) spinner.classList.remove('d-none');
      if (btnText) btnText.textContent = 'Sending...';

      let isSuccess = false;
      try {
        const fd = new FormData(cf);
        const postUrl = '<?= $actionUrl ?>';
        const r = await fetch(postUrl, {
          method: 'POST',
          body: fd
        });
        const rawText = await r.text();
        let d;
        try {
          d = JSON.parse(rawText);
        } catch (jsonErr) {
          console.error("Non-JSON response from server:", rawText);
          throw new Error('Server response invalid');
        }
        if (d.ok) {
          isSuccess = true;
          const submittedName = (fd.get('user_name') || '').trim();
          const submittedCity = (fd.get('user_city') || '').trim();
          const submittedVehicle = (fd.get('vehicle_type') || '').trim();

          if (btn) {
            btn.classList.remove('btn-brand');
            btn.classList.add('btn-success');
          }
          if (spinner) spinner.classList.add('d-none');
          if (btnText) btnText.innerHTML = '<i class="bi bi-check2-circle me-1"></i> Submitted Successfully!';
          if (msg) {
            msg.className = 'small fw-semibold mt-2 text-center ok';
            msg.innerHTML = '<i class="bi bi-patch-check-fill me-1"></i> Success! Opening confirmation...';
          }
          cf.reset();
          setLoc('idle', '');

          const thankYouUrl = '<?= (defined("BASE") ? BASE : "/") ?>thankyou.php?name=' + encodeURIComponent(submittedName) +
            '&city=' + encodeURIComponent(submittedCity) +
            '&v=' + encodeURIComponent(submittedVehicle);

          setTimeout(() => {
            window.location.href = thankYouUrl;
          }, 450);
          return;
        } else {
          if (msg) {
            msg.classList.add('bad');
            msg.textContent = d.error || 'Something went wrong. Please check your entries and try again.';
          }
        }
      } catch (err) {
        console.error("Form submission error:", err);
        if (msg) {
          msg.classList.add('bad');
          msg.textContent = 'Submission error. Please refresh the page (Ctrl+F5) and try again.';
        }
      } finally {
        if (!isSuccess) {
          if (btn) btn.disabled = false;
          if (spinner) spinner.classList.add('d-none');
          if (btnText) btnText.textContent = 'Get Quote Instantly →';
        }
      }
    });

    // Self-contained flip runner (letter-by-letter pop, same style as hero)
    const flipEl = cf.querySelector('.flip[data-flip]');
    if (flipEl && !flipEl.dataset.flipInit) {
      flipEl.dataset.flipInit = 'true';
      try {
        const w = JSON.parse(flipEl.dataset.flip);
        if (Array.isArray(w) && w.length > 1 && !matchMedia('(prefers-reduced-motion:reduce)').matches) {

          const renderWord = function(word) {
            flipEl.setAttribute('aria-label', word);
            flipEl.textContent = '';
            Array.from(word).forEach(function(c, i) {
              const s = document.createElement('span');
              s.className = 'ch';
              s.setAttribute('aria-hidden', 'true');
              s.style.setProperty('--i', i);
              s.textContent = c === ' ' ? '\u00a0' : c;
              flipEl.appendChild(s);
            });
            flipEl.classList.remove('pop');
            void flipEl.offsetWidth;
            flipEl.classList.add('pop');
          };

          let idx = 0;
          renderWord(w[0]);

          const swap = function() {
            if (document.hidden) return;
            flipEl.classList.add('out');
            setTimeout(function() {
              idx = (idx + 1) % w.length;
              flipEl.classList.remove('out');
              renderWord(w[idx]);
            }, 420);
          };

          // start a bit after the hero words so they don't all change together
          setTimeout(function() {
            setInterval(swap, 3200);
          }, 2600);
        }
      } catch (e) {}
    }
  })();
</script>