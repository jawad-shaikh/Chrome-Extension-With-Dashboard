<?php
include "../config/db_connect.php";

header('Access-Control-Allow-Origin: *');

$userId = $_POST['userId'];
$title = $_POST['title'];
$file_tmp = $_FILES['file']['tmp_name'];

$rendom_letters_one = uniqid();
$rendom_letters_two = uniqid();

move_uploaded_file($file_tmp, "files/$rendom_letters_one$rendom_letters_two.mp4");

$sql = "INSERT INTO `screen_recordings`(`user_id`, `video`, `title`) VALUES ('{$userId}','$rendom_letters_one$rendom_letters_two.mp4', '$title')";
mysqli_query($conn, $sql);

echo "$baseUrl/Dashboard/single.php?vid=$rendom_letters_one$rendom_letters_two.mp4";
