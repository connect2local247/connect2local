<?php

function get_encrypted_data($data, $table_name1, $table_name2, $col_name_id, $col_name_data, $col_name_key, $common_column) {
    $query = "SELECT $table_name1.$col_name_id, $table_name2.$col_name_key, $table_name1.$col_name_data 
  FROM $table_name1
  INNER JOIN $table_name2 ON $table_name1.$common_column = $table_name2.$common_column
  WHERE 1";


    
    $result = mysqli_query($GLOBALS['connect'], $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $encryptData = $row[$col_name_data];
            $key = $row[$col_name_key];
            $id = $row[$col_name_id];
            $decryptData = decryptData($encryptData, $key);

            if ($data == $decryptData) {
                $_SESSION['data'] = $decryptData;
                $encryptedDataArray = [
                    "id" => $id,
                    "key" => $key,
                    "encryptData" => $encryptData,
                ];
                return $encryptedDataArray;
            }
        }
    } else {
        echo "Error in the query: " . mysqli_error($GLOBALS['connect']);
    }
    
    return false;
}


function get_email_from_token($verification_token,$table_name,$register_table,$col_name_token,$key_col_name,$col_name_id){
    $get_data_query = "SELECT $key_col_name,$col_name_id FROM $table_name WHERE $col_name_token = '$verification_token'";
    $result = mysqli_query($GLOBALS['connect'],$get_data_query);
    

    if($result){
        $row = mysqli_fetch_assoc($result);

        $key = $row[$key_col_name];
        $id = $row[$col_name_id];

        $encryptedEmail = retrieveEncryptedEmail($id,$register_table);
        
        $decryptEmail = decryptData($encryptedEmail,$key);
    }

    return $decryptEmail;
}

function retrieveEncryptedEmail($primaryKey, $table) {
    // Determine the table and column names based on the provided table
    $emailColumn = ($table === 'customer_register') ? 'c_email' : 'b_email';
    $idColumn = ($table === 'customer_register') ? 'c_id':'b_id';
    // Retrieve the encrypted email based on the primary key
    $query = "SELECT $emailColumn FROM $table WHERE {$idColumn} = '$primaryKey'";
    $result = mysqli_query($GLOBALS['connect'], $query);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        return $row[$emailColumn];
    } else {
        return null; // Primary key not found or query error
    }
}

?>