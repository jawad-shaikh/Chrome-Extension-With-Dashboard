<?php



$conn = mysqli_connect('premium15', 'aetsqfgb_jawad', 'darkssj123', 'aetsqfgb_recod');



if (!$conn) {

    echo 'Connection error: ' . mysqli_connect_error();

}

$baseUrl = 'https://app.recod.io';

