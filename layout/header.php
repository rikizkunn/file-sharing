<?php

if (isset($_SESSION['user_id'])) {
  $usersInfo = $db->get_user_info($_SESSION['user_id']);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Poco admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
  <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
  <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
  <title>ShareKeun</title>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../assets/css/fontawesome.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/icofont.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/feather-icon.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/animate.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/pe7-icon.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/themify.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="..//assets/css/sweetalert2.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/datatables.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/todo.css">
  <link id="color" rel="stylesheet" href="../assets/css/color-1.css" media="screen">
  <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">

  <link rel="stylesheet" type="text/css" href="https://laravel.pixelstrap.com/poco/assets/css/date-picker.css">


</head>

<body>
  <!-- Loader starts-->
  <div class="loader-wrapper">
    <div class="typewriter">
      <h1>New Era Admin Loading..</h1>
    </div>
  </div>
  <!-- Loader ends-->
  <!-- page-wrapper Start-->
  <div class="page-wrapper">
    <div class="page-main-header">
      <div class="main-header-right">
        <div class="main-header-left text-center">
          <div class="logo-wrapper">
            <a href="/">
              <img src="../assets/images/logo/logo.png" alt="">
            </a>
          </div>
        </div>
        <div class="mobile-sidebar">
          <div class="media-body text-right switch-sm">
            <label class="switch ml-3">
              <i class="font-primary" id="sidebar-toggle" data-feather="align-center"></i>
            </label>
          </div>
        </div>
        <div class="vertical-mobile-sidebar">
          <i class="fa fa-bars sidebar-bar"></i>
        </div>
        <div class="nav-right col pull-right right-menu">
          <ul class="nav-menus">
            <li></li>
            <li>
              <a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()">
                <i data-feather="maximize"></i>
              </a>
            </li>
            <li class="onhover-dropdown">
              <span class="media user-header">
                <img class="img-fluid" src="../assets/images/dashboard/user.png" alt="">
              </span>
              <ul class="onhover-show-div profile-dropdown">
                <?php if (isset($_SESSION['user_id'])) {  ?>
                  <li class="gradient-primary">
                    <h5 class="f-w-600 mb-0">Hi, <?php echo $usersInfo['data']['username']; ?></h5>
                  </li>
                  <li>
                    <a href="/logout.php"><i data-feather="log-out"></i> Logout</a>
                  </li>
                <?php } else { ?>
                  <li class="gradient-primary">
                    <h5 class="f-w-600 mb-0">Not Logged In</h5>
                  </li>
                  <li>
                    <a href="/index.php"><i data-feather="login"></i> Login</a>
                  </li>

                <?php } ?>
              </ul>
            </li>
          </ul>
          <div class="d-lg-none mobile-toggle pull-right">
            <i data-feather="more-horizontal"></i>
          </div>
        </div>
        <script id="result-template" type="text/x-handlebars-template"> <div class="ProfileCard u-cf">
              <div class="ProfileCard-avatar">
                <i class="pe-7s-home"></i>
              </div>
              <div class="ProfileCard-details">
                <div class="ProfileCard-realName"></div>
              </div>
            </div>
          </script>
      </div>
    </div>