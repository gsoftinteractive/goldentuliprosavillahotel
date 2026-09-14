-- Golden Tulip Rosa Villa Hotel — Room rate update (14 Sep 2026)
--
-- SAFE TO RUN ON THE LIVE DATABASE. This file only UPDATEs prices and INSERTs
-- the new Standard Room in the `rooms` table. It does NOT drop or truncate
-- anything, so existing bookings, enquiries, subscribers and reviews are
-- untouched. Running it more than once is harmless.
--
-- Do NOT re-import sql/schema.sql on the live server — that file DROPs and
-- recreates every table and would wipe all bookings.
--
-- How to apply (cPanel): phpMyAdmin -> select the site database -> SQL tab ->
-- paste this whole file -> Go.
--
-- Final catalogue:
--   Classic Room      85,000
--   Standard Room    100,000   (new category)
--   Superior Room    120,000
--   Deluxe Room      130,000
--   Executive Suite  250,000

-- 1. New rates for the existing rooms
UPDATE rooms SET price_ngn =  85000.00, sort_order = 1 WHERE slug = 'classic';
UPDATE rooms SET price_ngn = 120000.00, sort_order = 3 WHERE slug = 'superior';
UPDATE rooms SET price_ngn = 130000.00, sort_order = 4 WHERE slug = 'deluxe';
UPDATE rooms SET price_ngn = 250000.00, sort_order = 5 WHERE slug = 'executive-suite';

-- 2. Add the Standard Room between Classic and Superior (skipped automatically if it already exists)
--    NOTE: the photo (room-classic.jpg) and description are placeholders until the hotel supplies
--    Standard Room specifics. Change them here or directly in phpMyAdmin.
INSERT INTO rooms (slug, name, tagline, description, price_ngn, max_guests, bed_type, size_sqm, image, highlights, ideal_for, is_active, sort_order)
SELECT 'standard', 'Standard Room', 'Refined Comfort with Room to Unwind',
 'The Standard Room at Golden Tulip Rosa Villa Hotel Owerri offers a step up in space and finish for guests who want a little more room to relax. Featuring elegant interiors, warm lighting, modern furnishings and a functional layout, it blends style with convenience for both business and leisure stays.',
 100000.00, 2, 'King Bed', 25, 'room-classic.jpg',
 'Generous room layout|Premium bedding|Work desk and chair|Modern en-suite bathroom|Smart TV with satellite channels|High-speed Wi-Fi|Air conditioning|Refrigerator|24-hour room service',
 'Business travelers|Couples|Short and medium stays|Guests seeking extra space at great value',
 1, 2
WHERE NOT EXISTS (SELECT 1 FROM rooms WHERE slug = 'standard');

-- 3. Safety net: keep the Standard rate current even if step 2 was skipped
UPDATE rooms SET price_ngn = 100000.00, sort_order = 2 WHERE slug = 'standard';
