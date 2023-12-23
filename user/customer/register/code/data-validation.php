<?php
        session_start();

        include "../../../../includes/table_query/db_connection.php";
        include "../../../../includes/table_query/find_encrypt_data.php";

        function validate_input($fname,$lname,$birth_date,$contact,$email,$password){
            $name_pattern = "/^[A-Z][a-z]{0,14}$/";
            $contact_pattern = '/^\d{10}$/';
            $email_pattern = '/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
            $password_pattern = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@#$_])[\w@#$_]{8,16}$/";
            
            $age = get_age($birth_date);


            if(preg_match($name_pattern,$fname)){
                    if(preg_match($name_pattern,$lname)){
                         if(preg_match($date_pattern,$birth_date)){ 
                             if(preg_match($contact_pattern,$contact)){
                                 if(preg_match($email_pattern,$email)){
                                     if(preg_match($password_pattern,$password)){
                                                
                                                if($age < 18){
                                                     $_SESSION['error'] = "You are not eligible to use our platform.";
                                                     return false;
                                                 }

                                                return true; 
                                             } else{
                                                $_SESSION['error'] = "Password Must Contain Uppercase,Lowercase or (@,_,#,$).";
                                             }
                                        } else{
                                            $_SESSION['error'] = "Please Enter Email in Valid Format.";
                                        }
                                } else{
                                    $_SESSION['error'] = "Please Enter Valid Phone Number.";
                                }
                         } 
                    } else{
                        $_SESSION['error'] = "Please Enter Surname in Valid Format.";
                    }
            } else{
                $_SESSION['error'] = "Please Enter Name in Valid Format.";
            }

            return false;
        }

        function check_exist_email($email){
            if(find_encrypted_data($email,"customer_register","customer_verification","C_ID","C_EMAIL","C_KEY","C_ID")){
                return true;
            }

            return false;
        }

        function check_exist_contact($contact){
            if(find_encrypted_data($email,"customer_register","customer_verification","C_ID","C_CONTACT","C_KEY","C_ID")){
                return true;
            }
        }

        function get_age($birth_date) {
            // Convert the birth date to a DateTime object
            $birth_date = new DateTime($birth_date);
            
            // Get the current date
            $current_date = new DateTime();
        
            // Calculate the difference between the current date and the birth date
            $age_interval = $current_date->diff($birth_date);
        
            // Return the years from the interval
            $age = $age_interval->y;

            return $age;
        }
        
        
        
        function store_data($fname,$lname,$birth_date,$age,$gender,$contact,$email,$password){
                $_SESSION['fname'] = $fname;
                $_SESSION['lname'] = $lname;
                $_SESSION['birth_date'] = $birth_date;
                $_SESSION['age'] = $age;
                $_SESSION['gender'] = $gender;
                $_SESSION['contact'] = $contact;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
        }

        if(isset($_POST['submit'])){
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $birth_date = $_POST['birth-date'];
            $gender = $_POST['gender'];
            $contact = $_POST['contact'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $POST['conf-password'];
            $term_condition = $_POST['agree-terms'];

            $age = get_age($birth_date);

            if($term_condition){
                $term_agree = "Yes";
                $_SESSION['term-condition'] = $term_agree;
            } else{
                $term_agree = "No";
                $_SESSION['term-condition'] = $term_agree;
            }
            if(validate_input($fname,$lname,$birth_date,$contact,$email,$password)){
                        if($_SESSION['term-condition'] == "Yes"){
                            store_data($fname,$lname,$birth_date,$age,$gender,$contact,$email,$password);
                            header("location:/user/customer/register/code/data_insertion.php");
                        } else{
                            $_SESSION['error'] = "You are not agreed with our policy";
                        }
            }
        }
?>