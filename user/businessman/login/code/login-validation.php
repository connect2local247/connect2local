<?php
        session_start();

        include "/connect2local/includes/table_query/db_connection.php";
        include "/connect2local/includes/table_query/find_encrypt_data.php";
        require "/connect2local/includes/table_query/get_encrypted_data.php";
        require "/connect2local/includes/table_query/get_data_query.php";

        if(isset($_SESSION['error'])){
            unset($_SESSION['error']);
        }

        if(isset($_SESSION['greet-message'])){
            unset($_SESSION['greet-message']);
        }
        function validate_login_data($email,$password){
            if(find_encrypted_data($email,"business_register","business_verification","B_ID","B_EMAIL","B_KEY","B_ID")){
                $encryptedPasswordDataArray = get_encrypted_data($password,"business_register","business_verification","B_ID","B_PASSWORD","B_KEY","B_ID");
                $encryptedEmailDataArray = get_encrypted_data($email,"business_register","business_verification","B_ID","B_EMAIL","B_KEY","B_ID");
                
                $encryptedPassword = $encryptedPasswordDataArray['encryptData'];
                $encryptedEmail = $encryptedEmailDataArray['encryptData'];
                $key = $encryptedEmailDataArray['key'];
                $business_id = $encryptedEmailDataArray['id'];
                $login_query = "SELECT B_EMAIL,B_PASSWORD FROM business_register WHERE B_ID = '$business_id' AND B_EMAIL = '$encryptedEmail'";
                // die($login_query);
                $result = mysqli_query($GLOBALS['connect'],$login_query);
                if(mysqli_num_rows($result) > 0 ){
                    $row = mysqli_fetch_assoc($result);

                    $db_password = decryptData($row['B_PASSWORD'],$key);

                    if($password == $db_password){
                        $_SESSION['business_id'] = $business_id;
                        echo $business_id;
                        $_SESSION['user_id'] = get_user_id("business_profile","$business_id","USER_ID","B_ID");;
                        $_SESSION['greet-message'] = "Login Successfully";
                        return true;
                    } else{
                        $_SESSION['error'] = "Password doesn't matched";
                    }
                }else{
                    $_SESSION['error'] = "Login Failed Try Again";
                }

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