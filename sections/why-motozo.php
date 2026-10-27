<!-- ==========================================================================
     WHY MOTOZO: 3D INTERACTIVE COMPARISON (Self-Contained: HTML + CSS + JS)
     ========================================================================== -->
<section class="section spotlight-section" id="why-motozo">
  <span id="impact" class="d-none"></span>

  <!-- Background Ambient Atmospheric Lighting -->
  <div class="ambient-orb ambient-orb-1"></div>
  <div class="ambient-orb ambient-orb-2"></div>

  <!-- Hidden Reusable Master 3D SVGs & Filters -->
  <svg width="0" height="0" style="position:absolute;pointer-events:none" aria-hidden="true">
    <defs>
      <!-- 3D Lighting & Shadows -->
      <filter id="f-glow-gold" x="-50%" y="-50%" width="200%" height="200%">
        <feGaussianBlur stdDeviation="6" result="blur" />
        <feColorMatrix type="matrix" values="1 0 0 0 1  0 0.8 0 0 0.8  0 0 0.2 0 0  0 0 0 1.6 0" />
        <feMerge>
          <feMergeNode />
          <feMergeNode in="SourceGraphic" />
        </feMerge>
      </filter>

      <filter id="f-glow-green" x="-50%" y="-50%" width="200%" height="200%">
        <feGaussianBlur stdDeviation="6" result="blur" />
        <feMerge>
          <feMergeNode in="blur" />
          <feMergeNode in="SourceGraphic" />
        </feMerge>
      </filter>

      <filter id="f-glow-red" x="-50%" y="-50%" width="200%" height="200%">
        <feGaussianBlur stdDeviation="6" result="blur" />
        <feMerge>
          <feMergeNode in="blur" />
          <feMergeNode in="SourceGraphic" />
        </feMerge>
      </filter>

      <filter id="f-3d-shadow" x="-30%" y="-20%" width="160%" height="150%">
        <feDropShadow dx="0" dy="12" stdDeviation="8" flood-color="#000" flood-opacity="0.6" />
      </filter>

      <!-- 3D Shaders & Materials -->
      <radialGradient id="skin" cx=".35" cy=".3" r=".8">
        <stop offset="0" stop-color="#fed5b5" />
        <stop offset=".6" stop-color="#e29b6f" />
        <stop offset="1" stop-color="#ab623e" />
      </radialGradient>

      <linearGradient id="shine" x1="0" x2="1">
        <stop offset="0" stop-color="#fff" stop-opacity=".35" />
        <stop offset=".4" stop-color="#fff" stop-opacity="0" />
        <stop offset="1" stop-color="#000" stop-opacity=".4" />
      </linearGradient>

      <linearGradient id="carshine" x1="0" y1="0" x2="0" y2="1">
        <stop offset="0" stop-color="#ffffff" stop-opacity=".4" />
        <stop offset=".4" stop-color="#ffffff" stop-opacity=".05" />
        <stop offset="1" stop-color="#000000" stop-opacity=".55" />
      </linearGradient>

      <linearGradient id="fshade" x1="0" y1="0" x2="0" y2="1">
        <stop offset="0" stop-color="#000" stop-opacity=".5" />
        <stop offset="1" stop-color="#fff" stop-opacity=".1" />
      </linearGradient>

      <radialGradient id="pad" cx=".5" cy=".5" r=".5">
        <stop offset="0" stop-color="#5dffa5" />
        <stop offset="60%" stop-color="#2fbf71" stop-opacity=".5" />
        <stop offset="100%" stop-color="#0e6e3e" stop-opacity="0" />
      </radialGradient>

      <radialGradient id="coin" cx=".32" cy=".28" r=".75">
        <stop offset="0" stop-color="#fff9cf" />
        <stop offset=".35" stop-color="#ffd23f" />
        <stop offset=".7" stop-color="#e09400" />
        <stop offset="1" stop-color="#804b00" />
      </radialGradient>

      <linearGradient id="gold-rim" x1="0" y1="0" x2="1" y2="1">
        <stop offset="0" stop-color="#fffde0" />
        <stop offset=".5" stop-color="#ffd23f" />
        <stop offset="1" stop-color="#a66e0a" />
      </linearGradient>

      <!-- Vector Icons -->
      <symbol id="i-check" viewBox="0 0 24 24">
        <path d="M4 12.5l5 5L20 6.5" />
      </symbol>
      <symbol id="i-x" viewBox="0 0 24 24">
        <path d="M6 6l12 12M18 6L6 18" />
      </symbol>
      <symbol id="i-truck" viewBox="0 0 24 24">
        <path d="M2 6h12v10H2zM14 10h4l4 3v3h-8z" />
        <circle cx="7" cy="18" r="2" />
        <circle cx="17" cy="18" r="2" />
      </symbol>
      <symbol id="i-rupee" viewBox="0 0 24 24">
        <path d="M7 5h10M7 9h10M7 5c6 0 6 8 0 8l7 7" />
      </symbol>
      <symbol id="i-cert" viewBox="0 0 24 24">
        <path d="M5 3h14v12H5zM8 7h8M8 10h5" />
        <circle cx="15" cy="18" r="3" />
        <path d="M13.5 20.5L13 24l2-1 2 1-.5-3.5" />
      </symbol>
      <symbol id="i-phone" viewBox="0 0 24 24">
        <rect x="7" y="2" width="10" height="20" rx="2" />
        <path d="M11 18h2" />
      </symbol>

      <!-- High-Detail 3D Car -->
      <symbol id="car" viewBox="0 0 100 50">
        <ellipse cx="50" cy="46" rx="46" ry="4" fill="#000" opacity=".6" />
        <path d="M5 38l4-14q2-4 8-4h12l10-12q2-2 6-2h24q4 0 6 3l8 11 10 4q5 2 5 8v6z" fill="var(--car,#b33927)" />
        <path d="M5 38l4-14q2-4 8-4h12l10-12q2-2 6-2h24q4 0 6 3l8 11 10 4q5 2 5 8v6z" fill="url(#carshine)" />
        <path d="M34 20l8-9h22l8 9z" fill="#b9e1f5" opacity=".85" />
        <rect x="91" y="27" width="4" height="6" rx="1.5" fill="#ffe066" filter="drop-shadow(0 0 4px #ffc107)" />
        <rect x="5" y="28" width="3" height="5" rx="1" fill="#ff4d4f" />
        <g>
          <circle cx="26" cy="38" r="9.5" fill="#151718" />
          <circle cx="26" cy="38" r="5" fill="#4f565b" />
          <circle cx="26" cy="38" r="2.2" fill="#d9e0e5" />
          <circle cx="76" cy="38" r="9.5" fill="#151718" />
          <circle cx="76" cy="38" r="5" fill="#4f565b" />
          <circle cx="76" cy="38" r="2.2" fill="#d9e0e5" />
        </g>
      </symbol>

      <symbol id="potli" viewBox="0 0 30 34">
        <path d="M10 9C0 16 0 33 15 33C30 33 30 16 20 9Z" fill="#f0b429" stroke="#8a5a00" stroke-width="1" />
        <path d="M9 8Q15 12 21 8L19 3Q15 5 11 3Z" fill="#d99a1b" stroke="#8a5a00" stroke-width="1" />
        <rect x="9" y="7" width="12" height="3" rx="1.5" fill="#8a5a00" />
        <text x="15" y="27" text-anchor="middle" font-size="13" font-weight="900" fill="#7a4a00" font-family="var(--font-body), Arial, sans-serif">₹</text>
      </symbol>
      <!-- 3D Currency Note -->
      <symbol id="note" viewBox="0 0 32 18">
        <rect x=".5" y=".5" width="31" height="17" rx="3" fill="#6be399" stroke="#166e3b" stroke-width="1.2" />
        <rect x="2" y="2" width="28" height="14" rx="2" fill="none" stroke="#2a9e59" stroke-dasharray="2 2" stroke-width=".8" />
        <circle cx="16" cy="9" r="5.5" fill="#1b8849" />
        <text x="16" y="12.5" text-anchor="middle" font-size="8.5" font-weight="900" fill="#ffffff" font-family="var(--font-body), Arial, sans-serif">₹</text>
      </symbol>
    </defs>
  </svg>

  <div class="wrap">
    <!-- Section Header Banner -->
    <div class="section-header reveal">
      <div class="section-tag">
        <span class="section-tag-dot"></span>
        <span>Why Motozo</span>
      </div>
      <h2 class="section-title">The Old Way vs The Smart Motozo Way</h2>
      <p class="section-subtitle">
        Compare traditional roadside vehicle scrapping with Motozo's transparent, government-authorized direct process.
      </p>
    </div>

    <!-- Interactive 3D Perspective Comparison Section -->
    <div class="vs-container reveal">
      <div class="vs">

        <!-- ================= LEFT: THE TRADITIONAL WAY ================= -->
        <div class="card-wrap" data-card="old">
          <article class="card old">
            <div class="card-corner card-corner-tl"></div>
            <div class="card-corner card-corner-tr"></div>
            <div class="card-corner card-corner-bl"></div>
            <div class="card-corner card-corner-br"></div>
            <div class="card-glare"></div>

            <div class="layer-3d-text">
              <span class="pill">THE TRADITIONAL WAY</span>
              <h3>Many hands. <em>Many cuts.</em></h3>
              <p>Your scrap vehicle passes through a chain of middlemen, and every single middleman takes a slice of your money.</p>

              <!-- Interactive Stage Steps -->
              <div class="step-tracker">
                <div class="step-item" id="old-st-0"><span class="step-dot"></span> You</div>
                <span class="step-arrow">➔</span>
                <div class="step-item" id="old-st-1"><span class="step-dot"></span> Kabadiwala</div>
                <span class="step-arrow">➔</span>
                <div class="step-item" id="old-st-2"><span class="step-dot"></span> Local Dealer</div>
                <span class="step-arrow">➔</span>
                <div class="step-item" id="old-st-3"><span class="step-dot"></span> Aggregator</div>
                <span class="step-arrow">➔</span>
                <div class="step-item" id="old-st-4"><span class="step-dot"></span> Scrap Yard</div>
              </div>
            </div>

            <!-- 3D Vector Stage -->
            <div class="layer-3d-stage">
              <svg id="s" class="stage" viewBox="0 0 1000 560" role="img" aria-label="Traditional scrap chain">
                <defs>
                  <radialGradient id="oldRoomGrad" cx="50%" cy="25%" r="75%">
                    <stop offset="0%" stop-color="#381916" stop-opacity="0.9" />
                    <stop offset="55%" stop-color="#240f0e" stop-opacity="0.96" />
                    <stop offset="100%" stop-color="#140605" />
                  </radialGradient>
                  <radialGradient id="oldSpotlight" cx="50%" cy="25%" r="60%">
                    <stop offset="0%" stop-color="#ff5742" stop-opacity="0.22" />
                    <stop offset="45%" stop-color="#ff3b26" stop-opacity="0.07" />
                    <stop offset="100%" stop-color="#000000" stop-opacity="0" />
                  </radialGradient>
                  <linearGradient id="oldFloorGrad" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stop-color="#55241e" />
                    <stop offset="35%" stop-color="#3c1714" />
                    <stop offset="75%" stop-color="#2a0f0d" />
                    <stop offset="100%" stop-color="#1b0807" />
                  </linearGradient>
                  <radialGradient id="oldDeckLight" cx="50%" cy="50%" r="50%">
                    <stop offset="0%" stop-color="#ff6048" stop-opacity="0.35" />
                    <stop offset="60%" stop-color="#ff4028" stop-opacity="0.12" />
                    <stop offset="100%" stop-color="#ff3018" stop-opacity="0" />
                  </radialGradient>
                  <linearGradient id="oldSlabGrad" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stop-color="#5c1e18" />
                    <stop offset="100%" stop-color="#1c0706" />
                  </linearGradient>
                </defs>

                <rect x="0" y="0" width="1000" height="560" rx="18" fill="url(#oldRoomGrad)" />
                <ellipse cx="500" cy="220" rx="460" ry="240" fill="url(#oldSpotlight)" />
                <polygon points="120,360 880,360 990,530 10,530" fill="url(#oldFloorGrad)" stroke="#ff5035" stroke-width="2.2" stroke-opacity="0.85" />
                <ellipse cx="500" cy="450" rx="380" ry="70" fill="url(#oldDeckLight)" />

                <g stroke="rgba(255, 115, 95, 0.42)" stroke-width="1.4" fill="none">
                  <path id="grid" />
                </g>

                <polygon points="10,530 990,530 1000,554 0,554" fill="url(#oldSlabGrad)" stroke="#ff4838" stroke-width="1.4" stroke-opacity="0.6" />
                <line x1="0" y1="530" x2="1000" y2="530" stroke="#ff5a43" stroke-width="2.8" filter="url(#f-glow-red)" />
                <line x1="0" y1="554" x2="1000" y2="554" stroke="#ff3820" stroke-width="1.5" stroke-opacity="0.7" />

                <g filter="url(#f-glow-red)">
                  <circle cx="120" cy="360" r="5" fill="#ff7a65" />
                  <circle cx="120" cy="360" r="2.2" fill="#fff" />
                  <path d="M142 360H120L111 376" stroke="#ff8c77" stroke-width="2.5" fill="none" stroke-linecap="round" />
                </g>
                <g filter="url(#f-glow-red)">
                  <circle cx="880" cy="360" r="5" fill="#ff7a65" />
                  <circle cx="880" cy="360" r="2.2" fill="#fff" />
                  <path d="M858 360H880L889 376" stroke="#ff8c77" stroke-width="2.5" fill="none" stroke-linecap="round" />
                </g>
                <g filter="url(#f-glow-red)">
                  <circle cx="990" cy="530" r="5.5" fill="#ff5a43" />
                  <circle cx="990" cy="530" r="2.5" fill="#fff" />
                  <path d="M965 530H990L981 515" stroke="#ff705b" stroke-width="2.5" fill="none" stroke-linecap="round" />
                </g>
                <g filter="url(#f-glow-red)">
                  <circle cx="10" cy="530" r="5.5" fill="#ff5a43" />
                  <circle cx="10" cy="530" r="2.5" fill="#fff" />
                  <path d="M35 530H10L19 515" stroke="#ff705b" stroke-width="2.5" fill="none" stroke-linecap="round" />
                </g>

                <line class="track" x1="40" y1="460" x2="960" y2="460" />

                <g id="people"></g>
                <g id="labels"></g>
                <g id="badges"></g>
                <g id="coinsG"></g>

                <line id="trail" stroke="#ffd23f" stroke-width="2.5" stroke-dasharray="3 5" opacity="0" />
                <g id="coinG" filter="url(#f-glow-gold)">
                  <circle r="20" fill="url(#coin)" stroke="url(#gold-rim)" stroke-width="2" />
                  <circle r="15" fill="none" stroke="#fff9a6" stroke-width="1.2" stroke-dasharray="3 2" />
                  <text y="7" text-anchor="middle" font-size="18" font-weight="900" fill="#543000" font-family="var(--font-body), Arial, sans-serif">₹</text>
                </g>
              </svg>
            </div>

            <div class="chips layer-3d-chips">
              <div class="chip">
                <svg>
                  <use href="#i-x" />
                </svg>
                <span>Cash in hand</span>
              </div>
              <div class="chip">
                <svg>
                  <use href="#i-x" />
                </svg>
                <span>No paperwork</span>
              </div>
              <div class="chip">
                <svg>
                  <use href="#i-x" />
                </svg>
                <span>Underpaid rate</span>
              </div>
            </div>
          </article>
        </div>

        <!-- ================= CENTER 3D VS EMBLEM BADGE ================= -->
        <div class="badge-3d-wrap" title="Old Way vs Smart Motozo Way">
          <div class="badge-3d">
            <div class="badge-ring"></div>
            <span>VS</span>
          </div>
        </div>

        <!-- ================= RIGHT: THE MOTOZO WAY ================= -->
        <div class="card-wrap" data-card="new">
          <article class="card new">
            <div class="card-corner card-corner-tl"></div>
            <div class="card-corner card-corner-tr"></div>
            <div class="card-corner card-corner-bl"></div>
            <div class="card-corner card-corner-br"></div>
            <div class="card-glare"></div>
            <div class="smart-choice-tag">★ Verified Direct</div>
            <span class="hand">Same car,<br>more value</span>

            <div class="layer-3d-text">
              <span class="pill">The Motozo way</span>
              <h3>Quote, pickup, payment. <em>All handled.</em></h3>
              <p>Motozo sends a free tow truck, your car is processed at an authorized RVSF, and the full payment comes directly to you.</p>

              <!-- Interactive Stage Steps -->
              <div class="step-tracker">
                <div class="step-item" id="new-st-0"><span class="step-dot"></span> Online Quote</div>
                <span class="step-arrow">➔</span>
                <div class="step-item" id="new-st-1"><span class="step-dot"></span> Tow Truck</div>
                <span class="step-arrow">➔</span>
                <div class="step-item" id="new-st-2"><span class="step-dot"></span> RVSF Plant</div>
                <span class="step-arrow">➔</span>
                <div class="step-item" id="new-st-3"><span class="step-dot"></span> 100% Direct Pay</div>
              </div>
            </div>

            <!-- 3D Vector Stage -->
            <div class="layer-3d-stage">
              <svg id="stage-motozo" class="stage" viewBox="0 -8 640 358" role="img" aria-label="Motozo way">
                <defs>
                  <radialGradient id="newRoomGrad" cx="50%" cy="25%" r="75%">
                    <stop offset="0%" stop-color="#14462d" stop-opacity="0.88" />
                    <stop offset="55%" stop-color="#0a2a1a" stop-opacity="0.96" />
                    <stop offset="100%" stop-color="#04160d" />
                  </radialGradient>
                  <radialGradient id="newSpotlight" cx="50%" cy="25%" r="60%">
                    <stop offset="0%" stop-color="#2fbf71" stop-opacity="0.25" />
                    <stop offset="45%" stop-color="#2fbf71" stop-opacity="0.08" />
                    <stop offset="100%" stop-color="#000000" stop-opacity="0" />
                  </radialGradient>
                  <linearGradient id="newFloorGrad" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stop-color="#1e6e44" />
                    <stop offset="35%" stop-color="#124e30" />
                    <stop offset="75%" stop-color="#0b3620" />
                    <stop offset="100%" stop-color="#062214" />
                  </linearGradient>
                  <radialGradient id="newDeckLight" cx="50%" cy="50%" r="50%">
                    <stop offset="0%" stop-color="#5dffa5" stop-opacity="0.32" />
                    <stop offset="60%" stop-color="#2fbf71" stop-opacity="0.12" />
                    <stop offset="100%" stop-color="#0e6e3e" stop-opacity="0" />
                  </radialGradient>
                  <linearGradient id="newSlabGrad" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stop-color="#1b7a49" />
                    <stop offset="100%" stop-color="#072b18" />
                  </linearGradient>

                  <pattern id="mzWin" x="266" y="170" width="11.5" height="11.7" patternUnits="userSpaceOnUse">
                    <rect x="2" y="2.5" width="7.5" height="6" rx="1" fill="#c8f5de" opacity=".9" />
                  </pattern>
                  <pattern id="mzWinS" x="0" y="0" width="11" height="11.7" patternUnits="userSpaceOnUse">
                    <rect x="2" y="2.5" width="7" height="6" rx="1" fill="#8fd9b4" opacity=".6" />
                  </pattern>
                  <linearGradient id="mzGlass" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stop-color="#4dbf91" />
                    <stop offset="1" stop-color="#175940" />
                  </linearGradient>

                  <linearGradient id="rvWall" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stop-color="#3fa175" />
                    <stop offset="1" stop-color="#1d5642" />
                  </linearGradient>
                  <pattern id="rvSlat" x="466" y="208" width="9" height="12" patternUnits="userSpaceOnUse">
                    <rect x="2" y="1" width="4" height="9" rx="1" fill="#c8f5de" opacity=".9" />
                  </pattern>
                  <linearGradient id="pickupBoxGrad" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stop-color="#ffffff" />
                    <stop offset="100%" stop-color="#eafaf1" />
                  </linearGradient>
                </defs>

                <rect x="0" y="-8" width="640" height="358" rx="18" fill="url(#newRoomGrad)" />
                <ellipse cx="320" cy="110" rx="300" ry="160" fill="url(#newSpotlight)" />

                <polygon points="80,190 560,190 632,322 8,322" fill="url(#newFloorGrad)" stroke="#2fbf71" stroke-width="2" stroke-opacity="0.85" />
                <ellipse cx="320" cy="265" rx="260" ry="50" fill="url(#newDeckLight)" />

                <g stroke="rgba(125,255,185,.38)" stroke-width="1.2" fill="none">
                  <path d="M80 190L8 322M140 190L86 322M200 190L164 322M260 190L242 322M320 190L320 322M380 190L398 322M440 190L476 322M500 190L554 322M560 190L632 322" />
                  <path d="M73 203H567M64 219H576M53 240H587M37 268H603M18 304H622" />
                </g>

                <polygon points="8,322 632,322 632,338 8,338" fill="url(#newSlabGrad)" stroke="#2fbf71" stroke-width="1.2" stroke-opacity="0.6" />
                <line x1="8" y1="322" x2="632" y2="322" stroke="#4ade80" stroke-width="2.4" filter="url(#f-glow-green)" />
                <line x1="8" y1="338" x2="632" y2="338" stroke="#166534" stroke-width="1.2" />

                <g filter="url(#f-glow-green)">
                  <circle cx="80" cy="190" r="4.5" fill="#7df0ad" />
                  <circle cx="80" cy="190" r="2" fill="#fff" />
                  <path d="M96 190H80L73 203" stroke="#9ff5c8" stroke-width="2.2" fill="none" stroke-linecap="round" />
                </g>
                <g filter="url(#f-glow-green)">
                  <circle cx="560" cy="190" r="4.5" fill="#7df0ad" />
                  <circle cx="560" cy="190" r="2" fill="#fff" />
                  <path d="M544 190H560L567 203" stroke="#9ff5c8" stroke-width="2.2" fill="none" stroke-linecap="round" />
                </g>
                <g filter="url(#f-glow-green)">
                  <circle cx="632" cy="322" r="5" fill="#4ade80" />
                  <circle cx="632" cy="322" r="2.2" fill="#fff" />
                  <path d="M614 322H632L625 309" stroke="#7df0ad" stroke-width="2.2" fill="none" stroke-linecap="round" />
                </g>
                <g filter="url(#f-glow-green)">
                  <circle cx="8" cy="322" r="5" fill="#4ade80" />
                  <circle cx="8" cy="322" r="2.2" fill="#fff" />
                  <path d="M26 322H8L15 309" stroke="#7df0ad" stroke-width="2.2" fill="none" stroke-linecap="round" />
                </g>

                <path class="gtrack" d="M30 300H610" />

                <g fill="#d5ffe6">
                  <circle r="4.5" filter="drop-shadow(0 0 6px #7df0ad)">
                    <animateMotion dur="2.8s" repeatCount="indefinite" path="M30 300H610" />
                  </circle>
                  <circle r="4.5" filter="drop-shadow(0 0 6px #7df0ad)">
                    <animateMotion dur="2.8s" begin="1.4s" repeatCount="indefinite" path="M30 300H610" />
                  </circle>
                </g>

                <ellipse class="glow-pulse" cx="300" cy="268" rx="86" ry="24" fill="url(#pad)" />
                <ellipse class="rip" cx="300" cy="268" rx="58" ry="17" />
                <ellipse class="rip" cx="300" cy="268" rx="58" ry="17" style="animation-delay:.9s" />
                <ellipse class="rip" cx="300" cy="268" rx="58" ry="17" style="animation-delay:1.8s" />
                <ellipse cx="300" cy="272" rx="58" ry="17" fill="#042214" />
                <ellipse cx="300" cy="268" rx="58" ry="17" fill="#0b5230" stroke="#2fbf71" stroke-width="2.5" />
                <ellipse cx="300" cy="268" rx="40" ry="11" fill="none" stroke="#7df0ad" stroke-width="1.4" stroke-dasharray="5 5" opacity=".8" />

                <g transform="translate(4 0)">
                  <ellipse cx="300" cy="278" rx="58" ry="9" fill="#000" opacity=".5" />
                  <polygon points="248,252 318,252 318,276 248,276" fill="#245f45" />
                  <polygon points="318,252 344,242 344,266 318,276" fill="#133c2a" />
                  <polygon points="248,252 274,242 344,242 318,252" fill="#4aa57f" />
                  <rect x="254" y="257" width="58" height="9" rx="2" fill="#bff0d4" opacity=".6" />
                  <rect x="277" y="262" width="14" height="14" rx="1.5" fill="#0a3a24" stroke="#7df0ad" stroke-width="1.2" />

                  <rect x="266" y="170" width="46" height="82" fill="url(#mzGlass)" />
                  <rect x="266" y="170" width="46" height="82" fill="url(#mzWin)" />
                  <polygon points="312,170 334,160 334,242 312,252" fill="#134733" />
                  <rect width="22" height="82" transform="translate(312,170) skewY(-24.4)" fill="url(#mzWinS)" />
                  <polygon points="266,170 288,160 334,160 312,170" fill="#6fcfa3" />
                  <line x1="266" y1="170" x2="266" y2="252" stroke="#9ff5c8" stroke-opacity=".7" stroke-width="1.8" />

                  <rect x="282" y="163" width="16" height="7" fill="#1d5a40" />
                  <polygon points="282,163 288,160 304,160 298,163" fill="#4aa57f" />
                  <line x1="290" y1="160" x2="290" y2="150" stroke="#7df0ad" stroke-width="1.5" />
                  <circle cx="290" cy="149" r="2.5" fill="#7df0ad" filter="drop-shadow(0 0 5px #7df0ad)" />
                </g>

                <g class="hubfloat">
                  <ellipse cx="300" cy="118" rx="42" ry="12" fill="none" stroke="#7df0ad" stroke-width="1.2" stroke-dasharray="4 3" opacity=".6" />
                  <image href="assets/media/logo.webp" x="235" y="86" width="130" height="66" preserveAspectRatio="xMidYMid meet" />
                </g>

                <g>
                  <ellipse cx="516" cy="282" rx="76" ry="9" fill="#000" opacity=".5" />


                  <rect x="548" y="140" width="12" height="52" fill="#2a5d44" />
                  <rect x="546" y="136" width="16" height="6" fill="#4aa57f" />
                  <rect x="548" y="156" width="12" height="4" fill="#c9f23c" opacity=".9" />

                  <polygon points="450,256 546,256 546,276 450,276" fill="#245f45" />
                  <polygon points="546,256 572,246 572,266 546,276" fill="#133c2a" />
                  <polygon points="450,256 476,246 572,246 546,256" fill="#4aa57f" />
                  <rect x="456" y="260" width="84" height="6" rx="2" fill="#bff0d4" opacity=".6" />

                  <rect x="456" y="196" width="84" height="60" fill="url(#rvWall)" />
                  <polygon points="540,198 566,188 566,246 540,256" fill="#134733" />
                  <g transform="translate(540,206) skewY(-20.5)" fill="#c8f5de" opacity=".7">
                    <rect x="5" y="0" width="7" height="22" rx="1" />
                    <rect x="16" y="0" width="7" height="22" rx="1" />
                  </g>

                  <polygon points="448,198 472,180 570,180 546,198" fill="#153a2a" />
                  <polygon points="448,198 546,198 546,204 448,204" fill="#123d2b" />
                  <path d="M472 180L448 198M570 180L546 198" stroke="#7df0ad" stroke-opacity=".6" stroke-width="1.4" />
                  <text x="497" y="202.5" text-anchor="middle" font-family="var(--font-body), Arial, sans-serif" font-weight="900" font-size="9" fill="#ffffffff">AUTHORIZED RVSF</text>

                  <g class="glow-pulse">
                    <rect x="466" y="208" width="45" height="12" fill="url(#rvSlat)" />
                    <rect x="466" y="226" width="45" height="12" fill="url(#rvSlat)" />
                  </g>

                  <rect x="516" y="214" width="20" height="40" fill="#0a3a24" stroke="#7df0ad" stroke-width="1.2" />
                  <path d="M516 222H536M516 230H536M516 238H536M516 246H536" stroke="#2fbf71" stroke-opacity=".6" />
                </g>

                <g class="hubfloat">
                  <image href="assets/media/rvsf-ministry.webp" x="488" y="60" width="100" height="100" preserveAspectRatio="xMidYMid meet" />
                </g>

                <g id="youFig"></g>
                <g id="mzLabels"></g>

                <use href="#car" x="76" y="200" width="136" height="68" style="--car:#b33927">
                  <animate attributeName="opacity" dur="14s" repeatCount="indefinite" keyTimes="0;.34;.35;1" values="1;1;0;0" />
                </use>

                <g>
                  <animate attributeName="opacity" dur="14s" repeatCount="indefinite" keyTimes="0;.01;.12;.15;1" values="0;1;1;0;0" />
                  <path d="M88 168Q190 88 292 182" fill="none" stroke="#7df0ad" stroke-width="2.8" stroke-dasharray="6 6">
                    <animate attributeName="stroke-dashoffset" from="24" to="0" dur=".8s" repeatCount="indefinite" />
                  </path>
                  <circle r="6" fill="#fff" filter="drop-shadow(0 0 6px #7df0ad)">
                    <animateMotion dur="1.4s" repeatCount="indefinite" path="M88 168Q190 88 292 182" />
                  </circle>
                </g>

                <g>
                  <animate attributeName="opacity" dur="14s" repeatCount="indefinite" keyTimes="0;.02;.12;.15;1" values="0;1;1;0;0" />
                  <rect x="8" y="86" width="140" height="48" rx="12" fill="#ffffff" filter="drop-shadow(0 10px 20px rgba(0,0,0,.4))" />
                  <path d="M60 134h12l-6 10z" fill="#ffffff" />
                  <circle cx="32" cy="110" r="13" fill="#0e6e3e" />
                  <use class="ic2" href="#i-phone" x="25" y="103" width="14" height="14" style="color:#fff;fill:#fff;" fill="#fff" />
                  <text x="96" y="104" text-anchor="middle" font-family="var(--font-body), Arial, sans-serif" font-weight="800" font-size="11.5" fill="#0f1f1a">Online request</text>
                  <text x="96" y="119" text-anchor="middle" font-family="var(--font-body), Arial, sans-serif" font-weight="500" font-size="9.5" fill="#5b6b64">from your phone</text>
                </g>

                <g>
                  <animate attributeName="opacity" dur="14s" repeatCount="indefinite" keyTimes="0;.13;.16;.31;.34;1" values="0;0;1;1;0;0" />
                  <g filter="drop-shadow(0 10px 22px rgba(0,0,0,.45)) drop-shadow(0 2px 8px rgba(47,191,113,.25))">
                    <path d="M229 86h142a12 12 0 0 1 12 12v24a12 12 0 0 1-12 12h-65l-6 9-6-9h-65a12 12 0 0 1-12-12v-24a12 12 0 0 1 12-12z" fill="url(#pickupBoxGrad)" stroke="#2fbf71" stroke-width="1.3" stroke-linejoin="round" />
                  </g>
                  <circle cx="243" cy="110" r="13" fill="#0e6e3e" />
                  <use class="ic2" href="#i-truck" x="236" y="103" width="14" height="14" style="color:#ffffff;fill:#ffffff;" fill="#ffffff" />
                  <text x="319" y="104" text-anchor="middle" font-family="var(--font-body), Arial, sans-serif" font-weight="800" font-size="11.5" fill="#0f1f1a">Free Pickup Sent</text>
                  <text x="319" y="119" text-anchor="middle" font-family="var(--font-body), Arial, sans-serif" font-weight="600" font-size="9.5" fill="#0e6e3e">Tow truck dispatched</text>
                </g>

                <g>
                  <animateMotion dur="14s" repeatCount="indefinite" calcMode="linear" keyPoints="0;0;.277;.277;1;1" keyTimes="0;.143;.32;.37;.57;1" path="M300 292L170 292L510 292" />
                  <animate attributeName="opacity" dur="14s" repeatCount="indefinite" keyTimes="0;.14;.15;.80;.81;1" values="0;0;1;1;0;0" />
                  <g>
                    <animateTransform attributeName="transform" type="scale" dur="14s" repeatCount="indefinite" calcMode="discrete" keyTimes="0;.34;1" values="-1 1;1 1;1 1" />
                    <g transform="scale(1.7) translate(-59 0)">
                      <ellipse cx="59" cy="2" rx="58" ry="4" fill="#000" opacity=".5" />
                      <rect x="0" y="-16" width="84" height="8" rx="2" fill="#1e2823" />
                      <use href="#car" x="4" y="-54" width="80" height="40" style="--car:#b33927">
                        <animate attributeName="opacity" dur="14s" repeatCount="indefinite" keyTimes="0;.34;.35;1" values="0;0;1;1" />
                      </use>
                      <path d="M86 -8V-30H104L118 -16V-8Z" fill="#138248" />
                      <path d="M92 -27H103L111 -17H92Z" fill="#d2f5e3" />
                      <polygon points="118,-15 140,-20 140,-4 118,-10" fill="#7df0ad" opacity=".35" />
                      <circle cx="118" cy="-12" r="2.5" fill="#fff" />
                      <circle cx="16" cy="-8" r="8.5" fill="#111" />
                      <circle cx="16" cy="-8" r="3.5" fill="#777" />
                      <circle cx="70" cy="-8" r="8.5" fill="#111" />
                      <circle cx="70" cy="-8" r="3.5" fill="#777" />
                      <circle cx="104" cy="-8" r="8.5" fill="#111" />
                      <circle cx="104" cy="-8" r="3.5" fill="#777" />
                    </g>
                  </g>
                </g>

                <g transform="translate(416 200) scale(1.36)">
                  <animate attributeName="opacity" dur="14s" repeatCount="indefinite" keyTimes="0;.80;.805;.985;.995;1" values="0;0;1;1;0;0" />
                  <g>
                    <animateTransform attributeName="transform" type="translate" dur="14s" repeatCount="indefinite" keyTimes="0;.84;.88;.92;1" values="0 0;0 0;-5 -6;-9 2;-9 2" />
                    <animateTransform attributeName="transform" type="rotate" additive="sum" dur="14s" repeatCount="indefinite" keyTimes="0;.84;.88;.92;1" values="0 48 50;0 48 50;-5 48 50;-8 48 50;-8 48 50" />
                    <svg x="0" y="0" width="50" height="50" viewBox="0 0 50 50">
                      <use href="#car" width="100" height="50" style="--car:#b33927" />
                    </svg>
                  </g>
                  <g>
                    <animateTransform attributeName="transform" type="translate" dur="14s" repeatCount="indefinite" keyTimes="0;.84;.88;.92;1" values="0 0;0 0;5 -6;9 2;9 2" />
                    <animateTransform attributeName="transform" type="rotate" additive="sum" dur="14s" repeatCount="indefinite" keyTimes="0;.84;.88;.92;1" values="0 52 50;0 52 50;5 52 50;8 52 50;8 52 50" />
                    <svg x="50" y="0" width="50" height="50" viewBox="50 0 50 50">
                      <use href="#car" x="0" width="100" height="50" style="--car:#b33927" />
                    </svg>
                  </g>
                  <g>
                    <animate attributeName="opacity" dur="14s" repeatCount="indefinite" keyTimes="0;.84;.86;1" values="0;0;1;1" />
                    <path d="M50 -6L50 54" stroke="#7df0ad" stroke-width="3" stroke-dasharray="6 4" stroke-linecap="round" />
                    <circle cx="50" cy="24" r="6" fill="#fff" filter="drop-shadow(0 0 8px #7df0ad)" />
                  </g>
                </g>

                <g>
                  <animate attributeName="opacity" dur="14s" repeatCount="indefinite" keyTimes="0;.76;.79;.87;.89;1" values="0;0;1;1;0;0" />
                  <rect x="8" y="86" width="140" height="48" rx="12" fill="#7df0ad" filter="drop-shadow(0 10px 25px rgba(47,191,113,.6))" />
                  <path d="M60 134h12l-6 10z" fill="#7df0ad" />
                  <circle cx="32" cy="110" r="13" fill="#05331c" />
                  <use class="ic2" href="#i-rupee" x="25" y="103" width="14" height="14" style="color:#fff;fill:#fff;" fill="#fff" />
                  <text x="96" y="104" text-anchor="middle" font-family="var(--font-body), Arial, sans-serif" font-weight="800" font-size="12" fill="#05331c">Paid in full</text>
                  <text x="96" y="119" text-anchor="middle" font-family="var(--font-body), Arial, sans-serif" font-weight="600" font-size="10" fill="#0a4d2c">in your hand</text>
                </g>
                <use href="#potli" x="82" y="284" width="26" height="30">
                  <animate attributeName="opacity" dur="14s" repeatCount="indefinite" keyTimes="0;.60;.64;.95;.98;1" values="0;0;1;1;0;0" />
                </use>
                <use href="#potli" x="106" y="288" width="24" height="28">
                  <animate attributeName="opacity" dur="14s" repeatCount="indefinite" keyTimes="0;.66;.70;.95;.98;1" values="0;0;1;1;0;0" />
                </use>
                <use href="#potli" x="94" y="266" width="24" height="28">
                  <animate attributeName="opacity" dur="14s" repeatCount="indefinite" keyTimes="0;.72;.76;.95;.98;1" values="0;0;1;1;0;0" />
                </use>

                <g id="payFlow"></g>
              </svg>
            </div>

            <div class="chips layer-3d-chips motozo-connected-perks">
              <div class="chip perk-step perk-step-1">
                <svg>
                  <use href="#i-truck" />
                </svg>
                <span>Free doorstep pickup</span>
              </div>
              <span class="perk-arrow"></span>
              <div class="chip perk-step perk-step-2">
                <svg>
                  <use href="#i-rupee" />
                </svg>
                <span>100% instant payment</span>
              </div>
              <span class="perk-arrow"></span>
              <div class="chip perk-step perk-step-3">
                <svg>
                  <use href="#i-cert" />
                </svg>
                <span>Scrap Certificate</span>
              </div>
            </div>
          </article>
        </div>

      </div>
    </div>

    <!-- Bottom Explanatory Trust Cards -->
    <div class="note-wrap reveal">

      <!-- Illegal & Risky Card -->
      <div class="note-card note-card--risk">
        <div class="note-icon note-icon--risk">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
            <path d="M12 8v5" />
            <path d="M12 16h.01" />
          </svg>
        </div>

        <div class="note-body">
          <div class="note-header-row">
            <span class="note-label fw-bold">THE RISKY WAY</span>
            <span class="note-status note-status--risk">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <circle cx="12" cy="12" r="9" />
                <path d="M12 8v4" />
                <path d="M12 16h.01" />
              </svg>
              Potential Risks
            </span>
          </div>
          <strong class="note-title">Illegal &amp; Unauthorised Scrapping</strong>
          <p class="note-desc">
            Unauthorised scrap dealers may bypass approved RVSF procedures, potentially exposing vehicle owners to incomplete documentation, unexpected deductions and possible legal complications.
          </p>
        </div>
      </div>

      <!-- Legal & Safe Card -->
      <div class="note-card note-card--safe">
        <div class="note-icon note-icon--safe">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
            <path d="m9 12 2 2 4-4" />
          </svg>
        </div>

        <div class="note-body">
          <div class="note-header-row">
            <span class="note-label fw-bold">THE SAFE WAY</span>
            <span class="note-status note-status--safe" aria-label="Authorised process">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="m5 12 4 4L19 6" />
              </svg>
              Authorised Process
            </span>
          </div>
          <strong class="note-title">Legal &amp; Authorised Vehicle Scrapping</strong>
          <p class="note-desc">
            Motozo facilitates vehicle scrapping through authorised Registered Vehicle Scrapping Facilities (RVSFs), helping you avoid unauthorised disposal and reduce potential legal and documentation risks.
          </p>
        </div>
      </div>

    </div>

  </div>
