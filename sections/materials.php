<!-- ==========================================================================
     VEHICLES & RVSF SCRAP CATEGORIES (Self-Contained: HTML + CSS + JS)
     FIXED: no square flash on refresh, no zigzag/flicker on chip labels
     ========================================================================== -->
<section class="section" id="categories">
  <div class="container">
    <div class="section-head reveal text-center">
      <span class="eyebrow">Authorized Vehicle Scrapping</span>
      <h2>Vehicle Scrapping Categories</h2>
      <p class="section-lead">Transparent scrap value with a legal Certificate of Deposit (COD).</p>
    </div>

    <div class="row g-5 align-items-center reveal mt-2">
      <!-- Left Column: 3D layered stage -->
      <div class="col-lg-6">
        <div class="o3d-wrap" id="o3dWrap" aria-label="Vehicle categories 3D stage">
          <div class="o3d-scale" id="o3dScale">
            <div class="o3d-persp">
              <div class="o3d-tilt" id="o3dTilt"></div>
            </div>
            <!-- flat overlay: chips + centre hub (projected from JS, no 3D intersection) -->
            <div class="o3d-chips" id="o3dChips"></div>
          </div>
          <div class="orbit-hint text-center">
            <span class="hint-badge"><i class="bi bi-cursor-fill me-1"></i> Tap a vehicle</span>
          </div>
        </div>
      </div>

      <!-- Right Column: Category Tabs + Instruction Card -->
      <div class="col-lg-6">
        <div class="vehicle-tabs-wrap">
          <div class="vehicle-tabs" role="tablist" aria-label="Vehicle Categories" id="vehicleTabs"></div>
        </div>
        <article class="vehicle-detail-panel" id="vehiclePanel" role="tabpanel" aria-live="polite"></article>
      </div>
    </div>
  </div>
</section>

