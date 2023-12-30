<?php
        session_start();

        include "../../../../includes/table_query/db_connection.php";
        include "../../../../includes/table_query/find_encrypt_data.php";


        if(isset($_SESSION['error'])){
            unset($_SESSION['error']);
        }

        function validate_input($fname,$lname,$birth_date,$address,$contact,$email,$password,$confirm_password){
            $name_pattern = "/^[A-Z][a-z]{0,14}$/";
            $contact_pattern = '/^\d{10}$/';
            $email_pattern = '/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
            $password_pattern = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@#_$])[\w@#_$]{8,16}$/";
            $address_pattern = '/^[A-Za-z ]{8,50}+$/';

            
            $age = get_age($birth_date);

            if($age < 18){
                $_SESSION['error'] = "You are not eligible to use our platform.";
                return false;
            }

            if(preg_match($name_pattern,$fname)){
                    if(preg_match($name_pattern,$lname)){
                        if(preg_match($address_pattern,$address)){
                             if(preg_match($contact_pattern,$contact)){
                                 if(preg_match($email_pattern,$email)){
                                     if(preg_match($password_pattern,$password)){
                                                
                                                if(is_password_matched($password,$confirm_password)){
                                                    
                                                    if(check_exist_email($email)){
                                                        $_SESSION['error'] = "Email Already Exists";
                                                        return false;
                                                    }
                                        
                                                    if(check_exist_contact($contact)){
                                                        $_SESSION['error'] = "Phone Number Already Exists";
                                                        return false;
                                                    }
                                                    
                                                    return true; 

                                                } else{
                                                    $_SESSION['error'] = "Password Doesn't Matched";
                                                }
                                                

                                             } else{
                                                $_SESSION['error'] = "Password Must Contain Uppercase,Lowercase or (@,_,#,$).";
                                             }
                                        } else{
                                            $_SESSION['error'] = "Please Enter Email in Valid Format.";
                                        }
                                } else{
                                    $_SESSION['error'] = "Please Enter Valid Phone Number.";
                                }
                            }else{
                                $_SESSION['error']= "Address does not match the expected format.";
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
            if(find_encrypted_data($email,"business_register","business_verification","B_ID","B_EMAIL","B_KEY","B_ID")){
                return true;
            }

            return false;
        }

        function check_exist_contact($contact){
            if(find_encrypted_data($contact,"business_register","business_verification","B_ID","B_CONTACT","B_KEY","B_ID")){
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
        
        function is_password_matched($password,$confirm_password){
            if($password == $confirm_password){
                return true;
            }
            return false;
        }
        
        
        function store_data($fname,$lname,$birth_date,$age,$gender,$address,$category,$contact,$email,$password,$confirm_password){
                $_SESSION['fname'] = $fname;
                $_SESSION['lname'] = $lname;
                $_SESSION['birth-date'] = $birth_date;
                $_SESSION['age'] = $age;
                $_SESSION['gender'] = $gender;
                $_SESSION['address'] = $address;
                $_SESSION['category'] = $category;
                $_SESSION['contact'] = $contact;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                $_SESSION['conf-password'] = $confirm_password;
        }

        if(isset($_POST['submit'])){
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $birth_date = $_POST['birth-date'];
            $gender = $_POST['gender'];
            $address = $_POST['address'];
            $category = $_POST['category'];
            $contact = $_POST['contact'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['conf-password'];
            $term_condition = $_POST['agree-terms'];

            $age = get_age($birth_date);

            if($term_condition){
                $term_agree = "Yes";
            } else{
                $term_agree = "No";
            }
            $_SESSION['term-condition'] = $term_agree;
            store_data($fname,$lname,$birth_date,$age,$gender,$address,$category,$contact,$email,$password,$confirm_password);

            if(validate_input($fname,$lname,$birth_date,$address,$contact,$email,$password,$confirm_password)){
                        if($_SESSION['term-condition'] == "Yes"){
                            unset($_SESSION['error']);
                            unset($_SESSION["conf-password"]);
                            store_data($fname,$lname,$birth_date,$age,$gender,$address,$category,$contact,$email,$password,$confirm_password);
                            header("location:/user/businessman/register/code/data_insertion.php");
                            exit;
                        } else{
                            $_SESSION['error'] = "You are not agreed with our policy";
                        }
            }

            header("location:/user/businessman/register/form/business_register.php");
        }
?>