</section>

<style>
  .spotlight-section {
    position: relative;
    overflow: hidden;
    isolation: isolate;
  }

  .spotlight-section::after {
    content: "";
    position: absolute;
    inset: 0;
    pointer-events: none;

    background: radial-gradient(350px circle at var(--mouse-x, -999px) var(--mouse-y, -999px),
        rgba(255, 255, 255, 0.18),
        transparent 65%);

    opacity: 0;
    transition: opacity 0.25s ease;
    z-index: 2;
  }

  .spotlight-section:hover::after {
    opacity: 1;
  }

  .spotlight-section>* {
    position: relative;
    z-index: 3;
  }

  /* ===== WHY MOTOZO: 3D Interactive Experience Styles ===== */
  #why-motozo {
    --bg-mesh: #0E6E3E;
    --text-light: #f2f7f4;
    --text-muted: #8b9d94;
    --green-glow: #2fbf71;
    --green-bright: #7df0ad;
    --green-deep: #063820;
    --red-glow: #ff4838;
    --red-amber: #ff9345;
    --red-deep: #40120d;
    --gold: #ffd23f;
    --gold-glow: #ffae19;
    --card-radius: 28px;
    font-family: var(--font-body);
    background: var(--bg-mesh);
    color: var(--text-light);
    position: relative;
    overflow: hidden;
    padding: 42px 0 95px;
    scroll-margin-top: calc(var(--hdr-height, 80px) + 12px) !important;
  }

  #why-motozo .ambient-orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(120px);
    pointer-events: none;
    z-index: 0;
    opacity: 0.55;
    animation: orbFloat 18s ease-in-out infinite alternate;
  }

  #why-motozo .ambient-orb-1 {
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(255, 72, 56, 0.42), transparent 70%);
    top: -100px;
    left: -120px;
  }

  #why-motozo .ambient-orb-2 {
    width: 700px;
    height: 700px;
    background: radial-gradient(circle, rgba(47, 191, 113, 0.48), transparent 70%);
    top: 15%;
    right: -150px;
    animation-duration: 22s;
  }

  #why-motozo .wrap {
    max-width: 1600px;
    width: 100%;
    box-sizing: border-box;
    margin: 0 auto;
    padding: 0 24px;
    position: relative;
    z-index: 3;
  }

  @keyframes orbFloat {
    0% {
      transform: translate(0, 0) scale(1);
    }

    50% {
      transform: translate(60px, 80px) scale(1.15);
    }

    100% {
      transform: translate(-40px, 40px) scale(0.95);
    }
  }

  /* Touch devices: glow effects band */
  @media (hover: none) {

    .spotlight-section::after,
    #why-motozo .card-glare {
      display: none !important;
    }
  }

  #why-motozo .section-header {
    text-align: center;
    margin-bottom: 44px;
  }

  #why-motozo .section-tag {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.14);
    padding: 8px 20px;
    border-radius: 100px;
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #b5c7bd;
    backdrop-filter: blur(12px);
    box-shadow: 0 10px 25px -10px rgba(0, 0, 0, 0.5);
    margin-bottom: 14px;
  }

  #why-motozo .section-tag-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--green-glow);
    box-shadow: 0 0 10px var(--green-glow);
    animation: pulseDot 2s infinite;
  }

  #why-motozo .section-tag span {
    color: #fff !important;
  }

  @keyframes pulseDot {

    0%,
    100% {
      opacity: 1;
      transform: scale(1);
    }

    50% {
      opacity: 0.4;
      transform: scale(0.8);
    }
  }

  #why-motozo .section-title {
    font-family: var(--font-heading, var(--font-serif));
    font-size: var(--heading-size);
    font-weight: var(--heading-weight);
    letter-spacing: var(--heading-letter-spacing);
    line-height: var(--heading-line-height);
    color: var(--heading-color);
    margin-bottom: 12px;
  }

  #why-motozo .section-subtitle {
    font-family: var(--font-body);
    font-size: clamp(0.92rem, 1.1vw, 1.04rem);
    color: var(--muted, #899097);
    max-width: 660px;
    margin: 0 auto;
    line-height: 1.6;
  }

  #why-motozo .vs-container {
    perspective: 2200px;
    position: relative;
  }

  #why-motozo .vs {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 32px;
    position: relative;
    align-items: stretch;
    transform-style: preserve-3d;
  }

  #why-motozo .card-wrap {
    position: relative;
    transform-style: preserve-3d;
    perspective: 1200px;
    transition: transform 0.25s ease-out;
    will-change: transform;
  }

  #why-motozo .card {
    border-radius: var(--card-radius);
    padding: clamp(24px, 2.5vw, 36px) clamp(20px, 2.4vw, 32px) clamp(22px, 2.2vw, 28px);
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transform-style: preserve-3d;
    transition: box-shadow 0.4s ease, border-color 0.4s ease;
    backdrop-filter: blur(24px);
    -webkit-backdrop-filter: blur(24px);
    height: 100%;
  }

  #why-motozo .card-glare {
    position: absolute;
    inset: 0;
    pointer-events: none;
    background: radial-gradient(circle 380px at var(--mouse-x, 50%) var(--mouse-y, 50%), rgba(255, 255, 255, 0.14), transparent 80%);
    opacity: 0;
    transition: opacity 0.35s ease;
    mix-blend-mode: overlay;
    z-index: 10;
    border-radius: inherit;
  }

  #why-motozo .card-wrap:hover .card-glare {
    opacity: 1;
  }

  #why-motozo .card.old {
    background:
      radial-gradient(circle at 50% 0%, rgba(145, 42, 32, 0.42) 0%, transparent 60%),
      radial-gradient(circle at 50% 55%, rgba(65, 22, 20, 0.55) 0%, transparent 70%),
      linear-gradient(170deg, #1f1313 0%, #160d0e 50%, #10090a 100%);
    border: 1.5px solid rgba(255, 85, 70, 0.55);
    box-shadow:
      0 30px 80px -20px rgba(0, 0, 0, 0.9),
      0 0 35px -5px rgba(255, 75, 55, 0.3),
      inset 0 1px 2px 0 rgba(255, 160, 140, 0.6),
      inset 0 0 40px -15px rgba(255, 60, 40, 0.2);
  }

  #why-motozo .card.old:hover {
    border-color: rgba(255, 105, 90, 0.75);
    box-shadow:
      0 40px 95px -20px rgba(0, 0, 0, 0.95),
      0 0 55px -5px rgba(255, 75, 55, 0.48),
      inset 0 1px 2px 0 rgba(255, 180, 160, 0.75),
      inset 0 0 50px -10px rgba(255, 60, 40, 0.25);
  }

  #why-motozo .card.new {
    background:
      radial-gradient(circle at 50% 0%, rgba(32, 120, 70, 0.45) 0%, transparent 60%),
      radial-gradient(circle at 50% 55%, rgba(18, 68, 42, 0.55) 0%, transparent 70%),
      linear-gradient(170deg, #102d20 0%, #092015 50%, #05150e 100%);
    border: 1.5px solid rgba(47, 215, 125, 0.65);
    box-shadow:
      0 30px 80px -20px rgba(0, 0, 0, 0.9),
      0 0 45px -5px rgba(47, 215, 125, 0.38),
      inset 0 1px 2px 0 rgba(160, 255, 200, 0.6),
      inset 0 0 40px -15px rgba(47, 191, 113, 0.22);
  }

  #why-motozo .card.new:hover {
    border-color: rgba(47, 240, 145, 0.9);
    box-shadow:
      0 45px 105px -18px rgba(0, 0, 0, 0.95),
      0 0 65px -5px rgba(47, 215, 125, 0.58),
      inset 0 1px 3px 0 rgba(190, 255, 220, 0.85),
      inset 0 0 50px -10px rgba(47, 191, 113, 0.3);
  }

  #why-motozo .layer-3d-text {
    position: relative;
    z-index: 10;
    transform: none;
  }

  #why-motozo .pill {
    display: inline-flex;
    align-items: center;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    padding: 6px 14px;
    border-radius: 999px;
    margin-bottom: 14px;
  }

  #why-motozo .card.old .pill {
    background: rgba(220, 38, 38, 0.22);
    border: 1px solid rgba(255, 72, 56, 0.45);
    color: #ff8c7a;
  }

  #why-motozo .card.new .pill {
    background: rgba(47, 191, 113, 0.2);
    border: 1px solid rgba(47, 191, 113, 0.5);
    color: #7df0ad;
  }

  #why-motozo h3 {
    font-size: clamp(22px, 2.2vw, 28px);
    font-weight: 800;
    color: #fff;
    margin: 0 0 8px;
    line-height: 1.25;
  }

  #why-motozo .card.old h3 em {
    color: #ff6b55;
    font-style: normal;
  }

  #why-motozo .card.new h3 em {
    color: #4ade80;
    font-style: normal;
  }

  #why-motozo .card p {
    color: #a0b3a7;
    font-size: 14.5px;
    line-height: 1.55;
    margin: 0 0 16px;
  }

  #why-motozo .step-tracker {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 4px;
    background: rgba(0, 0, 0, 0.5);
    padding: 7px 8px;
    border-radius: 12px;
    margin-bottom: 12px;
    border: 1px solid rgba(255, 255, 255, 0.08);
    width: 100%;
    box-sizing: border-box;
  }

  #why-motozo .step-item {
    flex: 1 1 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 4px;
    padding: 6px 3px;
    border-radius: 7px;
    font-size: 11px;
    font-weight: 700;
    text-align: center;
    white-space: nowrap;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.09);
    color: #8da195;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.25);
    transition: all 0.25s ease;
  }

  #why-motozo .step-item .step-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #475a50;
    flex-shrink: 0;
    transition: all 0.25s ease;
  }

  #why-motozo .card.old .step-item.active {
    background: linear-gradient(135deg, rgba(255, 72, 56, 0.3), rgba(180, 40, 30, 0.22));
    border-color: rgba(255, 85, 70, 0.8);
    color: #ffffff;
    box-shadow: 0 0 12px rgba(255, 72, 56, 0.5), inset 0 0 6px rgba(255, 120, 100, 0.28);
  }

  #why-motozo .card.old .step-item.active .step-dot {
    background: #ff4838;
    box-shadow: 0 0 8px #ff4838;
    transform: scale(1.3);
  }

  #why-motozo .card.new .step-item.active {
    background: linear-gradient(135deg, rgba(47, 191, 113, 0.32), rgba(14, 110, 62, 0.25));
    border-color: rgba(47, 215, 125, 0.85);
    color: #ffffff;
    box-shadow: 0 0 12px rgba(47, 191, 113, 0.55), inset 0 0 6px rgba(125, 240, 173, 0.35);
  }

  #why-motozo .card.new .step-item.active .step-dot {
    background: #2fbf71;
    box-shadow: 0 0 8px #2fbf71;
    transform: scale(1.3);
  }

  #why-motozo .step-arrow {
    color: rgba(255, 255, 255, 0.35);
    font-size: 9px;
    flex-shrink: 0;
    padding: 0 1px;
  }

  #why-motozo .layer-3d-stage {
    position: relative;
    z-index: 5;
    transform: translateZ(40px);
    margin: 4px 0 12px;
  }

  #why-motozo svg.stage {
    display: block;
    width: 100%;
    height: auto;
    filter: drop-shadow(0 20px 30px rgba(0, 0, 0, 0.7));
  }

  #why-motozo .chips {
    display: flex;
    align-items: center;
    gap: 8px;
    position: relative;
    z-index: 10;
    transform: translateZ(28px);
    margin-top: 14px;
    padding-top: 16px;
    border-top: 1px solid rgba(255, 255, 255, 0.08);
  }

  #why-motozo .chip {
    flex: 1 1 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    padding: 9px 8px;
    border-radius: 12px;
    font-size: 11.5px;
    font-weight: 700;
    text-align: center;
  }

  #why-motozo .card.old .chip {
    background: rgba(220, 38, 38, 0.12);
    border: 1px solid rgba(255, 72, 56, 0.28);
    color: #ff9b8c;
  }

  #why-motozo .card.old .chip svg {
    width: 16px;
    height: 16px;
    stroke: #ff5035;
    stroke-width: 3;
    fill: none;
    flex-shrink: 0;
  }

  /* Connected Motozo Perks with Sequential 1-second pulse */
  #why-motozo .perk-arrow {
    flex: 0 0 18px;
    height: 3px;
    border-radius: 2px;
    background: linear-gradient(90deg, #2fbf71, #7df0ad);
    box-shadow: 0 0 8px rgba(74, 222, 128, 0.7);
    animation: arrowGlow 1.5s infinite alternate ease-in-out;
  }

  #why-motozo .motozo-connected-perks {
    gap: 0;
  }

  @keyframes arrowGlow {
    0% {
      opacity: 0.55;
      transform: translateX(0);
    }

    100% {
      opacity: 1;
      transform: translateX(2px);
    }
  }

  #why-motozo .card.new .chip.perk-step {
    background: #ffffff;
    border: 1.5px solid #5FC38E;
    box-shadow: 0 4px 12px rgba(14, 110, 62, 0.15);
    color: #0B5C35;
    transition: all 0.3s ease;
  }

  #why-motozo .card.new .chip.perk-step svg {
    width: 17px;
    height: 17px;
    stroke: currentColor;
    stroke-width: 2.2;
    fill: none;
    flex-shrink: 0;
    filter: none;
    transition: stroke 0.3s ease;
  }

  #why-motozo .stage .ic2 {
    fill: currentColor;
  }

  @keyframes perkSequentialLight {
    0% {
      background: #1B692C;
      border-color: #1B692C;
      color: #ffffff;
      box-shadow: 0 6px 18px rgba(27, 105, 44, 0.38);
      transform: translateY(-2px);
    }

    28% {
      background: #1B692C;
      border-color: #1B692C;
      color: #ffffff;
      box-shadow: 0 6px 18px rgba(27, 105, 44, 0.38);
      transform: translateY(-2px);
    }

    33.33% {
      background: #ffffff;
      border-color: #5FC38E;
      color: #1B692C;
      box-shadow: 0 2px 8px rgba(27, 105, 44, 0.1);
      transform: translateY(0);
    }

    95% {
      background: #ffffff;
      border-color: #5FC38E;
      color: #1B692C;
      box-shadow: 0 2px 8px rgba(27, 105, 44, 0.1);
      transform: translateY(0);
    }

    100% {
      background: #1B692C;
      border-color: #1B692C;
      color: #ffffff;
      box-shadow: 0 6px 18px rgba(27, 105, 44, 0.38);
      transform: translateY(-2px);
    }
  }

  #why-motozo .perk-step-1 {
    animation: perkSequentialLight 3s infinite ease-in-out;
    animation-delay: 0s;
  }

  #why-motozo .perk-step-2 {
    animation: perkSequentialLight 3s infinite ease-in-out;
    animation-delay: 1s;
  }

  #why-motozo .perk-step-3 {
    animation: perkSequentialLight 3s infinite ease-in-out;
    animation-delay: 2s;
  }

  #why-motozo .badge-3d-wrap {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) translateZ(65px);
    z-index: 25;
    pointer-events: none;
  }

  #why-motozo .badge-3d {
    width: 68px;
    height: 68px;
    border-radius: 50%;
    background: radial-gradient(circle at 35% 30%, #222925, #080c0a);
    border: 2px solid rgba(255, 255, 255, 0.25);
    box-shadow: 0 0 35px rgba(0, 0, 0, 0.9), 0 0 20px rgba(47, 191, 113, 0.35);
    display: grid;
    place-items: center;
    position: relative;
    animation: badgePulse 3s ease-in-out infinite alternate;
  }

  #why-motozo .badge-ring {
    position: absolute;
    inset: -8px;
    border-radius: 50%;
    border: 1px dashed rgba(47, 191, 113, 0.5);
    animation: badgeRotate 20s linear infinite;
  }

  @keyframes badgeRotate {
    to {
      transform: rotate(360deg);
    }
  }

  @keyframes badgePulse {
    0% {
      transform: scale(1);
    }

    100% {
      transform: scale(1.06);
      box-shadow: 0 0 45px rgba(47, 191, 113, 0.55);
    }
  }

  #why-motozo .badge-3d span {
    font-weight: 900;
    font-size: 19px;
    letter-spacing: -0.04em;
    background: linear-gradient(135deg, #ffffff 0%, #7df0ad 50%, #ff8c7a 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  #why-motozo .smart-choice-tag {
    position: absolute;
    top: 0;
    right: 28px;
    background: var(--green-700);
    color: #fff;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    padding: 6px 16px;
    border-radius: 0 0 12px 12px;
    box-shadow: 0 8px 18px rgba(16, 185, 129, 0.45);
    z-index: 15;
  }

  #why-motozo .hand {
    position: absolute;
    top: 28px;
    right: 175px;
    font-family: 'Caveat', cursive, sans-serif;
    font-size: 20px;
    color: #ffd23f;
    line-height: 1.1;
    transform: rotate(-10deg);
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.6);
    pointer-events: none;
    z-index: 15;
  }

  /* Full-width Legal vs Illegal cards */
  #why-motozo .note-wrap {
    width: 100%;
    max-width: 100%;
    margin: 40px auto 0;
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 24px;
    align-items: stretch;
  }

  /* Both cards */
  #why-motozo .note-card {
    position: relative;
    width: 100%;
    min-width: 0;
    box-sizing: border-box;
    padding: 26px 28px;
    display: flex;
    align-items: flex-start;
    gap: 20px;
    border-radius: 20px;
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1),
      border-color 0.35s ease,
      box-shadow 0.35s ease;
  }

  /* LEFT CARD — THE RISKY WAY: PEACH / RED THEME (#FFF0EB) */
  #why-motozo .note-card--risk {
    background:  #FEF1EE;
    border: 1.5px solid rgba(239, 68, 68, 0.42);
    box-shadow: 0 14px 34px -8px rgba(0, 0, 0, 0.28),
      0 3px 10px rgba(239, 68, 68, 0.1);
  }

  #why-motozo .note-card--risk:hover {
    transform: translateY(-4px);
    border-color: #ef4444;
    box-shadow: 0 20px 42px -10px rgba(239, 68, 68, 0.35);
  }

  /* RIGHT CARD — THE SAFE WAY: MINT / GREEN THEME (#ECFAF2) */
  #why-motozo .note-card--safe {
    background: var(--green-50);
    border: 1.5px solid rgba(47, 191, 113, 0.48);
    box-shadow: 0 14px 34px -8px rgba(0, 0, 0, 0.28),
      0 3px 10px rgba(47, 191, 113, 0.1);
  }

  #why-motozo .note-card--safe:hover {
    transform: translateY(-4px);
    border-color: #2fbf71;
    box-shadow: 0 20px 42px -10px rgba(47, 191, 113, 0.35);
  }

  /* Card Icons */
  #why-motozo .note-icon {
    width: 48px;
    height: 48px;
    min-width: 48px;
    border-radius: 14px;
    display: grid;
    place-items: center;
    flex-shrink: 0;
    transition: transform 0.3s ease;
  }

  #why-motozo .note-card:hover .note-icon {
    transform: scale(1.06);
  }

  #why-motozo .note-icon--risk {
    color: #dc2626;
    background: #fee2e2;
    border: 1.5px solid rgba(239, 68, 68, 0.35);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.12);
  }

  #why-motozo .note-icon--safe {
    color: #0e6e3e;
    background: #dcfce7;
    border: 1.5px solid rgba(47, 191, 113, 0.4);
    box-shadow: 0 4px 12px rgba(47, 191, 113, 0.12);
  }

  /* Body Content */
  #why-motozo .note-body {
    flex: 1;
    min-width: 0;
    display: flex;
    flex-direction: column;
    text-align: left;
  }

  /* Header Row (Label + Status Badge) */
  #why-motozo .note-header-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 6px;
  }

  /* Label (THE SAFE WAY / THE RISKY WAY) */
  #why-motozo .note-label {
    font-family: var(--font-body);
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 1.8px;
    text-transform: uppercase;
    margin: 0;
    line-height: 1;
  }

  #why-motozo .note-card--risk .note-label {
    color: #dc2626;
  }

  #why-motozo .note-card--safe .note-label {
    color: #0e6e3e;
  }

  /* Status Badges */
  #why-motozo .note-status {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-family: var(--font-body);
    font-size: 11.5px;
    font-weight: 600;
    padding: 3.5px 10px;
    border-radius: 999px;
    white-space: nowrap;
    line-height: 1.2;
  }

  #why-motozo .note-status svg {
    flex-shrink: 0;
  }

  #why-motozo .note-status--risk {
    background: #fee2e2;
    color: #b91c1c;
    border: 1px solid rgba(239, 68, 68, 0.35);
  }

  #why-motozo .note-status--safe {
    background: #dcfce7;
    color: #15803d;
    border: 1px solid rgba(47, 191, 113, 0.4);
  }

  /* Card Title */
  #why-motozo .note-title {
    display: block;
    font-family: var(--font-body);
    font-size: 18px;
    font-weight: 800;
    line-height: 1.35;
    margin: 0 0 8px 0;
    letter-spacing: -0.2px;
  }

  #why-motozo .note-card--risk .note-title {
    color: #1f1d1d;
  }

  #why-motozo .note-card--safe .note-title {
    color: #0f1f1a;
  }

  /* Card Description */
  #why-motozo .note-desc {
    margin: 0;
    font-family: var(--font-body);
    font-size: 13.5px;
    line-height: 1.68;
    font-weight: 500;
    -webkit-font-smoothing: antialiased;
  }

  #why-motozo .note-card--risk .note-desc {
    color: #4a4242;
  }

  #why-motozo .note-card--safe .note-desc {
    color: #2c3e35;
  }

  /* Responsive Design */
  @media (max-width: 991.98px) {
    #why-motozo .note-wrap {
      grid-template-columns: 1fr;
      gap: 18px;
      margin-top: 32px;
    }

    #why-motozo .note-card {
      padding: 24px 22px;
      gap: 18px;
    }

    #why-motozo .note-title {
      font-size: 17px;
    }

    #why-motozo .note-desc {
      font-size: 13.5px;
    }
  }

  @media (max-width: 767.98px) {
    #why-motozo .note-card {
      padding: 20px 18px;
      gap: 15px;
      border-radius: 18px;
    }

    #why-motozo .note-icon {
      width: 44px;
      height: 44px;
      min-width: 44px;
      border-radius: 12px;
    }

    #why-motozo .note-header-row {
      gap: 8px;
    }

    #why-motozo .note-title {
      font-size: 16px;
      margin-bottom: 7px;
    }

    #why-motozo .note-desc {
      font-size: 13px;
      line-height: 1.62;
    }
  }

  @media (max-width: 479.98px) {
    #why-motozo .note-wrap {
      gap: 14px;
      margin-top: 24px;
    }

    #why-motozo .note-card {
      padding: 16px 14px;
      gap: 12px;
      border-radius: 16px;
    }

    #why-motozo .note-icon {
      width: 38px;
      height: 38px;
      min-width: 38px;
      border-radius: 10px;
    }

    #why-motozo .note-icon svg {
      width: 19px;
      height: 19px;
    }

    #why-motozo .note-header-row {
      gap: 6px;
    }

    #why-motozo .note-label {
      font-size: 10px;
      letter-spacing: 1.3px;
    }

    #why-motozo .note-status {
      font-size: 10.5px;
      padding: 2.5px 8px;
      gap: 4px;
    }

    #why-motozo .note-title {
      font-size: 15px;
      margin-bottom: 6px;
    }

    #why-motozo .note-desc {
      font-size: 12.5px;
      line-height: 1.58;
    }
  }

  @media (max-width: 359.98px) {
    #why-motozo .note-card {
      flex-direction: column;
      align-items: flex-start;
      gap: 10px;
      padding: 14px 12px;
    }

    #why-motozo .note-header-row {
      width: 100%;
    }
  }

  @media (prefers-reduced-motion: reduce) {

    #why-motozo .note-card,
    #why-motozo .note-icon {
      transition: none;
    }

    #why-motozo .note-card:hover {
      transform: none;
    }

    #why-motozo .note-card:hover .note-icon {
      transform: none;
    }
  }

  #why-motozo .track {
    stroke: #ff4838;
    stroke-width: 4;
    stroke-dasharray: 14 10;
    stroke-linecap: round;
    filter: drop-shadow(0 0 8px #ff3c28);
  }

  #why-motozo .gtrack {
    stroke: #2fbf71;
    stroke-width: 4;
    stroke-dasharray: 14 10;
    stroke-linecap: round;
    fill: none;
    filter: drop-shadow(0 0 8px #2fbf71);
  }

  #why-motozo .hit.go {
    transform-box: fill-box;
    transform-origin: 50% 100%;
    animation: hitBounce 0.45s cubic-bezier(0.34, 1.56, 0.64, 1);
  }

  @keyframes hitBounce {
    0% {
      transform: scale(1);
    }

    35% {
      transform: scale(1.12, 0.92);
    }

    65% {
      transform: scale(0.96, 1.04);
    }

    100% {
      transform: scale(1);
    }
  }

  #why-motozo .cutb {
    opacity: 0;
    pointer-events: none;
    transition: opacity .25s ease;
  }

  #why-motozo .cutb.on {
    opacity: 1;
  }

  #why-motozo .cutb .bp {
    transform-origin: center;
    transform-box: fill-box;
  }

  #why-motozo .cutb.on .bp {
    animation: cutBadgePop 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
  }

  @keyframes cutBadgePop {
    0% {
      transform: scale(0.65);
    }

    100% {
      transform: scale(1);
    }
  }

  #why-motozo .lbl {
    transition: opacity 0.3s ease, filter 0.3s ease;
  }

  #why-motozo .lbl rect {
    transition: fill 0.3s ease, stroke 0.3s ease, filter 0.3s ease;
  }

  #why-motozo .lbl text {
    transition: fill 0.3s ease;
  }

  #why-motozo .lbl.act rect {
    fill: #ff4838 !important;
    stroke: #ffa594 !important;
    filter: drop-shadow(0 0 14px rgba(255, 72, 56, 0.85)) !important;
  }

  #why-motozo .lbl.act text {
    fill: #ffffff !important;
    font-weight: 800 !important;
  }

  #why-motozo .hubfloat {
    animation: hubFloat 3.4s ease-in-out infinite alternate;
  }

  @keyframes hubFloat {
    0% {
      transform: translateY(0);
    }

    100% {
      transform: translateY(-7px);
    }
  }

  #why-motozo .rip {
    fill: none;
    stroke: #7df0ad;
    stroke-width: 2.5;
    opacity: 0;
    transform-box: fill-box;
    transform-origin: center;
    animation: ripWave 2.8s ease-out infinite;
  }

  @keyframes ripWave {
    0% {
      opacity: 0.9;
      transform: scale(0.9);
    }

    100% {
      opacity: 0;
      transform: scale(2.2);
    }
  }

  #why-motozo .glow-pulse {
    animation: glowPulse 2.6s ease-in-out infinite alternate;
  }

  @keyframes glowPulse {
    0% {
      opacity: 0.45;
    }

    100% {
      opacity: 0.95;
    }
  }

  @media (max-width: 991.98px) {
    #why-motozo .vs-container {
      perspective: none;
    }

    #why-motozo .vs {
      grid-template-columns: 1fr;
      gap: 20px;
      transform-style: flat;
    }

    #why-motozo .card-wrap {
      max-width: 580px;
      margin: 0 auto;
      width: 100%;
      will-change: auto;
      perspective: none;
      transform-style: flat;
    }

    #why-motozo .card {
      transform: none !important;
      transform-style: flat;
    }

    #why-motozo .badge-3d-wrap {
      position: relative;
      top: auto;
      left: auto;
      transform: none;
      margin: 12px auto;
      display: flex;
      justify-content: center;
    }

    #why-motozo .badge-3d {
      width: 54px;
      height: 54px;
    }

    #why-motozo .badge-3d span {
      font-size: 16px;
    }

    #why-motozo .hand {
      display: none !important;
    }

    #why-motozo .layer-3d-stage,
    #why-motozo .layer-3d-text,
    #why-motozo .layer-3d-chips {
      transform: none !important;
    }

    #why-motozo .step-tracker {
      flex-wrap: wrap;
      justify-content: center;
      gap: 6px 4px;
      padding: 8px 6px;
      overflow: visible;
    }

    #why-motozo .step-item {
      flex: 0 0 auto;
      padding: 4px 8px;
      font-size: 10.5px;
    }
  }

  @media (max-width: 575.98px) {

    #why-motozo {
      padding: 28px 0 45px;
    }

    #why-motozo .wrap {
      padding: 0 10px;
    }

    #why-motozo .section-header {
      margin-bottom: 20px;
    }

    #why-motozo .section-tag {
      padding: 6px 14px;
      font-size: 11px;
      margin-bottom: 8px;
    }

    #why-motozo .section-title {
      font-size: clamp(20px, 5.8vw, 25px);
      margin-bottom: 6px;
      line-height: 1.22;
    }

    #why-motozo .section-subtitle {
      font-size: 12.5px;
      line-height: 1.45;
    }

    #why-motozo .vs-container {
      perspective: none;
    }

    #why-motozo .vs {
      transform-style: flat;
    }

    #why-motozo .card-wrap {
      will-change: auto;
      perspective: none;
      transform-style: flat;
    }

    #why-motozo .card {
      transform: none !important;
      transform-style: flat;
    }

    #why-motozo .vs {
      gap: 16px;
    }

    #why-motozo .card {
      padding: 18px 12px 14px;
      border-radius: 18px;
    }

    #why-motozo .pill {
      font-size: 9.5px;
      padding: 4px 10px;
      margin-bottom: 8px;
    }

    #why-motozo .smart-choice-tag {
      right: 12px;
      font-size: 9px;
      padding: 3px 8px;
      border-radius: 0 0 8px 8px;
    }

    #why-motozo h3 {
      font-size: 17px;
      margin-bottom: 5px;
      line-height: 1.25;
    }

    #why-motozo .card p {
      font-size: 12px;
      line-height: 1.45;
      margin-bottom: 10px;
    }

    #why-motozo .step-tracker {
      flex-wrap: wrap;
      justify-content: center;
      gap: 5px 3px;
      padding: 6px 4px;
      overflow: visible;
      border-radius: 8px;
      margin-bottom: 8px;
    }

    #why-motozo .step-item {
      flex: 0 0 auto;
      padding: 3px 6px;
      font-size: 9.5px;
      gap: 3px;
      border-radius: 5px;
    }

    #why-motozo .step-item .step-dot {
      width: 5px;
      height: 5px;
    }

    #why-motozo .step-arrow {
      font-size: 8px;
      padding: 0 1px;
      opacity: 0.6;
    }

    #why-motozo .layer-3d-stage {
      margin: 4px 0 8px;
      overflow: hidden;
    }

    #why-motozo svg.stage {
      width: 100%;
      height: auto;
      border-radius: 10px;
      filter: none;
    }

    /* Symmetrical 3-column chips on both cards */
    #why-motozo .chips {
      display: grid !important;
      grid-template-columns: repeat(3, 1fr) !important;
      gap: 5px !important;
      margin-top: 8px;
      padding-top: 10px;
    }

    #why-motozo .chip {
      padding: 6px 3px !important;
      font-size: 8.5px !important;
      line-height: 1.2 !important;
      flex-direction: column !important;
      gap: 3px !important;
      border-radius: 8px !important;
      text-align: center !important;
    }

    #why-motozo .chip svg {
      width: 15px !important;
      height: 15px !important;
    }

    #why-motozo .card.new .motozo-connected-perks {
      display: flex !important;
      flex-wrap: nowrap !important;
      align-items: center !important;
      justify-content: space-between !important;
      gap: 3px !important;
    }

    #why-motozo .card.new .motozo-connected-perks .perk-arrow {
      display: block !important;
      flex: 0 0 auto !important;
      font-size: 11px !important;
      padding: 0 !important;
    }

    #why-motozo .card.new .motozo-connected-perks .perk-arrow {
      display: none !important;
    }

    #why-motozo .card.new .chip.perk-step {
      width: auto !important;
      padding: 6px 3px !important;
      font-size: 8.5px !important;
      line-height: 1.2 !important;
      flex-direction: column !important;
      gap: 3px !important;
      border-radius: 8px !important;
    }

    #why-motozo .card.new .chip.perk-step svg {
      width: 15px !important;
      height: 15px !important;
    }

    #why-motozo .badge-3d {
      width: 44px;
      height: 44px;
    }

    #why-motozo .badge-3d span {
      font-size: 14px;
    }

    #why-motozo .badge-3d-wrap {
      margin: 8px auto;
    }

    #why-motozo .note-wrap {
      margin-top: 18px;
      padding: 0 4px;
    }

    #why-motozo .note-card {
      padding: 10px 12px;
      gap: 10px;
      border-radius: 12px;
    }

    #why-motozo .note-icon {
      width: 28px;
      height: 28px;
    }

    #why-motozo .note-text {
      font-size: 11.5px;
      line-height: 1.4;
    }

    #why-motozo .ambient-orb {
      width: 220px;
      height: 220px;
      filter: blur(60px);
      opacity: 0.25;
    }
  }

  /* ===== Motozo: Clear & Sharp Text Fix ===== */

  #why-motozo {
    --text-light: #ffffff;
    --text-muted: #c5d5cc;
  }

  /* Main heading */
  #why-motozo .section-title {
    color: #ffffff;
    -webkit-text-fill-color: #ffffff;
    background: none;
    text-shadow: none;
  }

  /* Subtitle */
  #why-motozo .section-subtitle {
    color: #e0ebe4;
  }

  /* Card headings */
  #why-motozo .card h3 {
    color: #ffffff;
    -webkit-text-fill-color: #ffffff;
    text-shadow: none;
  }

  /* Card descriptions */
  #why-motozo .card p {
    color: #d0ded5;
    text-shadow: none;
  }

  /* Step tracker text */
  #why-motozo .step-item {
    color: #ffffff;
  }

  /* Improve text rendering */
  #why-motozo .layer-3d-text {
    -webkit-font-smoothing: antialiased;
    text-rendering: optimizeLegibility;
  }

  /* Remove blur from the cards */
  #why-motozo .card {
    backdrop-filter: none;
    -webkit-backdrop-filter: none;
  }

  /* ===== No-blur on hover: tilt, glare, spotlight off ===== */
  .spotlight-section::after,
  #why-motozo .card-glare {
    display: none !important;
  }

  #why-motozo .vs-container {
    perspective: none !important;
  }

  #why-motozo .vs,
  #why-motozo .card-wrap,
  #why-motozo .card {
    perspective: none !important;
    transform-style: flat !important;
    transform: none !important;
    will-change: auto !important;
  }

  #why-motozo .layer-3d-stage,
  #why-motozo .chips {
    transform: none !important;
  }

  /* VS badge sirf desktop par beech me */
  @media (min-width: 992px) {
    #why-motozo .badge-3d-wrap {
      transform: translate(-50%, -50%) !important;
    }
  }

  /* ==========================================================
     FINAL LIGHT THEME (purane light/background blocks hata do)
     ========================================================== */

  /* ---------- Section background ---------- */
  #why-motozo {
    background: #FCFCF7;
    color: #12301f !important;
  }

  #why-motozo .ambient-orb {
    opacity: 0.15 !important;
  }

  /* ---------- Header ---------- */
  #why-motozo .section-title {
    color: var(--heading-color) !important;
    -webkit-text-fill-color: var(--heading-color) !important;
    background: none !important;
    font-family: var(--font-heading) !important;
    font-size: var(--heading-size) !important;
  }

  #why-motozo .section-subtitle {
    font-family: var(--font-body) !important;
    font-size: clamp(0.92rem, 1.1vw, 1.04rem) !important;
    color: var(--muted, #899097) !important;
  }

  #why-motozo .section-tag {
    background: #fff !important;
    border: 1px solid rgba(27, 105, 44, 0.35) !important;
    box-shadow: none !important;
  }

  #why-motozo .section-tag span {
    color: #1B692C !important;
  }

  #why-motozo .section-tag-dot {
    background: #1B692C !important;
    box-shadow: none !important;
  }

  /* ---------- Cards ---------- */   
  #why-motozo .card.old {
    background: #FEF1EE;
    border: 1.5px solid #EF9A89 !important;
    box-shadow: 0 18px 40px -22px rgba(190, 70, 50, 0.5) !important;
  }

  #why-motozo .card.new {
    background:var(--green-50);
    border: 1.5px solid #5FC38E !important;
    box-shadow: 0 18px 40px -22px rgba(14, 110, 62, 0.5) !important;
  }

  #why-motozo .card h3 {
    color: #1b1614 !important;
    -webkit-text-fill-color: #1b1614 !important;
  }

  #why-motozo .card.old p {
    color: #4a3530 !important;
  }

  #why-motozo .card.new p {
    color: #234536 !important;
  }

  #why-motozo .card.old h3 em {
    color: #D6402B !important;
  }

  #why-motozo .card.new h3 em {
    color: #1B692C !important;
  }

  #why-motozo .card.old .pill {
    background: #fff !important;
    border: 1px solid #EF9A89 !important;
    color: #C4361F !important;
  }

  #why-motozo .card.new .pill {
    background: #fff !important;
    border: 1px solid #5FC38E !important;
    color: #0E7A45 !important;
  }

  /* ---------- Step tracker ---------- */
  #why-motozo .step-tracker {
    background: rgba(255, 255, 255, 0.7) !important;
    border: 1px solid rgba(0, 0, 0, 0.08) !important;
  }

  #why-motozo .step-item {
    background: #fff !important;
    border: 1px solid rgba(0, 0, 0, 0.1) !important;
    color: #3f3f3f !important;
    box-shadow: none !important;
  }

  #why-motozo .step-item .step-dot {
    background: #bdbdbd !important;
  }

  #why-motozo .step-arrow {
    color: rgba(0, 0, 0, 0.4) !important;
  }

  #why-motozo .card.old .step-item.active {
    background: #D6402B !important;
    border-color: #D6402B !important;
    color: #fff !important;
  }

  #why-motozo .card.new .step-item.active {
    background: #1B692C !important;
    border-color: #1B692C !important;
    color: #fff !important;
  }

  #why-motozo .card .step-item.active .step-dot {
    background: #fff !important;
    box-shadow: none !important;
  }

  /* ---------- Chips ---------- */
  #why-motozo .chips {
    border-top: 1px solid rgba(0, 0, 0, 0.1) !important;
  }

  #why-motozo .card.old .chip {
    background: #fff !important;
    border: 1px solid #EF9A89 !important;
    color: #B3301B !important;
  }

  #why-motozo .card.old .chip svg {
    stroke: #D6402B !important;
  }

  #why-motozo .card.new .chip.perk-step {
    background: #ffffff;
    border: 1.5px solid #5FC38E;
    color: #0B5C35;
    box-shadow: 0 4px 12px rgba(14, 110, 62, 0.15);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  #why-motozo .card.new .chip.perk-step svg {
    stroke: currentColor;
    filter: none !important;
  }

  #why-motozo .perk-step-1 {
    animation: perkSequentialLight 3s infinite ease-in-out;
    animation-delay: 0s;
  }

  #why-motozo .perk-step-2 {
    animation: perkSequentialLight 3s infinite ease-in-out;
    animation-delay: 1s;
  }

  #why-motozo .perk-step-3 {
    animation: perkSequentialLight 3s infinite ease-in-out;
    animation-delay: 2s;
  }

  #why-motozo .perk-arrow {
    background: #1B692C !important;
    box-shadow: none !important;
  }

  #why-motozo .smart-choice-tag {
    color: #fff !important;
  }

  #why-motozo .hand {
    color: #B86E00 !important;
    text-shadow: none !important;
  }

  /* ---------- VS badge ---------- */
  #why-motozo .badge-3d {
    background: #fff !important;
    border: 2px solid #1B692C !important;
    box-shadow: 0 8px 22px rgba(14, 111, 62, 0.25) !important;
  }

  #why-motozo .badge-ring {
    border-color: rgba(14, 138, 79, 0.5) !important;
  }

  #why-motozo .badge-3d span {
    background: none !important;
    color: #0E6F3E !important;
    -webkit-text-fill-color: #0E6F3E !important;
  }

  /* ---------- Bottom note ---------- */
  #why-motozo .note-card {
    border: 1px solid rgba(14, 111, 62, 0.35) !important;
    box-shadow: 0 12px 30px -16px rgba(14, 111, 62, 0.35) !important;
  }

  #why-motozo .note-text {
    color: #3d5a4a !important;
  }

  #why-motozo .note-text strong {
    color: #12301f !important;
  }

  #why-motozo .note-icon {
    background: rgba(14, 138, 79, 0.12) !important;
    border: 1px solid rgba(14, 138, 79, 0.4) !important;
    color: #1B692C !important;
  }

  /* ==========================================================
     PROCESS SCENES (SVG)
     ========================================================== */
  #why-motozo svg.stage {
    filter: drop-shadow(0 8px 16px rgba(0, 0, 0, 0.12)) !important;
  }

  /* Heavy glow hatao */
  #why-motozo svg.stage [filter="url(#f-glow-red)"],
  #why-motozo svg.stage [filter="url(#f-glow-green)"],
  #why-motozo svg.stage [filter="url(#f-glow-gold)"] {
    filter: none;
  }

  /* ---- Traditional scene: background ---- */
  #oldRoomGrad stop:nth-child(1) {
    stop-color: #FFF6F3;
    stop-opacity: 1;
  }

  #oldRoomGrad stop:nth-child(2) {
    stop-color: #FFE8E1;
    stop-opacity: 1;
  }

  #oldRoomGrad stop:nth-child(3) {
    stop-color: #FFD9CF;
  }

  #oldSpotlight stop {
    stop-color: #fff;
  }

  #oldDeckLight stop {
    stop-color: #fff;
  }

  #oldFloorGrad stop:nth-child(1) {
    stop-color: #F9C2B6;
  }

  #oldFloorGrad stop:nth-child(2) {
    stop-color: #F4AE9F;
  }

  #oldFloorGrad stop:nth-child(3) {
    stop-color: #EE9A8A;
  }

  #oldFloorGrad stop:nth-child(4) {
    stop-color: #E88777;
  }

  #oldSlabGrad stop:nth-child(1) {
    stop-color: #E88777;
  }

  #oldSlabGrad stop:nth-child(2) {
    stop-color: #CC6454;
  }

  /* ---- Traditional scene: lines & markers ---- */
  #s .track {
    stroke: #D6402B;
    stroke-width: 4;
    filter: none;
  }

  #s #grid {
    stroke: rgba(160, 50, 35, 0.35);
  }

  #s polygon[stroke="#ff5035"] {
    stroke: #D6402B;
  }

  #s polygon[stroke="#ff4838"] {
    stroke: #C9604F;
  }

  #s line[stroke="#ff5a43"],
  #s line[stroke="#ff3820"] {
    stroke: #C9604F;
  }

  #s circle[fill="#ff7a65"],
  #s circle[fill="#ff5a43"] {
    fill: #D6402B;
  }

  #s path[stroke="#ff8c77"],
  #s path[stroke="#ff705b"] {
    stroke: #D6402B;
  }

  #s .lbl line {
    stroke: #D6402B;
  }

  /* Name labels: white pill + dark text, active = red + white text */
  #why-motozo .lbl rect {
    fill: #fff;
    stroke: #D6402B;
  }

  #why-motozo .lbl text {
    fill: #7a2a1f;
  }

  /* "-₹ Commission" badge */
  #s .cutb rect {
    fill: #D6402B;
    stroke: #fff;
  }

  #s .cutb circle {
    fill: #8f1d0e;
  }

  /* ---- Motozo scene: background ---- */
  #newRoomGrad stop:nth-child(1) {
    stop-color: #F5FDF8;
    stop-opacity: 1;
  }

  #newRoomGrad stop:nth-child(2) {
    stop-color: #E1F7EA;
    stop-opacity: 1;
  }

  #newRoomGrad stop:nth-child(3) {
    stop-color: #CBEFDB;
  }

  #newSpotlight stop {
    stop-color: #fff;
  }

  #newDeckLight stop {
    stop-color: #fff;
  }

  #newFloorGrad stop:nth-child(1) {
    stop-color: #9BE3BC;
  }

  #newFloorGrad stop:nth-child(2) {
    stop-color: #85D8AB;
  }

  #newFloorGrad stop:nth-child(3) {
    stop-color: #70CC9A;
  }

  #newFloorGrad stop:nth-child(4) {
    stop-color: #5CBF89;
  }

  #newSlabGrad stop:nth-child(1) {
    stop-color: #5CBF89;
  }

  #newSlabGrad stop:nth-child(2) {
    stop-color: #2F9A63;
  }

  /* ---- Motozo scene: lines & markers ---- */
  #stage-motozo .gtrack {
    stroke: #1B692C;
    filter: none;
  }

  #stage-motozo g[stroke^="rgba(125"] {
    stroke: rgba(14, 111, 62, 0.35);
  }

  #stage-motozo polygon[stroke="#2fbf71"] {
    stroke: #1B692C;
  }

  #stage-motozo line[stroke="#4ade80"] {
    stroke: #1B692C;
  }

  #s .hubfloat {
    animation: none !important;
  }

  @keyframes perkSequentialLight {
    0% {
      background: #1B692C;
      border-color: #1B692C;
      color: #ffffff;
      box-shadow: 0 6px 18px rgba(27, 105, 44, 0.38);
      transform: translateY(-2px);
    }

    28% {
      background: #1B692C;
      border-color: #1B692C;
      color: #ffffff;
      box-shadow: 0 6px 18px rgba(27, 105, 44, 0.38);
      transform: translateY(-2px);
    }

    33.33% {
      background: #ffffff;
      border-color: #5FC38E;
      color: #1B692C;
      box-shadow: 0 2px 8px rgba(27, 105, 44, 0.1);
      transform: translateY(0);
    }

    95% {
      background: #ffffff;
      border-color: #5FC38E;
      color: #1B692C;
      box-shadow: 0 2px 8px rgba(27, 105, 44, 0.1);
      transform: translateY(0);
    }

    100% {
      background: #1B692C;
      border-color: #1B692C;
      color: #ffffff;
      box-shadow: 0 6px 18px rgba(27, 105, 44, 0.38);
      transform: translateY(-2px);
    }
  }
