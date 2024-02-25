<?php
        session_start();

        include "../../../../includes/table_query/db_connection.php";
        require "../../../../includes/table_query/find_encrypt_data.php";
        require "../../../../includes/code_generator/code_generator.php";
        require "../../../../includes/table_query/get_primary_key.php";
        require "../../../../includes/email_template/email_sending.php";


        if(isset($_SESSION['error'])){
            unset($_SESSION['error']);
        }
       
        function send_verification_link($email,$verification_link){

          $subject = "Verification Link of Admin";

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
              <h2 style='color: #333; margin: 10px 0;'>$verification_link</h2>
          </div>
      </div>

  </div>
";

$_SESSION['message'] = "Security Key Sent Successfully";
send_mail("",$email,$subject,$template);
}

        function check_email_exists($email){
          $query = "SELECT admin_id,admin_email,admin_otp FROM admin_login WHERE admin_id = 1";
          $result = mysqli_query($GLOBALS['connect'],$query);
          if(mysqli_num_rows($result) > 0){
                 
                  $row = mysqli_fetch_assoc($result);
                  $admin_id = $row['admin_id'];
                  $admin_otp = $row['admin_otp'];
                  $db_email = decryptData($row['admin_email'],$row['admin_otp']);
                  // die($db_email);
         
                      if($email == $db_email){
                              return true;
                      } else{
                          $_SESSION['error'] = "Email Doesn't Matched";
                      }
                  
                    }
                    return false;
        }

  
        if(isset($_POST['submit'])){
            $email = $_POST['email'];

                $col_name = "verification_token";
                $verification_token = generateVerificationToken($col_name);
                $verification_link = "http://connect2local/user/admin/login/form/forgot-password.php?verification_token=$verification_token";

            if(check_email_exists($email)){
              $update_query = "UPDATE admin_login SET verification_token = '$verification_token' WHERE admin_id = 1";
              $result = mysqli_query($GLOBALS['connect'],$update_query);
              // die($update_query);
                $_SESSION['email-verification'] = $email;
                
                    $_SESSION['message'] = "Verification Link Sent Successfully";
                    send_verification_link($email,$verification_link);

                    unset($_SESSION['error']);
                    header("location:/user/admin/login/form/admin-email-verification.php");
                    exit;
            } else{
                $_SESSION['admin-email-verification']="";
            }

            if(isset($_SESSION['message'])){
                $_SESSION['message'] = "";
            }
            header("location:/user/admin/login/form/admin-email-verification.php");

        }
?>