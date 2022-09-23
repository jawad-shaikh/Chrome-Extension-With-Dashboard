<?php
include('../config/db_connect.php');

session_start();
if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
}

if ($_GET['vid']) {
    $delete_vid_id = $_GET['vid'];
    $sql = "DELETE FROM screen_recordings WHERE video = '$delete_vid_id'";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
    }
}
