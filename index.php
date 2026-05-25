<?php
require_once __DIR__ . '/includes/functions.php';
$page_title = SITE_NAME . ' — ' . SITE_TAGLINE;
$page_desc  = 'A premium hospitality destination in the serene Achike Udenwa Estate of Owerri. 47 elegantly furnished rooms, fine dining, and refined hospitality.';
$transparent_nav = true;

$rooms = get_rooms();

$slides = [
    ['image' => 'images/exterior-aerial-sunset.jpg', 'eyebrow' => 'Now Open in Owerri', 'title' => 'A New Standard of', 'accent' => 'Luxury & Comfort'],
    ['image' => 'images/reception.jpg',              'eyebrow' => 'Where Every Detail Matters', 'title' => 'Refined Hospitality,', 'accent' => 'Thoughtfully Crafted'],
    ['image' => 'images/pool.jpg',                   'eyebrow' => 'Unwind In Style', 'title' => 'Your Sanctuary in', 'accent' => 'The Heart of Owerri'],
    ['image' => 'images/exterior-front-night.jpg',   'eyebrow' => 'Welcome', 'title' => 'Five-Star Hospitality,', 'accent' => 'Warm Local Spirit'],
];

include __DIR__ . '/includes/header.php';
?>

<!-- =================== HERO CAROUSEL =================== -->
<section class="hero">
    <div class="hero-slides">
        <?php foreach ($slides as $i => $s): ?>
            <div class="hero-slide<?= $i === 0 ? ' active' : '' ?>" style="background-image:url('<?= e($s['image']) ?>')"></div>
        <?php endforeach; ?>
    </div>

    <div class="hero-content">
        <span class="eyebrow light"><span data-hero-eyebrow><?= e($slides[0]['eyebrow']) ?></span></span>
        <h1>
            <span data-hero-title><?= e($slides[0]['title']) ?></span>
            <span class="accent" data-hero-accent><?= e($slides[0]['accent']) ?></span>
        </h1>
        <p class="hero-lede">
            Welcome to Golden Tulip Rosa Villa Hotel Owerri — where timeless elegance,
            modern comfort, and warm local hospitality come together to create unforgettable stays.
        </p>
        <div class="hero-actions">
            <a href="rooms.php"   class="btn btn-gold">Explore Our Rooms</a>
            <a href="booking.php" class="btn btn-outline-light">Book Your Stay</a>
        </div>
    </div>

    <div class="hero-dots">
        <?php foreach ($slides as $i => $_): ?>
            <button class="hero-dot<?= $i === 0 ? ' active' : '' ?>" aria-label="Slide <?= $i + 1 ?>"></button>
        <?php endforeach; ?>
    </div>

    <div class="hero-scroll">Scroll to discover</div>

    <!-- Quick Booking Bar -->
    <form class="booking-bar" action="booking.php" method="get">
        <div class="field">
            <label for="qb_check_in">Check-In</label>
            <input id="qb_check_in" type="date" name="check_in" data-role="check-in" data-pair="qb" required />
        </div>
        <div class="field">
            <label for="qb_check_out">Check-Out</label>
            <input id="qb_check_out" type="date" name="check_out" data-role="check-out" data-pair="qb" required />
        </div>
        <div class="field">
            <label for="qb_guests">Guests</label>
            <select id="qb_guests" name="adults">
                <option value="1">1 Adult</option>
                <option value="2" selected>2 Adults</option>
                <option value="3">3 Adults</option>
                <option value="4">4 Adults</option>
            </select>
        </div>
        <div class="field">
            <label for="qb_room">Room Type</label>
            <select id="qb_room" name="room_id">
                <option value="">Any room</option>
                <?php foreach ($rooms as $r): ?>
                    <option value="<?= (int)$r['id'] ?>"><?= e($r['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="field field-submit">
            <button type="submit" class="btn btn-gold">Check Availability</button>
        </div>
    </form>
</section>

<!-- =================== WELCOME =================== -->
<section class="section welcome">
    <div class="container welcome-grid">
        <div class="welcome-images reveal">
            <img class="img-main" src="images/exterior-front.jpg" alt="Golden Tulip Rosa Villa Hotel exterior" />
            <img class="img-accent" src="images/reception.jpg" alt="Hotel reception lobby" />
        </div>
        <div class="welcome-text reveal">
            <span class="eyebrow">Welcome</span>
            <h2>Experience Luxury and Comfort in the Heart of Owerri</h2>
            <p>
                Golden Tulip Rosa Villa Hotel Owerri is a premium hospitality destination located in
                the serene and prestigious Achike Udenwa Estate area of Owerri, the vibrant capital
                city of Imo State.
            </p>
            <p>
                Nestled within a calm, secure, and beautifully maintained environment, the hotel
                offers guests a refreshing blend of relaxation, elegance, and modern convenience —
                ideal for both business and leisure travelers.
            </p>
            <a href="about.php" class="btn btn-ghost">Discover Our Story</a>

            <div class="welcome-stats">
                <div class="welcome-stat"><div class="num">47</div><div class="label">Elegant Rooms</div></div>
                <div class="welcome-stat"><div class="num">4</div><div class="label">Dining Venues</div></div>
                <div class="welcome-stat"><div class="num">24<span style="font-size:24px">/7</span></div><div class="label">Reception</div></div>
            </div>
        </div>
    </div>
</section>

<!-- =================== ROOMS =================== -->
<section class="section rooms-section">
    <div class="section-head reveal">
        <span class="eyebrow center with-after">Accommodation</span>
        <h2 class="section-title">Rooms &amp; Suites</h2>
        <p class="section-lede">
            47 elegantly furnished rooms, thoughtfully designed to deliver comfort,
            relaxation, and refined luxury within a serene hospitality environment.
        </p>
    </div>

    <div class="container rooms-grid">
        <?php foreach ($rooms as $room): ?>
            <article class="room-card reveal">
                <div class="room-card-image">
                    <img src="images/<?= e($room['image']) ?>" alt="<?= e($room['name']) ?>" loading="lazy" />
                    <div class="room-card-price"><strong><?= naira((float)$room['price_ngn']) ?></strong>/ night</div>
                </div>
                <div class="room-card-body">
                    <div class="room-tag"><?= e($room['tagline']) ?></div>
                    <h3><?= e($room['name']) ?></h3>
                    <p><?= e(mb_strimwidth($room['description'], 0, 140, '…')) ?></p>
                    <div class="room-card-meta">
                        <span>↔ <?= (int)$room['size_sqm'] ?> sqm</span>
                        <span>♛ <?= e($room['bed_type']) ?></span>
                        <span>☻ Up to <?= (int)$room['max_guests'] ?></span>
                    </div>
                    <div class="room-card-actions">
                        <a href="room.php?slug=<?= e($room['slug']) ?>" class="btn btn-ghost">View Details</a>
                        <a href="booking.php?room_id=<?= (int)$room['id'] ?>" class="btn btn-gold" style="margin-left:auto;padding:12px 22px;">Book</a>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<!-- =================== EXPERIENCE =================== -->
<section class="section experience tight">
    <div class="section-head reveal">
        <span class="eyebrow center with-after">Curated Experiences</span>
        <h2 class="section-title">Beyond the Stay</h2>
        <p class="section-lede">From culinary journeys to wellness moments — every detail is designed to inspire.</p>
    </div>
    <div class="experience-grid">
        <a href="dining.php" class="exp-card reveal">
            <img src="images/restaurant.jpg" alt="Ikechi Restaurant" loading="lazy" />
            <div class="exp-card-body">
                <span class="eyebrow light">Dining</span>
                <h3>Ikechi Restaurant</h3>
                <p>A refined dining experience blending continental and African flavours, served buffet or à la carte.</p>
                <span class="btn-ghost">Discover Dining</span>
            </div>
        </a>
        <a href="amenities.php" class="exp-card reveal">
            <img src="images/pool.jpg" alt="Rosa Villa swimming pool" loading="lazy" />
            <div class="exp-card-body">
                <span class="eyebrow light">Leisure</span>
                <h3>Pool &amp; Wellness</h3>
                <p>Unwind by the pool, energize at our fitness centre, or relax in our Bush Bar lounge.</p>
                <span class="btn-ghost">Explore Amenities</span>
            </div>
        </a>
        <a href="amenities.php" class="exp-card reveal">
            <img src="images/bush-bar.jpg" alt="Bush Bar at Golden Tulip Rosa Villa" loading="lazy" />
            <div class="exp-card-body">
                <span class="eyebrow light">Lounge</span>
                <h3>Bush Bar &amp; Choby Lounge</h3>
                <p>A stylish, open-air space for evening drinks, cocktails, and easy conversation under the city sky.</p>
                <span class="btn-ghost">View Lounges</span>
            </div>
        </a>
        <a href="meetings.php" class="exp-card reveal">
            <img src="images/exterior-courtyard.jpg" alt="Meetings and events at Rosa Villa" loading="lazy" />
            <div class="exp-card-body">
                <span class="eyebrow light">Business</span>
                <h3>Meetings &amp; Events</h3>
                <p>Dedicated meeting space with modern AV, flexible seating, and attentive hospitality — every event made memorable.</p>
                <span class="btn-ghost">Plan Your Event</span>
            </div>
        </a>
    </div>
</section>

<!-- =================== AMENITIES STRIP =================== -->
<section class="amenities-strip">
    <div class="section-head reveal">
        <span class="eyebrow light center with-after">Hotel Facilities</span>
        <h2 class="section-title">Everything You Need, Perfected</h2>
    </div>
    <div class="container amenities-grid reveal">
        <?php
        $amenities = [
            ['Free Wi-Fi',     'High-speed internet across the hotel'],
            ['Fine Dining',    'Restaurant, coffee bar & lounges'],
            ['Outdoor Pool',   'Refreshing swimming pool'],
            ['Fitness Centre', 'Fully equipped gym facility'],
            ['Secure Parking', 'Ample on-site secure parking'],
            ['24-hr Reception','Round-the-clock guest support'],
            ['Meeting Spaces', 'Flexible business facilities'],
            ['Concierge',      'Personalized guest services'],
        ];
        foreach ($amenities as $a):
        ?>
            <div class="amenity">
                <div class="amenity-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M12 2 L14 8 L20 8 L15 12 L17 18 L12 14 L7 18 L9 12 L4 8 L10 8 Z"/>
                    </svg>
                </div>
                <h4><?= e($a[0]) ?></h4>
                <p><?= e($a[1]) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- =================== DINING TEASER =================== -->
<section class="dining-teaser">
    <div class="dining-teaser-image" style="background-image:url('images/restaurant.jpg')" aria-hidden="true"></div>
    <div class="dining-teaser-text reveal">
        <span class="eyebrow">Dining With International Standards</span>
        <h2>Ikechi Restaurant &amp; Bars</h2>
        <p>
            At Golden Tulip Rosa Villa, dining is an experience designed to be savoured.
            Our carefully curated food and beverage offerings combine global culinary
            standards with rich local flavours.
        </p>
        <p>
            Enjoy buffet or à la carte service in our restaurant, relax with crafted
            cocktails at the Choby Lounge, or unwind in the open air at our signature
            Bush Bar.
        </p>
        <a href="dining.php" class="btn btn-outline">Explore Dining</a>
    </div>
</section>

<!-- =================== CTA =================== -->
<section class="cta-strip">
    <div class="reveal">
        <span class="eyebrow light center with-after">Reserve Your Stay</span>
        <h2 class="section-title">Welcome to Luxury, Comfort &amp; Serenity</h2>
        <p>
            Book your stay at Golden Tulip Rosa Villa Hotel Owerri — and experience
            refined hospitality in the heart of Imo State.
        </p>
        <a href="booking.php" class="btn btn-gold">Book Now</a>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
