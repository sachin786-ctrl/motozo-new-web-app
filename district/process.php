<?php
/**
 * ============================================================================
 * DISTRICT BENEFITS COMPONENT (v4): district/benefits.php
 * Scroll-progress timeline - alternating content + mini dashboard visuals
 * Self-Contained: HTML + CSS + JS (Bootstrap Icons required)
 * ============================================================================
 */
declare(strict_types=1);

$cityName     = $districtData['name'] ?? ($districtName ?? 'District');
$districtSlug = $districtData['slug'] ?? ($districtSlug ?? 'delhi');
$city         = htmlspecialchars((string)$cityName, ENT_QUOTES, 'UTF-8');

$bzEyebrow = $districtData['benefits']['eyebrow'] ?? 'Complete Advantages';
$bzTitle   = $districtData['benefits']['title'] ?? ('Financial &amp; Legal Benefits in <span>' . $city . '</span>');
$bzSub     = $districtData['benefits']['sub'] ?? ('Scrapping your vehicle with a registered authorized facility in ' . $city . ' offers significant monetary, legal, and eco-friendly advantages.');
$bzFoot    = $districtData['benefits']['footer_note'] ?? ('Scrap valuation depends on vehicle condition, total weight, current metal indexes, and ' . $city . ' RTO policies.');

$bzRows = $districtData['benefits']['rows'] ?? [];

// Row 1
$r1Tag  = $bzRows[0]['tag']   ?? 'Value &amp; Savings';
$r1H    = $bzRows[0]['title'] ?? 'Monetary Benefits';
$r1P    = $bzRows[0]['desc']  ?? ('Maximize returns on your old vehicle through transparent metal valuation and official government incentives tailored for ' . $city . ' residents.');
$r1List = $bzRows[0]['list']  ?? [
  ['bi-cash-coin', 'Get up to 4-6% scrap value based on weight &amp; metal rates'],
  ['bi-file-earmark-text', 'Official Certificate of Deposit (CoD) for brand new car discounts'],
  ['bi-percent', 'Up to 25% waiver on road tax for new vehicle purchases'],
  ['bi-bank2', 'Instant bank transfer via secure digital payment before pickup'],
];
$r1Note = $bzRows[0]['note']  ?? 'You can easily trade or transfer your CoD with any automobile manufacturer for additional price concessions!';

// Row 2
$r2Tag  = $bzRows[1]['tag']   ?? '100% Secure';
$r2H    = $bzRows[1]['title'] ?? 'Legal Protection';
$r2P    = $bzRows[1]['desc']  ?? 'Safeguard yourself completely from future liabilities, traffic challans, and unlawful misuse associated with abandoned or end-of-life vehicles.';
$r2List = $bzRows[1]['list']  ?? [
  ['bi-key', 'Complete liability discharge immediately upon vehicle handover'],
  ['bi-shield-slash', 'Absolute protection from heavy penalties for illegal roadside scrappers'],
  ['bi-server', 'Permanent VAHAN database RC de-registration from RTO records'],
  ['bi-patch-check-fill', 'Fully compliant with strict MoRTH and government RVSF guidelines'],
];
$r2Note = $bzRows[1]['note']  ?? '<strong>Warning:</strong> Local unauthorized scrappers lack valid licenses and leave your RC active in government portals!';

// Row 3
$r3Tag  = $bzRows[2]['tag']   ?? 'Eco-Friendly';
$r3H    = $bzRows[2]['title'] ?? 'Environmental Benefits';
$r3P    = $bzRows[2]['desc']  ?? ('Contribute actively to a cleaner, greener ' . $city . ' by ensuring scientific recycling and hazardous fluid neutralization.');
$r3List = $bzRows[2]['list']  ?? [
  ['bi-droplet-half', 'Safe, eco-friendly disposal of toxic fluids, oils, and batteries'],
  ['bi-recycle', 'Advanced material recycling recovering up to 90% of vehicle components'],
  ['bi-wind', 'Direct reduction in urban carbon footprints by taking polluters off-road'],
  ['bi-globe2', "Active contribution to India's expanding sustainable circular economy"],
];
$r3Note = $bzRows[2]['note']  ?? 'Our processing units strictly follow green compliance guidelines for zero toxic leakage.';
?>

