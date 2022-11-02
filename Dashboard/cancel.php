<?php
if (isset($_GET["id"])) {
    include('../config/db_connect.php');
    $id = $_GET["id"];
    $UserId = $_COOKIE["user_id"];
    $sql = "Update `Transaction` set `IsCancelled` = 'IsProcessing' where StripeTransactionId = '$id' and UserId = $UserId";
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

        <title>Your Request Was Unable to Be Processed!</title>

    </head>



    <body>

        <h1>Your Request Was Unable to process!</h1>

        <p>

            We Are Sorry For In Convenience

            If you have any questions, please email

            <a href="mailto:orders@recod.io">orders@recod.io</a>.

        </p>

    </body>



    </html>
<?php } ?>