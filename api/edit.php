<?php
session_start();
require_once('../database/init_db.php');
$db = new fileSharing("localhost", "safe_pdf", "root", "");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $hash_id = $_POST['hash_id'];
    $user_id = $_SESSION['user_id'];

    if ($db->check_file_ownership($hash_id, $user_id)) {
        $fileInfo = $db->get_info($hash_id);

        if ($fileInfo['status']) {
            // Define the file path and folder path
            $folderPath = __DIR__ . '/../uploaded_files/' . $fileInfo['data']['hash_id'];
            $filePath = $folderPath . '/' . $fileInfo['data']['name'];
            // Check if a new file is uploaded
            if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK) {
                unlink($filePath);
                $newFileName = $_FILES['fileToUpload']['name'];
                $newFilePath = $folderPath . '/' . $newFileName;
                move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $newFilePath);
            } else {
                $newFileName = $fileInfo['data']['name'];
            }

            $newTitle = $_POST['title'];
            $newDescription = isset($_POST['desc']) ? $_POST['desc'] : '';
            $newIsPrivate = $_POST['private'];
            $newPassword = isset($_POST['password']) ?  password_hash($_POST['password'], PASSWORD_DEFAULT) : $fileInfo['data']['password'];
            $edited = $db->update_file_record($hash_id, $newFileName, $newTitle, $newDescription, $newIsPrivate, $newPassword);
            if ($edited) {
                print_r(["status" => true, "message" => "Record Successfully Updated"]);
            } else {
                print_r(["status" => true, "message" => "Record Failed to be Updated"]);
            }
        } else {
            print_r(["status" => false, "message" => "File Not Found"]);
        }
    } else {
        print_r(["status" => false, "message" => "Access Forbidden"]);
    }
}
