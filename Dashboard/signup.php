<?php

include('../config/db_connect.php');



if (isset($_POST['submit'])) {

  $username = $_POST['username'];

  $email = $_POST['email'];

  $password = $_POST['password'];



  if ($username != "" && $email != ""  && $password != "") {

    $sql = "SELECT * FROM user WHERE user_email='{$email}'";

    $res = mysqli_query($conn, $sql);

    if (!mysqli_num_rows($res) > 0) {

      $token = bin2hex(random_bytes(16));
      $session_id = bin2hex(random_bytes(16));

      $sql = "INSERT INTO `user`(`user_name`, `session_id`, `user_email`, `user_pass`, `token`) VALUES ('$username', '$session_id', '$email', '$password', '$token')";

      $result = mysqli_query($conn, $sql);

      if ($result) {

        header("Location: login.php");
      } else {

        $error = "Something Wrong Went.";
      }
    } else {

      $error = "Email Already Exists.";
    }
  } else {

    $error = "Please fill all the fields.";
  }
}

?>







<!DOCTYPE html>

<html lang="zxx">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />



<head>

  <meta charset="utf-8" />

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <title>Sign Up</title>

  <link rel="icon" href="img/favicon.png" type="image/png" />

  <link rel="stylesheet" href="css/bootstrap.min.css" />

  <link rel="stylesheet" href="css/style.css" />

  <link rel="stylesheet" href="css/login.css" />

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

    <a href="index.html" class="anim"><img src="loom-images/loom-logo.png" alt="logo"  width="50px" /></a>

    <a href="login.php" class="signBtn anim">Login Here</a>

  </header>

  <!--/Header-->



  <!--Login Section-->

  <div class="login-section anim">

    <div class="modal-content cs_modal">

      <div class="modal-header justify-content-center theme_bg_1">

        <h5 class="modal-title text_white" style="text-align: left">

          Sign up to Recod

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

            <input type="text" class="form-control" placeholder="Enter your Name" name="username" />

          </div>

          <div class="form-group">

            <input type="email" class="form-control" placeholder="Enter your Email" name="email" />

          </div>

          <div class="form-group">

            <input type="password" class="form-control" placeholder="Password" name="password" />

          </div>

          <div class="form-group">

            <input type="submit" class="btn_1 full_width text-center" name="submit" value="Create Account" />

            <!-- <a href="" class="btn_1 full_width text-center" name="submit">Sign Up</a> -->

          </div>

          <p>

            Already have an account?

            <a href="login.php">Log in</a>

          </p>

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