<?php
// Base path proyek (root folder)
define('BASE_PATH', dirname(__DIR__));

// Base URL otomatis (mendukung subfolder)
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$basePath = rtrim($scriptDir, '/');

// Jika script ada di subfolder (contents/jurusan/), naik ke root
$depth = substr_count(str_replace(str_replace('\\', '/', BASE_PATH), '', str_replace('\\', '/', dirname($_SERVER['SCRIPT_FILENAME']))), '/');
for ($i = 0; $i < $depth; $i++) {
    $basePath = dirname($basePath);
}
$basePath = rtrim(str_replace('\\', '/', $basePath), '/');

define('BASE_URL', $basePath);
?>
