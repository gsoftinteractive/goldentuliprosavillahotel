</main>

<footer class="site-footer">
    <div class="footer-grid">
        <div class="footer-col">
            <div class="footer-brand">
                <img src="images/logo.jpeg" class="logo-mark logo-mark--footer" alt="Golden Tulip Rosa Villa Hotel" />
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
            <a href="gallery.php">Gallery</a>
            <a href="reviews.php">Guest Reviews</a>
            <a href="about.php">About Us</a>
        </div>

        <div class="footer-col">
            <h4>Reservations</h4>
            <a href="booking.php">Book a Room</a>
            <a href="mailto:<?= e(HOTEL_EMAIL_RES) ?>"><?= e(HOTEL_EMAIL_RES) ?></a>
            <a href="https://wa.me/<?= e(HOTEL_WHATSAPP) ?>" target="_blank" rel="noopener" class="ft-line ft-line--wa">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M.057 24l1.687-6.163a11.867 11.867 0 0 1-1.587-5.946C.16 5.335 5.495 0 12.05 0a11.817 11.817 0 0 1 8.413 3.488 11.824 11.824 0 0 1 3.48 8.414c-.003 6.557-5.338 11.892-11.893 11.892a11.9 11.9 0 0 1-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                <span><span class="ft-label">WhatsApp / Reservations</span><?= e(HOTEL_PHONE_1) ?></span>
            </a>
            <a href="tel:<?= e(HOTEL_PHONE_2) ?>" class="ft-line">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.37 1.9.72 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.35 1.85.59 2.81.72A2 2 0 0 1 22 16.92z"/></svg>
                <span><span class="ft-label">Front Desk</span><?= e(HOTEL_PHONE_2) ?></span>
            </a>
        </div>

        <div class="footer-col">
            <h4>Visit Us</h4>
            <p class="footer-addr"><strong>Owerri</strong><br><?= e(HOTEL_ADDRESS_OW) ?></p>
            <p class="footer-addr"><strong>Port Harcourt</strong><br><?= e(HOTEL_ADDRESS_PH) ?></p>
        </div>
    </div>

    <div class="footer-bottom">
        <div>
            <div>&copy; <?= date('Y') ?> Golden Tulip Rosa Villa Hotel. All rights reserved.</div>
            <div class="footer-credit">Designed by <a href="https://gsoftinteractive.com" target="_blank" rel="noopener">Gsoft Interactive</a></div>
        </div>
        <div class="footer-bottom-links">
            <a href="#">Privacy</a>
            <a href="#">Terms</a>
        </div>
    </div>
</footer>

<script src="assets/js/main.js?v=2"></script>
</body>
</html>
