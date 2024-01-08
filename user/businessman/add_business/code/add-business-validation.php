<?php
        session_start();

        include "/connect2local/includes/table_query/db_connection.php";
        require "/connect2local/includes/table_query/find_encrypt_data.php";
        require "/connect2local/includes/table_query/get_encrypted_data.php";
        require "/connect2local/includes/table_query/get_primary_key.php";


        if(isset($_SESSION['error'])){
            unset($_SESSION['error']);
        }

        function store_data($business_name,$category,$email,$phone,$address,$description){
            $_SESSION['business-name'] = $business_name;
            $_SESSION['category'] = $category;
            $_SESSION['email'] = $email;
            $_SESSION['contact'] = $phone;
            $_SESSION['address'] = $address;
            $_SESSION['description'] = $description;
        }

        function validate_data($business_name,$email,$phone,$address,$description){
            $businessNamePattern = '/^.{1,50}$/';
            $email_pattern = '/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
            $phone_pattern = '/^\d{10}$/';
            $addressPattern = '/^[A-Za-z0-9\s\-,\.]{1,100}$/';
            $descriptionPattern = '/^.{1,150}$/';
            $urlPattern = '/^https?:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,}(:[0-9]+)?(\/[^\s]*)?$/';
           
            if(preg_match($businessNamePattern,$business_name)){
                if(preg_match($email_pattern,$email)){
                    if(preg_match($phone_pattern,$phone)){
                        if(preg_match($addressPattern,$address)){
                            if(preg_match($descriptionPattern,$description)){
                                    return true;
                            } else{
                                $_SESSION['error'] =  "Maximum Length Reached of Description";
                            }
                        } else{
                            $_SESSION['error'] =  "Invalid Format For Address";
                        }
                    } else{
                        $_SESSION['error'] =  "Invalid Format For Phone Number";
                    }
                } else{
                    $_SESSION['error'] =  "Enter Email in Valid Format";
                }
            } else{
                $_SESSION['error'] =  "Max Length Reached For Business Name.";
            }

            return false;
        }

        function validateOptionalLinks($webUrl, $instaUrl, $fbUrl, $twitterUrl, $linkedinUrl,$operateTime) {
            $urlPattern = '/^https?:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,}(:[0-9]+)?(\/[^\s]*)?$/';
            $facebookPattern = '/^(https?:\/\/)?(www\.)?facebook\.com\/.*/i';
            $instagramPattern = '/^(https?:\/\/)?(www\.)?instagram\.com\/.*/i';
            $linkedinPattern = '/^(https?:\/\/)?(www\.)?linkedin\.com\/.*/i';
            $twitterPattern = '/^(https?:\/\/)?(www\.)?twitter\.com\/.*/i';
            $timePattern = '/^([A-Za-z]{3}-[A-Za-z]{3} [ap]\.m\.-[ap]\.m\.)|(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/';

            $isValid = true;
        
            // Validate Web URL
            if (!empty($webUrl) && !preg_match($urlPattern, $webUrl)) {
                $_SESSION['error'] = "Invalid Web URL format.";
                $isValid = false;
            } else{
                $_SESSION['web-url'] = $webUrl;
            }
        
            // Validate Instagram URL
            if (!empty($instaUrl) && !preg_match($instagramPattern, $instaUrl)) {
                $_SESSION['error'] = "Invalid Instagram URL format.";
                $isValid = false;
            } else{
                $_SESSION['insta-url'] = $instaUrl;
            }
        
            // Validate Facebook URL
            if (!empty($fbUrl) && !preg_match($facebookPattern, $fbUrl)) {
                $_SESSION['error'] = "Invalid Facebook URL format.";
                $isValid = false;
            } else{
                $_SESSION['fb-url'] = $fbUrl;
            }
        
            // Validate Twitter URL
            if (!empty($twitterUrl) && !preg_match($twitterPattern, $twitterUrl)) {
                $_SESSION['error'] = "Invalid Twitter URL format.";
                $isValid = false;
            } else{
                $_SESSION['twitter-url'] = $twitterUrl;
            }
        
            // Validate LinkedIn URL
            if (!empty($linkedinUrl) && !preg_match($linkedinPattern, $linkedinUrl)) {
                $_SESSION['error'] = "Invalid LinkedIn URL format.";
                $isValid = false;
            } else{
                $_SESSION['linkedin-url'] = $linkedinUrl;
            }
         // Validate Operating Time
            if (!empty($operateTime) && !preg_match($timePattern, $operateTime)) {
                $_SESSION['error'] = "Invalid Operating Time format (24-hour format).";
                $isValid = false;
            } else{
                $_SESSION['operate-time'] = $operateTime;
            }

            return $isValid;
        }
        

        function check_exist_email($email){
            if(find_encrypted_data($email,"business_register","business_verification","B_ID","B_EMAIL","B_KEY","B_ID")){
                return true;
            }

            return false;
        }

        function check_exist_contact($contact,$email){
            if(find_encrypted_data($contact,"business_register","business_verification","B_ID","B_CONTACT","B_KEY","B_ID")){
                $contact_business_id = get_primary_key($contact,"business_register","business_verification","B_ID","B_CONTACT","B_KEY","B_ID");
                $email_business_id = get_primary_key($email,"business_register","business_verification","B_ID","B_CONTACT","B_KEY","B_ID");

                if($contact_business_id === $email_business_id){
                    return true;
                } else{
                    $_SESSION['error'] = "It's Not Your Registered Phone Number";
                }

            } else{
                $_SESSION['error'] = "Phone Number Doesn't Exists";
            }
            return false;
        }

        if(isset($_POST['submit'])){
            $business_name  = $_POST['business-name'];
            $category = $_POST['category'];
            $email = $_POST['email'];
            $phone = $_POST['contact'];
            $address = $_POST['address'];
            $description = $_POST['description'];
        
            $operate_time = isset($_POST['operating-time']) ? $_POST['operating-time'] : '';
            $web_url = isset($_POST['web-url']) ? $_POST['web-url'] : '';
            $insta_url = isset($_POST['insta-link']) ? $_POST['insta-link'] : '';
            $fb_url = isset($_POST['fb-link']) ? $_POST['fb-link'] : '';
            $twitter_url = isset($_POST['twit-link']) ? $_POST['twit-link'] : '';
            $linkedin_url = isset($_POST['linkedin-link']) ? $_POST['linkedin-link'] : '';


            store_data($business_name,$category,$email,$phone,$address,$description);

            if(validate_data($business_name,$email,$phone,$address,$description)){
                    if(validateOptionalLinks($web_url,$insta_url,$fb_url,$twitter_url,$linkedin_url,$operate_time)){
                        if(check_exist_email($email)){
                                if(check_exist_contact($phone,$email)){
                                    $_SESSION['message'] = "Your Request has been submitted";
                                    // $_SESSION['add-request'] = ""
                                    unset($_SESSION['error']);
                                }
                        } else{
                            $_SESSION['error'] = "Email Doesn't Exists.";
                        }
                    }
            }

        }

?>