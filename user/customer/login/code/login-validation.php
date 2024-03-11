<?php
        session_start();

        include "../../../../includes/table_query/db_connection.php";
        include "../../../../includes/table_query/find_encrypt_data.php";
        require "../../../../includes/table_query/get_encrypted_data.php";

        if(isset($_SESSION['error'])){
            unset($_SESSION['error']);
        }

        function validate_login_data($email,$password){
            if(find_encrypted_data($email,"customer_register","customer_verification","c_id","c_email","c_key","c_id") && find_encrypted_data($password,"customer_register","customer_verification","c_id","c_password","c_key","c_id")){
                $encryptedPasswordDataArray = get_encrypted_data($password,"customer_register","customer_verification","c_id","c_password","c_key","c_id");
                $encryptedEmailDataArray = get_encrypted_data($email,"customer_register","customer_verification","c_id","c_email","c_key","c_id");
                
                $encryptedPassword = $encryptedPasswordDataArray['encryptData'];
                $encryptedEmail = $encryptedEmailDataArray['encryptData'];

                $customer_id = $encryptedEmailDataArray['id'];
                $key = $encryptedEmailDataArray['key'];
                $login_query = "SELECT c_email,c_password FROM customer_register WHERE c_id = '$customer_id' AND c_email = '$encryptedEmail'";
        
                $result = mysqli_query($GLOBALS['connect'],$login_query);
                if(mysqli_num_rows($result) >= 1 ){
                    $row = mysqli_fetch_assoc($result);
                    $db_password = decryptData($row['c_password'],$key);

                    if($password == $db_password){
                        $_SESSION['c_id'] = $customer_id;
                        
                        $find_user_id = "SELECT * FROM customer_profile WHERE c_id = '$customer_id'";

                        if(mysqli_num_rows(mysqli_query($GLOBALS['connect'],$find_user_id))){
                            $row = mysqli_fetch_assoc(mysqli_query($GLOBALS['connect'],$find_user_id));

                            $_SESSION['cp_user_id'] = $row['cp_user_id'];
                            echo $_SESSION['cp_user_id'];

                            $query = "INSERT INTO notification(n_type,n_content,n_time,n_user_id) VALUES('greeting','successfully login',NOW(),'$customer_id')";
                            $result = mysqli_query($GLOBALS['connect'],$query);
                            // die($query);
                            // die();
                        }
                        // echo $business_id;
                        // $_SESSION['bp_user_id'] = get_user_id("business_profile","$business_id","bp_user_id","b_id");;
                        $_SESSION['greet-message'] = "Login Successfully";
                        $_SESSION['registered'] = 1;

                        return true;
                    } else{
                        $_SESSION['error'] = "Password doesn't matched";
                    }
                }else{
                    $_SESSION['error'] = "Login Failed Try Again";
                }
            } else if(!find_encrypted_data($email,"customer_register","customer_verification","c_id","c_email","c_key","c_id")){
                
                $_SESSION['error'] = "Email Doesn't Exists";

            } else if(!find_encrypted_data($password,"customer_register","customer_verification","c_id","c_password","c_key","c_id")){
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