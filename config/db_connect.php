<?php

$conn = mysqli_connect('localhost', 'root', '', 'loom');

if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
}
$baseUrl = 'http://localhost/Loom';
