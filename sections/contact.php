<?php

/**
 * ==========================================================================
 * CONTACT SECTION (HTML + CSS + JS) — Section ID: #contact
 * Fields: user_name, user_phone, user_pincode (city auto-filled into user_city), service_type, user_message
 * Delivers to admin email via send-mail.php, then redirects to thankyou.php
 * Uses global tokens + global buttons (.btn .btn-light-g) from style.css
 * ==========================================================================
 */

if (session_status() !== PHP_SESSION_ACTIVE && file_exists(__DIR__ . '/../includes/bootstrap.php')) {
  require_once __DIR__ . '/../includes/bootstrap.php';
}

$csrfToken   = $_SESSION['csrf'] ?? '';
$currentSlug = $districtSlug ?? '';
$currentCity = $districtName ?? '';
$baseUrl     = defined('BASE') ? BASE : '/';
$actionUrl   = $baseUrl . 'send-mail.php';
$thankyouUrl = $baseUrl . 'thankyou.php';

// Motozo location on Google Maps (replace with your exact Google Maps share link if you have one)
$mapUrl = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode('Motozo, B-10, Sector 2, Noida, Uttar Pradesh 201301');

// value (sent to mail) | label (shown) | small note | icon
$serviceOptions = [
  ['Scrap Vehicle',                  'Scrap Vehicle',                  'End-of-Life / Accidental', 'bi-recycle'],
  ['Sell Old Vehicle',               'Sell Old / Used Vehicle',        '',                         'bi-cash-coin'],
  ['RC Cancellation / VAHAN Query',  'RC Cancellation & VAHAN Query',  '',                         'bi-file-earmark-x'],
  ['Certificate of Deposit (COD)',   'Certificate of Deposit (COD)',   'COD Incentive',            'bi-patch-check'],
  ['Corporate / Bulk Scrappage',     'Corporate / Fleet Scrappage',    '',                         'bi-buildings'],
  ['General Inquiry',                'General Inquiry / Other',        '',                         'bi-chat-dots'],
];

$isContactPage = (isset($pageType) && $pageType === 'contact');
?>

