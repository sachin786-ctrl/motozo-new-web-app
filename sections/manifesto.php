<!-- ==========================================================================
     MANIFESTO PROMISE COMPONENT (Self-Contained: HTML + CSS + JS)
     ========================================================================== -->
<section class="manifesto" id="promise-manifesto">
  <!-- Atmospheric Ambient Glows & Tech Grid -->
  <div class="manifesto-ambient-grid" aria-hidden="true"></div>
  <div class="manifesto-glow-orb manifesto-glow-orb-top" aria-hidden="true"></div>
  <div class="manifesto-glow-orb manifesto-glow-orb-btm" aria-hidden="true"></div>

  <div class="container manifesto-container">
    <!-- Top Pill Badge -->
    <div class="manifesto-eyebrow-wrap">
      <span class="manifesto-pill">
        <span class="pill-dot"></span>
        <i class="bi bi-shield-check"></i>
        Our Core Promise
      </span>
      <div class="manifesto-accent-line" aria-hidden="true"></div>
    </div>

    <!-- Clean Word-by-Word Scroll Reveal Statement -->
    <h2 class="manifesto-text" id="fill">Making Scrap Trading Simple, Transparent &amp; Better for Everyone.</h2>

    <!-- Responsive Glassmorphic Value & Trust Chips -->
    <div class="chip-row manifesto-chips">
      <div class="manifesto-chip">
        <span class="chip-icon-box"><i class="bi bi-shield-check"></i></span>
        <div class="chip-text">
          <strong class="chip-title">Zero Hidden Cuts</strong>
          <span class="chip-subtitle">100% Upfront Guaranteed Valuation</span>
        </div>
      </div>

      <div class="manifesto-chip">
        <span class="chip-icon-box"><i class="bi bi-hammer"></i></span>
        <div class="chip-text">
          <strong class="chip-title">Transparent Bidding</strong>
          <span class="chip-subtitle">Real-Time Verified Buyer Network</span>
        </div>
      </div>

      <div class="manifesto-chip">
        <span class="chip-icon-box"><i class="bi bi-receipt-cutoff"></i></span>
        <div class="chip-text">
          <strong class="chip-title">End-to-End Documentation</strong>
          <span class="chip-subtitle">Govt RVSF Certificate of Deposit</span>
        </div>
      </div>

      <div class="manifesto-chip">
        <span class="chip-icon-box"><i class="bi bi-lightning-charge-fill"></i></span>
        <div class="chip-text">
          <strong class="chip-title">Instant Payment</strong>
          <span class="chip-subtitle">Instant Bank Transfer at Handover</span>
        </div>
      </div>
    </div>

    <!-- Regulatory / Trust Assurance Footnote -->
    <div class="manifesto-trust-strip">
      <span class="trust-strip-item"><i class="bi bi-patch-check-fill"></i> Govt. Authorized RVSF Partner</span>
      <span class="trust-strip-sep">•</span>
      <span class="trust-strip-item"><i class="bi bi-truck"></i> Free Pan-India Doorstep Towing</span>
      <span class="trust-strip-sep">•</span>
      <span class="trust-strip-item"><i class="bi bi-file-earmark-lock-fill"></i> Safe Legal RC Deregistration</span>
    </div>
  </div>
</section>

