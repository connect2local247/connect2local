<?php

        include "/connect2local/includes/table_query/db_connection.php";
        require "/connect2local/includes/table_query/get_primary_key.php";
        require "/connect2local/includes/table_query/get_encrypted_data.php";
        require "/connect2local/includes/table_query/find_encrypt_data.php";

        session_start();

        if(isset($_SESSION['error'])){
            unset($_SESSION['error']);
        }

        if(isset($_POST['submit'])){
            $user_code = $_POST['user-code'];
            $verification_code = $_SESSION['verify-code'];

            if($verification_code == $user_code){
                
                $email = $_SESSION['email'];
                
                if(find_encrypted_data($email,"customer_register","customer_verification","C_ID","C_EMAIL","C_KEY","C_ID")){
                    $customer_id = get_primary_key($email,"customer_register","customer_verification","C_ID","C_EMAIL","C_KEY","C_ID");
                    $data= get_encrypted_data($email,"customer_register","customer_verification","C_ID","C_EMAIL","C_KEY","C_ID");
                    
                    $key = $data['key'];
                    
                    $update_query = "UPDATE customer_verification SET C_EMAIL_VERIFIED = 'Yes' WHERE C_KEY = $key AND C_ID = '$customer_id'";
                    // die($update_query);
                    
                    $result = mysqli_query($GLOBALS['connect'],$update_query);
                    
                    if($result){
                        $_SESSION['greet-message'] = "Verification Code Matched.";
                    } else{
                        $update_query = "UPDATE customer_verification SET C_EMAIL_VERIFIED = 'No' WHERE C_KEY = $key AND C_ID = '$customer_id'";
                        $result = mysqli_query($GLOBALS['connect'],$update_query);
                    }
                }
                unset($_SESSION['user-code']);
                unset($_SESSION['verify-code']);


                
            } else{
                $_SESSION['error'] = "Verification Code Doesn't Matched.";
            }
            header("location:/user/customer/register/form/email_verification.php");
            exit;
        }