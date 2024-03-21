<?php
        session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect2Local - Email Verification</title>
    <link rel="stylesheet" href="/asset/css/form.css">
    <?php include "/connect2local/asset/link/cdn-link.html"; ?>
</head>
<body id="form-body" style="height:100vh;width:100%">
   
        <script>
            path = "/user/businessman/dashboard/dashboard.php";
        </script>
        <?php 

                include "../../../../component/form-alert.php";
                unset($_SESSION['error']);
        ?>

        <form action="/user/businessman/login/code/user_verification_code.php" method="POST" class="d-flex flex-column justify-content-center align-items-center p-2" style="height:90vh;width:100%;">
            
            <?php include "/connect2local/component/message-alert.php"; ?>

            <fieldset class="border border-light p-4 rounded-2 text-white col-lg-5 col-md-9 col-12" id="register-form">
                <legend class="text-center fs-3 fw-bold my-4 text-white">User Verification</legend>
                <div class="mt-2">
                    <input type="text" name="user-code" class="form-control py-2 border border-2 border-dark" placeholder="Enter Verification Code" id="otp" value="<?php if(isset($_SESSION['user-code'])) echo $_SESSION['user-code'];?>" required>
                </div>
                <div class="mt-2 d-flex justify-content-end px-2">
                    <a href="/user/businessman/login/code/resend-code.php?resend_code=1" class="nav-link text-white">Resend Code</a>
                </div>
                <div class="mt-3 d-flex justify-content-center">
                    <input type="submit" name="submit" value="Submit" id="register-btn" class="btn text-white py-3 px-5 border rounded-pill" style="width:150px" >
                </div>
            </fieldset>
        </form>

        <?php include "/connect2local/component/form-footer.php"; ?>
</body>
</html>