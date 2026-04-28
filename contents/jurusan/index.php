<?php
// File ini di-include dari dashboard.php, jadi session & koneksi sudah tersedia
$result = $jurusanModel->getAll();
if (!$result) {
    die("Error: " . $conn->error);
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="bi bi-building"></i> Data Jurusan</h3>
    <a href="contents/jurusan/create.php" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Jurusan
    </a>
</div>

<div class="table-wrapper">
    <table id="tableJurusan" class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th width="5%">No</th>
                <th width="15%">Kode</th>
                <th>Nama Jurusan</th>
                <th width="20%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><span class="badge bg-primary"><?= htmlspecialchars($row['kode_jurusan']) ?></span></td>
                <td><?= htmlspecialchars($row['nama_jurusan']) ?></td>
                <td>
                    <a href="contents/jurusan/edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                    <button class="btn btn-sm btn-danger btn-delete" data-id="<?= $row['id'] ?>">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
