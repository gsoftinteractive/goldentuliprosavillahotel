<?php
require_once __DIR__ . '/includes/functions.php';
$page_title = 'Dining — ' . SITE_NAME;
$page_desc  = 'Ikechi Restaurant, Choby Lounge, Bush Bar and Pool Bar at Golden Tulip Rosa Villa.';
include __DIR__ . '/includes/header.php';
?>

<section class="page-hero" style="background-image:url('images/restaurant.jpg')">
    <div class="page-hero-content">
        <span class="eyebrow light center with-after">Food &amp; Beverage</span>
        <h1>Dining &amp; Lounges</h1>
        <p>International standards meet local flavours — a curated culinary experience.</p>
    </div>
</section>

<section class="section">
    <div class="narrow center reveal">
        <span class="eyebrow with-after">Restaurants &amp; Bars</span>
        <h2 class="section-title">Dining With International Standards and Local Flavours</h2>
        <p class="section-lede">
            At Golden Rosa Villa, dining is an experience designed to be savoured. Our carefully curated
            food and beverage offerings combine global culinary standards with rich local flavours,
            creating memorable moments for both in-house and outside guests.
        </p>
    </div>
</section>

<section class="dining-teaser">
    <div class="dining-teaser-image" style="background-image:url('images/restaurant.jpg')"></div>
    <div class="dining-teaser-text reveal">
        <span class="eyebrow">All-Day Dining</span>
        <h2>Ikechi Restaurant</h2>
        <p>
            Ikechi Restaurant offers a refined yet welcoming dining atmosphere, perfect for business
            lunches, intimate dinners, and relaxed meals at any time of day.
        </p>
        <p>
            A thoughtful selection of continental and African dishes — available through both buffet
            service and à la carte options — prepared with fresh ingredients and attention to detail.
        </p>
        <p style="font-size:13px;color:var(--gold-deep);letter-spacing:2px;text-transform:uppercase;margin-top:18px;">
            Daily &middot; 6:30 AM – 10:30 PM
        </p>
        <a href="booking.php" class="btn btn-outline">Reserve a Table</a>
    </div>
</section>

<section class="dining-teaser" style="grid-template-columns: 1fr 1fr;">
    <div class="dining-teaser-text reveal" style="order:1;">
        <span class="eyebrow">Lounge &amp; Bar</span>
        <h2>Choby Lounge &amp; Bush Bar</h2>
        <p>
            A cozy, stylish space designed for connection and relaxation. Whether you're meeting
            colleagues, catching up with friends, or unwinding after a long day, the lounge offers
            a comfortable atmosphere paired with attentive service.
        </p>
        <p>
            Enjoy a selection of coffee, teas, snacks, cocktails, mocktails, wines, and spirits,
            alongside light meals from our à la carte menu.
        </p>
        <a href="contact.php" class="btn btn-outline">Enquire</a>
    </div>
    <div class="dining-teaser-image" style="background-image:url('images/bush-bar.jpg'); order:2;"></div>
</section>

<section class="dining-teaser">
    <div class="dining-teaser-image" style="background-image:url('images/pool.jpg')"></div>
    <div class="dining-teaser-text reveal">
        <span class="eyebrow">Open-Air</span>
        <h2>Pool Bar</h2>
        <p>
            The Outdoor Lounge provides a relaxed open-air setting for evenings spent unwinding
            under the city sky. Guests can enjoy refreshing drinks, light bites, and a calm social
            atmosphere — perfect for casual meet-ups or quiet moments of reflection.
        </p>
        <a href="amenities.php" class="btn btn-outline">View Amenities</a>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
