-- Golden Tulip Rosa Villa Hotel — Database Schema
--
-- Import notes:
--   * Shared hosting (cPanel / phpMyAdmin): create the database first via
--     the hosting panel, select it, then import this file.
--   * Local dev: create the DB once, then `mysql -u root <dbname> < sql/schema.sql`.

-- Rooms catalog
DROP TABLE IF EXISTS rooms;
CREATE TABLE rooms (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    slug            VARCHAR(80) NOT NULL UNIQUE,
    name            VARCHAR(120) NOT NULL,
    tagline         VARCHAR(200) NOT NULL,
    description     TEXT NOT NULL,
    price_ngn       DECIMAL(10,2) NOT NULL,
    max_guests      TINYINT NOT NULL DEFAULT 2,
    bed_type        VARCHAR(60) NOT NULL,
    size_sqm        SMALLINT NOT NULL DEFAULT 25,
    image           VARCHAR(200) NOT NULL,
    highlights      TEXT NOT NULL,
    ideal_for       TEXT NOT NULL,
    is_active       TINYINT(1) NOT NULL DEFAULT 1,
    sort_order      SMALLINT NOT NULL DEFAULT 0,
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO rooms (slug, name, tagline, description, price_ngn, max_guests, bed_type, size_sqm, image, highlights, ideal_for, sort_order) VALUES
('classic', 'Classic Room', 'Comfort Designed for the Modern Business Traveller',
 'The Classic Room at Golden Tulip Rosa Villa Hotel Owerri is carefully designed for guests who appreciate comfort, simplicity, and relaxation in a refined hospitality setting. Ideal for business travelers, solo guests, and short stays, the room provides a peaceful retreat within the serene environment of Owerri.',
 65000.00, 2, 'King Bed', 22, 'room-classic.jpg',
 'Comfortable bed with premium bedding|Functional work desk and chair|Modern en-suite bathroom|Smart TV with satellite channels|High-speed Wi-Fi|Air conditioning|24-hour room service',
 'Business travelers|Solo guests|Short stays|Transit or overnight visits',
 1),
('superior', 'Superior Room', 'Extra Space. Elevated Comfort. Thoughtful Design.',
 'The Superior Room offers enhanced space, comfort, and refined elegance for guests who desire a more relaxed and elevated stay experience. Thoughtfully designed for both business and leisure travelers, the Superior Room blends modern functionality with tasteful interiors. Select Superior Rooms feature private balconies.',
 95000.00, 2, 'King Bed', 28, 'room-superior.jpg',
 'Spacious room layout|Premium bedding for deeper rest|Comfortable seating area|Work desk|Modern en-suite bathroom|Smart TV|High-speed Wi-Fi|Air conditioning|Select rooms with private balcony',
 'Extended business stays|Couples|Guests seeking added comfort|Leisure travelers',
 2),
('deluxe', 'Deluxe Room', 'Curated Elegance for Discerning Guests',
 'The Deluxe Room brings together refined interiors, premium furnishings, and warm ambient lighting to create an inviting sanctuary. With more generous proportions and elevated touches throughout, this category is tailored for guests who expect comfort, style, and attention to detail.',
 135000.00, 2, 'King Bed', 32, 'room-deluxe.jpg',
 'Extra-spacious layout|Premium king bedding|Marble feature headboard wall|Plush seating|Smart TV|High-speed Wi-Fi|Air conditioning|Premium en-suite bath|Daily housekeeping',
 'Couples|Leisure travelers|Special occasions|Discerning guests',
 3),
('executive-suite', 'Executive Suite', 'Refined Luxury for Executive Stays',
 'The Executive Suite features a spacious separate living area and elegantly curated interiors, providing a premium environment suitable for both work and relaxation. Guests can comfortably host informal meetings, receive visitors, or unwind in a serene and well-appointed setting.',
 220000.00, 3, 'King Bed + Lounge', 48, 'suite-living.jpg',
 'Separate living and sleeping areas|Elegant interior decor|Premium bedding and furnishings|Spacious bathroom with premium amenities|Smart TV in both rooms|High-speed Wi-Fi|Air conditioning|Select suites with private balcony',
 'Executives and corporate leaders|Diplomats and VIP guests|Extended business stays|Special occasions',
 4);

-- Bookings
DROP TABLE IF EXISTS bookings;
CREATE TABLE bookings (
    id                  INT AUTO_INCREMENT PRIMARY KEY,
    reference           VARCHAR(20) NOT NULL UNIQUE,
    room_id             INT NOT NULL,
    guest_first_name    VARCHAR(80) NOT NULL,
    guest_last_name     VARCHAR(80) NOT NULL,
    guest_email         VARCHAR(160) NOT NULL,
    guest_phone         VARCHAR(40) NOT NULL,
    guest_country       VARCHAR(80) DEFAULT NULL,
    check_in            DATE NOT NULL,
    check_out           DATE NOT NULL,
    nights              SMALLINT NOT NULL,
    adults              TINYINT NOT NULL DEFAULT 1,
    children            TINYINT NOT NULL DEFAULT 0,
    total_amount        DECIMAL(12,2) NOT NULL,
    special_requests    TEXT DEFAULT NULL,
    payment_method      VARCHAR(40) NOT NULL DEFAULT 'bank_transfer',
    payment_status      ENUM('pending','confirmed','cancelled') NOT NULL DEFAULT 'pending',
    booking_status      ENUM('reserved','confirmed','cancelled','completed') NOT NULL DEFAULT 'reserved',
    created_at          TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_dates (check_in, check_out),
    INDEX idx_email (guest_email),
    CONSTRAINT fk_bookings_room FOREIGN KEY (room_id) REFERENCES rooms(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Contact / enquiry messages
DROP TABLE IF EXISTS enquiries;
CREATE TABLE enquiries (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    full_name   VARCHAR(120) NOT NULL,
    email       VARCHAR(160) NOT NULL,
    phone       VARCHAR(40) DEFAULT NULL,
    subject     VARCHAR(200) NOT NULL,
    message     TEXT NOT NULL,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Newsletter subscribers
DROP TABLE IF EXISTS subscribers;
CREATE TABLE subscribers (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    email       VARCHAR(160) NOT NULL UNIQUE,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Guest reviews / testimonials (new submissions default to approved=0; flip to 1 to publish)
DROP TABLE IF EXISTS reviews;
CREATE TABLE reviews (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(120) NOT NULL,
    email       VARCHAR(160) NOT NULL,
    location    VARCHAR(120) DEFAULT NULL,
    rating      TINYINT UNSIGNED NOT NULL DEFAULT 5,
    title       VARCHAR(200) DEFAULT NULL,
    comment     TEXT NOT NULL,
    approved    TINYINT(1) NOT NULL DEFAULT 0,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_approved_created (approved, created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO reviews (name, email, location, rating, title, comment, approved, created_at) VALUES
('Adaeze O.',   'adaeze@example.com',  'Lagos, Nigeria',          5, 'A serene escape in the heart of Owerri',
 'From the warm welcome at reception to the spotless rooms and exquisite dining, every detail at Golden Tulip Rosa Villa felt considered. The staff went out of their way to make our anniversary weekend memorable. We will be back.',
 1, '2026-03-12 14:20:00'),
('Chukwuemeka N.', 'emeka@example.com', 'Port Harcourt, Nigeria',  5, 'Best hotel in Owerri, no question',
 'Stayed here on business for a week and the experience was world-class. Quiet location, fast Wi-Fi, comfortable bed, and the breakfast was excellent. The Deluxe Room was beautifully finished and the Bush Bar lounge in the evening is a great touch.',
 1, '2026-04-02 09:05:00'),
('Sarah M.',    'sarah.m@example.com', 'London, United Kingdom',  5, 'Five-star service, warm Nigerian hospitality',
 'We were treated like royalty from arrival to checkout. The Ikedu Restaurant has a beautifully curated menu blending continental and African dishes, and the pool area is gorgeous. Thank you to the entire team for an unforgettable stay.',
 1, '2026-04-18 18:40:00'),
('Bode A.',     'bode.a@example.com',  'Abuja, Nigeria',          4, 'Excellent comfort, would recommend',
 'Beautiful property and lovely interiors. The rooms are spacious and the staff are very attentive. Slight delay at check-in but otherwise a great experience. Special mention to the concierge for arranging our airport pickup so smoothly.',
 1, '2026-04-29 11:10:00'),
('Tobi & Funmi K.', 'tk@example.com', 'Ibadan, Nigeria',          5, 'Perfect for our honeymoon stay',
 'Romantic, calm and tastefully designed. The Executive Suite had its own living area which felt like a private apartment. Breakfast in bed was thoughtfully presented. We could not have picked a better place to start our marriage.',
 1, '2026-05-10 08:30:00'),
('David O.',    'david.o@example.com', 'Houston, USA',             5, 'Truly international standard',
 'I travel for work across Africa, Europe and the US, and Golden Tulip Rosa Villa is right up there with the best. Clean, modern, friendly, and the meeting facilities were perfect for the client session I hosted. Highly recommended.',
 1, '2026-05-19 16:00:00');
