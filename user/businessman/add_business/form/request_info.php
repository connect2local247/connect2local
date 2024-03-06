<?php

    session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect2Local - Request Page</title>
    <link rel="stylesheet" href="/asset/css/form.css">
    <?php include "/connect2local/asset/link/cdn-link.html"; ?>
</head>
<body class="d-flex flex-column justify-content-center align-items-center p-3 bg-dark text-white" style="height:100vh;width:100%">

    <?php include "/connect2local/component/message-alert.php"; ?>

    <h1 class="text-center fw-bold">Thank's For Submitting Your Request</h1>
    <p class="fs-5 text-center">Your request has been sent to us and we will check & verify your detail for correction and you will got reply from us within 48 hour in your mailbox.</p>
    <?php
            if(isset($_GET['source'])){
    ?>
    <a href="/user/businessman/dashboard/dashboard.php" class="btn btn-warning py-3 px-4 fs-5">Back to Dashboard</a>
    <?php
            } else{

            
    ?>
    <a href="/index.php" class="btn btn-warning py-3 px-4 fs-5">Back to Home</a>

    <?php
            }
    ?>
</body>
</html>