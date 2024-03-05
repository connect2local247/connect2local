<?php
session_start();

include "../../../../includes/table_query/db_connection.php";


// Function to validate input fields
function validate_input($cp_username, $fname, $lname) {
    $cp_username_pattern = "/^[a-zA-Z0-9_.]{3,30}$/";
    $name_pattern = "/^[A-Z][a-z]{0,14}$/";

    if (preg_match($cp_username_pattern, $cp_username)) {
        if (preg_match($name_pattern, $fname)) {
            if (preg_match($name_pattern, $lname)) {
                    return true;
            } else {
                $_SESSION['error'] = "Please Enter Surname in Valid Format.";
            }
        } else {
            $_SESSION['error'] = "Please Enter Name in Valid Format.";
        }
    } else {
        $_SESSION['error'] = "username must be 3-30 characters long and can contain letters, numbers, underscores, and periods.";
    }

    return false;
}


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $cp_username = $_POST['username'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $birth_date = $_POST['birth-date'];
    $gender = $_POST['gender'];
    $customer_id = $_SESSION['c_id'];
    $cp_user_id = $_SESSION['cp_user_id'];


    // Validate input fields
    if (validate_input($cp_username, $fname, $lname)) {
        // Update the profile information in the database

        $check_cp_username_query = "SELECT * FROM customer_profile WHERE cp_username = '$cp_username' AND cp_user_id != '$cp_user_id'";
        $check_cp_username_result = mysqli_query($GLOBALS['connect'], $check_cp_username_query);

        if (mysqli_num_rows($check_cp_username_result) > 0) {
            // Set error message if cp_username already exists
            $_SESSION['error'] = "username already exists.";
            header("Location: /user/customer/dashboard/form/edit-profile.php");
            exit;
        }
        
        $update_query = "UPDATE customer_profile SET 
                        cp_username = '$cp_username' 
                        WHERE cp_user_id = '$cp_user_id'";
                        // die($update_query);
                        
                        
        $update_register_query = "UPDATE customer_register SET c_fname ='$fname',c_lname='$lname',c_birth_date = '$birth_date',c_gender = '$gender' WHERE c_id = '$customer_id'";
        mysqli_query($GLOBALS['connect'],$update_register_query);
        // Execute the update query
        if (mysqli_query($GLOBALS['connect'], $update_query)) {
            // Set success message
            
            // Handle profile image update
            if ($_FILES['cp_profile_img_url']['error'] == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES['cp_profile_img_url']['tmp_name'];
                $target_path = "../../../../database/data/user/";
                $file_name = basename($_FILES['cp_profile_img_url']['name']);
                $target_file = $target_path.$file_name;
                
                // Move uploaded image to target location
                if (move_uploaded_file($tmp_name, $target_file)) {
                    // Update profile image path in database
                    $update_img_query = "UPDATE customer_profile SET cp_profile_img_url = '$target_file' WHERE cp_user_id = '$cp_user_id'";
                    // die($update_blog_img_query);
                    mysqli_query($GLOBALS['connect'], $update_img_query);
                } else {
                    // Handle error if image upload fails
                    $_SESSION['error'] = "Error uploading profile image.";
                }
            }
            
            // Redirect back to the profile page upon successful update
            $_SESSION['greet-message'] = "Profile updated successfully.";
            header("Location: /user/customer/dashboard/form/edit-profile.php");
            exit;
        } else {
            // Display an error message if update fails
            $_SESSION['error'] = "Error updating profile: " . mysqli_error($GLOBALS['connect']);
            header("Location: /user/customer/dashboard/form/edit-profile.php");
            exit;
        }
    } else {
        // Redirect back to the profile page if input validation fails
        header("Location: /user/customer/dashboard/form/edit-profile.php");
        exit;

    }
} else {
    // Redirect to the profile page if the form is not submitted
    header("Location: /user/customer/dashboard/form/edit-profile.php");
    exit;
}
?>
