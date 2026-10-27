<?php
/* MOTOZO – How it works (Bootstrap 5 + Bootstrap Icons)
   Edit content here; markup below loops over these arrays. */
$ctaHref = '#quote';   // lead-form anchor, ya modal ke liye <a> me data-bs-toggle add karo

$steps = [
  ['icon' => 'bi-car-front',  'name' => 'Share Details',    'text' => 'Enter make, model &amp; city. Get a quote in 60 seconds.'],
  ['icon' => 'bi-cash-stack', 'name' => 'Best RVSF Offer',  'text' => 'We match you with approved centers for the top scrap value.'],
  ['icon' => 'bi-truck',      'name' => 'Free Pickup',      'text' => 'Pick your slot. Free doorstep towing, no extra cost.'],
  ['icon' => 'bi-wallet2',    'name' => 'Instant Pay &amp; RC', 'text' => 'Money in your bank, plus your VAHAN RC cancellation.'],
];

$trust = [
  ['bi-bank',         'Government Registered Facilities'],
  ['bi-check2-circle','Digital India Process Enabled'],
  ['bi-award',        'Legal Process Aligned'],
  ['bi-shield-check', 'RVSF Compliant'],
];
?>
<style>
/* ===== 1. SECTION + HEADER ===== */
.iso-steps-section {
  --pad-top: clamp(1.3rem, 3vw, 1.9rem);
  --badge: clamp(3.1rem, 2.4rem + 2.6vw, 4rem);
  --ar: 1.2rem;
  padding: clamp(3rem, 6vw, 5.5rem) 0 clamp(2.5rem, 5vw, 4.5rem);
  background: #EEF7F1;
  font-family: inherit;
  overflow: hidden;
}
.iso-head { margin-bottom: clamp(2rem, 4vw, 3.5rem); }
.iso-steps-section .iso-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: .5rem;
  padding: .35rem .95rem;
  background: rgba(255, 255, 255, 0.9);
  border: 1px solid rgba(27, 105, 44, 0.25);
  border-radius: 999px;
  color: var(--green-700, #1B692C);
  font-size: .78rem;
  font-weight: 700;
  letter-spacing: .12em;
  text-transform: uppercase;
  margin-bottom: .85rem;
}
.iso-steps-section .iso-eyebrow::before,
.iso-steps-section .iso-eyebrow::after {
  display: none !important;
}
.iso-title {
  font-family: var(--font-heading, var(--font-serif, inherit));
  font-size: var(--heading-size, clamp(1.65rem, 1.2rem + 1.8vw, 2.45rem));
  font-weight: var(--heading-weight, 800);
  line-height: var(--heading-line-height, 1.25);
  letter-spacing: var(--heading-letter-spacing, -0.02em);
  color: var(--heading-color, #1a2820);
  margin: 0 0 .5rem;
}
.iso-subtitle { font-size: clamp(.95rem, .9rem + .3vw, 1.05rem); line-height: 1.6; color: var(--muted, #5b6b62); margin: 0; }
.iso-cta { flex-shrink: 0; align-self: flex-start; padding: .7rem 1.6rem; font-weight: 600; white-space: nowrap; }

/* ===== 2. COLOUR SHADES (brand green #1B692C) ===== */
.iso-shade-1 { --tint:134,204,150; --top:#a3dcaf; --left:#74c088; --right:#5aa56e; --num-sh:#3f8a55; --badge1:#3f9a58; --badge2:#2f8a47; }
.iso-shade-2 { --tint:96,184,118;  --top:#74c98a; --left:#4aaa63; --right:#368c4d; --num-sh:#2d7a43; --badge1:#339150; --badge2:#28803f; }
.iso-shade-3 { --tint:60,156,86;   --top:#5cbb75; --left:#34934f; --right:#277a3e; --num-sh:#226b36; --badge1:#2a8344; --badge2:#217438; }
.iso-shade-4 { --tint:40,130,60;   --top:#3a9b55; --left:#2a8445; --right:#1f6f38; --num-sh:#1B692C; --badge1:#23803a; --badge2:#1B692C; }

/* ===== 3. STEP ===== */
.iso-list { margin: 0; padding: 0; list-style: none; }
.iso-list > li { position: relative; }
.iso-step {
  --overlap: 30%;               /* ek hi jagah: column padding aur slab overlap dono isse chalte hain */
  position: relative; max-width: 290px; margin: 0 auto;
}
.iso-col {
  position: relative; z-index: 1; margin: 0 5%;
  padding: var(--pad-top) clamp(.4rem, 1.5vw, .8rem) calc(var(--overlap) + 1%);
  text-align: center;
}
.iso-col::before {
  content: ""; position: absolute; inset: 0; z-index: -1; transform-origin: bottom;
  background: linear-gradient(180deg, rgba(var(--tint),0) 0%, rgba(var(--tint),.10) 35%, rgba(var(--tint),.30) 75%, rgba(var(--tint),.60) 100%);
  border-left: 1px solid rgba(var(--tint),.35); border-right: 1px solid rgba(var(--tint),.35);
  -webkit-mask-image: linear-gradient(180deg, transparent 0%, #000 35%);
  mask-image: linear-gradient(180deg, transparent 0%, #000 35%);
}
.iso-icon {
  display: grid; place-items: center; width: var(--badge); height: var(--badge);
  margin: 0 auto clamp(.7rem, 2vw, 1rem);
  background: linear-gradient(145deg, var(--badge1), var(--badge2)); color: #fff;
  font-size: clamp(1.4rem, 1.1rem + 1.2vw, 1.9rem); border-radius: 3px 20px;
  box-shadow: 0 8px 18px rgba(var(--tint),.55), inset 0 1px 0 rgba(255,255,255,.35);
}
.iso-icon i { line-height: 1; }
.iso-name { font-size: clamp(.98rem, .8rem + .9vw, 1.3rem); font-weight: 700; color: #1B692C; margin: 0 0 .4rem; line-height: 1.3; text-wrap: balance; }
.iso-text { font-size: clamp(.8rem, .74rem + .35vw, .95rem); line-height: 1.5; color: #2f4a3a; margin: 0 auto; max-width: 230px; }

/* ===== 4. PLATFORM ===== */
.iso-slab-wrap { position: relative; z-index: 2; margin-top: calc(var(--overlap) * -1); top: 0; transition: top .3s ease; }
.iso-slab { display: block; width: 100%; height: auto; overflow: visible; }
.s-shadow { fill: rgba(15,23,42,.14); }
.s-top { fill: var(--top); } .s-left { fill: var(--left); } .s-right { fill: var(--right); }
.s-num, .s-num-shadow { font: 900 48px Arial, Helvetica, sans-serif; text-anchor: middle; dominant-baseline: central; }
.s-num { fill: #dee2e6; }
.s-num-shadow { fill: var(--num-sh); opacity: .55; }

/* ===== 5. ARROWS: bina bg/border, 3 chevron ka flowing wave (gutter ke exact center me) ===== */
.iso-arrow {
  --ax: 50%; --ay: 5%; --rot: 0deg;
  display: flex; align-items: center; position: absolute; z-index: 3;
  top: 10%; right: 0;
  height: var(--ar); font-size: var(--ar); line-height: 1; color: #1B692C; pointer-events: none;
  transform: translate(var(--ax), var(--ay)) rotate(var(--rot)) scale(var(--as, 1));
}
.iso-arrow i {
  display: inline-block; line-height: 1; margin-left: -.34em; opacity: .22;
  transform: translateX(-4px) scale(.9); -webkit-text-stroke: .7px currentColor;
}
.iso-arrow i:first-child { margin-left: 0; }
.iso-arrow i:nth-child(2) { --k: 1; }
.iso-arrow i:nth-child(3) { --k: 2; }

/* ===== 6. SCROLL-SCRUBBED REVEAL (JS --sp/--cp/--ip/--np/--tp/--ap likhta hai; sirf transform + opacity) ===== */
.iso-list > li:nth-child(1) { --i: 0; } .iso-list > li:nth-child(2) { --i: 1; }
.iso-list > li:nth-child(3) { --i: 2; } .iso-list > li:nth-child(4) { --i: 3; }

.iso-anim .iso-slab    { will-change: transform, opacity; opacity: var(--sp, 0); transform: translateY(calc((1 - var(--sp, 0)) * -34px)); }
.iso-anim .iso-col::before { will-change: transform; transform: scaleY(var(--cp, 0)); }
.iso-anim .iso-icon    { will-change: transform, opacity; opacity: min(1, calc(var(--ip, 0) * 2.5)); transform: scale(calc(.35 + .65 * var(--ip, 0))); }
.iso-anim .iso-name    { opacity: var(--np, 0); transform: translateY(calc((1 - var(--np, 0)) * 14px)); }
.iso-anim .iso-text    { opacity: var(--tp, 0); transform: translateY(calc((1 - var(--tp, 0)) * 14px)); }
.iso-anim .iso-arrow   { opacity: min(1, calc(var(--ap, 0) * 2)); --as: calc(.3 + .7 * var(--ap, 0)); }

/* LOOP: reveal ke baad hamesha chalta hai (JS .iso-loop lagata hai, section screen par ho tab):
   icon 1 -> arrow 1 -> icon 2 -> arrow 2 -> icon 3 -> arrow 3 -> icon 4 -> phir se icon 1 */
.iso-loop .iso-icon { animation: iso-badge 4.2s ease-in-out calc(var(--i) * .9s) infinite; }
.iso-loop .iso-slab-wrap { animation: iso-col 4.2s ease-in-out calc(var(--i) * .9s) infinite; }
.iso-loop .iso-col::before { animation: iso-col 4.2s ease-in-out calc(var(--i) * .9s) infinite; }
.iso-loop .iso-arrow i { animation: iso-chev 4.2s ease-in-out calc(var(--i) * .9s + .45s + var(--k, 0) * .12s) infinite; }
@keyframes iso-badge {
  0%, 18%, 100% { transform: scale(1); }
  8% { transform: scale(1.16); box-shadow: 0 0 0 9px rgba(var(--tint), .25), 0 8px 18px rgba(var(--tint), .55); }
}
@keyframes iso-col {
  0%, 18%, 100% { transform: scale(1, 1); }
  8% { transform: scale(1.08, 1.03); }
}
@keyframes iso-chev {
  0%, 100% { opacity: .22; transform: translateX(-4px) scale(.9); filter: none; }
  8%  { opacity: 1; transform: translateX(0) scale(1.2); filter: drop-shadow(0 0 6px rgba(27,105,44,.65)); }
  18% { opacity: .22; transform: translateX(5px) scale(.9); filter: none; }
}

/* ===== 7. TRUST STRIP ===== */
.trust-strip { padding: clamp(30px, 3.5vw, 3rem) 0; background: #1B692C; color: white; border-top: 1px solid rgba(27,105,44,.14); font-family: inherit; }
.trust-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px 24px; }
.trust-item { display: inline-flex; align-items: center; gap: 10px; color: #fff; font-size: clamp(14px, 1.1vw, 18px); font-weight: 700; line-height: 1.35; transition: color .2s ease; }
.trust-icon { font-size: 1.35rem; line-height: 1; color: inherit; flex-shrink: 0; transition: transform .2s ease; }

/* ===== 8. HOVER ===== */
@media (hover: hover) {
  .iso-step:hover .iso-slab-wrap { top: -4px; }
  .trust-item:hover .trust-icon { transform: translateY(-1px); }
}

/* ===== 9. BREAKPOINTS (har breakpoint ek hi jagah) ===== */
@media (max-width: 991.98px) {
  /* 2x2 grid me step 2 right edge par hai, uske baad arrow ki jagah nahi: hide (1->2 aur 3->4 normal dikhte hain) */
  .iso-list > li:nth-child(2) .iso-arrow { display: none; }
}
@media (max-width: 575.98px) {
  .iso-cta { align-self: stretch; width: 100%; }
  .iso-step { max-width: 100%; }
  .iso-text { max-width: none; }
  .trust-strip { padding: 24px 0 28px; }
  .trust-grid { gap: 20px 14px; align-items: start; }
  .trust-item { flex-direction: column; justify-content: flex-start; text-align: center; gap: 8px; font-size: 13px; font-weight: 600; padding: 4px 6px; }
  .trust-icon { font-size: 1.45rem; }
}
@media (max-width: 359.98px) {
  .iso-col { padding-left: .25rem; padding-right: .25rem; }
  .iso-text { font-size: .76rem; line-height: 1.4; }
  .iso-name { font-size: .92rem; }
  .trust-grid { gap: 16px 8px; }
  .trust-item { font-size: 11.5px; gap: 6px; padding: 2px; }
}
@media (min-width: 992px) {
  .iso-steps-section { --ar: clamp(1.5rem, 1.1rem + .8vw, 1.9rem); }
  .iso-step { max-width: none; }               /* arrow hamesha step ke paas rahe */
  .iso-slab { filter: drop-shadow(0 -8px 15px rgba(var(--tint), .4)); }
}
@media (min-width: 1200px) {
  .trust-grid { display: flex; justify-content: space-between; gap: 16px; }
  .trust-item { white-space: nowrap; font-size: clamp(15px, 1.1vw, 20px); }
}
@media (min-width: 1400px) { .iso-title { letter-spacing: -0.025em; } }

@media (prefers-reduced-motion: reduce) {
  .iso-slab-wrap, .trust-item, .trust-icon { transition: none; }
  .iso-loop .iso-icon, .iso-loop .iso-col::before, .iso-loop .iso-slab-wrap, .iso-loop .iso-arrow i { animation: none; }
}
</style>

<!-- Shared SVG defs (ek hi baar, unique IDs). display:none nahi, warna Safari gradient/filter ignore karta hai -->
<svg width="0" height="0" style="position:absolute" aria-hidden="true" focusable="false">
  <defs>
    <radialGradient id="iso-glow" cx="50%" cy="50%" r="60%">
      <stop offset="0%" stop-color="#fff" stop-opacity=".45" />
      <stop offset="100%" stop-color="#fff" stop-opacity="0" />
    </radialGradient>
    <filter id="iso-blur" x="-10%" y="-80%" width="120%" height="260%">
      <feGaussianBlur stdDeviation="4" />
    </filter>
  </defs>
</svg>

<section class="iso-steps-section" id="how-it-works" aria-labelledby="iso-title">
  <div class="container">

    <div class="iso-head reveal d-flex flex-column flex-lg-row align-items-lg-end justify-content-between gap-3">
      <div>
        <span class="eyebrow iso-eyebrow"><i class="bi bi-gear-wide-connected"></i> How It Works</span>
        <h2 class="iso-title" id="iso-title">Scrap your vehicle in 4 simple steps</h2>
        <p class="iso-subtitle">Transparent, legal and Govt-approved.</p>
      </div>
      <a href="<?= $ctaHref ?>" class="btn btn-primary iso-cta">Get Best Price</a>
    </div>

    <ol class="iso-list row gx-2 gx-sm-3 gx-lg-4 gy-4 justify-content-center" id="iso-row">
      <?php foreach ($steps as $k => $s): $n = $k + 1; ?>
      <li class="col-6 col-lg-3">
        <div class="iso-step iso-shade-<?= $n ?>">
          <div class="iso-col">
            <span class="iso-icon"><i class="bi <?= $s['icon'] ?>" aria-hidden="true"></i></span>
            <h3 class="iso-name"><span class="visually-hidden">Step <?= $n ?>: </span><?= $s['name'] ?></h3>
            <p class="iso-text"><?= $s['text'] ?></p>
          </div>
          <div class="iso-slab-wrap">
            <svg class="iso-slab" viewBox="0 0 200 140" aria-hidden="true" focusable="false">
              <ellipse cx="100" cy="128" rx="92" ry="12" class="s-shadow" filter="url(#iso-blur)" />
              <polygon points="10,60 100,112 100,132 10,80" class="s-left" />
              <polygon points="100,112 190,60 190,80 100,132" class="s-right" />
              <polygon points="100,8 190,60 100,112 10,60" class="s-top" />
              <polygon points="100,8 190,60 100,112 10,60" fill="url(#iso-glow)" />
              <!-- number seedha (upright) -->
              <g>
                <text x="102" y="63" class="s-num-shadow"><?= $n ?></text>
                <text x="100" y="60" class="s-num"><?= $n ?></text>
              </g>
            </svg>
          </div>
        </div>
        <?php if ($n < count($steps)): ?>
        <span class="iso-arrow" aria-hidden="true"><i class="bi bi-chevron-right"></i><i class="bi bi-chevron-right"></i><i class="bi bi-chevron-right"></i></span>
        <?php endif; ?>
      </li>
      <?php endforeach; ?>
    </ol>

  </div>
</section>

<section class="trust-strip" aria-label="Trust and compliance guarantees">
  <div class="container">
    <div class="trust-grid">
      <?php foreach ($trust as $t): ?>
      <div class="trust-item">
        <i class="bi <?= $t[0] ?> trust-icon" aria-hidden="true"></i>
        <span class="trust-text"><?= $t[1] ?></span>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<script>
/* Scroll reveal (ek baar khulne ke baad open rehta hai) + uske baad hamesha chalne wala flow loop.
   JS na ho ya "reduce motion" ho to sab kuch visible rehta hai. */
(function () {
  var section = document.getElementById('how-it-works');
  var row = document.getElementById('iso-row');
  if (!section || !row) return;
  if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  var cols = Array.prototype.slice.call(row.children), N = cols.length;
  var clamp = function (v) { return v < 0 ? 0 : v > 1 ? 1 : v; };
  var seg = function (t, a, b) { return clamp((t - a) / (b - a)); };
  var easeOut = function (x) { return 1 - Math.pow(1 - x, 3); };
  var easeBack = function (x) { var c1 = 1.70158, c3 = c1 + 1; return 1 + c3 * Math.pow(x - 1, 3) + c1 * Math.pow(x - 1, 2); };

  function measure() {
    var vh = window.innerHeight, r = row.getBoundingClientRect();
    // Starts when top enters screen (vh * 0.88), fully open when comfortably in viewport (vh * 0.35)
    var start = vh * 0.88, end = vh * 0.35;
    var p = clamp((start - r.top) / (start - end));
    if ((window.innerHeight + (window.pageYOffset || window.scrollY || 0)) >= (document.documentElement.scrollHeight - 6) && r.bottom > 0) p = 1;
    return p;
  }

  /* <992px par 2x2 grid: ek row ke dono steps saath khulte hain */
  function render(p) {
    var per = window.innerWidth >= 992 ? 1 : 2, groups = Math.ceil(N / per);
    for (var i = 0; i < N; i++) {
      var t = p * groups - Math.floor(i / per), s = cols[i].style;
      s.setProperty('--sp', easeOut(seg(t, 0, .45)).toFixed(4));
      s.setProperty('--cp', easeOut(seg(t, .12, .75)).toFixed(4));
      s.setProperty('--ip', easeBack(seg(t, .4, .7)).toFixed(4));
      s.setProperty('--np', easeOut(seg(t, .5, .8)).toFixed(4));
      s.setProperty('--tp', easeOut(seg(t, .6, .9)).toFixed(4));
      s.setProperty('--ap', easeBack(seg(t, .62, 1)).toFixed(4));
    }
  }

  var target = measure(), current = target, raf = null, listening = false, inView = true;
  render(current);
  section.classList.add('iso-anim');

  /* loop tabhi chalta hai jab sab khul chuka ho aur section screen ke paas ho (CPU bachane ke liye) */
  function setLoop() { section.classList.toggle('iso-loop', current >= 0.999 && inView); }

  function tick() {
    raf = null;
    current += (target - current) * 0.14;
    if (Math.abs(target - current) < 0.0005) current = target;
    render(current);
    if (current !== target) raf = requestAnimationFrame(tick); else setLoop();
  }
  function update() {
    target = Math.max(target, measure());          // ratchet: wapas band nahi hoga
    if (!raf && current !== target) raf = requestAnimationFrame(tick); else if (!raf) setLoop();
  }
  function openFull() {
    target = 1;
    if (!raf && current !== target) raf = requestAnimationFrame(tick); else setLoop();
  }
  function listen(on) {
    if (on === listening) return;
    listening = on;
    window[on ? 'addEventListener' : 'removeEventListener']('scroll', update, { passive: true });
  }

  // Header click / hash navigation: instant open (just like lot-form.php)
  if (window.location.hash === '#how-it-works') {
    openFull();
  }
  document.addEventListener('click', function (e) {
    var a = e.target.closest('a');
    if (!a) return;
    var href = (a.getAttribute('href') || '').trim();
    if (href.indexOf('#how-it-works') !== -1) {
      openFull();
    }
  });

  if ('IntersectionObserver' in window) {
    new IntersectionObserver(function (e) {
      inView = e[0].isIntersecting;
      listen(inView);
      update();
      setLoop();
    }, { rootMargin: '150px 0px' }).observe(section);
  } else {
    listen(true);
  }
  window.addEventListener('resize', function () { render(current); update(); });
  window.addEventListener('load', update);
  window.addEventListener('pageshow', update);
  update();
})();
</script>