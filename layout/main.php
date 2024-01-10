<?php $page = (isset($_GET['page'])) ? $_GET['page'] : "dashboard"; ?>
<?php include_once(ROOT_PATH . 'config/config.php'); ?>

    <?php
    switch ($page) {

        case 'download_file':
            require('./page/download/download.php');
            break;

        case 'dashboard':
            require('./page/user/dashboard.php');
            break;

        case 'uploaded';
            require('./page/upload/show.php');
            break;

        case 'upload_form':
            require('./page/upload/add.php');
            break;

        case 'edit':
            require('./page/upload/edit.php');
            break;

        case 'todo':
            require('./page/user/todo.php');
            break;

        default:
            # code...
            break;
    }
    ?>
