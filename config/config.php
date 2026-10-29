<?php
/**
 * BİKGRUP - Konfigürasyon Dosyası
 * PHP 8.2 / 8.3 / 8.4 Uyumlu
 */

declare(strict_types=1);

// Oturum güvenliği ayarları (Session başlatılmadan önce tanımlanmalı)
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', '1');
    ini_set('session.use_only_cookies', '1');
    ini_set('session.cookie_samesite', 'Lax');
    session_start();
}

// PHP 8.0+ Uyumluluk Polyfill'leri (Her sürümde sıfır hata garantisi)
if (!function_exists('str_starts_with')) {
    function str_starts_with(string $haystack, string $needle): bool {
        return $needle === '' || strncmp($haystack, $needle, strlen($needle)) === 0;
    }
}
if (!function_exists('str_ends_with')) {
    function str_ends_with(string $haystack, string $needle): bool {
        return $needle === '' || substr($haystack, -strlen($needle)) === $needle;
    }
}
if (!function_exists('str_contains')) {
    function str_contains(string $haystack, string $needle): bool {
        return $needle === '' || strpos($haystack, $needle) !== false;
    }
}

// Hata raporlama (Geliştirme aşamasında açık, canlıda kapalı tutulabilir)
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Veritabanı Bilgileri
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_NAME', 'bikgrup_db');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// Uygulama Sabitleri
define('APP_NAME', 'BİKGRUP');
define('PANEL_SLUG', 'xpanel');
define('DEFAULT_LANG', 'tr');
define('SUPPORTED_LANGS', ['tr', 'en']);

// Base URL tespiti (XAMPP /bikgrup diziniyle tam uyumlu)
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
$scriptDir = rtrim(dirname($scriptName), '/\\');

// Eğer /bikgrup gibi bir alt dizindeyse
if ($scriptDir !== '' && $scriptDir !== '.') {
    $baseUrl = $protocol . $host . $scriptDir;
} else {
    // CLI veya kök dizin fallback
    $baseUrl = $protocol . $host . '/bikgrup';
}
define('BASE_URL', rtrim($baseUrl, '/'));

// Klasör Yolları
define('ROOT_PATH', dirname(__DIR__));
define('CONFIG_PATH', ROOT_PATH . '/config');
define('CORE_PATH', ROOT_PATH . '/core');
define('APP_PATH', ROOT_PATH . '/app');
define('VIEWS_PATH', ROOT_PATH . '/views');
define('LANG_PATH', ROOT_PATH . '/languages');
define('PUBLIC_PATH', ROOT_PATH . '/public');
define('UPLOADS_PATH', PUBLIC_PATH . '/uploads');
