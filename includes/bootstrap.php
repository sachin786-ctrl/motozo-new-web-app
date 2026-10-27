<?php
declare(strict_types=1);

if (!defined('ROOT')) {
    define('ROOT', str_replace('\\', '/', dirname(__DIR__)));
}

if (!defined('BASE')) {
    $rawDocRoot = $_SERVER['DOCUMENT_ROOT'] ?? '';
    $docRoot = str_replace('\\', '/', realpath($rawDocRoot) ?: $rawDocRoot);
    $projectRoot = ROOT;

    $normDocRoot = rtrim(strtolower($docRoot), '/');
    $normProjRoot = rtrim(strtolower($projectRoot), '/');

    $subDir = '';
    // 1. Case-insensitive comparison for Windows file systems
    if ($normDocRoot !== '' && strpos($normProjRoot, $normDocRoot) === 0) {
        $subDir = substr($projectRoot, strlen($normDocRoot));
    }

    // 2. Fallback via SCRIPT_NAME (e.g. /motozo/index.php -> /motozo/)
    if (trim($subDir, '/') === '') {
        $scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
        $folderName = basename($projectRoot);
        if (!empty($folderName) && preg_match('#^/(.*?' . preg_quote($folderName, '#') . ')(/|$)#i', $scriptName, $m)) {
            $subDir = '/' . $m[1];
        } elseif (isset($_SERVER['REQUEST_URI']) && preg_match('#^/(.*?' . preg_quote($folderName, '#') . ')(/|[?]|$)#i', $_SERVER['REQUEST_URI'], $m)) {
            $subDir = '/' . $m[1];
        }
    }

    // 3. Fallback: if running in /motozo folder specifically
    if (trim($subDir, '/') === '' && isset($_SERVER['REQUEST_URI']) && stripos($_SERVER['REQUEST_URI'], '/motozo') !== false) {
        $subDir = '/motozo';
    }

    $basePath = '/' . trim($subDir, '/') . (trim($subDir, '/') !== '' ? '/' : '');
    define('BASE', $basePath);
}

// Load environment variables from .env or config/.env if present
foreach ([ROOT . '/.env', ROOT . '/config/.env'] as $envFile) {
    if (file_exists($envFile)) {
        $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines !== false) {
            foreach ($lines as $line) {
                $line = trim($line);
                if ($line === '' || strpos($line, '#') === 0) {
                    continue;
                }
                if (strpos($line, '=') !== false) {
                    [$k, $v] = explode('=', $line, 2);
                    $k = trim(ltrim(trim($k), '$'));
                    $v = trim(trim($v), "\"' ;\r\n");
                    if ($k !== '' && getenv($k) === false) {
                        putenv("{$k}={$v}");
                        $_ENV[$k] = $v;
                        $_SERVER[$k] = $v;
                    }
                }
            }
        }
    }
}

header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('Referrer-Policy: strict-origin-when-cross-origin');

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_set_cookie_params([
        'httponly' => true,
        'samesite' => 'Lax',
        'secure'   => !empty($_SERVER['HTTPS']),
    ]);
    session_start();
}
if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}
// bots ko pakadne ke liye: page kab render hua
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $_SESSION['rendered_at'] = time();
}

// page defaults (index.php / district.php inhe override karenge)
$pageType     = $pageType     ?? 'home';
$districtSlug = $districtSlug ?? '';
$districtName = $districtName ?? '';
$year         = date('Y');

function e(?string $s): string {
    return htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}