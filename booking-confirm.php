<?php
require_once __DIR__ . '/includes/functions.php';

$ref = $_GET['ref'] ?? '';
$booking = null;
if ($ref) {
    $stmt = db()->prepare(
        'SELECT b.*, r.name AS room_name, r.image AS room_image
         FROM bookings b JOIN rooms r ON r.id = b.room_id
         WHERE b.reference = ? LIMIT 1');
    $stmt->execute([$ref]);
    $booking = $stmt->fetch();
}

if (!$booking) {
    header('Location: booking.php');
    exit;
}

$page_title = 'Reservation Confirmed — ' . SITE_NAME;
include __DIR__ . '/includes/header.php';
?>

<section class="page-hero" style="background-image:url('images/exterior-aerial-sunset.jpg'); min-height:380px;">
    <div class="page-hero-content">
        <span class="eyebrow light center with-after">Thank You</span>
        <h1>Reservation Received</h1>
        <p>We look forward to welcoming you to Golden Tulip Rosa Villa Hotel Owerri.</p>
    </div>
</section>

<section class="section">
    <div class="confirm-card reveal">
        <div class="confirm-icon">
            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <polyline points="20 6 9 17 4 12" />
            </svg>
        </div>

        <span class="eyebrow center with-after">Dear <?= e($booking['guest_first_name']) ?></span>
        <h2 style="margin:14px 0 12px;">Your reservation is reserved</h2>
        <p style="color:var(--grey);">A confirmation has been logged in our system. Please complete your bank transfer using the details below to confirm your stay.</p>

        <div class="confirm-ref"><?= e($booking['reference']) ?></div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;text-align:left;margin:30px 0;">
            <div><strong style="color:var(--gold-deep);font-size:11px;letter-spacing:2px;text-transform:uppercase;">Room</strong><br><?= e($booking['room_name']) ?></div>
            <div><strong style="color:var(--gold-deep);font-size:11px;letter-spacing:2px;text-transform:uppercase;">Guest</strong><br><?= e($booking['guest_first_name'] . ' ' . $booking['guest_last_name']) ?></div>
            <div><strong style="color:var(--gold-deep);font-size:11px;letter-spacing:2px;text-transform:uppercase;">Check-In</strong><br><?= e(date('D, d M Y', strtotime($booking['check_in']))) ?></div>
            <div><strong style="color:var(--gold-deep);font-size:11px;letter-spacing:2px;text-transform:uppercase;">Check-Out</strong><br><?= e(date('D, d M Y', strtotime($booking['check_out']))) ?></div>
            <div><strong style="color:var(--gold-deep);font-size:11px;letter-spacing:2px;text-transform:uppercase;">Nights</strong><br><?= (int)$booking['nights'] ?></div>
            <div><strong style="color:var(--gold-deep);font-size:11px;letter-spacing:2px;text-transform:uppercase;">Guests</strong><br><?= (int)$booking['adults'] ?> Adults<?= (int)$booking['children'] > 0 ? ', ' . (int)$booking['children'] . ' Children' : '' ?></div>
        </div>

        <div class="bank-box">
            <h4>Bank Transfer Details</h4>
            <div class="bank-row"><span class="lbl">Bank</span><span class="val"><?= e(BANK_NAME) ?></span></div>
            <div class="bank-row"><span class="lbl">Account Name</span><span class="val"><?= e(BANK_ACCOUNT_NAME) ?></span></div>
            <div class="bank-row"><span class="lbl">Account Number</span><span class="val"><?= e(BANK_ACCOUNT_NO) ?></span></div>
            <div class="bank-row" style="margin-top:14px;padding-top:14px;border-top:1px solid var(--grey-light);">
                <span class="lbl">Amount Due</span>
                <span class="val" style="font-family:var(--serif);font-size:22px;color:var(--gold-deep);"><?= naira((float)$booking['total_amount']) ?></span>
            </div>
            <div class="bank-row">
                <span class="lbl">Reference</span>
                <span class="val"><?= e($booking['reference']) ?></span>
            </div>
        </div>

        <p style="font-size:13px;color:var(--grey);margin-top:20px;">
            After completing your transfer, please email proof of payment to
            <a href="mailto:<?= e(HOTEL_EMAIL_RES) ?>" style="color:var(--gold-deep);"><?= e(HOTEL_EMAIL_RES) ?></a>
            quoting reference <strong><?= e($booking['reference']) ?></strong>.
            Your reservation will be confirmed once payment is verified.
        </p>

        <div style="margin-top:30px;display:flex;gap:14px;justify-content:center;flex-wrap:wrap;">
            <a href="index.php" class="btn btn-outline">Back to Home</a>
            <a href="contact.php" class="btn btn-gold">Contact Reservations</a>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
