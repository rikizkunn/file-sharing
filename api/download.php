<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('upload_max_filesize', '100M'); // Set upload max filesize to 100 megabytes
ini_set('post_max_size', '100M'); // Set post max size to 100 megabytes


function verifyPassword($userInputPassword, $correctPassword)
{
    return password_verify($userInputPassword, $correctPassword);
}

function downloadFile($fileInfo)
{
    $fileDir = __DIR__ . '/../uploaded_files/' . $fileInfo['hash_id'] . '/' . $fileInfo['name'];

    if (file_exists($fileDir)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($fileInfo['name']));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($fileDir));
        ob_clean();
        flush();
        readfile($fileDir);
        exit;
    } else {
        echo 'File not found';
    }
}


if (isset($_GET['hash_id'])) {

    require_once('../database/init_db.php');
    $db = new fileSharing("localhost", "safe_pdf", "root", "");


    $hash_id = $_GET['hash_id'];
    $check = $db->get_info($hash_id);

    if ($check['status']) {
        $fileInfo = $check['data'];
        if ($fileInfo['private'] == 1) {
            if ($_POST['password_file'] != '' && verifyPassword($_POST['password_file'], $fileInfo['password'])) {
                $db->update_download_count($hash_id);
                downloadFile($fileInfo);
            } else {
                echo 'Access denied (wrong password)';
            }
        } else {
            $db->update_download_count($hash_id);
            downloadFile($fileInfo);
        }
    } else {
        echo 'Failed to Download';
    }
}
