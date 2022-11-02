<?php

require '../vendor/autoload.php';
include('../config/db_connect.php');h


use Slim\Http\Request;

use Slim\Http\Response;

use \Stripe\Stripe;



if (isset($_POST['packageName'])) {

    $price;
    if ($_POST['packageName'] == 'basic') {
        $price = 25.00;
    } elseif ($_POST['packageName'] == 'standard') {
        $price = 50.00;
    } elseif ($_POST['packageName'] == 'premium') {
        $price = 100.00;
    } else {
        return;
    }






    \Stripe\Stripe::setApiKey('sk_test_4eC39HqLyjWDarjtT1zdp7dc');



    $session = \Stripe\Checkout\Session::create([

        'line_items' => [[

            'price_data' => [

                'currency' => 'usd',

                'product_data' => [

                    'name' => $_POST['packageName']
                ],

                'unit_amount' => $price * 100,

            ],

            'quantity' => 1,

        ]],

        'mode' => 'payment',

        'success_url' => 'https://app.recod.io/Dashboard/success.php?id={CHECKOUT_SESSION_ID}',

        'cancel_url' => 'https://app.recod.io/Dashboard/cancel.php?id={CHECKOUT_SESSION_ID}',

    ]);

    $id = $session->id;
    $UserId = $_COOKIE["user_id"];
    $sql = "INSERT INTO `Transaction`(`UserId`, `StripeTransactionId`, `IsSuccess`) VALUES ($UserId, '$id', 'IsProcessing')";

    $result = mysqli_query($conn, $sql);

    if ($result) {

        header("location: " . $session->url);
    } else {

        header("Location: login.php");
    }
    // header("location: " . $session->url);
}
