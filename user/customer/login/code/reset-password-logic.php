<?php
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

            if($password == $confirm_password){

                $data = get_encrypted_data($email,"customer_register","customer_verification","C_ID","C_EMAIL","C_KEY","C_ID");

                $id = $data['id'];
                $key = $data['key'];
                $encryptedEmail = ['encryptedData'];

                $encryptedPassword = encryptData($password,$key);


                $update_password_query = "UPDATE customer_register SET C_PASSWORD = '$encryptedPassword' WHERE C_ID = '$id' ";

                $result = mysqli_query($GLOBALS['connect'],$update_password_query);
                
                if($result){
                    $_SESSION['message'] = "Password Updated Successfully.";
                    header("Location:/user/customer/login/form/login.php");

                } else{
                    echo "Error in the query: " . mysqli_error($GLOBALS['connect']);
                }
                
            } else{
                $_SESSION['error'] = "Password Not Matched.";
            }
        }

?>