<?php
include "../config/db_connect.php";

header('Access-Control-Allow-Origin: *');


$userId = $_POST['userId'];
$videoId = $_POST['videoId'];
$comment = $_POST['comment'];


$sql = "INSERT INTO `comments`(`user_id`, `video_id`, `comment`) VALUES ('$userId','$videoId', '$comment')";
mysqli_query($conn, $sql);

echo "Success";