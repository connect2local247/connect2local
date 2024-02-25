<?php
        session_start();


        include "../../../../includes/table_query/db_connection.php";
        require "../../../../includes/security_function/secure_function.php";
        require "../../../../includes/code_generator/code_generator.php";
        require "../../../../includes/table_query/get_encrypted_data.php";
        require "../../../../includes/table_query/update_data.php";

        if(isset($_SESSION['error'])){
            unset($_SESSION['error']);
        }

        if(isset($_POST['submit'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['conf-password'];

            $verification_token = $_SESSION['verification-token'];
            if($password == $confirm_password){
              $query = "SELECT admin_otp FROM admin_login WHERE admin_id = 1";

              $result = mysqli_query($GLOBALS['connect'],$query);

              if(mysqli_num_rows($result) > 0){
                  $row = mysqli_fetch_assoc($result);
                  $key = $row['admin_otp'];
                  $encryptPassword = encryptData($password,$key); 
                  $update_password_query = "UPDATE admin_login SET admin_password = '$encryptPassword' WHERE admin_id = 1 ";
                  $result = mysqli_query($GLOBALS['connect'],$update_password_query);
                  updateDataAdmin();
                  
              }
                if($result){
                    $_SESSION['greet-message'] = "Password Updated Successfully.";
                    header("Location:/user/admin/login/form/forgot-password.php?verification_token={$_SESSION['verification-token']}");
                    exit;
                } else{
                    echo "Error in the query: " . mysqli_error($GLOBALS['connect']);
                }
                
            } else{
                $_SESSION['error'] = "Password Not Matched.";
            }

            header("location:/user/admin/login/form/forgot-password.php?verification_token={$_SESSION['verification-token']}");
            exit;
        }

?>