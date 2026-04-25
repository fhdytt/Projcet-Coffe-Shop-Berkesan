<?php
define('DB_HOST', '192.168.1.80');
define('DB_NAME', 'berkesan');
define('DB_USER', 'admin');
define('DB_PASS', 'admin123#');

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}