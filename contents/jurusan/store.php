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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $jurusan->store($_POST);

    if ($result['status']) {
        $_SESSION['success'] = $result['message'];
    } else {
        $_SESSION['error'] = $result['message'];
    }

    header("Location: " . BASE_URL . "/dashboard.php?page=jurusan");
    exit;
}
?>
