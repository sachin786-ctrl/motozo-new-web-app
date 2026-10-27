<?php

/**
 * Instant Valuation & Doorstep Scrap Valuation Form
 * Clean, smooth, and unified layout modeled after modern scrap platform UI.
 * Zero emojis - Pure Bootstrap Icons.
 * Completely empty initial state until user interaction.
 */
if (session_status() !== PHP_SESSION_ACTIVE && file_exists(__DIR__ . '/../includes/bootstrap.php')) {
  require_once __DIR__ . '/../includes/bootstrap.php';
}
$csrfToken = $_SESSION['csrf'] ?? '';
$actionUrl = (defined('BASE') ? BASE : '/') . 'send-mail.php';
$currentCity = $districtName ?? '';
?>

<!-- ==========================================================================
     VEHICLE LOT BUILDER & SCRAP VALUATION (Self-Contained: HTML + CSS + JS)
     ========================================================================== -->
<section class="section bg-tint" id="list-lot">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow">Instant Valuation</span>
      <h2>Calculate Vehicle Scrap Value &amp; Book Pickup</h2>
      <p>Select your vehicle, condition and location to get an instant doorstep scrap estimate.</p>
    </div>

    <div class="builder reveal" id="builder">
      <!-- Left Column: Unified Multi-Step Form Card -->
      <form class="builder-form" id="vehicle-lot-form" novalidate>
        <?php if (!empty($csrfToken)): ?>
          <input type="hidden" name="csrf" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
        <?php endif; ?>
        <input type="text" name="website" class="d-none" tabindex="-1" autocomplete="off" aria-hidden="true">

        <!-- ==================== STEP 1: Vehicle Category ==================== -->
        <div class="form-step" id="step1Wrap">
          <div class="sec-heading mb-3 text-center">
            <span class="sec-num mb-1">1</span>
            <h3 class="mb-1">What vehicle do you want to scrap?</h3>
            <p class="text-muted small mb-0">Select your vehicle category to get accurate scrap rates.</p>
          </div>
          <div class="pill-chips-wrap" id="vTypeChips">
            <label class="pill-chip"><input type="radio" name="v_type" value="Car" data-icon="bi-car-front-fill"><span><i class="bi bi-car-front-fill"></i>Car</span></label>
            <label class="pill-chip"><input type="radio" name="v_type" value="Two-Wheeler" data-icon="bi-bicycle"><span><i class="bi bi-bicycle"></i>Two-Wheeler</span></label>
            <label class="pill-chip"><input type="radio" name="v_type" value="Three-Wheeler" data-icon="bi-truck-flatbed"><span><i class="bi bi-truck-flatbed"></i>Three-Wheeler</span></label>
            <label class="pill-chip"><input type="radio" name="v_type" value="Commercial Vehicle" data-icon="bi-truck"><span><i class="bi bi-truck"></i>Commercial</span></label>
            <label class="pill-chip"><input type="radio" name="v_type" value="Bus" data-icon="bi-bus-front-fill"><span><i class="bi bi-bus-front-fill"></i>Bus</span></label>
            <label class="pill-chip"><input type="radio" name="v_type" value="Truck / Heavy Vehicle" data-icon="bi-truck-front-fill"><span><i class="bi bi-truck-front-fill"></i>Truck / Heavy</span></label>
            <label class="pill-chip"><input type="radio" name="v_type" value="Other" data-icon="bi-three-dots"><span><i class="bi bi-three-dots"></i>Other</span></label>
          </div>
          <div class="field-error text-center" id="err-v_type">Please select a vehicle type.</div>

          <div class="mt-3 pt-2 border-top d-flex justify-content-center">
            <button type="button" class="btn btn-brand px-4 py-2 d-inline-flex align-items-center gap-2 shadow-sm fw-bold" id="btnStep1Next">
              <span>Next</span>
              <i class="bi bi-arrow-right"></i>
            </button>
          </div>
        </div>

        <!-- ==================== STEP 2: Brand & Fuel ==================== -->
        <div class="form-step" id="step2Wrap" style="display: none;">
          <div class="sec-heading mb-3 text-center">
            <span class="sec-num mb-1">2</span>
            <h3 class="mb-1" id="step2HeadingTitle">Vehicle Brand &amp; Fuel Type</h3>
            <p class="text-muted small mb-0" id="step2HeadingDesc">Specify brand and fuel for accurate metal &amp; engine valuation.</p>
          </div>

          <div class="form-column-wrap">
            <div class="form-col-field">
              <div class="d-flex justify-content-between align-items-center mb-1">
                <label class="sub-label mb-0" for="vBrand" id="vBrandLabel">Vehicle Brand *</label>
                <span class="text-muted small" style="font-size: 0.84rem;">Tap popular or type below</span>
              </div>

              <!-- Dynamic Popular Brand Quick Chips -->
              <div class="d-flex flex-wrap gap-1 mb-2" id="vBrandQuickChips"></div>

              <div class="input-icon-wrap">
                <i class="bi bi-tag input-icon"></i>
                <input type="text" id="vBrand" name="v_brand" class="form-control form-icon-input" placeholder="e.g. Maruti Suzuki, Hyundai, Honda, Tata" list="vBrandList" autocomplete="off" required>
              </div>
              <datalist id="vBrandList"></datalist>
              <div class="field-error" id="err-vBrand">Please enter vehicle brand.</div>
            </div>

            <div class="form-col-field">
              <label class="sub-label mb-1">Fuel Type *</label>
              <div class="seg-control" id="fuelSeg">
                <label data-fuel="Petrol"><input type="radio" name="v_fuel" value="Petrol"><span>Petrol</span></label>
                <label data-fuel="Diesel"><input type="radio" name="v_fuel" value="Diesel"><span>Diesel</span></label>
                <label data-fuel="CNG"><input type="radio" name="v_fuel" value="CNG"><span>CNG</span></label>
                <label data-fuel="Electric"><input type="radio" name="v_fuel" value="Electric"><span>Electric</span></label>
                <label data-fuel="Hybrid"><input type="radio" name="v_fuel" value="Hybrid"><span>Hybrid</span></label>
              </div>
              <div class="field-error" id="err-v_fuel">Please select fuel type.</div>
            </div>
          </div>

          <div class="mt-3 pt-2 border-top d-flex justify-content-center align-items-center gap-2">
            <button type="button" class="btn btn-outline-secondary px-3 py-2 fw-semibold" id="btnStep2Back">
              <i class="bi bi-arrow-left me-1"></i> Back
            </button>
            <button type="button" class="btn btn-brand px-4 py-2 d-inline-flex align-items-center gap-2 shadow-sm fw-bold" id="btnStep2Next">
              <span>Next</span>
              <i class="bi bi-arrow-right"></i>
            </button>
          </div>
        </div>

        <!-- ==================== STEP 3: Vehicle Condition ==================== -->
        <div class="form-step" id="step3Wrap" style="display: none;">
          <div class="sec-heading mb-3 text-center">
            <span class="sec-num mb-1">3</span>
            <h3 class="mb-1">What is the vehicle condition?</h3>
            <p class="text-muted small mb-0">Condition determines scrap recovery weight and towing method.</p>
          </div>
          <div class="pill-chips-wrap" id="vCondChips">
            <label class="pill-chip"><input type="radio" name="v_cond" value="Running & Complete"><span><i class="bi bi-check-circle-fill"></i>Running &amp; Complete</span></label>
            <label class="pill-chip"><input type="radio" name="v_cond" value="Not Running"><span><i class="bi bi-pause-circle-fill"></i>Not Running</span></label>
            <label class="pill-chip"><input type="radio" name="v_cond" value="Accident / Damaged"><span><i class="bi bi-exclamation-triangle-fill"></i>Accident / Damaged</span></label>
            <label class="pill-chip"><input type="radio" name="v_cond" value="Burnt"><span><i class="bi bi-fire"></i>Burnt</span></label>
            <label class="pill-chip"><input type="radio" name="v_cond" value="Flood Damaged"><span><i class="bi bi-droplet-half"></i>Flood Damaged</span></label>
            <label class="pill-chip"><input type="radio" name="v_cond" value="Missing Parts"><span><i class="bi bi-tools"></i>Missing Parts</span></label>
          </div>
          <div class="field-error text-center" id="err-v_cond">Please select vehicle condition.</div>

          <div class="mt-3 pt-2 border-top d-flex justify-content-center align-items-center gap-2">
            <button type="button" class="btn btn-outline-secondary px-3 py-2 fw-semibold" id="btnStep3Back">
              <i class="bi bi-arrow-left me-1"></i> Back
            </button>
            <button type="button" class="btn btn-brand px-4 py-2 d-inline-flex align-items-center gap-2 shadow-sm fw-bold" id="btnStep3Next">
              <span>Next</span>
              <i class="bi bi-arrow-right"></i>
            </button>
          </div>
        </div>

        <!-- ==================== STEP 4: Pickup City & PIN ==================== -->
        <div class="form-step" id="step4Wrap" style="display: none;">
          <div class="sec-heading mb-3 text-center">
            <span class="sec-num mb-1">4</span>
            <h3 class="mb-1">Pickup city &amp; Pincode</h3>
            <p class="text-muted small mb-0">Where is the vehicle located for free doorstep pickup?</p>
          </div>

          <div class="form-column-wrap">
            <div class="form-col-field">
              <label class="sub-label mb-1" for="vCity">City / Location *</label>
              <div class="input-icon-wrap">
                <i class="bi bi-geo-alt input-icon"></i>
                <input type="text" id="vCity" name="v_city" class="form-control form-icon-input" placeholder="e.g. Pune, Delhi NCR" list="vCityList" value="<?= !empty($currentCity) ? htmlspecialchars($currentCity, ENT_QUOTES, 'UTF-8') : '' ?>" required>
              </div>
              <datalist id="vCityList">
                <option value="Delhi NCR">
                <option value="Noida">
                <option value="Greater Noida">
                <option value="Gurgaon">
                <option value="Ghaziabad">
                <option value="Faridabad">
                <option value="Mumbai">
                <option value="Pune">
                <option value="Bengaluru">
                <option value="Hyderabad">
                <option value="Ahmedabad">
                <option value="Jaipur">
                <option value="Lucknow">
                <option value="Chandigarh">
              </datalist>
              <div class="field-error" id="err-vCity">Please enter pickup city.</div>
            </div>

            <div class="form-col-field">
              <div class="d-flex justify-content-between align-items-center mb-1">
                <label class="sub-label mb-0" for="vPin">PIN Code *</label>
                <span class="text-muted small" id="pinFetchStatus" style="font-size: 0.84rem;"></span>
              </div>
              <div class="input-icon-wrap">
                <i class="bi bi-pin-map input-icon"></i>
                <input type="text" id="vPin" name="v_pincode" class="form-control form-icon-input" placeholder="Enter 6-digit PIN" maxlength="6" pattern="[0-9]{6}" autocomplete="postal-code" inputmode="numeric" required>
                <div class="input-suffix-icon" id="pinSuffixWrap" style="display: none;">
                  <span class="spinner-border spinner-border-sm text-success" id="pinSpinner" style="width: 16px; height: 16px; display: none;" role="status"></span>
                  <i class="bi bi-check-circle-fill text-success fs-6" id="pinSuccessIcon" style="display: none;"></i>
                </div>
              </div>
              <div class="pin-feedback mt-1 small" id="pinFeedback" style="display: none;"></div>
              <div class="field-error" id="err-vPin">Please enter valid 6-digit PIN.</div>
            </div>
          </div>

          <div class="mt-3 pt-2 border-top d-flex justify-content-center align-items-center gap-2">
            <button type="button" class="btn btn-outline-secondary px-3 py-2 fw-semibold" id="btnStep4Back">
              <i class="bi bi-arrow-left me-1"></i> Back
            </button>
            <button type="button" class="btn btn-brand px-4 py-2 d-inline-flex align-items-center gap-2 shadow-sm fw-bold" id="btnStep4Next">
              <span>Next</span>
              <i class="bi bi-arrow-right"></i>
            </button>
          </div>
        </div>

        <!-- ==================== STEP 5: Pickup When ==================== -->
        <div class="form-step" id="step5Wrap" style="display: none;">
          <div class="sec-heading mb-3 text-center">
            <span class="sec-num mb-1">5</span>
            <h3 class="mb-1">Pickup when?</h3>
            <p class="text-muted small mb-0">Choose when you would like our recovery towing team to visit.</p>
          </div>

          <div class="form-column-wrap">
            <div class="form-col-field">
              <div class="seg-control" id="whenSeg">
                <label><input type="radio" name="v_when" value="Today"><span>Today</span></label>
                <label><input type="radio" name="v_when" value="This week"><span>This week</span></label>
                <label><input type="radio" name="v_when" value="2 weeks"><span>2 weeks</span></label>
                <label><input type="radio" name="v_when" value="Flexible"><span>Flexible</span></label>
              </div>
              <div class="field-error text-center" id="err-v_when">Please select pickup timeframe.</div>
            </div>
          </div>

          <div class="mt-3 pt-2 border-top d-flex justify-content-center align-items-center gap-2">
            <button type="button" class="btn btn-outline-secondary px-3 py-2 fw-semibold" id="btnStep5Back">
              <i class="bi bi-arrow-left me-1"></i> Back
            </button>
            <button type="button" class="btn btn-brand px-4 py-2 d-inline-flex align-items-center gap-2 shadow-sm fw-bold" id="btnStep5Next">
              <span>Next</span>
              <i class="bi bi-arrow-right"></i>
            </button>
          </div>
        </div>

        <!-- ==================== STEP 6: Contact & Valuation ==================== -->
        <div class="form-step" id="step6Wrap" style="display: none;">
          <div class="sec-heading mb-2 text-center">
            <span class="sec-num mb-1">6</span>
            <h3 class="mb-1">Where should we send your official valuation?</h3>
            <p class="text-muted mb-0">Enter your contact details to confirm doorstep pickup &amp; receipt.</p>
          </div>

          <!-- Selected Vehicle Summary Recap Bar -->
          <div class="px-3 py-1.5 bg-light border mb-2.5 d-flex align-items-center justify-content-between flex-wrap gap-2 mx-auto" id="stepSummaryBar" style="max-width: 520px; border-radius: 8px;">
            <div class="d-flex align-items-center gap-2 text-start text-truncate" style="max-width: calc(100% - 75px);">
              <i class="bi bi-patch-check-fill text-success flex-shrink-0" style="font-size: 1.05rem;"></i>
              <div class="text-truncate">
                <span id="summaryVehicleName" class="text-dark fw-bold" style="font-size: 0.94rem;">Vehicle Selected</span>
                <span class="text-muted mx-1" style="font-size: 0.84rem;">&bull;</span>
                <span id="summaryVehicleMeta" class="text-muted" style="font-size: 0.86rem;">Condition &bull; City &bull; Pickup</span>
              </div>
            </div>
            <button type="button" class="btn btn-outline-success btn-sm py-0 fw-semibold" id="btnEditVehicle" style="font-size: 0.82rem; border-radius: 6px; width: 25px; height: 28px; padding-left: 2px; padding-right: 2px;">
              <i class="bi bi-pencil-square me-1"></i>Edit
            </button>
          </div>

          <div class="form-column-wrap" style="gap: 0.75rem;">
            <div class="form-col-field">
              <label class="sub-label mb-1" for="userName">Full Name *</label>
              <div class="input-icon-wrap">
                <i class="bi bi-person input-icon"></i>
                <input type="text" id="userName" name="user_name" class="form-control form-icon-input" placeholder="Your Full Name" required>
              </div>
              <div class="field-error" id="err-userName">Please enter full name.</div>
            </div>

            <div class="step6-inputs-row">
              <div class="form-col-field">
                <label class="sub-label mb-1" for="userPhone">Phone Number *</label>
                <div class="input-icon-wrap">
                  <i class="bi bi-telephone input-icon"></i>
                  <input type="tel" id="userPhone" name="user_phone" class="form-control form-icon-input" placeholder="XXXXXXX356" pattern="[0-9]{10}" maxlength="10" inputmode="numeric" required>
                </div>
                <div class="field-error" id="err-userPhone">Please enter 10-digit number.</div>
              </div>
              <div class="form-col-field">
                <label class="sub-label mb-1" for="userEmail">Email Address *</label>
                <div class="input-icon-wrap">
                  <i class="bi bi-envelope input-icon"></i>
                  <input type="email" id="userEmail" name="user_email" class="form-control form-icon-input" placeholder="Email Address" required>
                </div>
                <div class="field-error" id="err-userEmail">Please enter valid email.</div>
              </div>
            </div>
          </div>

          <!-- Action Buttons in Step 6 -->
          <div class="mt-2.5 pt-2 border-top d-flex flex-wrap gap-2 align-items-center justify-content-center">
            <button type="button" class="btn btn-outline-secondary px-3 py-2 fw-semibold" id="btnStep6Back">
              <i class="bi bi-arrow-left me-1"></i> Back
            </button>
            <button type="button" class="btn btn-brand px-4 py-2 fw-bold shadow-sm d-inline-flex align-items-center gap-2" id="btnSubmitLot">
              <span id="lotSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
              <span id="lotBtnText">Get My Scrap Value</span>
              <i class="bi bi-arrow-right" id="lotBtnIcon"></i>
            </button>
          </div>

          <!-- Message Container displayed right inside the form -->
          <div id="lot-form-msg" class="small fw-semibold mt-2 text-center" role="alert" aria-live="polite"></div>
        </div>

        <input type="hidden" name="estimated_value" id="hiddenEstVal" value="">
      </form>

      <!-- Right Column: Sticky Live Preview & Instant Scrap Estimate -->
      <aside class="builder-preview" aria-live="polite">
        <div class="bp-head">
          <span>Live Preview</span>
          <div class="bp-meter" id="meter" style="--p:16"><b id="meterTxt">16%</b></div>
        </div>

        <article class="bp-card">
          <div class="bp-media">
            <span class="bp-status mb-2"><span class="live-dot"></span>Doorstep Valuation</span>
            <div class="bp-icon-badge">
              <i class="bi bi-car-front" id="pIcon"></i>
            </div>
            <div class="text-uppercase fw-bold text-success mb-0" style="letter-spacing: .08em; font-size: 0.82rem;">Your Vehicle</div>
            <h3 class="mt-0 mb-1 d-flex align-items-center justify-content-center gap-2" style="font-size: clamp(1.25rem, 1.6vw, 1.45rem); font-weight: 800; color: #0f172a; line-height: 1.25;">
              <i class="bi bi-car-front text-success" id="pTitleIcon" style="font-size: 1.3rem;"></i>
              <span id="pTitle">Select Vehicle</span>
            </h3>
            <div class="bp-sub text-muted" id="pSub" style="font-size: 0.94rem; font-weight: 600;"><i class="bi bi-fuel-pump me-1"></i>Fuel: Pending</div>
          </div>
          <div class="bp-body">
            <div class="bp-meta my-1.5 d-flex flex-wrap align-items-center justify-content-center gap-1.5" style="font-size: 0.88rem;">
              <span class="badge bg-white text-dark border px-3 py-1.5 shadow-xs" style="border-radius: 14px; font-size: 0.86rem; font-weight: 600;"><i class="bi bi-geo-alt-fill text-success me-1"></i> <b id="pCity">Location: Pending</b></span>
              <span class="badge bg-white text-dark border px-3 py-1.5 shadow-xs" style="border-radius: 14px; font-size: 0.86rem; font-weight: 600;"><i class="bi bi-clock-fill text-success me-1"></i> <b id="pWhen">Pickup: Pending</b></span>
            </div>

            <div class="my-1.5" id="pCondBadge">
              <span class="badge bg-white text-muted border py-1.5 px-3 shadow-xs" style="border-radius: 14px; font-size: 0.86rem; font-weight: 600;"><i class="bi bi-hourglass me-1"></i>Condition: Pending</span>
            </div>

            <div class="bp-price-box text-center my-1.5" id="pPriceBox">
              <div class="text-muted fw-bold text-uppercase" style="letter-spacing: .08em; font-size: 0.82rem;">Estimated Scrap Value</div>
              <div class="my-1 d-flex align-items-center justify-content-center" id="pVal" style="min-height: 34px;">
                <span class="badge bg-white text-secondary border px-3 py-1.5 fw-bold shadow-xs" style="border-radius: 14px; font-size: 0.88rem;">
                  <span class="spinner-grow spinner-grow-sm text-success me-1.5" style="width: 7px; height: 7px;" role="status"></span>Calculating after Step 5
                </span>
              </div>
              <div class="small text-muted" id="pValNote" style="font-size: 0.86rem; font-weight: 500;">Complete Step 1 to 5 to reveal doorstep scrap value</div>
            </div>
          </div>
        </article>

        <p class="calc-note text-white-50 text-center mt-2 mb-0" style="font-size: 0.82rem; line-height: 1.45;">
          <i class="bi bi-shield-check text-success"></i> 100% Free Doorstep Inspection &bull; Instant Payment &bull; Free RTO Scrap Certificate
        </p>
      </aside>
    </div>
  </div>
