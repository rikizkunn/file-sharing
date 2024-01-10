<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header('Location: auth.php');
    exit;
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('upload_max_filesize', 100);
ini_set('post_max_size', 100);



define('ROOT_PATH', dirname(__DIR__) . '/htdocs/');
define('UPLOAD_PATH', './uploaded_files/');

require_once(ROOT_PATH . 'database/init_db.php');
$db = new fileSharing("localhost", "safe_pdf", "root", "");

require_once(ROOT_PATH . 'layout/header.php');
require_once(ROOT_PATH . 'layout/navbar.php');
require_once(ROOT_PATH . 'layout/main.php');
require_once(ROOT_PATH . 'layout/footer.php');

$db->close();
