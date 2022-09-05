<?php

include "config.php";

$u_name = $_POST["user_name"];
$u_email = $_POST["user_email"];
$u_pass = $_POST["user_pass"];


$sql1 =  'SELECT * FROM user WHERE user_email="' . $u_email . '"';
$res = mysqli_query($conn, $sql1);
if (mysqli_num_rows($res) > 0) {
  echo 0;
} else {
  $sql = "INSERT INTO `user`(`user_name`, `user_email`, `user_pass`) VALUES 
('{$u_name}','{$u_email}','{$u_pass}')";
  if (mysqli_query($conn, $sql))
    echo 1;
}
