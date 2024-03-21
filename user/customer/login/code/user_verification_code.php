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
            $id = $_SESSION['c_id'];
            $query = "SELECT c_verification_code FROM customer_verification WHERE c_id = '$id'";
            $result = mysqli_query($GLOBALS['connect'],$query);
            
            if(mysqli_num_rows($result) > 0){
                
                $row = mysqli_fetch_assoc($result);
                $verification_code = $row['c_verification_code'];
                if($verification_code == $user_code){
                    $email = $_SESSION['email'];
                    
                    if(find_encrypted_data($email,"customer_register","customer_verification","c_id","c_email","c_key","c_id")){
                        // die($email);
                        $c_id = get_primary_key($email,"customer_register","customer_verification","c_id","c_email","c_key","c_id");
                        $data= get_encrypted_data($email,"customer_register","customer_verification","c_id","c_email","c_key","c_id");
                        
                        $key = $data['key'];
                        
                        $update_query = "UPDATE customer_verification SET c_email_status = 1,c_verification_code = '0' WHERE c_key = $key AND c_id = '$c_id'";
                        
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
            header("location:/user/customer/login/form/email_verification.php");
            exit;
        }
?>