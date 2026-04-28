<?php
session_start();
require_once __DIR__ . '/classes/AccessControl.php';
AccessControl::isLoggedIn();
AccessControl::checkRole(1); // Hanya admin (role_id = 1)

require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/classes/User.php';
require_once __DIR__ . '/classes/Jurusan.php';

$db = new Database();
$conn = $db->getConnection();
$userModel = new User($conn);
$jurusanModel = new Jurusan($conn);

$users = $userModel->getAll();
$totalJurusan = $jurusanModel->getAll()->num_rows;

$pageTitle = 'Admin Panel - SI Kampus';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<div class="main-content">
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3><i class="bi bi-shield-lock"></i> Admin Panel</h3>
            <span class="badge bg-danger fs-6">Admin Only</span>
        </div>

        <!-- Statistik Admin -->
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="card stat-card bg-warning text-dark">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Total Pengguna Terdaftar</h6>
                            <h2 class="mb-0"><?= $users->num_rows ?></h2>
                        </div>
                        <i class="bi bi-people-fill stat-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
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
        </div>

        <!-- Daftar User -->
        <div class="table-wrapper">
            <h5 class="mb-3"><i class="bi bi-people"></i> Daftar Pengguna</h5>
            <table id="tableUsers" class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Reset pointer
                    $users->data_seek(0);
                    $no = 1;
                    while ($row = $users->fetch_assoc()):
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td>
                            <span class="badge <?= $row['role_id'] == 1 ? 'bg-danger' : 'bg-secondary' ?>">
                                <?= htmlspecialchars(ucfirst($row['role_name'])) ?>
                            </span>
                        </td>
                        <td><?= date('d M Y H:i', strtotime($row['created_at'])) ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#tableUsers').DataTable();
    });
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
