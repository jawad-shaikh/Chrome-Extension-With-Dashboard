<?php
if (isset($_GET["id"])) {
    include('../config/db_connect.php');
    $id = $_GET["id"];
    $UserId = $_COOKIE["user_id"];
    $sql = "Update `Transaction` set `IsSuccess` = 'IsProcessing' where StripeTransactionId = '$id' and UserId = $UserId";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("location: dashboard.php");
    } else {
        //TRYING TO HACK
        header("Location: login.php");
    }
?>
    <html>

    <head>

        <title>Thanks for your order!</title>

    </head>



    <body>

        <h1>Thanks for your order!</h1>

        <p>

            We appreciate your business!

            If you have any questions, please email

            <a href="mailto:orders@recod.io">orders@recod.io</a>.

        </p>

    </body>



    </html>
<?php } ?>