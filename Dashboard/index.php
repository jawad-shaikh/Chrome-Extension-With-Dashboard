<?php
include('../config/db_connect.php');

session_start();
if (!isset($_SESSION['userId'])) {
  header("Location: login.php");
}

$userId = $_SESSION['userId'];

$sql = "SELECT * FROM screen_recordings WHERE user_id = $userId ORDER BY created_at";

$result = mysqli_query($conn, $sql);

$videos = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);

mysqli_close($conn);

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
              <?php
              foreach ($videos as $video) :
              ?>

                <div class="col-first">
                  <video>
                    <source src="<?php echo "../api/files/" . $video['video'] ?>" type="video/mp4" size="1080" />
                    <a href="<?php echo "../api/files/" . $video['video'] ?>" download>Download</a>
                  </video>
                  <a href="single.php?vid=<?php echo $video['video'] ?>" class="video-goto">
                    <ion-icon name="play-outline"></ion-icon>
                  </a>
                  <div class="video-title">
                    <span><?php echo substr($video['title'], 0, 35) . "..."; ?></span>
                  </div>
                  <div class="date-area">
                    <span><?php echo $video['created_at'] ?></span>
                  </div>
                </div>

              <?php
              endforeach;
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