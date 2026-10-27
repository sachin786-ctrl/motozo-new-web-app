<?php

/**
 * ============================================================================
 * DISTRICT COVERAGE COMPONENT: district/coverage.php
 * Real Map (Leaflet + OpenStreetMap) with ALL covered localities as wave pins
 * Layout: Container > Row > 2 Columns (Real Map | Coverage Details)
 * ============================================================================
 */

declare(strict_types=1);

$cityName     = $districtData['name'] ?? ($districtName ?? 'District');
$districtSlug = $districtData['slug'] ?? ($districtSlug ?? 'delhi');
$gmapsKey     = $gmapsKey ?? (getenv('GOOGLE_MAPS_API_KEY') ?: ($_ENV['GOOGLE_MAPS_API_KEY'] ?? 'AIzaSyB6-Kya96EN5Mb-X-tFv9GKjBQdG-_T4tQ'));

/* City centres (fallback view) */
$cityCenters = [
  'delhi'     => [28.6139, 77.2090],
  'noida'     => [28.5700, 77.3500],
  'gurgaon'   => [28.4500, 77.0500],
  'ghaziabad' => [28.6692, 77.4200],
  'faridabad'     => [28.4000, 77.3150],
  'greater-noida' => [28.4744, 77.5040],
  'jaipur'        => [26.9124, 75.7873],
  'rajasthan'     => [27.0238, 74.2179],
  'muzaffarnagar' => [29.4727, 77.7085],
];

