<?php
session_start();
require_once __DIR__ . '/config/init.php';

// Redirect jika sudah login
if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    header("Location: " . BASE_URL . "/dashboard.php");
    exit;
}

require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/classes/User.php';
require_once __DIR__ . '/classes/Auth.php';

$error = '';
$success = $_SESSION['success'] ?? '';
unset($_SESSION['success']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();
    $conn = $db->getConnection();
    $auth = new Auth($conn);

    $result = $auth->login($_POST['email'], $_POST['password']);

    if ($result['status']) {
        header("Location: " . BASE_URL . "/dashboard.php");
        exit;
    } else {
        $error = $result['message'];
    }
}

$pageTitle = 'Login - SI Kampus';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="auth-wrapper">
        <div class="card auth-card">
            <div class="card-header">
                <h4 class="mb-0"><i class="bi bi-mortarboard-fill text-primary"></i> SI Kampus</h4>
                <small class="text-muted">Workshop Sistem Informasi</small>
            </div>
            <div class="card-body">
                <h5 class="text-center mb-4">Login</h5>

                <?php if ($error): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-circle"></i> <?= htmlspecialchars($error) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if ($success): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i> <?= htmlspecialchars($success) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-2">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </button>
                </form>
                <div class="text-center mt-3">
                    <small>Belum punya akun? <a href="register.php">Daftar di sini</a></small>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
