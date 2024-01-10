<?php
session_start();

require_once('database/init_db.php');
$db = new fileSharing("localhost", "safe_pdf", "root", "");

// Handle User Login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $username = $_POST['username'];
  $password = $_POST['password'];

  if ($_POST['auth'] == 'login') {
    $data = $db->login($username, $password);
  } else if ($_POST['auth'] == 'register') {
    $data = $db->register($username, $password);
  } else {
    $data = 'ngapain';
  }
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
  <title>Login - ShareKeun</title>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../assets/css/fontawesome.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/icofont.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/feather-icon.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/animate.css">
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
    <!-- login page start-->
    <div class="container-fluid p-0">
      <div class="authentication-main">
        <div class="row">
          <div class="col-md-12">
            <div class="auth-innerright">
              <div class="authentication-box">
                <div class="card-body p-0">
                  <div class="cont text-center">
                    <div>
                      <!-- LOGIN FORM -->
                      <form method="POST" action="auth.php" class="theme-form">
                        <h4>Login </h4>
                        <h6>Enter your Username and Password</h6>
                        <?php echo $data['message'] ?>
                        <div class="form-group">
                          <label class="col-form-label pt-0">Username</label>
                          <input class="form-control" name="username" type="text" required="">
                        </div>
                        <div class="form-group">
                          <label class="col-form-label">Password</label>
                          <input class="form-control" name="password" type="password" required="">
                        </div>
                        <div class="checkbox p-0">
                          <input id="checkbox1" type="checkbox">
                          <label for="checkbox1">Remember me</label>
                        </div>
                        <div class="form-group form-row mt-3 mb-0">
                          <input type="hidden" name="auth" value="login">
                          <button class="btn btn-primary btn-block" type="submit">LOGIN</button>
                        </div>
                        <hr>
                      </form>
                    </div>
                    <div class="sub-cont">
                      <div class="img">
                        <div class="img__text m--up">
                          <h2>New here?</h2>
                          <p>Sign up and discover great amount of new opportunities!</p>
                        </div>
                        <div class="img__text m--in">
                          <h2>One of us?</h2>
                          <p>If you already has an account, just sign in. We've missed you!</p>
                        </div>
                        <div class="img__btn">
                          <span class="m--up">Sign up</span>
                          <span class="m--in">Sign in</span>
                        </div>
                      </div>
                      <div>
                        <!-- REGISTER FORM -->
                        <form action="auth.php" method="POST" class="theme-form">
                          <h4 class="text-center">NEW USER</h4>
                          <h6 class="text-center">Enter your Username and Password For Signup</h6>
                          <?php echo $data['message']; ?>
                          <div class="form-group">
                            <input class="form-control" name="username" type="text" placeholder="User Name">
                          </div>
                          <div class="form-group">
                            <input class="form-control" name="password" type="password" placeholder="Password">
                          </div>
                          <div class="form-row">
                            <div class="col-sm-4">
                              <input type="hidden" name="auth" value="register">
                              <button class="btn btn-primary" type="submit">Sign Up</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/js/jquery-3.5.1.min.js"></script>
  <script src="../assets/js/bootstrap/popper.min.js"></script>
  <script src="../assets/js/bootstrap/bootstrap.js"></script>
  <script src="../assets/js/icons/feather-icon/feather.min.js"></script>
  <script src="../assets/js/icons/feather-icon/feather-icon.js"></script>
  <script src="../assets/js/sidebar-menu.js"></script>
  <script src="../assets/js/config.js"></script>
  <script src="../assets/js/login.js"></script>
  <script src="../assets/js/script.js"></script>
</body>

</html>