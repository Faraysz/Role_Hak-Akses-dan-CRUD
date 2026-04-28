<?php
require_once __DIR__ . '/../classes/AccessControl.php';
$baseUrl = defined('BASE_URL') ? BASE_URL : '';
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= $baseUrl ?>/dashboard.php">
            <i class="bi bi-mortarboard-fill"></i> SI Kampus
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $baseUrl ?>/dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $baseUrl ?>/dashboard.php?page=jurusan"><i class="bi bi-building"></i> Jurusan</a>
                </li>
                <?php if (AccessControl::isAdmin()): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $baseUrl ?>/admin.php"><i class="bi bi-shield-lock"></i> Admin Panel</a>
                </li>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i> <?= htmlspecialchars($_SESSION['user']['nama']) ?>
                        <span class="badge bg-light text-primary ms-1"><?= htmlspecialchars($_SESSION['user']['role_name']) ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><span class="dropdown-item-text text-muted"><?= htmlspecialchars($_SESSION['user']['email']) ?></span></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="<?= $baseUrl ?>/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
