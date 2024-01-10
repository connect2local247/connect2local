<?php

        include "/connect2local/includes/table_query/db_connection.php";
        require "/connect2local/includes/code_generator/code_generator.php";

        function generateEncryptionKey() {
            do {
                $key = generateSecurityKey();
                $check_exist_query = "SELECT C_KEY FROM customer_verification WHERE C_KEY = $key";
                $result = mysqli_query($GLOBALS['connect'], $check_exist_query);
            } while (mysqli_num_rows($result) > 0);
        
            return $key;
        }
        
        function generateUniqueID($prefix) {

            // Get the last used ID from the database or initialize to 0
            $lastID = getLastUsedIDFromDatabase($prefix);
            // $lastID = 0000001;
            // Increment the last ID
            $nextID = $lastID + 1;

            if(strlen($prefix) > 3){
                // Format the ID to have leading zeros (6 digits)
                $formattedID = sprintf("%06d", $nextID);
            } else{
                // Format the ID to have leading zeros (7 digits)
                $formattedID = sprintf("%07d", $nextID);
            }

            // Concatenate prefix and formatted ID
            $uniqueID = $prefix . $formattedID;

            return $uniqueID;
        }

        function getLastUsedIDFromDatabase($prefix) {
            if(strlen($prefix) > 3){
                $query = "SELECT MAX(B_ID) FROM business_register WHERE 1";
                $result = mysqli_query($GLOBALS['connect'], $query);
            } else{
                $query = "SELECT MAX(C_ID) FROM customer_register WHERE 1";
                $result = mysqli_query($GLOBALS['connect'], $query);
            }
        
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                $last_id_with_prefix = $row[0];
        
                // Check if the result is NULL (empty table)
                if ($last_id_with_prefix === null) {
                    $last_id = 0; // Set a default value for an empty table
                } else {
                    if(strlen($prefix) > 3){
                        // Remove the prefix by extracting the last 6 digits
                        $last_id = substr($last_id_with_prefix, 4);
                    } else{
                        // Remove the prefix by extracting the last 7 digits
                        $last_id = substr($last_id_with_prefix, 3);
                    }
                }
            } else {
                echo "No Such Rows Affected.<br>";
                $last_id = 0; // Set a default value if there is an issue with the query
            }
        
            return $last_id;
        }

        function generateUniqueBusinessCode() {
            $prefix = "C2L"; // 3-letter prefix
            $lastID = getLastUsedBusinessCodeFromDatabase();
        
            // Increment the last ID
            $nextID = $lastID + 1;
        
            // Format the ID to have leading zeros (4 digits)
            $formattedID = sprintf("%04d", $nextID);
        
            // Concatenate prefix and formatted ID
            $uniqueBusinessCode = $prefix . $formattedID;
        
            return $uniqueBusinessCode;
        }
        
        function getLastUsedBusinessCodeFromDatabase() {
            $prefix = "C2L"; // 3-letter prefix
            $query = "SELECT MAX(BUSINESS_CODE) FROM business_info WHERE BUSINESS_CODE LIKE '{$prefix}%'";
        
            $result = mysqli_query($GLOBALS['connect'], $query);
        
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                $lastBusinessCodeWithPrefix = $row[0];
        
                // Check if the result is NULL (empty table)
                if ($lastBusinessCodeWithPrefix === null) {
                    $lastID = 0; // Set a default value for an empty table
                } else {
                    // Remove the prefix by extracting the last 4 digits
                    $lastID = intval(substr($lastBusinessCodeWithPrefix, strlen($prefix)));
                }
            } else {
                echo "No Such Rows Affected.<br>";
                $lastID = 0; // Set a default value if there is an issue with the query
            }
        
            return $lastID;
        }
        
?>