<style>
  /* ==========================================================================
     MANIFESTO COMPONENT STYLING
     ========================================================================== */
  .manifesto {
    position: relative;
    overflow: hidden;
    min-height: 500px;
    padding: 5.5rem 0 4.8rem;
    display: flex;
    align-items: center;
    background-color: var(--section-bg-white);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.9);
  }

  /* Luminous top accent hairline */
  .manifesto::before {
    content: '';
    position: absolute;
    top: 0;
    left: 8%;
    right: 8%;
    height: 1px;
    background: linear-gradient(90deg, transparent 0%, rgba(27, 105, 44, 0.35) 50%, transparent 100%);
    z-index: 2;
    pointer-events: none;
  }

  /* Micro Tech-Dot Grid Background */
  .manifesto-ambient-grid {
    position: absolute;
    inset: 0;
    background-image: radial-gradient(rgba(27, 105, 44, 0.08) 1.2px, transparent 1.2px);
    background-size: 26px 26px;
    opacity: 0.85;
    pointer-events: none;
    mask-image: radial-gradient(ellipse 80% 65% at 50% 50%, black 20%, transparent 85%);
    -webkit-mask-image: radial-gradient(ellipse 80% 65% at 50% 50%, black 20%, transparent 85%);
    z-index: 1;
  }

  /* Atmospheric Floating Orbs */
  .manifesto-glow-orb {
    position: absolute;
    border-radius: 50%;
    pointer-events: none;
    filter: blur(80px);
    z-index: 1;
    opacity: 0.45;
  }

  .manifesto-glow-orb-top {
    top: -80px;
    left: 50%;
    transform: translateX(-50%);
    width: 600px;
    height: 300px;
    background: radial-gradient(circle, rgba(47, 191, 113, 0.16) 0%, rgba(207, 238, 221, 0.35) 70%, transparent 100%);
  }

  .manifesto-glow-orb-btm {
    bottom: -100px;
    right: 10%;
    width: 400px;
    height: 260px;
    background: radial-gradient(circle, rgba(26, 154, 88, 0.12) 0%, transparent 70%);
  }

  .manifesto-container {
    position: relative;
    z-index: 3;
    width: 100%;
  }

  /* Eyebrow Pill Badge */
  .manifesto-eyebrow-wrap {
    display: flex;
    align-items: center;
    gap: 1.2rem;
    margin-bottom: 1.25rem;
  }

  .manifesto-pill {
    display: inline-flex;
    align-items: center;
    gap: 0.55rem;
    padding: 0.4rem 0.95rem 0.4rem 0.8rem;
    background: var(--color-primary-soft, #EEF7F1);
    border: 1px solid rgba(27, 105, 44, 0.22);
    border-radius: 999px;
    color: var(--color-primary, #1B692C);
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    box-shadow: 0 2px 8px rgba(27, 105, 44, 0.08);
  }

  .manifesto-pill i {
    font-size: 0.92rem;
    color: var(--color-primary, #1B692C);
  }

  .pill-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #1a9a58;
    box-shadow: 0 0 8px rgba(26, 154, 88, 0.6);
    animation: manifestoPillPulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
  }

  @keyframes manifestoPillPulse {

    0%,
    100% {
      opacity: 1;
      transform: scale(1);
    }

    50% {
      opacity: 0.35;
      transform: scale(0.8);
    }
  }

  .manifesto-accent-line {
    flex: 1;
    max-width: 160px;
    height: 1px;
    background: linear-gradient(90deg, rgba(14, 110, 62, 0.22), transparent);
  }

  /* ==========================================================================
     CLEAN, UNIFORM EDITORIAL MANIFESTO STATEMENT
     All words are clean and normal; scroll activates them word-by-word into rich dark green
     ========================================================================== */
  .manifesto-text {
    font-family: var(--font-heading);
    font-weight: var(--heading-weight);
    font-size: var(--heading-size);
    line-height: var(--heading-line-height);
    max-width: 1000px;
    margin: 0 0 2.5rem;
    letter-spacing: var(--heading-letter-spacing);
    color: var(--heading-color);
    word-break: normal;
    overflow-wrap: break-word;
  }

  .manifesto-text span {
    color: rgba(10, 58, 36, 0.24);
    transition: color 0.3s cubic-bezier(0.2, 0.8, 0.2, 1);
    display: inline-block;
  }

  .manifesto-text span.on {
    color: var(--heading-color);
  }

  /* ==========================================================================
     RESPONSIVE VALUE & TRUST CHIPS
     ========================================================================== */
  .manifesto-chips {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1rem;
    margin-bottom: 2.2rem;
  }

  .manifesto-chip {
    display: flex;
    align-items: center;
    gap: 0.85rem;
    padding: 0.9rem 1.2rem;
    background: var(--section-card-bg);
    border: 1px solid var(--section-card-border);
    border-radius: 14px;
    box-shadow: var(--section-card-shadow);
    transition: all 0.25s ease;
    cursor: default;
    min-width: 0;
  }

  .manifesto-chip:hover {
    background: #ffffff;
    border-color: #2fbf71;
    transform: translateY(-2px);
    box-shadow: 0 10px 24px rgba(14, 110, 62, 0.12), 0 2px 6px rgba(0, 0, 0, 0.04);
  }

  .chip-icon-box {
    width: 42px;
    height: 42px;
    border-radius: 11px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #e7f7ee;
    border: 1px solid #cfeedd;
    color: #0e6e3e;
    font-size: 1.15rem;
    flex-shrink: 0;
    transition: transform 0.25s ease, background 0.25s ease, color 0.25s ease;
  }

  .manifesto-chip:hover .chip-icon-box {
    transform: scale(1.06);
    background: #0e6e3e;
    color: #ffffff;
    border-color: #0e6e3e;
  }

  .chip-text {
    display: flex;
    flex-direction: column;
    gap: 0.18rem;
    min-width: 0;
  }

  .manifesto-chip .chip-title {
    font-weight: 700;
    font-size: 1rem;
    line-height: 1.22;
    letter-spacing: -0.01em;
    white-space: normal;
    color: var(--heading-color, #1a2820);
  }

  .manifesto-chip .chip-subtitle {
    color: #556b60;
    font-size: 14px;
    font-weight: 500;
    line-height: 1.25;
    white-space: normal;
  }

  /* ==========================================================================
     TRUST ASSURANCE FOOTNOTE STRIP
     ========================================================================== */
  .manifesto-trust-strip {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 0.8rem 1.2rem;
    padding-top: 1.3rem;
    border-top: 1px solid #dcebe2;
  }

  .trust-strip-item {
    display: inline-flex;
    align-items: center;
    gap: 0.45rem;
    color: #3b5347;
    font-size: 14px;
    font-weight: 600;
    letter-spacing: 0.01em;
  }

  .trust-strip-item i {
    color: #0e6e3e;
    font-size: 0.9rem;
  }

  .trust-strip-sep {
    color: #9ac2ac;
    font-size: 0.75rem;
  }

  /* ==========================================================================
     RESPONSIVE BREAKPOINTS
     ========================================================================== */
  /* Tablets / Medium Desktops (up to 1100px) */
  @media (max-width: 1100px) {
    .manifesto-chips {
      grid-template-columns: repeat(2, 1fr);
      gap: 0.9rem;
    }
  }

  /* Tablets / Small Screens (up to 767.98px) */
  @media (max-width: 767.98px) {
    .manifesto {
      min-height: auto;
      padding: 4.5rem 0 3.8rem;
    }

    .manifesto-chips {
      grid-template-columns: repeat(2, 1fr);
      gap: 0.75rem;
      margin-bottom: 1.8rem;
    }

    .manifesto-text {
      font-size: var(--heading-size);
      line-height: var(--heading-line-height);
      letter-spacing: var(--heading-letter-spacing);
      margin-bottom: 1.8rem;
    }

    .manifesto-trust-strip {
      flex-direction: column;
      align-items: center;
      gap: 0.55rem;
      padding-top: 2rem;
    }

    .trust-strip-sep {
      display: none;
    }
  }

  /* Mobile Phones (up to 480px) */
  @media (max-width: 480px) {
    .manifesto {
      padding: 3.5rem 0 2.8rem;
    }

    .manifesto-eyebrow-wrap {
      margin-bottom: 1rem;
    }

    .manifesto-chips {
      grid-template-columns: repeat(2, 1fr);
      gap: 0.75rem;
    }

    .manifesto-pill {
      font-size: 0.7rem;
      padding: 0.35rem 0.8rem;
    }

    .manifesto-accent-line {
      max-width: 80px;
    }

    .manifesto-text {
      font-size: var(--heading-size);
      line-height: var(--heading-line-height);
      letter-spacing: var(--heading-letter-spacing);
      margin-bottom: 1.5rem;
    }

    .manifesto-chip {
      padding: 0.75rem 0.95rem;
      gap: 0.75rem;
      border-radius: 10px;
    }

    .chip-icon-box {
      width: 36px;
      height: 36px;
      font-size: 1rem;
      border-radius: 8px;
    }

    .manifesto-chip .chip-title {
      font-size: 0.86rem;
    }

    .manifesto-chip .chip-subtitle {
      font-size: 0.72rem;
    }

    .trust-strip-item {
      font-size: 0.76rem;
    }
  }
</style>

<script>
  (function() {
    const ft = document.getElementById('fill');
    if (!ft) return;

    // Clean word splitting with span wrapping (scroll reveal)
    const words = ft.textContent.trim().split(/\s+/);
    ft.innerHTML = words.map(w => `<span>${w}</span>`).join(' ');

    const fw = ft.querySelectorAll('span');

    function fill() {
      const r = ft.getBoundingClientRect(),
        winH = window.innerHeight,
        p = Math.min(Math.max((winH * 0.85 - r.top) / (r.height + winH * 0.35), 0), 1);
      fw.forEach((s, i) => s.classList.toggle('on', i < p * fw.length * 1.15));
    }

    window.addEventListener('scroll', fill, {
      passive: true
    });
    window.addEventListener('resize', fill, {
      passive: true
    });
    fill();
  })();
</script>