<?php
include('config/db_connect.php');

session_start();
if (!isset($_SESSION['userId'])) {
  header("Location: login.php");
}

if (isset($_GET['vid'])) {
  $userId = $_SESSION['userId'];
  $vid = mysqli_real_escape_string($conn, $_GET['vid']);

  $sql = "SELECT * FROM screen_recordings WHERE user_id = $userId AND video = '$vid'";

  $result = mysqli_query($conn, $sql);

  $video = mysqli_fetch_assoc($result);

  mysqli_free_result($result);
  mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="zxx">

<?php include "partials/header.php"; ?>
<style>
  .plyr {
    width: 85% !important;
  }
</style>
<div class="main_content_iner anim">
  <div class="container-fluid p-0">
    <div class="row">
      <div class="col-lg-12">
        <div class="video-outside anim">

          <?php if ($video) : ?>

            <video controls>
              <source src="<?php echo "../api/files/" . $video['video'] ?>" class="Videosrc" type="video/mp4" size="1080" />
              <a href="<?php echo "../api/files/" . $video['video'] ?>" download>Download</a>
            </video>

          <?php else : ?>
            <h4>No such video exists.</h4>
          <?php endif ?>

          <!-- <div class="video-action-parent">
            <div class="video-actions">
              <div class="emojies">
                <a href="#" class="interaction-link">😂 <span class="it-title">15</span></a>
                <a href="#" class="interaction-link">😍 <span class="it-title">25</span></a>
                <a href="#" class="interaction-link">😮 <span class="it-title">32</span></a>
                <a href="#" class="interaction-link">🙌 <span class="it-title">12</span></a>
                <a href="#" class="interaction-link">👍 <span class="it-title">24</span></a>
                <a href="#" class="interaction-link">👎 <span class="it-title">14</span></a>
              </div>
              <div class="comment onmediatab">
                <ion-icon name="chatbox-outline"></ion-icon>
                <a href="#commentArea">Comment</a>
              </div>
              <div class="record-comment onmediatab">
                <ion-icon name="videocam-outline"></ion-icon>
                <a href="#">Record a Comment</a>
              </div>
            </div>
          </div> -->

          <!--Video Information-->

          <!-- <div class="video-info-section">
            <h1 class="video-title">
              Domain Name Search | Free Check Domain Availability Tool
              -<br />Namecheap - 12 August 2022
            </h1>

            <div class="uploader-info">
              <img src="sources/profile.jpg" alt="" />
              <span class="uploader-details">
                <h4 class="uploader-name">A ChatterJE</h4>
                <span class="date">August 12, 2022 .
                  <span class="status">Not Posted</span></span>
              </span>
            </div> -->

          <!--Comments Area-->
          <!-- <div class="comment-area-title">
              <h4>Comments</h4>
            </div>
            <div class="comment-area">
              <div class="comment-x">
                <span class="userprofile">R</span>
                <span class="comment-details">
                  <h4 class="comment-username">
                    <strong>A ChatterJE</strong> at 0:02
                  </h4>
                  <div class="comment-text">Hi, What's up!</div>
                  <span class="date">5 days ago</span>
                </span>
              </div>

              <div class="comment-interaction">
                <span class="comment-button-box" id="commentArea">
                  <ion-icon name="chatbubble-outline"></ion-icon><button class="comment-button">Comment</button>
                </span>
                <form action="" class="form-comment">
                  <input type="text" class="comment-input" placeholder="Comment.." />
                  <button type="submit" class="comment-submit">
                    <ion-icon name="chevron-forward-outline"></ion-icon>
                  </button>
                </form>
              </div>
            </div> -->
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php include "partials/footer.php"; ?>
<script src="js/single.js"></script>

</html>