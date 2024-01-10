<?php

session_start();

if (isset($_POST['taskId'])) {
    require_once('../database/init_db.php');
    $db = new fileSharing("localhost", "safe_pdf", "root", "");
    $task_id = $_POST['taskId'];
    $delete = $db->delete_task($_SESSION['user_id'], $task_id);
    echo $delete;
} else {
    echo json_encode(['status' => false, 'message' => 'Task parameter not provided']);
}
