<?php
        session_start();

        include "/connect2local/includes/table_query/db_connection.php";
        include "/connect2local/includes/table_query/find_encrypt_data.php";

        if(isset($_SESSION['error'])){
            unset($_SESSION['error']);
        }

        function validate_login_data($email,$password){
            if(find_encrypted_data($email,"customer_register","customer_verification","C_ID","C_EMAIL","C_KEY","C_ID") && find_encrypted_data($password,"customer_register","customer_verification","C_ID","C_PASSWORD","C_KEY","C_ID")){
                
                $_SESSION['greet-message'] = "Login Successfully";
                return true;
            } else if(!find_encrypted_data($email,"customer_register","customer_verification","C_ID","C_EMAIL","C_KEY","C_ID")){
                
                $_SESSION['error'] = "Email Doesn't Exists";

            } else if(!find_encrypted_data($password,"customer_register","customer_verification","C_ID","C_PASSWORD","C_KEY","C_ID")){
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


            header("location:/user/customer/login/form/login.php");

        }


?>