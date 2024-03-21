<?php
        session_start();
        require "/connect2local/includes/table_query/db_connection.php";
        require "/connect2local/includes/code_generator/primary_key_generator.php";
        require "/connect2local/includes/email_template/email_sending.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect2local - Login</title>
    <link rel="stylesheet" href="/asset/css/form.css">
    <?php include "/connect2local/asset/link/cdn-link.html"; ?>
</head>
<body id="form-body">
<?php
    if(isset($_SESSION['c_id'])):
     $query = "SELECT c_fname,c_lname FROM customer_register WHERE c_id = '{$_SESSION['c_id']}'";
     $result = mysqli_query($GLOBALS['connect'],$query);
     if(mysqli_num_rows($result) > 0){
         $data = mysqli_fetch_assoc($result);
         
         $name = $data['c_fname']." ".$data['c_lname'];
        }
        // echo $name;
    endif;
        $verification_code = generateVerificationCode();
        function send_code($name,$email,$verification_code){
            $subject = "Verification Code From Connect2Local";
            
            $_SESSION['verify-code'] = $verification_code;
            $template = "
            <div style='max-width: 600px; margin: 0 auto; padding: 20px; font-family: \"Arial\", sans-serif;'>
            
            <div style='text-align: center;'>
            <img src='https://live.staticflickr.com/65535/53417631216_2be8f41b9e_n.jpg' alt='Connect2local' style='max-width: 100px;'>
            <h1 style='color: #333;'>Connect2Local</h1>
            </div>
            
            <div>
            <p>Hello $name,</p>
            
            <p>Thank you for registering with Connect2Local. You're just a step away from completing the process.</p>
            
            <div style='background-color: #f4f4f4; padding: 10px; text-align: center;'>
            <p>Your verification code is:</p>
            <h2 style='color: #333; margin: 10px 0;'>$verification_code</h2>
            </div>
            
            <p>Enter this code on our website to complete your registration.</p>
            
    <p>If you did not initiate this registration, please ignore this email.</p>

    <p>Best regards,<br>Connect2Local</p>
</div>

</div>
";



                send_mail($name,$email,$subject,$template);

}

    if(isset($_SESSION['c_id'])){
        $get_verification_status = "SELECT two_step_status FROM customer_verification WHERE c_id = '{$_SESSION['c_id']}'";
        $result = mysqli_query($GLOBALS['connect'], $get_verification_status);
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $two_step_enabled = $row['two_step_status']; // Convert to boolean
        }
  

    ?>
    <?php if($two_step_enabled == 1){
            $update = "UPDATE customer_verification SET c_verification_code = '$verification_code' WHERE c_id = '{$_SESSION['c_id']}'";
            if(mysqli_query($GLOBALS['connect'],$update)){

                send_code($name,$_SESSION['email'],$verification_code);
            }
       
    
    ?>
    
        <script>
            path = "/user/customer/login/form/email_verification.php";
        </script>
    <?php }else{ ?>
        <script>
            path = "/user/customer/dashboard/dashboard.php";
        </script>
    <?php 
            }
    }
                include "../../../../component/form-alert.php";
                unset($_SESSION['error']);
        ?>
        <form action="/user/customer/login/code/login-validation.php" method="post" class="d-flex flex-column align-items-center justify-content-center p-2" style="height:90vh;width: 100%;">
            <fieldset class="p-3 border rounded col-lg-7 col-md-10 col-12  text-white" id="register-form">
                <legend class="my-4 fw-bold fs-2 text-center text-uppercase">Login</legend>
                <div class="mt-3">
                    <label for="email" class="form-label ps-1">Email</label>
                    <input type="email" name="email" class="form-control border border-2 border-dark py-2" id="email" placeholder="Email Address" required>
                </div>

                <div class="mt-3">
                    <label for="password" class="form-label ps-1">Password</label>
                    <div class="mt-1 position-relative">
                        <input type="password" name="password" id="password" class="form-control py-2 border-2 border-dark" placeholder="Password" required>
        <i id="togglePassword" class="fas fa-eye text-secondary position-absolute top-0 end-0 py-2 fs-5 mt-1 me-4"></i>
                    </div>

                <script src="/asset/js/password-display-toggle.js"></script>
                </div>

                <div class="mt-3 d-flex align-items-center justify-content-between px-2">
                    <a href="/user/customer/register/form/customer_register.php" class="nav-link" style="font-size:15px;color:skyblue;">Create an Account</a>
                    <a href="/user/customer/login/form/verification-email.php" class="nav-link" style="font-size:15px;color:skyblue;">Forgot Password</a>
                 </div>

                 <div class="mt-5 d-flex justify-content-center">
                    <input type="submit" value="Login" name="submit" class="px-5 py-3 rounded-pill border text-white" id="register-btn" style="width:150px;">
                 </div>
            </fieldset>
        </form>
    
        <?php include "/connect2local/component/form-footer.php"; ?>
    
</body>
</html>