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

        $originalFileName = basename($_FILES['fileToUpload']['name']);
        $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        $hash_id = md5(uniqid());
        $uploadDir = __DIR__ . '/../uploaded_files/' . $hash_id;
        $filePath = $uploadDir . '/' . $originalFileName;

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true); // The third parameter true ensures that any missing parent directories are also created
        }

        $private = isset($_POST['private']) ? intval($_POST['private']) : 0;
        if (isset($_POST['password'])) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        } else {
            $password = '';
        }
        $description = isset($_POST['desc']) ? $_POST['desc'] : '';

        if ($_FILES['fileToUpload']['size'] <= $maxFileSize) {
            // Move the uploaded file to the destination directory
            $private = ($private == 1 && $password !== '') ? 1 : 0;
            if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $filePath)) {
                $data = [
                    "title" => $_POST['title'],
                    "name" => $originalFileName,
                    "hash_id" => $hash_id,
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
