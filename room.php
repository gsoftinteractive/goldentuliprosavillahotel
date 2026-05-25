<?php
require_once __DIR__ . '/includes/functions.php';

$slug = $_GET['slug'] ?? '';
$room = $slug ? get_room_by_slug($slug) : null;

if (!$room) {
    header('Location: rooms.php');
    exit;
}

$page_title = $room['name'] . ' — ' . SITE_NAME;
$page_desc  = $room['tagline'];
$highlights = split_pipe($room['highlights']);
$ideal_for  = split_pipe($room['ideal_for']);

include __DIR__ . '/includes/header.php';
?>

<section class="page-hero" style="background-image:url('images/<?= e($room['image']) ?>')">
    <div class="page-hero-content">
        <span class="eyebrow light center with-after">Accommodation</span>
        <h1><?= e($room['name']) ?></h1>
        <p><?= e($room['tagline']) ?></p>
    </div>
</section>

<section class="room-detail">
    <div class="container room-detail-grid">
        <div class="room-detail-image reveal">
            <img src="images/<?= e($room['image']) ?>" alt="<?= e($room['name']) ?>" />
        </div>
        <div class="room-detail-info reveal">
            <span class="room-detail-tag"><?= e($room['tagline']) ?></span>
            <h1 style="font-size:clamp(1.8rem, 3.5vw, 2.6rem)"><?= e($room['name']) ?></h1>

            <div class="room-detail-meta">
                <span>↔ <?= (int)$room['size_sqm'] ?> sqm</span>
                <span>♛ <?= e($room['bed_type']) ?></span>
                <span>☻ Up to <?= (int)$room['max_guests'] ?> guests</span>
            </div>

            <p style="color:var(--grey)"><?= e($room['description']) ?></p>

            <div class="room-price">
                <?= naira((float)$room['price_ngn']) ?>
                <small>per night</small>
            </div>

            <a href="booking.php?room_id=<?= (int)$room['id'] ?>" class="btn btn-gold">Book This Room</a>

            <div class="room-features">
                <h3>Room Highlights</h3>
                <ul>
                    <?php foreach ($highlights as $h): ?>
                        <li><?= e($h) ?></li>
                    <?php endforeach; ?>
                </ul>

                <h3>Ideal For</h3>
                <ul>
                    <?php foreach ($ideal_for as $i): ?>
                        <li><?= e($i) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
