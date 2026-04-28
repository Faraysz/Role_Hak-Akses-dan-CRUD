<?php
class Jurusan {
    private $conn;
    private $table = "jurusan";

    public function __construct($db) {
        $this->conn = $db;
    }

    // READ - Menampilkan semua data
    public function getAll() {
        return $this->conn->query("SELECT * FROM {$this->table} ORDER BY id ASC");
    }

    // READ - Menampilkan data berdasarkan ID
    public function getJurusanById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // CREATE - Menambah data baru
    public function store($data) {
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (kode_jurusan, nama_jurusan) VALUES (?, ?)");
        $stmt->bind_param("ss", $data['kode'], $data['nama']);
        if ($stmt->execute()) {
            return ['status' => true, 'message' => 'Data jurusan berhasil ditambahkan!'];
        }
        return ['status' => false, 'message' => 'Gagal menambahkan data: ' . $this->conn->error];
    }

    // UPDATE - Mengubah data
    public function update($id, $data) {
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET kode_jurusan = ?, nama_jurusan = ? WHERE id = ?");
        $stmt->bind_param("ssi", $data['kode'], $data['nama'], $id);
        if ($stmt->execute()) {
            return ['status' => true, 'message' => 'Data jurusan berhasil diperbarui!'];
        }
        return ['status' => false, 'message' => 'Gagal memperbarui data: ' . $this->conn->error];
    }

    // DELETE - Menghapus data
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            return ['status' => true, 'message' => 'Data jurusan berhasil dihapus!'];
        }
        return ['status' => false, 'message' => 'Gagal menghapus data: ' . $this->conn->error];
    }
}
?>
