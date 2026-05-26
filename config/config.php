<?php
/**
 * Golden Tulip Rosa Villa Hotel — Site Config
 *
 * Production overrides: create `config/config.local.php` with `define()` calls
 * for any constant you want to override (DB creds, bank details, etc.).
 * It loads first and wins (since define() is first-write-wins).
 * `config.local.php` is gitignored — never deployed, never overwritten.
 */

@include __DIR__ . '/config.local.php';

// Database
if (!defined('DB_HOST')) define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');
if (!defined('DB_PORT')) define('DB_PORT', getenv('DB_PORT') ?: '3306');
if (!defined('DB_NAME')) define('DB_NAME', getenv('DB_NAME') ?: 'gt_rosavilla');
if (!defined('DB_USER')) define('DB_USER', getenv('DB_USER') ?: 'root');
if (!defined('DB_PASS')) define('DB_PASS', getenv('DB_PASS') ?: '');

// Site
if (!defined('SITE_NAME'))    define('SITE_NAME',  'Golden Tulip Rosa Villa Hotel');
if (!defined('SITE_SHORT'))   define('SITE_SHORT', 'Rosa Villa');
if (!defined('SITE_TAGLINE')) define('SITE_TAGLINE', 'Luxury, Comfort & Serenity in the Heart of Owerri');
if (!defined('SITE_URL'))     define('SITE_URL',   (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://') . ($_SERVER['HTTP_HOST'] ?? 'localhost'));

// Contact
if (!defined('HOTEL_ADDRESS_PH'))   define('HOTEL_ADDRESS_PH',   '152 Tombia Street, GRA Phase 2, Port Harcourt, Rivers State, Nigeria');
if (!defined('HOTEL_ADDRESS_OW'))   define('HOTEL_ADDRESS_OW',   'Plot 5 Achike Udenwa Estate, New Owerri, Imo State');
// HOTEL_PHONE_1 = Reservations / WhatsApp (clickable WhatsApp link)
// HOTEL_PHONE_2 = Front Desk (regular phone)
if (!defined('HOTEL_PHONE_1'))      define('HOTEL_PHONE_1',      '+234 913 958 6398');
if (!defined('HOTEL_PHONE_2'))      define('HOTEL_PHONE_2',      '+234 913 958 6397');
if (!defined('HOTEL_WHATSAPP'))     define('HOTEL_WHATSAPP',     '2349139586398'); // digits only, used in wa.me link
if (!defined('HOTEL_EMAIL_RES'))    define('HOTEL_EMAIL_RES',    'reservations@goldentuliprosavillahotel.com');
if (!defined('HOTEL_EMAIL_INFO'))   define('HOTEL_EMAIL_INFO',   'info@goldentuliprosavillahotel.com');
if (!defined('HOTEL_EMAIL_EVENTS')) define('HOTEL_EMAIL_EVENTS', 'events@goldentuliprosavillahotel.com');

// Bank transfer (placeholders — override in config.local.php with real details)
if (!defined('BANK_NAME'))         define('BANK_NAME',         'Zenith Bank');
if (!defined('BANK_ACCOUNT_NAME')) define('BANK_ACCOUNT_NAME', 'Golden Tulip Rosa Villa Hotel Ltd');
if (!defined('BANK_ACCOUNT_NO'))   define('BANK_ACCOUNT_NO',   '1234567890');
if (!defined('BANK_SORT_CODE'))    define('BANK_SORT_CODE',    '057');

// Currency
define('CURRENCY_SYMBOL', '\u{20A6}'); // Naira sign
define('CURRENCY_CODE',   'NGN');

// Timezone
date_default_timezone_set('Africa/Lagos');

// Error display — toggle for production
$is_local = in_array($_SERVER['HTTP_HOST'] ?? '', ['localhost', '127.0.0.1', 'goldentuliprosavillahotel.test']);
if ($is_local) {
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '0');
    error_reporting(0);
}
