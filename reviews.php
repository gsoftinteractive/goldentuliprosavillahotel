<?php
require_once __DIR__ . '/includes/functions.php';

$submitted = false;
$errors    = [];
$old       = ['name' => '', 'email' => '', 'location' => '', 'rating' => 5, 'title' => '', 'comment' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old = array_merge($old, $_POST);

    foreach (['name', 'email', 'comment'] as $f) {
        if (empty(trim($_POST[$f] ?? ''))) {
            $errors[$f] = 'Required';
        }
    }
    if (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email';
    }
    $rating = (int)($_POST['rating'] ?? 5);
    if ($rating < 1 || $rating > 5) {
        $errors['rating'] = 'Choose a rating between 1 and 5';
    }
    if (mb_strlen($_POST['comment'] ?? '') < 20) {
        $errors['comment'] = 'Please share a few more words (at least 20 characters)';
    }

    if (!$errors) {
        $stmt = db()->prepare(
            'INSERT INTO reviews (name, email, location, rating, title, comment, approved) VALUES (?, ?, ?, ?, ?, ?, 0)'
        );
        $stmt->execute([
            trim($_POST['name']),
            trim($_POST['email']),
            trim($_POST['location'] ?? '') ?: null,
            $rating,
            trim($_POST['title'] ?? '') ?: null,
            trim($_POST['comment']),
        ]);
        $submitted = true;
        $old = ['name' => '', 'email' => '', 'location' => '', 'rating' => 5, 'title' => '', 'comment' => ''];
    }
}

// Fetch approved reviews
$reviews = db()->query(
    'SELECT name, location, rating, title, comment, created_at
     FROM reviews WHERE approved = 1 ORDER BY created_at DESC LIMIT 60'
)->fetchAll();

$totalApproved = count($reviews);
$averageRating = 0.0;
if ($totalApproved) {
    $sum = 0;
    foreach ($reviews as $r) $sum += (int)$r['rating'];
    $averageRating = round($sum / $totalApproved, 1);
}

function stars(int $rating): string {
    $rating = max(0, min(5, $rating));
    $out = '<span class="stars" aria-label="' . $rating . ' out of 5">';
    for ($i = 1; $i <= 5; $i++) {
        $out .= '<span class="star' . ($i <= $rating ? ' filled' : '') . '">&#9733;</span>';
    }
    $out .= '</span>';
    return $out;
}

$page_title = 'Guest Reviews — ' . SITE_NAME;
$page_desc  = 'Read what our guests have to say about Golden Tulip Rosa Villa Hotel Owerri — and share your own experience.';
include __DIR__ . '/includes/header.php';
?>

<section class="page-hero" style="background-image:url('images/reception.jpg')">
    <div class="page-hero-content">
        <span class="eyebrow light center with-after">Guest Reviews</span>
        <h1>What Our Guests Are Saying</h1>
        <p>Genuine words from the people who have stayed with us.</p>
    </div>
</section>

<?php if ($totalApproved): ?>
<section class="section reviews-summary-section">
    <div class="reviews-summary reveal">
        <div class="reviews-avg">
            <div class="reviews-avg-num"><?= e(number_format($averageRating, 1)) ?></div>
            <?= stars((int)round($averageRating)) ?>
            <div class="reviews-avg-count">Based on <?= $totalApproved ?> guest <?= $totalApproved === 1 ? 'review' : 'reviews' ?></div>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="section reviews-list-section" style="padding-top:0;">
    <div class="container">
        <?php if ($totalApproved === 0): ?>
            <p class="reviews-empty">No reviews yet — be the first to share your experience below.</p>
        <?php else: ?>
            <div class="reviews-grid">
                <?php foreach ($reviews as $r): ?>
                    <article class="review-card reveal">
                        <?= stars((int)$r['rating']) ?>
                        <?php if (!empty($r['title'])): ?>
                            <h3 class="review-title"><?= e($r['title']) ?></h3>
                        <?php endif; ?>
                        <p class="review-comment">&ldquo;<?= nl2br(e($r['comment'])) ?>&rdquo;</p>
                        <div class="review-meta">
                            <span class="review-author"><?= e($r['name']) ?></span>
                            <?php if (!empty($r['location'])): ?>
                                <span class="review-location"><?= e($r['location']) ?></span>
                            <?php endif; ?>
                            <span class="review-date"><?= e(date('F Y', strtotime($r['created_at']))) ?></span>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="section review-form-section">
    <div class="container narrow">
        <div class="reveal" style="text-align:center;margin-bottom:36px;">
            <span class="eyebrow with-after center">Share Your Stay</span>
            <h2 class="section-title">Leave a Review</h2>
            <p class="section-lede">We read every review. New submissions are moderated before they appear on this page.</p>
        </div>

        <div class="form-card reveal">
            <?php if ($submitted): ?>
                <div class="success-box">Thank you — your review has been received. It will appear here once approved.</div>
            <?php elseif ($errors): ?>
                <div class="error-box">Please correct the highlighted fields below.</div>
            <?php endif; ?>

            <form method="post" action="reviews.php#review-form" id="review-form">
                <div class="form-grid">
                    <div class="form-field">
                        <label for="name">Your Name</label>
                        <input id="name" name="name" type="text" value="<?= e($old['name']) ?>" required />
                        <?php if (!empty($errors['name'])): ?><div class="field-error"><?= e($errors['name']) ?></div><?php endif; ?>
                    </div>
                    <div class="form-field">
                        <label for="email">Email <span style="font-weight:400;color:var(--muted);">(not published)</span></label>
                        <input id="email" name="email" type="email" value="<?= e($old['email']) ?>" required />
                        <?php if (!empty($errors['email'])): ?><div class="field-error"><?= e($errors['email']) ?></div><?php endif; ?>
                    </div>
                    <div class="form-field">
                        <label for="location">Location (optional)</label>
                        <input id="location" name="location" type="text" value="<?= e($old['location']) ?>" placeholder="e.g. Lagos, Nigeria" />
                    </div>
                    <div class="form-field">
                        <label>Your Rating</label>
                        <div class="rating-input" role="radiogroup" aria-label="Rating">
                            <?php for ($i = 5; $i >= 1; $i--): ?>
                                <input type="radio" id="r<?= $i ?>" name="rating" value="<?= $i ?>" <?= (int)$old['rating'] === $i ? 'checked' : '' ?> />
                                <label for="r<?= $i ?>" aria-label="<?= $i ?> stars">&#9733;</label>
                            <?php endfor; ?>
                        </div>
                        <?php if (!empty($errors['rating'])): ?><div class="field-error"><?= e($errors['rating']) ?></div><?php endif; ?>
                    </div>
                    <div class="form-field full">
                        <label for="title">Headline (optional)</label>
                        <input id="title" name="title" type="text" value="<?= e($old['title']) ?>" placeholder="e.g. A serene escape in the heart of Owerri" />
                    </div>
                    <div class="form-field full">
                        <label for="comment">Your Review</label>
                        <textarea id="comment" name="comment" rows="5" required placeholder="Tell us about your stay..."><?= e($old['comment']) ?></textarea>
                        <?php if (!empty($errors['comment'])): ?><div class="field-error"><?= e($errors['comment']) ?></div><?php endif; ?>
                    </div>
                </div>
                <div style="margin-top:30px;text-align:right;">
                    <button type="submit" class="btn btn-gold">Submit Review</button>
                </div>
            </form>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
