<?php
// Start the session
session_start();

// Include necessary files
include "../../../../includes/table_query/find_encrypt_data.php";

// Get the business ID from the session
$business_id = $_SESSION['business_id'];

// Validate and sanitize form data
$businessName = $_POST['business-name'];
$address = $_POST['address'];
$operateTime = $_POST['operate-time'];
$webUrl = $_POST['web-url'];
$instaUrl = $_POST['insta-link'];
$fbUrl = $_POST['fb-link'];
$xUrl = $_POST['twitter-link'];
$linkedinUrl = $_POST['linkedin-link'];

// Validate data
if (validate_data($businessName, $address)) {
    // Validate optional links and operating time
    if (validateOptionalLinks($webUrl, $instaUrl, $fbUrl, $xUrl, $linkedinUrl, $operateTime)) {
        // Update records in the database
        $getKeyQuery = "SELECT b_key FROM business_verification WHERE b_id = '$business_id'";
        $keyResult = mysqli_query($GLOBALS['connect'], $getKeyQuery);
        if ($keyResult && mysqli_num_rows($keyResult) > 0) {
            $row = mysqli_fetch_assoc($keyResult);
            $key = $row['b_key'];
        }

        $updateQuery = "UPDATE business_info SET 
                business_name='$businessName', 
                bi_operate_time='$operateTime', 
                bi_web_url='$webUrl', 
                bi_ig_url='$instaUrl', 
                bi_fb_url='$fbUrl', 
                bi_twitter_url='$xUrl', 
                bi_linkedin_url='$linkedinUrl', 
                bi_address='$address' 
                WHERE b_id = '$business_id'";

        // Execute the update query
        if (mysqli_query($connect, $updateQuery)) {
            // Data updated successfully
            $_SESSION['success'] = "Account data updated successfully";
            echo json_encode(array("status" => "success", "message" => "Account data updated successfully"));
        } else {
            // Error updating data
            $_SESSION['error'] = "Error updating data: " . mysqli_error($connect);
            echo json_encode(array("status" => "error", "message" => "Error updating data: " . mysqli_error($connect)));
        }
    } else {
        $_SESSION['error'] = "Validation failed for optional links or operating time";
        echo json_encode(array("status" => "error", "message" => "Validation failed for optional links or operating time"));
    }
} else {
    $_SESSION['error'] = "Validation failed for business name or address";
    echo json_encode(array("status" => "error", "message" => "Validation failed for business name or address"));
}

// Function to validate and sanitize form data
function validate_data($businessName, $address) {
    // Regular expressions for validation
    $businessNamePattern = '/^.{1,50}$/'; // Business name should be between 1 to 50 characters
    $addressPattern = '/^[A-Za-z0-9\s\-,\.]{1,100}$/'; // Address should be between 1 to 100 characters

    // Validate business name
    if (!preg_match($businessNamePattern, $businessName)) {
        return false;
    }

    // Validate address
    if (!preg_match($addressPattern, $address)) {
        return false;
    }

    // All data is valid
    return true;
}

// Function to validate optional links and operating time
function validateOptionalLinks($webUrl, $instaUrl, $fbUrl, $xUrl, $linkedinUrl, $operateTime) {
    // Regular expression for URL validation
    $urlPattern = '/^https?:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,}(:[0-9]+)?(\/[^\s]*)?$/'; // Valid URL pattern
    $timePattern = '/^(Mon|Tue|Wed|Thu|Fri|Sat|Sun)\s*-\s*(Mon|Tue|Wed|Thu|Fri|Sat|Sun)\s+\d{1,2}:\d{2}\s*[ap]\.m\.\s*-\s*\d{1,2}:\d{2}\s*[ap]\.m\.$/'; // Valid time pattern

    // Validate Web URL
    if (!empty($webUrl) && !preg_match($urlPattern, $webUrl)) {
        return false;
    }

    // Validate Instagram URL
    if (!empty($instaUrl) && !preg_match($urlPattern, $instaUrl)) {
        return false;
    }

    // Validate Facebook URL
    if (!empty($fbUrl) && !preg_match($urlPattern, $fbUrl)) {
        return false;
    }

    // Validate x URL
    if (!empty($xUrl) && !preg_match($urlPattern, $xUrl)) {
        return false;
    }

    // Validate LinkedIn URL
    if (!empty($linkedinUrl) && !preg_match($urlPattern, $linkedinUrl)) {
        return false;
    }

    // Validate Operating Time
    if (!empty($operateTime) && !preg_match($timePattern, $operateTime)) {
        return false;
    }

    // All data is valid
    return true;
}

// function check_duplication($email, $contact, $business_id) {
//   // Get the encryption key (b_key) for the given business_id from business_verification
//   $getKeyQuery = "SELECT b_key FROM business_verification WHERE b_id = '$business_id'";
//   $keyResult = mysqli_query($GLOBALS['connect'], $getKeyQuery);
//   if ($keyResult && mysqli_num_rows($keyResult) > 0) {
//       $row = mysqli_fetch_assoc($keyResult);
//       $encryptionKey = $row['b_key'];

//       // Decrypt the provided email and contact using the encryption key
//       $decryptedEmail = decryptData($email, $encryptionKey);
//       $decryptedContact = decryptData($contact, $encryptionKey);

//       // Check for duplicate email and contact in business_info
//       $infoQuery = "SELECT bi_email, bi_contact FROM business_info WHERE b_id != '$business_id'";
//       $infoResult = mysqli_query($GLOBALS['connect'], $infoQuery);
//       if ($infoResult && mysqli_num_rows($infoResult) > 0) {
//           while ($row = mysqli_fetch_assoc($infoResult)) {
//               $existingEmail = decryptData($row['bi_email'], $encryptionKey);
//               $existingContact = decryptData($row['bi_contact'], $encryptionKey);

//               // Compare decrypted email and contact with provided email and contact
//               if ($existingEmail === $decryptedEmail || $existingContact === $decryptedContact) {
//                   $_SESSION['error'] = "Email or phone number already exists.";
//                   return false;
//               }
//           }
//       }

//       // Check for duplicate email and contact in business_register
//       $registerQuery = "SELECT b_email, b_contact FROM business_register WHERE b_id != '$business_id'";
//       $registerResult = mysqli_query($GLOBALS['connect'], $registerQuery);
//       if ($registerResult && mysqli_num_rows($registerResult) > 0) {
//           while ($row = mysqli_fetch_assoc($registerResult)) {
//               $existingEmail = decryptData($row['b_email'], $encryptionKey);
//               $existingContact = decryptData($row['b_contact'], $encryptionKey);

//               // Compare decrypted email and contact with provided email and contact
//               if ($existingEmail === $decryptedEmail || $existingContact === $decryptedContact) {
//                   $_SESSION['error'] = "Email or phone number already exists.";
//                   return false;
//               }
//           }
//       }

//       // No duplication found
//       return true;
//   } else {
//       // Error retrieving encryption key
//       $_SESSION['error'] = "Error retrieving encryption key.";
//       return false;
//   }
// }
?>