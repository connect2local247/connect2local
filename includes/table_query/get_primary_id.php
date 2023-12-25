<?php

    session_start();

    function getCustomerRegisterId($email="",$contact=""){
        $connect = $GLOBALS['connect'];
        
        $contact_pattern = '/^\d{10}$/';
        if($email != ""){
            $is_email_exist = find_encrypted_data($email,"customer_register","customer_verification","C_ID","C_EMAIL","C_KEY","C_ID");

            if($is_email_exist){
                getRegisteredData("C_ID","customer_register");
            }
        } else if($contact != "" && preg_match($contact_pattern,$contact) ){

        }
    }

?>