<?php
    session_start();

    include "../../../../includes/table_query/db_connection.php";
    include "../../../../includes/security_function/secure_function.php";

    if(isset($_SESSION['error'])){
      unset($_SESSION['error']);
    }
    if(isset($_POST['submit'])){
          $email = $_POST['email'];
          $password = $_POST['password'];

          
          $fetch_data_admin = "SELECT admin_email,admin_password,admin_otp as skey FROM admin_login WHERE 1";
          $result = mysqli_query($GLOBALS['connect'],$fetch_data_admin);
          // die($fetch_data_admin);
          if ($row = mysqli_fetch_assoc($result)) {
            $db_skey = $row['skey'];
            $db_email = decryptData($row['admin_email'],$db_skey);
            $db_password = decryptData($row['admin_password'],$db_skey);

            if($db_email != $email){
                  $encryptEmail = encryptData($email,$db_skey);
                  
                  $update_query = "UPDATE admin_login SET admin_email = '$encryptEmail',admin_otp = $db_skey WHERE 1";
                  $result = mysqli_query($GLOBALS['connect'],$update_query);
                  
                  if($result){
                    $_SESSION['greet-message'] = "Email Updated Successfully";
                    unset($_SESSION['error']);
                  } else{
                    $_SESSION['error'] = "Update Failed";
                  }
                  
                  header("location:/user/admin/dashboard/dashboard.php?content=account");
                }
                
                if($db_password != $password){
               $encryptPassword = encryptData($password,$db_skey);
                $update_query = "UPDATE admin_login SET admin_password = '$encryptPassword', admin_otp = $db_skey WHERE 1";
                $result = mysqli_query($GLOBALS['connect'],$update_query);

                // die($update_query);
                if($result){
                  $_SESSION['greet-message'] = "Password Updated Successfully";
                  unset($_SESSION['error']);
                } else{
                  $_SESSION['error'] = "Update Failed";
                }
                header("location:/user/admin/dashboard/dashboard.php?content=account");
                
            }
          }
    }
?>  