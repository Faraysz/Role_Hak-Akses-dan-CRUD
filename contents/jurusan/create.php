<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/AccessControl.php';
AccessControl::isLoggedIn();

$pageTitle = 'Tambah Jurusan - SI Kampus';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/navbar.php';
?>

<div class="main-content">
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3><i class="bi bi-plus-circle"></i> Tambah Jurusan</h3>
            <a href="../../dashboard.php?page=jurusan" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST" action="store.php">
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode Jurusan</label>
                        <input type="text" class="form-control" id="kode" name="kode" placeholder="Contoh: TI, TE, TM" maxlength="10" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Jurusan</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Contoh: Teknologi Informasi" required>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
