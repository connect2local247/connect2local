<?php 
        include "/connect2local/includes/table_query/db_connection.php";
        require "/connect2local/includes/code_generator/code_generator.php";
        require "/connect2local/includes/table_query/get_encrypted_data.php";
        require "/connect2local/includes/security_function/secure_function.php";

        session_start();

        ini_set('display_errors', 0);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Connect2Local - Reset Password</title>
    <link rel="stylesheet" href="/asset/css/style.css">
    <link rel="stylesheet" href="/asset/css/form.css">
    <?php include "/connect2local/asset/link/cdn-link.html"; ?>
</head>
<body id="form-body">
        <script>
            path = "/user/businessman/login/form/login.php";
        </script>
        <?php 

                include "../../../../component/form-alert.php";
                unset($_SESSION['error']);
        ?>
<?php

        if(isset($_GET['verification_token'])){
            if($_GET['verification_token'] != "" ){
               $verification_token = $_GET['verification_token'];
               $query = "SELECT B_VERIFICATION_TOKEN FROM business_verification WHERE B_VERIFICATION_TOKEN = '$verification_token' ";
               
               $result = mysqli_query($GLOBALS['connect'],$query);
               
               $_SESSION['verification-token'] = $verification_token;
               $email = get_email_from_token($verification_token,"business_verification","business_register","B_VERIFICATION_TOKEN","B_KEY","B_ID");
               
               
               if(mysqli_num_rows($result) > 0){
                   
?>

<form action="/user/businessman/login/code/reset-password-logic.php" method="POST" class="d-flex flex-column align-items-center justify-content-center" style="height:100vh;width: 100%;">
           
            <fieldset class="p-4 border rounded position-relative col-lg-4 col-md-7 col-11 text-white" id="register-form">
                <legend class="my-4 fw-bold fs-2 text-center text-white">Reset Password</legend>
                <div class="mt-3">
                    <input type="email" name="email" class="form-control border-2 py-2 border border-dark" id="email" value="<?php echo $email ?>" readonly>
                </div>

                <div class="mt-3 position-relative">
                        <input type="password" name="password" id="password" class="form-control border-2 p-2 border-dark" placeholder="Password" required>
        <i id="togglePassword" class="fas fa-eye text-secondary position-absolute top-0 end-0 py-2 fs-5 mt-1 me-4"></i>
                    </div>
                <script src="/asset/js/password-display-toggle.js"></script>
                </div>

                <div class="mt-3">
                    <input type="password" name="conf-password" id="password" class="form-control border-2 py-2 border border-dark" placeholder="Confirm Password"  required>
                </div>

                <div class="mt-3 d-flex align-items-center justify-content-center px-2">
                    <input type="submit" value="Save" name="submit" id="register-btn" class="px-5 py-2 rounded text-white border" style="border:grey; width:150px;height:45px;">
                 </div>
            </fieldset>
        </form>

<?php

        } else{
?>


<div class="error text-center d-flex align-items-center justify-content-center" style="height:90vh;width:100%">
<div class="container mt-5">
    <div class="card shadow-lg rounded text-white border" id="register-form">
        <div class="card-body text-center">
            <h1 class="text-warning mb-4">Verification Error</h1>
            <p class="lead">Oops! Something went wrong while verifying your email address.</p>
            <p>Please try again. If the issue persists, contact us for assistance.</p>

            <div class="mt-4 d-flex justify-content-center" style="gap:7px">
                <a href="verification-email.php" class="nav-link" style="color:skyblue">Try Again</a> |
                <a href="mailto:connect2local247@gmail.com" class="nav-link" style="color:skyblue">Contact Us</a>
            </div>

            <p class="mt-3">If you need further assistance, click <a href="help.php" style="color:skyblue">here</a>.</p>
        </div>
    </div>
</div>
</div>

<?php
        }
    }
} else{
            
?>

<?php

    }
?>

<?php include "../../../../component/form-footer.php"; ?>

</body>
</html>