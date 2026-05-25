<?php
require_once __DIR__ . '/config.php';

function db(): PDO {
    static $pdo = null;
    if ($pdo !== null) return $pdo;

    $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
        DB_HOST, DB_PORT, DB_NAME);

    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
    } catch (PDOException $e) {
        http_response_code(500);
        $msg = ini_get('display_errors') ? $e->getMessage() : 'Database connection error.';
        die('<div style="font-family:sans-serif;padding:40px;max-width:640px;margin:80px auto;background:#fff7f5;border:1px solid #f5c2b6;border-radius:8px;">'
          . '<h2 style="color:#a8392a;margin:0 0 12px">Database not reachable</h2>'
          . '<p style="color:#555">Could not connect to MySQL. Make sure MySQL is running and the database <code>' . DB_NAME . '</code> exists.</p>'
          . '<p style="color:#777;font-size:13px">Run: <code>mysql -u ' . DB_USER . ' -p &lt; sql/schema.sql</code></p>'
          . '<p style="color:#999;font-size:12px">' . htmlspecialchars($msg) . '</p>'
          . '</div>');
    }
    return $pdo;
}
