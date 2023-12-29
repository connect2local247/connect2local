<?php
        session_start();

        include "/connect2local/includes/table_query/db_connection.php";
        require "/connect2local/includes/table_query/find_encrypt_data.php";


        function send_verification_link($email){

        }

        function check_email_exists($email){
            if(find_encrypted_data($email,"customer_register","customer_verification","C_ID","C_EMAIL","C_KEY","C_ID")){
                return true;
            } else{
                $_SESSION['error'] = "Email Doesn't Exists";
            }     
            
            return false;
        }

        function update_data($email,$verification_token){
            $update_query = "UPDATE VERIFY_TOKEN FROM customer_verification SET VERIFY_TOKEN = '$verification_token' WHERE C_KEY = $key";
        }
        
        if(isset($_POST['submit'])){
            $email = $_POST['email'];


        }
?>