</section>

<!-- ==========================================================================
     CSS STYLES (Exact Reference Alignment: Clean, Smooth & Filled)
     ========================================================================== -->
<style>
  #list-lot {
    padding: 3.5rem 0 4rem;
    background: var(--section-bg-soft, #EEF7F1);
  }

  #list-lot .section-head {
    margin: 0 auto 1.75rem;
  }

  #list-lot .section-head h2 {
    font-family: var(--font-heading);
    font-size: var(--heading-size);
    font-weight: var(--heading-weight);
    line-height: var(--heading-line-height);
    letter-spacing: var(--heading-letter-spacing);
    color: var(--heading-color);
    margin-bottom: 0.5rem;
  }

  #list-lot .section-head p {
    font-family: var(--font-body);
    font-size: clamp(0.96rem, 1.25vw, 1.08rem);
    color: var(--muted, #899097);
    line-height: 1.6;
    margin-bottom: 0;
  }

  #list-lot .container {
    width: 100%;
    box-sizing: border-box;
  }

  .builder {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr)); 
    gap: 1.5rem;
    width: 100%;
    max-width: 100%;
    margin: 0 auto;
    align-items: stretch;
    box-sizing: border-box;
  }

  .builder > * {
    min-width: 0;
    max-width: 100%;
    box-sizing: border-box;
  }

  .builder-form {
    display: flex;
    flex-direction: column;
    justify-content: center;
    height: 100%;
    min-height: 440px;
    background: #ffffff;
    border-radius: 14px;
    border: 1px solid #dce8e0;
    box-shadow: 0 10px 30px -10px rgba(11, 58, 36, 0.08);
    padding: 1.5rem 1.6rem 1.35rem;
    width: 100%;
    max-width: 100%;
    min-width: 0;
    box-sizing: border-box;
    position: relative;
    margin: 0;
  }

  .builder-preview {
    background: var(--green-700);
    color: #ffffff;
    border-radius: 14px;
    box-shadow: 0 14px 32px -10px rgba(10, 58, 36, 0.32);
    border: 1px solid rgba(255, 255, 255, 0.1);
    padding: 1.15rem 1.15rem 1rem;
    position: sticky;
    top: 90px;
    width: 100%;
    max-width: 100%;
    min-width: 0;
    box-sizing: border-box;
    height: 100%;
    min-height: 440px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    text-align: center;
  }

  /* Single Column Form Structure */
  .form-column-wrap {
    display: flex;
    flex-direction: column;
    gap: 0.85rem;
    max-width: 460px;
    width: 100%;
    margin: 0 auto;
    box-sizing: border-box;
  }

  .step6-inputs-row {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 0.75rem;
    width: 100%;
    box-sizing: border-box;
  }

  @media (max-width: 575.98px) {
    .step6-inputs-row {
      grid-template-columns: 1fr;
    }
  }

  .form-col-field {
    width: 100%;
    text-align: left;
  }

  .form-step {
    width: 100%;
    animation: fadeInStep 0.28s ease-in-out;
  }

  @keyframes fadeInStep {
    from {
      opacity: 0;
      transform: translateY(6px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  #stepSummaryBar {
    background: #f8faf9 !important;
    border: 1px solid #dce8e0 !important;
  }

  /* Section Headings with Green Circle Number - Centered Stack */
  .sec-heading {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    margin-bottom: 1.25rem !important;
  }

  .sec-num {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: var(--color-primary, #1B692C);
    color: #ffffff;
    font-size: 0.92rem;
    font-weight: 800;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    box-shadow: 0 2px 6px rgba(27, 105, 44, 0.25);
    margin-bottom: 0.45rem !important;
  }

  .sec-heading h3 {
    margin: 0;
    font-size: clamp(1.22rem, 1.55vw, 1.4rem);
    font-weight: 800;
    color: #111827;
    font-family: var(--font-heading, var(--font-body));
    text-align: center;
    line-height: 1.3;
    letter-spacing: -0.01em;
  }

  .sec-heading p {
    color: #64748b;
    font-size: clamp(0.88rem, 1.1vw, 0.96rem);
    text-align: center;
    margin-top: 0.25rem;
    margin-bottom: 0;
    line-height: 1.45;
  }

  .sub-label {
    font-size: 0.92rem;
    font-weight: 700;
    color: #1e293b;
    display: block;
    margin-bottom: 0.35rem;
  }

  /* Pill Chips - Centered */
  .pill-chips-wrap {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    gap: 0.6rem;
    max-width: 520px;
    margin: 0 auto;
  }

  .pill-chip {
    margin: 0;
    cursor: pointer;
    user-select: none;
    position: relative;
  }

  .pill-chip input {
    position: absolute;
    opacity: 0;
    pointer-events: none;
  }

  .pill-chip span {
    display: inline-flex;
    align-items: center;
    gap: 0.55rem;
    background: #ffffff;
    border: 1.5px solid #dce8e0;
    border-radius: 9px;
    padding: 0.52rem 1.05rem;
    font-size: clamp(0.92rem, 1.1vw, 0.98rem);
    font-weight: 600;
    color: #1e293b;
    transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
  }

  .pill-chip span i {
    color: var(--color-primary, #1B692C);
    font-size: 1.1rem;
    transition: color 0.2s;
  }

  .pill-chip:hover span {
    border-color: var(--color-primary, #1B692C);
    background: #f4faf6;
    transform: translateY(-1px);
    box-shadow: 0 4px 10px rgba(27, 105, 44, 0.1);
  }

  .pill-chip input:checked+span {
    background: var(--color-primary, #1B692C);
    color: #ffffff;
    border-color: var(--color-primary, #1B692C);
    box-shadow: 0 4px 14px rgba(27, 105, 44, 0.35);
    transform: translateY(-1px);
    font-weight: 700;
  }

  .pill-chip input:checked+span i {
    color: #ffffff !important;
  }

  .pill-chip input:focus-visible+span {
    outline: 2px solid var(--color-primary, #1B692C);
    outline-offset: 2px;
  }

  /* Dashed Chips for Step 5 */
  .dash-chips-wrap {
    display: flex;
    flex-wrap: wrap;
    gap: 0.55rem;
  }

  .dash-chip {
    margin: 0;
    cursor: pointer;
    user-select: none;
    position: relative;
  }

  .dash-chip input {
    position: absolute;
    opacity: 0;
    pointer-events: none;
  }

  .dash-chip span {
    display: inline-flex;
    align-items: center;
    gap: 0.45rem;
    background: #ffffff;
    border: 1.5px dashed #a8cdb6;
    border-radius: 9px;
    padding: 0.48rem 1rem;
    font-size: 0.92rem;
    font-weight: 600;
    color: #334155;
    transition: all 0.2s ease;
  }

  .dash-chip:hover span {
    border-color: var(--color-primary, #1B692C);
    background: #f4faf6;
    color: var(--color-primary, #1B692C);
  }

  .dash-chip input:checked+span {
    background: var(--color-primary-soft, #EEF7F1);
    border: 1.5px solid var(--color-primary, #1B692C);
    color: var(--color-primary, #1B692C);
    font-weight: 700;
  }

  /* Quick Select Popular Brand Chips in Step 2 */
  .quick-brand-chip {
    display: inline-flex;
    align-items: center;
    padding: 0.35rem 0.75rem;
    font-size: 0.86rem;
    font-weight: 600;
    color: #334155;
    background: #f1f6f3;
    border: 1px solid #d4e3dc;
    border-radius: 7px;
    cursor: pointer;
    transition: all 0.16s ease;
    user-select: none;
    line-height: 1.25;
  }

  .quick-brand-chip:hover {
    background: #e2ede6;
    color: var(--color-primary, #1B692C);
    border-color: var(--color-primary, #1B692C);
    transform: translateY(-1px);
  }

  .quick-brand-chip.active {
    background: var(--color-primary, #1B692C);
    color: #ffffff;
    border-color: var(--color-primary, #1B692C);
    box-shadow: 0 2px 6px rgba(27, 105, 44, 0.22);
  }

  /* Segmented Control Bar */
  .seg-control {
    display: flex;
    flex-wrap: wrap;
    background: #eef4f0;
    padding: 4px;
    gap: 4px;
    border-radius: 9px;
    user-select: none;
    width: 100%;
  }

  .seg-control label {
    flex: 1 1 0;
    min-width: 75px;
    margin: 0;
    cursor: pointer;
    position: relative;
  }

  .seg-control input {
    position: absolute;
    opacity: 0;
    pointer-events: none;
  }

  .seg-control span {
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 0.52rem 0.5rem;
    font-size: 0.92rem;
    font-weight: 600;
    color: #374151;
    border-radius: 7px;
    transition: all 0.2s ease;
  }

  .seg-control label:hover span {
    color: var(--color-primary, #1B692C);
  }

  .seg-control input:checked+span {
    background: #ffffff;
    color: var(--color-primary, #1B692C);
    font-weight: 700;
    box-shadow: 0 2px 7px rgba(0, 0, 0, 0.08);
  }

  /* Input Icon Wrappers */
  .input-icon-wrap {
    position: relative;
    width: 100%;
  }

  .input-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--color-primary, #1B692C);
    font-size: 1.05rem;
    pointer-events: none;
  }

  .form-icon-input {
    padding-left: 2.6rem !important;
    padding-right: 0.95rem;
    border-radius: 8px;
    border: 1.5px solid #dce8e0;
    font-size: 0.95rem;
    transition: border-color 0.2s, box-shadow 0.2s;
    height: 44px;
    width: 100%;
  }

  .form-icon-input:focus {
    border-color: var(--color-primary, #1B692C);
    box-shadow: 0 0 0 3px rgba(27, 105, 44, 0.14);
  }

  #vehicle-lot-form .btn {
    border-radius: 8px;
  }

  /* Modern Circular Ring Loader */
  .btn-spinner {
    width: 17px;
    height: 17px;
    border: 2.5px solid rgba(255, 255, 255, 0.32);
    border-top: 2.5px solid #ffffff;
    border-radius: 50%;
    animation: btnSpinRing 0.65s linear infinite;
    display: inline-block;
    vertical-align: middle;
    flex-shrink: 0;
  }

  @keyframes btnSpinRing {
    to {
      transform: rotate(360deg);
    }
  }

  /* Inline Field Errors */
  .field-error {
    display: none;
    font-size: 0.84rem;
    font-weight: 600;
    color: #dc3545;
    margin-top: 0.35rem;
    font-family: var(--font-body, system-ui, sans-serif);
  }

  .field-error.show {
    display: block;
    animation: errFadeIn 0.2s ease;
  }

  @keyframes errFadeIn {
    from {
      opacity: 0;
      transform: translateY(-3px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  @keyframes fieldShake {
    0%, 100% { transform: translateX(0); }
    20%, 60% { transform: translateX(-5px); }
    40%, 80% { transform: translateX(5px); }
  }

  .shake-err {
    animation: fieldShake 0.35s ease !important;
  }

  .form-control.is-invalid {
    border-color: #dc3545 !important;
    background-color: #fff8f8 !important;
    box-shadow: 0 0 0 2px rgba(220, 53, 69, 0.15) !important;
  }

  /* Preview Card Styles */
  .bp-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.65rem;
    font-size: 0.82rem;
    text-transform: uppercase;
    letter-spacing: .08em;
    font-weight: 700;
    color: #ffffff;
    width: 100%;
  }

  .bp-meter {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: conic-gradient(#22c55e calc(var(--p, 0)*1%), rgba(255, 255, 255, .15) 0);
    display: grid;
    place-items: center;
    font-size: .78rem;
    position: relative;
  }

  .bp-meter::before {
    content: '';
    position: absolute;
    inset: 3px;
    background: var(--section-bg-white);
    border-radius: 50%;
  }

  .bp-meter b {
    position: relative;
    z-index: 1;
    font-weight: 800;
    color: var(--green-700);
  }

  .bp-card {
    background: #ffffff;
    color: #1e293b;
    border-radius: 12px;
    overflow: hidden;
    margin: 0;
    box-shadow: 0 10px 24px -6px rgba(0, 0, 0, .22);
    transform: scale(1);
    transform-origin: center center;
    transition: transform 0.35s cubic-bezier(0.2, 0.85, 0.3, 1), box-shadow 0.35s ease;
    backface-visibility: hidden;
    -webkit-backface-visibility: hidden;
    will-change: transform, box-shadow;
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    text-align: center;
  }

  .bp-card.card-pulse {
    transform: scale(1.02);
    box-shadow: 0 14px 30px -6px rgba(10, 58, 36, 0.3), 0 0 0 2px rgba(34, 197, 94, 0.35);
  }

  .bp-media {
    background: linear-gradient(180deg, #f4faf6 0%, #e6f3ec 100%);
    padding: 0.85rem 0.95rem 0.75rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    border-bottom: 1px solid #dce8e0;
    width: 100%;
  }

  .bp-icon-badge {
    width: 54px;
    height: 54px;
    border-radius: 50%;
    background: #ffffff;
    border: 2px solid #c2e2cf;
    display: grid;
    place-items: center;
    box-shadow: 0 6px 14px -3px rgba(19, 82, 59, 0.16);
    margin: 0 auto 0.4rem;
    transition: transform 0.3s ease;
  }

  .bp-icon-badge:hover {
    transform: scale(1.05);
  }

  .bp-icon-badge>i {
    font-size: 1.85rem;
    color: #13523b;
    line-height: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
  }

  .bp-status {
    font-size: 0.78rem;
    font-weight: 700;
    color: #13523b;
    background: #e1f3e7;
    border: 1px solid #bce2ca;
    padding: 0.25rem 0.8rem;
    border-radius: 20px;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    box-shadow: 0 2px 6px rgba(19, 82, 59, 0.06);
  }

  .live-dot {
    width: 6px;
    height: 6px;
    background: #16a34a;
    border-radius: 50%;
    animation: livePulse 1.6s infinite ease-in-out;
  }

  @keyframes livePulse {
    0% {
      transform: scale(0.95);
      opacity: 0.8;
    }

    50% {
      transform: scale(1.3);
      opacity: 1;
    }

    100% {
      transform: scale(0.95);
      opacity: 0.8;
    }
  }

  .bp-body {
    padding: 0.85rem 1rem;
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
  }

  .bp-price-box {
    background: linear-gradient(135deg, rgba(34, 197, 94, 0.08), rgba(16, 185, 129, 0.16));
    border: 1.5px dashed rgba(22, 101, 52, 0.32);
    border-radius: 10px;
    width: 100%;
    max-width: 440px;
    padding: 0.75rem 0.95rem !important;
    box-sizing: border-box;
    overflow: hidden;
  }

  #pVal {
    min-height: 38px;
    width: 100%;
    max-width: 100%;
    box-sizing: border-box;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
  }

  #pVal .fw-bold {
    font-size: clamp(1.4rem, 2.2vw, 1.85rem);
    letter-spacing: -0.02em;
    line-height: 1.25;
    text-align: center;
    word-break: break-word;
    overflow-wrap: break-word;
    display: inline-block;
    max-width: 100%;
  }

  #pTitle {
    word-break: break-word;
    overflow-wrap: break-word;
    max-width: 100%;
    text-align: center;
    font-family: var(--font-heading, var(--font-body));
  }

  .input-suffix-icon {
    position: absolute;
    right: 0.95rem;
    top: 50%;
    transform: translateY(-50%);
    display: flex;
    align-items: center;
    pointer-events: none;
    z-index: 2;
  }

  .pin-feedback {
    display: none;
    font-size: 0.86rem;
    margin-top: 0.35rem;
    font-weight: 600;
  }

  .pin-feedback.valid {
    display: block;
    color: #15803d;
    animation: fadeInStep 0.2s ease;
  }

  .pin-feedback.checking {
    display: block;
    color: #64748b;
  }

  @media (max-width: 767.98px) {
    .form-icon-input {
      font-size: 16px !important;
    }
  }

  #lot-form-msg.ok {
    color: #0f5132;
    background: #d1e7dd;
    border: 1px solid #badbcc;
    padding: .65rem .95rem;
    border-radius: 6px;
    font-size: 0.92rem;
  }

  #lot-form-msg.bad {
    color: #842029;
    background: #f8d7da;
    border: 1px solid #f5c2c7;
    padding: .65rem .95rem;
    border-radius: 6px;
    font-size: 0.92rem;
  }

  /* Center Action Buttons in Steps */
  .form-step > .border-top {
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
    gap: 12px;
    flex-wrap: wrap;
    margin-top: 1.25rem !important;
    padding-top: 0.95rem !important;
  }

  .form-step .btn {
    padding: 0.58rem 2rem !important;
    font-size: 0.96rem !important;
    font-weight: 700 !important;
    border-radius: 8px;
  }

  /* Responsive Rules */
  @media (max-width: 991.98px) {
    .builder {
      grid-template-columns: 1fr;
      gap: 1.25rem;
    }

    .builder-form {
      padding: 1.35rem 1.15rem;
      min-height: auto;
    }

    .builder-preview {
      position: static;
      min-height: auto;
      padding: 1.15rem 1rem;
    }
  }

  @media (max-width: 575.98px) {
    #list-lot {
      padding: 2.25rem 0 2.5rem;
    }

    .builder {
      gap: 1rem;
    }

    .builder-form {
      padding: 1.15rem 0.85rem;
      border-radius: 12px;
    }

    .builder-preview {
      padding: 1rem 0.85rem;
      border-radius: 12px;
    }

    .bp-card {
      border-radius: 10px;
    }

    .bp-media {
      padding: 0.75rem 0.75rem 0.65rem;
    }

    .bp-icon-badge {
      width: 48px;
      height: 48px;
    }

    .bp-icon-badge>i {
      font-size: 1.65rem;
    }

    #pTitle {
      font-size: 1.22rem !important;
    }

    .pill-chip span {
      padding: 0.45rem 0.85rem;
      font-size: 0.88rem;
      gap: 0.45rem;
    }

    .pill-chip span i {
      font-size: 1rem;
    }

    .sec-heading h3 {
      font-size: 1.12rem;
    }

    .sec-heading p {
      font-size: 0.86rem;
    }

    .sec-num {
      width: 28px;
      height: 28px;
      font-size: 0.85rem;
    }

    .seg-control {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
    }
  }
</style>

<!-- ==========================================================================
     JAVASCRIPT LOGIC (Interactive, Zero-Preselection, Real-time Validation)
     ========================================================================== -->
<script>
  (function() {
    const lotForm = document.getElementById('vehicle-lot-form'),
      lotSubmitBtn = document.getElementById('btnSubmitLot'),
      lotBtnIcon = document.getElementById('lotBtnIcon'),
      mobileSubmitBtn = document.querySelector('.btn-mobile-submit'),
      lotSpinner = document.getElementById('lotSpinner'),
      lotBtnText = document.getElementById('lotBtnText'),
      lotMsg = document.getElementById('lot-form-msg');

    if (!lotForm) return;

    let isLotFormSubmitted = false;

    const vIconMap = {
      'Car': {
        icon: 'bi-car-front-fill'
      },
      'Two-Wheeler': {
        icon: 'bi-bicycle'
      },
      'Three-Wheeler': {
        icon: 'bi-truck-flatbed'
      },
      'Commercial Vehicle': {
        icon: 'bi-truck'
      },
      'Bus': {
        icon: 'bi-bus-front-fill'
      },
      'Truck / Heavy Vehicle': {
        icon: 'bi-truck-front-fill'
      },
      'Other': {
        icon: 'bi-three-dots'
      }
    };

    // Brand-specific car scrap pricing ranges
    const carBrandPricing = {
      'Maruti Suzuki': {
        lo: 15000,
        hi: 60000
      },
      'Maruti': {
        lo: 15000,
        hi: 60000
      },
      'Hyundai': {
        lo: 30000,
        hi: 65000
      },
      'Honda': {
        lo: 40000,
        hi: 80000
      },
      'Tata': {
        lo: 15000,
        hi: 60000
      },
      'Tata Motors': {
        lo: 15000,
        hi: 60000
      },
      'Mahindra': {
        lo: 40000,
        hi: 80000
      },
      'Toyota': {
        lo: 40000,
        hi: 80000
      },
      'Ford': {
        lo: 28000,
        hi: 70000
      },
      'Kia': {
        lo: 28000,
        hi: 68000
      },
      'Volkswagen': {
        lo: 28000,
        hi: 72000
      },
      'Skoda': {
        lo: 28000,
        hi: 70000
      },
      'Renault': {
        lo: 20000,
        hi: 55000
      },
      'Nissan': {
        lo: 22000,
        hi: 58000
      },
      'MG': {
        lo: 32000,
        hi: 75000
      },
      'Chevrolet': {
        lo: 20000,
        hi: 52000
      },
      'Fiat': {
        lo: 18000,
        hi: 50000
      },
      'Jeep': {
        lo: 40000,
        hi: 85000
      },
      'BMW': {
        lo: 50000,
        hi: 110000
      },
      'Mercedes-Benz': {
        lo: 55000,
        hi: 120000
      },
      'Audi': {
        lo: 50000,
        hi: 115000
      },
      'Other': {
        lo: 16000,
        hi: 60000
      }
    };

    // Realistic scrap base pricing for other vehicle categories
    const vBasePricing = {
      'Car': [16000, 60000],
      'Two-Wheeler': [3200, 7500],
      'Three-Wheeler': [11000, 18000],
      'Commercial Vehicle': [38000, 75000],
      'Bus': [75000, 120000],
      'Truck / Heavy Vehicle': [95000, 160000],
      'Other': [16000, 60000]
    };

    const fuelMultipliers = {
      'Diesel': 1.04,
      'Petrol': 1.0,
      'CNG': 1.02,
      'Electric': 1.06,
      'Hybrid': 1.04
    };

    const condMultipliers = {
      'Running & Complete': {
        mult: 1.0,
        cls: 'bg-success-subtle text-success border border-success-subtle'
      },
      'Running': {
        mult: 1.0,
        cls: 'bg-success-subtle text-success border border-success-subtle'
      },
      'Not Running': {
        mult: 0.80,
        cls: 'bg-info-subtle text-info-emphasis border border-info-subtle'
      },
      'Non-Running': {
        mult: 0.80,
        cls: 'bg-info-subtle text-info-emphasis border border-info-subtle'
      },
      'Accident / Damaged': {
        mult: 0.65,
        cls: 'bg-warning-subtle text-dark border border-warning-subtle'
      },
      'Accidental / Damaged': {
        mult: 0.65,
        cls: 'bg-warning-subtle text-dark border border-warning-subtle'
      },
      'Flood Damaged': {
        mult: 0.55,
        cls: 'bg-secondary-subtle text-secondary border border-secondary-subtle'
      },
      'Missing Parts': {
        mult: 0.50,
        cls: 'bg-warning-subtle text-dark border border-warning-subtle'
      },
      'Burnt': {
        mult: 0.35,
        cls: 'bg-danger-subtle text-danger border border-danger-subtle'
      }
    };

    // Category-specific Brand & Fuel Configurations
    const vehicleTypeConfigs = {
      'Car': {
        heading: 'Car Brand & Fuel Type',
        subText: 'Specify car brand and fuel for accurate metal & engine scrap value.',
        brandLabel: 'Car Brand *',
        placeholder: 'e.g. Maruti Suzuki, Hyundai, Tata, Honda, Mahindra',
        quickBrands: ['Maruti Suzuki', 'Hyundai', 'Tata Motors', 'Mahindra', 'Honda', 'Toyota'],
        allBrands: ['Maruti Suzuki', 'Hyundai', 'Tata Motors', 'Mahindra', 'Honda', 'Toyota', 'Kia', 'Volkswagen', 'Skoda', 'Renault', 'Ford', 'Nissan', 'MG', 'Chevrolet', 'Fiat', 'Jeep'],
        fuels: ['Petrol', 'Diesel', 'CNG', 'Electric', 'Hybrid']
      },
      'Two-Wheeler': {
        heading: 'Bike / Scooter Brand & Fuel',
        subText: 'Specify two-wheeler make and powertrain for accurate scrap rate.',
        brandLabel: 'Bike / Two-Wheeler Brand *',
        placeholder: 'e.g. Hero, Honda, Bajaj, TVS, Royal Enfield, Yamaha',
        quickBrands: ['Hero', 'Honda', 'Bajaj', 'TVS', 'Royal Enfield', 'Yamaha'],
        allBrands: ['Hero MotoCorp', 'Honda', 'Bajaj', 'TVS', 'Royal Enfield', 'Yamaha', 'Suzuki', 'KTM', 'Ather Energy', 'Ola Electric', 'Jawa', 'Aprilia', 'Piaggio Vespa', 'Yezdi'],
        fuels: ['Petrol', 'Electric']
      },
      'Three-Wheeler': {
        heading: 'Three-Wheeler Brand & Fuel',
        subText: 'Specify auto rickshaw or cargo brand and fuel type.',
        brandLabel: 'Three-Wheeler Brand *',
        placeholder: 'e.g. Bajaj, Piaggio (Ape), Mahindra, TVS, Atul Auto',
        quickBrands: ['Bajaj', 'Piaggio (Ape)', 'Mahindra', 'TVS', 'Atul Auto'],
        allBrands: ['Bajaj Auto', 'Piaggio (Ape)', 'Mahindra', 'TVS Motor', 'Atul Auto', 'Saarthi', 'Terra Motors', 'Kinetic Green'],
        fuels: ['CNG', 'Diesel', 'Petrol', 'Electric']
      },
      'Commercial Vehicle': {
        heading: 'Commercial Brand & Fuel Type',
        subText: 'Specify LCV, pickup, or mini-truck make for scrap calculation.',
        brandLabel: 'Commercial Vehicle Brand *',
        placeholder: 'e.g. Tata (Ace/407), Mahindra (Bolero), Ashok Leyland',
        quickBrands: ['Tata Motors', 'Mahindra', 'Ashok Leyland', 'Maruti', 'Force'],
        allBrands: ['Tata Motors (Ace/407)', 'Mahindra (Bolero/Maxximo)', 'Ashok Leyland (Dost)', 'Maruti Suzuki (Super Carry)', 'Force Motors', 'Eicher', 'Isuzu'],
        fuels: ['Diesel', 'CNG', 'Petrol', 'Electric']
      },
      'Bus': {
        heading: 'Bus Brand & Fuel Type',
        subText: 'Specify passenger bus or coach brand for body metal tonnage valuation.',
        brandLabel: 'Bus Brand *',
        placeholder: 'e.g. Ashok Leyland, Tata Motors, Eicher, BharatBenz',
        quickBrands: ['Ashok Leyland', 'Tata Motors', 'Eicher', 'BharatBenz', 'Force'],
        allBrands: ['Ashok Leyland', 'Tata Motors', 'Eicher', 'BharatBenz', 'Force Motors', 'Volvo', 'Scania', 'SML Isuzu'],
        fuels: ['Diesel', 'CNG', 'Electric']
      },
      'Truck / Heavy Vehicle': {
        heading: 'Truck Brand & Fuel Type',
        subText: 'Specify heavy truck or tipper brand for heavy iron scrap calculation.',
        brandLabel: 'Truck / Heavy Brand *',
        placeholder: 'e.g. Tata Motors, Ashok Leyland, BharatBenz, Eicher',
        quickBrands: ['Tata Motors', 'Ashok Leyland', 'Eicher', 'BharatBenz', 'Mahindra'],
        allBrands: ['Tata Motors', 'Ashok Leyland', 'Eicher', 'BharatBenz', 'Mahindra', 'Force Motors', 'Volvo', 'Scania', 'SML Isuzu', 'AMW'],
        fuels: ['Diesel', 'CNG', 'Electric']
      },
      'Other': {
        heading: 'Vehicle Brand & Fuel Type',
        subText: 'Specify vehicle brand or manufacturer.',
        brandLabel: 'Vehicle Brand *',
        placeholder: 'e.g. Enter vehicle manufacturer',
        quickBrands: ['Tata', 'Mahindra', 'Maruti', 'Honda', 'Ashok Leyland'],
        allBrands: ['Tata', 'Mahindra', 'Maruti Suzuki', 'Hyundai', 'Honda', 'Toyota', 'Hero', 'Bajaj', 'TVS', 'Ashok Leyland', 'Eicher'],
        fuels: ['Petrol', 'Diesel', 'CNG', 'Electric', 'Hybrid']
      }
    };

    let prevSelectedVehicleType = '';

    function applyVehicleTypeTheme(vType) {
      if (!vType || !vehicleTypeConfigs[vType]) vType = 'Car';
      const cfg = vehicleTypeConfigs[vType];

      // Update Step 2 Heading Title & Desc
      const s2Title = document.getElementById('step2HeadingTitle');
      const s2Desc = document.getElementById('step2HeadingDesc');
      if (s2Title) s2Title.textContent = cfg.heading;
      if (s2Desc) s2Desc.textContent = cfg.subText;

      // Update Brand Label & Input
      const brandLabel = document.getElementById('vBrandLabel');
      const brandInput = document.getElementById('vBrand');
      if (brandLabel) brandLabel.textContent = cfg.brandLabel;
      if (brandInput) {
        brandInput.placeholder = cfg.placeholder;
        // If switching between categories, reset incompatible brand
        if (prevSelectedVehicleType && prevSelectedVehicleType !== vType) {
          const prevVal = brandInput.value.trim().toLowerCase();
          const matches = cfg.allBrands.some(b => b.toLowerCase().includes(prevVal) || (prevVal.length > 2 && prevVal.includes(b.toLowerCase().split(' ')[0])));
          if (!matches) {
            brandInput.value = '';
          }
        }
      }

      // Update Datalist
      const dl = document.getElementById('vBrandList');
      if (dl) {
        dl.innerHTML = cfg.allBrands.map(b => `<option value="${b}">`).join('');
      }

      // Render Quick Brand Chips
      const qcContainer = document.getElementById('vBrandQuickChips');
      if (qcContainer) {
        const curVal = (brandInput ? brandInput.value.trim().toLowerCase() : '');
        qcContainer.innerHTML = cfg.quickBrands.map(b => {
          const isActive = (curVal && (curVal === b.toLowerCase() || curVal.includes(b.toLowerCase())));
          return `<button type="button" class="quick-brand-chip ${isActive ? 'active' : ''}" data-brand="${b}">${b}</button>`;
        }).join('');

        qcContainer.querySelectorAll('.quick-brand-chip').forEach(btn => {
          btn.addEventListener('click', (e) => {
            e.preventDefault();
            const brandVal = btn.getAttribute('data-brand');
            if (brandInput) {
              brandInput.value = brandVal;
              clearFieldError('vBrand', 'err-vBrand');
            }
            qcContainer.querySelectorAll('.quick-brand-chip').forEach(c => c.classList.remove('active'));
            btn.classList.add('active');
            updateVehiclePreview();
            pulsePreviewCard();
            saveLotDraft();
          });
        });
      }

      // Filter Fuel Types in #fuelSeg
      const fuelLabels = document.querySelectorAll('#fuelSeg label[data-fuel]');
      fuelLabels.forEach(lbl => {
        const f = lbl.getAttribute('data-fuel');
        if (cfg.fuels.includes(f)) {
          lbl.style.display = '';
        } else {
          lbl.style.display = 'none';
          const r = lbl.querySelector('input');
          if (r && r.checked) {
            r.checked = false;
            clearFieldError(null, 'err-v_fuel');
          }
        }
      });

      prevSelectedVehicleType = vType;
    }

    function showFieldError(fieldId, errId, msg) {
      const errEl = document.getElementById(errId);
      if (errEl) {
        if (msg) errEl.textContent = msg;
        errEl.classList.add('show');
        errEl.classList.remove('shake-err');
        void errEl.offsetWidth;
        errEl.classList.add('shake-err');
      }
      if (fieldId) {
        const inputEl = document.getElementById(fieldId);
        if (inputEl) {
          inputEl.classList.add('is-invalid');
          inputEl.classList.remove('shake-err');
          void inputEl.offsetWidth;
          inputEl.classList.add('shake-err');
        }
      }
    }

    function clearFieldError(fieldId, errId) {
      const errEl = document.getElementById(errId);
      if (errEl) {
        errEl.classList.remove('show');
        errEl.classList.remove('shake-err');
      }
      if (fieldId) {
        const inputEl = document.getElementById(fieldId);
        if (inputEl) {
          inputEl.classList.remove('is-invalid');
          inputEl.classList.remove('shake-err');
        }
      }
    }

    // Real-time error dismissal
    const inputs = [{
        field: 'vBrand',
        err: 'err-vBrand'
      },
      {
        field: 'vCity',
        err: 'err-vCity'
      },
      {
        field: 'vPin',
        err: 'err-vPin'
      },
      {
        field: 'userName',
        err: 'err-userName'
      },
      {
        field: 'userPhone',
        err: 'err-userPhone'
      },
      {
        field: 'userEmail',
        err: 'err-userEmail'
      }
    ];

    inputs.forEach(item => {
      const el = document.getElementById(item.field);
      if (el) {
        el.addEventListener('input', () => clearFieldError(item.field, item.err));
        el.addEventListener('change', () => clearFieldError(item.field, item.err));
      }
    });

    const radios = [{
        name: 'v_type',
        err: 'err-v_type'
      },
      {
        name: 'v_fuel',
        err: 'err-v_fuel'
      },
      {
        name: 'v_cond',
        err: 'err-v_cond'
      },
      {
        name: 'v_when',
        err: 'err-v_when'
      }
    ];

    radios.forEach(item => {
      lotForm.querySelectorAll(`[name="${item.name}"]`).forEach(r => {
        r.addEventListener('change', () => {
          clearFieldError(null, item.err);
          if (item.name === 'v_type') {
            applyVehicleTypeTheme(r.value);
          }
        });
      });
    });

    function calcScrapEstimate(type, fuel, cond, brand) {
      let baseLo = 16000;
      let baseHi = 60000;

      if (!type || type === 'Car') {
        const bInput = (brand || '').trim().toLowerCase();
        let matchedBrand = null;
        for (const [bName, range] of Object.entries(carBrandPricing)) {
          const bLower = bName.toLowerCase();
          if (bInput && (bInput === bLower || bInput.includes(bLower) || bLower.includes(bInput))) {
            matchedBrand = range;
            break;
          }
        }
        if (matchedBrand) {
          baseLo = matchedBrand.lo;
          baseHi = matchedBrand.hi;
        } else {
          baseLo = carBrandPricing['Other'].lo;
          baseHi = carBrandPricing['Other'].hi;
        }
      } else {
        const base = vBasePricing[type] || [16000, 60000];
        baseLo = base[0];
        baseHi = base[1];
      }

      const fMult = fuelMultipliers[fuel] || 1.0;
      const cInfo = condMultipliers[cond] || {
        mult: 1.0,
        cls: 'bg-success-subtle text-success border border-success-subtle'
      };
      const cMult = cInfo.mult;

      let minVal = Math.round((baseLo * fMult * cMult) / 500) * 500;
      let maxVal = Math.round((baseHi * fMult * cMult) / 500) * 500;
      if (maxVal <= minVal) maxVal = minVal + 1500;

      return {
        formatted: `₹ ${minVal.toLocaleString('en-IN')} – ₹ ${maxVal.toLocaleString('en-IN')}`,
        condClass: cInfo.cls
      };
    }

    function updateVehiclePreview() {
      const gRadio = name => {
        const el = lotForm.querySelector(`[name="${name}"]:checked`);
        return el ? el.value : '';
      };

      const vType = gRadio('v_type');
      const vBrand = (lotForm.querySelector('#vBrand')?.value || '').trim();
      const vFuel = gRadio('v_fuel');
      const vCond = gRadio('v_cond');
      const vCity = (lotForm.querySelector('#vCity')?.value || '').trim();
      const vWhen = gRadio('v_when');

      // Update Preview Elements
      const pIcon = document.getElementById('pIcon');
      const pTitleIcon = document.getElementById('pTitleIcon');
      const pTitle = document.getElementById('pTitle');
      const pSub = document.getElementById('pSub');
      const pCity = document.getElementById('pCity');
      const pWhen = document.getElementById('pWhen');
      const pVal = document.getElementById('pVal');
      const pValNote = document.getElementById('pValNote');
      const hidVal = document.getElementById('hiddenEstVal');
      const condBadge = document.getElementById('pCondBadge');

      // 1. Vehicle Title: Clean format without empty brackets
      if (vType) {
        const info = vIconMap[vType] || {
          icon: 'bi-car-front-fill'
        };
        if (pIcon) pIcon.className = 'bi ' + info.icon;
        if (pTitleIcon) pTitleIcon.className = 'bi ' + info.icon + ' text-success';
        if (pTitle) {
          pTitle.textContent = vBrand ? `${vBrand} — ${vType}` : vType;
        }
      } else {
        if (pIcon) pIcon.className = 'bi bi-car-front';
        if (pTitleIcon) pTitleIcon.className = 'bi bi-car-front text-success';
        if (pTitle) {
          pTitle.textContent = vBrand || 'Select Vehicle';
        }
      }

      // 2. Fuel Type: Only show when selected
      if (pSub) {
        if (vFuel) {
          pSub.innerHTML = `<span class="text-success fw-bold" style="font-size: 0.94rem;"><i class="bi bi-fuel-pump me-1"></i>Fuel: ${vFuel}</span>`;
        } else {
          pSub.innerHTML = `<span class="text-muted" style="font-size: 0.94rem; font-weight: 600;"><i class="bi bi-fuel-pump me-1"></i>Fuel: Pending</span>`;
        }
      }

      // 3. City / Location: Only show when entered
      if (pCity) {
        pCity.textContent = vCity ? vCity : 'Location: Pending';
      }

      // 4. Pickup Timeframe: Only show when selected (no false fallback)
      if (pWhen) {
        pWhen.textContent = vWhen ? `Pickup: ${vWhen}` : 'Pickup: Pending';
      }

      // 5. Condition: Only show when selected
      if (condBadge) {
        if (vCond) {
          const cInfo = condMultipliers[vCond] || {
            cls: 'bg-success-subtle text-success border border-success-subtle'
          };
          condBadge.innerHTML = `<span class="badge ${cInfo.cls} py-1.5 px-3 fw-bold shadow-xs" style="border-radius: 14px; font-size: 0.86rem;"><i class="bi bi-check2-circle me-1"></i>${vCond}</span>`;
        } else {
          condBadge.innerHTML = `<span class="badge bg-white text-muted border py-1.5 px-3 fw-bold shadow-xs" style="border-radius: 14px; font-size: 0.86rem;"><i class="bi bi-hourglass me-1"></i>Condition: Pending</span>`;
        }
      }

      // 6. Valuation Price: Only calculate and reveal when Step 5 is complete or all key details are present!
      const isReadyForValuation = (currentStep === 6) || (vType && vFuel && vCond && vCity && vWhen);

      if (isReadyForValuation && vType) {
        const est = calcScrapEstimate(vType, vFuel, vCond, vBrand);
        if (pVal) {
          pVal.innerHTML = `<span class="fw-bold text-success">${est.formatted}</span>`;
        }
        if (hidVal) hidVal.value = est.formatted;
        if (pValNote) {
          pValNote.textContent = 'Instant doorstep scrap estimate based on live metal rates';
        }
      } else {
        if (pVal) {
          pVal.innerHTML = `<span class="badge bg-white text-secondary border px-3 py-1.5 fw-bold shadow-xs" style="border-radius: 14px; font-size: 0.88rem;"><span class="spinner-grow spinner-grow-sm text-success me-1.5" style="width: 7px; height: 7px;" role="status"></span>Calculating after Step 5</span>`;
        }
        if (hidVal) hidVal.value = '';
        if (pValNote) {
          pValNote.textContent = 'Complete Step 1 to 5 to reveal doorstep scrap value';
        }
      }

    }

    function updateMeter(step) {
      const pcts = {
        1: 16,
        2: 33,
        3: 50,
        4: 67,
        5: 84,
        6: 100
      };
      const pct = pcts[step || currentStep] || 16;
      const meter = document.getElementById('meter');
      const meterTxt = document.getElementById('meterTxt');
      if (meter) meter.style.setProperty('--p', pct);
      if (meterTxt) meterTxt.textContent = pct + '%';
    }

    let currentStep = 1;
    const stepWraps = {
      1: document.getElementById('step1Wrap'),
      2: document.getElementById('step2Wrap'),
      3: document.getElementById('step3Wrap'),
      4: document.getElementById('step4Wrap'),
      5: document.getElementById('step5Wrap'),
      6: document.getElementById('step6Wrap')
    };

    function updateStep6Summary() {
      const gRadio = name => {
        const el = lotForm.querySelector(`[name="${name}"]:checked`);
        return el ? el.value : '';
      };
      const vType = gRadio('v_type') || 'Vehicle';
      const vBrand = (lotForm.querySelector('#vBrand')?.value || '').trim();
      const vFuel = gRadio('v_fuel');
      const vCond = gRadio('v_cond') || 'Condition';
      const vCity = (lotForm.querySelector('#vCity')?.value || '').trim();
      const vWhen = gRadio('v_when') || '';

      const sumTitle = document.getElementById('summaryVehicleName');
      const sumMeta = document.getElementById('summaryVehicleMeta');
      if (sumTitle) {
        sumTitle.textContent = (vBrand ? vBrand + ' — ' : '') + vType + (vFuel ? ` • ${vFuel}` : '');
      }
      if (sumMeta) {
        sumMeta.textContent = `${vCond} • ${vCity || 'City'}` + (vWhen ? ` • Pickup: ${vWhen}` : '');
      }
    }

    function goToStep(stepNum, skipScroll = false) {
      for (let s = 1; s <= 6; s++) {
        if (stepWraps[s]) {
          stepWraps[s].style.display = (s === stepNum) ? 'block' : 'none';
        }
      }
      currentStep = stepNum;
      updateMeter(stepNum);
      updateVehiclePreview();
      pulsePreviewCard();

      if (stepNum === 2) {
        const vType = lotForm.querySelector('[name="v_type"]:checked')?.value || 'Car';
        applyVehicleTypeTheme(vType);
      }

      if (stepNum === 6) {
        updateStep6Summary();
        setTimeout(() => {
          const uNameInput = document.getElementById('userName');
          if (uNameInput && window.innerWidth > 768) {
            uNameInput.focus({ preventScroll: true });
          }
        }, 120);
      }

      saveLotDraft(stepNum);

      if (!skipScroll) {
        const rect = lotForm.getBoundingClientRect();
        if (rect.top < -50) {
          window.scrollTo({
            top: window.scrollY + rect.top - 60,
            behavior: 'smooth'
          });
        }
      }
    }

    // ==========================================================================
    // Indian Postal PIN Code Real-time Verification & State Management
    // ==========================================================================
    const postalCircles = {
      '11': 'Delhi', '12': 'Haryana', '13': 'Haryana', '14': 'Punjab', '15': 'Punjab', '16': 'Chandigarh / Punjab',
      '17': 'Himachal Pradesh', '18': 'Jammu & Kashmir', '19': 'Jammu & Kashmir / Ladakh',
      '20': 'Uttar Pradesh', '21': 'Uttar Pradesh', '22': 'Uttar Pradesh', '23': 'Uttar Pradesh', '24': 'Uttarakhand',
      '25': 'Uttar Pradesh', '26': 'Uttar Pradesh', '27': 'Uttar Pradesh', '28': 'Uttar Pradesh',
      '30': 'Rajasthan', '31': 'Rajasthan', '32': 'Rajasthan', '33': 'Rajasthan', '34': 'Rajasthan',
      '36': 'Gujarat', '37': 'Gujarat', '38': 'Gujarat', '39': 'Gujarat',
      '40': 'Maharashtra / Goa', '41': 'Maharashtra (Pune Region)', '42': 'Maharashtra', '43': 'Maharashtra', '44': 'Maharashtra (Nagpur Region)',
      '45': 'Madhya Pradesh', '46': 'Madhya Pradesh', '47': 'Madhya Pradesh', '48': 'Madhya Pradesh', '49': 'Chhattisgarh',
      '50': 'Telangana', '51': 'Andhra Pradesh', '52': 'Andhra Pradesh', '53': 'Andhra Pradesh',
      '56': 'Karnataka (Bengaluru Region)', '57': 'Karnataka', '58': 'Karnataka', '59': 'Karnataka',
      '60': 'Tamil Nadu (Chennai Region)', '61': 'Tamil Nadu', '62': 'Tamil Nadu', '63': 'Tamil Nadu', '64': 'Tamil Nadu',
      '67': 'Kerala', '68': 'Kerala', '69': 'Kerala',
      '70': 'West Bengal (Kolkata Region)', '71': 'West Bengal', '72': 'West Bengal', '73': 'West Bengal / Sikkim', '74': 'West Bengal',
      '75': 'Odisha', '76': 'Odisha', '77': 'Odisha',
      '78': 'Assam', '79': 'North Eastern States',
      '80': 'Bihar (Patna Region)', '81': 'Bihar', '82': 'Bihar', '83': 'Jharkhand', '84': 'Bihar', '85': 'Bihar'
    };

    const pinState = {
      pin: '',
      status: 'idle', // 'idle' | 'checking' | 'valid' | 'invalid'
      location: '',
      district: '',
      errorMsg: ''
    };

    function renderPinStatus() {
      const pinSpinner = document.getElementById('pinSpinner');
      const pinSuccessIcon = document.getElementById('pinSuccessIcon');
      const pinSuffixWrap = document.getElementById('pinSuffixWrap');
      const pinFeedback = document.getElementById('pinFeedback');
      const pinFetchStatus = document.getElementById('pinFetchStatus');

      if (pinState.status === 'checking') {
        if (pinSuffixWrap) pinSuffixWrap.style.display = 'flex';
        if (pinSpinner) pinSpinner.style.display = 'inline-block';
        if (pinSuccessIcon) pinSuccessIcon.style.display = 'none';
        if (pinFetchStatus) pinFetchStatus.textContent = 'Verifying...';
        if (pinFeedback) {
          pinFeedback.className = 'pin-feedback checking d-block';
          pinFeedback.innerHTML = '<span class="spinner-grow spinner-grow-sm text-success me-1" style="width: 8px; height: 8px;" role="status"></span>Verifying PIN ' + pinState.pin + '...';
        }
        clearFieldError('vPin', 'err-vPin');
      } else if (pinState.status === 'valid') {
        if (pinSuffixWrap) pinSuffixWrap.style.display = 'flex';
        if (pinSpinner) pinSpinner.style.display = 'none';
        if (pinSuccessIcon) pinSuccessIcon.style.display = 'inline-block';
        if (pinFetchStatus) pinFetchStatus.innerHTML = '<span class="text-success fw-bold"><i class="bi bi-shield-check me-1"></i>Verified</span>';
        if (pinFeedback) {
          pinFeedback.className = 'pin-feedback valid d-block';
          pinFeedback.innerHTML = '<i class="bi bi-geo-alt-fill text-success me-1"></i><strong>Verified:</strong> ' + pinState.location;
        }
        clearFieldError('vPin', 'err-vPin');
      } else if (pinState.status === 'invalid') {
        if (pinSuffixWrap) pinSuffixWrap.style.display = 'none';
        if (pinSpinner) pinSpinner.style.display = 'none';
        if (pinSuccessIcon) pinSuccessIcon.style.display = 'none';
        if (pinFetchStatus) pinFetchStatus.innerHTML = '<span class="text-danger fw-bold"><i class="bi bi-exclamation-circle me-1"></i>Invalid</span>';
        if (pinFeedback) {
          pinFeedback.className = 'pin-feedback';
          pinFeedback.style.display = 'none';
          pinFeedback.innerHTML = '';
        }
        showFieldError('vPin', 'err-vPin', pinState.errorMsg || 'Please enter a valid 6-digit Indian PIN.');
      } else {
        if (pinSuffixWrap) pinSuffixWrap.style.display = 'none';
        if (pinSpinner) pinSpinner.style.display = 'none';
        if (pinSuccessIcon) pinSuccessIcon.style.display = 'none';
        if (pinFetchStatus) pinFetchStatus.textContent = '';
        if (pinFeedback) {
          pinFeedback.className = 'pin-feedback';
          pinFeedback.style.display = 'none';
          pinFeedback.innerHTML = '';
        }
      }
    }

    let activePinFetchPromise = null;

    async function verifyPinCode(pin) {
      pin = (pin || '').trim();

      if (!pin) {
        pinState.pin = '';
        pinState.status = 'invalid';
        pinState.location = '';
        pinState.district = '';
        pinState.errorMsg = 'Please enter 6-digit PIN.';
        renderPinStatus();
        return false;
      }

      if (pin.length !== 6 || !/^[1-9][0-9]{5}$/.test(pin)) {
        pinState.pin = pin;
        pinState.status = 'invalid';
        pinState.location = '';
        pinState.district = '';
        pinState.errorMsg = (pin.startsWith('0')) ? 'Invalid PIN. Indian PIN codes cannot start with 0.' : 'Please enter a valid 6-digit Indian PIN.';
        renderPinStatus();
        return false;
      }

      // Check if already verified for this exact PIN
      if (pinState.pin === pin && (pinState.status === 'valid' || pinState.status === 'invalid')) {
        renderPinStatus();
        return pinState.status === 'valid';
      }

      // If a fetch is currently active for this same PIN, reuse it
      if (activePinFetchPromise && pinState.pin === pin && pinState.status === 'checking') {
        return activePinFetchPromise;
      }

      pinState.pin = pin;
      pinState.status = 'checking';
      pinState.location = '';
      pinState.district = '';
      pinState.errorMsg = '';
      renderPinStatus();

      activePinFetchPromise = (async () => {
        const controller = new AbortController();
        const timeoutId = setTimeout(() => controller.abort(), 4000);

        try {
          const res = await fetch('https://api.postalpincode.in/pincode/' + pin, {
            signal: controller.signal
          });
          clearTimeout(timeoutId);

          if (!res.ok) throw new Error('Network error: ' + res.status);
          const data = await res.json();

          if (data && data[0] && data[0].Status === 'Success' && Array.isArray(data[0].PostOffice) && data[0].PostOffice.length > 0) {
            const po = data[0].PostOffice[0];
            const district = po.District || po.Circle || '';
            const state = po.State || '';
            const locLabel = district ? (district + (state ? ', ' + state : '')) : (state || 'India');

            pinState.pin = pin;
            pinState.status = 'valid';
            pinState.location = locLabel;
            pinState.district = district;
            pinState.errorMsg = '';
            renderPinStatus();

            const cityInput = document.getElementById('vCity');
            if (cityInput && (!cityInput.value.trim() || cityInput.value.trim() === 'Pending')) {
              if (district) {
                cityInput.value = district;
                clearFieldError('vCity', 'err-vCity');
                updateVehiclePreview();
                pulsePreviewCard();
              }
            }
            saveLotDraft();
            return true;
          } else {
            // Explicit error from India Post directory
            pinState.pin = pin;
            pinState.status = 'invalid';
            pinState.location = '';
            pinState.district = '';
            pinState.errorMsg = 'Invalid PIN Code: No Indian post office found for ' + pin;
            renderPinStatus();
            return false;
          }
        } catch (err) {
          // If network error/timeout, check postal circles fallback
          const prefix = pin.substring(0, 2);
          const region = postalCircles[prefix];
          const isDummy = ['111111', '222222', '333333', '444444', '555555', '666666', '777777', '888888', '999999'].includes(pin);
          if (region && !isDummy) {
            pinState.pin = pin;
            pinState.status = 'valid';
            pinState.location = region + ' Region';
            pinState.district = region.split(' ')[0];
            pinState.errorMsg = '';
            renderPinStatus();
            saveLotDraft();
            return true;
          } else {
            pinState.pin = pin;
            pinState.status = 'invalid';
            pinState.location = '';
            pinState.district = '';
            pinState.errorMsg = 'Invalid PIN Code: Please enter a valid 6-digit Indian PIN.';
            renderPinStatus();
            return false;
          }
        } finally {
          activePinFetchPromise = null;
        }
      })();

      return activePinFetchPromise;
    }

    // ==========================================================================
    // Multi-Step Validation: Strict Gating Across Steps 1 - 6
    // ==========================================================================

    // Step 1 Validation: Vehicle Category
    function validateStep1() {
      const vType = lotForm.querySelector('[name="v_type"]:checked');
      if (!vType) {
        showFieldError(null, 'err-v_type', 'Please select a vehicle category to proceed.');
        const chips = document.getElementById('vTypeChips');
        if (chips) {
          chips.classList.remove('shake-err');
          void chips.offsetWidth;
          chips.classList.add('shake-err');
          chips.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
          });
        }
        return false;
      }
      clearFieldError(null, 'err-v_type');
      return true;
    }

    // Step 2 Validation: Brand & Fuel Type
    function validateStep2() {
      let isValid = true;
      let firstInvalidEl = null;

      const vBrand = (lotForm.querySelector('#vBrand')?.value || '').trim();
      if (!vBrand || vBrand.length < 2) {
        showFieldError('vBrand', 'err-vBrand', 'Please enter or select a vehicle brand.');
        isValid = false;
        if (!firstInvalidEl) firstInvalidEl = lotForm.querySelector('#vBrand');
      }

      const vFuel = lotForm.querySelector('[name="v_fuel"]:checked');
      if (!vFuel) {
        showFieldError(null, 'err-v_fuel', 'Please select a fuel type.');
        isValid = false;
        const fuelSeg = document.getElementById('fuelSeg');
        if (fuelSeg) {
          fuelSeg.classList.remove('shake-err');
          void fuelSeg.offsetWidth;
          fuelSeg.classList.add('shake-err');
        }
        if (!firstInvalidEl) firstInvalidEl = fuelSeg;
      }

      if (firstInvalidEl) {
        firstInvalidEl.scrollIntoView({
          behavior: 'smooth',
          block: 'center'
        });
        if (typeof firstInvalidEl.focus === 'function') firstInvalidEl.focus();
      }
      return isValid;
    }

    // Step 3 Validation: Condition
    function validateStep3() {
      const vCond = lotForm.querySelector('[name="v_cond"]:checked');
      if (!vCond) {
        showFieldError(null, 'err-v_cond', 'Please select vehicle condition.');
        const chips = document.getElementById('vCondChips');
        if (chips) {
          chips.classList.remove('shake-err');
          void chips.offsetWidth;
          chips.classList.add('shake-err');
          chips.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
          });
        }
        return false;
      }
      clearFieldError(null, 'err-v_cond');
      return true;
    }

    // Step 4 Validation: Pickup City & PIN Code (Strict Real-time Verification)
    async function validateStep4() {
      let isValid = true;
      let firstInvalidEl = null;

      const vCity = (lotForm.querySelector('#vCity')?.value || '').trim();
      if (!vCity || vCity.length < 2) {
        showFieldError('vCity', 'err-vCity', 'Please enter pickup city.');
        isValid = false;
        if (!firstInvalidEl) firstInvalidEl = lotForm.querySelector('#vCity');
      }

      const vPin = (lotForm.querySelector('#vPin')?.value || '').trim();
      if (!vPin) {
        showFieldError('vPin', 'err-vPin', 'Please enter 6-digit PIN.');
        isValid = false;
        if (!firstInvalidEl) firstInvalidEl = lotForm.querySelector('#vPin');
      } else if (!/^[1-9][0-9]{5}$/.test(vPin)) {
        showFieldError('vPin', 'err-vPin', 'Please enter a valid 6-digit Indian PIN (cannot start with 0).');
        isValid = false;
        if (!firstInvalidEl) firstInvalidEl = lotForm.querySelector('#vPin');
      } else {
        // PIN is 6 digits: attempt postal directory verification & auto-population
        try {
          await verifyPinCode(vPin);
        } catch (e) {}
        // If unlisted in directory but user already provided their city, allow proceeding
        if (pinState.status === 'invalid' && !vCity) {
          isValid = false;
          if (!firstInvalidEl) firstInvalidEl = lotForm.querySelector('#vPin');
        }
      }

      if (firstInvalidEl) {
        firstInvalidEl.scrollIntoView({
          behavior: 'smooth',
          block: 'center'
        });
        if (typeof firstInvalidEl.focus === 'function') firstInvalidEl.focus();
      }
      return isValid;
    }

    // Step 5 Validation: Pickup Timeframe
    function validateStep5() {
      const vWhen = lotForm.querySelector('[name="v_when"]:checked');
      if (!vWhen) {
        showFieldError(null, 'err-v_when', 'Please select pickup timeframe.');
        const seg = document.getElementById('whenSeg');
        if (seg) {
          seg.classList.remove('shake-err');
          void seg.offsetWidth;
          seg.classList.add('shake-err');
          seg.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
          });
        }
        return false;
      }
      clearFieldError(null, 'err-v_when');
      return true;
    }

    // Step 6 Validation: Contact Details
    function validateStep6() {
      let isValid = true;
      let firstInvalidEl = null;

      const uName = (lotForm.querySelector('#userName')?.value || '').trim();
      if (!uName || uName.length < 2) {
        showFieldError('userName', 'err-userName', 'Please enter your full name (minimum 2 characters).');
        isValid = false;
        if (!firstInvalidEl) firstInvalidEl = lotForm.querySelector('#userName');
      }

      const uPhone = (lotForm.querySelector('#userPhone')?.value || '').trim();
      if (!uPhone) {
        showFieldError('userPhone', 'err-userPhone', 'Please enter mobile number.');
        isValid = false;
        if (!firstInvalidEl) firstInvalidEl = lotForm.querySelector('#userPhone');
      } else if (!/^[6-9][0-9]{9}$/.test(uPhone)) {
        showFieldError('userPhone', 'err-userPhone', 'Please enter a valid 10-digit Indian mobile number.');
        isValid = false;
        if (!firstInvalidEl) firstInvalidEl = lotForm.querySelector('#userPhone');
      }

      const uEmail = (lotForm.querySelector('#userEmail')?.value || '').trim();
      if (!uEmail) {
        showFieldError('userEmail', 'err-userEmail', 'Please enter email address.');
        isValid = false;
        if (!firstInvalidEl) firstInvalidEl = lotForm.querySelector('#userEmail');
      } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(uEmail)) {
        showFieldError('userEmail', 'err-userEmail', 'Please enter a valid email address.');
        isValid = false;
        if (!firstInvalidEl) firstInvalidEl = lotForm.querySelector('#userEmail');
      }

      if (firstInvalidEl) {
        firstInvalidEl.scrollIntoView({
          behavior: 'smooth',
          block: 'center'
        });
        if (typeof firstInvalidEl.focus === 'function') firstInvalidEl.focus();
      }
      return isValid;
    }

    // ==========================================================================
    // Step Navigation Event Listeners (Strict Gating on Every Step)
    // ==========================================================================

    // Step 1 -> 2
    document.getElementById('btnStep1Next')?.addEventListener('click', (e) => {
      e.preventDefault();
      if (validateStep1()) goToStep(2);
    });

    // Step 2 -> 1, 2 -> 3
    document.getElementById('btnStep2Back')?.addEventListener('click', () => {
      goToStep(1);
    });
    document.getElementById('btnStep2Next')?.addEventListener('click', (e) => {
      e.preventDefault();
      if (validateStep2()) goToStep(3);
    });

    // Step 3 -> 2, 3 -> 4
    document.getElementById('btnStep3Back')?.addEventListener('click', () => {
      goToStep(2);
    });
    document.getElementById('btnStep3Next')?.addEventListener('click', (e) => {
      e.preventDefault();
      if (validateStep3()) goToStep(4);
    });

    // Step 4 -> 3, 4 -> 5 (Async Postal Verification Required to Proceed)
    document.getElementById('btnStep4Back')?.addEventListener('click', () => {
      goToStep(3);
    });
    document.getElementById('btnStep4Next')?.addEventListener('click', async (e) => {
      e.preventDefault();
      const nextBtn = document.getElementById('btnStep4Next');
      const origHtml = nextBtn ? nextBtn.innerHTML : '';
      if (nextBtn) {
        nextBtn.disabled = true;
        nextBtn.innerHTML = '<span>Verifying...</span> <span class="spinner-border spinner-border-sm" role="status"></span>';
      }
      try {
        const ok = await validateStep4();
        if (ok) {
          goToStep(5);
        }
      } finally {
        if (nextBtn) {
          nextBtn.disabled = false;
          nextBtn.innerHTML = origHtml;
        }
      }
    });

    // Step 5 -> 4, 5 -> 6
    document.getElementById('btnStep5Back')?.addEventListener('click', () => {
      goToStep(4);
    });
    document.getElementById('btnStep5Next')?.addEventListener('click', (e) => {
      e.preventDefault();
      if (validateStep5()) goToStep(6);
    });

    // Step 6 -> 5, Edit Vehicle -> 1
    document.getElementById('btnStep6Back')?.addEventListener('click', () => {
      goToStep(5);
    });
    document.getElementById('btnEditVehicle')?.addEventListener('click', () => {
      goToStep(1);
    });

    // Form Submission strictly inside Step 6
    const submitLotForm = async () => {
      // Validate Step 6
      if (!validateStep6()) return;

      // Verify all prior steps in strict sequence: if any fails, halt & redirect to that step
      if (!validateStep1()) {
        goToStep(1);
        return;
      }
      if (!validateStep2()) {
        goToStep(2);
        return;
      }
      if (!validateStep3()) {
        goToStep(3);
        return;
      }
      const isStep4Ok = await validateStep4();
      if (!isStep4Ok) {
        goToStep(4);
        return;
      }
      if (!validateStep5()) {
        goToStep(5);
        return;
      }

      let isLotSuccess = false;
      if (lotSubmitBtn) lotSubmitBtn.disabled = true;
      if (mobileSubmitBtn) mobileSubmitBtn.disabled = true;
      if (lotSpinner) lotSpinner.classList.remove('d-none');
      if (lotBtnIcon) lotBtnIcon.classList.add('d-none');
      if (lotBtnText) lotBtnText.textContent = 'Sending...';
      if (lotMsg) {
        lotMsg.className = 'small fw-semibold mt-3 text-center';
        lotMsg.textContent = '';
      }

      try {
        const fd = new FormData(lotForm);
        const postUrl = '<?= $actionUrl ?>';
        const res = await fetch(postUrl, {
          method: 'POST',
          body: fd
        });
        const rawText = await res.text();
        let data;
        try {
          data = JSON.parse(rawText);
        } catch (jsonErr) {
          console.error('Non-JSON server response:', rawText);
          throw new Error('Invalid server JSON response');
        }

        if (data.ok) {
          isLotSuccess = true;
          isLotFormSubmitted = true;
          try {
            sessionStorage.setItem('motozo_lot_submitted', 'true');
          } catch (e) {}
          clearLotDraft();
          const uName = (lotForm.querySelector('#userName')?.value || '').trim();
          const uCityVal = (lotForm.querySelector('#vCity')?.value || '').trim();
          const vType = (lotForm.querySelector('[name="v_type"]:checked')?.value || '').trim();
          try {
            lotForm.reset();
          } catch (e) {}

          if (lotMsg) {
            lotMsg.className = 'small fw-semibold mt-3 text-center ok';
            lotMsg.innerHTML = '<i class="bi bi-check-circle-fill me-1"></i> Success! Your scrap valuation request has been submitted. Redirecting...';
          }
          if (lotSpinner) lotSpinner.classList.add('d-none');
          if (lotBtnIcon) lotBtnIcon.classList.add('d-none');
          if (lotBtnText) lotBtnText.innerHTML = '<i class="bi bi-check2-circle me-1"></i> Request Submitted!';

          const thankYouUrl = '<?= (defined("BASE") ? BASE : "/") ?>thankyou.php?name=' + encodeURIComponent(uName) +
            '&city=' + encodeURIComponent(uCityVal) +
            '&v=' + encodeURIComponent(vType);

          setTimeout(() => {
            window.location.href = thankYouUrl;
          }, 450);
          return;
        } else {
          if (lotMsg) {
            lotMsg.className = 'small fw-semibold mt-3 text-center bad';
            lotMsg.textContent = data.error || 'Failed to submit. Please check your entries and try again.';
          }
        }
      } catch (err) {
        console.error("Lot form submit error:", err);
        if (lotMsg) {
          lotMsg.className = 'small fw-semibold mt-3 text-center bad';
          lotMsg.textContent = 'Submission error. Please try again or reach out to us via WhatsApp.';
        }
      } finally {
        if (!isLotSuccess) {
          if (lotSubmitBtn) lotSubmitBtn.disabled = false;
          if (mobileSubmitBtn) mobileSubmitBtn.disabled = false;
          if (lotSpinner) lotSpinner.classList.add('d-none');
          if (lotBtnIcon) lotBtnIcon.classList.remove('d-none');
          if (lotBtnText) lotBtnText.textContent = 'Get My Scrap Value';
        }
      }
    };

    if (lotSubmitBtn) {
      lotSubmitBtn.addEventListener('click', async (e) => {
        e.preventDefault();
        await submitLotForm();
      });
    }

    if (mobileSubmitBtn) {
      mobileSubmitBtn.addEventListener('click', async (e) => {
        e.preventDefault();
        await submitLotForm();
      });
    }

    lotForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      if (currentStep === 1) {
        if (validateStep1()) goToStep(2);
      } else if (currentStep === 2) {
        if (validateStep2()) goToStep(3);
      } else if (currentStep === 3) {
        if (validateStep3()) goToStep(4);
      } else if (currentStep === 4) {
        if (await validateStep4()) goToStep(5);
      } else if (currentStep === 5) {
        if (validateStep5()) goToStep(6);
      } else if (currentStep === 6) {
        await submitLotForm();
      }
    });

    const bpCard = document.querySelector('.bp-card');
    let cardPulseTimer = null;
    let pulseInputDebounce = null;

    function pulsePreviewCard() {
      if (!bpCard) return;
      bpCard.classList.add('card-pulse');
      clearTimeout(cardPulseTimer);
      cardPulseTimer = setTimeout(() => {
        bpCard.classList.remove('card-pulse');
      }, 320);
    }

    lotForm.addEventListener('input', () => {
      updateVehiclePreview();
      if (currentStep === 6) updateStep6Summary();
      clearTimeout(pulseInputDebounce);
      pulseInputDebounce = setTimeout(pulsePreviewCard, 180);
      saveLotDraft();
    });
    lotForm.addEventListener('change', () => {
      updateVehiclePreview();
      if (currentStep === 6) updateStep6Summary();
      pulsePreviewCard();
      saveLotDraft();
    });

    // Indian Postal PIN Code Real-time Input Setup
    function setupPinCodeVerifier() {
      const pinInput = document.getElementById('vPin');
      if (!pinInput) return;

      let pinTimeout = null;

      pinInput.addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '').slice(0, 6);
        const pin = this.value.trim();

        if (pinTimeout) clearTimeout(pinTimeout);

        if (pin.length < 6) {
          pinState.pin = pin;
          pinState.status = 'idle';
          pinState.location = '';
          pinState.district = '';
          pinState.errorMsg = '';
          renderPinStatus();
          clearFieldError('vPin', 'err-vPin');
          return;
        }

        if (!/^[1-9][0-9]{5}$/.test(pin)) {
          pinState.pin = pin;
          pinState.status = 'invalid';
          pinState.location = '';
          pinState.district = '';
          pinState.errorMsg = 'Invalid PIN. Indian PIN codes cannot start with 0.';
          renderPinStatus();
          return;
        }

        // 6 digits entered: debounce 250ms and verify
        pinTimeout = setTimeout(() => {
          verifyPinCode(pin);
        }, 250);
      });
    }

    // ==========================================================================
    // Form State Persistence: Auto-Save Draft & Resume After Page Refresh
    // ==========================================================================
    const DRAFT_STORAGE_KEY = 'motozo_lot_builder_draft_v2';

    function saveLotDraft(targetStep) {
      if (isLotFormSubmitted) return;
      try {
        if (sessionStorage.getItem('motozo_lot_submitted') === 'true') return;
      } catch (e) {}

      try {
        const stepNum = targetStep || currentStep || 1;
        const draft = {
          savedAt: Date.now(),
          step: stepNum,
          v_type: lotForm.querySelector('[name="v_type"]:checked')?.value || '',
          v_brand: (lotForm.querySelector('#vBrand')?.value || '').trim(),
          v_fuel: lotForm.querySelector('[name="v_fuel"]:checked')?.value || '',
          v_cond: lotForm.querySelector('[name="v_cond"]:checked')?.value || '',
          v_city: (lotForm.querySelector('#vCity')?.value || '').trim(),
          v_pincode: (lotForm.querySelector('#vPin')?.value || '').trim(),
          v_when: lotForm.querySelector('[name="v_when"]:checked')?.value || '',
          user_name: (lotForm.querySelector('#userName')?.value || '').trim(),
          user_phone: (lotForm.querySelector('#userPhone')?.value || '').trim(),
          user_email: (lotForm.querySelector('#userEmail')?.value || '').trim(),
          pinState: {
            status: pinState.status,
            pin: pinState.pin,
            location: pinState.location,
            district: pinState.district
          }
        };
        localStorage.setItem(DRAFT_STORAGE_KEY, JSON.stringify(draft));
      } catch (err) {
        // Ignore localStorage quota or private browsing errors
      }
    }

    function clearLotDraft() {
      try {
        localStorage.removeItem(DRAFT_STORAGE_KEY);
        localStorage.removeItem('motozo_lot_builder_draft_v1');
      } catch (err) {}
      try {
        sessionStorage.removeItem(DRAFT_STORAGE_KEY);
        sessionStorage.removeItem('motozo_lot_builder_draft_v1');
      } catch (err) {}
    }

    function restoreLotDraft() {
      try {
        if (isLotFormSubmitted) {
          clearLotDraft();
          return false;
        }
        try {
          if (sessionStorage.getItem('motozo_lot_submitted') === 'true') {
            sessionStorage.removeItem('motozo_lot_submitted');
            clearLotDraft();
            return false;
          }
        } catch (e) {}

        const raw = localStorage.getItem(DRAFT_STORAGE_KEY);
        if (!raw) return false;

        const draft = JSON.parse(raw);
        if (!draft || typeof draft !== 'object') return false;

        // Discard drafts older than 24 hours
        if (draft.savedAt && (Date.now() - draft.savedAt > 24 * 60 * 60 * 1000)) {
          clearLotDraft();
          return false;
        }

        // If draft has no vehicle selected and step is 1, don't consider it a meaningful draft
        if (!draft.v_type && !draft.v_brand && !draft.v_city) {
          clearLotDraft();
          return false;
        }

        // 1. Restore Vehicle Type (Step 1)
        if (draft.v_type) {
          const typeRadio = lotForm.querySelector(`[name="v_type"][value="${draft.v_type}"]`);
          if (typeRadio) {
            typeRadio.checked = true;
          }
          applyVehicleTypeTheme(draft.v_type);
        }

        // 2. Restore Brand & Fuel (Step 2)
        if (draft.v_brand) {
          const brandInput = document.getElementById('vBrand');
          if (brandInput) {
            brandInput.value = draft.v_brand;
            const bVal = draft.v_brand.toLowerCase();
            const qc = document.getElementById('vBrandQuickChips');
            if (qc) {
              qc.querySelectorAll('.quick-brand-chip').forEach(btn => {
                const b = btn.getAttribute('data-brand').toLowerCase();
                if (bVal && (bVal === b || bVal.includes(b))) {
                  btn.classList.add('active');
                } else {
                  btn.classList.remove('active');
                }
              });
            }
          }
        }
        if (draft.v_fuel) {
          const fuelRadio = lotForm.querySelector(`[name="v_fuel"][value="${draft.v_fuel}"]`);
          if (fuelRadio) fuelRadio.checked = true;
        }

        // 3. Restore Condition (Step 3)
        if (draft.v_cond) {
          const condRadio = lotForm.querySelector(`[name="v_cond"][value="${draft.v_cond}"]`);
          if (condRadio) condRadio.checked = true;
        }

        // 4. Restore City & PIN (Step 4)
        if (draft.v_city) {
          const cityInput = document.getElementById('vCity');
          if (cityInput) cityInput.value = draft.v_city;
        }
        if (draft.v_pincode) {
          const pinInput = document.getElementById('vPin');
          if (pinInput) pinInput.value = draft.v_pincode;
          if (draft.pinState && draft.pinState.status === 'valid' && draft.pinState.pin === draft.v_pincode) {
            pinState.pin = draft.pinState.pin;
            pinState.status = 'valid';
            pinState.location = draft.pinState.location || '';
            pinState.district = draft.pinState.district || '';
            pinState.errorMsg = '';
            renderPinStatus();
          }
        }

        // 5. Restore Pickup When (Step 5)
        if (draft.v_when) {
          const whenRadio = lotForm.querySelector(`[name="v_when"][value="${draft.v_when}"]`);
          if (whenRadio) whenRadio.checked = true;
        }

        // 6. Restore Contact Information (Step 6)
        if (draft.user_name) {
          const nameInput = document.getElementById('userName');
          if (nameInput) nameInput.value = draft.user_name;
        }
        if (draft.user_phone) {
          const phoneInput = document.getElementById('userPhone');
          if (phoneInput) phoneInput.value = draft.user_phone;
        }
        if (draft.user_email) {
          const emailInput = document.getElementById('userEmail');
          if (emailInput) emailInput.value = draft.user_email;
        }

        // Update preview card & Step 6 recap
        updateVehiclePreview();

        let resumeStep = parseInt(draft.step, 10);
        if (!resumeStep || isNaN(resumeStep) || resumeStep < 1 || resumeStep > 6) {
          resumeStep = 1;
        }

        // Safety gate: don't jump to steps > 1 if vehicle type was never chosen
        const hasVType = !!lotForm.querySelector('[name="v_type"]:checked');
        if (!hasVType && resumeStep > 1) {
          resumeStep = 1;
        }

        goToStep(resumeStep, true);
        return true;
      } catch (err) {
        console.warn('Failed to restore lot form draft:', err);
        return false;
      }
    }

    window.addEventListener('beforeunload', () => {
      if (!isLotFormSubmitted) {
        try {
          if (sessionStorage.getItem('motozo_lot_submitted') !== 'true') {
            saveLotDraft();
          }
        } catch (e) {
          saveLotDraft();
        }
      }
    });

    window.addEventListener('pageshow', (event) => {
      let wasSubmitted = false;
      try {
        wasSubmitted = (sessionStorage.getItem('motozo_lot_submitted') === 'true');
      } catch (e) {}

      if (event.persisted || isLotFormSubmitted || wasSubmitted) {
        clearLotDraft();
        try {
          sessionStorage.removeItem('motozo_lot_submitted');
        } catch (e) {}
        isLotFormSubmitted = false;
        try {
          lotForm.reset();
        } catch (e) {}
        applyVehicleTypeTheme('Car');
        goToStep(1, true);
        updateVehiclePreview();
        updateMeter(1);
      }
    });

    // Initialize
    setupPinCodeVerifier();
    const hasRestoredDraft = restoreLotDraft();
    if (!hasRestoredDraft) {
      goToStep(1, true);
      const initVType = lotForm.querySelector('[name="v_type"]:checked')?.value || 'Car';
      applyVehicleTypeTheme(initVType);
      updateVehiclePreview();
      updateMeter(1);
    }

    // Sync quick brand chips if user types manually into brand input
    const brandInputEl = document.getElementById('vBrand');
    if (brandInputEl) {
      brandInputEl.addEventListener('input', () => {
        const val = brandInputEl.value.trim().toLowerCase();
        const qc = document.getElementById('vBrandQuickChips');
        if (qc) {
          qc.querySelectorAll('.quick-brand-chip').forEach(btn => {
            const b = btn.getAttribute('data-brand').toLowerCase();
            if (val && (val === b || val.includes(b))) {
              btn.classList.add('active');
            } else {
              btn.classList.remove('active');
            }
          });
        }
      });
    }
  })();
</script>