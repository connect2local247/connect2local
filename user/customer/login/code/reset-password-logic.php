<?php
        session_start();


        include "../../../../includes/table_query/db_connection.php";
        require "../../../../includes/security_function/secure_function.php";
        require "../../../../includes/table_query/get_encrypted_data.php";

        if(isset($_SESSION['error'])){
            unset($_SESSION['error']);
        }

        if(isset($_POST['submit'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['conf-password'];

            $verification_token = $_SESSION['verification-token'];
            if($password == $confirm_password){

                $data = get_encrypted_data($email,"customer_register","customer_verification","c_id","c_email","c_key","c_id");

                $id = $data['id'];
                $key = $data['key'];
                $encryptedEmail = ['encryptedData'];

                $encryptedPassword = encryptData($password,$key);


                $update_password_query = "UPDATE customer_register SET c_password = '$encryptedPassword' WHERE c_id = '$id' ";

                $result = mysqli_query($GLOBALS['connect'],$update_password_query);
                
                if($result){
                    $_SESSION['greet-message'] = "Password Updated Successfully.";
                    header("Location:/user/customer/login/form/forgot-password.php?verification_token={$_SESSION['verification-token']}");
                    exit;
                } else{
                    echo "Error in the query: " . mysqli_error($GLOBALS['connect']);
                }
                
            } else{
                $_SESSION['error'] = "Password Not Matched.";
            }

            header("location:/user/customer/login/form/forgot-password.php?verification_token={$_SESSION['verification-token']}");
            exit;
        }

?>