/* Locality => [lat, lng]  (approximate centre points) */
$defaultLocalities = [
  'delhi' => [
    'South Delhi' => [28.5500, 77.2200],
    'Dwarka' => [28.5921, 77.0460],
    'Rohini' => [28.7495, 77.0565],
    'Connaught Place' => [28.6315, 77.2167],
    'Janakpuri' => [28.6219, 77.0878],
    'Lajpat Nagar' => [28.5677, 77.2433],
    'Saket' => [28.5244, 77.2066],
    'Vasant Kunj' => [28.5200, 77.1590],
    'Pitampura' => [28.7007, 77.1311],
    'Karol Bagh' => [28.6519, 77.1909],
    'Mayur Vihar' => [28.6086, 77.2970],
    'Greater Kailash' => [28.5494, 77.2420],
    'Paschim Vihar' => [28.6692, 77.1019],
    'Shahdara' => [28.6735, 77.2890],
    'Laxmi Nagar' => [28.6304, 77.2773],
    'Punjabi Bagh' => [28.6683, 77.1313],
    'Model Town' => [28.7158, 77.1910],
    'Hauz Khas' => [28.5494, 77.2001],
    'Nehru Place' => [28.5491, 77.2530],
    'Okhla Industrial Area' => [28.5300, 77.2750],
  ],
  'noida' => [
    'Sector 18 (Atta)' => [28.5700, 77.3260],
    'Sector 62 (IT Hub)' => [28.6270, 77.3650],
    'Sector 137' => [28.5120, 77.4080],
    'Sector 50' => [28.5700, 77.3660],
    'Sector 76' => [28.5640, 77.3860],
    'Sector 15' => [28.5850, 77.3130],
    'Sector 128 (Wish Town)' => [28.5160, 77.3600],
    'Noida Expressway' => [28.5400, 77.3900],
    'Sector 44' => [28.5560, 77.3400],
    'Sector 104' => [28.5430, 77.3700],
    'Sector 75' => [28.5700, 77.3870],
    'Sector 120' => [28.5900, 77.3600],
    'Sector 37 (Golf Course)' => [28.5600, 77.3370],
    'Sector 93 (Grand Omaxe)' => [28.5280, 77.3850],
    'Sector 125 (Amity)' => [28.5440, 77.3330],
    'Sector 63 (Industrial)' => [28.6290, 77.3810],
    'Sector 80 (Phase 2)' => [28.5270, 77.4200],
    'Sector 142 (Advant)' => [28.5020, 77.4180],
    'Sector 150 (Sports City)' => [28.4600, 77.4580],
    'Sector 29' => [28.5680, 77.3330],
  ],
  'gurgaon' => [
    'DLF Phase 1-5' => [28.4750, 77.0950],
    'Cyber City' => [28.4950, 77.0890],
    'Golf Course Road' => [28.4510, 77.1020],
    'Golf Course Ext Road' => [28.4140, 77.0970],
    'Sohna Road' => [28.4100, 77.0420],
    'MG Road' => [28.4800, 77.0800],
    'Sector 56' => [28.4240, 77.1060],
    'Sector 14' => [28.4650, 77.0300],
    'Palam Vihar' => [28.5100, 77.0300],
    'Manesar IMT' => [28.3550, 76.9400],
    'New Gurgaon (Sec 82-95)' => [28.3900, 76.9900],
    'Sushant Lok' => [28.4590, 77.0700],
    'Sector 23' => [28.5040, 77.0480],
    'South City 1 & 2' => [28.4440, 77.0490],
    'Udyog Vihar' => [28.5050, 77.0830],
    'Nirvana Country' => [28.4000, 77.0700],
    'Gwal Pahari' => [28.4350, 77.1500],
    'Badshahpur' => [28.3870, 77.0480],
    'Sector 48' => [28.4200, 77.0300],
    'Sector 57' => [28.4150, 77.0800],
  ],
  'ghaziabad' => [
    'Indirapuram' => [28.6420, 77.3690],
    'Vaishali' => [28.6450, 77.3400],
    'Vasundhara' => [28.6600, 77.3600],
    'Raj Nagar Extension' => [28.6990, 77.4380],
    'Crossings Republik' => [28.6280, 77.4300],
    'Kaushambi' => [28.6450, 77.3230],
    'Sahibabad' => [28.6740, 77.3550],
    'Mohan Nagar' => [28.6710, 77.4040],
    'Kavi Nagar' => [28.6650, 77.4430],
    'Wave City' => [28.6850, 77.5050],
    'Shalimar Garden' => [28.6770, 77.3390],
    'Govindpuram' => [28.6830, 77.4570],
    'Loni' => [28.7530, 77.2890],
    'Surya Nagar' => [28.6670, 77.4220],
    'Sanjay Nagar' => [28.6900, 77.4440],
    'Patel Nagar' => [28.6720, 77.4300],
    'Bulandshahr Road Industrial Area' => [28.6450, 77.4700],
    'Pratap Vihar' => [28.7050, 77.4700],
    'Chander Nagar' => [28.6760, 77.4250],
  ],
  'faridabad' => [
    'NIT 1 to 5' => [28.3920, 77.3100],
    'Sector 15' => [28.4050, 77.3220],
    'Sector 16' => [28.4030, 77.3300],
    'Sector 21' => [28.4170, 77.3050],
    'Greater Faridabad (Neharpar)' => [28.3550, 77.3400],
    'Ballabgarh' => [28.3400, 77.3200],
    'Green Field Colony' => [28.4000, 77.2930],
    'Surajkund' => [28.4900, 77.2900],
    'Sector 28' => [28.4250, 77.3180],
    'Sector 31' => [28.4350, 77.3100],
    'Sector 37' => [28.4350, 77.3260],
    'Sainik Colony' => [28.4020, 77.3150],
    'Sector 14' => [28.4120, 77.3000],
    'Sector 9' => [28.3990, 77.3260],
    'Sector 8' => [28.4090, 77.3340],
    'Old Faridabad' => [28.4110, 77.3110],
    'Mathura Road Corridor' => [28.4300, 77.3000],
    'Sector 46' => [28.3730, 77.3260],
    'Sector 85' => [28.3500, 77.3300],
  ],
  'greater-noida' => [
    'Pari Chowk' => [28.4640, 77.5100],
    'Alpha 1 & 2' => [28.4750, 77.5230],
    'Beta 1 & 2' => [28.4760, 77.4990],
    'Gamma 1 & 2' => [28.4840, 77.5020],
    'Delta 1 & 2' => [28.4950, 77.5100],
    'Knowledge Park (1-5)' => [28.4640, 77.4860],
    'Greater Noida West (Gaur City)' => [28.6070, 77.4350],
    'Kasna Industrial Area' => [28.4190, 77.5080],
    'Surajpur Industrial Area' => [28.4990, 77.5230],
    'Ecotech (1 to 12)' => [28.4400, 77.5200],
    'Chi & Pi Sectors' => [28.4490, 77.5180],
    'Zeta & Eta Sectors' => [28.4900, 77.5300],
    'Omicron & Mu Sectors' => [28.5100, 77.5200],
    'Yamuna Expressway (Sec 17-22)' => [28.3800, 77.5350],
    'Jaypee Greens' => [28.4670, 77.5000],
    'Techzone 4' => [28.5950, 77.4450],
    'Sector 1-4 (Gr Noida West)' => [28.6150, 77.4400],
    'Sector 10 & 12 (Gr Noida West)' => [28.6010, 77.4600],
    'Bodaki Multimodal Hub' => [28.5080, 77.5500],
    'Dankaur & Bilaspur Belt' => [28.3500, 77.5500],
  ],
  'jaipur' => [
    'Vaishali Nagar' => [26.9070, 75.7420],
    'Malviya Nagar' => [26.8530, 75.8180],
    'Mansarovar' => [26.8600, 75.7600],
    'Raja Park' => [26.8950, 75.8270],
    'C-Scheme' => [26.9070, 75.7990],
    'Jagatpura' => [26.8280, 75.8500],
    'Pratap Nagar' => [26.8000, 75.8200],
    'Sanganer' => [26.8160, 75.7720],
    'Tonk Road' => [26.8500, 75.7950],
    'Ajmer Road' => [26.8850, 75.7300],
    'Vidhyadhar Nagar' => [26.9600, 75.7800],
    'Bani Park' => [26.9280, 75.7880],
    'Jhotwara' => [26.9450, 75.7360],
    'Sitapura Industrial Area' => [26.7750, 75.8450],
    'VKI Area' => [26.9850, 75.7680],
    'Gopalpura Bypass' => [26.8650, 75.7750],
    'Nirman Nagar' => [26.8850, 75.7500],
    'Civil Lines' => [26.9050, 75.7850],
    'Shastri Nagar' => [26.9400, 75.8000],
    'Durgapura' => [26.8450, 75.7880],
  ],
  'rajasthan' => [
    'Jaipur Central' => [26.9124, 75.7873],
    'Jodhpur Industrial' => [26.2700, 73.0200],
    'Kota Industrial Area' => [25.1800, 75.8300],
    'Udaipur City' => [24.5854, 73.7125],
    'Alwar NCR Belt' => [27.5530, 76.6346],
    'Bhiwadi Industrial' => [28.2100, 76.8600],
    'Bikaner' => [28.0229, 73.3119],
    'Ajmer' => [26.4499, 74.6399],
    'Bhilwara' => [25.3400, 74.6300],
    'Sikar' => [27.6100, 75.1400],
    'Bharatpur' => [27.2152, 77.5030],
    'Pali' => [25.7700, 73.3200],
    'Sri Ganganagar' => [29.9090, 73.8800],
    'Chittorgarh' => [24.8887, 74.6269],
    'Neemrana Japanese Zone' => [27.9850, 76.3850],
    'Beawar' => [26.1000, 74.3200],
    'Kishangarh' => [26.5700, 74.8700],
    'Hanumangarh' => [29.5800, 74.3200],
    'Dausa' => [26.8900, 76.3300],
    'Tonk' => [26.1600, 75.7900],
  ],
  'muzaffarnagar' => [
    'New Mandi' => [29.4750, 77.7180],
    'Gandhi Nagar' => [29.4680, 77.7050],
    'Civil Lines' => [29.4780, 77.7020],
    'Bhopa Road' => [29.4730, 77.7280],
    'Jansath Road' => [29.4620, 77.7220],
    'Shamli Road' => [29.4820, 77.6850],
    'Roorkee Road' => [29.4950, 77.7120],
    'Khatauli' => [29.2800, 77.7200],
    'Circular Road' => [29.4700, 77.6950],
    'Patel Nagar' => [29.4650, 77.7080],
    'Prem Puri' => [29.4600, 77.6980],
    'Rampur Tiraha' => [29.5300, 77.7300],
    'Muzaffarnagar Industrial Area' => [29.4850, 77.7350],
    'Sadar Bazar' => [29.4720, 77.7000],
    'Almaspur' => [29.4850, 77.7150],
    'Sujru' => [29.4550, 77.6850],
    'Kukra' => [29.4780, 77.7400],
    'Shahpur' => [29.3500, 77.5500],
    'Budhana' => [29.2800, 77.4700],
    'Charthawal' => [29.5500, 77.5900],
  ],
];

