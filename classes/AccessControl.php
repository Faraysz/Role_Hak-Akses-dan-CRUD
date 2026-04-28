<?php
class AccessControl {
    public static function isLoggedIn() {
        if (!isset($_SESSION['user'])) {
            $loginUrl = defined('BASE_URL') ? BASE_URL . '/login.php' : 'login.php';
            header("Location: " . $loginUrl);
            exit;
        }
    }

    public static function checkRole($role_id) {
        if ($_SESSION['user']['role_id'] != $role_id) {
            $dashboardUrl = defined('BASE_URL') ? BASE_URL . '/dashboard.php' : 'dashboard.php';
            echo '<div style="text-align:center;margin-top:100px;">
                    <h2>403 - Akses Ditolak!</h2>
                    <p>Anda tidak memiliki hak akses ke halaman ini.</p>
                    <a href="' . $dashboardUrl . '" style="color:#007bff;">Kembali ke Dashboard</a>
                  </div>';
            exit;
        }
    }

    public static function isAdmin() {
        return isset($_SESSION['user']['role_id']) && $_SESSION['user']['role_id'] == 1;
    }
}
?>
