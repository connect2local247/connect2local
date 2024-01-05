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
                
                if(find_encrypted_data($email,"business_register","business_verification","B_ID","B_EMAIL","B_KEY","B_ID")){
                    $business_id = get_primary_key($email,"business_register","business_verification","B_ID","B_EMAIL","B_KEY","B_ID");
                    $data= get_encrypted_data($email,"business_register","business_verification","B_ID","B_EMAIL","B_KEY","B_ID");
                    
                    $key = $data['key'];
                    
                    $update_query = "UPDATE business_verification SET B_EMAIL_VERIFIED = 'Yes' WHERE B_KEY = $key AND B_ID = '$business_id'";
                    // die($update_query);
                    
                    $result = mysqli_query($GLOBALS['connect'],$update_query);
                    
                    if($result){
                        $_SESSION['greet-message'] = "Verification Code Matched.";
                    } else{
                        $update_query = "UPDATE business_verification SET B_EMAIL_VERIFIED = 'No' WHERE B_KEY = $key AND B_ID = '$business_id'";
                        $result = mysqli_query($GLOBALS['connect'],$update_query);
                    }
                }

                unset($_SESSION['user-code']);
                unset($_SESSION['verify-code']);

            } else{
                $_SESSION['error'] = "Verification Code Doesn't Matched.";
            }
            header("location:/user/businessman/register/form/email_verification.php");
            exit;
        }
?>