/* Accepts: ['Name' => [lat,lng]]  |  ['Name', ...]  |  [['name'=>..,'lat'=>..,'lng'=>..], ...] */
$raw = $districtData['localities'] ?? ($defaultLocalities[$districtSlug] ?? [
  $cityName . ' Central',
  $cityName . ' North',
  $cityName . ' South',
  $cityName . ' East',
  $cityName . ' West',
  $cityName . ' Industrial Area',
  $cityName . ' Extension',
  $cityName . ' Old City',
  $cityName . ' Cantt',
]);

$localities = [];
foreach ($raw as $k => $v) {
  if (is_array($v) && isset($v['name'])) {
    $localities[] = ['name' => (string)$v['name'], 'lat' => isset($v['lat']) ? (float)$v['lat'] : null, 'lng' => isset($v['lng']) ? (float)$v['lng'] : null];
  } elseif (is_array($v) && count($v) === 2 && is_string($k)) {
    $localities[] = ['name' => $k, 'lat' => (float)$v[0], 'lng' => (float)$v[1]];
  } else {
    $localities[] = ['name' => (string)$v, 'lat' => null, 'lng' => null]; // geocoded in browser
  }
}
/* Naam se coordinates fill karo (geocoding ki zaroorat nahi padegi) */
$lookup = $defaultLocalities[$districtSlug] ?? [];
foreach ($localities as &$L) {
  if ($L['lat'] === null && isset($lookup[$L['name']])) {
    $L['lat'] = (float)$lookup[$L['name']][0];
    $L['lng'] = (float)$lookup[$L['name']][1];
  }
}
unset($L);

