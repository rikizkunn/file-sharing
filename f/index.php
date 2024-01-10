<?php

session_start();

function verifyPassword($userInputPassword, $correctPassword)
{
    return password_verify($userInputPassword, $correctPassword);
}


require_once('../database/init_db.php');
$db = new fileSharing("localhost", "safe_pdf", "root", "");

if (isset($_GET['hash_id'])) {
    $hash_id = $_GET['hash_id'];
    $data = $db->get_info($hash_id);
    if ($data['status'] == false) {
        header('Location: 404.html');
        exit();
    }
    $requiresPassword = $data['data']['private'];
    $fileInfo = $data['data'];
    $formattedDate = date('d M Y', strtotime($fileInfo['created_at']));
    $sizeInKB = round($fileInfo['size'] / 1024, 2);
    $description = !empty($fileInfo['description']) ? $fileInfo['description'] : 'No description available';
}



?>
<?php include('../layout/header.php'); ?>

<!-- Right sidebar Ends-->
<?php
if ($requiresPassword) {
    if (isset($_POST['password_file'])) {
        $userInputPassword = $_POST['password_file'];
        $correctPassword = $fileInfo['password'];
        if (verifyPassword($userInputPassword, $correctPassword)) {
            include('download_file.php');
        } else {
            $alert = '<div class="alert alert-danger" role="alert"><p>Wrong Password</p></div>';
            include 'password_form.php'; // Include the password form again
        }
    } else {
        include('password_form.php');
    }
} else {
    include('download_file.php');
}
?>
</div>
<script src="../assets/js/jquery-3.5.1.min.js"></script>
<script src="../assets/js/bootstrap/popper.min.js"></script>
<script src="../assets/js/bootstrap/bootstrap.js"></script>
<script src="../assets/js/icons/feather-icon/feather.min.js"></script>
<script src="../assets/js/icons/feather-icon/feather-icon.js"></script>
<script src="../assets/js/sidebar-menu.js"></script>
<script src="../assets/js/config.js"></script>
<script src="../assets/js/chat-menu.js"></script>
<script src="../assets/js/script.js"></script>
<script src="../assets/js/theme-customizer/customizer.js"></script>
<script src="../assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/js/datatable/datatables/datatable.custom.js"></script>
</body>

</html>