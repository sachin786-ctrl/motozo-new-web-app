<?php

declare(strict_types=1);
ob_start();
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

require __DIR__ . '/includes/bootstrap.php';
$cfg       = require __DIR__ . '/config/mail.php';
$districts = require __DIR__ . '/config/districts.php';

function out(bool $ok, string $msg, int $code = 200)
{
  while (ob_get_level() > 0) {
    ob_end_clean();
  }
  // Return HTTP 200 so Apache ErrorDocuments do not replace JSON with HTML error pages
  http_response_code(200);
  echo json_encode($ok ? ['ok' => true, 'message' => $msg] : ['ok' => false, 'error' => $msg], JSON_UNESCAPED_UNICODE);
  exit;
}
function f(string $k, int $max = 100): string
{
  $v = $_POST[$k] ?? '';
  if (!is_string($v)) return '';
  return mb_substr(trim(preg_replace('/\s+/u', ' ', strip_tags($v))), 0, $max);
}
function pick(string $v, array $allowed, string $default = ''): string
{
  return in_array($v, $allowed, true) ? $v : $default;
}
function x(?string $s): string
{
  return htmlspecialchars((string)($s ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
function csv_safe(string $s): string
{
  return preg_match('/^[=+\-@\t\r]/', $s) ? "'" . $s : $s;
}

$ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
$isLocalhost = in_array($ip, ['127.0.0.1', '::1', 'localhost'], true);

function rate_ok(string $ip, int $max, int $window): bool
{
  // Localhost development & testing exempt
  if (in_array($ip, ['127.0.0.1', '::1', 'localhost'], true)) {
    return true;
  }
  $dir = ROOT . '/storage/rate';
  if (!is_dir($dir)) @mkdir($dir, 0750, true);
  $fp = @fopen($dir . '/' . hash('sha256', $ip) . '.json', 'c+');
  if (!$fp) return true;
  flock($fp, LOCK_EX);
  $now  = time();
  $hits = array_values(array_filter(json_decode(stream_get_contents($fp) ?: '[]', true) ?: [], fn($t) => $t > ($now - $window)));
  $ok = count($hits) < $max;
  if ($ok) $hits[] = $now;
  ftruncate($fp, 0);
  rewind($fp);
  fwrite($fp, json_encode($hits));
  flock($fp, LOCK_UN);
  fclose($fp);
  return $ok;
}

/* ---------- gatekeeping ---------- */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') out(false, 'Invalid request.', 405);

$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
if (!$isLocalhost && $origin !== '' && parse_url($origin, PHP_URL_HOST) !== explode(':', $_SERVER['HTTP_HOST'] ?? '')[0]) {
  out(false, 'Invalid request origin.', 403);
}

$postedCsrf = (string)($_POST['csrf'] ?? '');
$sessionCsrf = (string)($_SESSION['csrf'] ?? '');
if (!empty($sessionCsrf) && !hash_equals($sessionCsrf, $postedCsrf)) {
  if (!$isLocalhost) {
    out(false, 'Session expired. Please refresh the page (Ctrl+F5) and try again.', 403);
  }
}
if (!empty($_POST['website'])) out(true, 'Thank you!');                                       // honeypot: bot ko fake success
if (!$isLocalhost && (time() - (int)($_SESSION['rendered_at'] ?? 0) < 2)) {
  out(false, 'Please try again in a moment.', 429);
}

if (!rate_ok($ip, 20, 600)) out(false, 'Too many requests. Please try again after some time.', 429);

/* ---------- inputs + validation ---------- */
$rawFormType = f('form_type', 40);
$isContact   = ($rawFormType === 'Contact Form' || isset($_POST['is_contact_form']));
$isLot       = isset($_POST['v_type']);

$name  = f('user_name', 60);
$phone = f('user_phone', 10);
$email = f('user_email', 100);
$city  = f('user_city') ?: f('v_city') ?: f('user_pincode');
$rawPin = f('user_pincode') ?: f('v_pincode');
$pincode = preg_match('/^[1-9]\d{5}$/', $rawPin) ? $rawPin : '';
$userMessage = f('user_message', 1000) ?: f('message', 1000);

if (!preg_match("/^[\p{L} .'-]{2,60}$/u", $name))          out(false, 'Please enter a valid full name.', 422);
if (!preg_match('/^[6-9][0-9]{9}$/', $phone))              out(false, 'Please enter a valid 10-digit mobile number.', 422);
if (!$isContact && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
  out(false, 'Please enter a valid email address.', 422);
}
if ($isContact && !empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
  out(false, 'Please enter a valid email address.', 422);
}
if (mb_strlen($city) < 2 || !preg_match('/^[\p{L}\p{N}\s.,&()\/#-]{2,100}$/u', $city)) out(false, 'Please enter a valid city or location.', 422);

// Naam ke har word ka pehla letter CAPITAL karna (e.g. "rahul sharma" => "Rahul Sharma")
$name = mb_convert_case(mb_strtolower($name, 'UTF-8'), MB_CASE_TITLE, 'UTF-8');
if (preg_match('/\p{L}/u', $city)) {
  $city = mb_convert_case(mb_strtolower($city, 'UTF-8'), MB_CASE_TITLE, 'UTF-8');
}

if ($isContact) {
  $service = f('service_type', 80) ?: 'General Inquiry';
  $vehicle = f('vehicle_type', 50) ?: 'Inquiry';
} else {
  $vehicle = $isLot
    ? pick(f('v_type'), ['Car', 'Two-Wheeler', 'Three-Wheeler', 'Commercial Vehicle', 'Bus', 'Truck / Heavy Vehicle', 'Other'], 'Other')
    : pick(f('vehicle_type'), ['Bike', 'Car', 'Bus', 'Truck', 'Commercial Vehicle', 'Other'], 'Other');
  $service = pick(f('service_type'), ['Scrap Vehicle', 'Sell Old Vehicle', 'Purchase COD', 'Sale COD'], 'Scrap Vehicle');
}

$v = ['brand' => '', 'model' => '', 'reg' => '', 'year' => '', 'fuel' => '', 'cond' => '', 'pin' => '', 'addr' => '', 'when' => '', 'est' => '', 'extras' => ''];
if ($isLot) {
  $v['brand'] = f('v_brand', 40);
  $v['model'] = f('v_model', 40);
  $v['reg']   = preg_match('/^[A-Za-z0-9 -]{0,15}$/', f('v_reg')) ? strtoupper(f('v_reg')) : '';
  $v['year']  = preg_match('/^(19|20)\d{2}$/', f('v_year')) ? f('v_year') : '';
  $v['fuel']  = pick(f('v_fuel'), ['Petrol', 'Diesel', 'CNG', 'Electric', 'Hybrid']);
  $v['cond']  = pick(f('v_cond'), ['Running & Complete', 'Not Running', 'Accident / Damaged', 'Burnt', 'Flood Damaged', 'Missing Parts']);
  $v['pin']   = preg_match('/^\d{6}$/', f('v_pincode')) ? f('v_pincode') : '';
  $v['addr']  = f('v_address', 200);
  $rawWhen = f('v_when');
  if (in_array(strtolower($rawWhen), ['this week', 'thisweek'], true)) {
    $v['when'] = 'This Week';
  } elseif (in_array(strtolower($rawWhen), ['2 weeks', 'within 2 weeks', '2weeks'], true)) {
    $v['when'] = 'Within 2 Weeks';
  } elseif (in_array(strtolower($rawWhen), ['today'], true)) {
    $v['when'] = 'Today';
  } elseif (in_array(strtolower($rawWhen), ['flexible'], true)) {
    $v['when'] = 'Flexible';
  } else {
    $v['when'] = pick($rawWhen, ['Today', 'This Week', 'Within 2 Weeks', 'Flexible', 'This week', '2 weeks'], 'Flexible');
  }
  $v['est']   = f('estimated_value', 40);     // client-side andaza, trusted nahi
  $allowedExtras = [
    'Vehicle is at home',
    'Vehicle is at workshop',
    'Vehicle is accident damaged',
    'Keys available',
    'RC available',
    'Pickup assistance required',
    'RC Available',
    'Keys Available',
    'Vehicle at Home',
    'At Workshop',
    'Towing Help Needed',
    'Weighbridge Nearby'
  ];
  $ex = is_array($_POST['v_extras'] ?? null) ? $_POST['v_extras'] : [];
  $v['extras'] = implode(', ', array_values(array_intersect($allowedExtras, array_map('strval', $ex))));
}

/* ---------- SOURCE: kis page se aaya (server verify karta hai) ---------- */
$slug        = strtolower(f('source_slug', 40));
$srcDistrict = $districts[$slug] ?? '';                       // unknown slug => home
$srcLabel    = $srcDistrict ? "District Page: $srcDistrict" : 'Home Page';
$ref         = parse_url($_SERVER['HTTP_REFERER'] ?? '');
$srcPath     = (isset($ref['host']) && $ref['host'] === explode(':', $_SERVER['HTTP_HOST'] ?? '')[0])
  ? mb_substr(($ref['path'] ?? '/'), 0, 120) : '';

/* ---------- uploads: abhi sirf naam note hote hain, file save nahi ---------- */
$docs = [];
foreach ($_FILES as $fi) {
  if (is_string($fi['name'] ?? null) && ($fi['error'] ?? 1) === UPLOAD_ERR_OK && ($fi['size'] ?? 0) <= 5 * 1024 * 1024) {
    $docs[] = mb_substr(preg_replace('/[^\w.\- ]/u', '', $fi['name']), 0, 60);
  }
}
$docsNote = $docs ? implode(', ', $docs) : 'None';

/* ---------- save lead (storage/ me, web se band) ---------- */
$ts          = date('d-m-Y H:i:s');
$displayDate = date('d M Y');           // Format: 10 Sep 2026
$displayTime = date('h:i A');           // Format: 01:42 PM

$lead = [
  'time' => $ts,
  'form' => $isContact ? 'Contact Form' : ($isLot ? 'Lot Builder' : 'Hero Quick Form'),
  'source' => $srcLabel,
  'source_slug' => $slug && $srcDistrict ? $slug : 'home',
  'source_path' => $srcPath,
  'name' => $name,
  'phone' => $phone,
  'email' => $email ?: 'Not Provided',
  'user_city' => $city,
  'pincode' => $pincode ?: ($v['pin'] ?? ''),
  'vehicle' => $vehicle,
  'service' => $service,
  'message' => $userMessage,
  'details' => $v,
  'docs' => $docsNote,
  'ip' => $ip,
];
@mkdir(ROOT . '/storage', 0750, true);
@file_put_contents(ROOT . '/storage/leads.jsonl', json_encode($lead, JSON_UNESCAPED_UNICODE) . "\n", FILE_APPEND | LOCK_EX);

$csv = ROOT . '/storage/leads.csv';
$new = !file_exists($csv);
if ($fp = @fopen($csv, 'a')) {
  flock($fp, LOCK_EX);
  if ($new) fputcsv($fp, ['Time', 'Form', 'Lead Source', 'Name', 'Phone', 'Email', 'User City', 'Vehicle', 'Brand/Model', 'Year', 'Fuel', 'Est Value', 'IP']);
  fputcsv($fp, array_map('csv_safe', [
    $ts,
    $lead['form'],
    $srcLabel,
    $name,
    $phone,
    $email ?: 'Not Provided',
    $city,
    $vehicle,
    trim($v['brand'] . ' ' . $v['model']) ?: ($userMessage ? 'Msg: ' . mb_substr($userMessage, 0, 50) : ''),
    $v['year'],
    $v['fuel'],
    $v['est'],
    $ip
  ]));
  flock($fp, LOCK_UN);
  fclose($fp);
}

/* ==========================================================================
   CONFIGURABLE ASSETS & SOCIAL LINKS
   ========================================================================== */
// Email clients (Gmail, Outlook, Yahoo) require full absolute URLs (with https://) to render images.
$reqHost = $_SERVER['HTTP_HOST'] ?? '';
$isLocalEnv = empty($reqHost)
  || in_array($reqHost, ['localhost', '127.0.0.1', '::1'])
  || strpos($reqHost, 'localhost:') === 0;

if (!$isLocalEnv) {
  $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';
  $brandLogoUrl = $scheme . $reqHost . (defined('BASE') ? rtrim(BASE, '/') : '') . '/assets/media/footer_logo.png';
} else {
  // During local testing, external email proxies (Gmail) cannot reach localhost.
  // Use public absolute URL (or live domain asset)
  $brandLogoUrl = 'https://motozo.in/assets/media/footer_logo.png';
}

$socialLinks  = [
  'facebook'  => 'https://www.facebook.com/motozoofficial',
  'instagram' => 'https://www.instagram.com/motozoofficial',
];

/* ==========================================================================
   1. ADMIN NOTIFICATION EMAIL TEMPLATE (#1C6936)
   ========================================================================== */
$tag     = $srcDistrict ?: (!empty($city) ? $city : 'General');
if ($isContact) {
  $subject = "New Contact Inquiry [{$tag}] — {$service} | {$name} ({$city})";
  $waUrl = 'https://wa.me/91' . preg_replace('/\D/', '', $phone) . '?text=' . rawurlencode("Hello {$name}, thank you for contacting Motozo regarding {$service} in {$city}. We have received your inquiry.");
} else {
  $subject = "New Lead [{$tag}] — {$vehicle} | {$name} ({$city})";
  $waUrl = 'https://wa.me/91' . preg_replace('/\D/', '', $phone) . '?text=' . rawurlencode("Hello {$name}, thank you for contacting Motozo regarding your {$vehicle} in {$city}. We are reviewing your valuation request.");
}

$body = "
<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<title>" . x($subject) . "</title>
</head>
<body style='margin:0;padding:24px 12px;background-color:#f1f5f3;font-family:-apple-system,BlinkMacSystemFont,\"Segoe UI\",Roboto,Helvetica,Arial,sans-serif;'>
  <table role='presentation' style='width:100%;max-width:640px;margin:0 auto;background:#ffffff;border-radius:12px;overflow:hidden;border:1px solid #dce8e0;border-collapse:collapse;'>
    
    <!-- Header with #1C6936 -->
    <tr>
      <td style='background:#1C6936;padding:24px 28px;'>
        <table role='presentation' style='width:100%;border-collapse:collapse;'>
          <tr>
            <td style='vertical-align:middle;'>
              <div style='margin-bottom:12px;'>
                <a href='https://motozo.in' target='_blank' style='display:inline-block;text-decoration:none;'>
                  <img src='{$brandLogoUrl}' alt='Motozo' width='140' style='display:block;max-width:140px;height:auto;border:0;color:#ffffff;font-size:22px;font-weight:800;letter-spacing:1px;' />
                </a>
              </div>
              <h1 style='margin:0;font-size:22px;font-weight:800;color:#ffffff;line-height:1.2;'>" . ($isContact ? 'New Contact Inquiry' : ($isLot ? 'Vehicle Lot Valuation' : 'New Quote Request')) . "</h1>
              <div style='font-size:13px;color:#e1f2e7;margin-top:6px;'>Received on <strong>{$displayDate}</strong> at {$displayTime}</div>
            </td>
            <td style='text-align:right;vertical-align:middle;'>
              <span style='display:inline-block;padding:6px 14px;background:rgba(255,255,255,0.22);border:1px solid rgba(255,255,255,0.4);border-radius:20px;font-size:11px;font-weight:700;color:#ffffff;text-transform:uppercase;'>
                " . x($tag) . " &bull; " . ($isContact ? 'Contact Form' : ($isLot ? 'Lot Builder' : 'Hero Form')) . "
              </span>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <!-- Action Bar -->
    <tr>
      <td style='background:#eaf4ee;border-bottom:1px solid #d3e7da;padding:12px 28px;'>
        <table role='presentation' style='width:100%;border-collapse:collapse;'>
          <tr>
            <td style='font-size:13px;color:#1C6936;font-weight:600;'>
              Quick Action:
            </td>
            <td style='text-align:right;'>
              <a href='tel:" . x($phone) . "' style='display:inline-block;padding:8px 16px;background:#1C6936;color:#ffffff;text-decoration:none;border-radius:6px;font-size:12px;font-weight:700;margin-right:8px;'>
                Call Customer
              </a>
              <a href='" . x($waUrl) . "' target='_blank' style='display:inline-block;padding:8px 16px;background:#15803d;color:#ffffff;text-decoration:none;border-radius:6px;font-size:12px;font-weight:700;'>
                WhatsApp
              </a>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <!-- Main Content -->
    <tr>
      <td style='padding:28px;'>

        <!-- Customer Profile with Initial Avatar Circle -->
        <table role='presentation' style='width:100%;border-collapse:collapse;margin-bottom:24px;'>
          <tr>
            <td colspan='2' style='padding-bottom:14px;border-bottom:2px solid #e2ece5;'>
              <table role='presentation' style='border-collapse:collapse;'>
                <tr>
                  <td style='vertical-align:middle;'>
                    <div style='font-size:16px;font-weight:800;color:#0f172a;line-height:1.2;'>" . x($name) . "</div>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td style='width:36%;padding:9px 0;color:#64748b;font-size:13px;font-weight:500;'>Full Name</td>
            <td style='padding:9px 0;color:#0f172a;font-weight:700;font-size:14px;'>" . x($name) . "</td>
          </tr>
          <tr>
            <td style='padding:9px 0;color:#64748b;font-size:13px;font-weight:500;'>Phone Number</td>
            <td style='padding:9px 0;'><a href='tel:" . x($phone) . "' style='color:#1C6936;font-weight:700;font-size:14px;text-decoration:none;'>" . x($phone) . "</a></td>
          </tr>
          <tr>
            <td style='padding:9px 0;color:#64748b;font-size:13px;font-weight:500;'>Email Address</td>
            <td style='padding:9px 0;'>" . (!empty($email) ? "<a href='mailto:" . x($email) . "' style='color:#0369a1;text-decoration:none;font-size:14px;'>" . x($email) . "</a>" : "<span style='color:#94a3b8;font-size:13px;font-style:italic;'>Not Provided (Phone Preferred)</span>") . "</td>
          </tr>
          <tr>
            <td style='padding:9px 0;color:#64748b;font-size:13px;font-weight:500;'>Customer Location</td>
            <td style='padding:9px 0;color:#0f172a;font-weight:600;font-size:14px;'>" . x($city) . (!empty($pincode) ? " <span style='font-size:12px;color:#64748b;font-weight:normal;'>(PIN: " . x($pincode) . ")</span>" : "") . "</td>
          </tr>
        </table>

        <!-- Vehicle & Requirement Section -->
        <table role='presentation' style='width:100%;border-collapse:collapse;margin-bottom:24px;'>
          <tr>
            <td colspan='2' style='font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;color:#1C6936;padding-bottom:8px;border-bottom:2px solid #e2ece5;'>
              Vehicle &amp; Request Details
            </td>
          </tr>
          <tr>
            <td style='width:36%;padding:9px 0;color:#64748b;font-size:13px;font-weight:500;'>Service Type</td>
            <td style='padding:9px 0;'><span style='background:#fef3c7;color:#92400e;padding:4px 10px;border-radius:4px;font-weight:700;font-size:12px;'>" . x($service) . "</span></td>
          </tr>
          <tr>
            <td style='padding:9px 0;color:#64748b;font-size:13px;font-weight:500;'>Vehicle Category</td>
            <td style='padding:9px 0;color:#0f172a;font-weight:600;font-size:14px;'>" . x($vehicle) . "</td>
          </tr>";

if ($isLot) {
  if (!empty($v['brand']) || !empty($v['model'])) {
    $body .= "<tr><td style='padding:9px 0;color:#64748b;font-size:13px;font-weight:500;'>Make / Model</td><td style='padding:9px 0;color:#0f172a;font-weight:700;font-size:14px;'>" . x(trim($v['brand'] . ' ' . $v['model'])) . "</td></tr>";
  }
  if (!empty($v['reg'])) {
    $body .= "<tr><td style='padding:9px 0;color:#64748b;font-size:13px;font-weight:500;'>Registration No.</td><td style='padding:9px 0;color:#0f172a;font-weight:700;font-size:14px;font-family:monospace;letter-spacing:1px;'>" . x($v['reg']) . "</td></tr>";
  }
  if (!empty($v['year']) || !empty($v['fuel'])) {
    $body .= "<tr><td style='padding:9px 0;color:#64748b;font-size:13px;font-weight:500;'>Year &amp; Fuel</td><td style='padding:9px 0;color:#0f172a;font-size:14px;'>" . x(trim($v['year'] . ($v['fuel'] ? ' • ' . $v['fuel'] : ''))) . "</td></tr>";
  }
  if (!empty($v['cond'])) {
    $body .= "<tr><td style='padding:9px 0;color:#64748b;font-size:13px;font-weight:500;'>Condition</td><td style='padding:9px 0;color:#0f172a;font-weight:600;font-size:14px;'>" . x($v['cond']) . "</td></tr>";
  }
  if (!empty($v['est'])) {
    $estValAdmin = preg_match('/^₹/', $v['est']) ? $v['est'] : '₹ ' . $v['est'];
    $body .= "<tr><td style='padding:9px 0;color:#64748b;font-size:13px;font-weight:500;'>Client Estimate</td><td style='padding:9px 0;color:#b45309;font-weight:700;font-size:14px;'>" . x($estValAdmin) . " <span style='font-size:12px;color:#94a3b8;font-weight:normal;'>(indicative)</span></td></tr>";
  }
}

$body .= "
        </table>";

if (!empty($userMessage)) {
  $body .= "
        <!-- Customer Message Section -->
        <table role='presentation' style='width:100%;border-collapse:collapse;margin-bottom:24px;background:#f0fdf4;border:1px solid #bbf7d0;border-left:4px solid #16a34a;border-radius:6px;'>
          <tr>
            <td style='padding:16px 20px;'>
              <div style='font-size:12px;font-weight:700;color:#15803d;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:6px;'>Customer Query / Message</div>
              <div style='font-size:14px;color:#0f172a;line-height:1.6;white-space:pre-wrap;'>" . x($userMessage) . "</div>
            </td>
          </tr>
        </table>";
}

if ($isLot && (!empty($v['addr']) || !empty($v['pin']) || !empty($v['when']) || !empty($v['extras']) || $docsNote !== 'None')) {
  $body .= "
        <!-- Pickup & Logistics Section -->
        <table role='presentation' style='width:100%;border-collapse:collapse;margin-bottom:24px;'>
          <tr>
            <td colspan='2' style='font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;color:#1C6936;padding-bottom:8px;border-bottom:2px solid #e2ece5;'>
              Pickup &amp; Logistics
            </td>
          </tr>";
  if (!empty($v['addr'])) {
    $body .= "<tr><td style='width:36%;padding:9px 0;color:#64748b;font-size:13px;font-weight:500;'>Pickup Address</td><td style='padding:9px 0;color:#0f172a;font-size:14px;'>" . x($v['addr']) . "</td></tr>";
  }
  if (!empty($v['pin'])) {
    $body .= "<tr><td style='padding:9px 0;color:#64748b;font-size:13px;font-weight:500;'>Pincode</td><td style='padding:9px 0;color:#0f172a;font-weight:600;font-size:14px;'>" . x($v['pin']) . "</td></tr>";
  }
  if (!empty($v['when'])) {
    $body .= "<tr><td style='padding:9px 0;color:#64748b;font-size:13px;font-weight:500;'>Preferred Schedule</td><td style='padding:9px 0;color:#1C6936;font-weight:600;font-size:14px;'>" . x($v['when']) . "</td></tr>";
  }
  if (!empty($v['extras'])) {
    $body .= "<tr><td style='padding:9px 0;color:#64748b;font-size:13px;font-weight:500;'>Additional Tags</td><td style='padding:9px 0;color:#0f172a;font-size:14px;'>" . x($v['extras']) . "</td></tr>";
  }
  if ($docsNote !== 'None') {
    $body .= "<tr><td style='padding:9px 0;color:#64748b;font-size:13px;font-weight:500;'>Attached Documents</td><td style='padding:9px 0;color:#0284c7;font-weight:500;font-size:14px;'>" . x($docsNote) . "</td></tr>";
  }
  $body .= "
        </table>";
}

$body .= "
        <!-- Meta Details -->
        <table role='presentation' style='width:100%;border-collapse:collapse;background:#f8faf9;border:1px solid #dce8e0;border-radius:8px;font-size:12px;color:#64748b;margin-top:10px;'>
          <tr>
            <td style='padding:12px 16px;'><strong>Source:</strong> " . x($srcLabel) . ($srcPath ? " (" . x($srcPath) . ")" : '') . "</td>
            <td style='padding:12px 16px;text-align:right;'><strong>IP:</strong> <span style='font-family:monospace;'>" . x($ip) . "</span></td>
          </tr>
        </table>

      </td>
    </tr>

    <!-- Footer -->
    <tr>
      <td style='background:#f8faf9;border-top:1px solid #e5ebe7;padding:16px 28px;text-align:center;font-size:12px;color:#64748b;'>
        Motozo Lead Notification &bull; Generated securely on {$displayDate}
      </td>
    </tr>

  </table>
</body>
</html>";

/* ==========================================================================
   2. CUSTOMER CONFIRMATION EMAIL TEMPLATE (#1C6936)
   (Sent only for quote-form.php, NOT for lot-form.php as requested)
   ========================================================================== */
$userSubject = '';
$userBody = '';

if (!$isLot && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $userSubject = "Vehicle Valuation Request Received for {$vehicle} ({$city}) — Motozo";

  $userBody = "
<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<title>Valuation Request Received — Motozo</title>
</head>
<body style='margin:0;padding:24px 12px;background-color:#f1f5f3;font-family:-apple-system,BlinkMacSystemFont,\"Segoe UI\",Roboto,Helvetica,Arial,sans-serif;'>
  <table role='presentation' style='width:100%;max-width:600px;margin:0 auto;background:#ffffff;border-radius:14px;overflow:hidden;border:1px solid #dce8e0;border-collapse:collapse;box-shadow:0 6px 24px rgba(0,0,0,0.04);'>
    
    <!-- Brand Header (#1C6936) -->
    <tr>
      <td style='background:#1C6936;padding:32px 28px;text-align:center;'>
        <div style='margin:0 auto 12px auto;text-align:center;'>
          <a href='https://motozo.in' target='_blank' style='display:inline-block;text-decoration:none;'>
            <img src='{$brandLogoUrl}' alt='Motozo' width='160' style='display:inline-block;max-width:160px;height:auto;border:0;color:#ffffff;font-size:24px;font-weight:800;letter-spacing:1px;' />
          </a>
        </div>
        <div style='color:#c2e6cf;font-size:13px;font-weight:500;letter-spacing:0.4px;'>
          India's Trusted Vehicle Scrapping &amp; Valuation Partner
        </div>
      </td>
    </tr>

    <!-- Body Area -->
    <tr>
      <td style='padding:32px 28px;'>

        <!-- Greeting Card with Customer Initial Avatar -->
        <table role='presentation' style='width:100%;border-collapse:collapse;background:#f0f7f2;border-left:4px solid #1C6936;border-radius:6px;margin-bottom:26px;'>
          <tr>
            <td style='padding:18px 20px;'>
              <table role='presentation' style='border-collapse:collapse;'>
                <tr>
                  <td style='vertical-align:middle;'>
                    <h2 style='margin:0;color:#1C6936;font-size:18px;font-weight:700;'>Thank You, " . x($name) . "!</h2>
                    <div style='font-size:12px;color:#64748b;margin-top:2px;'>Request Registered on {$displayDate}</div>
                  </td>
                </tr>
              </table>
              <p style='margin:12px 0 0;font-size:14px;line-height:1.6;color:#1e3a27;'>
                We have received your valuation inquiry for <strong>" . x($vehicle) . "</strong> in <strong>" . x($city) . "</strong>. Our specialist team has begun assessing your request.
              </p>
            </td>
          </tr>
        </table>

        <!-- Message -->
        <p style='font-size:14px;line-height:1.65;color:#334155;margin:0 0 24px;'>
          Our dedicated vehicle valuation specialist will call you on <strong style='color:#1C6936;font-size:15px;'>" . x($phone) . "</strong> within <strong>30 minutes</strong> with your quote, free doorstep pickup details, and instant payment options.
        </p>

        <!-- 3-Step Process (Clean Badge Boxes) -->
        <table role='presentation' style='width:100%;border-collapse:collapse;margin-bottom:28px;'>
          <tr>
            <td style='padding:14px;background:#f8faf9;border:1px solid #dce8e0;border-radius:8px;vertical-align:top;width:33.33%;'>
              <div style='display:inline-block;padding:3px 8px;background:#1C6936;color:#ffffff;border-radius:4px;font-size:10px;font-weight:800;letter-spacing:0.5px;margin-bottom:8px;'>STEP 01</div>
              <div style='font-weight:700;color:#0f172a;font-size:13px;margin-bottom:4px;'>Instant Quote</div>
              <div style='font-size:12px;color:#64748b;line-height:1.4;'>Highest certified scrap &amp; resale valuation.</div>
            </td>
            <td style='width:8px;'></td>
            <td style='padding:14px;background:#f8faf9;border:1px solid #dce8e0;border-radius:8px;vertical-align:top;width:33.33%;'>
              <div style='display:inline-block;padding:3px 8px;background:#1C6936;color:#ffffff;border-radius:4px;font-size:10px;font-weight:800;letter-spacing:0.5px;margin-bottom:8px;'>STEP 02</div>
              <div style='font-weight:700;color:#0f172a;font-size:13px;margin-bottom:4px;'>Free Towing</div>
              <div style='font-size:12px;color:#64748b;line-height:1.4;'>Doorstep inspection &amp; instant payment transfer.</div>
            </td>
            <td style='width:8px;'></td>
            <td style='padding:14px;background:#f8faf9;border:1px solid #dce8e0;border-radius:8px;vertical-align:top;width:33.33%;'>
              <div style='display:inline-block;padding:3px 8px;background:#1C6936;color:#ffffff;border-radius:4px;font-size:10px;font-weight:800;letter-spacing:0.5px;margin-bottom:8px;'>STEP 03</div>
              <div style='font-weight:700;color:#0f172a;font-size:13px;margin-bottom:4px;'>Govt. Certificate</div>
              <div style='font-size:12px;color:#64748b;line-height:1.4;'>Official Certificate of Deposit &amp; RC de-registration.</div>
            </td>
          </tr>
        </table>

        <!-- Summary Table -->
        <table role='presentation' style='width:100%;border-collapse:collapse;border:1px solid #dce8e0;border-radius:10px;overflow:hidden;margin-bottom:26px;'>
          <tr>
            <td colspan='2' style='background:#f4f8f5;padding:12px 18px;font-size:12px;font-weight:700;color:#1C6936;border-bottom:1px solid #dce8e0;text-transform:uppercase;letter-spacing:0.6px;'>
              Inquiry Summary
            </td>
          </tr>
          <tr>
            <td style='padding:10px 18px;border-bottom:1px solid #edf2ef;color:#64748b;font-size:13px;width:40%;'>Vehicle Category</td>
            <td style='padding:10px 18px;border-bottom:1px solid #edf2ef;color:#0f172a;font-weight:600;font-size:13px;'>" . x($vehicle) . "</td>
          </tr>
          <tr>
            <td style='padding:10px 18px;border-bottom:1px solid #edf2ef;color:#64748b;font-size:13px;'>Service Requested</td>
            <td style='padding:10px 18px;border-bottom:1px solid #edf2ef;color:#0f172a;font-weight:600;font-size:13px;'>" . x($service) . "</td>
          </tr>
          <tr>
            <td style='padding:10px 18px;border-bottom:1px solid #edf2ef;color:#64748b;font-size:13px;'>Location City</td>
            <td style='padding:10px 18px;border-bottom:1px solid #edf2ef;color:#0f172a;font-weight:600;font-size:13px;'>" . x($city) . "</td>
          </tr>";

  if ($isLot && !empty($v['pin'])) {
    $userBody .= "
          <tr>
            <td style='padding:10px 18px;border-bottom:1px solid #edf2ef;color:#64748b;font-size:13px;'>Pickup Pincode</td>
            <td style='padding:10px 18px;border-bottom:1px solid #edf2ef;color:#0f172a;font-weight:600;font-size:13px;'>" . x($v['pin']) . "</td>
          </tr>";
  }

  if ($isLot && (!empty($v['brand']) || !empty($v['model']))) {
    $userBody .= "
          <tr>
            <td style='padding:10px 18px;border-bottom:1px solid #edf2ef;color:#64748b;font-size:13px;'>Make &amp; Model</td>
            <td style='padding:10px 18px;border-bottom:1px solid #edf2ef;color:#0f172a;font-weight:600;font-size:13px;'>" . x(trim($v['brand'] . ' ' . $v['model'])) . "</td>
          </tr>";
  }
  if ($isLot && !empty($v['fuel'])) {
    $userBody .= "
          <tr>
            <td style='padding:10px 18px;border-bottom:1px solid #edf2ef;color:#64748b;font-size:13px;'>Fuel Type</td>
            <td style='padding:10px 18px;border-bottom:1px solid #edf2ef;color:#0f172a;font-weight:600;font-size:13px;'>" . x($v['fuel']) . "</td>
          </tr>";
  }
  if ($isLot && !empty($v['cond'])) {
    $userBody .= "
          <tr>
            <td style='padding:10px 18px;border-bottom:1px solid #edf2ef;color:#64748b;font-size:13px;'>Vehicle Condition</td>
            <td style='padding:10px 18px;border-bottom:1px solid #edf2ef;color:#0f172a;font-weight:600;font-size:13px;'>" . x($v['cond']) . "</td>
          </tr>";
  }
  if ($isLot && !empty($v['est'])) {
    $estValUser = preg_match('/^₹/', $v['est']) ? $v['est'] : '₹ ' . $v['est'];
    $userBody .= "
          <tr>
            <td style='padding:10px 18px;border-bottom:1px solid #edf2ef;color:#64748b;font-size:13px;'>Estimated Scrap Value</td>
            <td style='padding:10px 18px;border-bottom:1px solid #edf2ef;color:#1C6936;font-weight:700;font-size:14px;'>" . x($estValUser) . "</td>
          </tr>";
  }
  if ($isLot && !empty($v['when'])) {
    $userBody .= "
          <tr>
            <td style='padding:10px 18px;border-bottom:1px solid #edf2ef;color:#64748b;font-size:13px;'>Pickup Schedule</td>
            <td style='padding:10px 18px;border-bottom:1px solid #edf2ef;color:#1C6936;font-weight:600;font-size:13px;'>" . x($v['when']) . "</td>
          </tr>";
  }

  $userBody .= "
          <tr>
            <td style='padding:10px 18px;color:#64748b;font-size:13px;'>Contact Number</td>
            <td style='padding:10px 18px;color:#0f172a;font-weight:600;font-size:13px;'>" . x($phone) . "</td>
          </tr>
        </table>

        <!-- Assurance Bar -->
        <table role='presentation' style='width:100%;border-collapse:collapse;background:#f8faf9;border:1px dashed #b9d8c3;border-radius:8px;'>
          <tr>
            <td style='padding:14px;text-align:center;font-size:13px;color:#1C6936;font-weight:600;'>
              Authorized Govt Registered Vehicle Scrappage Facility (RVSF) Partner
            </td>
          </tr>
        </table>

      </td>
    </tr>

    <!-- Footer & Social Links -->
    <tr>
      <td style='background:#f8faf9;border-top:1px solid #dce8e0;padding:26px 28px;text-align:center;'>
        
        <div style='font-size:12px;font-weight:700;color:#1C6936;text-transform:uppercase;letter-spacing:1px;margin-bottom:12px;'>
          Connect With Us
        </div>

        <!-- Social Media Icon Links -->
        <div style='margin-bottom:18px;'>
          <a href='" . x($socialLinks['facebook'] ?? '#') . "' target='_blank' style='display:inline-block;margin:0 6px;text-decoration:none;'>
            <img src='https://img.icons8.com/color/48/facebook-new.png' width='26' height='26' alt='Facebook' style='display:block;border:0;' />
          </a>
          <a href='" . x($socialLinks['instagram'] ?? '#') . "' target='_blank' style='display:inline-block;margin:0 6px;text-decoration:none;'>
            <img src='https://img.icons8.com/color/48/instagram-new--v1.png' width='26' height='26' alt='Instagram' style='display:block;border:0;' />
          </a>
  
        </div>

        <p style='margin:0 0 8px;font-size:13px;color:#64748b;line-height:1.5;'>
          Need urgent assistance? Reply directly to this email or visit <a href='https://motozo.in' style='color:#1C6936;text-decoration:none;font-weight:600;'>motozo.in</a>
        </p>
        <div style='font-size:11px;color:#94a3b8;margin-top:12px;'>
          &copy; " . date('Y') . " Motozo. All rights reserved.
        </div>
      </td>
    </tr>

  </table>
</body>
</html>";
}

/* ==========================================================================
   3. DISPATCH MAILS (SMTP WITH FALLBACK)
   ========================================================================== */
$sent = false;
$mailDriver = strtolower((string)($cfg['driver'] ?? 'smtp'));
$replyEmail = (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) ? $email : (string)$cfg['from'];

if ($mailDriver === 'smtp' && !empty($cfg['smtp'])) {
  require_once __DIR__ . '/includes/smtp.php';
  $smtp = new SimpleSMTP($cfg['smtp']);

  // 1. Send Admin Notification Email
  $sent = $smtp->send(
    (string)$cfg['from'],
    (string)$cfg['from_name'],
    (array)$cfg['to'],
    $replyEmail,
    $subject,
    $body
  );
  if (!$sent) {
    $err = $smtp->getLastError();
    @file_put_contents(ROOT . '/storage/mail-errors.log', "$ts [SMTP Admin Failed] for $phone: $err\n", FILE_APPEND | LOCK_EX);
    // Fallback to native mail()
    $headers  = "MIME-Version: 1.0\r\nContent-Type: text/html; charset=UTF-8\r\n";
    $headers .= 'From: ' . $cfg['from_name'] . ' <' . $cfg['from'] . ">\r\n";
    $headers .= 'Reply-To: ' . $replyEmail . "\r\n";
    $sent = @mail(implode(',', (array)$cfg['to']), '=?UTF-8?B?' . base64_encode($subject) . '?=', $body, $headers);
  }

  // 2. Send Customer Confirmation Email (Only for quote-form.php when email is provided, NOT for lot-form.php or contact form without email)
  if (!$isLot && !$isContact && !empty($email) && !empty($userBody) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $userSent = $smtp->send(
      (string)$cfg['from'],
      (string)$cfg['from_name'],
      [$email],
      (string)$cfg['from'],
      $userSubject,
      $userBody
    );
    if (!$userSent) {
      $userErr = $smtp->getLastError();
      @file_put_contents(ROOT . '/storage/mail-errors.log', "$ts [SMTP User Confirmation Failed] for $email: $userErr\n", FILE_APPEND | LOCK_EX);
      $uHeaders  = "MIME-Version: 1.0\r\nContent-Type: text/html; charset=UTF-8\r\n";
      $uHeaders .= 'From: ' . $cfg['from_name'] . ' <' . $cfg['from'] . ">\r\n";
      $uHeaders .= 'Reply-To: ' . $cfg['from'] . "\r\n";
      @mail($email, '=?UTF-8?B?' . base64_encode($userSubject) . '?=', $userBody, $uHeaders);
    }
  }
} else {
  $headers  = "MIME-Version: 1.0\r\nContent-Type: text/html; charset=UTF-8\r\n";
  $headers .= 'From: ' . $cfg['from_name'] . ' <' . $cfg['from'] . ">\r\n";
  $headers .= 'Reply-To: ' . $replyEmail . "\r\n";
  $sent = @mail(implode(',', (array)$cfg['to']), '=?UTF-8?B?' . base64_encode($subject) . '?=', $body, $headers);
  if (!$sent) {
    @file_put_contents(ROOT . '/storage/mail-errors.log', "$ts [mail() Failed] for $phone\n", FILE_APPEND | LOCK_EX);
  }
  if (!$isLot && !$isContact && !empty($email) && !empty($userBody) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $uHeaders  = "MIME-Version: 1.0\r\nContent-Type: text/html; charset=UTF-8\r\n";
    $uHeaders .= 'From: ' . $cfg['from_name'] . ' <' . $cfg['from'] . ">\r\n";
    $uHeaders .= 'Reply-To: ' . $cfg['from'] . "\r\n";
    @mail($email, '=?UTF-8?B?' . base64_encode($userSubject) . '?=', $userBody, $uHeaders);
  }
}

// lead save ho chuki hai, isliye user ko success; mail fail hui to log me hai
if ($isContact) {
  out(true, "Thank you $name! Your message has been received. Our team will contact you on $phone shortly.");
} else {
  out(true, "Thank you $name! Our team will contact you on $phone within 30 minutes.");
}
