<?php
session_start();
require_once '../app/config/config.php';

// Kalau sudah login, langsung redirect
if (isset($_SESSION['user_id'])) {
    $redirect = $_SESSION['role'] === 'admin' ? 'admin/' : 'kasir/';
    header("Location: $redirect");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nama']    = $user['nama'];
        $_SESSION['role']    = $user['role'];

        // Redirect berdasarkan role
        header("Location: " . ($user['role'] === 'admin' ? 'admin/' : 'kasir/'));
        exit;
    } else {
        $error = 'Username atau password salah.';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login — Berkesan Coffee</title>
    <link rel="stylesheet" href="/public/assets/css/style.css">
    <link rel="stylesheet" href="/public/assets/css/login.css">
</head>
<body class="login-page">
    <div class="login-card">
        <h1>☕ Berkesan Coffee</h1>
        <p>Silakan login untuk melanjutkan</p>
        <?php if ($error): ?>
            <div class="alert alert-error"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Masuk</button>
        </form>
    </div>

    <script src="/berkesan/public/assets/js/login.js"></script>
</body>
</html>