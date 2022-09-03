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
              <h1>Personal Library</h1>
            </div>

            <div class="video-box">
              <div class="image-section">
                <img src="loom-images/personal-image.jpg" alt="" />
              </div>
              <div class="image-info-section">
                <div class="image-info-title">
                  <h3 class="col-name">Send a video</h3>
                  <p class="col-para">
                    Lorem ipsum dolor, sit amet consectetur adipisicing
                    elit. Velit reprehenderit suscipit, mollitia
                    distinctio aliquam incidunt modi eligendi nisi
                    quisquam perferendis.
                  </p>
                  <a href="#" class="col-button">Get Loom for Free</a>
                </div>
              </div>
            </div>

            <div class="personal-infotext">
              <h5><strong>Learn how others are using Loom</strong></h5>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.Quia, quam.</p>
            </div>

            <!--While loop here to fetch the data from the backend-->
            <div class="two-col-videos">
              <div class="col-first">
                <video controls crossorigin playsinline poster="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg">
                  <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-1080p.mp4" type="video/mp4" size="1080" />
                  <a href="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4" download>Download</a>
                </video>
              </div>

              <div class="col-second">
                <video controls crossorigin playsinline poster="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg" class="video2">
                  <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-1080p.mp4" type="video/mp4" size="1080" />
                  <a href="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4" download>Download</a>
                </video>
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