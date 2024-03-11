<?php
        session_start();

        require "/connect2local/includes/table_query/db_connection.php";
        require "/connect2local/includes/security_function/secure_function.php";
        require "/connect2local/includes/code_generator/primary_key_generator.php";
        require "/connect2local/includes/email_template/email_sending.php";


        function insert_data(){
            $fname = $_SESSION['fname'];
            $lname = $_SESSION['lname'];
            $birth_date = $_SESSION['birth-date'];
            $gender = $_SESSION['gender'];
            $contact = $_SESSION['contact'];
            $email = $_SESSION['email'];
            $password = $_SESSION['password'];
            $term_condition = $_SESSION['term-condition'];
            $encryption_key = generateEncryptionKey();


            $encryptedEmail = encryptData($email,$encryption_key);
            $encryptedContact = encryptData($contact,$encryption_key);
            $encryptedPassword = encryptData($password,$encryption_key);

            

            $customer_generated_id = generateUniqueID("customer_register","C2L","c_id");

            $customer_id = $customer_generated_id;
            $verification_code = generateVerificationCode();
            $cp_user_id = generateUniqueID("customer_profile","C2LU","cp_user_id");

            $register_insert_query = "INSERT INTO customer_register (c_id, c_fname, c_lname, c_birth_date, c_gender, c_contact, c_email, c_password, c_term_status,join_date) 
                         VALUES ('$customer_id', '$fname', '$lname', '$birth_date', '$gender', '$encryptedContact', '$encryptedEmail', '$encryptedPassword',$term_condition, NOW())";


            $verification_insert_query = "INSERT INTO customer_verification (c_key,c_verification_code,c_id) VALUES ('$encryption_key','$verification_code','$customer_id')";

            $register_query_result = mysqli_query($GLOBALS['connect'],$register_insert_query);
            $verification_query_result = mysqli_query($GLOBALS['connect'],$verification_insert_query);
            $customer_profile_query = "INSERT INTO customer_profile(cp_user_id,c_id,cp_update_time) VALUES('$cp_user_id','$customer_id',NOW());";
            $customer_profile_result = mysqli_query($GLOBALS['connect'],$customer_profile_query);

            echo $register_insert_query;
            if($register_query_result && $verification_query_result) {

                send_code($email,$verification_code);
            $_SESSION['c_id'] = $customer_id;     
            $_SESSION['cp_user_id'] = $cp_user_id;  
            $_SESSION['greet-message'] = "Congratulations !!! You are registered Successfully.";
            send_notification($customer_id);
            $_SESSION['message'] = "Verification Code Sent Successfully.";
            header("location:/user/customer/register/form/customer_register.php");
            return true;
            }
            
            if (!$register_query_result) {
                die("Error in register query: " . mysqli_error($GLOBALS['connect']));
            }
        
            if (!$verification_query_result) {
                die("Error in verification query: " . mysqli_error($GLOBALS['connect']));
            }

            return false;
            
        }
        insert_data();

        function send_code($email,$verification_code){
                $subject = "Verification Code From Connect2Local";

                $name = $_SESSION['fname'] ." ". $_SESSION['lname'];
                $template = "
    <div style='max-width: 600px; margin: 0 auto; padding: 20px; font-family: \"Arial\", sans-serif;'>

        <div style='text-align: center;'>
            <img src='https://live.staticflickr.com/65535/53417631216_2be8f41b9e_n.jpg' alt='Connect2local' style='max-width: 100px;'>
            <h1 style='color: #333;'>Connect2Local</h1>
        </div>

        <div>
            <p>Hello $name,</p>

            <p>Thank you for registering with Connect2Local. You're just a step away from completing the process.</p>

            <div style='background-color: #f4f4f4; padding: 10px; text-align: center;'>
                <p>Your verification code is:</p>
                <h2 style='color: #333; margin: 10px 0;'>$verification_code</h2>
            </div>

            <p>Enter this code on our website to complete your registration.</p>

            <p>If you did not initiate this registration, please ignore this email.</p>

            <p>Best regards,<br>Connect2Local</p>
        </div>

    </div>
";



                        send_mail($name,$email,$subject,$template);
        }

        function send_notification($customer_id){
                    $query = "INSERT INTO notification(n_content,n_type,n_user_id,n_time) VALUES ('You are registered Successfully','greeting','$customer_id',NOW()";
                    $result = mysqli_query($GLOBALS['connect'],$query);

                    $_SESSION['registered'] = 1;
        }

        function store_data(){

        }
?>