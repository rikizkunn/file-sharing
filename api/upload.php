<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header('Location: auth.php');
    exit;
}

require_once(__DIR__ . '/../database/init_db.php');
$db = new fileSharing("localhost", "safe_pdf", "root", "");

$maxFileSize = 30 * 1024 * 1024; // 30 MB

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the file was uploaded without errors
    if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../uploaded_files/';
        $originalFileName = basename($_FILES['fileToUpload']['name']);
        $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        $hashedFilename = md5(uniqid()) . '.' . $fileExtension;
        $filePath = $uploadDir . $hashedFilename;

        $private = isset($_POST['private']) ? intval($_POST['private']) : 0;
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';

        if ($_FILES['fileToUpload']['size'] <= $maxFileSize) {
            // Move the uploaded file to the destination directory
            $private = ($private == 1 && $password !== '') ? 1 : 0;
            if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $filePath)) {
                $data = [
                    "name" => $originalFileName,
                    "hash_id" => $hashedFilename,
                    "user_id" => $_SESSION['user_id'],
                    "description" => $description,
                    "private" => $private,
                    "password" => $password,
                    "size" => $_FILES['fileToUpload']['size']
                ];

                $resp = $db->file_upload($data);
                if ($resp['status'] == true) {
                    $_SESSION['alert'] = '<div class="alert alert-success dark alert-dismissible fade show" role="alert"><strong>Upload Success ! </strong> <p> ' . $originalFileName . ' Uploaded </p></div>';
                    header('Location: /index.php?page=upload_form');
                    exit;
                } else {
                    $_SESSION['alert'] = '<div class="alert alert-danger dark alert-dismissible fade show" role="alert"><strong>Upload Failed ! </strong> <p> ' . $originalFileName . ' Uploaded </p></div>';
                    header('Location: /index.php?page=upload_form');
                    exit;
                }
            } else {
                echo ["status" => false, "msg" => "Error moving the file to the upload directory!"];
            }
        } else {
            echo ["status" => false, "msg" => "File size exceeds the allowed limit."];
        }
    } else {
        echo ["status" => false, "msg" => "Error uploading file. Error code: " . $_FILES['fileToUpload']['error']];
    }
}
