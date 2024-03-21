<?php
            session_start();
            
            include "../../../../includes/table_query/db_connection.php";
            include "../../../../includes/security_function/secure_function.php";

            if(isset($_SESSION['error'])){
                unset($_SESSION['error']);
            }
            if(isset($_SESSION['greet-message'])){
                unset($_SESSION['error']);
            }

            function check_existence($email,$contact,$customer_id){
                    $check_exist_query = "SELECT cr.c_email, cr.c_contact, cv.c_key 
                    FROM customer_register cr 
                    JOIN customer_verification cv ON cr.c_id = cv.c_id 
                    WHERE cr.c_id != '$customer_id';
                    ";

                    // die($check_exist_query);
                    $check_result = mysqli_query($GLOBALS['connect'],$check_exist_query);

                    if(mysqli_num_rows($check_result) > 0){
                        while($data = mysqli_fetch_assoc($check_result)){
                            if($contact == decryptData($data['c_contact'],$data['c_key'])){
                                // echo decryptData($data['c_email'],$data['c_key']);
                                // die();
                                $_SESSION['error'] = "Phone Number Already Exist";
                                return false;
                            } 
                            if($email == decryptData($data['c_email'],$data['c_key'])){
                                $_SESSION['error'] = "Email Already Exist";
                                return false;
                                // die(decryptData($data['c_contact'],$data['c_key']));  
                            }
                        }
                        return true;
                    }
            }

            if(isset($_POST['submit'])){
                $email = $_POST['email'];
                $password = $_POST['password'];
                $phone = $_POST['phone'];

                if(isset($_GET['key'])){
                    $key = $_GET['key'];
                }
                if(isset($_GET['customer_id'])){
                    $customer_id = $_GET['customer_id'];
                }
                    // die(check_existence($email,$phone,$customer_id));
                if(check_existence($email,$phone,$customer_id)){
                    $encryptEmail = encryptData($email,$key);
                    $encryptPhone = encryptData($phone,$key);
                    $encryptPassword = encryptData($password,$key);
                    $query = "UPDATE customer_register SET c_email = '$encryptEmail',c_contact='$encryptPhone',c_password='$encryptPassword' WHERE c_id = '$customer_id'";
                    $result = mysqli_query($GLOBALS['connect'],$query);

                    if($result){
                        $_SESSION['greet-message'] = "Data Updated Successfully";
                        unset($_SESSION['error']);
                    } else{
                        $_SESSION['error'] = "Failed to Update !!!";
                    }
                }

                header("location:/user/customer/dashboard/dashboard.php?content=account");


            }
?>
<?php

// session_start();

// include "../../../../includes/table_query/db_connection.php";
// include "../../../../includes/table_query/find_encrypt_data.php";

// if (isset($_SESSION['error'])) {
//     // You can handle any error display or redirection logic here if needed
// }

// function check_exist_email($email, $connect, $customer_id,$cKey){
//     // Query the database to check if the decrypted email exists
//     $query = "SELECT c_email FROM customer_register WHERE c_id != '$customer_id'";
//     $result = mysqli_query($connect, $query);

//     while ($row = mysqli_fetch_assoc($result)) {
//         $decrypted_email = decryptData($row['c_email'],$cKey);
//         if ($email == $decrypted_email) {
//             return true; // Email already exists
//         }
//     }
//     return false;
// }

// function check_exist_contact($contact, $connect, $customer_id,$cKey){
//     // Query the database to check if the decrypted contact exists
//     $query = "SELECT c_contact FROM customer_register WHERE c_id != '$customer_id'";
//     $result = mysqli_query($connect, $query);

//     while ($row = mysqli_fetch_assoc($result)) {
//         $decrypted_contact = decryptData($row['c_contact'],$cKey);
//         if ($contact == $decrypted_contact) {
//             return true; // Contact already exists
//         }
//     }
//     return false;
// }

// if (isset($_POST['submit'])) {
//     // Retrieve form data
//     $email = $_POST['email'];
//     $phone = $_POST['phone'];
//     $password = $_POST['password'];

//     // Retrieve cKey from GET parameter
//     if (isset($_GET['key'])) {
//         $cKey = $_GET['key'];
//     }

//     if(isset($_GET['customer_id'])){
//         $customer_id = $_GET['customer_id'];
//     }
//     // Perform necessary sanitization/validation on form data
    
//     // Check for duplicate email and contact
//     if (check_exist_email($email, $connect, $customer_id,$cKey)) {
//         $_SESSION['error'] = "Email Already Exists";
//         header("location:/user/customer/dashboard/dashboard.php?content=account");
//         exit;
//     }
//     if (check_exist_contact($phone, $connect, $customer_id,$cKey)) {
//         $_SESSION['error'] = "Contact Already Exists";
//         header("location:/user/customer/dashboard/dashboard.php?content=account");
//         exit;
//     }

//     // Re-encrypt the data with the customer key before storing
//     $encrypted_email = encryptData($email, $cKey);
//     $encrypted_phone = encryptData($phone, $cKey);
//     $encrypted_password = encryptData($password, $cKey);

//     // Update query
//     $update_customer_query = "UPDATE customer_register
//                                 SET c_email = '$encrypted_email', c_contact = '$encrypted_phone', c_password = '$encrypted_password'
//                                 WHERE c_id = '$customer_id'";

//     // Execute the query
//     $update_result = mysqli_query($connect, $update_customer_query);

//     if ($update_result) {
//         // Update successful
//         if (isset($_SESSION['error'])) {
//             unset($_SESSION['error']);
//         }
//         $_SESSION['greet-message'] = "Data updated Successfully";
//     } else {
//         // Update failed
//         echo "<div class='alert alert-danger'>Error updating data: " . mysqli_error($connect) . "</div>";
//     }

//     header("location:/user/customer/dashboard/dashboard.php?content=account");
// }
?>
