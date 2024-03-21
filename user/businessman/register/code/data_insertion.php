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
            $address = $_SESSION['address'].",Kadi-382715,Gujarat";
            $category = $_SESSION['category'];
            $contact = $_SESSION['contact'];
            $email = $_SESSION['email'];
            $password = $_SESSION['password'];
            $term_condition = $_SESSION['term-condition'];
            $encryption_key = generateEncryptionKey();


            $encryptedEmail = encryptData($email,$encryption_key);
            $encryptedContact = encryptData($contact,$encryption_key);
            $encryptedPassword = encryptData($password,$encryption_key);

            

            $business_generated_id = generateUniqueID("business_register","C2LB","b_id");
            $business_user_id = generateUniqueID("business_profile","C2LBU","bp_user_id");
            $business_id = $business_generated_id;
            $verification_code = generateVerificationCode();

            $register_insert_query = "INSERT INTO business_register (b_id, b_fname, b_lname, b_birth_date, b_gender,b_address,b_category, b_contact, b_email, b_password, b_term_status, join_date) 
                         VALUES ('$business_id', '$fname', '$lname', '$birth_date', '$gender','$address','$category', '$encryptedContact', '$encryptedEmail', '$encryptedPassword', $term_condition, NOW())";


            $verification_insert_query = "INSERT INTO business_verification (b_key,b_verification_code,b_id) VALUES ('$encryption_key','$verification_code','$business_id')";

            $business_profile_insert_query = "INSERT INTO business_profile(bp_user_id,bp_fname,bp_lname,bp_birth_date,bp_gender,bp_category,bp_update_time,b_id) VALUES ('$business_user_id','$fname', '$lname', '$birth_date', '$gender','$category',NOW(),'$business_id')";
           
            $business_profile_interaction_insert_query = "INSERT INTO business_profile_interaction (bp_user_id) VALUES('$business_user_id')";
            // die($business_profile_interaction_insert_query);

            $business_profile_result = mysqli_query($GLOBALS['connect'],$business_profile_insert_query);
            $register_query_result = mysqli_query($GLOBALS['connect'],$register_insert_query);
            $verification_query_result = mysqli_query($GLOBALS['connect'],$verification_insert_query);
            $business_profile_interaction_result = mysqli_query($GLOBALS['connect'],$business_profile_interaction_insert_query);

            echo $register_insert_query;
            if ($register_query_result && $verification_query_result) {
                $_SESSION['user_id'] = $business_user_id;
                $_SESSION['business_id'] = $business_id;

            send_code($email,$verification_code);
            send_notification($business_id);
            $_SESSION['greet-message'] = "Congratulations !!! You are registered Successfully.";
            $_SESSION['registered'] = 1;

            $_SESSION['message'] = "Verification Code Sent Successfully.";
            header("location:/user/businessman/register/form/business_register.php");
            exit;
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

        if(insert_data()){

            
        }
        function send_code($email,$verification_code){
                $subject = "Verification Code From Connect2Local";

                $name = $_SESSION['fname'] ." ". $_SESSION['lname'];
                $_SESSION['verify-code'] = $verification_code;
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

        function send_notification($business_id){
                    $query = "INSERT INTO notification(n_content,n_type,n_user_id,n_time) VALUES ('You are Registered Successfully','greeting','$business_id',NOW()";
                    $result = mysqli_query($GLOBALS['connect'],$query);
        }

        function store_data(){

        }
?>