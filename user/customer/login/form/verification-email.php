<?php
        session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect2Local - User Verification</title>
    <link rel="stylesheet" href="/asset/css/form.css">
    <?php include "/connect2local/asset/link/cdn-link.html"; ?>
</head>
<body id="form-body" style="height:100vh;width:100%">
    
        <?php 

                include "../../../../component/form-alert.php";
                unset($_SESSION['error']);
        ?>
        <form action="/user/customer/login/code/email_verification_check.php" method="POST" class="d-flex flex-column justify-content-center align-items-center p-2" style="height:90vh;width:100%;">
            <?php include "../../../../component/message-alert.php"; ?>


            <fieldset class="border p-4 rounded-2 text-white col-lg-5 col-md-9 col-12" id="register-form">
                <legend class="text-center fs-3 fw-bold my-4 text-white">User Verification</legend>
                <div class="mt-2">
                    <input type="email" name="email" class="form-control py-2 border border-2 border-dark" placeholder="Enter Email Address" id="email" required>
                </div>
                <div class="mt-2 d-flex justify-content-end px-2">
                    <?php
                                if(isset($_SESSION['verification-email']) && $_SESSION['verification-email'] != ""){
                                    $email = $_SESSION['verification-email'];
                                    ?>
                    <a href="/user/customer/login/code/resend-link.php?resend_link=1&email=<?php echo $email; ?>" class="nav-link text-white">Resend Link</a>
                    
                    <?php
                                }
                    ?>
                </div>
                <div class="mt-4 d-flex justify-content-center">
                    <input type="submit" name="submit" value="Submit" id="register-btn" class="btn border text-white py-2 px-5 rounded-pill" >
                </div>
            </fieldset>
        </form>
    
    
   
   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>