<style>
  #categories {
    --font-body: Poppins, Helvetica, sans-serif;
    --font-serif: ui-serif, Georgia, Cambria, "Times New Roman", Times, serif;
    --font-heading: var(--font-serif);
    --font-subhead: var(--font-body);
    --c-brand: #1B692C;
    --c-muted-text: #53695e;
    --c-dark-text: #0f1f1a;
    font-family: var(--font-body);
    overflow-x: clip;
    position: relative;
    padding: 72px 0 88px;
    color: var(--c-dark-text);
    background: var(--section-bg-white);
  }

  #categories .section-head .eyebrow {
    font-family: var(--font-body);
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--color-primary, #1B692C);
  }

  #categories .section-head h2 {
    font-family: var(--font-heading);
    font-size: var(--heading-size);
    font-weight: var(--heading-weight);
    line-height: var(--heading-line-height);
    letter-spacing: var(--heading-letter-spacing);
    color: var(--heading-color);
    margin: .6rem 0;
  }

  #categories .section-head .section-lead {
    font-family: var(--font-body);
    color: var(--muted, #899097);
    font-size: clamp(0.92rem, 1.1vw, 1.04rem);
    line-height: 1.6;
  }

  /* ---------- 3D stage ---------- */
  /* hidden until first frame is laid out -> no square/unscaled flash on refresh */
  .o3d-wrap {
    position: relative;
    width: 100%;
    max-width: 600px;
    margin: 0 auto;
    aspect-ratio: 780/560;
    user-select: none;
    touch-action: pan-y;
    cursor: grab;
    opacity: 0;
    transition: opacity .35s ease
  }

  .o3d-wrap.ready {
    opacity: 1
  }

  .o3d-wrap:active {
    cursor: grabbing
  }

  .o3d-scale {
    position: absolute;
    left: 0;
    top: 0;
    width: 780px;
    height: 560px;
    transform-origin: 0 0
  }

  .o3d-persp {
    position: absolute;
    inset: 0;
    perspective: 1500px
  }

  .o3d-tilt,
  .o3d-spin {
    position: absolute;
    left: 0;
    top: 0;
    width: 0;
    height: 0;
    transform-style: preserve-3d
  }

  .o3d-tilt {
    left: 50%;
    top: 68%;
    transform: rotateX(var(--t, 58deg))
  }

  .o3d-d {
    position: absolute;
    left: 0;
    top: 0;
    border-radius: 50%;
    transform-style: preserve-3d;
    backface-visibility: hidden
  }

  .o3d-plane {
    display: grid;
    place-items: center;
    text-align: center;
    color: #0E6E3E
  }

  .o3d-plane img {
    width: 84%;
    max-height: 84%;
    object-fit: contain;
    filter: drop-shadow(0 4px 8px rgba(14, 110, 62, .25))
  }

  .o3d-item {
    position: absolute;
    left: 0;
    top: 0;
    transform-style: preserve-3d
  }

  .o3d-dot {
    position: absolute;
    left: -9px;
    top: -9px;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: radial-gradient(circle, #7df0ad, rgba(47, 191, 113, .2) 70%);
    box-shadow: 0 0 14px rgba(47, 191, 113, .9)
  }

  /* flat overlay layer */
  .o3d-chips {
    position: absolute;
    inset: 0;
    pointer-events: none
  }

  .o3d-chip-pos {
    position: absolute;
    left: 0;
    top: 0;
    width: 150px;
    height: 110px;
    margin: -55px 0 0 -75px;
    display: grid;
    place-items: center;
    will-change: transform;
    backface-visibility: hidden
  }

  /* centre sphere cluster (flat overlay) */
  .orbit-center-cluster {
    position: absolute;
    left: -48px;
    top: -48px;
    width: 96px;
    height: 96px;
    display: grid;
    place-items: center;
    pointer-events: none;
    will-change: transform
  }

  .sphere-floor-shadow {
    position: absolute;
    top: 86px;
    width: 86px;
    height: 20px;
    border-radius: 50%;
    background: radial-gradient(ellipse, rgba(5, 38, 20, .4) 0%, transparent 72%);
    filter: blur(5px)
  }

  .o3d-ring,
  .o3d-track {
    position: absolute;
    left: 0;
    top: 0;
    border-radius: 50%
  }

  .o3d-track {
    border: 1px solid rgba(14, 110, 62, .45)
  }

  .o3d-ring {
    background: conic-gradient(from 0deg, rgba(14, 110, 62, 0) 0 30%, rgba(14, 110, 62, .9) 78%, #0E6E3E 100%);
    -webkit-mask: radial-gradient(farthest-side, transparent calc(100% - 5px), #000 calc(100% - 4px));
    mask: radial-gradient(farthest-side, transparent calc(100% - 5px), #000 calc(100% - 4px));
    animation: ringSpin var(--sp) linear infinite;
    animation-direction: var(--dir);
    filter: drop-shadow(0 0 4px rgba(14, 110, 62, .5))
  }

  @keyframes ringSpin {
    to {
      transform: rotate(360deg)
    }
  }

  .glossy-3d-sphere {
    position: relative;
    width: 92px;
    height: 92px;
    border-radius: 50%;
    display: grid;
    place-items: center;
    z-index: 2;
    background: radial-gradient(circle at 35% 26%, #fff 0%, #f4fff8 55%, #d3f3e0 100%);
    border: 4px solid #0E6E3E;
    box-shadow: inset 0 -6px 12px rgba(14, 110, 62, .18), 0 14px 30px -4px rgba(5, 46, 26, .5), 0 0 0 6px rgba(47, 191, 113, .18), 0 0 38px rgba(47, 191, 113, .6);
    animation: sphereFloat 4s ease-in-out infinite alternate
  }

  .hub-logo {
    width: 68%;
    height: 68%;
    object-fit: contain;
    position: relative;
    z-index: 1
  }

  @keyframes sphereFloat {
    from {
      transform: translateY(0)
    }

    to {
      transform: translateY(-6px)
    }
  }

  .sphere-gloss-highlight {
    position: absolute;
    z-index: 2;
    top: 6px;
    left: 16px;
    width: 30px;
    height: 14px;
    border-radius: 50%;
    background: radial-gradient(ellipse, rgba(255, 255, 255, .8) 0%, rgba(255, 255, 255, 0) 80%);
    transform: rotate(-25deg)
  }

  .sphere-recycle-icon {
    display: none;
    width: 40px;
    height: 40px;
    color: #0E6E3E
  }

  /* vehicle chips */
  .orbit-chip-item {
    position: static;
    transform: none;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 3px;
    pointer-events: auto;
    background: rgba(255, 255, 255, .96);
    border: 1.5px solid rgba(47, 191, 113, .35);
    border-radius: 14px;
    padding: 5px 9px 5px;
    white-space: nowrap;
    cursor: pointer;
    box-shadow: 0 12px 26px -4px rgba(11, 58, 36, .22), 0 2px 6px rgba(0, 0, 0, .05);
    transition: border-color .25s, box-shadow .25s
  }

  .orbit-chip-item .chip-icon-box {
    width: 34px;
    height: 34px;
    border-radius: 10px;
    background: #eef9f2;
    color: #0E6E3E;
    display: grid;
    place-items: center;
    font-size: 1.2rem;
    transition: background .25s, color .25s
  }

  .orbit-chip-item .chip-label-text {
    display: flex;
    flex-direction: column;
    line-height: 1.2;
    text-align: center
  }

  .orbit-chip-item .chip-label-text strong {
    font-family: var(--font-heading);
    font-size: .85rem;
    font-weight: 800;
    color: #0f1f1a
  }

  .orbit-chip-item .chip-label-text span {
    display: none;
    font-size: .62rem;
    font-weight: 600;
    color: #556b60
  }

  .orbit-chip-item.active .chip-label-text span {
    display: block
  }

  .orbit-chip-item:hover {
    border-color: #0E6E3E;
    box-shadow: 0 14px 30px -4px rgba(14, 110, 62, .35)
  }

  .orbit-chip-item:hover .chip-icon-box {
    background: #0E6E3E;
    color: #fff
  }

  .orbit-chip-item.active {
    border: 2px solid #0E6E3E;
    box-shadow: 0 16px 36px -6px rgba(47, 191, 113, .5), 0 0 0 4px rgba(47, 191, 113, .2)
  }

  .orbit-chip-item.active .chip-icon-box {
    background: linear-gradient(135deg, #0E6E3E, #0a4f2b);
    color: #fff
  }

  .orbit-chip-item.active .chip-label-text strong {
    color: #0E6E3E
  }

  .orbit-hint {
    position: absolute;
    bottom: -14px;
    left: 0;
    right: 0;
    z-index: 5;
    pointer-events: none
  }

  .hint-badge {
    display: inline-flex;
    align-items: center;
    font-family: var(--font-subhead);
    background: rgba(14, 110, 62, .08);
    border: 1px solid rgba(47, 191, 113, .32);
    color: #0E6E3E;
    font-size: .74rem;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 20px;
    backdrop-filter: blur(4px)
  }

  /* Right column */
  .vehicle-tabs-wrap {
    width: 100%;
    margin-bottom: 20px
  }

  .vehicle-tabs {
    display: flex;
    flex-wrap: wrap;
    gap: 8px
  }

  .v-tab-btn {
    border: 1.5px solid var(--line, #e2ebe6);
    background: #fff;
    color: #2c3e35;
    padding: 7px 14px;
    font-family: var(--font-heading);
    font-weight: 700;
    font-size: .85rem;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    border-radius: 8px;
    transition: all .22s cubic-bezier(.16, 1, .3, 1);
    box-shadow: 0 2px 6px rgba(0, 0, 0, .03);
    cursor: pointer
  }

  .v-tab-btn i {
    color: var(--color-primary, #1B692C);
    font-size: 1rem
  }

  .v-tab-btn:hover {
    border-color: var(--color-primary, #1B692C);
    background: #f0fbf5;
    color: var(--color-primary, #1B692C);
    transform: translateY(-1px)
  }

  .v-tab-btn[aria-selected="true"],
  .v-tab-btn.active {
    background: var(--color-primary, #1B692C);
    color: #fff;
    border-color: var(--color-primary, #1B692C);
    box-shadow: 0 4px 14px rgba(27, 105, 44, .35);
    transform: translateY(-2px)
  }

  .v-tab-btn[aria-selected="true"] i,
  .v-tab-btn.active i {
    color: #7df0ad
  }

  .vehicle-detail-panel {
    background: #fff;
    border: 1.5px solid rgba(47, 191, 113, .25);
    border-radius: 20px;
    padding: 28px;
    box-shadow: 0 18px 45px -15px rgba(11, 58, 36, .12), 0 4px 16px rgba(0, 0, 0, .04);
    position: relative;
    overflow: hidden;
    transition: opacity .2s ease, transform .2s ease
  }

  .vehicle-detail-panel.is-out {
    opacity: 0;
    transform: translateY(8px)
  }

  .vehicle-detail-panel::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #0E6E3E, #2fbf71, #7df0ad)
  }

  .panel-header-badges {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 8px;
    margin-bottom: 12px
  }

  .badge-seq {
    font-family: var(--font-heading);
    background: rgba(14, 110, 62, .1);
    color: #0E6E3E;
    font-weight: 800;
    font-size: .72rem;
    letter-spacing: .06em;
    padding: 4px 10px;
    border-radius: 6px
  }

  .badge-status {
    background: #ecfdf5;
    color: #065f46;
    border: 1px solid #a7f3d0;
    font-weight: 700;
    font-size: .72rem;
    padding: 3px 10px;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    gap: 4px
  }

  .badge-code {
    font-family: var(--font-heading);
    background: #0E6E3E;
    color: #fff;
    font-weight: 900;
    font-size: .72rem;
    padding: 3px 10px;
    border-radius: 6px;
    letter-spacing: .05em
  }

  .panel-title {
    font-family: var(--font-heading);
    font-size: clamp(1.35rem, 2.2vw, 1.8rem);
    font-weight: 700;
    color: #0f1f1a;
    line-height: 1.25;
    margin: 4px 0 8px;
    letter-spacing: -.3px
  }

  .panel-desc {
    color: #4b5e54;
    font-size: .94rem;
    line-height: 1.55;
    margin-bottom: 18px
  }

  .panel-metrics-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(135px, 1fr));
    gap: 10px;
    background: #f7faf8;
    border: 1px solid #e1ede6;
    border-radius: 14px;
    padding: 14px;
    margin-bottom: 22px
  }

  .metric-item {
    display: flex;
    flex-direction: column;
    gap: 2px
  }

  .metric-label {
    font-family: var(--font-heading);
    font-size: .7rem;
    font-weight: 700;
    color: #5d7166;
    text-transform: uppercase;
    letter-spacing: .04em
  }

  .metric-value {
    font-family: var(--font-heading);
    font-size: 1.05rem;
    font-weight: 800;
    color: #0E6E3E;
    line-height: 1.2;
    letter-spacing: -.2px
  }

  .metric-value.accent {
    color: #0f1f1a
  }

  .metric-sub {
    font-size: .68rem;
    color: #7a8e83;
    font-weight: 500
  }

  .instruction-title {
    font-family: var(--font-heading);
    font-size: .88rem;
    font-weight: 800;
    color: #0f1f1a;
    text-transform: uppercase;
    letter-spacing: .04em;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 6px
  }

  .instruction-steps {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
    margin-bottom: 22px
  }

  .step-box {
    background: #fff;
    border: 1px solid #e2ebe5;
    border-radius: 12px;
    padding: 10px 12px;
    display: flex;
    align-items: flex-start;
    gap: 10px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, .02);
    transition: transform .2s, border-color .2s
  }

  .step-box:hover {
    transform: translateY(-1px);
    border-color: #0E6E3E
  }

  .step-num {
    font-family: var(--font-heading);
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: #0E6E3E;
    color: #fff;
    font-weight: 800;
    font-size: .72rem;
    display: grid;
    place-items: center;
    flex-shrink: 0;
    margin-top: 2px
  }

  .step-info strong {
    font-family: var(--font-heading);
    display: block;
    font-size: .82rem;
    font-weight: 700;
    color: #0f1f1a;
    line-height: 1.3
  }

  .step-info span {
    display: block;
    font-size: .75rem;
    color: #55695e;
    line-height: 1.35;
    margin-top: 2px
  }

  .panel-action-bar {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding-top: 16px;
    border-top: 1px solid #eef3f0
  }

  .btn-quote-action {
    font-family: var(--font-heading);
    background: var(--color-primary, #1B692C);
    color: #fff;
    border: none;
    padding: 11px 22px;
    border-radius: 8px !important;
    font-weight: 700;
    font-size: .92rem;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    box-shadow: 0 4px 14px -2px rgba(27, 105, 44, .4);
    transition: all .25s ease;
  }

  .btn-quote-action:hover {
    background: #145222;
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 8px 22px -2px rgba(27, 105, 44, .55);
  }

  .panel-guarantees {
    display: flex;
    align-items: center;
    gap: 14px;
    font-size: .76rem;
    font-weight: 600;
    color: #52675b
  }

  .panel-guarantees span {
    display: inline-flex;
    align-items: center;
    gap: 4px
  }

  .panel-guarantees i {
    color: #16a34a
  }

  @media (max-width:991.98px) {
    .o3d-wrap {
      max-width: 540px;
      margin-bottom: 20px
    }

    .panel-metrics-grid {
      gap: 12px
    }
  }

  @media (max-width:767.98px) {
    #categories {
      padding: 50px 0 65px
    }

    .vehicle-tabs-wrap {
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
      padding-bottom: 6px;
      margin-bottom: 14px
    }

    .vehicle-tabs {
      flex-wrap: nowrap;
      width: max-content;
      gap: 6px
    }

    .v-tab-btn {
      padding: 6px 12px;
      font-size: .8rem;
      white-space: nowrap
    }

    .vehicle-detail-panel {
      padding: 20px 16px;
      border-radius: 16px
    }

    .panel-title {
      font-size: 1.35rem
    }

    .instruction-steps {
      grid-template-columns: 1fr 1fr
    }

    .panel-action-bar {
      flex-direction: column;
      align-items: stretch;
      text-align: center
    }

    .btn-quote-action {
      justify-content: center
    }

    .panel-guarantees {
      justify-content: center;
      flex-wrap: wrap;
      gap: 10px
    }
  }

  @media (max-width:575.98px) {
    .o3d-wrap {
      width: calc(100% - 40px)
    }
  }

  @media (max-width:479.98px) {
    .panel-metrics-grid {
      padding: 10px;
      gap: 8px
    }

    .metric-value {
      font-size: .95rem
    }
  }

  @media (max-width:359.98px) {
    .instruction-steps {
      grid-template-columns: 1fr
    }
  }

  @media (prefers-reduced-motion:reduce) {

    .o3d-ring,
    .glossy-3d-sphere {
      animation: none
    }

    .o3d-wrap {
      transition: none
    }
  }
</style>

<script>
  (function() {
    const VEHICLES = [{
        code: 'LMV',
        icon: 'bi-car-front-fill',
        name: 'Private Cars & SUVs (LMV)',
        short: 'Cars / SUVs',
        desc: 'End-of-life private hatchbacks, sedans & SUVs (15+ yrs petrol / 10+ yrs diesel) processed directly at authorized RVSFs.',
        minPrice: '₹12,000',
        maxPrice: '₹95,000',
        rebate: 'Up to 25% Tax Rebate',
        cod: 'Direct VAHAN COD',
        steps: [{
          t: '1. Govt. Authorized RVSF',
          d: 'Instant fair quote via RC number & vehicle state.'
        }, {
          t: '2. Free Doorstep Pickup',
          d: 'Zero-cost towing straight to authorized RVSF.'
        }, {
          t: '3. Transparent Pricing',
          d: 'Eco-friendly fluid draining & chassis slicing.'
        }, {
          t: '4. Instant Payment',
          d: 'Direct bank transfer + official VAHAN COD.'
        }]
      },
      {
        code: '2WN',
        icon: 'bi-bicycle',
        name: 'Two-Wheelers (Bikes & Scooters)',
        short: 'Bikes / Scooters',
        desc: '15+ year old motorcycles, scooters and mopeds with expired registration, de-linked to prevent illegal reuse.',
        minPrice: '₹1,500',
        maxPrice: '₹12,000',
        rebate: 'Safe RTO De-Registration',
        cod: 'Zero Police / Challan Risk',
        steps: [{
          t: '1. Quick Bike Quote',
          d: 'Rate based on engine CC & dry metal weight.'
        }, {
          t: '2. Doorstep Pickup',
          d: 'RC verification & digital handover receipt.'
        }, {
          t: '3. Chassis Destruction',
          d: 'Physical engine & chassis slicing prevents cloning.'
        }, {
          t: '4. COD & Bank Transfer',
          d: 'Instant payout + RTO cancellation proof.'
        }]
      },
      {
        code: 'LGV',
        icon: 'bi-truck',
        name: 'Light Goods Vehicles (Pickups & Minis)',
        short: 'Pickups / Minis',
        desc: 'Commercial mini-trucks and delivery carriers (Tata Ace, Bolero Pik-Up, Dost) completing commercial fitness validity.',
        minPrice: '₹15,000',
        maxPrice: '₹85,000',
        rebate: 'Commercial Tax Waiver',
        cod: 'Permit De-Linking COD',
        steps: [{
          t: '1. Commercial Audit',
          d: 'Fast fitness validity & commercial permit check.'
        }, {
          t: '2. Flatbed Recovery',
          d: 'Heavy recovery dispatched to your yard or depot.'
        }, {
          t: '3. Weighbridge Scrap Rate',
          d: 'Certified kerb weight for maximum metal payout.'
        }, {
          t: '4. Fast Settlement',
          d: 'Direct bank RTGS + permit surrender assistance.'
        }]
      },
      {
        code: 'HGV',
        icon: 'bi-truck-flatbed',
        name: 'Heavy Goods Vehicles (Cargo Trucks & Tippers)',
        short: 'Heavy Multi-Axle',
        desc: 'Multi-axle heavy haulers, 10/12/14-wheeler dumpers and trailers retiring under national transport regulations.',
        minPrice: '₹65,000',
        maxPrice: '₹2,50,000',
        rebate: 'Fleet Subsidy Eligible',
        cod: 'Tonnage-Based National COD',
        steps: [{
          t: '1. On-Site Valuation',
          d: 'Technical appraisal at transport hub or depot.'
        }, {
          t: '2. Heavy Crane Logistics',
          d: 'Commercial recovery cranes & transport arranged.'
        }, {
          t: '3. Hydraulic Shearing',
          d: 'Certified dismantling of chassis rails & axles.'
        }, {
          t: '4. Bulk Payout & COD',
          d: 'Immediate RTGS payout + National Scrappage COD.'
        }]
      },
      {
        code: 'MGV',
        icon: 'bi-truck-front-fill',
        name: 'Medium Goods Vehicles (Tempo & 407 Trucks)',
        short: 'Tempo / 407 Trucks',
        desc: 'Medium tonnage delivery trucks (Tata 407, Eicher Pro, Swaraj Mazda) facing commercial permit phase-out.',
        minPrice: '₹35,000',
        maxPrice: '₹1,20,000',
        rebate: 'High Steel Scrap Yield',
        cod: 'Full MoRTH Tax Exemption',
        steps: [{
          t: '1. Fleet Quote',
          d: 'Single truck or commercial fleet valuation.'
        }, {
          t: '2. Tow Dispatch',
          d: 'Scheduled pickup with complete digital receipt.'
        }, {
          t: '3. Depollution & Baling',
          d: 'Safe hazardous fluid draining & eco-compaction.'
        }, {
          t: '4. VAHAN De-Linking',
          d: 'Permanent chassis retirement on VAHAN portal.'
        }]
      },
      {
        code: 'LPV',
        icon: 'bi-car-front',
        name: 'Light Passenger Vehicles (Vans & Cabs)',
        short: 'Vans / Micro-Cabs',
        desc: 'Shared passenger vans, micro-buses and utility campers (Maruti Eeco, Omni, Bolero Camper) completing legal lifespan.',
        minPrice: '₹14,000',
        maxPrice: '₹90,000',
        rebate: 'Up to 25% Tax Rebate',
        cod: 'Commercial COD Issued',
        steps: [{
          t: '1. Document Review',
          d: 'Rapid RC, permit & fitness audit for scrap clearance.'
        }, {
          t: '2. Free Doorstep Pickup',
          d: 'Safe towing from parking, garage or taxi stand.'
        }, {
          t: '3. RVSF Dismantling',
          d: 'Certified eco-friendly component recycling.'
        }, {
          t: '4. Instant Payment',
          d: 'Spot bank payout + Certificate of Deposit issued.'
        }]
      },
      {
        code: '4WIC',
        icon: 'bi-taxi-front-fill',
        name: 'Commercial Fleet Cabs & App Taxis',
        short: 'Fleet Cabs / Taxis',
        desc: 'Commercial fleet sedans and tourist taxis (Dzire Tour, Etios, Indigo) reaching statutory age limits.',
        minPrice: '₹18,000',
        maxPrice: '₹75,000',
        rebate: 'New Taxi Purchase Benefit',
        cod: 'Commercial RTO COD',
        steps: [{
          t: '1. Kerb Valuation',
          d: 'Transparent rate based on unladen kerb weight.'
        }, {
          t: '2. Fleet Coordination',
          d: 'Single or bulk cab towing from your depot.'
        }, {
          t: '3. Destruction Video',
          d: 'Destruction video recorded for corporate audit.'
        }, {
          t: '4. Direct Bank RTGS',
          d: 'Fast settlement with complete MoRTH COD.'
        }]
      },
      {
        code: 'HPV',
        icon: 'bi-bus-front-fill',
        name: 'Heavy Passenger Vehicles (Buses & Coaches)',
        short: 'Commercial Buses',
        desc: 'Full-size passenger buses, 40+ seater staff coaches, school buses and sleeper carriers completing 15-year limits.',
        minPrice: '₹75,000',
        maxPrice: '₹3,20,000',
        rebate: 'High Tonnage Recovery',
        cod: 'Institutional VAHAN COD',
        steps: [{
          t: '1. Depot Valuation',
          d: 'Specialist team visits school/college/depot.'
        }, {
          t: '2. Heavy Breakdown Tow',
          d: 'Commercial heavy towing moves non-runners.'
        }, {
          t: '3. Industrial Demolition',
          d: 'Heavy chassis, engine block & body recycling.'
        }, {
          t: '4. Institutional COD',
          d: 'Official government certificate for audit records.'
        }]
      },
      {
        code: 'MPV',
        icon: 'bi-truck',
        name: 'Medium Passenger Vehicles (Mini-Buses)',
        short: 'Mini-Buses / Utility',
        desc: 'Medium passenger carriers, hospital ambulances and corporate shuttles (Force Traveller, Tata Winger) at end-of-life.',
        minPrice: '₹30,000',
        maxPrice: '₹1,40,000',
        rebate: 'Utility Replacement Bonus',
        cod: 'Govt Certified Scrapping',
        steps: [{
          t: '1. Condition Check',
          d: 'Quick appraisal by body type & dry kerb weight.'
        }, {
          t: '2. Site Pickup',
          d: 'Direct pickup from hospital, yard or business premises.'
        }, {
          t: '3. Authorized Shredding',
          d: 'High-pressure baling & environmental handling.'
        }, {
          t: '4. Direct Payout',
          d: 'Spot bank transfer + VAHAN Certificate of Deposit.'
        }]
      }
    ];

    const tabsContainer = document.getElementById('vehicleTabs'),
      panelContainer = document.getElementById('vehiclePanel'),
      wrap = document.getElementById('o3dWrap'),
      scaleEl = document.getElementById('o3dScale'),
      tilt = document.getElementById('o3dTilt'),
      chipsLayer = document.getElementById('o3dChips');
    if (!tabsContainer || !panelContainer || !wrap || !tilt || !chipsLayer) return;

    const TILT = 58,
      STEP = 360 / VEHICLES.length;
    const mk = (cls, css, parent) => {
      const d = document.createElement('div');
      d.className = cls;
      d.style.cssText = css;
      parent.appendChild(d);
      return d;
    };
    const disc = (R, z, bg, extra = '') => mk('o3d-d', `width:${R*2}px;height:${R*2}px;margin:${-R}px 0 0 ${-R}px;transform:translateZ(${z}px);background:${bg};${extra}`, tilt);
    const mix = (a, b, t) => a.map((v, i) => Math.round(v + (b[i] - v) * t));

    /* fewer layers: one every 4px (was 2px) */
    function tier(R, z0, h, c1, c2, topBg) {
      const n = Math.max(2, Math.round(h / 4));
      for (let k = 0; k <= n; k++) disc(R, z0 + h * k / n, `rgba(${mix(c1, c2, k / n)},.94)`, 'box-shadow:0 0 0 1px rgba(255,255,255,.3)');
      return disc(R - 6, z0 + h + .6, topBg, 'box-shadow:inset 0 0 40px rgba(255,255,255,.95),0 0 0 2px rgba(255,255,255,.9)');
    }

    const walls = [];

    function wall(R, z0, h, arc, rot, col, top = '255,255,255', glow = '47,191,113') {
      const g = mk('o3d-spin', '', tilt);
      walls.push({
        g,
        rot
      });
      const m = `conic-gradient(#000 0 ${arc}deg,transparent ${arc}deg)`;
      const base = `width:${R*2}px;height:${R*2}px;margin:${-R}px 0 0 ${-R}px;-webkit-mask:${m};mask:${m};`;
      for (let z = z0; z <= z0 + h; z += 4) mk('o3d-d', `${base}transform:translateZ(${z}px);border:7px solid rgba(${col},${(.1 + .42 * (z - z0) / h).toFixed(2)})`, g);
      mk('o3d-d', `${base}transform:translateZ(${z0 + h}px);border:4px solid rgba(${top},.95);box-shadow:0 0 14px rgba(${glow},.85)`, g);
    }

    disc(440, -6, 'radial-gradient(circle,rgba(47,191,113,.42),rgba(47,191,113,0) 70%)');
    const LIGHT = 'radial-gradient(circle,#fbfffc,#e6f7ee 70%,#cdeedb)';
    tier(300, 0, 14, [110, 196, 152], [214, 242, 226], LIGHT);
    tier(255, 14, 24, [100, 190, 146], [220, 245, 231], LIGHT);
    tier(210, 38, 28, [80, 176, 130], [224, 246, 233], LIGHT);
    tier(170, 66, 18, [14, 110, 62], [47, 191, 113], 'radial-gradient(circle,#dff6e8 62%,#2fbf71 64%,#7df0ad)');
    const plate = tier(142, 84, 12, [190, 228, 206], [236, 249, 241], 'radial-gradient(circle at 40% 35%,#fff,#e9f8ef 60%,#c3e9d3)');
    plate.classList.add('o3d-plane');
    plate.innerHTML = '<img src="assets/media/logo.webp" alt="Motozo" onerror="this.style.display=\'none\'">';

    wall(322, 0, 92, 210, .35, '225,250,236');
    wall(268, 14, 78, 250, -.5, '190,238,212');
    wall(216, 38, 62, 290, .7, '255,255,255');
    wall(176, 66, 40, 330, -.9, '14,110,62', '14,110,62', '14,110,62');

    disc(80, 98);

    /* centre hub: flat overlay (no longer a 3D plane) */
    const hub = document.createElement('div');
    hub.className = 'orbit-center-cluster';
    hub.setAttribute('aria-hidden', 'true');
    hub.innerHTML = `<div class="sphere-floor-shadow"></div>
    <div class="glossy-3d-sphere"><div class="sphere-gloss-highlight"></div>
    <img class="hub-logo" src="assets/media/rvsf-ministry.webp" alt="RVSF Ministry" onerror="this.style.display='none';this.nextElementSibling.style.display='block'"><svg class="sphere-recycle-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M7 19H4.815a1.83 1.83 0 0 1-1.57-.881 1.785 1.785 0 0 1-.004-1.784L7.196 9.5"/><path d="M11 19h8.203a1.83 1.83 0 0 0 1.556-.89 1.784 1.784 0 0 0 0-1.775l-1.226-2.12"/><path d="m14 16 3 3 3-3"/><path d="M8.293 13.596 4.3 6.643a1.83 1.83 0 0 1 .006-1.776 1.785 1.785 0 0 1 1.57-.867h9.08"/><path d="m9 7-3-3-3 3"/><path d="m15.5 10 3-3-3-3"/></svg></div>`;
    chipsLayer.appendChild(hub);

    /* orbit: only the glowing dots live in 3D; chips are flat overlays */
    const ring = mk('o3d-spin', '', tilt);
    const chipPos = [];
    const chipNodes = VEHICLES.map((v, i) => {
      const th = i * STEP;
      const it = mk('o3d-item', `transform:rotateZ(${th}deg) translateX(345px) translateZ(170px)`, ring);
      it.innerHTML = `<div class="o3d-dot" style="transform:translateZ(-168px)"></div>`;
      const pos = document.createElement('div');
      pos.className = 'o3d-chip-pos';
      pos.innerHTML = `<div class="orbit-chip-item ${i === 0 ? 'active' : ''}" role="button" tabindex="0" aria-label="Select ${v.name}">
      <span class="chip-icon-box"><i class="bi ${v.icon}" aria-hidden="true"></i></span>
      <span class="chip-label-text"><strong>${v.code}</strong><span>${v.short}</span></span></div>`;
      chipsLayer.appendChild(pos);
      chipPos.push({
        pos,
        th
      });
      return pos.querySelector('.orbit-chip-item');
    });

    let a = 90,
      tween = null,
      dragging = false,
      moved = 0,
      lx = 0,
      k = 1,
      cs = 1,
      hold = false,
      resumeAt = 0;
    const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* projection: perspective 1500, tilt 58deg, origin (50%, 68%) of 780x560 stage */
    const P = 1500,
      TR = TILT * Math.PI / 180,
      SIN = Math.sin(TR),
      COS = Math.cos(TR);
    const OX = 390,
      OY = 280,
      TOP = 560 * 0.68;

    function project(x, y, z) {
      const yy = y * COS - z * SIN,
        zz = y * SIN + z * COS;
      const s = P / (P - zz);
      return {
        x: OX + x * s,
        y: OY + (TOP - OY + yy) * s,
        s,
        z: zz
      };
    }

    function layout() {
      chipPos.forEach(c => {
        const ang = (c.th + a) * Math.PI / 180;
        const p = project(345 * Math.cos(ang), 345 * Math.sin(ang), 170);
        c.pos.style.transform = `translate(${p.x.toFixed(2)}px,${p.y.toFixed(2)}px) scale(${(cs * p.s).toFixed(3)})`;
        c.pos.style.zIndex = Math.round(p.z + 1000);
      });
      const h = project(0, 0, 255);
      hub.style.transform = `translate(${h.x.toFixed(2)}px,${h.y.toFixed(2)}px) scale(${(1.5 * h.s).toFixed(3)})`;
      hub.style.zIndex = Math.round(h.z + 1000);
    }

    function fit() {
      k = wrap.clientWidth / 780;
      scaleEl.style.transform = `scale(${k})`;
      cs = Math.min(.85 / k, 1.5);
      wrap.style.setProperty('--t', TILT + 'deg');
      layout();
    }
    window.addEventListener('resize', fit);
    fit();

    const ease = t => t < .5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;

    function rotateTo(deg) {
      const diff = ((deg - a + 540) % 360) - 180;
      tween = {
        from: a,
        diff,
        t0: performance.now(),
        dur: reduce ? 1 : 1000
      };
      resumeAt = performance.now() + 2200;
    }
    wrap.addEventListener('pointerdown', e => {
      dragging = true;
      moved = 0;
      lx = e.clientX;
      tween = null;
    });
    window.addEventListener('pointermove', e => {
      if (!dragging) return;
      const dx = e.clientX - lx;
      lx = e.clientX;
      moved += Math.abs(dx);
      a += dx * .45;
    });
    window.addEventListener('pointerup', () => {
      dragging = false;
      resumeAt = performance.now() + 1500;
    });

    let lt = performance.now();
    (function loop(now) {
      const dt = Math.min(now - lt, 50);
      lt = now;
      if (!tween && !dragging && !hold && !reduce && now > resumeAt) a += dt * .013;
      if (tween) {
        const p = Math.min((now - tween.t0) / tween.dur, 1);
        a = tween.from + tween.diff * ease(p);
        if (p >= 1) tween = null;
      }
      /* only transforms change per frame (no inherited CSS variable restyle) */
      ring.style.transform = `rotateZ(${a.toFixed(2)}deg)`;
      for (const w of walls) w.g.style.transform = `rotateZ(${(a * w.rot).toFixed(2)}deg)`;
      layout();
      requestAnimationFrame(loop);
    })(performance.now());

    /* reveal only after first frames are painted -> no square flash */
    requestAnimationFrame(() => requestAnimationFrame(() => wrap.classList.add('ready')));

    tabsContainer.innerHTML = VEHICLES.map((v, i) => `
    <button type="button" class="v-tab-btn ${i === 0 ? 'active' : ''}" role="tab" aria-selected="${i === 0}" tabindex="${i === 0 ? 0 : -1}" data-index="${i}">
      <i class="bi ${v.icon}" aria-hidden="true"></i><span>${v.code}</span></button>`).join('');

    let swapTimer, first = true;

    function renderVehicleDetail(i) {
      const v = VEHICLES[i];
      tabsContainer.querySelectorAll('.v-tab-btn').forEach((btn, n) => {
        btn.setAttribute('aria-selected', n === i);
        btn.classList.toggle('active', n === i);
        btn.tabIndex = n === i ? 0 : -1;
      });
      chipNodes.forEach((c, n) => c.classList.toggle('active', n === i));
      rotateTo(90 - i * STEP);

      const html = `
      <div class="panel-header-badges">
        <span class="badge-code">${v.code}</span>
        <span class="badge-status"><i class="bi bi-shield-fill-check" aria-hidden="true"></i> RVSF Authorized</span>
      </div>
      <h3 class="panel-title">${v.name}</h3>
      <div class="panel-metrics-grid">
        <div class="metric-item"><span class="metric-label">Minimum Value</span><span class="metric-value">${v.minPrice}</span></div>
        <div class="metric-item"><span class="metric-label">Maximum Value</span><span class="metric-value">${v.maxPrice}</span></div>
      </div>
      <div class="instruction-steps">
        ${v.steps.map((st, n) => `<div class="step-box"><span class="step-num">${n + 1}</span><div class="step-info"><strong>${st.t.replace(/^\d+\.\s*/, '')}</strong></div></div>`).join('')}
      </div>
      <div class="panel-action-bar">
        <a href="#get-started" class="btn-quote-action"><span>Get Free Quote</span><i class="bi bi-arrow-right" aria-hidden="true"></i></a>
        <div class="panel-guarantees"><span><i class="bi bi-check-circle-fill" aria-hidden="true"></i> Free towing</span><span><i class="bi bi-check-circle-fill" aria-hidden="true"></i> Instant payout</span></div>
      </div>`;

      clearTimeout(swapTimer);
      if (first) {
        panelContainer.innerHTML = html;
        first = false;
        return;
      }
      panelContainer.classList.add('is-out');
      swapTimer = setTimeout(() => {
        panelContainer.innerHTML = html;
        panelContainer.classList.remove('is-out');
      }, 200);
    }

    chipNodes.forEach((node, i) => {
      node.addEventListener('mouseenter', () => hold = true);
      node.addEventListener('mouseleave', () => hold = false);
      node.addEventListener('click', () => {
        if (moved > 5) return;
        renderVehicleDetail(i);
      });
      node.addEventListener('keydown', e => {
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          renderVehicleDetail(i);
        }
      });
    });
    tabsContainer.addEventListener('click', e => {
      const btn = e.target.closest('.v-tab-btn');
      if (btn) renderVehicleDetail(parseInt(btn.dataset.index, 10));
    });
    tabsContainer.addEventListener('keydown', e => {
      const act = tabsContainer.querySelector('.v-tab-btn[aria-selected="true"]');
      if (!act) return;
      const cur = parseInt(act.dataset.index, 10),
        n = VEHICLES.length;
      let nx = null;
      if (e.key === 'ArrowRight' || e.key === 'ArrowDown') nx = (cur + 1) % n;
      else if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') nx = (cur - 1 + n) % n;
      if (nx === null) return;
      e.preventDefault();
      renderVehicleDetail(nx);
      tabsContainer.querySelectorAll('.v-tab-btn')[nx].focus();
    });

    renderVehicleDetail(0);
  })();
</script>