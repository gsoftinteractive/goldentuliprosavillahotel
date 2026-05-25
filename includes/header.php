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
    <link rel="stylesheet" href="assets/css/style.css?v=1" />
</head>
<body class="<?= $transparent_nav ? 'has-transparent-nav' : '' ?>">

<a href="#main" class="skip-link">Skip to content</a>

<div class="topbar">
    <div class="topbar-inner">
        <div class="topbar-left">
            <a href="tel:<?= e(HOTEL_PHONE_1) ?>"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.37 1.9.72 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.35 1.85.59 2.81.72A2 2 0 0 1 22 16.92z"/></svg> <?= e(HOTEL_PHONE_1) ?></a>
            <a href="mailto:<?= e(HOTEL_EMAIL_RES) ?>" class="hide-sm"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg> <?= e(HOTEL_EMAIL_RES) ?></a>
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
            <a href="index.php"   class="nav-link<?= is_active('index.php') ?>">Home</a>
            <a href="rooms.php"   class="nav-link<?= is_active('rooms.php') . is_active('room.php') ?>">Rooms</a>
            <a href="dining.php"  class="nav-link<?= is_active('dining.php') ?>">Dining</a>
            <a href="amenities.php" class="nav-link<?= is_active('amenities.php') ?>">Amenities</a>
            <a href="meetings.php" class="nav-link<?= is_active('meetings.php') ?>">Meetings</a>
            <a href="about.php"   class="nav-link<?= is_active('about.php') ?>">About</a>
            <a href="contact.php" class="nav-link<?= is_active('contact.php') ?>">Contact</a>
            <a href="booking.php" class="btn btn-gold nav-cta">Book Now</a>
        </nav>

        <button class="nav-toggle" id="navToggle" aria-label="Toggle menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</header>

<main id="main">
