<?php
session_start();

include "../../../../includes/table_query/db_connection.php";
include "../../../../includes/security_function/secure_function.php";

$response = array(); // Initialize response array

if(isset($_POST['type']) && isset($_POST['value'])) {
    $type = $_POST['type'];
    $value = $_POST['value'];

    $business_id = $_SESSION['business_id']; // Moved inside the conditional block

    // Handle different types of updates
    if($type === 'email') {
        // Update email logic
        $checkQuery = "SELECT b_email FROM business_register WHERE b_id != '$business_id'";
        $result = mysqli_query($GLOBALS['connect'],$checkQuery);
        $findKey = "SELECT b_key FROM business_verification WHERE b_id != '$business_id'";
        $findResult = mysqli_query($GLOBALS['connect'],$findKey);

        if(mysqli_num_rows($result) > 0 && mysqli_num_rows($findResult) > 0){
            while(($row = mysqli_fetch_assoc($result)) && ($key = mysqli_fetch_assoc($findResult))){
                $db_email = decryptData($row['b_email'],$key['b_key']);
                if($db_email == $value){
                    $response['status'] = 'error';
                    $response['message'] = 'Email already exists';
                    $_SESSION['error'] = "Email already exists.";
                    echo json_encode($response); // Send JSON response and exit
                    exit;
                } 
            }

            if(!isset($_SESSION['error'])){
                $getKeyQuery = "SELECT b_key FROM business_verification WHERE b_id = '$business_id'";
                $keyResult = mysqli_query($GLOBALS['connect'], $getKeyQuery);
                if ($keyResult && mysqli_num_rows($keyResult) > 0) {
                    $row = mysqli_fetch_assoc($keyResult);
                    $key = $row['b_key'];
                }

                $encryptEmail =  encryptData($value,$key);
                $update_query = "UPDATE business_info SET bi_email = '$encryptEmail' WHERE b_id = '$business_id'";
                $result = mysqli_query($GLOBALS['connect'],$update_query);

                $update_query = "UPDATE business_register SET b_email = '$encryptEmail' WHERE b_id = '$business_id'";
                $result = mysqli_query($GLOBALS['connect'],$update_query);

                if($result){
                    $response['status'] = 'success';
                    $response['message'] = 'Email updated successfully';
                }
                else{
                    $response['status'] = 'error';
                    $response['message'] = 'Email not updated yet';
                    $_SESSION['error'] = "Email not updated yet.";
                }
            }
        }
    } elseif($type === 'contact') {
        // Update contact logic
        $checkQuery = "SELECT b_contact FROM business_register WHERE b_id != '$business_id'";
        $result = mysqli_query($GLOBALS['connect'],$checkQuery);
        $findKey = "SELECT b_key FROM business_verification WHERE b_id != '$business_id'";
        $findResult = mysqli_query($GLOBALS['connect'],$findKey);

        if(mysqli_num_rows($result) > 0 && mysqli_num_rows($findResult) > 0){
            while(($row = mysqli_fetch_assoc($result)) && ($key = mysqli_fetch_assoc($findResult))){
                $db_contact = decryptData($row['b_contact'],$key['b_key']);
                if($db_contact == $value){
                    $response['status'] = 'error';
                    $response['message'] = 'Contact already exists';
                    $_SESSION['error'] = "Contact already exists.";
                    echo json_encode($response); // Send JSON response and exit
                    exit;
                } 
            }

            if(!isset($_SESSION['error'])){
                $getKeyQuery = "SELECT b_key FROM business_verification WHERE b_id = '$business_id'";
                $keyResult = mysqli_query($GLOBALS['connect'], $getKeyQuery);
                if ($keyResult && mysqli_num_rows($keyResult) > 0) {
                    $row = mysqli_fetch_assoc($keyResult);
                    $key = $row['b_key'];
                }

                $encryptContact =  encryptData($value,$key);
                $update_query = "UPDATE business_info SET bi_contact = '$encryptContact' WHERE b_id = '$business_id'";
                $result = mysqli_query($GLOBALS['connect'],$update_query);

                $update_query = "UPDATE business_register SET b_contact = '$encryptContact' WHERE b_id = '$business_id'";
                $result = mysqli_query($GLOBALS['connect'],$update_query);

                if($result){
                    $response['status'] = 'success';
                    $response['message'] = 'Contact updated successfully';
                }
                else{
                    $response['status'] = 'error';
                    $response['message'] = 'Contact not updated yet';
                    $_SESSION['error'] = "Contact not updated yet.";
                }
            }
        }
    } elseif($type === 'password') {
        // Update password logic
        if(!isset($_SESSION['error'])){
            $getKeyQuery = "SELECT b_key FROM business_verification WHERE b_id = '$business_id'";
            $keyResult = mysqli_query($GLOBALS['connect'], $getKeyQuery);
            if ($keyResult && mysqli_num_rows($keyResult) > 0) {
                $row = mysqli_fetch_assoc($keyResult);
                $key = $row['b_key'];
            }

            $encryptPassword =  encryptData($value,$key);
            $update_query = "UPDATE business_info SET bi_password = '$encryptPassword' WHERE b_id = '$business_id'";
            $result = mysqli_query($GLOBALS['connect'],$update_query);

            $update_query = "UPDATE business_register SET b_password = '$encryptPassword' WHERE b_id = '$business_id'";
            $result = mysqli_query($GLOBALS['connect'],$update_query);

            if($result){
                $response['status'] = 'success';
                $response['message'] = 'Password updated successfully';
            }
            else{
                $response['status'] = 'error';
                $response['message'] = 'Password not updated yet';
                $_SESSION['error'] = "Password not updated yet.";
            }
        }
    } else {
        // Handle invalid type
        $response['status'] = 'error';
        $response['message'] = 'Invalid update type';
    }
} else {
    // Handle missing parameters
    $response['status'] = 'error';
    $response['message'] = 'Missing parameters';
}

// Output response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
