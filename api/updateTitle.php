<?php

include "../config/db_connect.php";

header('Access-Control-Allow-Origin: *');

if (isset($_POST['userId'])) {
    $userId = $_POST['userId'];
}

$title = $_POST['title'];

$videoToReplace = $_POST['videoToReplace'];

$sql = "UPDATE screen_recordings SET title = '$title' WHERE video = '$videoToReplace'";

mysqli_query($conn, $sql);

echo "$baseUrl/Dashboard/single.php?vid=$videoToReplace";
