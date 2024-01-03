<?php
        function generateVerificationCode() {
            
            $digits = str_pad(mt_rand(0, 99), 2, '0', STR_PAD_LEFT);
        
            $characters = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 4));
        
            $verificationCode = $characters . $digits;
        
            return $verificationCode;
        }

        function generateOTP() {
        
            $otp = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
        
            return $otp;
        }

        function generateSecurityKey() {
            // Generate a random 6-digit number
            $securityKey = mt_rand(100000, 999999);
        
            // Return the generated security key
            return $securityKey;
        }

        function generateVerificationToken($col_name) {
            do {
                // Generate a new token
                $dataToHash = time();
                $hash = password_hash($dataToHash, PASSWORD_DEFAULT);
                $truncatedHash = substr($hash, 0, 100);
        
                // Check if the token already exists in the database
                $query = "SELECT $col_name FROM customer_verification WHERE $col_name = '$truncatedHash'";
                $result = mysqli_query($GLOBALS['connect'], $query);
        
                // If the token already exists, generate a new one
            } while (mysqli_num_rows($result) > 0);
        
            return $truncatedHash;
        }
        
        
        
        function createUniqueFilename() {
            $timestamp = time(); // Get current timestamp
            $randomString = bin2hex(random_bytes(2)); // Generate a shorter random string (adjust length as needed)
        
            $filename = $timestamp . $randomString . '.xlsx'; // Combine timestamp, shorter random string, and file extension
        
            return $filename;
        }
?>