</style>

<script>
  (function() {
    // 3D Card Tilt on Pointer Movement
    const cardWraps = document.querySelectorAll('#why-motozo .card-wrap');
    cardWraps.forEach(wrap => {
      const card = wrap.querySelector('.card');
      let bounds;

      function onMouseEnter() {
        bounds = wrap.getBoundingClientRect();
      }

      function onMouseMove(e) {
        if (window.innerWidth <= 991 || ('ontouchstart' in window) || (navigator.maxTouchPoints > 0)) return;
        if (!bounds) bounds = wrap.getBoundingClientRect();
        const x = e.clientX - bounds.left;
        const y = e.clientY - bounds.top;
        const centerX = bounds.width / 2;
        const centerY = bounds.height / 2;
        const rotateX = ((y - centerY) / centerY) * -0.85;
        const rotateY = ((x - centerX) / centerX) * 0.85;

        card.style.setProperty('--mouse-x', `${(x / bounds.width) * 100}%`);
        card.style.setProperty('--mouse-y', `${(y / bounds.height) * 100}%`);

        if (typeof gsap !== 'undefined') {
          gsap.to(card, {
            rotateX,
            rotateY,
            duration: 0.5,
            ease: "power2.out",
            transformPerspective: 1800
          });
        } else {
          card.style.transform = `perspective(1800px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
        }
      }

      function onMouseLeave() {
        if (window.innerWidth <= 991 || ('ontouchstart' in window) || (navigator.maxTouchPoints > 0)) return;
        if (typeof gsap !== 'undefined') {
          gsap.to(card, {
            rotateX: 0,
            rotateY: 0,
            duration: 0.6,
            ease: "power2.out"
          });
        } else {
          card.style.transform = '';
        }
      }

    });

    // Master Stage Orchestration for Traditional Way
    (function() {
      const stageEl = document.getElementById('s');
      if (!stageEl) return;
      const NS = 'http://www.w3.org/2000/svg',
        $id = id => document.getElementById(id);
      const XS = [110, 295, 480, 665],
        RX = 850,
        TR = 460,
        CH = 274,
        S = 1.2,
        FY = 412,
        CUT = 800;
      const hx = h => {
        if (h.length === 4) h = '#' + h[1] + h[1] + h[2] + h[2] + h[3] + h[3];
        return [1, 3, 5].map(i => parseInt(h.substr(i, 2), 16));
      };
      const mix = (h, t, k) => {
        const a = hx(h),
          b = hx(t);
        return '#' + a.map((v, i) => Math.round(v + (b[i] - v) * k).toString(16).padStart(2, '0')).join('');
      };
      const lgr = (id, c) => `<linearGradient id="${id}"><stop offset="0" stop-color="${mix(c, '#ffffff', .28)}"/><stop offset=".42" stop-color="${c}"/><stop offset="1" stop-color="${mix(c, '#000000', .55)}"/></linearGradient>`;
      const FILTER = p => `<filter id="${p}L" x="-15%" y="-8%" width="130%" height="116%" color-interpolation-filters="sRGB"><feGaussianBlur in="SourceAlpha" stdDeviation="1.5" result="b"/><feDiffuseLighting in="b" surfaceScale="2.4" diffuseConstant="1.3" lighting-color="#fff" result="d"><feDistantLight azimuth="225" elevation="58"/></feDiffuseLighting><feComposite in="d" in2="SourceAlpha" operator="in" result="d2"/><feBlend in="SourceGraphic" in2="d2" mode="multiply" result="m"/><feSpecularLighting in="b" surfaceScale="2.4" specularConstant=".5" specularExponent="16" lighting-color="#fff6ea" result="s"><feDistantLight azimuth="225" elevation="40"/></feSpecularLighting><feComposite in="s" in2="SourceAlpha" operator="in" result="s2"/><feSpecularLighting in="b" surfaceScale="2.4" specularConstant=".55" specularExponent="10" lighting-color="#8ff0bd" result="r"><feDistantLight azimuth="10" elevation="18"/></feSpecularLighting><feComposite in="r" in2="SourceAlpha" operator="in" result="r2"/><feComposite in="m" in2="s2" operator="arithmetic" k2="1" k3=".75" result="ms"/><feComposite in="ms" in2="r2" operator="arithmetic" k2="1" k3=".45"/></filter><filter id="${p}S" x="-50%" y="-50%" width="200%" height="200%"><feGaussianBlur stdDeviation="1"/></filter>`;
      const bale = (x, y, w, h, c) => `<rect x="${x}" y="${y}" width="${w}" height="${h}" fill="${c}" stroke="#3d464b" stroke-width=".6"/><polygon points="${x},${y} ${x + 7},${y - 5} ${x + w + 7},${y - 5} ${x + w},${y}" fill="${mix(c, '#fff', .3)}"/><polygon points="${x + w},${y} ${x + w + 7},${y - 5} ${x + w + 7},${y + h - 5} ${x + w},${y + h}" fill="${mix(c, '#000', .35)}"/><path d="M${x + w / 3} ${y}v${h}M${x + 2 * w / 3} ${y}v${h}" stroke="#1f2427" stroke-width="1.2"/>`;

      const PR = {
        none: '',
        pile: `<g stroke-width=".5" stroke="#2b2d2f"><rect x="6" y="176" width="30" height="7" rx="1" fill="#8b5a2b" transform="rotate(-6 20 180)"/><rect x="14" y="182" width="26" height="6" rx="1" fill="#4e5357" transform="rotate(8 26 185)"/><rect x="26" y="168" width="22" height="6" rx="1" fill="#9aa0a4" transform="rotate(-25 36 170)"/><rect x="2" y="170" width="20" height="6" rx="1" fill="#b3b8bb" transform="rotate(24 12 173)"/><rect x="40" y="178" width="24" height="7" rx="1" fill="#a0664a" transform="rotate(-12 52 181)"/><rect x="46" y="184" width="22" height="5" rx="1" fill="#7c8286" transform="rotate(5 56 186)"/></g><circle cx="22" cy="166" r="5" fill="none" stroke="#9aa0a4" stroke-width="2.4"/><circle cx="52" cy="170" r="4.5" fill="none" stroke="#a0664a" stroke-width="2"/><circle cx="8" cy="186" r="4" fill="none" stroke="#6e4a2a" stroke-width="2"/>`,
        bags: `<ellipse cx="22" cy="177" rx="16" ry="13" fill="#1c2126"/><path d="M19 165l3-6 3 6z" fill="#2d333b"/><ellipse cx="46" cy="180" rx="15" ry="11" fill="#262c33"/><path d="M43 170l3-5 3 5z" fill="#3a414a"/><ellipse cx="34" cy="165" rx="12" ry="10" fill="#14181c"/><path d="M14 172q6-6 12-3M40 175q6-5 10-2" stroke="#fff" stroke-opacity=".2" stroke-width="1.5" fill="none"/>`,
        sacks: `<ellipse cx="22" cy="177" rx="16" ry="13" fill="#9e754f"/><path d="M19 165l3-6 3 6z" fill="#7d5939"/><ellipse cx="46" cy="180" rx="15" ry="11" fill="#a47b53"/><path d="M43 170l3-5 3 5z" fill="#845e3a"/><ellipse cx="34" cy="165" rx="12" ry="10" fill="#8e6743"/><path d="M14 176q8 4 16 0M38 180q7 3 14 0" stroke="#5f4228" stroke-opacity=".5" fill="none"/>`,
        bales3: bale(8, 166, 28, 24, '#8c969a') + bale(38, 166, 28, 24, '#8c969a') + bale(22, 142, 28, 24, '#9aa6ae'),
        factory: `<g id="scrapYardBuilding">
          <ellipse cx="-8" cy="22" rx="96" ry="16" fill="#000" opacity="0.65"/>
          <ellipse cx="-8" cy="22" rx="86" ry="12" fill="#ff4838" opacity="0.22" filter="url(#f-glow-red)"/>
          <polygon points="-78,22 62,22 86,10 62,2 -78,2" fill="#2f1614" stroke="#ff6b55" stroke-opacity="0.5" stroke-width="1.2"/>
          <rect x="36" y="-105" width="14" height="65" fill="#52231c" stroke="#873e33" stroke-width="1.2"/>
          <rect x="34" y="-108" width="18" height="6" fill="#873e33"/>
          <rect x="36" y="-90" width="14" height="6" fill="#f59e0b" opacity="0.95"/>
          <rect x="36" y="-76" width="14" height="6" fill="#f59e0b" opacity="0.95"/>
          <circle cx="43" cy="-112" r="4" fill="#ff4838" filter="url(#f-glow-red)">
            <animate attributeName="opacity" values="0.3;1;0.3" dur="1.4s" repeatCount="indefinite"/>
          </circle>
          <polygon points="-70,20 38,20 38,-56 -70,-56" fill="#46211c" stroke="#ff8c7a" stroke-width="1.5"/>
          <polygon points="38,20 68,6 68,-70 38,-56" fill="#28110f" stroke="#ff7c6b" stroke-opacity="0.7" stroke-width="1.2"/>
          <g stroke="#ffa394" stroke-opacity="0.32" stroke-width="1">
            <line x1="-54" y1="-56" x2="-54" y2="20"/><line x1="-38" y1="-56" x2="-38" y2="20"/><line x1="-22" y1="-56" x2="-22" y2="20"/><line x1="-6" y1="-56" x2="-6" y2="20"/><line x1="10" y1="-56" x2="10" y2="20"/><line x1="26" y1="-56" x2="26" y2="20"/>
          </g>
          <polygon points="-78,-56 -42,-84 72,-68 38,-56" fill="#753026" stroke="#ffb8aa" stroke-width="1.6"/>
          <polygon points="-78,-56 -42,-84 -42,-56" fill="#58241d"/>
          <path d="M-42 -84L-78 -56M72 -68L38 -56" stroke="#ffc5b8" stroke-width="1.8"/>
          <rect x="-65" y="-50" width="94" height="17" rx="3" fill="#140605" stroke="#ff4838" stroke-width="1.5" filter="url(#f-glow-red)"/>
          <text x="-18" y="-38" text-anchor="middle" font-family="var(--font-body), Arial, sans-serif" font-weight="900" font-size="9" fill="#ffcec7" letter-spacing="0.6">SCRAP YARD</text>
          <rect x="-60" y="-24" width="46" height="44" rx="2" fill="#180a08" stroke="#ff5035" stroke-width="1.5"/>
          <g stroke="#ff7c6b" stroke-opacity="0.7" stroke-width="1.2">
            <line x1="-60" y1="-16" x2="-14" y2="-16"/><line x1="-60" y1="-8" x2="-14" y2="-8"/><line x1="-60" y1="0" x2="-14" y2="0"/><line x1="-60" y1="8" x2="-14" y2="8"/><line x1="-60" y1="16" x2="-14" y2="16"/>
          </g>
          <rect x="-60" y="-30" width="46" height="6" fill="#f59e0b"/>
          <path d="M-58 -24L-54 -30M-50 -24L-46 -30M-42 -24L-38 -30M-34 -24L-30 -30M-26 -24L-22 -30M-18 -24L-14 -30" stroke="#1c1917" stroke-width="2"/>
          <rect x="-6" y="-18" width="40" height="38" rx="2" fill="#321512" stroke="#ff7c6b" stroke-opacity="0.8" stroke-width="1.2"/>
          <rect x="2" y="-12" width="24" height="18" rx="2" fill="#ffd23f" filter="drop-shadow(0 0 8px #ff9800)" opacity="0.95"/>
          <line x1="14" y1="-12" x2="14" y2="6" stroke="#321512" stroke-width="1.5"/>
          <line x1="2" y1="-3" x2="26" y2="-3" stroke="#321512" stroke-width="1.5"/>

        </g>`
      };

      function arm(side, a1, a2, c, l1 = 24, l2 = 26) {
        const sx = side === 'L' ? 67.6 : 100.4,
          sy = 61,
          r = d => d * Math.PI / 180;
        const ex = sx + l1 * Math.sin(r(a1)),
          ey = sy + l1 * Math.cos(r(a1));
        const hx_ = ex + l2 * Math.sin(r(a2)),
          hy = ey + l2 * Math.cos(r(a2));
        return {
          h: [hx_, hy],
          g: `<g class="${side === 'L' ? 'fa0' : 'fa'}" style="transform-origin:${sx}px ${sy}px"><path d="M${sx} ${sy}L${ex} ${ey}" stroke="url(#${c.i}sh)" stroke-width="11.5" stroke-linecap="round" fill="none"/><path d="M${ex} ${ey}L${hx_} ${hy}" stroke="url(#${c.i}sk)" stroke-width="8.5" stroke-linecap="round" fill="none"/><circle cx="${hx_}" cy="${hy}" r="4.6" fill="url(#${c.i}sk)"/></g>`
        };
      }

      function head(c) {
        const k = c.skin,
          hair = c.hair || '#2a1f18';
        let h = `<g class="fh" style="transform-origin:84px 48px">` +
          `<ellipse cx="74.7" cy="34.5" rx="2.1" ry="3.3" fill="${k}"/><ellipse cx="93.3" cy="34.5" rx="2.1" ry="3.3" fill="${mix(k, '#000', .06)}"/>` +
          `<path d="M74.7 30C74.4 39.5 77.8 46.4 84 46.8C90.2 46.4 93.6 39.5 93.3 30C93 21.5 88.6 21.4 84 21.4C79.4 21.4 75 21.5 74.7 30Z" fill="url(#${c.i}fr)"/>` +
          `<ellipse cx="78.8" cy="38" rx="1.8" ry="1.1" fill="#d9776a" opacity=".2"/><ellipse cx="89.2" cy="38" rx="1.8" ry="1.1" fill="#d9776a" opacity=".2"/>`;
        [80.1, 87.3].forEach(x => {
          h += `<ellipse cx="${x}" cy="33" rx="1.75" ry="1.05" fill="#f4ede4"/><circle cx="${x + .1}" cy="33.05" r=".85" fill="#3a2314"/><circle cx="${x - .1}" cy="32.75" r=".28" fill="#fff"/>`;
        });
        h += `<path d="M84.4 34.5Q85.6 37.6 85.2 38.8Q84 39.4 82.6 38.8" stroke="${mix(k, '#000', .35)}" stroke-width=".6" fill="none"/>` +
          `<path d="M81.4 42Q84 43.4 86.6 42" stroke="${mix(k, '#000', .45)}" stroke-width=".8" fill="none" stroke-linecap="round"/>`;
        if (c.beard) h += `<path d="M79.8 41C81.2 39.6 83 39.8 84 40.3C85 39.8 86.8 39.6 88.2 41C86.4 40.6 85 40.9 84 41C83 40.9 81.6 40.6 79.8 41Z" fill="${mix(hair, '#ffffff', .1)}" opacity=".85"/>`;
        h += `<path d="M74.6 27C74 19 79 16.6 84.2 16.8C89.6 16.6 94.2 19 93.6 27C91 22.4 88 20.6 84 20.6C80 20.6 77.2 22.4 74.6 27Z" fill="${hair}"/>` +
          `<path d="M78 19.4Q83 17.6 88 18.8" stroke="#fff" stroke-opacity=".2" fill="none"/>`;
        if (c.hat === 'cap') h += `<path d="M74 28.5C73.6 18.5 79.6 16.4 84 16.4C88.4 16.4 94.4 18.5 94 28.5Z" fill="url(#${c.i}hat)"/><path d="M73.6 28.2Q88 27 100.5 29.2Q101 31.4 96 31.4Q84 30.2 73.6 30Z" fill="#ff4838"/>`;
        if (c.hat === 'helmet') h += `<path d="M73.6 28.6C73.2 16.4 79 13.6 84 13.6C89 13.6 94.8 16.4 94.4 28.6Z" fill="url(#${c.i}hat)"/><path d="M71 28.2Q84 26.4 97 28.2Q97.6 30.4 95 30.6Q84 29.2 73 30.6Q70.4 30.4 71 28.2Z" fill="#dcdcd4"/>`;
        return h + '</g>';
      }

      function fig(c, n) {
        c.i = 'm' + n;
        const i = c.i;
        const armL = arm('L', ...c.L, c),
          armR = arm('R', ...c.R, c);
        let held = '';
        const hold = (a, rot, col) => `<g transform="translate(${a.h[0]} ${a.h[1]}) rotate(${rot})"><rect x="-8" y="-12" width="15" height="20" rx="1.4" fill="${col}"/><rect x="-6.4" y="-9.4" width="11.8" height="15.2" fill="#eef3ee"/><rect x="-3.6" y="-13.4" width="6.2" height="3.2" rx=".9" fill="#a3aca5"/><path d="M-5 -5h8.4M-5 -2h8.4M-5 1h5.6" stroke="#9fb3a5" stroke-width=".8"/></g>`;
        if (c.hold === 'tablet') held = `<g transform="translate(${armL.h[0] + 10} ${armL.h[1] - 6}) rotate(-6)"><rect x="-10" y="-7" width="21" height="14" rx="1.8" fill="#0e1114"/><rect x="-8.7" y="-5.7" width="18.4" height="11.4" fill="#2fbf71"/><path d="M-6 -2.5h9M-6 .3h13M-6 3h6" stroke="#e8fff1" stroke-width=".9"/></g>`;
        if (c.hold === 'clipL') held = hold(armL, -8, '#592019');
        if (c.hold === 'clipR') held = hold(armR, 8, '#592019');
        if (c.hold === 'phone') held = `<rect x="${armR.h[0] - 2}" y="${armR.h[1] - 10}" width="3.6" height="8" rx="1" fill="#101214"/>`;
        const torso = 'M76.5 51.5C71 52.2 65.5 53.2 63.8 58.5C62.8 66 65.8 79 67.8 92L67.7 104L100.3 104L100.2 92C102.2 79 105.2 66 104.2 58.5C102.5 53.2 97 52.2 91.5 51.5Z';
        const plaid = c.plaid ? `<pattern id="${i}pl" width="6" height="6" patternUnits="userSpaceOnUse" patternTransform="rotate(-4)"><rect width="6" height="6" fill="#b8a582"/><rect width="6" height="1.8" fill="#6b4a3a" opacity=".6"/><rect width="1.8" height="6" fill="#6b4a3a" opacity=".6"/></pattern>` : '';
        const sh = c.plaid ? `url(#${i}pl)` : `url(#${i}sh)`;
        const vest = c.vest ? `<path d="M67.8 58.5C66.8 66 69.8 79 71.8 92L71.7 106L84.6 106L84.6 62L80 52.2C75 52.6 69.5 53.6 67.8 58.5Z" fill="#ff7043"/><path d="M108.2 58.5C109.2 66 106.2 79 104.2 92L104.3 106L91.4 106L91.4 62L96 52.2C101 52.6 106.5 53.6 108.2 58.5Z" fill="#ff7043" transform="translate(-4 0)"/><rect x="70.8" y="84" width="27" height="2.8" fill="#e9eef0"/><rect x="70.8" y="94" width="27" height="2.8" fill="#e9eef0"/>` : '';
        return `<defs>${FILTER(i)}${lgr(i + 'sh', c.shirt)}${lgr(i + 'pt', c.pants)}${lgr(i + 'sk', c.skin)}${lgr(i + 'hat', c.hatc || '#fff')}<radialGradient id="${i}fr" cx="81" cy="29" r="15" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="${mix(c.skin, '#fff', .25)}"/><stop offset=".55" stop-color="${c.skin}"/><stop offset="1" stop-color="${mix(c.skin, '#000', .08)}"/></radialGradient>${plaid}</defs>
<ellipse cx="84" cy="187.5" rx="21" ry="3.6" fill="#000" opacity=".55" filter="url(#${i}S)"/>${PR[c.prop]}
<g filter="url(#${i}L)"><g class="fb"><path d="M68.4 102Q67.2 124 70.6 146L71.8 182L80.4 182L81.7 146Q82.8 124 83.6 106Z" fill="url(#${i}pt)"/><path d="M99.6 102Q100.8 124 97.4 146L96.2 182L87.6 182L86.3 146Q85.2 124 84.4 106Z" fill="url(#${i}pt)"/><path d="M71 180.5h9q2.4 0 2.8 3l.4 3.1h-15.3q-1.8 0-1.4-2.1q.8-4 4.5-4z" fill="#2a1d15"/><path d="M88 180.5h9q3.7 0 4.5 4q.4 2.1-1.4 2.1h-15.3l.4-3.1q.4-3 2.8-3z" fill="#2a1d15"/><path d="M68 186.6h15.3M84.7 186.6h15.3" stroke="#756c67" stroke-width=".9"/>
<path d="${torso}" fill="${sh}"/>${c.plaid ? `<path d="${torso}" fill="url(#${i}sh)" opacity=".35"/>` : ''}<path d="M71 70q4 5 5 12M96 72q-3.5 6-4 13" stroke="#000" stroke-opacity=".16" stroke-width=".9" fill="none"/><path d="M100.2 92C102.2 79 105.2 66 104.2 58.5L98 61L96.5 104L100.3 104Z" fill="#000" opacity=".14" filter="url(#${i}S)"/><path d="M68.1 100.4Q84 101.6 99.9 100.4L99.9 104L68.1 104Z" fill="#17120e"/><rect x="81.4" y="100.6" width="5.2" height="3.4" rx=".6" fill="#c8b27a"/><path d="M84.6 60L84.6 100" stroke="#000" stroke-opacity=".3" stroke-width=".7"/>${[64, 73, 82, 91].map(y => `<circle cx="85.8" cy="${y}" r=".7" fill="#fff" opacity=".7"/>`).join('')}${vest}
<path d="M79.4 43L79 53Q84 56 89 53L88.6 43Z" fill="url(#${i}sk)"/><ellipse cx="84.5" cy="46.5" rx="5.2" ry="2.6" fill="#000" opacity=".08" filter="url(#${i}S)"/><path d="M76 51.2L78.6 49.5L84 58.5L81 60.5Z" fill="${mix(c.shirt, '#fff', .25)}"/><path d="M92 51.2L89.4 49.5L84 58.5L87 60.5Z" fill="${mix(c.shirt, '#000', .15)}"/></g>
${armL.g}${held}${armR.g}</g>${head(c)}`;
      }

      const M = [{
          name: 'You',
          skin: '#9a6844',
          shirt: '#b8a582',
          pants: '#2b2f36',
          plaid: 1,
          prop: 'none',
          L: [-5, -4],
          R: [62, -142],
          hold: 'phone'
        },
        {
          name: 'Kabadiwala',
          skin: '#c08a62',
          shirt: '#3f7fbf',
          pants: '#3a3226',
          prop: 'bags',
          hat: 'cap',
          hatc: '#ff4838',
          beard: 1,
          L: [-5, -4],
          R: [35, 105]
        },
        {
          name: 'Local Dealer',
          skin: '#b47d5a',
          shirt: '#d49b6a',
          pants: '#2c2c30',
          prop: 'sacks',
          L: [-14, 62],
          R: [5, 3],
          hold: 'clipL'
        },
        {
          name: 'Aggregator',
          skin: '#8e5d3c',
          shirt: '#383e47',
          pants: '#2a2d33',
          beard: 1,
          hat: 'helmet',
          hatc: '#fff',
          vest: 1,
          prop: 'bales3',
          L: [-14, 62],
          R: [28, 72],
          hold: 'clipL'
        }
      ];

      function el(t, a, h) {
        const e = document.createElementNS(NS, t);
        for (const k in a) e.setAttribute(k, a[k]);
        if (h) e.innerHTML = h;
        return e;
      }
      const pg = $id('people'),
        lg = $id('labels'),
        bg = $id('badges');
      if (!pg || !lg || !bg) return;
      const bd = [],
        hit = [],
        lbs = [];

      function updateStepProgress(side, idx) {
        for (let k = 0; k < 5; k++) {
          const el = document.getElementById(`${side}-st-${k}`);
          if (el) el.classList.toggle('active', k === idx);
        }
      }

      const act = i => {
        lbs.forEach((l, k) => l.classList.toggle('act', k === i));
        updateStepProgress('old', i);
      };

      M.forEach((c, i) => {
        const x = XS[i];
        const g = el('g', {
          transform: `translate(${x},${FY}) scale(${S}) translate(-84,-190)`
        });
        const hg = el('g', {
          class: 'hit'
        });
        const ig = el('g', {
          style: `animation-delay:${-i * .45}s`
        }, fig(c, i));
        hg.appendChild(ig);
        g.appendChild(hg);
        pg.appendChild(g);
        hit.push(hg);

        const ly = 16,
          hh = 32;
        const widths = [84, 128, 132, 124];
        const wd = widths[i] || 110;
        const lb = el('g', {
          class: 'lbl'
        });
        lb.innerHTML = `<line x1="${x}" y1="${ly + hh}" x2="${x}" y2="${FY - S * 180}" stroke="#ff6b55" stroke-opacity=".6" stroke-dasharray="3 4"/>` +
          `<rect x="${x - wd / 2}" y="${ly}" width="${wd}" height="${hh}" rx="16" fill="#251210" stroke="#ff6b55" stroke-width="1.8"/>` +
          `<text x="${x}" y="${ly + 21.5}" text-anchor="middle" font-family="var(--font-body), Arial, sans-serif" font-weight="800" font-size="13" fill="#ffffff">${c.name}</text>`;
        lg.appendChild(lb);
        lbs.push(lb);

        if (i >= 1 && i <= 3) {
          const b = el(
            'g', {
              class: 'cutb',
              transform: `translate(${x}, 108)`
            },
            '<g class="bp">' +
            '<rect x="-65" y="-17" width="130" height="34" rx="17" fill="#dc2626" stroke="#ffa394" stroke-width="1.5" filter="url(#f-glow-red)"/>' +
            '<circle cx="-42" cy="0" r="11" fill="#75130b"/>' +
            '<text x="-42" y="4" fill="#fef08a" font-size="12" font-weight="900" text-anchor="middle" font-family="var(--font-body), Arial, sans-serif">−₹</text>' +
            '<text x="14" y="4.5" fill="#fff" font-size="12.5" font-weight="800" text-anchor="middle" font-family="var(--font-body), Arial, sans-serif">Commission</text>' +
            '</g>'
          );
          bg.appendChild(b);
          bd[i] = b;
        }
      });

      const rvG = el('g', {
        class: 'yard'
      }, `<g transform="translate(${RX}, 384) scale(1.22)">${PR.factory}</g>`);
      pg.appendChild(rvG);
      const rl = el('g', {
        class: 'lbl'
      });
      rl.innerHTML = `<line x1="${RX}" y1="48" x2="${RX}" y2="65" stroke="#ff4838" stroke-opacity=".6" stroke-dasharray="3 4"/>` +
        `<rect x="${RX - 58}" y="16" width="116" height="32" rx="16" fill="#251210" stroke="#ff4838" stroke-width="1.8"/>` +
        `<text x="${RX}" y="37.5" text-anchor="middle" font-family="var(--font-body), Arial, sans-serif" font-weight="800" font-size="13" fill="#ffffff">Scrap Yard</text>`;
      lg.appendChild(rl);
      lbs.push(rl);

      const mg = el('g', {
          class: 'hubfloat'
        },
        '<image href="assets/media/rvsf-ministry.webp" x="773" y="66" width="154" height="154" preserveAspectRatio="xMidYMid meet" filter="drop-shadow(0 6px 16px rgba(0,0,0,0.65))"/>');
      bg.appendChild(mg);

      const coin = $id('coinG'),
        trail = $id('trail'),
        cg = $id('coinsG');
      const yf = $id('youFig');
      if (yf) yf.innerHTML = `<g transform="translate(52 292) scale(0.77) translate(-84 -190)">${fig(Object.assign({}, M[0], { prop: 'none' }), 'y')}</g>`;

      function spawn(i) {
        const n = i % 2 ? 3 : 2;
        const sx = cx,
          sy = cy;
        const chX = XS[i],
          chY = 274;
        const rsX = XS[i] - 56,
          rsY = 388;
        for (let k = 0; k < n; k++) {
          const g = el('g', {
              transform: `translate(${sx},${sy}) scale(.4)`,
              opacity: 0
            },
            '<circle r="9" fill="url(#coin)"/><circle r="6.5" fill="none" stroke="#fff480" stroke-width="1"/><text y="3.5" text-anchor="middle" font-size="9" font-weight="900" fill="#664000" font-family="var(--font-body), Arial, sans-serif">₹</text>');
          cg.appendChild(g);
          setTimeout(async () => {
            await tween(520, t => {
              const e = ease(t);
              g.setAttribute('opacity', 1);
              g.setAttribute('transform', `translate(${sx + (chX - sx) * e},${sy + (chY - sy) * e}) scale(${.4 + .6 * e})`);
            });
            fire(hit[i], 'go');
            await tween(520, t => {
              const e = ease(t);
              g.setAttribute('transform', `translate(${chX + (rsX - chX) * e},${chY + (rsY - chY) * e - Math.sin(Math.PI * t) * 25}) scale(${1 - .6 * e})`);
              g.setAttribute('opacity', 1 - Math.max(0, t - .6) / .4);
            });
            g.remove();
          }, k * 260);
        }
      }

      const sleep = ms => new Promise(r => setTimeout(r, ms));
      const ease = t => t < .5 ? 2 * t * t : 1 - Math.pow(-2 * t + 2, 2) / 2;

      function tween(d, fn) {
        return new Promise(r => {
          const s = performance.now();
          (function f(n) {
            const t = Math.min((n - s) / d, 1);
            fn(t);
            t < 1 ? requestAnimationFrame(f) : r();
          })(s);
        });
      }

      let cx = XS[0],
        cy = CH,
        cs = 1,
        co = 1;
      let carSplit = 0,
        ck = 1,
        carFree = false,
        carX = 0,
        cco = 1,
        cz = 0;
      const carG = el('g', {});
      pg.appendChild(carG);
      const CAR = '<use href="#car" width="100" height="50" style="--car:#b33927"/>';
      const carL = el('g', {}, `<svg x="-50" y="-50" width="50" height="50" viewBox="0 0 50 50">${CAR}</svg>`);
      const carR = el('g', {}, `<svg x="0" y="-50" width="50" height="50" viewBox="50 0 50 50">${CAR}</svg>`);
      const carCut = el('g', {}, '<path d="M0 -62L0 4" stroke="#ff4838" stroke-width="3.5" stroke-dasharray="6 4" stroke-linecap="round"/><path d="M-12 -56L12 -40M12 -56L-12 -40" stroke="#ffd23f" stroke-width="3.5" stroke-linecap="round"/>');
      carG.appendChild(carL);
      carG.appendChild(carR);
      carG.appendChild(carCut);

      function drawCar() {
        const s = carSplit;
        carG.setAttribute('transform', `translate(${carFree ? carX : cx},435) scale(${1.8 * ck})`);
        carG.style.opacity = cco;
        carL.setAttribute('transform', `translate(${-9 * s},${2 * s}) rotate(${-8 * s} -2 0)`);
        carR.setAttribute('transform', `translate(${9 * s},${2 * s}) rotate(${8 * s} 2 0)`);
        carCut.style.opacity = s;
      }

      let ang = 0;

      function put() {
        const zs = cs * (1 + cz * .45);
        coin.setAttribute('transform', `translate(${cx},${cy - cz * 26}) scale(${zs * Math.cos(ang)},${zs})`);
        coin.style.opacity = co;
        const k = 1 + cz * .9;
        csh.setAttribute('cx', cx);
        csh.setAttribute('cy', cy + 16);
        csh.setAttribute('rx', 15 * cs * k);
        csh.setAttribute('ry', 4.5 * cs * k);
        csh.setAttribute('opacity', co * (.15 + cz * .5));
        trail.style.opacity = 0;
        drawCar();
      }

      const wg = el('g', {});
      coin.parentNode.insertBefore(wg, coin);
      const csh = el('ellipse', {
        fill: '#000'
      });
      wg.appendChild(csh);
      const rings = [0, 1, 2].map(() => {
        const e = el('ellipse', {
          fill: 'none',
          stroke: '#ffd23f',
          'stroke-width': 3
        });
        wg.appendChild(e);
        return e;
      });

      (function spin(t) {
        ang = (t / 1000) * Math.PI * 2 / 1.6;
        rings.forEach((e, k) => {
          const p = ((t / 1000 / 1.8) + k / 3) % 1;
          const r = 18 + 60 * p;
          e.setAttribute('cx', cx);
          e.setAttribute('cy', cy + 14);
          e.setAttribute('rx', r);
          e.setAttribute('ry', r * .28);
          e.setAttribute('opacity', co * (1 - p) * .9);
        });
        put();
        requestAnimationFrame(spin);
      })(0);

      function fire(e, c) {
        if (!e) return;
        e.classList.remove(c);
        void e.getBBox();
        e.classList.add(c);
      }
      async function move(axis, to, d, sc) {
        const f = axis === 'x' ? cx : cy,
          s0 = cs,
          s1 = sc == null ? cs : sc;
        await tween(d, t => {
          const e = ease(t);
          if (axis === 'x') cx = f + (to - f) * e;
          else cy = f + (to - f) * e;
          cs = s0 + (s1 - s0) * e;
          put();
        });
      }
      async function give() {
        await tween(280, t => {
          cz = ease(t);
          put();
        });
        await tween(420, t => {
          cz = 1 - ease(t);
          put();
        });
      }

      async function loop() {
        for (;;) {
          bd.forEach(b => b && b.classList.remove('on'));
          cg.innerHTML = '';
          carSplit = 0;
          ck = 1;
          carFree = false;
          cco = 1;
          cz = 0;
          act(0);
          cx = XS[0];
          cy = TR;
          cs = 1;
          co = 1;
          put();
          await sleep(600);
          fire(hit[0], 'go');
          await sleep(350);

          for (let i = 1; i < 4; i++) {
            await move('x', XS[i], 900, 1 - i * .1);
            act(i);
            fire(hit[i], 'go');
            give();
            bd[i].classList.add('on');
            spawn(i);
            await sleep(1300);
          }

          const x1 = cx;
          await tween(1000, t => {
            const e = ease(t);
            cx = x1 + (CUT - x1) * e;
            cs = .7 - .1 * e;
            put();
          });
          act(4);
          fire(rvG, 'go');
          await sleep(300);

          await tween(800, t => {
            carSplit = ease(t);
            put();
          });
          await sleep(600);
          await tween(500, t => {
            co = 1 - t;
            put();
          });
          act(-1);

          carFree = true;
          carX = cx;
          const x0 = carX;
          await tween(1200, t => {
            const e = ease(t);
            carX = x0 + (RX - x0) * e;
            ck = 1 - .45 * e;
            put();
          });
          fire(rvG, 'go');
          await tween(600, t => {
            cco = 1 - t;
            put();
          });
          await sleep(900);

          carFree = false;
          cx = XS[0];
          cs = 1;
          carSplit = 0;
          ck = 1;
          co = 0;
          cco = 0;
          put();
          await sleep(300);
          await tween(500, t => {
            co = t;
            cco = t;
            put();
          });
        }
      }
      loop();
    })();

    // Motozo Flow: Currency Notes & Scrap Certificate
    (function() {
      const path = 'M500 262Q300 150 98 292',
        f = v => v.toFixed(2);
      let n = '';
      [.58, .62, .66, .69].forEach((a, i) => {
        const b = a + .11,
          cert = i === 3;
        n += `<g><animateMotion dur="14s" repeatCount="indefinite" calcMode="linear" keyPoints="0;0;1;1" keyTimes="0;${f(a)};${f(b)};1" path="${path}"/>` +
          `<animate attributeName="opacity" dur="14s" repeatCount="indefinite" keyTimes="0;${f(a)};${f(a + .01)};${f(b)};${f(b + .01)};1" values="0;0;1;1;0;0"/>` +
          (cert ? `<circle r="16" fill="#fff" filter="drop-shadow(0 0 8px #7df0ad)"/><use class="ic2" href="#i-cert" x="-9" y="-9" width="18" height="18" style="color:#0e6e3e"/>` :
            `<use href="#note" x="-18" y="-9.6" width="36" height="19.2"/>`) + `</g>`;
      });
      const pf = document.getElementById('payFlow');
      if (pf) pf.innerHTML = n;
    })();

    // Motozo Labels & Step Trackers
    (function() {
      const g = document.getElementById('mzLabels');
      if (!g) return;
      const D = '#0E6E3E',
        Y = '#7df0ad';
      const mk = (iv, on, off) => {
        let t = [0],
          v = [off];
        iv.forEach(([s, e]) => {
          t.push(s, e);
          v.push(on, off);
        });
        t.push(1);
        v.push(off);
        return `keyTimes="${t.join(';')}" values="${v.join(';')}"`;
      };

      const L = [
        ['You', 72, 70, 112, [
          [.001, .14],
          [.76, .89]
        ]],
        ['Motozo Hub', 300, 110, 136, [
          [.14, .34]
        ]],
        ['Authorized RVSF', 520, 180, 58, [
          [.57, .8],
          [.82, .985]
        ]]
      ];

      g.innerHTML = L.map(([n, x, w, ly, iv]) =>
        `<line x1="${x}" y1="34" x2="${x}" y2="${ly}" stroke="${Y}" stroke-opacity=".5" stroke-dasharray="4 5"/>` +
        `<rect x="${x - w / 2}" y="6" width="${w}" height="${28}" rx="14" fill="${D}" stroke="${Y}" stroke-width="1.6"><animate attributeName="fill" dur="14s" repeatCount="indefinite" calcMode="discrete" ${mk(iv, Y, D)}/></rect>` +
        `<text x="${x}" y="25" text-anchor="middle" font-family="var(--font-body), Arial, sans-serif" font-weight="800" font-size="12.5" fill="#fff"><animate attributeName="fill" dur="14s" repeatCount="indefinite" calcMode="discrete" ${mk(iv, '#05331c', '#fff')}/>${n}</text>`
      ).join('');

      function syncMotozoStepTracker() {
        const now = (Date.now() % 14000) / 14000;
        let activeIdx = 0;
        if (now < 0.14) activeIdx = 0;
        else if (now < 0.37) activeIdx = 1;
        else if (now < 0.76) activeIdx = 2;
        else activeIdx = 3;

        for (let k = 0; k < 4; k++) {
          const el = document.getElementById(`new-st-${k}`);
          if (el) el.classList.toggle('active', k === activeIdx);
        }
        requestAnimationFrame(syncMotozoStepTracker);
      }
      syncMotozoStepTracker();
    })();

    // Perspective 3D Grid Generation
    (function() {
      const T = 360,
        B = 530,
        H = B - T;
      let d = '';
      for (let i = 0; i <= 8; i++) {
        const t = i / 8;
        d += `M${125 + 750 * t} ${T}L${12 + 976 * t} ${B}`;
      }
      [.1, .22, .38, .59, .86].forEach(k => {
        const y = T + H * k,
          off = 113 * k;
        d += `M${125 - off} ${y}H${875 + off}`;
      });
      const gridEl = document.getElementById('grid');
      if (gridEl) gridEl.setAttribute('d', d);
    })();
  })();
</script>