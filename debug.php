<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h3>Debug Info</h3>";

// 1. Test init.php
echo "<p><b>1. Loading init.php...</b></p>";
require_once __DIR__ . '/config/init.php';
echo "BASE_PATH: " . BASE_PATH . "<br>";
echo "BASE_URL: " . BASE_URL . "<br>";
echo "DOCUMENT_ROOT: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";
echo "SCRIPT_NAME: " . $_SERVER['SCRIPT_NAME'] . "<br>";
echo "SCRIPT_FILENAME: " . $_SERVER['SCRIPT_FILENAME'] . "<br>";

// 2. Test session
echo "<p><b>2. Testing session...</b></p>";
session_start();
echo "Session OK. Session ID: " . session_id() . "<br>";
echo "Session login: " . (isset($_SESSION['login']) ? 'true' : 'false') . "<br>";

// 3. Test database
echo "<p><b>3. Testing database connection...</b></p>";
try {
    require_once __DIR__ . '/config/Database.php';
    $db = new Database();
    $conn = $db->getConnection();
    echo "Database OK! Connected to db_kampus<br>";
    
    // Test query
    $result = $conn->query("SELECT COUNT(*) as total FROM jurusan");
    $row = $result->fetch_assoc();
    echo "Total jurusan: " . $row['total'] . "<br>";
} catch (Exception $e) {
    echo "Database ERROR: " . $e->getMessage() . "<br>";
}

// 4. Test class loading
echo "<p><b>4. Testing class loading...</b></p>";
try {
    require_once __DIR__ . '/classes/User.php';
    echo "User.php OK<br>";
    require_once __DIR__ . '/classes/Auth.php';
    echo "Auth.php OK<br>";
    require_once __DIR__ . '/classes/AccessControl.php';
    echo "AccessControl.php OK<br>";
    require_once __DIR__ . '/classes/Jurusan.php';
    echo "Jurusan.php OK<br>";
} catch (Exception $e) {
    echo "Class ERROR: " . $e->getMessage() . "<br>";
}

echo "<p><b>5. Semua test selesai!</b></p>";
echo "<p><a href='" . BASE_URL . "/login.php'>Coba Login Page</a></p>";
?>
