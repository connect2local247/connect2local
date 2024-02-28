<?php
        session_start();

        include "../../../../includes/table_query/db_connection.php";
        require "../../../../includes/code_generator/primary_key_generator.php";
        require "../../../../includes/table_query/find_encrypt_data.php";
        require "../../../../includes/table_query/get_encrypted_data.php";
        require "../../../../includes/table_query/get_primary_key.php";
        require "../../../../includes/email_template/email_sending.php";
        include "../../../../includes/table_query/get_notification_data.php";


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
            $descriptionPattern = '/^[\s\S]{10,150}$/';
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

        function validateOptionalLinks($webUrl, $instaUrl, $fbUrl, $xUrl, $linkedinUrl,$operateTime) {
            $urlPattern = '/^https?:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,}(:[0-9]+)?(\/[^\s]*)?$/';
            $facebookPattern = '/^(https?:\/\/)?(www\.)?facebook\.com\/.*/i';
            $instagramPattern = '/^(https?:\/\/)?(www\.)?instagram\.com\/.*/i';
            $linkedinPattern = '/^(https?:\/\/)?(www\.)?linkedin\.com\/.*/i';
            $xPattern = '/^(https?:\/\/)?(www\.)?x\.com\/.*/i';
            $timePattern = '/^(Mon|Tue|Wed|Thu|Fri|Sat|Sun)\s*-\s*(Mon|Tue|Wed|Thu|Fri|Sat|Sun)\s+\d{1,2}:\d{2}\s*[ap]\.m\.\s*-\s*\d{1,2}:\d{2}\s*[ap]\.m\.$/';

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
        
            // Validate x URL
            if (!empty($xUrl) && !preg_match($xPattern, $xUrl)) {
                $_SESSION['error'] = "Invalid x URL format.";
                $isValid = false;
            } else{
                $_SESSION['x-url'] = $xUrl;
            }
        
            // Validate LinkedIn URL
            if (!empty($linkedinUrl) && !preg_match($linkedinPattern, $linkedinUrl)) {
                $_SESSION['error'] = "Invalid LinkedIn URL format.";
                $isValid = false;
            } else{
                $_SESSION['linkedin-url'] = $linkedinUrl;
            }
         // Validate Operating Time
            // die($operateTime);
            if (!empty($operateTime) && !preg_match($timePattern, $operateTime)) {
                $_SESSION['error'] = "Invalid Operating Time format (24-hour format).";
                $isValid = false;
            } else{
                $_SESSION['operate-time'] = $operateTime;
            }

            return $isValid;
        }
        

        function check_exist_email($email){
            if(find_encrypted_data($email,"business_register","business_verification","b_id","b_email","b_key","b_id")){
                return true;
            }

            return false;
        }

        function check_exist_contact($contact,$email){
            if(find_encrypted_data($contact,"business_register","business_verification","b_id","b_contact","b_key","b_id")){
                $contact_business_id = get_primary_key($contact,"business_register","business_verification","b_id","b_contact","b_key","b_id");
                $email_business_id = get_primary_key($email,"business_register","business_verification","b_id","b_email","b_key","b_id");

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

        function get_name($business_id){
            $name_query = "SELECT b_fname,b_lname FROM business_register WHERE b_id = '$business_id'";

            $result = mysqli_query($GLOBALS['connect'],$name_query);

            if(mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_assoc($result);

                        $name_array = [
                            "fname" => $row['b_fname'],
                            "lname" => $row['b_lname']
                        ];

                        return $name_array;
            }

            return "";
        }

        function check_duplication($email,$contact){
                if(find_encrypted_data($email,"business_info","business_verification","business_code","bi_email","b_key","b_key")){
                    $_SESSION['error'] = "Email Already Exists";
                    return false;
                } else if(find_encrypted_data($contact,"business_info","business_verification","business_code","bi_contact","b_key","b_key")){
                    $_SESSION['error'] = "Phone Number Already Exists";
                    return false;
                }
                return true;
        }
        function insert_request($business_code,$request_id){
            $check_query = "SELECT `request_time` FROM `business_add_status` WHERE `business_code` = '$business_code'";
            $result = mysqli_query($GLOBALS['connect'], $check_query);
            
            if(mysqli_num_rows($result) == 0) {
                // No existing entry with the same business_code, so insert data
                $insert_query = "INSERT INTO `business_add_status`(`request_id`, `business_code`,`request_time`) VALUES ('$request_id','$business_code',NOW())";
                mysqli_query($GLOBALS['connect'], $insert_query);
                return true;
                // Handle success or error
            } else {
                $row = mysqli_fetch_assoc($result);
                $existing_request_time = strtotime($row['request_time']);
                $current_time = time();
                $time_difference = $current_time - $existing_request_time;
                
                if($time_difference >= 2 * 24 * 60 * 60) {
                    // More than 2 days have passed since the existing request_time, so insert data
                    $insert_query = "INSERT INTO `business_add_status`(`request_id`, `business_code`,`request_time`) VALUES ('$request_id','$business_code',NOW())";
                    mysqli_query($GLOBALS['connect'], $insert_query);
                    return true;
                    // Handle success or error
                } else {
                    $_SESSION['error'] = "Please Wait For 2 Days";
                }
            }
            return false;
        }

        function send_greet_mail($email,$fname,$lname){
            $name = $fname."".$lname;

            $subject = "Request Submission Mail From Connect2Local";
            
                        $template = "
                <div style='max-width: 600px; margin: 0 auto; padding: 20px; font-family: \"Arial\", sans-serif; background-color: #f8f8f8;'>

                    <div style='text-align: center;'>
                        <img src='https://live.staticflickr.com/65535/53417631216_2be8f41b9e_n.jpg' alt='Connect2local' style='max-width: 100px;'>
                    </div>

                    <div style='text-align: center;'>
                        <h1 style='color: #333; margin-top: 10px;'>Connect2Local</h1>
                    </div>

                    <div>
                        <p>Hello $name,</p>

                        <p>Thank you for choosing Connect2Local! We've received your business request and are excited to have you on board.</p>

                        <p>Our team is currently reviewing and validating your information. You can expect a follow-up email regarding the approval or denial of your business request within the next 48 hours.</p>

                        <p>If you have any urgent inquiries or concerns, please don't hesitate to reach out to us through our support system or help center.</p>

                        <p style='color: #555; margin-top: 20px;'>Best regards,<br>Connect2Local Team</p>
                    </div>

                </div>
            ";
            $_SESSION['message'] = "Your Request has been submitted";
            send_mail($name,$email,$subject,$template);
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
            $x_url = isset($_POST['twit-link']) ? $_POST['twit-link'] : '';
            $linkedin_url = isset($_POST['linkedin-link']) ? $_POST['linkedin-link'] : '';


            store_data($business_name,$category,$email,$phone,$address,$description);
            
            if(validate_data($business_name,$email,$phone,$address,$description)){
                if(validateOptionalLinks($web_url,$insta_url,$fb_url,$x_url,$linkedin_url,$operate_time)){
                    if(check_exist_email($email)){
                        if(check_exist_contact($phone,$email)){
                            if(check_duplication($email,$phone)){
                                
                            $business_code = generateUniqueBusinessCode();
                            $business_id =get_primary_key($email,"business_register","business_verification","b_id","b_email","b_key","b_id");
                            $name_array = get_name($business_id);

                            $dataArray = get_encrypted_data($email,"business_register","business_verification","b_id","b_email","b_key","b_id");

                            $key = $dataArray['key'];
                            $fname = $name_array['fname'];
                            $lname = $name_array['lname'];
                            $encryptedEmail = encryptData($email,$key);
                            $encryptedPhone = encryptData($phone,$key);

                                    $insert_query = "INSERT INTO `business_info`(`business_code`, `bi_fname`, `bi_lname`, `business_name`, `bi_category`, `bi_address`, `bi_operate_time`, `bi_contact`, `bi_email`, `bi_web_url`, `bi_ig_url`, `bi_fb_url`, `bi_twitter_url`, `bi_linkedin_url`, `bi_description`, `b_key`, `b_id`)VALUES ('$business_code','$fname','$lname','$business_name','$category','$address','$operate_time','$encryptedPhone','$encryptedEmail','$web_url','$insta_url','$fb_url','$x_url','$linkedin_url','$description',$key,'$business_id')";
                                    $result = mysqli_query($GLOBALS['connect'],$insert_query); 
                                    
                                    //    die($insert_query); 
                                    if($result){
                                        $request_id = generateUniqueID("business_add_status","C2LR","request_id");
                                        $result = insert_request($business_code,$request_id);
                                        if($result){
                                            send_greet_mail($email,$fname,$lname);
                                            sent_notification("request","has requested to add their business",$business_id);
                                            $_SESSION['greet-message'] = "Your Request Sent Successfully";
                                            unset($_SESSION['error']);
                                        }
                                    } else{
                                        $_SESSION['error'] = "Something went Wrong While Adding Your Business.";
                                    }
                            }
                          }
                        } else{
                            $_SESSION['error'] = "Email Doesn't Exists.";
                        }
                    }
            }

            header("location:/user/businessman/add_business/form/add-business-form.php");
            exit();
        }

?>