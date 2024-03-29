<?php

        session_start();

        require "/connect2local/includes/email_template/email_sending.php";
        require "/connect2local/includes/code_generator/code_generator.php";

        $resend_code = 0;

        if(isset($_GET['resend_code'])){
            if($_GET['resend_code'] == 1){
                    $email = $_SESSION['email'];

                    resend_code($email);
                    
                    header("location:/user/customer/register/form/email_verification.php");
                    exit;
                    
                }
            }
            
            function resend_code($email){
                
                $new_verification_code = generateVerificationCode();
                
                $_SESSION['verify-code'] = $new_verification_code;
                
                $name = $_SESSION['fname']." ".$_SESSION['lname'];
                $subject = "New Verification Code From Connect2Local";
                
                $template = "
                                <div style='max-width: 600px; margin: 0 auto; padding: 20px; font-family: \"Arial\", sans-serif; background-color: #f8f8f8;'>

                                    <div style='text-align: center;'>
                                        <img src='https://live.staticflickr.com/65535/53417631216_2be8f41b9e_n.jpg' alt='Connect2local' style='max-width: 100px;'>
                                    </div>

                                    <div style='text-align: center;'>
                                        <h1 style='color: #333; margin-top: 10px;'>Connect2Local</h1>
                                    </div>

                                    <div>
                                        <p>Hello $name,</p>

                                        <p>We noticed that you requested a resend of your verification code on Connect2Local.</p>

                                        <div style='background-color: #ffffff; padding: 10px; text-align: center; border-radius: 8px;'>
                                            <p>Your verification code is:</p>
                                            <h2 style='color: #333; margin: 10px 0;'>$new_verification_code</h2>
                                        </div>

                                        <p>Enter this code on our website to complete your registration.</p>

                                        <p>If you didn't request this code, please ignore this email or contact our support team.</p>

                                        <p style='color: #555; margin-top: 20px;'>Best regards,<br>Connect2Local</p>
                                    </div>

                                </div>
                            ";

                
                $_SESSION['message'] = "Verification has been resent to your mail.";
                send_mail($name,$email,$subject,$template);
        }

?>