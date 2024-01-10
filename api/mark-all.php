<?php
session_start();
if (isset($_POST['completed'])) {
    require_once('../database/init_db.php');
    $db = new fileSharing("localhost", "safe_pdf", "root", "");
    $completed = $_POST['completed'];
    $mark_all = $db->mark_all($_SESSION['user_id'], $completed);
    echo $mark_all;
} else {
    echo json_encode(['status' => false, 'message' => 'Task parameter not provided']);
}
