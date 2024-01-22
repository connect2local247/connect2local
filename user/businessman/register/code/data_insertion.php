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
            $age = $_SESSION['age'];
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

            

            $business_generated_id = generateUniqueID("business_register","C2LB","B_ID");
            $business_user_id = generateUniqueID("business_profile","C2LBU","USER_ID");
            $business_id = $business_generated_id;

            $register_insert_query = "INSERT INTO business_register (B_ID, B_FNAME, B_LNAME, B_BIRTH_DATE, B_AGE, B_GENDER,B_ADDRESS,B_CATEGORY, B_CONTACT, B_EMAIL, B_PASSWORD, B_TERM_AGREE, JOIN_DATE) 
                         VALUES ('$business_id', '$fname', '$lname', '$birth_date', '$age', '$gender','$address','$category', '$encryptedContact', '$encryptedEmail', '$encryptedPassword', '$term_condition', NOW())";


            $verification_insert_query = "INSERT INTO business_verification (B_KEY,B_ID) VALUES ('$encryption_key','$business_id')";

            $business_profile_insert_query = "INSERT INTO business_profile(USER_ID,FNAME,LNAME,BIRTH_DATE,GENDER,ADDRESS,CATEGORY,UPDATE_TIME,B_ID) VALUES ('$business_user_id','$fname', '$lname', '$birth_date', '$gender','$address','$category',NOW(),'$business_id')";

            $business_profile_result = mysqli_query($GLOBALS['connect'],$business_profile_insert_query);
            $register_query_result = mysqli_query($GLOBALS['connect'],$register_insert_query);
            $verification_query_result = mysqli_query($GLOBALS['connect'],$verification_insert_query);

            echo $register_insert_query;
            if ($register_query_result && $verification_query_result) {
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

            $email = $_SESSION['email'];
            send_code($email);

            $_SESSION['greet-message'] = "Congratulations !!! You are registered Successfully.";
            $_SESSION['message'] = "Verification Code Sent Successfully.";
            header("location:/user/businessman/register/form/business_register.php");
            exit;
        }
        function send_code($email){
                $subject = "Verification Code From Connect2Local";

                $name = $_SESSION['fname'] ." ". $_SESSION['lname'];
                $verification_code = generateVerificationCode();
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

        function send_notification(){

        }

        function store_data(){

        }
?>