<?php
        session_start();


        include "/connect2local/includes/table_query/db_connection.php";
        require "/connect2local/includes/security_function/secure_function.php";
        require "/connect2local/includes/table_query/get_encrypted_data.php";

        if(isset($_SESSION['error'])){
            unset($_SESSION['error']);
        }

        if(isset($_POST['submit'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['conf-password'];

            $verification_token = $_SESSION['verification-token'];
            if($password == $confirm_password){

                $data = get_encrypted_data($email,"business_register","business_verification","B_ID","B_EMAIL","B_KEY","B_ID");

                $id = $data['id'];
                $key = $data['key'];
                $encryptedEmail = ['encryptedData'];

                $encryptedPassword = encryptData($password,$key);


                $update_password_query = "UPDATE business_register SET B_PASSWORD = '$encryptedPassword' WHERE B_ID = '$id' ";

                $result = mysqli_query($GLOBALS['connect'],$update_password_query);
                
                if($result){
                    $_SESSION['greet-message'] = "Password Updated Successfully.";
                    header("Location:/user/businessman/login/form/forgot-password.php?verification_token={$_SESSION['verification-token']}");
                    exit;
                } else{
                    echo "Error in the query: " . mysqli_error($GLOBALS['connect']);
                }
                
            } else{
                $_SESSION['error'] = "Password Not Matched.";
            }

            header("location:/user/businessman/login/form/forgot-password.php?verification_token={$_SESSION['verification-token']}");
            exit;
        }

?>