$center = $districtData['center'] ?? ($cityCenters[$districtSlug] ?? [22.9734, 78.6569]);
$zoom   = isset($cityCenters[$districtSlug]) || isset($districtData['center']) ? 11 : 5;

$e = static fn(string $v): string => htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
$mapConfig = json_encode([
  'city'       => $cityName,
  'center'     => $center,
  'zoom'       => $zoom,
  'key'        => $gmapsKey,
  'localities' => $localities,
]);
$covEyebrow = $districtData['coverage']['eyebrow'] ?? 'Coverage';
$covBadge   = $districtData['coverage']['badge'] ?? (count($localities) . ' Areas Covered');
$covTitle   = $districtData['coverage']['title'] ?? ('Free doorstep towing across <span class="d-cov-city">' . $e($cityName) . '</span>');
$covSub     = $districtData['coverage']['sub'] ?? ('Every society, basement and commercial zone in ' . $e($cityName) . '. No towing charges.');
?>

<section class="d-cov" id="coverage">
  <div class="container">
    <div class="d-cov-eyebrow-wrap text-center mb-4">
      <span class="d-cov-eyebrow">
        <i class="bi bi-geo-alt-fill"></i> <?= htmlspecialchars($covEyebrow, ENT_QUOTES, 'UTF-8') ?>
      </span>
    </div>

    <div class="row g-4 g-xl-5 align-items-center">

      <!-- MAP -->
      <div class="col-lg-7">
        <div class="d-cov-map-card">
          <div class="d-cov-badge"><span class="d-cov-live"></span><?= $covBadge ?></div>
          <div id="dCovMap" class="d-cov-map" role="region" aria-label="<?= $e($cityName) ?> coverage map"></div>
        </div>
      </div>

      <!-- DETAILS -->
      <div class="col-lg-5">
        <h2 class="d-cov-title"><?= $covTitle ?></h2>
        <p class="d-cov-sub"><?= $covSub ?></p>

        <div class="d-cov-stats">
          <div><strong><?= count($localities) ?>+</strong><span>Areas Covered</span></div>
          <div><strong>₹0</strong><span>Towing Fee</span></div>
          <div><strong>2 hr</strong><span>Express Pickup</span></div>
        </div>

        <div class="d-cov-pills" id="dCovPills">
          <?php foreach ($localities as $i => $loc): ?>
            <button type="button" class="d-cov-pill" data-idx="<?= $i ?>"><?= $e($loc['name']) ?></button>
          <?php endforeach; ?>
        </div>

        <a href="#get-started" class="d-cov-btn">Schedule free pickup <i class="bi bi-arrow-right"></i></a>
      </div>

    </div>
  </div>
</section>

