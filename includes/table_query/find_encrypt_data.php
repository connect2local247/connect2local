<?php

        include "db_connection.php";
        require "/connect2local/includes/security_function/secure_function.php";



        function find_encrypted_data($data, $table_name1, $table_name2, $col_name_id, $col_name_data, $col_name_key, $common_column) {
            $query = "SELECT $table_name1.$col_name_id, $table_name2.$col_name_key, $table_name1.$col_name_data 
          FROM $table_name1
          INNER JOIN $table_name2 ON $table_name1.$common_column = $table_name2.$common_column
          WHERE 1";


            
            $result = mysqli_query($GLOBALS['connect'], $query);
        
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $encryptData = $row[$col_name_data];
                    $key = $row[$col_name_key];
                    $decryptData = decryptData($encryptData, $key);
        
                    if ($data == $decryptData) {
                        $_SESSION['data'] = $decryptData;
                        return true;
                    }
                }
            } else {
                echo "Error in the query: " . mysqli_error($GLOBALS['connect']);
            }
            
            return false;
        }
        
?>