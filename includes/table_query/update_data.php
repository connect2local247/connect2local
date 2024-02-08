<?php 

        function updateDataAdmin(){

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
            $result = mysqli_query($GLOBALS['connect'],$update_query);

            if($result){
                return true;
            }
        }

        return false;
        }

?>