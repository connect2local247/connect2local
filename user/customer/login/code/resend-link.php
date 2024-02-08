<?php
        session_start();

        // include "/connect2local/includes/table_query/db_connection.php";
        // require "/connect2local/includes/table_query/find_encrypt_data.php";
        // require "/connect2local/includes/code_generator/code_generator.php";
        // require "/connect2local/includes/table_query/get_primary_key.php";
        // require "/connect2local/includes/email_template/email_sending.php";
        require "email_verification_check.php";


        if(isset($_SESSION['error'])){
            unset($_SESSION['error']);
        }
       
        function resend_verification_link($email,$verification_link){
            $subject = "Resend Reset Password Link From Connect2Local";

            $name = $_SESSION['fullname'];

            $template = "<div style='max-width: 600px; margin: 0 auto; padding: 20px; font-family: 'Arial', sans-serif; background-color: #f8f8f8;'>

            <div style='text-align: center;'>
                <img src='https://live.staticflickr.com/65535/53417631216_2be8f41b9e_n.jpg' alt='Connect2local' style='max-width: 100px;'>
            </div>
        
            <div style='text-align: center;'>
                <h1 style='color: #333; margin-top: 10px;'>Connect2Local</h1>
            </div>
        
            <div>
                <p>Hello $name,</p>
        
                <p>We received a request again to reset your password on Connect2Local. If you did not initiate this request, please ignore this email.</p>
        
                <div style='background-color: #ffffff; padding: 10px; text-align: center; border-radius: 8px;'>
                    <p>To reset your password, click the link below:</p>
                    <a href=\"$verification_link\" style='display: inline-block; padding: 10px 20px; background-color: #4CAF50; color: #fff; text-decoration: none; border-radius: 5px;'>Reset Password</a>
                </div>
        
                <p>If you are unable to click the link, you can copy and paste the following URL into your browser:</p>
                <p>$verification_link</p>
        
                <p>This link is valid for a limited time. If you don't reset your password within this period, you may need to submit another request.</p>
        
                <p>If you didn't request a password reset, please secure your account and contact our support team immediately.</p>
        
                <p style='color: #555; margin-top: 20px;'>Best regards,<br>Connect2Local</p>
            </div>
        
        </div>
        ";

        send_mail($name,$email,$subject,$template);
        }

        // function check_email_exists($email){
        //     if(find_encrypted_data($email,"customer_register","customer_verification","C_ID","C_EMAIL","C_KEY","C_ID")){
        //         return true;
        //     } else{
        //         $_SESSION['error'] = "Email Doesn't Exists";
        //     }     
            
        //     return false;
        // }

        // function get_name($customer_id){
        //     $query = "SELECT C_FNAME,C_LNAME FROM customer_register WHERE C_ID = '$customer_id'";

        //     $result = mysqli_query($GLOBALS['connect'],$query);

        //     if(mysqli_num_rows($result) > 0){
        //         $row = mysqli_fetch_assoc($result);

        //         $fname = $row['C_FNAME'];
        //         $lname = $row['C_LNAME'];

        //         return $fname."".$lname;
        //     } 

        //     return "";
        // }

        // function update_data($email,$verification_token){
        //     $customer_id = get_primary_key($email,"customer_register","customer_verification","C_ID","C_EMAIL","C_KEY","C_ID");

        //     $_SESSION['fullname'] = get_name($customer_id);

        //     $find_key_query = "SELECT C_KEY FROM customer_verification WHERE C_ID = '$customer_id'";

        //     $result = mysqli_query($GLOBALS['connect'],$find_key_query);

        //     $key = "";
        //     if($result){
        //         $row = mysqli_fetch_assoc($result);
                
        //         $key = $row['C_KEY'];
        //         echo $key;
        //     }

        //     $update_query = "UPDATE customer_verification SET C_VERIFY_TOKEN = '$verification_token' WHERE C_KEY = $key";
        //     $result = mysqli_query($GLOBALS['connect'],$update_query);

        //     // die($result);
        //     if($result){
        //         return true;
        //     } else{
        //         echo "Error in the query: " . mysqli_error($GLOBALS['connect']);
        //     }

        //     return false;
        // }

        
        if(isset($_GET['resend_link'])){
            $email = $_GET['email'];

            $col_name = "C_VERIFY_TOKEN";
            $verification_token = generateVerificationToken($col_name,$email,$key);
            $verification_link = "http://connect2local/user/customer/login/form/forgot-password.php?verification_token=$verification_token";
           

            if(check_email_exists($email)){
                if(update_data($email,$verification_token)){
                    $_SESSION['message'] = "Verification Link Resend Successfully";
                    resend_verification_link($email,$verification_link);

                    unset($_SESSION['error']);
                    header("location:/user/customer/login/form/verification-email.php");
                    exit;
                }
            }

            if(isset($_SESSION['message'])){
                $_SESSION['message'] = "";
            }
            header("location:/user/customer/login/form/verification-email.php");

        }
?>