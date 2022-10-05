<?php

include('../config/db_connect.php');

if (!isset($_COOKIE["user_id"]) && !isset($_COOKIE["session_id"]) && !isset($_COOKIE["userName"])) {

  header("Location: login.php");
} else {
  $user_id = $_COOKIE["user_id"];
  $session_id = $_COOKIE["session_id"];
  $userName = $_COOKIE["userName"];

  $verifySessionId = "SELECT * FROM user WHERE session_id = '$session_id'";

  $result = mysqli_query($conn, $verifySessionId);

  if (mysqli_num_rows($result) > 0) {

    $sql = "SELECT * FROM screen_recordings WHERE user_id = $user_id ORDER BY created_at";

    $result = mysqli_query($conn, $sql);

    $videos = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);

    mysqli_close($conn);
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


?>



<!DOCTYPE html>

<html lang="zxx">



<?php include "partials/header.php"; ?>

<div class="main_content_iner anim">

  <div class="container-fluid p-0">

    <div class="row">

      <div class="col-lg-12">

        <div class="container-wrapper">

          <div class="child-wrapper">

            <div class="page-heading">

              <h1>My Videos</h1>

            </div>

            <div class="two-col-videos">

              <?php if (count($videos) == 0) { ?>

                <h3>No videos to show...</h3>

                <?php } else {

                foreach ($videos as $video) {

                ?>



                  <div class="col-first">

                    <video>

                      <source src="<?php echo "../api/files/" . $video['video'] ?>" type="video/mp4" size="1080" />

                      <a href="<?php echo "../api/files/" . $video['video'] ?>" download>Download</a>

                    </video>

                    <a href="single.php?vid=<?php echo $video['video'] ?>" class="video-goto">

                      <ion-icon name="play-outline"></ion-icon>

                    </a>

                    <a href="deleteVid.php?vid=<?php echo $video['video'] ?>" onclick="return confirm('Are you sure you want to delete a video?')" class="delete-bt">

                      <ion-icon name="trash-outline"></ion-icon>

                    </a>

                    <div class="video-title">

                      <span><?php echo substr($video['title'], 0, 35) . "..."; ?></span>

                    </div>

                    <div class="date-area">

                      <span><?php echo $video['created_at'] ?></span>

                    </div>

                  </div>



              <?php

                }
              }

              ?>



            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

</div>



<?php include "partials/footer.php"; ?>

<script src="js/personal.js"></script>



</html>