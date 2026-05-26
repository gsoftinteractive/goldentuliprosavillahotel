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
                <p><a href="https://wa.me/<?= e(HOTEL_WHATSAPP) ?>" target="_blank" rel="noopener" class="contact-wa">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" style="vertical-align:-2px;margin-right:6px;color:#25D366"><path d="M.057 24l1.687-6.163a11.867 11.867 0 0 1-1.587-5.946C.16 5.335 5.495 0 12.05 0a11.817 11.817 0 0 1 8.413 3.488 11.824 11.824 0 0 1 3.48 8.414c-.003 6.557-5.338 11.892-11.893 11.892a11.9 11.9 0 0 1-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                    <?= e(HOTEL_PHONE_1) ?> <span class="contact-line-label">WhatsApp / Reservations</span>
                </a></p>
                <p><a href="tel:<?= e(HOTEL_PHONE_2) ?>"><?= e(HOTEL_PHONE_2) ?> <span class="contact-line-label">Front Desk</span></a></p>
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
