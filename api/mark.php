<?php
session_start();
if (isset($_POST['taskId']) && isset($_POST['completed'])) {
    require_once('../database/init_db.php');
    $db = new fileSharing("localhost", "safe_pdf", "root", "");
    $task_id = $_POST['taskId'];
    $completed = $_POST['completed'];
    $mark = $db->mark($_SESSION['user_id'], $task_id, $completed);
    echo $mark;
} else {
    echo json_encode(['status' => false, 'message' => 'Task parameter not provided']);
}
