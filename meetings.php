<?php
require_once __DIR__ . '/includes/functions.php';
$page_title = 'Meetings & Events — ' . SITE_NAME;
$page_desc  = 'Dedicated meeting space, restaurant private dining, and event facilities.';
include __DIR__ . '/includes/header.php';
?>

<section class="page-hero" style="background-image:url('images/exterior-courtyard.jpg')">
    <div class="page-hero-content">
        <span class="eyebrow light center with-after">Business &amp; Events</span>
        <h1>Meetings &amp; Events</h1>
        <p>Refined spaces, modern facilities, and attentive hospitality for every gathering.</p>
    </div>
</section>

<section class="section">
    <div class="container welcome-grid">
        <div class="welcome-images reveal">
            <img class="img-main" src="images/restaurant.jpg" alt="Meeting space at Rosa Villa" />
            <img class="img-accent" src="images/exterior-courtyard.jpg" alt="Hotel courtyard" />
        </div>
        <div class="welcome-text reveal">
            <span class="eyebrow">Meetings Made Memorable</span>
            <h2>Refined Spaces, Effortless Execution</h2>
            <p>
                Golden Tulip Rosa Villa Hotel Owerri offers a refined and well-equipped environment
                for business meetings, training, interviews, seminars, private dinners, and intimate
                social gatherings.
            </p>
            <p>
                Designed with efficiency, comfort, and professionalism in mind, our meeting facilities
                combine modern functionality with attentive hospitality to ensure every event is
                seamless and well-executed.
            </p>
            <p>
                For smaller or more informal engagements, our lounge and restaurant areas provide
                flexible alternatives ideal for creative sessions, casual business meetings, and
                private gatherings.
            </p>
            <a href="mailto:<?= e(HOTEL_EMAIL_EVENTS) ?>" class="btn btn-gold">Enquire — Events</a>
        </div>
    </div>
</section>

<section class="amenities-strip">
    <div class="section-head reveal">
        <span class="eyebrow light center with-after">Meeting Facilities</span>
        <h2 class="section-title">What's Included</h2>
    </div>
    <div class="container amenities-grid reveal">
        <?php
        $facilities = [
            ['Dedicated Meeting Room',    'Flexible seating arrangements'],
            ['Coffee Bar Setting',        'Informal meetings &amp; creative sessions'],
            ['Private Dining Space',      'Restaurant area for small gatherings'],
            ['Air Conditioning',          'Comfortable climate throughout'],
            ['High-Speed Internet',       'Smooth connectivity for every session'],
            ['Audiovisual Support',       'Modern AV available on request'],
            ['Event Planning Team',       'Dedicated support from start to finish'],
            ['Catering &amp; F&amp;B',          'Coffee breaks, lunches and dinners'],
        ];
        foreach ($facilities as $f): ?>
            <div class="amenity">
                <div class="amenity-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                </div>
                <h4><?= $f[0] ?></h4>
                <p><?= $f[1] ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="cta-strip">
    <div class="reveal">
        <span class="eyebrow light center with-after">Plan Your Event</span>
        <h2 class="section-title">Let's Make It Memorable</h2>
        <p>For enquiries and bookings, please contact our events team.</p>
        <a href="mailto:<?= e(HOTEL_EMAIL_EVENTS) ?>" class="btn btn-gold"><?= e(HOTEL_EMAIL_EVENTS) ?></a>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
