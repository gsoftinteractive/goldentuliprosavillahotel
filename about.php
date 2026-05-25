<?php
require_once __DIR__ . '/includes/functions.php';
$page_title = 'About — ' . SITE_NAME;
$page_desc  = 'Discover the story of Golden Tulip Rosa Villa Hotel Owerri.';
include __DIR__ . '/includes/header.php';
?>

<section class="page-hero" style="background-image:url('images/exterior-aerial-sunset.jpg')">
    <div class="page-hero-content">
        <span class="eyebrow light center with-after">Our Story</span>
        <h1>About Golden Tulip Rosa Villa</h1>
        <p>Welcome to Luxury, Comfort, and Serenity in the Heart of Owerri.</p>
    </div>
</section>

<section class="section">
    <div class="narrow reveal" style="text-align:center;">
        <span class="eyebrow with-after center">Hotel Overview</span>
        <h2 class="section-title">A Global Brand With Local Soul</h2>
        <p class="section-lede" style="margin-bottom:30px;">
            Golden Tulip Rosa Villa Hotel Owerri is part of the globally recognized Golden Tulip
            Hotels &amp; Resorts brand — renowned for delivering exceptional hospitality standards,
            premium comfort, and thoughtfully crafted guest experiences across the world.
        </p>
        <p style="color:var(--grey);max-width:760px;margin:0 auto 18px;">
            The hotel offers a seamless blend of elegant accommodation, relaxing leisure experiences,
            modern hospitality services, and business-friendly facilities — designed to meet the needs
            of both corporate and leisure travelers.
        </p>
        <p style="color:var(--grey);max-width:760px;margin:0 auto;">
            What truly distinguishes Golden Tulip Rosa Villa Hotel Owerri is its unique combination of
            international quality and warm local hospitality. Every guest experience is shaped by
            attentive service, refined comfort, and the vibrant character of Owerri itself.
        </p>
    </div>
</section>

<section class="section welcome tight">
    <div class="container welcome-grid">
        <div class="welcome-images reveal">
            <img class="img-main" src="images/exterior-front-night.jpg" alt="Hotel exterior at night" />
            <img class="img-accent" src="images/chandelier.jpg" alt="Hotel interior detail" />
        </div>
        <div class="welcome-text reveal">
            <span class="eyebrow">Our Location</span>
            <h2>In the Heart of Owerri</h2>
            <p>
                Golden Tulip Rosa Villa Hotel Owerri is strategically located in the serene Achike
                Udenwa Estate area of Owerri, providing convenient access for both business and
                leisure travelers within the city and beyond.
            </p>
            <p style="margin-top:18px;font-weight:500;color:var(--charcoal);">Nearby:</p>
            <ul style="list-style:none;padding:0;margin-top:8px;color:var(--grey);font-size:14px;">
                <li style="padding:6px 0;border-bottom:1px solid var(--grey-light);">All Seasons Hotel</li>
                <li style="padding:6px 0;border-bottom:1px solid var(--grey-light);">Imo Concorde Hotel</li>
                <li style="padding:6px 0;border-bottom:1px solid var(--grey-light);">Freedom Square</li>
                <li style="padding:6px 0;border-bottom:1px solid var(--grey-light);">Everyday Mall Owerri</li>
                <li style="padding:6px 0;">Imo House of Assembly</li>
            </ul>
        </div>
    </div>
</section>

<section class="cta-strip">
    <div class="reveal">
        <span class="eyebrow light center with-after">Reserve Your Stay</span>
        <h2 class="section-title">Experience It For Yourself</h2>
        <p>Welcome to luxury, comfort, and serenity in the heart of Owerri.</p>
        <a href="booking.php" class="btn btn-gold">Book Now</a>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
