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
        
        function generateUniqueID($table_name, $prefix,$primaryKeyColumn) {
            // Get the last used ID from the database or initialize to 0
            $lastID = getLastUsedIDFromDatabase($table_name,$primaryKeyColumn, $prefix);
        
            // Increment the last ID
            $nextID = $lastID + 1;
        
            // Determine the number of leading zeros based on the length of the prefix and total length constraint
            $numberOfZeros = max(0, 10 - strlen($prefix) - strlen($nextID));
        
            // Check if the total length exceeds 10 characters, adjust the numeric part accordingly
            $numericPart = substr($nextID, -$numberOfZeros);
            
            // Format the ID with the prefix and leading zeros
            $formattedID = $prefix . str_repeat('0', $numberOfZeros) . $numericPart;
        
            return $formattedID;
        }
        
        
        function getLastUsedIDFromDatabase($table_name, $primaryKeyColumn, $prefix) {
            $query = "SELECT MAX($primaryKeyColumn) FROM $table_name";
            $result = mysqli_query($GLOBALS['connect'], $query);
        
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                $last_id_with_prefix = $row[0];
        
                // Check if the result is NULL (empty table)
                if ($last_id_with_prefix === null) {
                    $last_id = 0; // Set a default value for an empty table
                } else {
                    // Remove the prefix by extracting the appropriate number of digits
                    $prefix_length = strlen($prefix);
                    $last_id = substr($last_id_with_prefix, $prefix_length);
                }
            } else {
                echo "Error in query: " . mysqli_error($GLOBALS['connect']) . "<br>";
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


        function generateUniqueBlogID() {
            $prefix = "BLG"; // 4-letter prefix
            $lastID = getLastUsedBlogIDFromDatabase();
        
            // Increment the last ID
            $nextID = $lastID + 1;
        
            // Format the ID to have leading zeros (11 digits)
            $formattedID = sprintf("%011d", $nextID);
        
            // Concatenate prefix and formatted ID
            $uniqueBlogID = $prefix . $formattedID;
        
            return $uniqueBlogID;
        }
        
        function getLastUsedBlogIDFromDatabase() {
            $prefix = "BLG"; // 4-letter prefix
            $query = "SELECT MAX(BLG_ID) FROM blog_data WHERE BLG_ID LIKE '{$prefix}%';";
        
            $result = mysqli_query($GLOBALS['connect'], $query);
        
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                $lastBlogIDWithPrefix = $row[0];
        
                // Check if the result is NULL (empty table)
                if ($lastBlogIDWithPrefix === null) {
                    $lastID = 0; // Set a default value for an empty table
                } else {
                    // Remove the prefix by extracting the last 11 digits
                    $lastID = intval(substr($lastBlogIDWithPrefix, strlen($prefix)));
                }
            } else {
                echo "Error executing query: " . mysqli_error($GLOBALS['connect']) . "<br>";
                $lastID = 0; // Set a default value if there is an issue with the query
            }
        
            return $lastID;
        }
        
        
?>