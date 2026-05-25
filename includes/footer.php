</main>

<footer class="site-footer">
    <div class="footer-grid">
        <div class="footer-col">
            <div class="footer-brand">
                <span class="logo-mark light">GT</span>
                <div>
                    <div class="footer-brand-primary">Golden Tulip</div>
                    <div class="footer-brand-secondary">Rosa Villa Hotel</div>
                </div>
            </div>
            <p class="footer-blurb">Where timeless elegance meets modern comfort. A premium hospitality destination in the serene Achike Udenwa Estate, Owerri.</p>
            <div class="socials">
                <a href="#" aria-label="Instagram"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg></a>
                <a href="#" aria-label="Facebook"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
                <a href="#" aria-label="Twitter"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg></a>
            </div>
        </div>

        <div class="footer-col">
            <h4>Explore</h4>
            <a href="index.php">Home</a>
            <a href="rooms.php">Rooms &amp; Suites</a>
            <a href="dining.php">Dining</a>
            <a href="amenities.php">Amenities</a>
            <a href="meetings.php">Meetings &amp; Events</a>
            <a href="about.php">About Us</a>
        </div>

        <div class="footer-col">
            <h4>Reservations</h4>
            <a href="booking.php">Book a Room</a>
            <a href="mailto:<?= e(HOTEL_EMAIL_RES) ?>"><?= e(HOTEL_EMAIL_RES) ?></a>
            <a href="tel:<?= e(HOTEL_PHONE_1) ?>"><?= e(HOTEL_PHONE_1) ?></a>
            <a href="tel:<?= e(HOTEL_PHONE_2) ?>"><?= e(HOTEL_PHONE_2) ?></a>
        </div>

        <div class="footer-col">
            <h4>Visit Us</h4>
            <p class="footer-addr"><strong>Owerri</strong><br><?= e(HOTEL_ADDRESS_OW) ?></p>
            <p class="footer-addr"><strong>Port Harcourt</strong><br><?= e(HOTEL_ADDRESS_PH) ?></p>
        </div>
    </div>

    <div class="footer-bottom">
        <div>&copy; <?= date('Y') ?> Golden Tulip Rosa Villa Hotel. All rights reserved.</div>
        <div class="footer-bottom-links">
            <a href="#">Privacy</a>
            <a href="#">Terms</a>
        </div>
    </div>
</footer>

<script src="assets/js/main.js?v=1"></script>
</body>
</html>
