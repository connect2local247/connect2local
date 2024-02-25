<?php 

        function updateDataAdmin(){

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

            $update_query = "UPDATE admin_login SET admin_email = '$encryptDbEmail', admin_password = '$encryptDbPassword', admin_otp = $new_admin_otp WHERE admin_id = 1";
         
            $result = mysqli_query($GLOBALS['connect'],$update_query);

            if($result){
                return true;
            }
        }

        return false;
        }

?>