<?php
include('../config/db_connect.php');

session_start();
if (!isset($_SESSION['userId'])) {
  $userNotLoggedIn = true;
}

if (isset($_GET['vid'])) {
  $vid = mysqli_real_escape_string($conn, $_GET['vid']);

  // fetching video
  $fetchVid = "SELECT sr.id, sr.user_id, sr.created_at, sr.video, sr.title, u.user_name FROM screen_recordings sr INNER JOIN user u on u.user_id = sr.user_id  WHERE sr.video = '$vid'";

  $fetchVidResult = mysqli_query($conn, $fetchVid);

  $video = mysqli_fetch_assoc($fetchVidResult);

  if ($video) {
    // fetching comments
    $videoId = $video['id'];
    $fetchComments = "SELECT c.comment, c.created_at, u.user_name FROM comments c LEFT JOIN user u ON c.user_id = u.user_id WHERE video_id = $videoId";

    $fetchCommentsResuilt = mysqli_query($conn, $fetchComments);

    $comments = mysqli_fetch_all($fetchCommentsResuilt);
  }

  mysqli_close($conn);
} else {
  $video = null;
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

            <!--Video Information-->

            <div class="video-info-section">
              <h1 class="video-title">
                <?= $video['title'] ?>
              </h1>

              <div class="uploader-info">
                <span class="userprofile" style="padding: 22px;">
                  <strong style="font-size: 25px;">
                    <?php
                    echo strtoupper(substr($video['user_name'], 0, 1))
                    ?>
                  </strong>
                </span>
                <span class="uploader-details">
                  <h4 class="uploader-name"><?= $video['user_name'] ?></h4>
                  <span class="date"><?= $video['created_at'] ?></span>
                </span>
              </div>

              <!--Comments Area-->
              <div class="comment-area-title">
                <h4>Comments</h4>
              </div>
              <div class="comment-interaction">
                <span class="comment-button-box" id="commentArea">
                  <ion-icon name="chatbubble-outline"></ion-icon><button class="comment-button">Comment</button>
                </span>
                <form class="form-comment">
                  <input type="text" class="comment-input" id="commentInput" placeholder="Comment.." />
                  <input type="hidden" class="userName" value="<?php if (isset($_SESSION['userName'])) {
                                                                  echo $_SESSION['userName'];
                                                                } else {
                                                                  echo "guest";
                                                                } ?>">
                  <input type="hidden" class="userID" value="<?php if (isset($_SESSION['userId'])) {
                                                                echo $_SESSION['userId'];
                                                              } else {
                                                                echo "";
                                                              } ?>">
                  <input type="hidden" class="videoID" value="<?= $video['id'] ?>" />
                  <button type="submit" class="comment-submit" id="publishComment">
                    <ion-icon name="chevron-forward-outline"></ion-icon>
                  </button>
                </form>
              </div>

              <div class="comment-area">
                <?php foreach ($comments as $comment) : ?>
                  <div class="comment-x">
                    <span class="userprofile">
                      <strong>
                        <?php if ($comment[2] == "") {
                          echo "G";
                        } else {
                          echo strtoupper(substr($comment[2], 0, 1));
                        }  ?>
                      </strong>
                    </span>
                    <span class="comment-details">
                      <h4 class="comment-username">
                        <strong>
                          <?php if ($comment[2] == "") {
                            echo "guest";
                          } else {
                            echo $comment[2];
                          } ?>
                        </strong>
                      </h4>
                      <div class="comment-text"><?php echo $comment[0] ?></div>
                      <span class="date"><?php echo $comment[1] ?></span>
                    </span>
                  </div>
                <?php endforeach; ?>
              </div>

            <?php else : ?>
              <h4>No such video exists.</h4>
            <?php endif; ?>

            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include "partials/footer.php"; ?>
<script src="js/single.js"></script>

</html>