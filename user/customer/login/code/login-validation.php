<?php
        session_start();

        include "/connect2local/includes/table_query/dC_connection.php";
        include "/connect2local/includes/table_query/find_encrypt_data.php";
        require "/connect2local/includes/table_query/get_encrypted_data.php";

        if(isset($_SESSION['error'])){
            unset($_SESSION['error']);
        }

        function validate_login_data($email,$password){
            if(find_encrypted_data($email,"customer_register","customer_verification","C_ID","C_EMAIL","C_KEY","C_ID") && find_encrypted_data($password,"customer_register","customer_verification","C_ID","C_PASSWORD","C_KEY","C_ID")){
                $encryptedPasswordDataArray = get_encrypted_data($password,"customer_register","customer_verification","C_ID","C_PASSWORD","C_KEY","C_ID");
                $encryptedEmailDataArray = get_encrypted_data($email,"customer_register","customer_verification","C_ID","C_EMAIL","C_KEY","C_ID");
                
                $encryptedPassword = $encryptedPasswordDataArray['encryptData'];
                $encryptedEmail = $encryptedEmailDataArray['encryptData'];

                $customer_id = $encryptedEmailDataArray['id'];

                $login_query = "SELECT C_EMAIL,C_PASSWORD FROM customer_register WHERE C_ID = '$customer_id' AND C_EMAIL = '$encryptedEmail' AND C_PASSWORD = '$encryptedPassword'";
                // die($login_query);
                $result = mysqli_query($GLOBALS['connect'],$login_query);
                if(mysqli_num_rows($result) == 1 ){
                    $_SESSION['greet-message'] = "Login Successfully";
                    return true;
                }else{
                    $_SESSION['error'] = "Login Failed Try Again";
                }
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