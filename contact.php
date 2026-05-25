<?php
require_once __DIR__ . '/includes/functions.php';

$success = false;
$errors  = [];
$old     = ['full_name'=>'','email'=>'','phone'=>'','subject'=>'','message'=>''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old = array_merge($old, $_POST);
    foreach (['full_name','email','subject','message'] as $f) {
        if (empty($_POST[$f])) $errors[$f] = 'Required';
    }
    if (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email';
    }
    if (!$errors) {
        $stmt = db()->prepare('INSERT INTO enquiries (full_name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([
            trim($_POST['full_name']),
            trim($_POST['email']),
            trim($_POST['phone'] ?? ''),
            trim($_POST['subject']),
            trim($_POST['message']),
        ]);
        $success = true;
        $old = ['full_name'=>'','email'=>'','phone'=>'','subject'=>'','message'=>''];
    }
}

$page_title = 'Contact — ' . SITE_NAME;
include __DIR__ . '/includes/header.php';
?>

<section class="page-hero" style="background-image:url('images/exterior-front.jpg')">
    <div class="page-hero-content">
        <span class="eyebrow light center with-after">Get In Touch</span>
        <h1>Contact Us</h1>
        <p>We're here to assist — reservations, enquiries, events, and more.</p>
    </div>
</section>

<section class="section">
    <div class="container contact-grid">
        <div class="reveal">
            <span class="eyebrow with-after">Reach Us</span>
            <h2 style="margin:14px 0 24px;">We'd Love to Hear From You</h2>

            <div class="contact-info-block">
                <h4>Reservations</h4>
                <p><a href="mailto:<?= e(HOTEL_EMAIL_RES) ?>"><?= e(HOTEL_EMAIL_RES) ?></a></p>
                <p><a href="tel:<?= e(HOTEL_PHONE_1) ?>"><?= e(HOTEL_PHONE_1) ?></a></p>
                <p><a href="tel:<?= e(HOTEL_PHONE_2) ?>"><?= e(HOTEL_PHONE_2) ?></a></p>
            </div>

            <div class="contact-info-block">
                <h4>General Enquiries</h4>
                <p><a href="mailto:<?= e(HOTEL_EMAIL_INFO) ?>"><?= e(HOTEL_EMAIL_INFO) ?></a></p>
            </div>

            <div class="contact-info-block">
                <h4>Meetings &amp; Events</h4>
                <p><a href="mailto:<?= e(HOTEL_EMAIL_EVENTS) ?>"><?= e(HOTEL_EMAIL_EVENTS) ?></a></p>
            </div>

            <div class="contact-info-block">
                <h4>Owerri (Hotel)</h4>
                <p><?= e(HOTEL_ADDRESS_OW) ?></p>
            </div>

            <div class="contact-info-block">
                <h4>Port Harcourt (Office)</h4>
                <p><?= e(HOTEL_ADDRESS_PH) ?></p>
            </div>
        </div>

        <div class="reveal">
            <div class="form-card">
                <?php if ($success): ?>
                    <div class="success-box">Thank you — your message has been received. We'll be in touch shortly.</div>
                <?php elseif ($errors): ?>
                    <div class="error-box">Please correct the highlighted fields below.</div>
                <?php endif; ?>

                <form method="post" action="contact.php">
                    <div class="form-grid">
                        <div class="form-field">
                            <label for="full_name">Full Name</label>
                            <input id="full_name" name="full_name" type="text" value="<?= e($old['full_name']) ?>" required />
                            <?php if (!empty($errors['full_name'])): ?><div class="field-error"><?= e($errors['full_name']) ?></div><?php endif; ?>
                        </div>
                        <div class="form-field">
                            <label for="email">Email</label>
                            <input id="email" name="email" type="email" value="<?= e($old['email']) ?>" required />
                            <?php if (!empty($errors['email'])): ?><div class="field-error"><?= e($errors['email']) ?></div><?php endif; ?>
                        </div>
                        <div class="form-field">
                            <label for="phone">Phone (optional)</label>
                            <input id="phone" name="phone" type="tel" value="<?= e($old['phone']) ?>" />
                        </div>
                        <div class="form-field">
                            <label for="subject">Subject</label>
                            <input id="subject" name="subject" type="text" value="<?= e($old['subject']) ?>" required />
                            <?php if (!empty($errors['subject'])): ?><div class="field-error"><?= e($errors['subject']) ?></div><?php endif; ?>
                        </div>
                        <div class="form-field full">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" required><?= e($old['message']) ?></textarea>
                            <?php if (!empty($errors['message'])): ?><div class="field-error"><?= e($errors['message']) ?></div><?php endif; ?>
                        </div>
                    </div>
                    <div style="margin-top:30px;text-align:right;">
                        <button type="submit" class="btn btn-gold">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
