<?php
            session_start();

            include "../../../../includes/table_query/db_connection.php";
            require "../../../../includes/code_generator/code_generator.php";
            require "../../../../includes/security_function/secure_function.php";
            include "../../../../includes/email_template/email_sending.php";

            if(isset($_SESSION['error'])){
                unset($_SESSION['error']);
            }

         function resend_admin_otp($email,$code){

            $subject = "New Security Key of Admin";

            $template = "
    <div style='max-wadmin_idth: 600px; margin: 0 auto; padding: 20px; font-family: \"Arial\", sans-serif; background-color: #f8f8f8;'>

        <div style='text-align: center;'>
            <img src='https://live.staticflickr.com/65535/53417631216_2be8f41b9e_n.jpg' alt='Connect2local' style='max-wadmin_idth: 100px;'>
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

                        $new_admin_otp = generateSecurityKey();

                        $get_data_query = "SELECT admin_email,admin_password,admin_otp FROM admin_login WHERE admin_id = 1";

                        $result = mysqli_query($GLOBALS['connect'],$get_data_query);

                        if(mysqli_num_rows($result) > 0){
                            $row = mysqli_fetch_assoc($result);

                            $key = $row['admin_otp'];
                            $db_email = decryptData($row['admin_email'],$row['admin_otp']);
                            $db_password = decryptData($row['admin_password'],$row['admin_otp']);

                            $encryptDbEmail = encryptData($db_email,$new_admin_otp); 
                            $encryptDbPassword = encryptData($db_password,$new_admin_otp); 

                            $update_query = "UPDATE admin_login SET admin_email = '$encryptDbEmail', admin_password = '$encryptDbPassword', admin_otp = '$new_admin_otp' WHERE admin_id = 1";
                            // die($update_query);
                            $result = mysqli_query($GLOBALS['connect'],$update_query);

                            if($result){
                                resend_admin_otp($db_email,$new_admin_otp);
                                return $new_admin_otp;
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