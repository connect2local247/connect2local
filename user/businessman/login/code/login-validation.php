<?php
        session_start();

        include "/connect2local/includes/table_query/db_connection.php";
        include "/connect2local/includes/table_query/find_encrypt_data.php";

        if(isset($_SESSION['error'])){
            unset($_SESSION['error']);
        }

        if(isset($_SESSION['greet-message'])){
            unset($_SESSION['greet-message']);
        }
        function validate_login_data($email,$password){
            if(find_encrypted_data($email,"business_register","business_verification","B_ID","B_EMAIL","B_KEY","B_ID") && find_encrypted_data($password,"business_register","business_verification","B_ID","B_PASSWORD","B_KEY","B_ID")){
                
                $_SESSION['greet-message'] = "Login Successfully";
                return true;
            } else if(!find_encrypted_data($email,"business_register","business_verification","B_ID","B_EMAIL","B_KEY","B_ID")){
                
                $_SESSION['error'] = "Email Doesn't Exists";

            } else if(!find_encrypted_data($password,"business_register","business_verification","B_ID","B_PASSWORD","B_KEY","B_ID")){
                $_SESSION['error'] = "Password Doesn't Matched";
            }

            return false;
        }
        if(isset($_POST['submit'])){
            $email  = $_POST['email'];
            $password = $_POST['password'];

            if(validate_login_data($email,$password)){
                if(isset($_SESSION['error'])){
                    unset($_SESSION['error']);
                }

                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                
                $_SESSION['login-status'] = true;
            }


            header("location:/user/businessman/login/form/login.php");

        }


?>