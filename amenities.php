<?php
require_once __DIR__ . '/includes/functions.php';
$page_title = 'Amenities — ' . SITE_NAME;
$page_desc  = 'Pool, gym, lounge, secure parking, free Wi-Fi and 24-hour reception.';
include __DIR__ . '/includes/header.php';
?>

<section class="page-hero" style="background-image:url('images/pool.jpg')">
    <div class="page-hero-content">
        <span class="eyebrow light center with-after">Facilities</span>
        <h1>Amenities &amp; Leisure</h1>
        <p>Everything you need for a comfortable and inspired stay.</p>
    </div>
</section>

<section class="section">
    <div class="narrow center reveal">
        <span class="eyebrow with-after">Designed for Comfort</span>
        <h2 class="section-title">Hotel Facilities</h2>
        <p class="section-lede">
            Thoughtfully curated facilities designed to support relaxation, productivity, and
            memorable moments throughout your stay.
        </p>
    </div>
</section>

<section class="experience">
    <div class="experience-grid">
        <div class="exp-card reveal">
            <img src="images/pool.jpg" alt="Swimming pool" loading="lazy" />
            <div class="exp-card-body">
                <span class="eyebrow light">Leisure</span>
                <h3>Outdoor Pool</h3>
                <p>Refresh in our outdoor pool — the centerpiece of relaxation at Rosa Villa.</p>
            </div>
        </div>
        <div class="exp-card reveal">
            <img src="images/gym.jpg" alt="Fitness centre" loading="lazy" />
            <div class="exp-card-body">
                <span class="eyebrow light">Wellness</span>
                <h3>Fitness Centre</h3>
                <p>A fully equipped gym to keep your routine going while you travel.</p>
            </div>
        </div>
        <div class="exp-card reveal">
            <img src="images/reception.jpg" alt="Hotel reception" loading="lazy" />
            <div class="exp-card-body">
                <span class="eyebrow light">Service</span>
                <h3>24-Hour Reception</h3>
                <p>Warm, professional staff available around the clock for guest support.</p>
            </div>
        </div>
        <div class="exp-card reveal">
            <img src="images/chandelier.jpg" alt="Common lounge area" loading="lazy" />
            <div class="exp-card-body">
                <span class="eyebrow light">Spaces</span>
                <h3>Lobby &amp; Lounge</h3>
                <p>Elegant common areas — from a grand piano lobby to intimate lounge spaces.</p>
            </div>
        </div>
    </div>
</section>

<section class="amenities-strip">
    <div class="section-head reveal">
        <span class="eyebrow light center with-after">Included With Every Stay</span>
        <h2 class="section-title">Standard Amenities</h2>
    </div>
    <div class="container amenities-grid reveal">
        <?php
        $items = [
            ['Fine Dining Restaurant',   'Continental &amp; African cuisine'],
            ['Coffee Bar',               'Espresso, teas &amp; light bites'],
            ['Outdoor Bush Lounge',      'Open-air evenings under the sky'],
            ['Lobby with Grand Piano',   'Elegant arrival experience'],
            ['Common Lounge Area',       'Comfortable shared spaces'],
            ['Meeting Room',             'Flexible business facility'],
            ['24-Hour Reception',        'Round-the-clock service'],
            ['Functional Gym Facility',  'Cardio &amp; strength equipment'],
            ['Free High-Speed Wi-Fi',    'Connected throughout the hotel'],
            ['Secure Parking',           'Ample on-site parking'],
            ['Elevator Access',          'Easy access to every floor'],
            ['Laundry &amp; Dry Cleaning', 'Same-day service available'],
        ];
        foreach ($items as $i): ?>
            <div class="amenity">
                <div class="amenity-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                </div>
                <h4><?= $i[0] ?></h4>
                <p><?= $i[1] ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
