<?php $page = (isset($_GET['page'])) ? $_GET['page'] : "main"; ?>
<?php include_once(ROOT_PATH . 'config/config.php'); ?>

    <?php
    switch ($page) {

        case 'download_file':
            require('./page/download/download.php');
            break;
            // case 'login':
            //     require('./page/login.php');
            //     break;
        case 'dashboard':
            require('./page/user/dashboard.php');
            break;
            // User Uploading Feature
        case 'uploaded';
            require('./page/upload/show.php');
            break;

        case 'upload_form':
            require('./page/upload/add.php');
            break;
        default:
            # code...
            break;
    }
    ?>
