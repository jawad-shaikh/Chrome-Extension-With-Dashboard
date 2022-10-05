<head>

  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

  <!-- Required meta tags -->

  <meta charset="utf-8" />

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <title>Video</title>

  <!--Stylesheets-->

  <link rel="icon" href="img/logo.png" type="image/png" />

  <link rel="stylesheet" href="css/bootstrap.min.css" />

  <link rel="stylesheet" href="css/style.css" />

  <link rel="stylesheet" href="https://unpkg.com/plyr@3/dist/plyr.css" />

  <link rel="stylesheet" href="css/index.css">

  <link rel="shortcut icon" href="loom-images/favicon.ico" type="image/x-icon">

</head>



<body class="crm_body_bg">

  <!--PreLoader-->

  <div class="loader">

    <span>R</span>

    <span>E</span>

    <span>C</span>

    <span>O</span>

    <span>D</span>

  </div>



  <!--/Preloeader-->



  <?php include "sidebar.php"; ?>



  <!--/ sidebar  -->



  <section class="main_content dashboard_part large_header_bg">

    <!-- menu  -->

    <div class="container-fluid no-gutters">

      <div class="row">

        <div class="col-lg-12 p-0">

          <div class="header_iner d-flex justify-content-between align-items-center anim">

            <?php if (!isset($userNotLoggedIn)) { ?>

              <h1 class="media-manual">Hello, <span class="name-pill"><?php echo $_COOKIE["userName"] ?></span></h1>

              <!-- <h2>100/100</h2> -->

            <?php } ?>

            <div class="sidebar_icon d-lg-none">

              <ion-icon name="menu-outline"></ion-icon>

            </div>

            <div class="serach_field-area d-flex align-items-center">

              <div class="search_inner">

                <form action="#" style="visibility: hidden">

                  <div class="search_field">

                    <input type="text" placeholder="Search here..." />

                  </div>

                  <button type="submit">

                    <img src="img/icon/icon_search.svg" alt="" />

                  </button>

                </form>

              </div>

              <span class="f_s_14 f_w_400 ml_25 white_text text_white">Apps</span>

            </div>

            <div class="header_right d-flex justify-content-between align-items-center">

              <div class="header_notification_warp d-flex align-items-center">

                <?php

                if (basename($_SERVER['PHP_SELF']) == 'single.php') {

                ?>

                  <li class="anim">

                    <a class="nav-link-notify onmediatab downloadlink" href="#">

                      <ion-icon name="download-outline"></ion-icon>

                    </a>

                  </li>

                  <li class="anim">

                    <a class="nav-link-notify onmediatab copylink" href="#">

                      <ion-icon name="link-outline"></ion-icon>

                    </a>

                  </li>

                <?php } ?>

                <?php if (isset($userNotLoggedIn)) : ?>

                  <li class="anim">

                    <a class="btn btn-primary" href="signup.php">

                      sign up for free

                    </a>

                  </li>

                <?php endif; ?>

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

    <!--/ menu  -->