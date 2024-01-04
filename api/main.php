<?php $page = (isset($_GET['page'])) ? $_GET['page']:"main"; ?>
<?php include_once(ROOT_PATH.'config/config.php'); ?>

    <?php
        switch ($page) {
            case 'upload_file':
                
                require('./upload/upload.php');
                break;

            default:
                # code...
                break;
        }
    ?>
