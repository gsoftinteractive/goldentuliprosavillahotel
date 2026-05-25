<?php
require_once __DIR__ . '/includes/functions.php';
$page_title = 'Rooms & Suites — ' . SITE_NAME;
$page_desc  = '47 elegantly furnished rooms and suites at Golden Tulip Rosa Villa Hotel Owerri.';
$rooms = get_rooms();
include __DIR__ . '/includes/header.php';
?>

<section class="page-hero" style="background-image:url('images/room-deluxe.jpg')">
    <div class="page-hero-content">
        <span class="eyebrow light center with-after">Accommodation</span>
        <h1>Rooms &amp; Suites</h1>
        <p>Styled comfort for inspired stays — 47 elegant rooms and suites thoughtfully designed for relaxation.</p>
    </div>
</section>

<section class="section rooms-section">
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
                    <p><?= e(mb_strimwidth($room['description'], 0, 160, '…')) ?></p>
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

<?php include __DIR__ . '/includes/footer.php'; ?>
