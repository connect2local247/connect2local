<?php

session_start();

include "../../../../includes/table_query/db_connection.php";
include "../../../../includes/table_query/find_encrypt_data.php";

if (isset($_SESSION['error'])) {
    // You can handle any error display or redirection logic here if needed
}

function check_exist_email($email, $connect, $customer_id,$cKey){
    // Query the database to check if the decrypted email exists
    $query = "SELECT c_email FROM customer_register WHERE c_id != '$customer_id'";
    $result = mysqli_query($connect, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $decrypted_email = decryptData($row['c_email'],$cKey);
        if ($email == $decrypted_email) {
            return true; // Email already exists
        }
    }
    return false;
}

function check_exist_contact($contact, $connect, $customer_id,$cKey){
    // Query the database to check if the decrypted contact exists
    $query = "SELECT c_contact FROM customer_register WHERE c_id != '$customer_id'";
    $result = mysqli_query($connect, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $decrypted_contact = decryptData($row['c_contact'],$cKey);
        if ($contact == $decrypted_contact) {
            return true; // Contact already exists
        }
    }
    return false;
}

if (isset($_POST['submit'])) {
    // Retrieve form data
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // Retrieve cKey from GET parameter
    if (isset($_GET['key'])) {
        $cKey = $_GET['key'];
    }

    if(isset($_GET['customer_id'])){
        $customer_id = $_GET['customer_id'];
    }
    // Perform necessary sanitization/validation on form data
    
    // Check for duplicate email and contact
    if (check_exist_email($email, $connect, $customer_id,$cKey)) {
        $_SESSION['error'] = "Email Already Exists";
        header("location:/user/customer/dashboard/dashboard.php?content=account");
        exit;
    }
    if (check_exist_contact($phone, $connect, $customer_id,$cKey)) {
        $_SESSION['error'] = "Contact Already Exists";
        header("location:/user/customer/dashboard/dashboard.php?content=account");
        exit;
    }

    // Re-encrypt the data with the customer key before storing
    $encrypted_email = encryptData($email, $cKey);
    $encrypted_phone = encryptData($phone, $cKey);
    $encrypted_password = encryptData($password, $cKey);

    // Update query
    $update_customer_query = "UPDATE customer_register
                                SET c_email = '$encrypted_email', c_contact = '$encrypted_phone', c_password = '$encrypted_password'
                                WHERE c_id = '$customer_id'";

    // Execute the query
    $update_result = mysqli_query($connect, $update_customer_query);

    if ($update_result) {
        // Update successful
        if (isset($_SESSION['error'])) {
            unset($_SESSION['error']);
        }
        $_SESSION['greet-message'] = "Data updated Successfully";
    } else {
        // Update failed
        echo "<div class='alert alert-danger'>Error updating data: " . mysqli_error($connect) . "</div>";
    }

    header("location:/user/customer/dashboard/dashboard.php?content=account");
}
?>
