<?php

        session_start();

        if(isset($_SESSION['error'])){
            unset($_SESSION['error']);
        }

        if(isset($_POST['submit'])){
            $user_code = $_POST['user-code'];
            $verification_code = $_SESSION['verify-code'];

            if($verification_code == $user_code){
                $_SESSION['greet-message'] = "Verification Code Matched.";


                unset($_SESSION['user-code']);
                unset($_SESSION['verify-code']);

            } else{
                $_SESSION['error'] = "Verification Code Doesn't Matched.";
            }
            header("location:/user/businessman/register/form/email_verification.php");
            exit;
        }
?>