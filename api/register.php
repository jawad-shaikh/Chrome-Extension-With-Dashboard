<?php

include "../config/db_connect.php";

$u_name = $_POST["user_name"];
$u_email = $_POST["user_email"];
$u_pass = $_POST["user_pass"];


$sql1 =  'SELECT * FROM user WHERE user_email="' . $u_email . '"';
$res = mysqli_query($conn, $sql1);
if (mysqli_num_rows($res) > 0) {
  echo 0;
} else {
  $token = bin2hex(random_bytes(16));
  $sql = "INSERT INTO `user`(`user_name`, `user_email`, `user_pass`, `token`) VALUES ('{$u_name}','{$u_email}','{$u_pass}', '{$token}')";
  if (mysqli_query($conn, $sql)) {
    $user_id = mysqli_insert_id($conn);
    $arr = ['user_id' => $user_id, 'token' => $token];
    $JSON = json_encode($arr);
    echo $JSON;
  }
}
