<?php
require_once __DIR__ . '/../config/db.php';

function e(?string $s): string {
    return htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function naira(float $n): string {
    return '₦' . number_format($n, 0);
}

function get_rooms(): array {
    return db()->query('SELECT * FROM rooms WHERE is_active = 1 ORDER BY sort_order ASC')->fetchAll();
}

function get_room_by_slug(string $slug): ?array {
    $stmt = db()->prepare('SELECT * FROM rooms WHERE slug = ? AND is_active = 1');
    $stmt->execute([$slug]);
    $row = $stmt->fetch();
    return $row ?: null;
}

function get_room_by_id(int $id): ?array {
    $stmt = db()->prepare('SELECT * FROM rooms WHERE id = ?');
    $stmt->execute([$id]);
    $row = $stmt->fetch();
    return $row ?: null;
}

function split_pipe(?string $s): array {
    if (!$s) return [];
    return array_values(array_filter(array_map('trim', explode('|', $s))));
}

function nights_between(string $in, string $out): int {
    $a = new DateTimeImmutable($in);
    $b = new DateTimeImmutable($out);
    return max(0, (int)$a->diff($b)->format('%a'));
}

function gen_reference(): string {
    return 'GTRV-' . strtoupper(substr(bin2hex(random_bytes(4)), 0, 8));
}

function current_page(): string {
    $p = basename($_SERVER['SCRIPT_NAME'] ?? '');
    return $p ?: 'index.php';
}

function is_active(string $name): string {
    return current_page() === $name ? ' active' : '';
}

/**
 * Returns ['ok' => bool, 'errors' => [...], 'data' => [...]] for a booking form payload.
 */
function validate_booking(array $p): array {
    $errors = [];
    $required = ['room_id','first_name','last_name','email','phone','check_in','check_out','adults'];
    foreach ($required as $f) {
        if (empty($p[$f])) $errors[$f] = 'Required';
    }
    if (!empty($p['email']) && !filter_var($p['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email';
    }
    if (!empty($p['check_in']) && !empty($p['check_out'])) {
        $today = (new DateTimeImmutable('today'))->format('Y-m-d');
        if ($p['check_in'] < $today)            $errors['check_in']  = 'Check-in cannot be in the past';
        if ($p['check_out'] <= $p['check_in'])  $errors['check_out'] = 'Check-out must be after check-in';
    }
    return ['ok' => empty($errors), 'errors' => $errors];
}
