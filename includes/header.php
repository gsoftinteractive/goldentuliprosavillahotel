<?php
require_once __DIR__ . '/functions.php';
$page_title = $page_title ?? SITE_NAME;
$page_desc  = $page_desc  ?? 'A premium hospitality destination in the heart of Owerri. ' . SITE_TAGLINE;
$transparent_nav = $transparent_nav ?? false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= e($page_title) ?></title>
    <meta name="description" content="<?= e($page_desc) ?>" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600;700&family=Montserrat:wght@200;300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/style.css?v=4" />
</head>
<body class="<?= $transparent_nav ? 'has-transparent-nav' : '' ?>">

<a href="#main" class="skip-link">Skip to content</a>

<div class="topbar">
    <div class="topbar-inner">
        <div class="topbar-left">
            <a href="https://wa.me/<?= e(HOTEL_WHATSAPP) ?>" target="_blank" rel="noopener" class="tb-wa" aria-label="WhatsApp reservations">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M.057 24l1.687-6.163a11.867 11.867 0 0 1-1.587-5.946C.16 5.335 5.495 0 12.05 0a11.817 11.817 0 0 1 8.413 3.488 11.824 11.824 0 0 1 3.48 8.414c-.003 6.557-5.338 11.892-11.893 11.892a11.9 11.9 0 0 1-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                <span class="tb-num"><?= e(HOTEL_PHONE_1) ?></span>
            </a>
            <a href="tel:<?= e(HOTEL_PHONE_2) ?>" class="tb-tel hide-sm" aria-label="Hotel front desk">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.37 1.9.72 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.35 1.85.59 2.81.72A2 2 0 0 1 22 16.92z"/></svg>
                <?= e(HOTEL_PHONE_2) ?>
            </a>
            <a href="mailto:<?= e(HOTEL_EMAIL_RES) ?>" class="hide-md" aria-label="Email reservations">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                <?= e(HOTEL_EMAIL_RES) ?>
            </a>
        </div>
        <div class="topbar-right hide-sm">
            <span>Reception open 24/7</span>
        </div>
    </div>
</div>

<header class="site-nav" id="siteNav">
    <div class="nav-inner">
        <a href="index.php" class="logo">
            <span class="logo-mark">GT</span>
            <span class="logo-text">
                <span class="logo-primary">Golden Tulip</span>
                <span class="logo-secondary">Rosa Villa Hotel</span>
            </span>
        </a>

        <nav class="nav-links" id="navLinks">
            <a href="index.php"     class="nav-link<?= is_active('index.php') ?>">Home</a>
            <a href="rooms.php"     class="nav-link<?= is_active('rooms.php') . is_active('room.php') ?>">Rooms</a>
            <a href="dining.php"    class="nav-link<?= is_active('dining.php') ?>">Dining</a>
            <a href="amenities.php" class="nav-link<?= is_active('amenities.php') ?>">Amenities</a>
            <a href="meetings.php"  class="nav-link<?= is_active('meetings.php') ?>">Meetings</a>
            <a href="gallery.php"   class="nav-link<?= is_active('gallery.php') ?>">Gallery</a>
            <a href="reviews.php"   class="nav-link<?= is_active('reviews.php') ?>">Reviews</a>
            <a href="about.php"     class="nav-link<?= is_active('about.php') ?>">About</a>
            <a href="contact.php"   class="nav-link<?= is_active('contact.php') ?>">Contact</a>
            <a href="booking.php"   class="btn btn-gold nav-cta">Book Now</a>
        </nav>

        <button class="nav-toggle" id="navToggle" aria-label="Toggle menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</header>

<main id="main">
