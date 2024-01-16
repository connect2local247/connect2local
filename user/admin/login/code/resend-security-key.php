<?php
            session_start();

            include "/connect2local/includes/table_query/db_connection.php";
            require "/connect2local/includes/code_generator/code_generator.php";
            require "/connect2local/includes/security_function/secure_function.php";
            include "/connect2local/includes/email_template/email_sending.php";

            if(isset($_SESSION['error'])){
                unset($_SESSION['error']);
            }

         function resend_security_key($email,$code){

            $subject = "New Security Key of Admin";

            $template = "
    <div style='max-width: 600px; margin: 0 auto; padding: 20px; font-family: \"Arial\", sans-serif; background-color: #f8f8f8;'>

        <div style='text-align: center;'>
            <img src='https://live.staticflickr.com/65535/53417631216_2be8f41b9e_n.jpg' alt='Connect2local' style='max-width: 100px;'>
        </div>

        <div style='text-align: center;'>
            <h1 style='color: #333; margin-top: 10px;'>Connect2Local</h1>
        </div>

        <div>
        
            <p>Your new login security key for Connect2Local is:</p>

            <div style='background-color: #ffffff; padding: 10px; text-align: center; border-radius: 8px;'>
                <h2 style='color: #333; margin: 10px 0;'>$code</h2>
            </div>
        </div>

    </div>
";

$_SESSION['message'] = "Security Key has been Resent Successfully";
send_mail("",$email,$subject,$template);
}
        function getNewSecurityKeyFromDatabase(){

                        $new_security_key = generateSecurityKey();

                        $get_data_query = "SELECT EMAIL,PASSWORD,SECURITY_KEY FROM admin_login WHERE ID = 1";

                        $result = mysqli_query($GLOBALS['connect'],$get_data_query);

                        if(mysqli_num_rows($result) > 0){
                            $row = mysqli_fetch_assoc($result);

                            $key = $row['SECURITY_KEY'];
                            $db_email = decryptData($row['EMAIL'],$row['SECURITY_KEY']);
                            $db_password = decryptData($row['PASSWORD'],$row['SECURITY_KEY']);

                            $encryptDbEmail = encryptData($db_email,$new_security_key); 
                            $encryptDbPassword = encryptData($db_password,$new_security_key); 

                            $update_query = "UPDATE admin_login SET EMAIL = '$encryptDbEmail', PASSWORD = '$encryptDbPassword', SECURITY_KEY = '$new_security_key' WHERE ID = 1";
                            // die($update_query);
                            $result = mysqli_query($GLOBALS['connect'],$update_query);

                            if($result){
                                resend_security_key($db_email,$new_security_key);
                                return $new_security_key;
                            }
                        }

                        return 0;
        }

        if(isset($_GET['resend_key'])){
            if($_GET['resend_key'] == 1){
                if(isset($_SESSION['code_attempts'])){
                    if($_SESSION['code_attempts'] <= 5){
                            getNewSecurityKeyFromDatabase();
                        } else{
                            $_SESSION['error'] = "Too Many attempts. Please try again after 24 hours";
                        }
                    }
                }
        }
        
        header("location:/user/admin/login/form/admin-verification.php");
        exit();

?>