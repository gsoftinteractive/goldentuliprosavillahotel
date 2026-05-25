<?php
/**
 * Golden Tulip Rosa Villa Hotel — Site Config
 * Edit DB credentials below to match your local / production environment.
 */

// Database
define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');
define('DB_PORT', getenv('DB_PORT') ?: '3306');
define('DB_NAME', getenv('DB_NAME') ?: 'gt_rosavilla');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');

// Site
define('SITE_NAME',  'Golden Tulip Rosa Villa Hotel');
define('SITE_SHORT', 'Rosa Villa');
define('SITE_TAGLINE', 'Luxury, Comfort & Serenity in the Heart of Owerri');
define('SITE_URL',   (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://') . ($_SERVER['HTTP_HOST'] ?? 'localhost'));

// Contact
define('HOTEL_ADDRESS_PH',   '152 Tombia Street, GRA Phase 2, Port Harcourt, Rivers State, Nigeria');
define('HOTEL_ADDRESS_OW',   'Plot 5 Achike Udenwa Estate, New Owerri, Imo State');
define('HOTEL_PHONE_1',      '+234 913 958 6398');
define('HOTEL_PHONE_2',      '+234 913 958 6397');
define('HOTEL_EMAIL_RES',    'reservations@goldentuliprosavillahotel.com');
define('HOTEL_EMAIL_INFO',   'info@goldentuliprosavillahotel.com');
define('HOTEL_EMAIL_EVENTS', 'events@goldentuliprosavillahotel.com');

// Bank transfer (placeholders — update with real details)
define('BANK_NAME',       'Zenith Bank');
define('BANK_ACCOUNT_NAME', 'Golden Tulip Rosa Villa Hotel Ltd');
define('BANK_ACCOUNT_NO',   '1234567890');
define('BANK_SORT_CODE',    '057');

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
