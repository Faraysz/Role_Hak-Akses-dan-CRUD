<?php
class User {
    private $conn;
    private $table = "users";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function findByEmail($email) {
        $stmt = $this->conn->prepare("SELECT u.*, r.role_name FROM {$this->table} u JOIN roles r ON u.role_id = r.id WHERE u.email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function register($data) {
        $check = $this->findByEmail($data['email']);
        if ($check) {
            return ['status' => false, 'message' => 'Email sudah terdaftar!'];
        }

        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (nama, email, password, role_id) VALUES (?, ?, ?, ?)");
        $role_id = 2; // default: user
        $stmt->bind_param("sssi", $data['nama'], $data['email'], $hashedPassword, $role_id);

        if ($stmt->execute()) {
            return ['status' => true, 'message' => 'Registrasi berhasil! Silakan login.'];
        }
        return ['status' => false, 'message' => 'Registrasi gagal: ' . $this->conn->error];
    }

    public function getAll() {
        return $this->conn->query("SELECT u.*, r.role_name FROM {$this->table} u JOIN roles r ON u.role_id = r.id ORDER BY u.id ASC");
    }
}
?>
