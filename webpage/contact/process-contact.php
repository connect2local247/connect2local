<?php
session_start();
if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $description = $_POST['description'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/asset/css/style.css">
    <?php include "../../asset/link/cdn-link.html"; ?>
</head>
<body id="home-body">
        <?php include "../../component/navbar.php";?>
        <div class="container d-flex justify-content-center align-items-center" style="min-height:100vh">
        <div class="greeting-content d-flex m-auto flex-column text-white">
    <h1 class="text-center">Thank you, <?php echo $fname ?> for reaching out!</h1>
    <p style="text-align:justify">We appreciate you taking the time to fill out our contact form. Our team is dedicated to providing you with the information you need and resolving any issues you may have with our platform. Please select your preferred method of contact from the options below:</p>
    <div class="button-container d-flex mx-auto" style="gap:10px">
        <button class="btn btn-outline-info" id="email-btn" style="height:50px;width:120px" onclick="location.href='mailto:connect2local247@gmail.com'">Email</button>
        <button class="btn btn-outline-warning" id="phone-btn" style="height:50px;width:120px" onclick="location.href='tel:9723884857'">Phone</button>
    </div>
</div>

        </div>
        <?php include "../../component/footer.php"; ?>
</body>
</html>

