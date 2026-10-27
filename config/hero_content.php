<?php
/**
 * ============================================================================
 * MOTOZO.IN — HERO CONTENT CONFIGURATION
 * ============================================================================
 * 
 * Har page (Home, Noida, Greater Noida, Delhi, Gurgaon, Ghaziabad, Faridabad)
 * ka Hero section content yahan se customize hota hai.
 * 
 * Sabhi district pages ka content distinct, unique aur local context ke mutabiq hai:
 * - Unique pill badges, headlines, flip animations, description leads, aur trust metrics.
 * ============================================================================
 */

return [
  // 1. Home Page (index.php)
  'home' => [
    'pill_icon'   => 'bi bi-shield-check',
    'pill_text'   => "India's most trusted vehicle scrapping partner",
    'pill_live'   => false,
    'title_line1' => 'Scrap Your Old Vehicle',
    'flip1'       => ['Easier.', 'Smarter.', 'Faster.', 'Greener.'],
    'title_line2' => 'Sell Your Old Vehicle',
    'flip2'       => ['Better.', 'Safer.', 'Instantly.', 'Higher.'],
    'lead'        => 'Get a free quote for your vehicle, doorstep pickup &amp; instant payment across Delhi NCR.',
    'trust'       => [
      ['icon' => 'bi-truck',          'text' => 'Free<br>Pickup'],
      ['icon' => 'bi-cash-stack',     'text' => 'Transparent<br>Pricing'],
      ['icon' => 'bi-currency-rupee', 'text' => 'Instant<br>Payment'],
    ],
  ],

  // 2. Delhi Page (car-scrap-dealer-delhi.php)
  'delhi' => [
    'pill_icon'   => 'bi bi-shield-check',
    'pill_text'   => 'Govt. Authorized RVSF Partner &bull; Delhi NCR',
    'pill_live'   => false,
    'title_line1' => 'Scrap Your End-of-Life Car in <span class="hero-city-name">Delhi</span>',
    'flip1'       => ['Legally.', 'Safely.', 'Quickly.', 'Hassle-Free.'],
    'title_line2' => '100% Protected RC Cancellation',
    'flip2'       => ['Best Rate.', 'Zero Risk.', 'Instant UPI.', 'Top Value.'],
    'lead'        => 'Avoid impoundment and penalties under Delhi CAQM mandates. Get maximum certified scrap value across all 14 DL RTO zones with free society basement towing &amp; instant bank transfer.',
    'trust'       => [
      ['icon' => 'bi-truck-flatbed',  'text' => 'Free DL<br>Towing'],
      ['icon' => 'bi-patch-check',    'text' => 'MoRTH<br>COD'],
      ['icon' => 'bi-shield-lock',    'text' => 'Zero Legal<br>Liability'],
    ],
  ],

  // 3. Noida Page (car-scrap-dealer-noida.php)
  'noida' => [
    'pill_icon'   => 'bi bi-shield-check',
    'pill_text'   => 'MoRTH Approved Vehicle Scrapping &bull; Noida UP-16',
    'pill_live'   => false,
    'title_line1' => 'Scrap Your Aging Vehicle in <span class="hero-city-name">Noida</span>',
    'flip1'       => ['Transparently.', 'Easier.', 'Smarter.', 'Greener.'],
    'title_line2' => 'Get Highest Certified Payout',
    'flip2'       => ['Direct RVSF.', 'Fair Weight.', 'Cash Fast.', 'Guaranteed.'],
    'lead'        => 'Authorized car dismantling under UP-16 RTO regulations. Get fair digital weight valuation, specialized society basement pickup, and guaranteed VAHAN RC deregistration.',
    'trust'       => [
      ['icon' => 'bi-building-down',        'text' => 'Basement<br>Pickup'],
      ['icon' => 'bi-file-earmark-check',   'text' => 'UP-16<br>Deregistration'],
      ['icon' => 'bi-cash-coin',            'text' => 'Instant Bank<br>Transfer'],
    ],
  ],

  // 4. Greater Noida Page (car-scrap-dealer-greater-noida.php)
  'greater-noida' => [
    'pill_icon'   => 'bi bi-shield-check',
    'pill_text'   => 'Authorized Green Scrapyard &bull; Greater Noida &amp; Yamuna Exp.',
    'pill_live'   => false,
    'title_line1' => 'Scrap Old Cars &amp; Fleets in <span class="hero-city-name">Greater Noida</span>',
    'flip1'       => ['Effortlessly.', 'Faster.', 'Higher Value.', 'Eco-Friendly.'],
    'title_line2' => 'Direct Authorized Dismantling',
    'flip2'       => ['Express Tow.', 'Verified.', 'MoRTH COD.', 'Top Cash.'],
    'lead'        => 'Certified green vehicle scrappage across Greater Noida &amp; Greater Noida West. Best scrap valuation, instant bank credit, and valid Certificate of Deposit (COD) for your new vehicle purchase.',
    'trust'       => [
      ['icon' => 'bi-speedometer2',     'text' => 'Expressway<br>Towing'],
      ['icon' => 'bi-award',            'text' => 'MoRTH<br>COD Slip'],
      ['icon' => 'bi-lightning-charge', 'text' => 'Same-Day<br>Payout'],
    ],
  ],

  // 5. Gurgaon Page (car-scrap-dealer-gurgaon.php)
  'gurgaon' => [
    'pill_icon'   => 'bi bi-shield-check',
    'pill_text'   => 'Certified End-of-Life Vehicle Scrapping &bull; Gurugram HR-26',
    'pill_live'   => false,
    'title_line1' => 'Scrap Your End-of-Life Car in <span class="hero-city-name">Gurgaon</span>',
    'flip1'       => ['Professionally.', 'Instantly.', 'Safely.', 'Better Return.'],
    'title_line2' => 'Corporate &amp; Private Vehicle Scrapping',
    'flip2'       => ['Corporate Grade.', 'Instant Pay.', 'No Hassle.', 'Highest Rate.'],
    'lead'        => 'Certified RVSF facility for Gurugram &amp; Manesar. Seamless de-registration on HR-26/HR-98 portals, maximum certified metal rate, and zero-liability Certificate of Deposit.',
    'trust'       => [
      ['icon' => 'bi-geo',             'text' => 'DLF &amp; Condo<br>Basement Tow'],
      ['icon' => 'bi-shield-check',    'text' => 'HR-26 Portal<br>COD'],
      ['icon' => 'bi-wallet2',         'text' => 'Instant IMPS<br>Payment'],
    ],
  ],

  // 6. Ghaziabad Page (car-scrap-dealer-ghaziabad.php)
  'ghaziabad' => [
    'pill_icon'   => 'bi bi-shield-check',
    'pill_text'   => 'Govt. Registered Scrappage Facility &bull; Ghaziabad UP-14',
    'pill_live'   => false,
    'title_line1' => 'Scrap Your Banned Vehicle in <span class="hero-city-name">Ghaziabad</span>',
    'flip1'       => ['Directly.', 'Smoothly.', 'Quickly.', 'Stress-Free.'],
    'title_line2' => '100% Legal UP-14 Deregistration',
    'flip2'       => ['Honest Weight.', 'Direct Bank Pay.', 'No Middleman.', 'Safe.'],
    'lead'        => 'Official RVSF scrapping partner across Ghaziabad, Indirapuram &amp; Vaishali. Instant valuation based on certified metal grades, free doorstep towing, and authorized VAHAN RC cancellation.',
    'trust'       => [
      ['icon' => 'bi-truck',           'text' => 'Indirapuram<br>Free Tow'],
      ['icon' => 'bi-check2-circle',   'text' => 'UP-14 VAHAN<br>Slip'],
      ['icon' => 'bi-currency-rupee',  'text' => 'Zero Towing<br>Deduction'],
    ],
  ],

  // 7. Faridabad Page (car-scrap-dealer-faridabad.php)
  'faridabad' => [
    'pill_icon'   => 'bi bi-shield-check',
    'pill_text'   => 'Authorized Industrial &amp; Car Scrapping &bull; Faridabad HR-38',
    'pill_live'   => false,
    'title_line1' => 'Scrap Your End-of-Life Vehicle in <span class="hero-city-name">Faridabad</span>',
    'flip1'       => ['Certified.', 'Honest Price.', 'Fast Towing.', 'Clean.'],
    'title_line2' => 'Authorized HR-38 &amp; HR-51 Scrapping',
    'flip2'       => ['Industrial Price.', 'Zero Tow Fee.', 'Clean Exit.', 'Max Return.'],
    'lead'        => 'Certified green vehicle recycling unit for Faridabad &amp; Ballabgarh. Get maximum industrial scrap recovery rates, free flatbed pickup, and legitimate Certificate of Deposit (COD).',
    'trust'       => [
      ['icon' => 'bi-wrench-adjustable', 'text' => 'NIT &amp; Neharpar<br>Pickup'],
      ['icon' => 'bi-shield-shaded',     'text' => 'HR-38 Portal<br>COD'],
      ['icon' => 'bi-cash-stack',        'text' => 'Spot Bank<br>Credit'],
    ],
  ],

  // 8. Jaipur Page (car-scrap-dealer-jaipur.php)
  'jaipur' => [
    'pill_icon'   => 'bi bi-shield-check',
    'pill_text'   => 'Authorized RVSF Scrapping Partner &bull; Jaipur RJ-14',
    'pill_live'   => false,
    'title_line1' => 'Scrap Your Vehicle in <span class="hero-city-name">Jaipur</span>',
    'flip1'       => ['Certified.', 'Fair Value.', 'Fast Tow.', 'Legal.'],
    'title_line2' => 'Pink City Authorized Vehicle Recycling',
    'flip2'       => ['Top Cash.', 'RJ-14 COD.', 'Zero Risk.', 'Instant UPI.'],
    'lead'        => 'Get maximum certified metal scrap rates across Jaipur. Doorstep pickup across Mansarovar, Vaishali Nagar &amp; Malviya Nagar with official Rajasthan COD road tax rebate.',
    'trust'       => [
      ['icon' => 'bi-truck',         'text' => 'Free Jaipur<br>Pickup'],
      ['icon' => 'bi-award',         'text' => 'RJ-14 VAHAN<br>COD'],
      ['icon' => 'bi-shield-check',  'text' => 'Certified<br>Deregistration'],
    ],
  ],

  // 9. Rajasthan Page (car-scrap-dealer-rajasthan.php)
  'rajasthan' => [
    'pill_icon'   => 'bi bi-shield-check',
    'pill_text'   => 'State-Wide Authorized Scrappage Hub &bull; Rajasthan',
    'pill_live'   => false,
    'title_line1' => 'Scrap End-of-Life Vehicles in <span class="hero-city-name">Rajasthan</span>',
    'flip1'       => ['State-Wide.', 'Authorized.', 'Hassle-Free.', 'Clean.'],
    'title_line2' => 'MoRTH Certified Vehicle Scrapping',
    'flip2'       => ['Best Rate.', '25% Tax Rebate.', 'Verified.', 'Safe.'],
    'lead'        => 'Rajasthan\'s government-approved vehicle scrappage facility. Complete electronic de-registration on RJ RTO portals, free towing, and official Certificate of Deposit (COD).',
    'trust'       => [
      ['icon' => 'bi-map',            'text' => 'All RJ Zones<br>Covered'],
      ['icon' => 'bi-percent',        'text' => '25% Road Tax<br>Rebate'],
      ['icon' => 'bi-currency-rupee', 'text' => 'Instant Digital<br>Payout'],
    ],
  ],

  // 10. Muzaffarnagar Page (car-scrap-dealer-muzaffarnagar.php)
  'muzaffarnagar' => [
    'pill_icon'   => 'bi bi-shield-check',
    'pill_text'   => 'Govt. Authorized Vehicle Scrappage &bull; Muzaffarnagar UP-12',
    'pill_live'   => false,
    'title_line1' => 'Scrap Your Banned Vehicle in <span class="hero-city-name">Muzaffarnagar</span>',
    'flip1'       => ['Directly.', 'Safely.', 'High Value.', 'Compliant.'],
    'title_line2' => '100% Legal UP-12 Deregistration',
    'flip2'       => ['Top Scrap Rate.', 'Zero Risk.', 'MoRTH COD.', 'Instant Pay.'],
    'lead'        => 'Authorized vehicle dismantler in Muzaffarnagar &amp; Western UP. Full legal compliance for 10-year diesel &amp; 15-year petrol cars with free doorstep towing &amp; instant bank credit.',
    'trust'       => [
      ['icon' => 'bi-truck-flatbed', 'text' => 'Free Doorstep<br>Towing'],
      ['icon' => 'bi-patch-check',   'text' => 'UP-12 VAHAN<br>COD'],
      ['icon' => 'bi-bank',          'text' => 'On-the-Spot<br>Transfer'],
    ],
  ],
];
