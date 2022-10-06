<?php

include('../config/db_connect.php');

if (isset($_COOKIE["user_id"]) && isset($_COOKIE["session_id"]) && isset($_COOKIE["userName"])) {

  $user_id = $_COOKIE["user_id"];
  $session_id = $_COOKIE["session_id"];
  $userName = $_COOKIE["userName"];

  $verifySessionId = "SELECT * FROM user WHERE session_id = '$session_id' AND user_id = $user_id";

  $result = mysqli_query($conn, $verifySessionId);

  if (mysqli_num_rows($result) > 0) {
    header("Location: index.php");
  } else {

    if (isset($_SERVER['HTTP_COOKIE'])) {
      $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
      foreach ($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time() - 1000);
        setcookie($name, '', time() - 1000, '/');
      }
    }

    header("Location: login.php");
  }
}

if (isset($_POST['submit'])) {

  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM user WHERE user_email ='{$email}' AND user_pass='{$password}'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {

    $data = mysqli_fetch_assoc($result);

    $user_id = $data["user_id"];
    $session_id = $data["session_id"];
    $userName = $data["user_name"];

    setcookie("user_id", $user_id, time() + (86400 * 30), "/");
    setcookie("session_id", $session_id, time() + (86400 * 30), "/");
    setcookie("userName", $userName, time() + (86400 * 30), "/");

    header("Location: index.php");
  } else {

    $error = "Email or Password are Wrong.";
  }
}



if (isset($_GET['token'])) {

  $token = $_GET['token'];



  $sql = "SELECT * FROM user WHERE token ='{$token}'";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {

    $data = mysqli_fetch_assoc($result);

    $user_id = $data["user_id"];
    $session_id = $data["session_id"];
    $userName = $data["user_name"];

    setcookie("user_id", $user_id, time() + (86400 * 30), "/");
    setcookie("session_id", $session_id, time() + (86400 * 30), "/");
    setcookie("userName", $userName, time() + (86400 * 30), "/");

    header("Location: index.php");
  }
}



?>



<!DOCTYPE html>

<html lang="zxx">







<meta http-equiv="content-type" content="text/html;charset=UTF-8" />



<head>

  <meta charset="utf-8" />

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <title>Login</title>

  <link rel="stylesheet" href="css/bootstrap.min.css" />

  <link rel="stylesheet" href="css/style.css" />

  <link rel="stylesheet" href="css/login.css" />

  <link rel="shortcut icon" href="loom-images/favicon.ico" type="image/x-icon">

</head>



<body class="crm_body_bg">

  <!--Loader-->

  <div class="loader">

    <span>R</span>

    <span>E</span>

    <span>C</span>

    <span>O</span>

    <span>D</span>

  </div>



  <!--Loader-->



  <!--Header-->

  <header class="header-lm">

    <a href="index.html" class="anim"><img src="loom-images/loom-logo.png" alt="logo" width="50px" /></a>

  </header>

  <!--/Header-->



  <!--Login Section-->

  <div class="login-section anim">

    <div class="modal-content cs_modal">

      <div class="modal-header justify-content-center theme_bg_1">

        <h5 class="modal-title text_white" style="text-align: left">

          Sign in to Recod

        </h5>

      </div>

      <div class="modal-body">

        <?php

        if (isset($error)) {

          echo "<div class='alert alert-danger' id='error'>$error</div>";
        }

        ?>

        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

          <div class="form-group">

            <input type="email" class="form-control" placeholder="Enter your email" name="email" required />

          </div>

          <div class="form-group">

            <input type="password" class="form-control" placeholder="Password" name="password" required />

          </div>

          <input class="btn_1 full_width text-center" type="submit" name="submit" value="Login">

          <p>

            Need an account?

            <a href="signup.php">Sign Up</a>

          </p>

          <!-- <div class="text-center">

            <a href="#" data-toggle="modal" data-target="#forgot_password" data-dismiss="modal" class="pass_forget_btn">Forget Password?</a>

          </div> -->

        </form>

      </div>

    </div>

  </div>

  <!--Login Section-->



  <!--Gsap-->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.0/gsap.min.js"></script>

  <!-- jquery slim -->

  <script src="js/jquery-3.4.1.min.js"></script>

  <!-- popper js -->

  <script src="js/popper.min.js"></script>

  <!-- bootstarp js -->

  <script src="js/bootstrap.min.js"></script>

  <!--Login js-->

  <script src="js/login.js"></script>

</body>



</html>