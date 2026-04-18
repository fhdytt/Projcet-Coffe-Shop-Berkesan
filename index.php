<?php
$servername = "localhost";
$username = "root"; 
$password = "12344321"; 
$dbname = "berkesan";

$conn = new mysqli($servername, $username, $password, $dbname);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cek Koneksi Berkesan</title>
    <style>
        .box { padding: 20px; border-radius: 10px; font-family: sans-serif; margin-top: 20px; }
        .success { background: #e8f5e9; border: 2px solid #2e7d32; color: #1b5e20; }
        .error { background: #ffebee; border: 2px solid #c62828; color: #b71c1c; }
    </style>
</head>
<body>

    <?php if ($conn->connect_error): ?>
        <div class="box error">
            <h2>❌ Koneksi Gagal!</h2>
            <p>Pesan Error: <?= $conn->connect_error ?></p>
        </div>
    <?php else: ?>
        <div class="box success">
            <h2>✅ Koneksi Berhasil!</h2>
            <p>Server berhasil terhubung ke database: <strong><?= $dbname ?></strong></p>
            <p>Sekarang lanjut ke <strong>Project</strong></p>
        </div>
    <?php endif; ?>

</body>
</html>
