<?php

include('../config/db_connect.php');

if (!isset($_COOKIE["user_id"]) && !isset($_COOKIE["session_id"]) && !isset($_COOKIE["userName"])) {

    header("Location: login.php");
} else {
    $user_id = $_COOKIE["user_id"];
    $session_id = $_COOKIE["session_id"];
    $userName = $_COOKIE["userName"];

    $verifySessionId = "SELECT * FROM user WHERE session_id = '$session_id'";

    $result = mysqli_query($conn, $verifySessionId);

    if (mysqli_num_rows($result) > 0) {

        if ($_GET['vid']) {

            $delete_vid_id = $_GET['vid'];

            $sql = "DELETE FROM screen_recordings WHERE video = '$delete_vid_id'";

            if (mysqli_query($conn, $sql)) {

                unlink("../api/files/$delete_vid_id");

                header("Location: index.php");
            }
        }
    } else {
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach ($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time() - 1000);
                setcookie($name, '', time() - 1000, '/');
            }
        }

        header("Location: login.php");
    }
}
