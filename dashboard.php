<?php
session_start();
require_once __DIR__ . '/config/init.php';
require_once __DIR__ . '/classes/AccessControl.php';
AccessControl::isLoggedIn();

require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/classes/Jurusan.php';
require_once __DIR__ . '/classes/User.php';

$db = new Database();
$conn = $db->getConnection();

// Statistik untuk dashboard
$jurusanModel = new Jurusan($conn);
$userModel = new User($conn);
$totalJurusan = $jurusanModel->getAll()->num_rows;
$totalUsers = $userModel->getAll()->num_rows;

$page = $_GET['page'] ?? 'home';

$pageTitle = 'Dashboard - SI Kampus';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<div class="main-content">
    <div class="container mt-4">
        <!-- Flash Messages -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> <?= htmlspecialchars($_SESSION['success']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle"></i> <?= htmlspecialchars($_SESSION['error']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if ($page === 'home'): ?>
            <!-- Dashboard Home -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3><i class="bi bi-speedometer2"></i> Dashboard</h3>
                <span class="text-muted">Selamat datang, <strong><?= htmlspecialchars($_SESSION['user']['nama']) ?></strong>!</span>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="card stat-card bg-primary text-white">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title">Total Jurusan</h6>
                                <h2 class="mb-0"><?= $totalJurusan ?></h2>
                            </div>
                            <i class="bi bi-building stat-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card stat-card bg-success text-white">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title">Total Users</h6>
                                <h2 class="mb-0"><?= $totalUsers ?></h2>
                            </div>
                            <i class="bi bi-people stat-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card stat-card bg-info text-white">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title">Role Anda</h6>
                                <h2 class="mb-0"><?= htmlspecialchars(ucfirst($_SESSION['user']['role_name'])) ?></h2>
                            </div>
                            <i class="bi bi-shield-check stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <h5><i class="bi bi-info-circle"></i> Informasi Sistem</h5>
                    <hr>
                    <p>Sistem ini merupakan implementasi dari <strong>Workshop Sistem Informasi Minggu 11</strong> yang mencakup:</p>
                    <ul>
                        <li><strong>Acara 19:</strong> User Roles & Access Rights - Role-Based Access Control (RBAC) dengan PHP OOP</li>
                        <li><strong>Acara 20:</strong> Manajemen Data - CRUD Jurusan dengan PHP OOP dan DataTables</li>
                    </ul>
                    <p class="text-muted mb-0">Politeknik Negeri Jember - D4 Teknik Informatika</p>
                </div>
            </div>

        <?php elseif ($page === 'jurusan'): ?>
            <!-- Halaman CRUD Jurusan -->
            <?php include __DIR__ . '/contents/jurusan/index.php'; ?>

        <?php else: ?>
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle"></i> Halaman tidak ditemukan.
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
