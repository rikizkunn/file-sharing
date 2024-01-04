<?php
  
    include_once '../../koneksi/koneksi.php';
    $stmt = $koneksi->prepare('SELECT * FROM uploaded_files');
    $stmt->execute();
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
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link id="color" rel="stylesheet" href="../assets/css/color-1.css" media="screen">
    <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">
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
      <!-- Page Header Start-->
      <div class="page-main-header">
        <div class="main-header-right">
          <div class="main-header-left text-center">
            <div class="logo-wrapper"><a href="index.html"><img src="../assets/images/logo/logo.png" alt=""></a></div>
          </div>
          <div class="mobile-sidebar">
            <div class="media-body text-right switch-sm">
              <label class="switch ml-3"><i class="font-primary" id="sidebar-toggle" data-feather="align-center"></i></label>
            </div>
          </div>
          <div class="vertical-mobile-sidebar"><i class="fa fa-bars sidebar-bar">               </i></div>
          <div class="nav-right col pull-right right-menu">
            <ul class="nav-menus">
              <li>
              </li>
              <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
              <li class="onhover-dropdown"> <span class="media user-header"><img class="img-fluid" src="../assets/images/dashboard/user.png" alt=""></span>
                <ul class="onhover-show-div profile-dropdown">
                  <li class="gradient-primary">
                    <h5 class="f-w-600 mb-0">Elana Saint</h5><span>Web Designer</span>
                  </li>
                  <li><i data-feather="user"> </i>Profile</li>
                  <li><i data-feather="message-square"> </i>Inbox</li>
                  <li><i data-feather="file-text"> </i>Taskboard</li>
                  <li><i data-feather="settings"> </i>Settings            </li>
                </ul>
              </li>
            </ul>
            <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
          </div>
          <script id="result-template" type="text/x-handlebars-template">
            <div class="ProfileCard u-cf">                        
            <div class="ProfileCard-avatar"><i class="pe-7s-home"></i></div>
            <div class="ProfileCard-details">
            <div class="ProfileCard-realName">{{name}}</div>
            </div>
            </div>
          </script>
          <script id="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
        </div>
      </div>
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <div class="iconsidebar-menu">
          <div class="sidebar">
            <ul class="iconMenu-bar custom-scrollbar">
              <li><a class="bar-icons" href="javascript:void(0)">
                  <!--img(src='../assets/images/menu/home.png' alt='')--><i class="pe-7s-home"></i><span>General    </span></a>
                <ul class="iconbar-mainmenu custom-scrollbar">
                  <li class="iconbar-header">Dashboard</li>
                  <li><a href="index.html">Default</a></li>
                  <li><a href="dashboard-crypto.html">Crypto</a></li>
                </ul>
              </li>
              <li><a class="bar-icons" href="javascript:void(0)"><i class="pe-7s-copy-file"></i><span>Dokumen</span></a>
                <ul class="iconbar-mainmenu custom-scrollbar">
                  <li class="iconbar-header">All Pages</li>
                  <li><a href="sample-page.html">Daftar Dokumen</a></li>
                  <li><a href="sample-page.html">Tambah Dokumen</a></li>
                  <li><a href="sample-page.html">Private Sharing</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
        <!-- Page Sidebar Ends-->
       
        <!-- Right sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6 main-header">
                  <h2>Uploaded Files</h2>
                  <h6 class="mb-0">Recent Uploaded Files</h6>
                </div>
                <div class="col-lg-6 breadcrumb-right">       
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="pe-7s-home"></i></a></li>
                    <li class="breadcrumb-item">PDF</li>
                    <li class="breadcrumb-item">Daftar Dokumen</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
            <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Data</h5><span>Informasi PDF file</span>
                  </div>
                  <div class="card-block row">
                    <div class="col-sm-12 col-lg-12 col-xl-12">
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Name</th>
                              <th scope="col">Author</th>
                              <th scope="col">Created</th>
                              <th scope="col">Document</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach($rows as $row) {
                                    echo '
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>'. $row['name'] .'</td>
                                            <td>'. $row['author'] .'</td>
                                            <td>'. $row['created_at'] .'</td>
                                            <td>'. $row['file_dir'] .'</td>
                                            <td>'. $row['name'] .'</td>
                                        </tr>';
                                }
                            ?>
                           
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 footer-copyright">
                <p class="mb-0">Copyright © 2021 Poco. All rights reserved.</p>
              </div>
              <div class="col-md-6">
                <p class="pull-right mb-0">Hand-crafted & made with<i class="fa fa-heart"></i></p>
              </div>
            </div>
          </div>
        </footer>
      </div>
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
  </body>
</html>