<?php
header('Access-Control-Allow-Origin: *');
include "../config/db_connect.php";

$l_email = $_POST["login_email"];
$l_pass = $_POST["login_pass"];

// echo json_encode(["name" => $l_email]);
// return;

$sql = 'SELECT * FROM user WHERE user_email="' . $l_email . '" && user_pass="' . $l_pass . '"';
$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) > 0) {
  $data = mysqli_fetch_assoc($res);
  $JSON = json_encode($data);
  echo $JSON;
} else {
  echo 0;
}
