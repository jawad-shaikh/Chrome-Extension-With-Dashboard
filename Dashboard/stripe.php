<?php
require '../vendor/autoload.php';

use Slim\Http\Request;
use Slim\Http\Response;
use \Stripe\Stripe;

if (isset($_POST['packageName'])) {
    $price;
    if ($_POST['packageName'] == 'basic') {
        $price = 2500;
    } elseif ($_POST['packageName'] == 'standard') {
        $price = 5000;
    } elseif ($_POST['packageName'] == 'premium') {
        $price = 10000;
    }



    \Stripe\Stripe::setApiKey('sk_test_4eC39HqLyjWDarjtT1zdp7dc');

    $session = \Stripe\Checkout\Session::create([
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => $_POST['packageName'],
                ],
                'unit_amount' => $price,
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => 'http://localhost/Loom/Dashboard/success.php?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => 'http://localhost/Loom/Dashboard/cancel.php?session_id={CHECKOUT_SESSION_ID}',
    ]);
    
    header("location: " . $session->url);
}