<section class="d-bz" id="benefits" aria-labelledby="d-bz-heading">
  <div class="container">

    <header class="d-bz-head" data-bz-reveal>
      <span class="d-bz-eyebrow"><i class="bi bi-compass" aria-hidden="true"></i> <?= htmlspecialchars($bzEyebrow, ENT_QUOTES, 'UTF-8') ?></span>
      <h2 class="d-bz-title" id="d-bz-heading">
        <?= $bzTitle ?>
      </h2>
      <p class="d-bz-sub">
        <?= $bzSub ?>
      </p>
    </header>

    <div class="d-bz-rows" id="d-bz-rows">
      <span class="d-bz-line" aria-hidden="true"><span class="d-bz-line-fill"></span></span>

      <!-- ================= 01 MONETARY ================= -->
      <div class="d-bz-row" data-bz-reveal>
        <div class="d-bz-dot" aria-hidden="true"><i class="bi bi-currency-rupee"></i></div>

        <div class="d-bz-copy">
          <span class="d-bz-num" aria-hidden="true">01</span>
          <span class="d-bz-tag"><?= $r1Tag ?></span>
          <h3 class="d-bz-h"><?= $r1H ?></h3>
          <p class="d-bz-p"><?= $r1P ?></p>

          <ul class="d-bz-list">
            <?php foreach ($r1List as $item): ?>
              <?php 
                $ico = is_array($item) ? ($item[0] ?? 'bi-check-circle') : 'bi-check-circle';
                $txt = is_array($item) ? ($item[1] ?? '') : (string)$item;
              ?>
              <li><span class="d-bz-li-ico"><i class="bi <?= htmlspecialchars($ico, ENT_QUOTES, 'UTF-8') ?>" aria-hidden="true"></i></span><span><?= $txt ?></span></li>
            <?php endforeach; ?>
          </ul>

          <div class="d-bz-note d-bz-note--tip" role="note">
            <i class="bi bi-lightbulb" aria-hidden="true"></i>
            <span><?= $r1Note ?></span>
          </div>
        </div>

        <div class="d-bz-vis">
          <div class="d-bz-card">
            <div class="d-bz-card-top">
              <span><i class="bi bi-wallet2" aria-hidden="true"></i> Your Scrap Benefits</span>
              <em class="d-bz-live">Instant</em>
            </div>
            <div class="d-bz-metrics">
              <div class="d-bz-metric">
                <strong><span data-count="4">4</span>–<span data-count="6">6</span><small>%</small></strong>
                <span>Scrap value</span>
              </div>
              <div class="d-bz-metric d-bz-metric--hi">
                <strong><span data-count="25">25</span><small>%</small></strong>
                <span>Road tax waiver</span>
              </div>
            </div>
            <ul class="d-bz-status">
              <li style="--k:0"><i class="bi bi-check-lg" aria-hidden="true"></i> Certificate of Deposit issued</li>
              <li style="--k:1"><i class="bi bi-check-lg" aria-hidden="true"></i> Paid by secure bank transfer</li>
              <li style="--k:2"><i class="bi bi-check-lg" aria-hidden="true"></i> Paid before vehicle pickup</li>
            </ul>
          </div>
        </div>
      </div>

      <!-- ================= 02 LEGAL ================= -->
      <div class="d-bz-row d-bz-row--flip" data-bz-reveal>
        <div class="d-bz-dot" aria-hidden="true"><i class="bi bi-shield-check"></i></div>

        <div class="d-bz-copy">
          <span class="d-bz-num" aria-hidden="true">02</span>
          <span class="d-bz-tag"><?= $r2Tag ?></span>
          <h3 class="d-bz-h"><?= $r2H ?></h3>
          <p class="d-bz-p"><?= $r2P ?></p>

          <ul class="d-bz-list">
            <?php foreach ($r2List as $item): ?>
              <?php 
                $ico = is_array($item) ? ($item[0] ?? 'bi-shield-check') : 'bi-shield-check';
                $txt = is_array($item) ? ($item[1] ?? '') : (string)$item;
              ?>
              <li><span class="d-bz-li-ico"><i class="bi <?= htmlspecialchars($ico, ENT_QUOTES, 'UTF-8') ?>" aria-hidden="true"></i></span><span><?= $txt ?></span></li>
            <?php endforeach; ?>
          </ul>

          <div class="d-bz-note d-bz-note--warn" role="note">
            <i class="bi bi-exclamation-octagon" aria-hidden="true"></i>
            <span><?= $r2Note ?></span>
          </div>
        </div>

        <div class="d-bz-vis">
          <div class="d-bz-card">
            <div class="d-bz-card-top">
              <span><i class="bi bi-card-checklist" aria-hidden="true"></i> RC Status Check</span>
              <em class="d-bz-live">Verified</em>
            </div>
            <div class="d-bz-stamp"><i class="bi bi-shield-fill-check" aria-hidden="true"></i> Protected</div>
            <ul class="d-bz-status">
              <li style="--k:0"><i class="bi bi-check-lg" aria-hidden="true"></i> Liability discharged on handover</li>
              <li style="--k:1"><i class="bi bi-check-lg" aria-hidden="true"></i> RC de-registered on VAHAN</li>
              <li style="--k:2"><i class="bi bi-check-lg" aria-hidden="true"></i> RVSF guidelines followed</li>
            </ul>
            <div class="d-bz-bad">
              <i class="bi bi-x-octagon-fill" aria-hidden="true"></i>
              <span><b>Unauthorized yard</b> RC stays active and liability stays with you</span>
            </div>
          </div>
        </div>
      </div>

      <!-- ================= 03 ENVIRONMENT ================= -->
      <div class="d-bz-row" data-bz-reveal>
        <div class="d-bz-dot" aria-hidden="true"><i class="bi bi-recycle"></i></div>

        <div class="d-bz-copy">
          <span class="d-bz-num" aria-hidden="true">03</span>
          <span class="d-bz-tag"><?= $r3Tag ?></span>
          <h3 class="d-bz-h"><?= $r3H ?></h3>
          <p class="d-bz-p"><?= $r3P ?></p>

          <ul class="d-bz-list">
            <?php foreach ($r3List as $item): ?>
              <?php 
                $ico = is_array($item) ? ($item[0] ?? 'bi-recycle') : 'bi-recycle';
                $txt = is_array($item) ? ($item[1] ?? '') : (string)$item;
              ?>
              <li><span class="d-bz-li-ico"><i class="bi <?= htmlspecialchars($ico, ENT_QUOTES, 'UTF-8') ?>" aria-hidden="true"></i></span><span><?= $txt ?></span></li>
            <?php endforeach; ?>
          </ul>

          <div class="d-bz-note d-bz-note--ok" role="note">
            <i class="bi bi-patch-check" aria-hidden="true"></i>
            <span><?= $r3Note ?></span>
          </div>
        </div>

        <div class="d-bz-vis">
          <div class="d-bz-card">
            <div class="d-bz-card-top">
              <span><i class="bi bi-bar-chart-line" aria-hidden="true"></i> Material Recovery</span>
              <em class="d-bz-live">Eco</em>
            </div>
            <div class="d-bz-meter" role="img" aria-label="Up to 90 percent of vehicle components recovered">
              <div class="d-bz-meter-top">
                <span>Components recycled</span>
                <strong>Up to <span data-count="90">90</span>%</strong>
              </div>
              <div class="d-bz-track"><span class="d-bz-fill" style="--w:90%"></span></div>
            </div>
            <div class="d-bz-chips">
              <span style="--k:0"><i class="bi bi-droplet-half" aria-hidden="true"></i> Toxic fluids</span>
              <span style="--k:1"><i class="bi bi-moisture" aria-hidden="true"></i> Engine oil</span>
              <span style="--k:2"><i class="bi bi-battery-charging" aria-hidden="true"></i> Batteries</span>
            </div>
            <ul class="d-bz-status">
              <li style="--k:3"><i class="bi bi-check-lg" aria-hidden="true"></i> Safe, eco-friendly disposal</li>
              <li style="--k:4"><i class="bi bi-check-lg" aria-hidden="true"></i> Zero toxic leakage compliance</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <p class="d-bz-foot" data-bz-reveal>
      <i class="bi bi-info-circle" aria-hidden="true"></i>
      <?= $bzFoot ?>
    </p>
  </div>
