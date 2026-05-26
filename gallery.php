<?php
require_once __DIR__ . '/includes/functions.php';
$page_title = 'Gallery — ' . SITE_NAME;
$page_desc  = 'Step inside Golden Tulip Rosa Villa Hotel Owerri — explore our rooms, dining, amenities and grounds in photos.';

$gallery = [
    ['file' => 'exterior-aerial-sunset.jpg', 'cat' => 'exterior',  'caption' => 'The hotel at golden hour'],
    ['file' => 'exterior-front.jpg',         'cat' => 'exterior',  'caption' => 'Front entrance'],
    ['file' => 'exterior-front-night.jpg',   'cat' => 'exterior',  'caption' => 'Evening facade'],
    ['file' => 'exterior-courtyard.jpg',     'cat' => 'exterior',  'caption' => 'Courtyard and gardens'],
    ['file' => 'reception.jpg',              'cat' => 'interior',  'caption' => 'Reception &amp; lobby'],
    ['file' => 'chandelier.jpg',             'cat' => 'interior',  'caption' => 'Lobby chandelier'],
    ['file' => 'staircase.jpg',              'cat' => 'interior',  'caption' => 'Grand staircase'],
    ['file' => 'room-classic.jpg',           'cat' => 'rooms',     'caption' => 'Classic Room'],
    ['file' => 'room-superior.jpg',          'cat' => 'rooms',     'caption' => 'Superior Room'],
    ['file' => 'room-deluxe.jpg',            'cat' => 'rooms',     'caption' => 'Deluxe Room'],
    ['file' => 'suite-living.jpg',           'cat' => 'rooms',     'caption' => 'Executive Suite — living area'],
    ['file' => 'bathroom.jpg',               'cat' => 'rooms',     'caption' => 'En-suite bathroom'],
    ['file' => 'restaurant.jpg',             'cat' => 'dining',    'caption' => 'Ikedu Restaurant'],
    ['file' => 'bush-bar.jpg',               'cat' => 'dining',    'caption' => 'Bush Bar &amp; Choby Lounge'],
    ['file' => 'pool.jpg',                   'cat' => 'amenities', 'caption' => 'Swimming pool'],
    ['file' => 'gym.jpg',                    'cat' => 'amenities', 'caption' => 'Fitness centre'],
];

$categories = [
    'all'       => 'All',
    'exterior'  => 'Exterior',
    'rooms'     => 'Rooms',
    'dining'    => 'Dining',
    'amenities' => 'Amenities',
    'interior'  => 'Interior',
];

include __DIR__ . '/includes/header.php';
?>

<section class="page-hero" style="background-image:url('images/exterior-courtyard.jpg')">
    <div class="page-hero-content">
        <span class="eyebrow light center with-after">Photo Gallery</span>
        <h1>Inside Golden Tulip Rosa Villa</h1>
        <p>Every angle of the experience that awaits you in Owerri.</p>
    </div>
</section>

<section class="section gallery-section">
    <div class="narrow reveal" style="text-align:center;">
        <span class="eyebrow with-after center">Explore</span>
        <h2 class="section-title">A Visual Tour</h2>
        <p class="section-lede">From the architecture and grounds to the rooms, dining and leisure spaces — browse a curated look at the hotel.</p>
    </div>

    <div class="gallery-filters" role="tablist">
        <?php foreach ($categories as $key => $label): ?>
            <button type="button" class="gallery-filter<?= $key === 'all' ? ' active' : '' ?>" data-filter="<?= e($key) ?>"><?= e($label) ?></button>
        <?php endforeach; ?>
    </div>

    <div class="gallery-grid" id="galleryGrid">
        <?php foreach ($gallery as $i => $item): ?>
            <a href="images/<?= e($item['file']) ?>"
               class="gallery-item reveal"
               data-cat="<?= e($item['cat']) ?>"
               data-index="<?= $i ?>"
               aria-label="<?= e(strip_tags($item['caption'])) ?>">
                <img src="images/<?= e($item['file']) ?>" alt="<?= e(strip_tags($item['caption'])) ?>" loading="lazy" />
                <span class="gallery-caption"><?= $item['caption'] ?></span>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<!-- Lightbox overlay -->
<div class="lightbox" id="lightbox" aria-hidden="true" role="dialog">
    <button class="lightbox-close" aria-label="Close">&times;</button>
    <button class="lightbox-prev" aria-label="Previous image">&#10094;</button>
    <button class="lightbox-next" aria-label="Next image">&#10095;</button>
    <figure class="lightbox-figure">
        <img class="lightbox-img" src="" alt="" />
        <figcaption class="lightbox-caption"></figcaption>
    </figure>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
