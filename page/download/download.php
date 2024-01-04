<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();

// if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
//     header('Location: auth.php'); 
//     exit;
// }
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    http_response_code(403);
    echo 'Request GET method not supported';
    exit;
}

require_once(__DIR__ . '/../../database/init_db.php');
$db = new fileSharing("localhost", "safe_pdf", "root", "");

if (!isset($_POST['hash_id']) or $_POST['hash_id'] == "") {
    http_response_code(404);
    echo 'something went wrong';
    exit;
}

$hash_id = $_POST['hash_id'];

$fileData = $db->get_info($hash_id);

if ($fileData['status'] == true) {

    $directory = __DIR__ . '/../../uploaded_files/';

    $hash_file = basename($hash_id);
    $filepath = $directory . $hash_file;

    if (file_exists($filepath) && strpos(realpath($filepath), realpath($directory)) === 0) {
        // Set appropriate headers for file download
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $fileData['data']['name'] . '"');
        header('Content-Length: ' . filesize($filepath));

        // Read and output the file contents
        readfile($filepath);
        exit;
    } else {
        // File not found or not allowed
        http_response_code(404);
        echo 'File not found or access denied.';
        exit;
    }
} else {
    http_response_code(200);
    echo 'not found in our database sirrr!';
    exit;
}
