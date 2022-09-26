<?php
include "../config/db_connect.php";

header('Access-Control-Allow-Origin: *');

$userId = $_POST['userId'];
$title = $_POST['title'];
$videoToReplace = $_POST['videoToReplace'];
$file_tmp = $_FILES['file']['tmp_name'];

move_uploaded_file($file_tmp, "files/$videoToReplace");

$sql = "UPDATE screen_recordings SET title = '$title' WHERE video = '$videoToReplace'";
mysqli_query($conn, $sql);

echo "$baseUrl/Dashboard/single.php?vid=$videoToReplace";
