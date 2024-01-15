<?php
    session_start();

    // Check the code attempt limit
    if (!isset($_SESSION['code_attempts'])) {
        $_SESSION['code_attempts'] = 0;
    }

    // Set the expiration time (30 seconds in this example)
    $expirationTime = 30;

    // Check if the code has expired
    if (isset($_SESSION['code_timestamp'])) {
        $currentTime = time();
        $elapsedTime = $currentTime - $_SESSION['code_timestamp'];

        // If the elapsed time is greater than the expiration time, reset the session variables
        if ($elapsedTime > $expirationTime) {
            unset($_SESSION['user-code']);
            unset($_SESSION['code_timestamp']);
        }
    }
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
        path = "/user/admin/dashboard/dashboard.php";
    </script>

    <?php 
        include "../../../../component/form-alert.php";
        unset($_SESSION['error']);
    ?>

    <form action="/user/admin/login/code/verification.php" method="POST" class="d-flex flex-column justify-content-center align-items-center p-2" style="height:90vh;width:100%;">
        <?php include "/connect2local/component/message-alert.php"; ?>

        <fieldset class="border border-light p-4 rounded-2 text-white col-lg-5 col-md-9 col-12" id="register-form">
            <legend class="text-center fs-3 fw-bold my-4 text-white">Admin Verification</legend>
            <div class="mt-2">
                <input type="text" name="user-code" class="form-control py-2 border border-2 border-dark" placeholder="Enter Security Key" id="otp" value="<?php if(isset($_SESSION['user-code'])) echo $_SESSION['user-code'];?>" <?php if(isset($_SESSION['code_timestamp']) && (time() - $_SESSION['code_timestamp'] > $expirationTime)) echo 'disabled'; ?> required>
            </div>
            <div class="mt-2" id="expirationMessage" <?php if(!(isset($_SESSION['code_timestamp']) && (time() - $_SESSION['code_timestamp'] <= $expirationTime))) echo 'style="display:none;"'; ?>>
                Code Expires in <span id="countdownMessage"></span> seconds
            </div>
            <div class="mt-2 d-flex justify-content-end px-2">
                <a href="/user/admin/login/code/resend-security-key.php?resend_key=1" class="nav-link text-white" id="resendSecurityKey" <?php if(isset($_SESSION['code_timestamp']) && (time() - $_SESSION['code_timestamp'] <= $expirationTime)) echo 'style="display:none;"'; ?>>Resend Code</a>
                <script src="/asset/js/timeout.js"></script>
            </div>
            <div class="mt-3 d-flex justify-content-center">
                <input type="submit" name="submit" value="Submit" id="register-btn" class="btn text-white py-3 px-5 border rounded-pill" style="width:150px">
            </div>
        </fieldset>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var resendSecurityKey = document.getElementById("resendSecurityKey");
            var expirationMessage = document.getElementById("expirationMessage");

            // Function to show the Resend Code link and hide the expiration message
            function showResendLink() {
                resendSecurityKey.style.display = "inline";
                expirationMessage.style.display = "none";
            }

            // Function to hide the Resend Code link and show the expiration message
            function showExpirationMessage() {
                resendSecurityKey.style.display = "none";
                expirationMessage.style.display = "block";
            }

            // Example countdown logic (you can modify it according to your needs)
            var countdown = <?php echo $expirationTime; ?>;
            var countdownInterval;

            function updateCountdown() {
                document.getElementById("countdownMessage").innerText = countdown;
            }

            function startCountdown() {
                countdownInterval = setInterval(function () {
                    updateCountdown();
                    countdown--;

                    if (countdown <= 0) {
                        clearInterval(countdownInterval);
                        showResendLink();
                    }
                }, 1000);
            }

            // Check if the code has expired
            <?php
                if (isset($_SESSION['code_timestamp']) && (time() - $_SESSION['code_timestamp'] <= $expirationTime)) {
            ?>
                    startCountdown();
            <?php
                } else {
                    showResendLink();
                }
            ?>
        });
    </script>
</body>
</html>