<script>
  (function() {
    var cfg = <?= $mapConfig ?>;
    var el = document.getElementById('dCovMap');
    if (!el || !cfg.key) return;

    var reduceMotion = window.matchMedia && matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* Map script tab section visible hone par hi load hoti hai (billing + speed) */
    var loaded = false;

    function loadMaps() {
      if (loaded) return;
      loaded = true;
      window.dCovInit = init;
      var s = document.createElement('script');
      s.src = 'https://maps.googleapis.com/maps/api/js?key=' + encodeURIComponent(cfg.key) +
        '&callback=dCovInit&loading=async&v=weekly&language=en&region=IN';
      s.async = true;
      document.head.appendChild(s);
    }
    if ('IntersectionObserver' in window) {
      var lo = new IntersectionObserver(function(en) {
        if (en[0].isIntersecting) {
          lo.disconnect();
          loadMaps();
        }
      }, {
        rootMargin: '300px'
      });
      lo.observe(el);
    } else {
      loadMaps();
    }

    function init() {
      var map = new google.maps.Map(el, {
        center: {
          lat: cfg.center[0],
          lng: cfg.center[1]
        },
        zoom: cfg.zoom,
        gestureHandling: 'cooperative',
        disableDefaultUI: true,
        zoomControl: true,
        fullscreenControl: true,
        clickableIcons: false,
        styles: [{
            featureType: 'poi',
            stylers: [{
              visibility: 'off'
            }]
          },
          {
            featureType: 'transit',
            stylers: [{
              visibility: 'simplified'
            }]
          }
        ]
      });

      /* ---------- Wave pin ---------- */
      function Pin(pos, name, idx) {
        this.pos = pos;
        this.name = name;
        this.idx = idx;
        this.div = null;
        this.setMap(map);
      }
      Pin.prototype = Object.create(google.maps.OverlayView.prototype);
      Pin.prototype.onAdd = function() {
        var d = document.createElement('div'),
          self = this,
          tip = document.createElement('span');
        d.className = 'd-cov-pin';
        d.style.setProperty('--d', '-' + ((this.idx * 0.37) % 3).toFixed(2) + 's');
        tip.className = 'd-cov-tip';
        tip.textContent = this.name;
        d.appendChild(tip);
        ['r1', 'r2', 'r3'].forEach(function(c) {
          var r = document.createElement('i');
          r.className = 'ring ' + c;
          d.appendChild(r);
        });
        var dot = document.createElement('i');
        dot.className = 'dot';
        d.appendChild(dot);
        d.addEventListener('click', function() {
          activate(self.idx, true);
        });
        this.div = d;
        this.getPanes().overlayMouseTarget.appendChild(d);
      };
      Pin.prototype.draw = function() {
        var p = this.getProjection().fromLatLngToDivPixel(this.pos);
        if (p && this.div) this.div.style.transform = 'translate(' + p.x + 'px,' + p.y + 'px)';
      };
      Pin.prototype.onRemove = function() {
        if (this.div && this.div.parentNode) this.div.parentNode.removeChild(this.div);
        this.div = null;
      };
      Pin.prototype.setActive = function(on) {
        if (this.div) this.div.classList.toggle('is-active', on);
      };

      /* ---------- State ---------- */
      var pins = [],
        current = -1;
      var box = document.getElementById('dCovPills');
      var pills = box.querySelectorAll('.d-cov-pill');

      function fit() {
        var b = new google.maps.LatLngBounds(),
          n = 0;
        pins.forEach(function(p) {
          if (p) {
            b.extend(p.pos);
            n++;
          }
        });
        if (n > 1) {
          map.fitBounds(b, 56);
          google.maps.event.addListenerOnce(map, 'idle', function() {
            if (map.getZoom() > 14) map.setZoom(14);
          });
        } else if (n === 1) {
          map.setCenter(b.getCenter());
          map.setZoom(14);
        }
      }

      function addPin(i, lat, lng) {
        pins[i] = new Pin(new google.maps.LatLng(lat, lng), cfg.localities[i].name, i);
      }

      function activate(i, fromPin) {
        if (!pins[i]) return;
        if (current > -1) {
          if (pins[current]) pins[current].setActive(false);
          if (pills[current]) pills[current].classList.remove('is-active');
        }
        current = i;
        pins[i].setActive(true);
        pills[i].classList.add('is-active');

        // map us location par le jao
        map.panTo(pins[i].pos);
        if (map.getZoom() < 14) setTimeout(function() {
          map.setZoom(14);
        }, 350);

        // map pin par click hua ho to pill list me dikhao
        if (fromPin) box.scrollTo({
          top: Math.max(0, pills[i].offsetTop - 48),
          behavior: 'smooth'
        });
      }

      pills.forEach(function(p) {
        p.addEventListener('click', function() {
          activate(+p.dataset.idx, false);
        });
      });

      /* ---------- Place pins ---------- */
      var pending = [];
      cfg.localities.forEach(function(l, i) {
        if (l.lat !== null && l.lng !== null) addPin(i, l.lat, l.lng);
        else pending.push(i);
      });
      fit();

      if (pending.length) {
        var geo = new google.maps.Geocoder();
        (function nextGeo() {
          if (!pending.length) {
            fit();
            return;
          }
          var i = pending.shift(),
            k = 'dcovg:' + cfg.city + ':' + cfg.localities[i].name,
            c = null;
          try {
            c = JSON.parse(localStorage.getItem(k));
          } catch (e) {}
          if (c) {
            addPin(i, c[0], c[1]);
            return nextGeo();
          }
          geo.geocode({
            address: cfg.localities[i].name + ', ' + cfg.city + ', India'
          }, function(r, s) {
            if (s === 'OK' && r[0]) {
              var p = r[0].geometry.location;
              try {
                localStorage.setItem(k, JSON.stringify([p.lat(), p.lng()]));
              } catch (e) {}
              addPin(i, p.lat(), p.lng());
            }
            setTimeout(nextGeo, 250);
          });
        })();
      }
    }
  })();
