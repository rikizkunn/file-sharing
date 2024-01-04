<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('upload_max_filesize', 100);
ini_set('post_max_size',100);

$x = $db->test();
var_dump($x);


    // if (!isset($_SESSION['authenticated'])) {
    //     exit;
    // }
    $file = '/path/to/file/outside/www/secret.pdf';

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exit;

?>