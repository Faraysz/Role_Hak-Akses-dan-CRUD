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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $result = $jurusan->delete($id);

    if ($result['status']) {
        echo json_encode(['status' => true, 'message' => $result['message']]);
        $_SESSION['success'] = $result['message'];
    } else {
        echo json_encode(['status' => false, 'message' => $result['message']]);
        $_SESSION['error'] = $result['message'];
    }
} else {
    echo json_encode(['status' => false, 'message' => 'Request tidak valid']);
}
?>