</section>

<style>
  .d-bz {
    --bz-green: #1B692C;
    --bz-mid: #2b8a45;
    --bz-dark: #124a1f;
    --bz-border: #d3e5d9;
    --bz-ink: #172319;
    --bz-text: #52645a;
    --bz-ease: cubic-bezier(.22, .8, .24, 1);
    --p: 0%;

    padding: 5.5rem 0 5rem;
    background: var(--green-50, #f1f8f3);
    overflow: hidden;
  }

  /* ---------- Reveal ---------- */
  .d-bz.is-js [data-bz-reveal] { opacity: 0; transform: translateY(34px); transition: opacity .85s var(--bz-ease), transform .95s var(--bz-ease); }
  .d-bz.is-js [data-bz-reveal].is-in { opacity: 1; transform: none; }

  /* ---------- Header ---------- */
  .d-bz-head { max-width: 800px; margin: 0 auto 4rem; text-align: center; }
  .d-bz-eyebrow {
    display: inline-flex; align-items: center; gap: .5rem; padding: .4rem 1rem; margin-bottom: 1.1rem;
    background: #fff; border: 1px solid var(--bz-border); border-radius: 999px;
    color: var(--bz-green); font-size: .78rem; font-weight: 700; letter-spacing: .12em; text-transform: uppercase;
  }
  .d-bz-title { font-family: var(--font-heading, inherit); font-size: clamp(1.8rem, 2.6vw, 2.6rem); font-weight: 800; line-height: 1.25; letter-spacing: -.02em; color: var(--bz-ink); margin: 0 0 .9rem; }
  .d-bz-title span { color: var(--bz-green); }
  .d-bz-sub { font-family: var(--font-body, inherit); font-size: 1.05rem; line-height: 1.65; color: var(--bz-text); margin: 0; }

  /* ---------- Timeline rows ---------- */
  .d-bz-rows { position: relative; display: grid; gap: 4.5rem; }

  .d-bz-line {
    position: absolute; z-index: 0; top: 30px; bottom: 30px; left: 50%; width: 3px; margin-left: -1.5px;
    background: #d6e6db; border-radius: 3px; overflow: hidden;
  }
  .d-bz-line-fill { display: block; width: 100%; height: var(--p); background: var(--bz-green); border-radius: 3px; transition: height .15s linear; }

  .d-bz-row {
    position: relative; z-index: 1;
    display: grid; grid-template-columns: 1fr 76px 1fr; align-items: center;
  }
  .d-bz-copy { grid-column: 1; grid-row: 1; padding-right: 1.5rem; }
  .d-bz-vis  { grid-column: 3; grid-row: 1; padding-left: 1.5rem; }
  .d-bz-row--flip .d-bz-copy { grid-column: 3; padding-right: 0; padding-left: 1.5rem; }
  .d-bz-row--flip .d-bz-vis  { grid-column: 1; padding-left: 0; padding-right: 1.5rem; }

  /* Row slide direction */
  .d-bz.is-js .d-bz-copy, .d-bz.is-js .d-bz-vis { opacity: 0; transition: opacity .9s ease, transform 1s var(--bz-ease); }
  .d-bz.is-js .d-bz-copy { transform: translateX(-36px); }
  .d-bz.is-js .d-bz-vis  { transform: translateX(36px); transition-delay: .15s; }
  .d-bz.is-js .d-bz-row--flip .d-bz-copy { transform: translateX(36px); }
  .d-bz.is-js .d-bz-row--flip .d-bz-vis  { transform: translateX(-36px); }
  .d-bz.is-js .d-bz-row.is-in .d-bz-copy, .d-bz.is-js .d-bz-row.is-in .d-bz-vis { opacity: 1; transform: none; }

  /* Center dot */
  .d-bz-dot {
    grid-column: 2; grid-row: 1; justify-self: center; align-self: start; margin-top: 6px;
    width: 58px; height: 58px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    background: #fff; border: 3px solid #c3dccb; color: #8aa896; font-size: 1.4rem;
    box-shadow: 0 0 0 8px var(--green-50, #f1f8f3);
    transition: background-color .5s ease, border-color .5s ease, color .5s ease, transform .6s var(--bz-ease);
  }
  .d-bz-row.is-in .d-bz-dot { background: var(--bz-green); border-color: var(--bz-green); color: #fff; transform: scale(1.08); animation: bz-pulse 2.8s ease-out 1.2s 2; }
  @keyframes bz-pulse { 0% { box-shadow: 0 0 0 8px var(--green-50, #f1f8f3), 0 0 0 8px rgba(27, 105, 44, .35); } 100% { box-shadow: 0 0 0 8px var(--green-50, #f1f8f3), 0 0 0 26px rgba(27, 105, 44, 0); } }

  /* ---------- Copy ---------- */
  .d-bz-num { display: block; font-family: var(--font-heading, inherit); font-size: 4.5rem; font-weight: 800; line-height: .9; letter-spacing: -.04em; color: var(--green-700); margin-bottom: .35rem; }
  .d-bz-tag { display: inline-block; padding: .3rem .8rem; margin-bottom: .8rem; border-radius: 999px; background: #fff; border: 1px solid var(--bz-border); color: var(--bz-green); font-size: .72rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; }
  .d-bz-h { font-family: var(--font-heading, inherit); font-size: clamp(1.5rem, 2.2vw, 2rem); font-weight: 800; letter-spacing: -.01em; color: var(--bz-ink); margin: 0 0 .65rem; line-height: 1.2; }
  .d-bz-p { font-family: var(--font-body, inherit); font-size: .97rem; line-height: 1.7; color: var(--bz-text); margin: 0 0 1.4rem; }

  .d-bz-list { list-style: none; margin: 0 0 1.4rem; padding: 0; display: grid; gap: .8rem; }
  .d-bz-list li { display: flex; gap: .8rem; align-items: flex-start; font-size: .92rem; line-height: 1.5; font-weight: 500; color: #2c3e35; }
  .d-bz-li-ico {
    flex: 0 0 auto; width: 36px; height: 36px; border-radius: 11px; display: inline-flex; align-items: center; justify-content: center;
    background: #fff; border: 1px solid var(--bz-border); color: var(--bz-green); font-size: 1.02rem;
    transition: background-color .3s ease, color .3s ease, transform .45s var(--bz-ease), border-color .3s ease;
  }
  .d-bz-list li:hover .d-bz-li-ico { background: var(--bz-green); color: #fff; border-color: var(--bz-green); transform: translateX(3px) scale(1.06); }
  .d-bz-list li > span:last-child { padding-top: .35rem; }

  .d-bz-note { display: flex; gap: .7rem; align-items: flex-start; padding: .95rem 1.1rem; border-radius: 14px; font-size: .85rem; line-height: 1.55; border: 1px solid transparent; }
  .d-bz-note i { font-size: 1.1rem; flex: 0 0 auto; margin-top: 1px; }
  .d-bz-note--tip  { background: #fffbea; border-color: #f4e5a8; color: #75590a; }
  .d-bz-note--tip i { color: #d99a00; }
  .d-bz-note--warn { background: #fff4f4; border-color: #f3caca; color: #8c1f1f; }
  .d-bz-note--warn i { color: #d32f2f; }
  .d-bz-note--ok   { background: #fff; border-color: var(--bz-border); color: var(--bz-dark); }
  .d-bz-note--ok i { color: var(--bz-green); }

  /* ---------- Visual card ---------- */
  .d-bz-card {
    position: relative; background: #fff; border: 1px solid var(--bz-border); border-radius: 24px; padding: 1.4rem 1.5rem 1.5rem;
    box-shadow: 0 18px 46px rgba(27, 105, 44, .1);
    transition: transform .5s var(--bz-ease), box-shadow .5s ease;
  }
  .d-bz-card:hover { transform: translateY(-6px); box-shadow: 0 26px 56px rgba(27, 105, 44, .17); }
  .d-bz-card::after { /* soft offset layer */
    content: ""; position: absolute; z-index: -1; inset: 14px -14px -14px 14px; border-radius: 24px; background: #dcecdf; opacity: .7;
  }
  .d-bz-row--flip .d-bz-card::after { inset: 14px 14px -14px -14px; }

  .d-bz-card-top { display: flex; justify-content: space-between; align-items: center; gap: 1rem; padding-bottom: 1rem; margin-bottom: 1.2rem; border-bottom: 1px dashed var(--bz-border); }
  .d-bz-card-top > span { display: inline-flex; align-items: center; gap: .55rem; font-weight: 700; font-size: .95rem; color: var(--bz-ink); }
  .d-bz-card-top > span i { width: 32px; height: 32px; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; background: var(--green-50, #f1f8f3); color: var(--bz-green); }
  .d-bz-live { font-style: normal; display: inline-flex; align-items: center; gap: .4rem; padding: .22rem .65rem; border-radius: 999px; background: #e9f7ee; color: var(--bz-green); font-size: .7rem; font-weight: 800; letter-spacing: .08em; text-transform: uppercase; }
  .d-bz-live::before { content: ""; width: 7px; height: 7px; border-radius: 50%; background: #22a24a; animation: bz-blink 1.6s ease-in-out infinite; }
  @keyframes bz-blink { 50% { opacity: .25; } }

  /* metrics */
  .d-bz-metrics { display: grid; grid-template-columns: 1fr 1fr; gap: .85rem; margin-bottom: 1.2rem; }
  .d-bz-metric { padding: 1rem 1.1rem; border-radius: 16px; background: var(--green-50, #f1f8f3); border: 1px solid var(--bz-border); }
  .d-bz-metric strong { display: block; font-family: var(--font-heading, inherit); font-size: clamp(1.8rem, 3vw, 2.4rem); font-weight: 800; line-height: 1; letter-spacing: -.03em; color: var(--bz-green); font-variant-numeric: tabular-nums; }
  .d-bz-metric strong small { font-size: .5em; margin-left: 2px; }
  .d-bz-metric > span { display: block; margin-top: .45rem; font-size: .8rem; color: var(--bz-text); font-weight: 600; }
  .d-bz-metric--hi { background: var(--bz-green); border-color: var(--bz-green); }
  .d-bz-metric--hi strong, .d-bz-metric--hi > span { color: #fff; }
  .d-bz-metric--hi > span { opacity: .85; }

  /* status list */
  .d-bz-status { list-style: none; margin: 0; padding: 0; display: grid; gap: .65rem; }
  .d-bz-status li { display: flex; align-items: center; gap: .65rem; font-size: .88rem; font-weight: 600; color: #2c3e35; }
  .d-bz-status li i { flex: 0 0 auto; width: 24px; height: 24px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; background: var(--bz-green); color: #fff; font-size: .8rem; }
  .d-bz.is-js .d-bz-status li { opacity: 0; transform: translateX(-10px); }
  .d-bz.is-js .d-bz-status li i { transform: scale(0); }
  .d-bz.is-js .d-bz-row.is-in .d-bz-status li {
    opacity: 1; transform: none;
    transition: opacity .5s ease, transform .6s var(--bz-ease); transition-delay: calc(.7s + var(--k, 0) * .18s);
  }
  .d-bz.is-js .d-bz-row.is-in .d-bz-status li i { transform: scale(1); transition: transform .5s cubic-bezier(.34, 1.56, .64, 1); transition-delay: calc(.85s + var(--k, 0) * .18s); }

  /* legal stamp */
  .d-bz-stamp {
    display: inline-flex; align-items: center; gap: .6rem; margin-bottom: 1.2rem; padding: .7rem 1.2rem; border-radius: 14px;
    background: var(--bz-green); color: #fff; font-weight: 800; font-size: 1.05rem; letter-spacing: .12em; text-transform: uppercase;
    box-shadow: 0 10px 22px rgba(27, 105, 44, .28);
  }
  .d-bz-stamp i { font-size: 1.3rem; }
  .d-bz.is-js .d-bz-stamp { opacity: 0; transform: scale(1.5) rotate(-6deg); }
  .d-bz.is-js .d-bz-row.is-in .d-bz-stamp { opacity: 1; transform: rotate(-2deg); transition: opacity .4s ease .5s, transform .7s cubic-bezier(.34, 1.56, .64, 1) .5s; }

  .d-bz-bad { display: flex; gap: .65rem; align-items: flex-start; margin-top: 1.1rem; padding: .85rem 1rem; border-radius: 12px; background: #fff4f4; border: 1px solid #f3caca; color: #8c1f1f; font-size: .82rem; line-height: 1.5; }
  .d-bz-bad i { color: #d32f2f; font-size: 1.05rem; margin-top: 1px; flex: 0 0 auto; }
  .d-bz-bad b { display: block; font-weight: 800; }

  /* eco meter + chips */
  .d-bz-meter { margin-bottom: 1.2rem; }
  .d-bz-meter-top { display: flex; justify-content: space-between; align-items: baseline; gap: 1rem; margin-bottom: .55rem; font-size: .88rem; font-weight: 600; color: var(--bz-text); }
  .d-bz-meter-top strong { font-family: var(--font-heading, inherit); font-size: 1.3rem; font-weight: 800; color: var(--bz-green); font-variant-numeric: tabular-nums; }
  .d-bz-track { height: 14px; border-radius: 999px; background: #e3efe7; overflow: hidden; }
  .d-bz-fill { display: block; height: 100%; width: var(--w, 90%); border-radius: 999px; background: var(--bz-green); transform-origin: left center; }
  .d-bz.is-js .d-bz-fill { transform: scaleX(0); }
  .d-bz.is-js .d-bz-row.is-in .d-bz-fill { transform: scaleX(1); transition: transform 1.6s var(--bz-ease) .6s; }

  .d-bz-chips { display: flex; flex-wrap: wrap; gap: .5rem; margin-bottom: 1.2rem; }
  .d-bz-chips span { display: inline-flex; align-items: center; gap: .4rem; padding: .4rem .8rem; border-radius: 999px; background: var(--green-50, #f1f8f3); border: 1px solid var(--bz-border); color: var(--bz-dark); font-size: .8rem; font-weight: 600; }
  .d-bz-chips i { color: var(--bz-green); }
  .d-bz.is-js .d-bz-chips span { opacity: 0; transform: translateY(8px); }
  .d-bz.is-js .d-bz-row.is-in .d-bz-chips span { opacity: 1; transform: none; transition: opacity .5s ease, transform .6s var(--bz-ease); transition-delay: calc(.8s + var(--k, 0) * .12s); }

  /* ---------- Footnote ---------- */
  .d-bz-foot { display: flex; gap: .55rem; align-items: flex-start; justify-content: center; max-width: 760px; margin: 4rem auto 0; padding: .8rem 1.25rem; background: #fff; border: 1px solid var(--bz-border); border-radius: 14px; font-size: .88rem; line-height: 1.5; color: var(--bz-text); }
  .d-bz-foot i { color: var(--bz-green); margin-top: 2px; }

  /* ---------- Responsive ---------- */
  @media (max-width: 991.98px) {
    .d-bz { padding: 4rem 0 3.5rem; }
    .d-bz-head { margin-bottom: 3rem; }
    .d-bz-rows { gap: 3.5rem; }
    .d-bz-line { left: 22px; margin-left: -1.5px; }
    .d-bz-row { grid-template-columns: 44px 1fr; column-gap: 1.1rem; align-items: start; }
    .d-bz-dot { grid-column: 1; grid-row: 1 / span 2; width: 44px; height: 44px; font-size: 1.1rem; margin-top: 0; box-shadow: 0 0 0 6px var(--green-50, #f1f8f3); }
    .d-bz-copy, .d-bz-row--flip .d-bz-copy { grid-column: 2; grid-row: 1; padding: 0 0 1.75rem; }
    .d-bz-vis, .d-bz-row--flip .d-bz-vis { grid-column: 2; grid-row: 2; padding: 0 14px 0 0; }
    .d-bz-card::after, .d-bz-row--flip .d-bz-card::after { inset: 12px -10px -12px 10px; }
    .d-bz-num { font-size: 3.5rem; }
    .d-bz.is-js .d-bz-copy, .d-bz.is-js .d-bz-vis,
    .d-bz.is-js .d-bz-row--flip .d-bz-copy, .d-bz.is-js .d-bz-row--flip .d-bz-vis { transform: translateY(26px); }
  }

  @media (max-width: 575.98px) {
    .d-bz { padding: 2.75rem 0 2.25rem; }
    .d-bz-head { margin-bottom: 2rem; }
    .d-bz-eyebrow { font-size: .7rem; padding: .3rem .75rem; margin-bottom: .7rem; }
    .d-bz-title { font-size: clamp(1.35rem, 5.8vw, 1.75rem); line-height: 1.25; margin-bottom: .6rem; }
    .d-bz-sub { font-size: .86rem; line-height: 1.5; }
    .d-bz-num { font-size: 2.5rem; margin-bottom: .2rem; }
    .d-bz-tag { font-size: .68rem; padding: .2rem .55rem; }
    .d-bz-h { font-size: 1.25rem; margin-bottom: .5rem; }
    .d-bz-p { font-size: .86rem; line-height: 1.5; margin-bottom: 1rem; }
    .d-bz-list li { font-size: .82rem; line-height: 1.4; gap: .55rem; }
    .d-bz-note { font-size: .78rem; padding: .75rem .9rem; }
    .d-bz-card { padding: 1.15rem 1rem 1.25rem; border-radius: 20px; }
    .d-bz-metrics { grid-template-columns: 1fr; gap: .75rem; }
    .d-bz-rows { gap: 2.75rem; }
  }

  @media (prefers-reduced-motion: reduce) {
    .d-bz *, .d-bz *::before, .d-bz *::after { transition-duration: .01ms !important; transition-delay: 0s !important; animation: none !important; }
    .d-bz.is-js [data-bz-reveal], .d-bz.is-js .d-bz-copy, .d-bz.is-js .d-bz-vis,
    .d-bz.is-js .d-bz-status li, .d-bz.is-js .d-bz-chips span, .d-bz.is-js .d-bz-stamp { opacity: 1; transform: none; }
    .d-bz.is-js .d-bz-status li i { transform: scale(1); }
    .d-bz.is-js .d-bz-fill { transform: none; }
  }
</style>

<script>
(function () {
  var root = document.getElementById('benefits');
  if (!root || root.dataset.bzInit) return;
  root.dataset.bzInit = '1';
  root.classList.add('is-js');

  var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---- Count-up ---- */
  var counters = root.querySelectorAll('[data-count]');
  if (!reduce) counters.forEach(function (el) { el.textContent = '0'; });

  function countUp(el) {
    var target = parseInt(el.getAttribute('data-count'), 10);
    if (reduce) { el.textContent = target; return; }
    var dur = 1500, start = null;
    function tick(ts) {
      if (start === null) start = ts;
      var p = Math.min((ts - start) / dur, 1);
      el.textContent = Math.round(target * (1 - Math.pow(1 - p, 3)));
      if (p < 1) requestAnimationFrame(tick);
    }
    requestAnimationFrame(tick);
  }

  function show(el) {
    el.classList.add('is-in');
    el.querySelectorAll('[data-count]').forEach(function (c) { setTimeout(function () { countUp(c); }, 500); });
  }

  /* ---- Reveal ---- */
  var items = root.querySelectorAll('[data-bz-reveal]');
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (en.isIntersecting) { show(en.target); io.unobserve(en.target); }
      });
    }, { threshold: .2, rootMargin: '0px 0px -60px 0px' });
    items.forEach(function (el) { io.observe(el); });
  } else {
    items.forEach(function (el) {
      el.classList.add('is-in');
      el.querySelectorAll('[data-count]').forEach(function (c) { c.textContent = c.getAttribute('data-count'); });
    });
  }

  /* ---- Scroll progress line ---- */
  var rows = document.getElementById('d-bz-rows');
  var ticking = false;
  function update() {
    ticking = false;
    var r = rows.getBoundingClientRect();
    var vh = window.innerHeight || document.documentElement.clientHeight;
    var p = (vh * 0.6 - r.top) / r.height;
    p = Math.max(0, Math.min(1, p));
    root.style.setProperty('--p', (p * 100).toFixed(1) + '%');
  }
  function onScroll() { if (!ticking) { ticking = true; requestAnimationFrame(update); } }

  if (reduce) { root.style.setProperty('--p', '100%'); }
  else {
    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onScroll);
    update();
  }
})();
</script>