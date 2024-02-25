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
            $id = $_SESSION['business_id'];
            $query = "SELECT b_verification_code FROM business_verification WHERE b_id = '$id'";
            $result = mysqli_query($GLOBALS['connect'],$query);

            if(mysqli_num_rows($result) > 0){

            $row = mysqli_fetch_assoc($result);
            $verification_code = $row['b_verification_code'];
            if($verification_code == $user_code){
                $email = $_SESSION['email'];
                
                if(find_encrypted_data($email,"business_register","business_verification","b_id","b_email","b_key","b_id")){
                    $business_id = get_primary_key($email,"business_register","business_verification","b_id","b_email","b_key","b_id");
                    $data= get_encrypted_data($email,"business_register","business_verification","b_id","b_email","b_key","b_id");
                    
                    $key = $data['key'];
                    
                    $update_query = "UPDATE business_verification SET b_email_status = 1,b_verification_code = '0' WHERE b_key = $key AND b_id = '$business_id'";
                    
                    $result = mysqli_query($GLOBALS['connect'],$update_query);
                    
                    if($result){
                        $_SESSION['greet-message'] = "Verification Code Matched.";
                    } 
                }

                unset($_SESSION['user-code']);
                unset($_SESSION['verify-code']);

            } else{
                $_SESSION['error'] = "Verification Code Doesn't Matched.";
            }
        }
            header("location:/user/businessman/register/form/email_verification.php");
            exit;
        }
?>