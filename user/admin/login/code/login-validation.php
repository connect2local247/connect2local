<?php
        session_start();

        include "/connect2local/includes/table_query/db_connection.php";
        include "/connect2local/includes/security_function/secure_function.php";
        require "/connect2local/includes/code_generator/code_generator.php";
        include "/connect2local/includes/table_query/update_data.php";
        include "/connect2local/includes/email_template/email_sending.php";

        if(isset($_SESSION['error'])){
            unset($_SESSION['error']);
        }

        function isEncrypted($data) {
            // Define a regular expression pattern for detecting common characteristics of encrypted data
            $encryptedPattern = '/^[A-Za-z0-9+\/=]+\s*$/';
        
            // Check if the data matches the pattern
            if (preg_match($encryptedPattern, $data)) {
                return true;
            } else {
                return false;
            }
        }

        function send_security_code($email,$code){

                        $subject = "Security Key of Admin";

                        $template = "
                <div style='max-wadmin_idth: 600px; margin: 0 auto; padding: 20px; font-family: \"Arial\", sans-serif; background-color: #f8f8f8;'>

                    <div style='text-align: center;'>
                        <img src='https://live.staticflickr.com/65535/53417631216_2be8f41b9e_n.jpg' alt='Connect2local' style='max-wadmin_idth: 100px;'>
                    </div>

                    <div style='text-align: center;'>
                        <h1 style='color: #333; margin-top: 10px;'>Connect2Local</h1>
                    </div>

                    <div>
                    
                        <p>Your login security key for Connect2Local is:</p>

                        <div style='background-color: #ffffff; padding: 10px; text-align: center; border-radius: 8px;'>
                            <h2 style='color: #333; margin: 10px 0;'>$code</h2>
                        </div>
                    </div>

                </div>
            ";

            $_SESSION['message'] = "Security Key Sent Successfully";
            send_mail("",$email,$subject,$template);
        }

        function match_credential($email,$password){
            $query = "SELECT admin_id,admin_email,admin_password,admin_otp FROM admin_login WHERE admin_id = 1";
            $result = mysqli_query($GLOBALS['connect'],$query);
            if(mysqli_num_rows($result) > 0){

                    $row = mysqli_fetch_assoc($result);
                    $admin_id = $row['admin_id'];
                    $db_email = $row['admin_email'];
                    $db_password = $row['admin_password'];
                    $admin_otp = $row['admin_otp'];

                    echo $db_email."<br>".$db_password;
                    if(!isEncrypted($db_email) || !isEncrypted($db_password)){
                        $key = generateSecurityKey();
                        $encryptDbEmail = encryptData($db_email,$key); 
                        $encryptDbPassword = encryptData($db_password,$key); 

                        $update_query = "UPDATE admin_login SET admin_email = '$encryptDbEmail',admin_otp = '$key' WHERE admin_id = $admin_id";
                        $result = mysqli_query($GLOBALS['connect'],$update_query);
                        
                        if(!$result){
                            die($update_query);
                        } 
                        $update_query = "UPDATE admin_login SET admin_password = '$encryptDbPassword',admin_otp = '$key' WHERE admin_id = $admin_id";
                        $result = mysqli_query($GLOBALS['connect'],$update_query);

                        if(!$result){
                            die($update_query);
                        } 

                        $_SESSION['error'] = "Login Failed !!! Try Again";
                        return false;
                    }
                        $decryptDbEmail = decryptData($db_email,$admin_otp);
                        $decryptDbPassword = decryptData($db_password,$admin_otp);

                        echo "<br>".$decryptDbEmail."<br>".$decryptDbPassword;
                        // die();
                        // echo $decryptDbEmail."<br>".$decryptDbPassword;
                        // die();
                        if($email == $decryptDbEmail){
                            if($password == $decryptDbPassword){

                                updateDataAdmin();
                                
                                $query = "SELECT admin_otp FROM admin_login WHERE admin_id = 1";
                                $result = mysqli_query($GLOBALS['connect'],$query);
                                
                                if(mysqli_num_rows($result) > 0 ){

                                    $row = mysqli_fetch_assoc($result);

                                    $key = $row['admin_otp'];

                                    $_SESSION['greet-message'] = "Login Detail Matched.";
                                    unset($_SESSION['error']);
                                    send_security_code($email,$key);
                                }
                                return true;
                            } else{
                                $_SESSION['error'] = "Password Doesn't Matched";
                            }
                        } else{
                            $_SESSION['error'] = "Email Doesn't Matched";
                        }
                    

                    return false;
            }


        }
        if(isset($_POST['submit'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            if(match_credential($email,$password)){
                $_SESSION['greet-message'] = "Login Details Matched";
                unset($_SESSION['error']);  
            } 

            header("location:/user/admin/login/form/login.php");
        }


?>