<?php
class Auth {
    private $conn;
    private $user;

    public function __construct($db) {
        $this->conn = $db;
        $this->user = new User($db);
    }

    public function login($email, $password) {
        $userData = $this->user->findByEmail($email);

        if (!$userData) {
            return ['status' => false, 'message' => 'Email tidak ditemukan!'];
        }

        if (!password_verify($password, $userData['password'])) {
            return ['status' => false, 'message' => 'Password salah!'];
        }

        $_SESSION['user'] = [
            'id'        => $userData['id'],
            'nama'      => $userData['nama'],
            'email'     => $userData['email'],
            'role_id'   => $userData['role_id'],
            'role_name' => $userData['role_name']
        ];
        $_SESSION['login'] = true;

        return ['status' => true, 'message' => 'Login berhasil!'];
    }

    public function logout() {
        session_destroy();
        header("Location: login.php");
        exit;
    }

    public static function isLoggedIn() {
        return isset($_SESSION['login']) && $_SESSION['login'] === true;
    }
}
?>
