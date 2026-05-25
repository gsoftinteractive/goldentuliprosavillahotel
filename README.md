# Golden Tulip Rosa Villa Hotel

> _Luxury, Comfort & Serenity in the Heart of Owerri_

The official marketing & booking website for **Golden Tulip Rosa Villa Hotel Owerri** — a premium hospitality destination in the serene Achike Udenwa Estate, Imo State, Nigeria. Part of the globally recognized Golden Tulip Hotels & Resorts brand.

Built with vanilla PHP and MySQL — fast, dependency-free, and easy to deploy anywhere PHP runs.

---

## Features

- **Cinematic landing page** — 4-slide auto-rotating hero carousel with the hotel's signature aerial sunset shot
- **Sticky quick-booking bar** at the bottom of the hero — check-in/out, guests, room type, one click to availability
- **Four room categories** — Classic, Superior, Deluxe, and Executive Suite, each with their own detail page and gallery
- **Seamless booking flow** — live total calculation, date-range validation, instant reservation reference
- **Bank-transfer checkout** — confirmation page shows transfer details, amount due, and a quoted reference number
- **Contact form** with enquiry persistence
- **Five-star aesthetic** — Cormorant Garamond + Montserrat, gold-on-cream palette, scroll-reveal animations
- **Mobile-first responsive** — collapses to a single-column layout with off-canvas nav under 768px
- **No build step** — drop on any PHP-capable server and go

---

## Tech Stack

| Layer    | Tech                                 |
|----------|--------------------------------------|
| Frontend | HTML5, CSS3 (custom design system), vanilla JS |
| Backend  | PHP 8 (PDO, no framework)            |
| Database | MySQL 8                              |
| Fonts    | Cormorant Garamond, Montserrat (Google Fonts) |
| Local dev| Laravel Herd (Apache + PHP + MySQL)  |

No Composer, no npm — just PHP and MySQL.

---

## Local Setup

### Requirements
- [Laravel Herd](https://herd.laravel.com) (or any PHP 8+ + MySQL stack)
- MySQL 8 (Herd Pro ships it)

### Steps

1. **Clone**
   ```bash
   git clone https://github.com/gsoftinteractive/goldentuliprosavillahotel.git
   cd goldentuliprosavillahotel
   ```

2. **Drop the folder into Herd's parked path** (or run from any PHP-capable web root).

3. **Import the database**
   ```bash
   mysql -u root -h 127.0.0.1 < sql/schema.sql
   ```
   This creates `gt_rosavilla` with 4 tables (`rooms`, `bookings`, `enquiries`, `subscribers`) and seeds the 4 room categories.

4. **Configure** — edit [config/config.php](config/config.php) if your DB user/password differs from `root`/empty.

5. **Open** — `http://goldentuliprosavillahotel.test`

---

## Project Structure

```
.
├── index.php             # Landing page — hero carousel + booking bar
├── rooms.php             # All rooms grid
├── room.php              # Single room (slug-based)
├── booking.php           # Booking form with live summary
├── booking-confirm.php   # Reservation receipt + bank transfer details
├── dining.php            # Restaurants & bars
├── amenities.php         # Facilities & leisure
├── meetings.php          # Events & business
├── about.php             # Hotel story & location
├── contact.php           # Enquiry form
│
├── config/
│   ├── config.php        # Site + DB + bank constants
│   └── db.php            # PDO singleton with friendly error page
│
├── includes/
│   ├── header.php        # Topbar + sticky nav
│   ├── footer.php        # Footer with socials + addresses
│   └── functions.php     # Shared helpers (naira format, room loader, validation)
│
├── assets/
│   ├── css/style.css     # Full design system
│   └── js/main.js        # Carousel, nav, scroll reveal, booking summary
│
├── images/               # All site photography (sensibly named)
├── sql/schema.sql        # Schema + seed
└── .htaccess             # Apache config (security, caching, compression)
```

---

## Customisation

### Update bank transfer details
Edit the constants in [config/config.php](config/config.php):
```php
define('BANK_NAME',         'Zenith Bank');
define('BANK_ACCOUNT_NAME', 'Golden Tulip Rosa Villa Hotel Ltd');
define('BANK_ACCOUNT_NO',   '1234567890');
```

### Adjust room prices
Run an `UPDATE` against the `rooms` table:
```sql
UPDATE rooms SET price_ngn = 75000 WHERE slug = 'classic';
```
Or edit the `INSERT` in [sql/schema.sql](sql/schema.sql) and re-import.

### Hotel contact info
All addresses, phones, and emails are constants near the top of [config/config.php](config/config.php).

---

## Production Deployment

1. **Clone** on the server into your web root.
2. **Set DB credentials via environment variables** (preferred) — `config.php` reads `DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME` from `getenv()` and falls back to local defaults.
3. **Import schema** — `mysql -u <user> -p <dbname> < sql/schema.sql`.
4. Ensure Apache has `mod_rewrite`, `mod_deflate`, `mod_expires` enabled (the bundled `.htaccess` uses them).
5. Point your domain to the folder. **No PHP framework, no build step, no migrations beyond the SQL file.**

When `HTTP_HOST` is not local, the error display is auto-suppressed.

---

## Database Schema (quick reference)

| Table         | Purpose                                              |
|---------------|------------------------------------------------------|
| `rooms`       | Catalogue — slug, name, price, photo, highlights     |
| `bookings`    | Reservations with reference, dates, total, payment status |
| `enquiries`   | Contact form submissions                             |
| `subscribers` | Newsletter sign-ups                                  |

Every booking gets a unique `GTRV-XXXXXXXX` reference for guests to quote on their bank transfer.

---

## Hotel Contact

- **Owerri (Hotel):** Plot 5 Achike Udenwa Estate, New Owerri, Imo State
- **Port Harcourt (Office):** 152 Tombia Street, GRA Phase 2, Port Harcourt, Rivers State
- **Reservations:** reservations@goldentuliprosavillahotel.com · +234 913 958 6398
- **Events:** events@goldentuliprosavillahotel.com

---

_Welcome to Luxury, Comfort, and Serenity in the Heart of Owerri._
