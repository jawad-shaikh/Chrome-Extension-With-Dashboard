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
    <div class="row text-center">
        <h1 class="text-center d-block w-100 py-5">Pricing</h1>
    </div>
<div class="pricing-wrapper">
        <div class="card-box">
          <div class="card text-center">
            <div class="title">
              <i class="fa fa-paper-plane" aria-hidden="true"></i>
              <h2>Basic</h2>
            </div>
            <div class="price">
              <h4><sup>$</sup>25</h4>
            </div>
            <div class="option">
              <ul>
              <li> <i class="fa fa-check" aria-hidden="true"></i> 10 GB Space </li>
              <li> <i class="fa fa-check" aria-hidden="true"></i> 3 Domain Names </li>
              <li> <i class="fa fa-check" aria-hidden="true"></i> 20 Email Address </li>
              <li> <i class="fa fa-times" aria-hidden="true"></i> Live Support </li>
              </ul>
            </div>
            <a href="#">Order Now </a>
          </div>
        </div>
        <!-- END Col one -->
        <div class="card-box">
          <div class="card text-center">
            <div class="title">
              <i class="fa fa-plane" aria-hidden="true"></i>
              <h2>Standard</h2>
            </div>
            <div class="price">
              <h4><sup>$</sup>50</h4>
            </div>
            <div class="option">
              <ul>
              <li> <i class="fa fa-check" aria-hidden="true"></i> 50 GB Space </li>
              <li> <i class="fa fa-check" aria-hidden="true"></i> 5 Domain Names </li>
              <li> <i class="fa fa-check" aria-hidden="true"></i> Unlimited Email Address </li>
              <li> <i class="fa fa-times" aria-hidden="true"></i> Live Support </li>
              </ul>
            </div>
            <a href="#">Order Now </a>
          </div>
        </div>
        <!-- END Col two -->
        <div class="card-box">
          <div class="card text-center">
            <div class="title">
              <i class="fa fa-rocket" aria-hidden="true"></i>
              <h2>Premium</h2>
            </div>
            <div class="price">
              <h4><sup>$</sup>100</h4>
            </div>
            <div class="option">
              <ul>
              <li> <i class="fa fa-check" aria-hidden="true"></i> Unlimited GB Space </li>
              <li> <i class="fa fa-check" aria-hidden="true"></i> 30 Domain Names </li>
              <li> <i class="fa fa-check" aria-hidden="true"></i> Unlimited Email Address </li>
              <li> <i class="fa fa-check" aria-hidden="true"></i> Live Support </li>
              </ul>
            </div>
            <a href="#">Order Now </a>
          </div>
        </div>
      </div>
</div>
</div>
<?php include "partials/footer.php"; ?>
<script src="js/personal.js"></script>

</html>