<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('upload_max_filesize', '100M'); // Set upload max filesize to 100 megabytes
ini_set('post_max_size', '100M'); // Set post max size to 100 megabytes
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header('Location: auth.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    require_once(__DIR__ . '/../database/init_db.php');
    $db = new fileSharing("localhost", "safe_pdf", "root", "");

    $hash_id = $_GET['hash_id'];
    $user_id = $_SESSION['user_id'];

    $deleted = $db->delete_file($hash_id, $user_id);
    http_response_code($deleted['status'] ? 200 : 400);
    echo $deleted['message'];
}
