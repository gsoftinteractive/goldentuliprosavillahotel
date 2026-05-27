<?php
require_once __DIR__ . '/includes/functions.php';

$errors    = [];
$success   = false;
$reference = '';

// Pre-fill from query string
$prefill = [
    'room_id'   => (int)($_GET['room_id']  ?? 0),
    'check_in'  => $_GET['check_in']  ?? '',
    'check_out' => $_GET['check_out'] ?? '',
    'adults'    => (int)($_GET['adults']   ?? 2),
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $p = $_POST;
    $v = validate_booking($p);
    if (!$v['ok']) {
        $errors = $v['errors'];
        $prefill = array_merge($prefill, $p);
    } else {
        $room = get_room_by_id((int)$p['room_id']);
        if (!$room) {
            $errors['room_id'] = 'Selected room not available.';
        } else {
            $nights    = nights_between($p['check_in'], $p['check_out']);
            $total     = $nights * (float)$room['price_ngn'];
            $reference = gen_reference();

            $stmt = db()->prepare(
                'INSERT INTO bookings
                (reference, room_id, guest_first_name, guest_last_name, guest_email, guest_phone, guest_country,
                 check_in, check_out, nights, adults, children, total_amount, special_requests,
                 payment_method, payment_status, booking_status)
                VALUES
                (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, "bank_transfer", "pending", "reserved")');
            $stmt->execute([
                $reference,
                (int)$room['id'],
                trim($p['first_name']),
                trim($p['last_name']),
                trim($p['email']),
                trim($p['phone']),
                trim($p['country'] ?? ''),
                $p['check_in'],
                $p['check_out'],
                $nights,
                (int)$p['adults'],
                (int)($p['children'] ?? 0),
                $total,
                trim($p['special_requests'] ?? ''),
            ]);

            header('Location: booking-confirm.php?ref=' . urlencode($reference));
            exit;
        }
        $prefill = array_merge($prefill, $p);
    }
}

$rooms        = get_rooms();
$selected_room = null;
if (!empty($prefill['room_id'])) {
    $selected_room = get_room_by_id((int)$prefill['room_id']);
}
if (!$selected_room && $rooms) $selected_room = $rooms[0];

$page_title = 'Book Your Stay — ' . SITE_NAME;
$page_desc  = 'Reserve your stay at Golden Tulip Rosa Villa Hotel Owerri.';
include __DIR__ . '/includes/header.php';
?>

<section class="page-hero" style="background-image:url('images/exterior-front-night.jpg')">
    <div class="page-hero-content">
        <span class="eyebrow light center with-after">Reservations</span>
        <h1>Book Your Stay</h1>
        <p>Reserve directly with us for the best available rates and personalized service.</p>
    </div>
</section>

<section class="section">
    <div class="container booking-page-grid">
        <div class="reveal">
            <?php if ($errors): ?>
                <div class="error-box">Please correct the highlighted fields below.</div>
            <?php endif; ?>

            <div class="form-card">
                <form id="bookingForm" method="post" action="booking.php" data-price="<?= e((string)($selected_room['price_ngn'] ?? 0)) ?>">

                    <h3 style="font-family:var(--sans);font-size:12px;letter-spacing:3px;text-transform:uppercase;color:var(--gold-deep);margin-bottom:24px;">Stay Details</h3>

                    <div class="form-grid">
                        <div class="form-field full">
                            <label for="room_id">Room Selection</label>
                            <select id="room_id" name="room_id" data-summary-trigger onchange="document.getElementById('bookingForm').dataset.price = this.options[this.selectedIndex].dataset.price || 0; recalcSummary();" required>
                                <?php foreach ($rooms as $r): ?>
                                    <option value="<?= (int)$r['id'] ?>"
                                            data-price="<?= e((string)$r['price_ngn']) ?>"
                                            <?= ((int)($prefill['room_id'] ?? 0) === (int)$r['id']) ? 'selected' : '' ?>>
                                        <?= e($r['name']) ?> — <?= naira((float)$r['price_ngn']) ?> / night
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (!empty($errors['room_id'])): ?><div class="field-error"><?= e($errors['room_id']) ?></div><?php endif; ?>
                        </div>

                        <div class="form-field">
                            <label for="check_in">Check-In</label>
                            <input id="check_in" type="date" name="check_in" value="<?= e($prefill['check_in'] ?? '') ?>" data-role="check-in" data-pair="book" data-summary-trigger required />
                            <?php if (!empty($errors['check_in'])): ?><div class="field-error"><?= e($errors['check_in']) ?></div><?php endif; ?>
                        </div>
                        <div class="form-field">
                            <label for="check_out">Check-Out</label>
                            <input id="check_out" type="date" name="check_out" value="<?= e($prefill['check_out'] ?? '') ?>" data-role="check-out" data-pair="book" data-summary-trigger required />
                            <?php if (!empty($errors['check_out'])): ?><div class="field-error"><?= e($errors['check_out']) ?></div><?php endif; ?>
                        </div>

                        <div class="form-field">
                            <label for="adults">Adults</label>
                            <select id="adults" name="adults" required>
                                <?php for ($i = 1; $i <= 6; $i++): ?>
                                    <option value="<?= $i ?>" <?= ((int)($prefill['adults'] ?? 2) === $i) ? 'selected' : '' ?>><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="form-field">
                            <label for="children">Children</label>
                            <select id="children" name="children">
                                <?php for ($i = 0; $i <= 4; $i++): ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>

                    <h3 style="font-family:var(--sans);font-size:12px;letter-spacing:3px;text-transform:uppercase;color:var(--gold-deep);margin:40px 0 24px;">Guest Information</h3>

                    <div class="form-grid">
                        <div class="form-field">
                            <label for="first_name">First Name</label>
                            <input id="first_name" name="first_name" type="text" value="<?= e($prefill['first_name'] ?? '') ?>" required />
                            <?php if (!empty($errors['first_name'])): ?><div class="field-error"><?= e($errors['first_name']) ?></div><?php endif; ?>
                        </div>
                        <div class="form-field">
                            <label for="last_name">Last Name</label>
                            <input id="last_name" name="last_name" type="text" value="<?= e($prefill['last_name'] ?? '') ?>" required />
                            <?php if (!empty($errors['last_name'])): ?><div class="field-error"><?= e($errors['last_name']) ?></div><?php endif; ?>
                        </div>
                        <div class="form-field">
                            <label for="email">Email</label>
                            <input id="email" name="email" type="email" value="<?= e($prefill['email'] ?? '') ?>" required />
                            <?php if (!empty($errors['email'])): ?><div class="field-error"><?= e($errors['email']) ?></div><?php endif; ?>
                        </div>
                        <div class="form-field">
                            <label for="phone">Phone</label>
                            <input id="phone" name="phone" type="tel" value="<?= e($prefill['phone'] ?? '') ?>" required />
                            <?php if (!empty($errors['phone'])): ?><div class="field-error"><?= e($errors['phone']) ?></div><?php endif; ?>
                        </div>
                        <div class="form-field full">
                            <label for="country">Country (optional)</label>
                            <input id="country" name="country" type="text" value="<?= e($prefill['country'] ?? '') ?>" />
                        </div>
                        <div class="form-field full">
                            <label for="special_requests">Special Requests (optional)</label>
                            <textarea id="special_requests" name="special_requests"><?= e($prefill['special_requests'] ?? '') ?></textarea>
                        </div>
                    </div>

                    <input type="hidden" name="nights" value="0" />
                    <input type="hidden" name="total_amount" value="0" />

                    <div style="margin-top:36px;display:flex;justify-content:flex-end;gap:14px;">
                        <a href="rooms.php" class="btn btn-outline">Back to Rooms</a>
                        <button type="submit" class="btn btn-gold">Reserve Now</button>
                    </div>
                </form>
            </div>
        </div>

        <aside class="reveal">
            <div class="booking-summary">
                <h3>Booking Summary</h3>
                <div class="summary-row"><span class="label">Room</span><span><?= e($selected_room['name'] ?? '—') ?></span></div>
                <div class="summary-row"><span class="label">Rate</span><span data-sum="rate"><?= naira((float)($selected_room['price_ngn'] ?? 0)) ?></span></div>
                <div class="summary-row"><span class="label">Nights</span><span data-sum="nights">0 nights</span></div>
                <div class="summary-row"><span class="label">Subtotal</span><span data-sum="subtotal">₦0</span></div>
                <div class="summary-total"><span class="label">Total</span><span class="value" data-sum="total">₦0</span></div>

                <div style="margin-top:30px;font-size:12px;color:rgba(246,241,231,0.55);line-height:1.7;letter-spacing:0.5px;">
                    <strong style="color:var(--gold-light);display:block;margin-bottom:6px;letter-spacing:2px;text-transform:uppercase;font-size:10px;">Payment Method</strong>
                    Bank transfer. After reservation, you will receive our bank details to complete your payment.
                </div>
                <div style="margin-top:24px;font-size:12px;color:rgba(246,241,231,0.55);line-height:1.7;">
                    <strong style="color:var(--gold-light);display:block;margin-bottom:6px;letter-spacing:2px;text-transform:uppercase;font-size:10px;">Check-In / Out</strong>
                    Check-in from 2:00 PM &middot; Check-out by 12:00 PM
                </div>
            </div>
        </aside>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
