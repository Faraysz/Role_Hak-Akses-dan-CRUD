<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/AccessControl.php';
AccessControl::isLoggedIn();

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/Database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/Jurusan.php';

$db = new Database();
$conn = $db->getConnection();
$jurusan = new Jurusan($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $result = $jurusan->update($id, $_POST);

    if ($result['status']) {
        $_SESSION['success'] = $result['message'];
    } else {
        $_SESSION['error'] = $result['message'];
    }

    header("Location: ../../dashboard.php?page=jurusan");
    exit;
}
?>
