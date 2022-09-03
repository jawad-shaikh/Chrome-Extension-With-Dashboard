<!DOCTYPE html>
<html lang="zxx">

<?php include "partials/single-header.php"; ?>
<style>video, .plyr{width: 600px !important;}</style>
<div class="main_content_iner anim">
  <div class="container-fluid p-0">
    <div class="row">
      <div class="col-lg-12">
        <div class="container-wrapper">
          <div class="child-wrapper">
          <div class="page-heading">
              <h1>My Videos</h1>
            </div>
            <!--While loop here to fetch the data from the backend-->
            <div class="two-col-videos">
              <div class="col-first">
                <video  crossorigin playsinline poster="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg">
                  <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-1080p.mp4" type="video/mp4" size="1080" />
                  <a href="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4" download>Download</a>
                </video>
                <a href="single.php" class="video-goto"><ion-icon name="play-outline"></ion-icon></a>

                <div class="date-area">
                  <span>Date: 05/08/2022</span>
                </div>

              </div>

              <div class="col-second">
                <video  crossorigin playsinline poster="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg" class="video2">
                  <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-1080p.mp4" type="video/mp4" size="1080" />
                  <a href="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4" download>Download</a>
                </video>
                <a href="single.php" class="video-goto"><ion-icon name="play-outline"></ion-icon></a>

                <div class="date-area">
                  <span>Date: 05/08/2022</span>
                </div>

              </div>
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