</script>

<style>
  .d-cov {
    padding: 5rem 0 4.5rem;
    background: var(--green-50);
  }

  .d-cov-pin.is-active .dot {
    background: var(--green-700, #1B692C);
    transform: scale(1.5);
    box-shadow: 0 0 0 4px rgba(27, 105, 44, 0.25), 0 3px 8px rgba(0, 0, 0, .35);
  }

  .d-cov-pin.is-active .ring {
    background: rgba(27, 105, 44, 0.3);
    border-color: rgba(27, 105, 44, 0.55);
    animation-duration: 2s;
  }

  .d-cov-live {
    background: var(--green-700, #1B692C);
    box-shadow: 0 0 0 3px rgba(27, 105, 44, 0.2);
  }

  /* ---------- Eyebrow Header ---------- */
  .d-cov-eyebrow-wrap {
    display: flex;
    justify-content: center;
  }

  .d-cov-eyebrow {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: .5rem;
    padding: .4rem 1.25rem;
    border-radius: 999px;
    background: var(--green-50, #EEF7F1);
    border: 1px solid var(--green-100, #cfeedd);
    color: var(--green-700, #1B692C);
    font-size: .8rem;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    box-shadow: 0 2px 8px rgba(27, 105, 44, 0.08);
    transition: all .25s ease;
  }

  .d-cov-eyebrow i {
    color: var(--green-700, #1B692C);
    font-size: .85rem;
  }

  /* ---------- Text ---------- */
  .d-cov-title {
    font-family: var(--font-heading, inherit);
    font-weight: var(--heading-weight, 800);
    font-size: clamp(1.75rem, 2.3vw, 2.35rem);
    line-height: 1.25;
    letter-spacing: -.02em;
    color: var(--heading-color, #1a2820);
    margin: 0 0 .75rem;
  }

  .d-cov-city {
    color: var(--green-700, #1B692C);
  }

  .d-cov-sub {
    font-family: var(--font-body, inherit);
    color: var(--muted, #5b6b62);
    font-size: 1rem;
    line-height: 1.6;
    margin: 0 0 1.5rem;
  }

  /* ---------- Stats 3-Col Bar ---------- */
  .d-cov-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: .75rem;
    margin-bottom: 1.5rem;
    padding: 1rem 1.25rem;
    background: var(--green-50, #EEF7F1);
    border: 1px solid var(--green-100, #cfeedd);
    border-radius: 16px;
  }

  .d-cov-stats>div {
    display: flex;
    flex-direction: column;
    gap: .15rem;
  }

  .d-cov-stats strong {
    display: block;
    font-family: var(--font-heading, inherit);
    font-size: 1.35rem;
    font-weight: 800;
    line-height: 1.1;
    color: var(--green-700, #1B692C);
  }

  .d-cov-stats span {
    font-size: .78rem;
    font-weight: 600;
    color: var(--muted, #5b6b62);
  }

  /* ---------- Pills ---------- */
  .d-cov-pills {
    position: relative;
    display: flex;
    flex-wrap: wrap;
    gap: .45rem;
    max-height: 190px;
    overflow-y: auto;
    padding: .2rem .35rem .5rem 0;
    margin-bottom: 1.65rem;
    scrollbar-width: thin;
    scrollbar-color: rgba(27, 105, 44, .3) transparent;
    -webkit-mask-image: linear-gradient(to bottom, #000 82%, transparent 100%);
    mask-image: linear-gradient(to bottom, #000 82%, transparent 100%);
  }

  .d-cov-pill {
    font: inherit;
    font-size: .82rem;
    font-weight: 600;
    cursor: pointer;
    padding: .38rem .85rem;
    border-radius: 999px;
    background: #ffffff;
    color: var(--green-900, #0a3a24);
    border: 1px solid var(--section-card-border, #dcebe2);
    box-shadow: 0 1px 3px rgba(0, 0, 0, .03);
    transition: background .25s ease, color .25s ease, border-color .25s ease, transform .2s ease, box-shadow .25s ease;
  }

  .d-cov-pill:hover {
    border-color: var(--green-700, #1B692C);
    background: var(--green-50, #EEF7F1);
    color: var(--green-700, #1B692C);
    transform: translateY(-1px);
    box-shadow: 0 3px 8px rgba(27, 105, 44, 0.1);
  }

  .d-cov-pill.is-active {
    background: var(--green-700, #1B692C);
    border-color: var(--green-700, #1B692C);
    color: #ffffff;
    box-shadow: 0 4px 14px rgba(27, 105, 44, 0.28);
    transform: translateY(-1px);
  }

  /* ---------- Button ---------- */
  .d-cov-btn {
    display: inline-flex;
    align-items: center;
    gap: .55rem;
    padding: .85rem 1.75rem;
    border-radius: 999px;
    background: var(--green-700, #1B692C);
    color: #ffffff;
    font-weight: 700;
    font-size: .95rem;
    text-decoration: none;
    box-shadow: 0 6px 18px rgba(27, 105, 44, 0.24);
    transition: background .25s ease, transform .25s ease, box-shadow .25s ease;
  }

  .d-cov-btn:hover {
    background: var(--green-900, #0a3a24);
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 10px 24px rgba(10, 58, 36, 0.28);
  }

  .d-cov-btn i {
    transition: transform .25s ease;
  }

  .d-cov-btn:hover i {
    transform: translateX(4px);
  }

  /* ---------- Map Card ---------- */
  .d-cov-map-card {
    position: relative;
    isolation: isolate;
    padding: .65rem;
    background: #ffffff;
    border: 1px solid var(--section-card-border, #dcebe2);
    border-radius: 24px;
    box-shadow: 0 20px 45px -15px rgba(10, 58, 36, 0.1), 0 4px 16px rgba(0, 0, 0, .04);
  }

  .d-cov-map {
    height: 540px;
    border-radius: 18px;
    overflow: hidden;
    background: #e9f2ec;
  }

  .d-cov-badge {
    position: absolute;
    top: 1.25rem;
    left: 1.25rem;
    z-index: 5;
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    padding: .35rem .85rem;
    border-radius: 999px;
    background: rgba(255, 255, 255, .95);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(27, 105, 44, 0.12);
    font-size: .75rem;
    font-weight: 700;
    color: var(--green-900, #0a3a24);
    box-shadow: 0 4px 14px rgba(0, 0, 0, .08);
  }

  .d-cov-live {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #e5322d;
    box-shadow: 0 0 0 3px rgba(229, 50, 45, 0.2);
    animation: dCovBlink 1.4s ease-in-out infinite;
  }

  /* ---------- Wave Pins (Google Maps Overlay) ---------- */
  .d-cov-pin {
    position: absolute;
    left: -8px;
    top: -8px;
    width: 16px;
    height: 16px;
    cursor: pointer;
    will-change: transform;
    z-index: 1;
  }

  .d-cov-pin:hover,
  .d-cov-pin.is-active {
    z-index: 50;
  }

  .d-cov-pin .dot {
    position: absolute;
    inset: 3px;
    border-radius: 50%;
    background: var(--green-700, #1B692C);
    border: 2px solid #ffffff;
    box-shadow: 0 2px 6px rgba(0, 0, 0, .3);
    transition: background .35s ease, transform .35s cubic-bezier(.3, 1.5, .5, 1), box-shadow .35s ease;
  }

  .d-cov-pin .ring {
    position: absolute;
    inset: 0;
    border-radius: 50%;
    pointer-events: none;
    opacity: 0;
    background: rgba(27, 105, 44, 0.3);
    border: 1px solid rgba(27, 105, 44, 0.45);
    animation: dCovWave 3s cubic-bezier(.2, .6, .3, 1) infinite;
    animation-delay: var(--d, 0s);
  }

  .d-cov-pin .r2 {
    animation-delay: calc(var(--d, 0s) + 1s);
  }

  .d-cov-pin .r3 {
    animation-delay: calc(var(--d, 0s) + 2s);
  }

  .d-cov-pin.is-active .dot {
    background: #e5322d;
    transform: scale(1.45);
    box-shadow: 0 0 0 4px rgba(229, 50, 45, 0.25), 0 3px 8px rgba(0, 0, 0, .35);
  }

  .d-cov-pin.is-active .ring {
    background: rgba(229, 50, 45, 0.35);
    border-color: rgba(229, 50, 45, 0.65);
    animation-duration: 1.8s;
  }

  .d-cov-tip {
    position: absolute;
    bottom: 24px;
    left: 50%;
    transform: translate(-50%, 6px);
    white-space: nowrap;
    padding: .28rem .75rem;
    border-radius: 999px;
    background: #ffffff;
    color: var(--green-900, #0a3a24);
    border: 1px solid var(--green-100, #cfeedd);
    font-size: .76rem;
    font-weight: 700;
    box-shadow: 0 6px 18px rgba(10, 58, 36, 0.15);
    opacity: 0;
    pointer-events: none;
    transition: opacity .25s ease, transform .25s ease;
  }

  .d-cov-pin:hover .d-cov-tip,
  .d-cov-pin.is-active .d-cov-tip {
    opacity: 1;
    transform: translate(-50%, 0);
  }

  @keyframes dCovWave {
    0% {
      transform: scale(.5);
      opacity: .85;
    }

    100% {
      transform: scale(3.6);
      opacity: 0;
    }
  }

  @keyframes dCovBlink {

    0%,
    100% {
      opacity: 1;
    }

    50% {
      opacity: .3;
    }
  }

  @media (prefers-reduced-motion: reduce) {

    .d-cov-pin .ring,
    .d-cov-live {
      animation: none;
    }
  }

  @media (max-width: 991.98px) {
    .d-cov {
      padding: 3.75rem 0;
    }

    .d-cov-map {
      height: 420px;
    }
  }

  @media (max-width: 575.98px) {
    .d-cov {
      padding: 2.75rem 0 2.25rem;
    }

    .d-cov-head {
      margin-bottom: 1.6rem;
    }

    .d-cov-eyebrow {
      font-size: .7rem;
      padding: .3rem .75rem;
      margin-bottom: .7rem;
    }

    .d-cov-title {
      font-size: clamp(1.35rem, 5.8vw, 1.75rem);
      line-height: 1.25;
      margin-bottom: .6rem;
    }

    .d-cov-sub {
      font-size: .86rem;
      line-height: 1.5;
    }

    .d-cov-chips {
      gap: .35rem;
      margin: 1.25rem 0 1.5rem;
    }

    .d-cov-chips button {
      font-size: .72rem;
      padding: .25rem .6rem;
    }

    .d-cov-stats {
      gap: .5rem;
      margin-bottom: 1.5rem;
    }

    .d-cov-stats .val {
      font-size: 1.15rem;
    }

    .d-cov-stats .lbl {
      font-size: .7rem;
    }

    .d-cov-map {
      height: 320px;
    }

    .d-cov-btn {
      width: 100%;
      justify-content: center;
      font-size: .88rem;
      padding: .65rem 1.2rem;
    }
  }
</style>