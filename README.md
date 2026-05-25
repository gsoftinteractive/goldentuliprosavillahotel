# Golden Tulip Rosa Villa Hotel

Marketing & booking website for Golden Tulip Rosa Villa Hotel Owerri.

**Stack:** HTML · CSS · PHP (vanilla, PDO) · MySQL

## Local Setup (Laravel Herd)

1. **Database** — start MySQL (Herd Pro ships it) and import the schema:
   ```bash
   mysql -u root -p < sql/schema.sql
   ```

2. **Configuration** — update `config/config.php` if your DB credentials differ from the defaults (`root` / empty password). For production, set `DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME` as environment variables.

3. **Serve** — Herd auto-serves this folder. Open:
   ```
   http://goldentuliprosavillahotel.test
   ```

## Project Layout

```
.
├── index.php             # Landing page (hero carousel + booking bar)
├── rooms.php             # All rooms
├── room.php              # Single-room detail
├── booking.php           # Booking form
├── booking-confirm.php   # Reservation + bank transfer details
├── dining.php
├── amenities.php
├── meetings.php
├── about.php
├── contact.php
├── config/               # DB credentials + helpers
├── includes/             # header, footer, shared functions
├── assets/               # CSS, JS
├── images/               # Photography
├── sql/schema.sql        # Database schema + seed data
└── .htaccess
```

## Updating Bank Transfer Details

Edit the constants in `config/config.php`:
- `BANK_NAME`
- `BANK_ACCOUNT_NAME`
- `BANK_ACCOUNT_NO`

## Deployment

1. Push to GitHub.
2. On the production server, clone the repo into the web root.
3. Set environment variables for DB credentials (or copy a `config/config.local.php` override that supersedes the defaults).
4. Import `sql/schema.sql` into the production MySQL.
5. Ensure Apache has `mod_rewrite` and `mod_deflate` enabled.
