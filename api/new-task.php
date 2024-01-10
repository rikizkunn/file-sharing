<?php
session_start();

if (isset($_POST['task'])) {
    require_once('../database/init_db.php');
    $db = new fileSharing("localhost", "safe_pdf", "root", "");
    $task = $_POST['task'];

    $in = $db->new_tasks($_SESSION['user_id'], $task);
    echo $in;
} else {
    echo json_encode(['status' => false, 'message' => 'Task parameter not provided']);
}