<section class="section-contact <?= $isContactPage ? 'is-standalone-page' : '' ?>" id="contact" aria-labelledby="contact-heading">

  <span class="ct-deco ct-bigblob" aria-hidden="true"></span>

  <div class="container ct-container">
    <div class="row g-4 g-lg-5 align-items-center">

      <!-- LEFT: Heading + Form -->
      <div class="col-12 col-lg-6">
        <div class="contact-header ct-reveal" style="--d:0ms">
          <span class="contact-eyebrow"><i class="bi bi-chat-dots-fill me-1"></i> Get In Touch</span>
          <h2 class="contact-title" id="contact-heading">Have Questions? We’re Here to Help.</h2>
          <p class="contact-subtitle">Send us your inquiry and our specialists will assist you within 30 minutes.</p>
        </div>

        <form id="motozo-contact-form" class="contact-form ct-reveal" style="--d:120ms" novalidate>
          <!-- Anti-spam Honeypot -->
          <input type="text" name="website" class="d-none" tabindex="-1" autocomplete="off" aria-hidden="true">

          <?php if (!empty($csrfToken)): ?>
            <input type="hidden" name="csrf" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
          <?php endif; ?>

          <input type="hidden" name="form_type" value="Contact Form">
          <input type="hidden" name="is_contact_form" value="1">

          <?php if (!empty($currentSlug)): ?>
            <input type="hidden" name="source_slug" value="<?= htmlspecialchars($currentSlug, ENT_QUOTES, 'UTF-8') ?>">
          <?php endif; ?>

          <div class="row g-4">

            <!-- Name -->
            <div class="col-6 col-sm-6">
              <label class="contact-label" for="contact_user_name">Full Name <span class="req-star">*</span></label>
              <div class="ct-field">
                <i class="bi bi-person ct-icon" aria-hidden="true"></i>
                <input type="text" id="contact_user_name" name="user_name" class="contact-input"
                  placeholder="Your Name" autocomplete="name" required minlength="2" maxlength="60"
                  aria-describedby="err_user_name">
              </div>
              <span class="ct-error" id="err_user_name" role="alert"></span>
            </div>

            <!-- Phone -->
            <div class="col-6 col-sm-6">
              <label class="contact-label" for="contact_user_phone">Phone Number <span class="req-star">*</span></label>
              <div class="ct-field">
                <i class="fa-solid fa-phone ct-icon" aria-hidden="true"></i>
                <div class="phone-input-group">
                  <span class="phone-prefix">+91</span>
                  <input type="tel" id="contact_user_phone" name="user_phone" class="contact-input phone-field"
                    placeholder="XXXXXXXX78" maxlength="10" pattern="[6-9][0-9]{9}"
                    inputmode="numeric" autocomplete="tel-national" aria-describedby="err_user_phone" required>
                </div>
              </div>
              <span class="ct-error" id="err_user_phone" role="alert"></span>
            </div>

            <!-- Pincode or City (auto-detected if PIN or typed directly) + location fetch -->
            <div class="col-6 col-sm-6">
              <label class="contact-label" for="contact_user_pincode">Pincode or City Name <span class="req-star">*</span></label>
              <div class="ct-field">
                <i class="bi bi-geo-alt ct-icon" aria-hidden="true"></i>
                <input type="text" id="contact_user_pincode" name="user_pincode" class="contact-input ct-city"
                  placeholder="PIN or City (201301 or Noida)" maxlength="60"
                  autocomplete="postal-code" required
                  aria-describedby="ct_detect err_user_pincode">
                <button type="button" id="ct-locate" class="ct-locate" title="Use my current location" aria-label="Use my current location">
                  <i class="bi bi-crosshair ct-locate-icon" aria-hidden="true"></i>
                  <span class="spinner-border spinner-border-sm ct-locate-spin d-none" role="status" aria-hidden="true"></span>
                </button>
              </div>
              <span class="ct-detect" id="ct_detect" aria-live="polite"></span>
              <span class="ct-error" id="err_user_pincode" role="alert"></span>
              <!-- Auto-detected from PIN code or set directly from City name -->
              <input type="hidden" id="contact_user_city" name="user_city"
                value="<?= !empty($currentCity) ? htmlspecialchars($currentCity, ENT_QUOTES, 'UTF-8') : '' ?>">
            </div>

            <!-- Inquiry type (custom dropdown) -->
            <div class="col-6 col-sm-6">
              <label class="contact-label" id="lbl_service_type" for="contact_service_type_btn">Service / Inquiry Type <span class="req-star">*</span></label>
              <div class="ct-field">
                <i class="bi bi-card-checklist ct-icon" aria-hidden="true"></i>
                <div class="ct-select" id="ct-select">
                  <button type="button" id="contact_service_type_btn" class="contact-input ct-select-btn"
                    aria-haspopup="listbox" aria-expanded="false" aria-controls="ct-options"
                    aria-describedby="err_service_type">
                    <span class="ct-select-label">Select Inquiry Type</span>
                    <i class="bi bi-chevron-down ct-chev" aria-hidden="true"></i>
                  </button>

                  <ul class="ct-options" id="ct-options" role="listbox" aria-labelledby="lbl_service_type">
                    <?php foreach ($serviceOptions as [$val, $label, $note, $icon]): ?>
                      <li role="option" tabindex="-1" aria-selected="false"
                          data-value="<?= htmlspecialchars($val, ENT_QUOTES, 'UTF-8') ?>"
                          data-label="<?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?>">
                        <i class="bi <?= $icon ?> ct-opt-icon" aria-hidden="true"></i>
                        <span class="ct-opt-text">
                          <span class="ct-opt-main"><?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?></span>
                          <?php if ($note !== ''): ?><span class="ct-opt-note"><?= htmlspecialchars($note, ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
                        </span>
                        <i class="bi bi-check2 ct-opt-check" aria-hidden="true"></i>
                      </li>
                    <?php endforeach; ?>
                  </ul>

                  <input type="hidden" id="contact_service_type" name="service_type" value="">
                </div>
              </div>
              <span class="ct-error" id="err_service_type" role="alert"></span>
            </div>

            <!-- Message -->
            <div class="col-12">
              <div class="d-flex align-items-baseline justify-content-between">
                <label class="contact-label" for="contact_user_message">Message / Vehicle Details</label>
                <span class="ct-optional">(Optional)</span>
              </div>
              <div class="ct-field">
                <i class="bi bi-chat-left-text ct-icon" aria-hidden="true"></i>
                <textarea id="contact_user_message" name="user_message" class="contact-input contact-textarea"
                  rows="2" maxlength="1000"
                  placeholder="Vehicle make, model, year, condition or your query..."></textarea>
              </div>
            </div>

            <div class="col-12 mt-4">
              <!-- Global button system: .btn .btn-light-g (white on green) -->
              <button type="submit" id="contact-submit-btn" class="btn btn-light-g contact-submit-btn">
                <span id="contact-btn-content" class="d-inline-flex align-items-center gap-2">
                  <span>Send Message</span>
                  <i class="bi bi-arrow-right" aria-hidden="true"></i>
                </span>
                <span id="contact-btn-spinner" class="d-none align-items-center gap-2" aria-hidden="true">
                  <span class="spinner-border spinner-border-sm" role="status"></span>
                  <span>Sending...</span>
                </span>
              </button>
            </div>
          </div>

          <div id="contact-form-feedback" class="contact-feedback-box d-none" role="alert" aria-live="polite"></div>
        </form>
      </div>

      <!-- RIGHT: Info card -->
      <div class="col-12 col-lg-6">
        <div class="contact-info-card ct-reveal" style="--d:240ms">
          <span class="info-bar" aria-hidden="true"></span>
          <h3 class="info-title">Motozo Support Desk</h3>

          <div class="contact-channels">
            <a href="tel:+919711941108" class="channel-item" aria-label="Call Motozo Customer Support">
              <i class="bi bi-telephone channel-icon" aria-hidden="true"></i>
              <span class="channel-meta">
                <span class="channel-value">+91 9711 9411 08</span>
                <span class="channel-note">Mon – Sun: 9:00 AM – 8:00 PM</span>
              </span>
            </a>

            <a href="https://wa.me/919711941108?text=<?= rawurlencode('Hello Motozo Team, I have an inquiry regarding vehicle scrapping / valuation.') ?>" target="_blank" rel="noopener noreferrer" class="channel-item" aria-label="Chat with Motozo on WhatsApp">
              <i class="bi bi-whatsapp channel-icon" aria-hidden="true"></i>
              <span class="channel-meta">
                <span class="channel-value">WhatsApp Quick Help</span>
              </span>
            </a>

            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=info@motozo.in" target="_blank" rel="noopener noreferrer" class="channel-item" aria-label="Send email to Motozo">
              <i class="bi bi-envelope channel-icon" aria-hidden="true"></i>
              <span class="channel-meta">
                <span class="channel-value">info@motozo.in</span>
              </span>
            </a>

            <a href="<?= htmlspecialchars($mapUrl, ENT_QUOTES, 'UTF-8') ?>" target="_blank" rel="noopener noreferrer" class="channel-item" aria-label="Open Motozo location on Google Maps">
              <i class="bi bi-geo-alt channel-icon" aria-hidden="true"></i>
              <span class="channel-meta">
                <span class="channel-value">B-10, Sector 2, Noida, UP — 201301</span>
                <span class="channel-note">View on Google Maps</span>
              </span>
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<style>
  .section-contact {
    --ct-ink: #ffffff;
    --ct-muted: rgba(255, 255, 255, .85);
    --ct-line: rgba(255, 255, 255, .5);
    --ct-green: #ffffff;
    --ct-err: #ffb4a8;
    --ct-input-bg: #0e6e3e;

    position: relative;
    overflow: hidden;
    isolation: isolate;
    padding: clamp(3.5rem, 6vw, 5.5rem) 0;
    background-color: var(--green-700);
    border-top: 1px solid var(--line, #e3ebe7);
    color: var(--ct-ink);
  }

  .section-contact.is-standalone-page {
    padding-top: calc(var(--hdr-height, 80px) + clamp(2.5rem, 5vw, 4.5rem));
    min-height: calc(100vh - 300px);
  }

  .ct-container { position: relative; z-index: 2; }

  /* Decorative soft blob */
  .ct-deco { position: absolute; z-index: 0; pointer-events: none; }

  .ct-bigblob {
    width: 56vw;
    max-width: 780px;
    aspect-ratio: 1;
    right: -14%;
    top: -12%;
    border-radius: 50%;
    background: linear-gradient(160deg, #dff3e7 0%, var(--green-100, #cfeedd) 100%);
  }

  /* Smooth reveal */
  .ct-reveal {
    opacity: 0;
    transform: translateY(28px);
    transition: opacity .8s cubic-bezier(.22, .61, .36, 1) var(--d, 0ms),
      transform .8s cubic-bezier(.22, .61, .36, 1) var(--d, 0ms);
    will-change: opacity, transform;
  }
  .ct-reveal.in { opacity: 1; transform: none; }

  /* Header */
  .contact-header { margin-bottom: 2rem; max-width: 520px; }

  .contact-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    padding: .35rem .95rem;
    background: rgba(255, 255, 255, 0.14);
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 999px;
    color: #ffffff !important;
    font-size: .78rem;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    margin-bottom: .85rem;
  }

  .section-contact .contact-title {
    font-family: var(--font-heading, var(--font-serif, inherit)) !important;
    font-size: var(--heading-size) !important;
    font-weight: 800 !important;
    letter-spacing: var(--heading-letter-spacing, -0.02em) !important;
    line-height: var(--heading-line-height, 1.25) !important;
    margin: 0 0 .65rem !important;
    color: var(--ct-ink);
  }

  .contact-subtitle { font-size: .95rem; color: var(--ct-muted); line-height: 1.6; margin: 0; }

  /* Form */
  .contact-form { max-width: 560px; }

  .contact-label {
    display: block;
    font-size: .82rem;
    font-weight: 600;
    color: var(--ct-ink);
    margin-bottom: .15rem;
  }

  .req-star { color: var(--ct-err); }
  .ct-optional { font-size: .74rem; color: var(--ct-muted); }

  /* Field wrapper + leading icon */
  .ct-field { position: relative; }

  .ct-icon {
    position: absolute;
    left: 0;
    top: .5rem;
    font-size: 1rem;
    line-height: 1.43rem;
    color: rgba(255, 255, 255, .8);
    pointer-events: none;
    transition: color .2s ease;
  }
  .ct-field:focus-within .ct-icon { color: #fff; }
  /* Font Awesome icon inside .ct-icon: keep same size/alignment as the Bootstrap icons */
  .ct-icon.fa-solid { font-size: .88rem; line-height: 1.43rem; display: inline-block; }

  .contact-input {
    display: block;
    width: 100%;
    font-family: var(--font-body);
    font-size: .92rem;
    color: var(--ct-ink);
    background: var(--ct-input-bg);
    border: 0;
    border-bottom: 1.5px solid var(--ct-line);
    border-radius: 0;
    padding: .5rem 0;
    outline: none;
    box-shadow: none;
    transition: border-color .2s ease, box-shadow .2s ease;
  }
  .ct-field .contact-input { padding-left: 1.75rem; }

  .contact-input::placeholder { color: rgba(255, 255, 255, .6); font-size: .86rem; }

  /* Browser autofill / saved data: keep the same green (no white flash, also while focused) */
  .contact-input:-webkit-autofill,
  .contact-input:-webkit-autofill:hover,
  .contact-input:-webkit-autofill:focus,
  .contact-input:-webkit-autofill:active {
    -webkit-text-fill-color: #fff;
    caret-color: #fff;
    -webkit-box-shadow: 0 0 0 1000px var(--ct-input-bg) inset;
    box-shadow: 0 0 0 1000px var(--ct-input-bg) inset;
    transition: background-color 9999s ease-out 0s;
  }
  .contact-input:-webkit-autofill:focus {
    -webkit-box-shadow: 0 0 0 1000px var(--ct-input-bg) inset, 0 1.5px 0 0 var(--ct-green);
    box-shadow: 0 0 0 1000px var(--ct-input-bg) inset, 0 1.5px 0 0 var(--ct-green);
  }

  .contact-input:focus {
    border-bottom-color: var(--ct-green);
    box-shadow: 0 1.5px 0 0 var(--ct-green);
  }

  .contact-textarea { resize: vertical; min-height: 100px; line-height: 1.5; }

  /* Phone with +91 prefix */
  .phone-input-group {
    display: flex;
    align-items: flex-end;
    padding-left: 1.75rem;
    background: var(--ct-input-bg);
    border-bottom: 1.5px solid var(--ct-line);
    transition: border-color .2s ease, box-shadow .2s ease;
  }
  .phone-input-group:focus-within {
    border-bottom-color: var(--ct-green);
    box-shadow: 0 1.5px 0 0 var(--ct-green);
  }
  .phone-prefix {
    font-size: .9rem;
    font-weight: 700;
    color: var(--ct-green);
    padding: .5rem .6rem .5rem 0;
    user-select: none;
  }
  .phone-input-group .contact-input.phone-field {
    border-bottom: 0;
    box-shadow: none;
    padding-left: 0;
    flex: 1;
    min-width: 0;
  }

  /* City + locate button */
  .ct-city { padding-right: 2.4rem !important; text-overflow: ellipsis; }

  .ct-locate {
    position: absolute;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 1.9rem;
    height: 1.9rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    border: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, .16);
    color: #fff;
    font-size: .95rem;
    cursor: pointer;
    transition: background .2s ease;
  }
  .ct-locate:hover { background: rgba(255, 255, 255, .3); }
  .ct-locate:focus-visible { outline: 2px solid #fff; outline-offset: 2px; }
  .ct-locate:disabled { cursor: progress; }
  .ct-locate .spinner-border { width: .9rem; height: .9rem; border-width: .14em; }

  /* Detected city line */
  .ct-detect { display: block; margin-top: .3rem; font-size: .78rem; font-weight: 600; line-height: 1.4; color: #d6f5e2; }
  .ct-detect:empty { display: none; }
  .ct-detect i { margin-right: .3rem; color: #8ff0b4; }
  .ct-detect .spinner-border { width: .7rem; height: .7rem; border-width: .12em; margin-right: .4rem; vertical-align: -1px; }

  /* Custom select */
  .ct-select { position: relative; }
  .ct-select.open { z-index: 30; }

  .ct-select-btn {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: .5rem;
    text-align: left;
    cursor: pointer;
  }
  .ct-select-label { min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
  .ct-select:not(.has-value) .ct-select-label { color: rgba(255, 255, 255, .6); font-size: .86rem; }
  .ct-chev { font-size: .8rem; transition: transform .2s ease; }
  .ct-select.open .ct-chev { transform: rotate(180deg); }

  .ct-options {
    display: none;
    position: absolute;
    left: 0;
    right: 0;
    top: calc(100% + 6px);
    z-index: 30;
    margin: 0;
    padding: .4rem;
    list-style: none;
    max-height: 300px;
    overflow-y: auto;
    background: #fff;
    border: 1px solid #dcebe2;
    border-radius: 8px;
    box-shadow: 0 18px 40px -12px rgba(10, 58, 36, .45);
  }
  .ct-select.open .ct-options { display: block; animation: ctDrop .18s ease; }

  @keyframes ctDrop {
    from { opacity: 0; transform: translateY(-6px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  .ct-options li {
    display: flex;
    align-items: center;
    gap: .75rem;
    padding: .7rem .85rem;
    border-radius: 6px;
    color: #1a2820;
    font-size: .88rem;
    line-height: 1.35;
    cursor: pointer;
    outline: none;
    transition: background .15s ease;
  }
  .ct-options li + li { margin-top: 2px; }
  .ct-options li:hover,
  .ct-options li:focus { background: var(--green-50, #EEF7F1); }
  .ct-options li[aria-selected="true"] { background: var(--green-50, #EEF7F1); font-weight: 700; }

  .ct-opt-icon { flex-shrink: 0; width: 20px; text-align: center; font-size: 1.05rem; color: var(--green-700, #1B692C); }
  .ct-opt-text { flex: 1; min-width: 0; display: flex; flex-direction: column; }
  .ct-opt-main { font-weight: 600; }
  .ct-opt-note { font-size: .75rem; color: #5d6d64; font-weight: 400; }
  .ct-opt-check { visibility: hidden; flex-shrink: 0; color: var(--green-700, #1B692C); font-size: 1.05rem; }
  .ct-options li[aria-selected="true"] .ct-opt-check { visibility: visible; }

  /* Inline validation */
  .ct-error {
    display: block;
    margin-top: .3rem;
    font-size: .74rem;
    font-weight: 600;
    line-height: 1.4;
    color: var(--ct-err);
  }
  .ct-error:empty { display: none; }

  .contact-input.is-invalid,
  .phone-input-group.is-invalid {
    border-bottom-color: var(--ct-err);
    box-shadow: 0 1.5px 0 0 var(--ct-err);
  }

  /* Submit uses global .btn .btn-light-g — only sizing here */
  .contact-submit-btn {
    padding: .75rem 2.4rem;
    font-size: 1rem;
    font-weight: 700;
    box-shadow: 0 12px 22px -10px rgba(0, 0, 0, .45);
  }
  .contact-submit-btn:hover:not(:disabled) { transform: translateY(-2px); }
  .contact-submit-btn:disabled { opacity: .85; cursor: not-allowed; transform: none; }

  /* Feedback (errors only — success redirects to thankyou.php) */
  .contact-feedback-box {
    margin-top: 1.1rem;
    padding: .75rem 1rem;
    font-size: .85rem;
    font-weight: 600;
    line-height: 1.5;
    border-radius: 0;
    animation: contactFadeIn .3s ease;
  }
  .contact-feedback-box.is-error { background: #fef2f2; border: 1px solid #fecaca; color: #b91c1c; }

  @keyframes contactFadeIn {
    from { opacity: 0; transform: translateY(-6px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  /* Info card */
  .contact-info-card {
    --ct-ink: var(--heading-color, #1a2820);
    --ct-muted: #5d6d64;
    --ct-green: var(--green-700, #1B692C);
    background: var(--green-50, #EEF7F1);
    border-radius: 10px 40%;
    padding: clamp(2.8rem, 5.5vw, 4.6rem) clamp(2.4rem, 5vw, 4.4rem);
    box-shadow: 0 30px 60px -30px rgba(10, 58, 36, .3);
  }

  .info-bar {
    display: block;
    width: 68px;
    height: 8px;
    border-radius: 999px;
    background: linear-gradient(90deg, var(--green-700, #1B692C), var(--accent, #2fbf71));
    margin-bottom: 1rem;
  }

  .section-contact .info-title {
    font-size: clamp(1.35rem, 2vw, 1.7rem);
    font-weight: 800;
    color: var(--ct-ink);
    margin: 0 0 1.5rem;
  }

  .contact-channels { display: flex; flex-direction: column; gap: 1.2rem; }

  .channel-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    text-decoration: none;
    color: inherit;
  }

  .channel-icon {
    flex-shrink: 0;
    width: 40px;
    height: 40px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: var(--green-100, #cfeedd);
    color: var(--ct-green);
    font-size: 1.05rem;
    transition: background .2s ease, color .2s ease;
  }
  a.channel-item:hover .channel-icon { background: var(--green-700, #1B692C); color: #fff; }

  .channel-meta { display: flex; flex-direction: column; min-width: 0; }
  .channel-value { font-size: .95rem; font-weight: 700; color: var(--ct-ink); line-height: 1.4; word-break: break-word; transition: color .2s ease; }
  .channel-note { font-size: .78rem; color: var(--ct-muted); }
  a.channel-item:hover .channel-value { color: var(--ct-green); }

  /* Responsive */
  @media (max-width: 991.98px) {
    .ct-bigblob { width: 90vw; right: -35%; top: auto; bottom: -10%; }
    .contact-info-card { border-radius: 42px 90px 42px 90px / 42px 70px 42px 70px; }
  }

  @media (max-width: 575.98px) {
    .section-contact { padding: 2.75rem 0; }
    .contact-info-card { padding: 2rem 1.5rem; border-radius: 36px 64px 36px 64px / 36px 54px 36px 54px; }
    .contact-submit-btn { width: 100%; }
  }

  @media (prefers-reduced-motion: reduce) {
    .ct-reveal { opacity: 1; transform: none; transition: none; }
    .ct-select.open .ct-options { animation: none; }
  }
</style>

<script>
  (function() {
    /* ---------- Smooth reveal on scroll ---------- */
    const revealEls = document.querySelectorAll('#contact .ct-reveal');
    if ('IntersectionObserver' in window) {
      const io = new IntersectionObserver((entries, obs) => {
        entries.forEach(en => {
          if (en.isIntersecting) {
            en.target.classList.add('in');
            obs.unobserve(en.target);
          }
        });
      }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
      revealEls.forEach(el => io.observe(el));
    } else {
      revealEls.forEach(el => el.classList.add('in'));
    }

    /* ---------- Form ---------- */
    const contactForm = document.getElementById('motozo-contact-form');
    if (!contactForm || contactForm.dataset.bound === 'true') return;
    contactForm.dataset.bound = 'true';

    const submitBtn   = document.getElementById('contact-submit-btn'),
          btnContent  = document.getElementById('contact-btn-content'),
          btnSpinner  = document.getElementById('contact-btn-spinner'),
          feedbackBox = document.getElementById('contact-form-feedback');

    const THANKYOU_URL = '<?= $thankyouUrl ?>';

    const fields = {
      user_name:    document.getElementById('contact_user_name'),
      user_phone:   document.getElementById('contact_user_phone'),
      user_pincode: document.getElementById('contact_user_pincode'),
      service_type: document.getElementById('contact_service_type')      // hidden input
    };

    /* ---------- Custom select ---------- */
    const sel      = document.getElementById('ct-select'),
          selBtn   = document.getElementById('contact_service_type_btn'),
          selLabel = selBtn.querySelector('.ct-select-label'),
          optEls   = Array.from(sel.querySelectorAll('[role="option"]')),
          PLACEHOLDER = selLabel.textContent;

    // Element that shows the error state / receives focus per field
    const ui = { service_type: selBtn };

    function openSel() {
      sel.classList.add('open');
      selBtn.setAttribute('aria-expanded', 'true');
      (optEls.find(o => o.getAttribute('aria-selected') === 'true') || optEls[0]).focus();
    }
    function closeSel(focusBtn) {
      sel.classList.remove('open');
      selBtn.setAttribute('aria-expanded', 'false');
      if (focusBtn) selBtn.focus();
    }
    function pick(o) {
      optEls.forEach(x => x.setAttribute('aria-selected', x === o ? 'true' : 'false'));
      fields.service_type.value = o.dataset.value;
      selLabel.textContent = o.dataset.label;
      sel.classList.add('has-value');
      fields.service_type.dispatchEvent(new Event('change', { bubbles: true }));
      closeSel(true);
    }
    function resetSel() {
      optEls.forEach(x => x.setAttribute('aria-selected', 'false'));
      fields.service_type.value = '';
      selLabel.textContent = PLACEHOLDER;
      sel.classList.remove('has-value', 'open');
    }

    selBtn.addEventListener('click', () => sel.classList.contains('open') ? closeSel(false) : openSel());
    selBtn.addEventListener('keydown', e => {
      if (e.key === 'ArrowDown' || e.key === 'ArrowUp') { e.preventDefault(); openSel(); }
    });
    optEls.forEach(o => o.addEventListener('click', () => pick(o)));
    sel.addEventListener('keydown', e => {
      if (!sel.classList.contains('open') || e.target === selBtn) return;
      const i = optEls.indexOf(document.activeElement);
      if (e.key === 'ArrowDown') { e.preventDefault(); optEls[Math.min(i + 1, optEls.length - 1)].focus(); }
      else if (e.key === 'ArrowUp') { e.preventDefault(); optEls[Math.max(i - 1, 0)].focus(); }
      else if (e.key === 'Home') { e.preventDefault(); optEls[0].focus(); }
      else if (e.key === 'End') { e.preventDefault(); optEls[optEls.length - 1].focus(); }
      else if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); if (i > -1) pick(optEls[i]); }
      else if (e.key === 'Escape') { e.preventDefault(); closeSel(true); }
      else if (e.key === 'Tab') { closeSel(false); }
    });
    document.addEventListener('click', e => { if (!sel.contains(e.target)) closeSel(false); });
    contactForm.addEventListener('reset', resetSel);

    /* ---------- Validation (short messages) ---------- */
    const clean = v => (v || '').replace(/\s+/g, ' ').trim();

    const DEFAULT_CITY = <?= json_encode((string) $currentCity) ?>;
    const cityHidden   = document.getElementById('contact_user_city');
    const detectEl     = document.getElementById('ct_detect');
    // Pincode lookup state: idle | loading | ok | invalid | offline
    let pinState = { pin: '', city: '', status: 'idle' };

    const rules = {
      user_name: v => {
        if (!v) return 'Enter your name';
        if (v.length < 2) return 'Name too short';
        if (!/^[\p{L}][\p{L}\p{M} .'’-]*$/u.test(v)) return 'Letters only';
        return '';
      },
      user_phone: v => {
        if (!v) return 'Enter mobile number';
        if (!/^\d{10}$/.test(v)) return 'Enter 10 digits';
        if (!/^[6-9]/.test(v)) return 'Must start with 6–9';
        return '';
      },
      user_pincode: v => {
        if (!v) return 'Enter pincode or city';
        if (/^\d+$/.test(v)) {
          if (v.length !== 6) return 'Enter 6-digit pincode';
          if (v[0] === '0') return 'Invalid pincode';
          return '';
        }
        if (v.length < 2) return 'City name too short';
        return '';
      },
      service_type: v => v ? '' : 'Select one'
    };

    function setFieldState(key, msg) {
      const el = fields[key];
      const t  = ui[key] || el;
      const errEl = document.getElementById('err_' + key);
      if (errEl) errEl.textContent = msg;
      t.setAttribute('aria-invalid', msg ? 'true' : 'false');
      t.classList.toggle('is-invalid', !!msg);
      const group = el.closest('.phone-input-group');
      if (group) group.classList.toggle('is-invalid', !!msg);
    }

    function validateField(key) {
      const el = fields[key];
      if (!el) return true;
      const value = (key === 'user_phone' || key === 'user_pincode') ? el.value.trim() : clean(el.value);
      let msg = rules[key](value);
      setFieldState(key, msg);
      return !msg;
    }

    Object.keys(fields).forEach(key => {
      const el = fields[key];
      if (!el) return;
      if (key !== 'service_type') el.addEventListener('blur', () => validateField(key));
      el.addEventListener(key === 'service_type' ? 'change' : 'input', () => {
        if ((ui[key] || el).getAttribute('aria-invalid') === 'true') validateField(key);
      });
    });

    // Phone: digits only, handle pasted "+91 …" / "0…" numbers
    const phoneEl = fields.user_phone;
    function normalizePhone(raw) {
      let d = (raw || '').replace(/\D/g, '');
      if (d.length > 10 && d.startsWith('91')) d = d.slice(2);
      else if (d.length > 10 && d.startsWith('0')) d = d.slice(1);
      return d.slice(0, 10);
    }
    phoneEl.addEventListener('input', () => { phoneEl.value = phoneEl.value.replace(/\D/g, '').slice(0, 10); });
    phoneEl.addEventListener('paste', e => {
      e.preventDefault();
      const text = (e.clipboardData || window.clipboardData).getData('text');
      phoneEl.value = normalizePhone(text);
      phoneEl.dispatchEvent(new Event('input', { bubbles: true }));
    });

    /* ---------- Pincode & City lookup ---------- */
    const pinEl = fields.user_pincode;
    const pinCache = {};
    const cityCache = {};
    let pinSeq = 0;
    let cityDebounceTimer = null;

    async function getJSON(url) {
      const ctrl = new AbortController();
      const timer = setTimeout(() => ctrl.abort(), 8000);
      try {
        const r = await fetch(url, { signal: ctrl.signal });
        if (!r.ok) throw new Error('HTTP ' + r.status);
        return await r.json();
      } finally { clearTimeout(timer); }
    }

    function setDetect(text, kind) {
      detectEl.textContent = '';
      if (!text) return;
      const i = document.createElement(kind === 'load' ? 'span' : 'i');
      i.className = kind === 'load' ? 'spinner-border' : 'bi bi-check-circle-fill';
      detectEl.appendChild(i);
      detectEl.appendChild(document.createTextNode(' ' + text));
    }

    function applyPin(pin, res) {
      pinState = { pin: pin, city: res.city || '', status: res.status };
      if (res.status === 'ok') {
        cityHidden.value = res.city || DEFAULT_CITY;
        setDetect(res.city, 'ok');
      } else {
        // Not found in directory: do not show awkward error or text underneath, accept input
        cityHidden.value = DEFAULT_CITY;
        setDetect('');
      }
      setFieldState('user_pincode', '');
      return pinState;
    }

    async function lookupPin(pin) {
      if (pinCache[pin]) return applyPin(pin, pinCache[pin]);
      const seq = ++pinSeq;
      pinState = { pin: pin, city: '', status: 'loading' };
      setDetect('Checking…', 'load');
      let res;
      try {
        const j = await getJSON('https://api.postalpincode.in/pincode/' + pin);
        const r = j && j[0];
        if (r && r.Status === 'Success' && r.PostOffice && r.PostOffice.length) {
          const po = r.PostOffice[0];
          res = { status: 'ok', city: clean((po.District || po.Name || '') + ', ' + (po.State || '')).replace(/^,\s*|,\s*$/g, '') };
        } else {
          res = { status: 'not_found' };
        }
      } catch (e) {
        res = { status: 'offline' };
      }
      if (seq !== pinSeq) return pinState;  // user kept typing — ignore stale result
      if (res.status !== 'offline') pinCache[pin] = res;
      return applyPin(pin, res);
    }

    async function lookupCity(cityName) {
      const q = cityName.trim();
      if (q.length < 3) {
        setDetect('');
        return;
      }
      const cacheKey = q.toLowerCase();
      if (cityCache[cacheKey]) {
        applyCityResult(q, cityCache[cacheKey]);
        return;
      }
      const seq = ++pinSeq;
      setDetect('Checking…', 'load');
      let res;
      try {
        const j = await getJSON('https://api.postalpincode.in/postoffice/' + encodeURIComponent(q));
        const r = j && j[0];
        if (r && r.Status === 'Success' && r.PostOffice && r.PostOffice.length) {
          const po = r.PostOffice[0];
          const matched = clean((po.District || po.Name || '') + ', ' + (po.State || '')).replace(/^,\s*|,\s*$/g, '');
          res = { found: true, display: matched, city: matched };
        } else {
          res = { found: false };
        }
      } catch (e) {
        res = { found: false };
      }
      if (seq !== pinSeq) return;
      cityCache[cacheKey] = res;
      applyCityResult(q, res);
    }

    function applyCityResult(originalRaw, res) {
      if (res && res.found) {
        cityHidden.value = res.city;
        setDetect(res.display, 'ok');
      } else {
        // Not found or custom city (e.g. delhicccccccccccc) -> Do NOT display under input, accept raw value!
        cityHidden.value = originalRaw;
        setDetect('');
      }
      setFieldState('user_pincode', '');
    }

    function resetPin() {
      pinSeq++;
      clearTimeout(cityDebounceTimer);
      pinState = { pin: '', city: '', status: 'idle' };
      cityHidden.value = DEFAULT_CITY;
      setDetect('');
    }

    pinEl.addEventListener('input', () => {
      clearTimeout(cityDebounceTimer);
      const raw = pinEl.value.trim();
      const isDigitsOnly = /^\d+$/.test(raw);

      if (isDigitsOnly) {
        if (pinEl.value.length > 6) pinEl.value = pinEl.value.slice(0, 6);
        const v = pinEl.value.trim();
        if (v.length === 6 && v[0] !== '0') {
          lookupPin(v);
        } else {
          resetPin();
        }
      } else if (raw.length >= 3) {
        // User typed a city name -> save input and try to fetch verified district/state
        cityHidden.value = raw;
        cityDebounceTimer = setTimeout(() => {
          lookupCity(raw);
        }, 400);
      } else if (raw.length > 0) {
        cityHidden.value = raw;
        setDetect('');
      } else {
        resetPin();
      }
    });
    pinEl.addEventListener('paste', () => {
      setTimeout(() => {
        pinEl.dispatchEvent(new Event('input', { bubbles: true }));
      }, 0);
    });
    contactForm.addEventListener('reset', resetPin);

    /* ---------- Location fetch (GPS → pincode) ---------- */
    const locBtn  = document.getElementById('ct-locate'),
          locIcon = locBtn.querySelector('.ct-locate-icon'),
          locSpin = locBtn.querySelector('.ct-locate-spin');

    function locLoading(on) {
      locBtn.disabled = on;
      locIcon.classList.toggle('d-none', on);
      locSpin.classList.toggle('d-none', !on);
    }

    async function reversePin(lat, lon) {
      const valid = p => { const d = (p || '').replace(/\D/g, ''); return /^[1-9]\d{5}$/.test(d) ? d : ''; };
      try {
        const j = await getJSON('https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=' + lat +
          '&longitude=' + lon + '&localityLanguage=en');
        const p = valid(j.postcode);
        if (p) return p;
      } catch (e) { /* try fallback */ }
      try {
        const j2 = await getJSON('https://nominatim.openstreetmap.org/reverse?format=jsonv2&zoom=18&addressdetails=1' +
          '&lat=' + lat + '&lon=' + lon);
        const p2 = valid((j2.address || {}).postcode);
        if (p2) return p2;
      } catch (e) { /* give up */ }
      return '';
    }

    locBtn.addEventListener('click', () => {
      if (!navigator.geolocation || !window.isSecureContext) {
        setFieldState('user_pincode', 'Location unavailable');
        return;
      }
      setFieldState('user_pincode', '');
      locLoading(true);

      navigator.geolocation.getCurrentPosition(async pos => {
        try {
          const pin = await reversePin(pos.coords.latitude, pos.coords.longitude);
          if (pin) {
            pinEl.value = pin;
            pinEl.dispatchEvent(new Event('input', { bubbles: true }));   // triggers city lookup
          } else {
            setFieldState('user_pincode', 'Could not detect pincode');
          }
        } finally {
          locLoading(false);
        }
      }, err => {
        locLoading(false);
        setFieldState('user_pincode', err && err.code === 1 ? 'Location blocked' : 'Could not detect pincode');
      }, { enableHighAccuracy: false, timeout: 10000, maximumAge: 300000 });
    });

    /* ---------- Submit ---------- */
    function showError(text, icon, withCall) {
      feedbackBox.className = 'contact-feedback-box is-error';
      feedbackBox.textContent = '';              // textContent: server text can never inject HTML
      const i = document.createElement('i');
      i.className = 'bi ' + icon + ' me-1';
      feedbackBox.appendChild(i);
      feedbackBox.appendChild(document.createTextNode(' ' + text));
      if (withCall) {
        const a = document.createElement('a');
        a.href = 'tel:+919711941108';
        a.className = 'text-danger fw-bold';
        a.textContent = '+91 9711 9411 08';
        feedbackBox.appendChild(document.createTextNode(' '));
        feedbackBox.appendChild(a);
      }
    }

    function setLoading(on) {
      submitBtn.disabled = on;
      btnContent.classList.toggle('d-none', on);
      btnSpinner.classList.toggle('d-none', !on);
      btnSpinner.classList.toggle('d-inline-flex', on);
    }

    contactForm.addEventListener('submit', async function(e) {
      e.preventDefault();
      if (submitBtn.disabled) return;

      feedbackBox.className = 'contact-feedback-box d-none';
      feedbackBox.textContent = '';

      // Honeypot filled → bot. Silently stop.
      const hp = contactForm.querySelector('input[name="website"]');
      if (hp && hp.value) return;

      let firstInvalid = null;
      Object.keys(fields).forEach(key => {
        if (!validateField(key) && !firstInvalid) firstInvalid = ui[key] || fields[key];
      });
      if (firstInvalid) { firstInvalid.focus(); return; }

      setLoading(true);
      let redirecting = false;

      try {
        const rawLoc = pinEl.value.trim();
        const isDigits = /^\d+$/.test(rawLoc);

        if (isDigits) {
          if (rawLoc.length !== 6 || rawLoc[0] === '0') {
            setFieldState('user_pincode', 'Enter 6-digit pincode');
            pinEl.focus();
            return;
          }
          if (pinState.pin !== rawLoc || pinState.status === 'loading' || pinState.status === 'idle') {
            await lookupPin(rawLoc);
          }
        } else {
          if (rawLoc.length < 2) {
            setFieldState('user_pincode', 'City name too short');
            pinEl.focus();
            return;
          }
          if (!cityHidden.value || cityHidden.value === DEFAULT_CITY) {
            cityHidden.value = rawLoc;
          }
          pinState = { pin: '', city: cityHidden.value, status: 'ok' };
        }

        const resolvedCity = clean(cityHidden.value) || rawLoc || DEFAULT_CITY || 'India';

        const formData = new FormData(contactForm);
        formData.set('user_name', clean(fields.user_name.value));
        formData.set('user_pincode', isDigits ? rawLoc : '');
        formData.set('user_city', resolvedCity);
        formData.set('user_phone', fields.user_phone.value.trim());
        formData.set('user_message', (contactForm.elements['user_message'].value || '').trim());

        const response = await fetch('<?= $actionUrl ?>', { method: 'POST', body: formData });
        const rawText = await response.text();
        let data;
        try {
          data = JSON.parse(rawText);
        } catch (jsonErr) {
          console.error('Non-JSON response from send-mail.php:', rawText);
          throw new Error('Invalid server response');
        }

        if (data && data.ok) {
          redirecting = true;
          try {
            sessionStorage.setItem('motozo_thankyou', JSON.stringify({
              name: formData.get('user_name'),
              phone: formData.get('user_phone'),
              t: Date.now()
            }));
          } catch (storageErr) { /* private mode — thankyou page shows generic text */ }

          contactForm.reset();
          window.location.href = THANKYOU_URL;
          return;
        }

        showError((data && data.error) ? String(data.error) : 'Something went wrong. Try again.',
          'bi-exclamation-circle-fill', false);

      } catch (err) {
        console.error('Contact Form submission error:', err);
        showError('Network error. Try again or call', 'bi-wifi-off', true);
      } finally {
        if (!redirecting) setLoading(false);
      }
    });
  })();
</script>