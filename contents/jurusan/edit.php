<?php
session_start();
require_once __DIR__ . '/../../config/init.php';
require_once BASE_PATH . '/classes/AccessControl.php';
AccessControl::isLoggedIn();

require_once BASE_PATH . '/config/Database.php';
require_once BASE_PATH . '/classes/Jurusan.php';

$db = new Database();
$conn = $db->getConnection();
$jurusan = new Jurusan($conn);

if (!isset($_GET['id'])) {
    header("Location: " . BASE_URL . "/dashboard.php?page=jurusan");
    exit;
}

$jurusan_data = $jurusan->getJurusanById($_GET['id']);

if (!$jurusan_data) {
    $_SESSION['error'] = 'Data jurusan tidak ditemukan!';
    header("Location: " . BASE_URL . "/dashboard.php?page=jurusan");
    exit;
}

$pageTitle = 'Edit Jurusan - SI Kampus';
require_once BASE_PATH . '/includes/header.php';
require_once BASE_PATH . '/includes/navbar.php';
?>

<div class="main-content">
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3><i class="bi bi-pencil-square"></i> Edit Jurusan</h3>
            <a href="<?= BASE_URL ?>/dashboard.php?page=jurusan" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST" action="<?= BASE_URL ?>/contents/jurusan/update.php">
                    <input type="hidden" name="id" value="<?= $jurusan_data['id'] ?>">
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode Jurusan</label>
                        <input type="text" class="form-control" id="kode" name="kode" placeholder="Contoh: TI, TE, TM" maxlength="10" value="<?= htmlspecialchars($jurusan_data['kode_jurusan']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Jurusan</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Contoh: Teknologi Informasi" value="<?= htmlspecialchars($jurusan_data['nama_jurusan']) ?>" required>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">
                        <i class="bi bi-save"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . '/includes/footer.php'; ?>
