<?php
session_start();

include "../../../../includes/table_query/db_connection.php";


// Function to validate input fields
function validate_input($bp_username, $bp_fname, $bp_lname) {
    $bp_username_pattern = "/^[a-zA-Z0-9_.]{3,30}$/";
    $name_pattern = "/^[A-Z][a-z]{0,14}$/";

    if (preg_match($bp_username_pattern, $bp_username)) {
        if (preg_match($name_pattern, $bp_fname)) {
            if (preg_match($name_pattern, $bp_lname)) {
                    return true;
            } else {
                $_SESSION['error'] = "Please Enter Surname in Valid Format.";
            }
        } else {
            $_SESSION['error'] = "Please Enter Name in Valid Format.";
        }
    } else {
        $_SESSION['error'] = "bp_username must be 3-30 characters long and can contain letters, numbers, underscores, and periods.";
    }

    return false;
}


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $bp_username = $_POST['bp_username'];
    $bp_fname = $_POST['bp_fname'];
    $bp_lname = $_POST['bp_lname'];
    $bp_birth_date = $_POST['birth-date'];
    $bp_gender = $_POST['bp_gender'];
    $bp_bio = $_POST['bp_bio'];
    $bp_user_id = $_SESSION['bp_user_id'];


    // Validate input fields
    if (validate_input($bp_username, $bp_fname, $bp_lname)) {
        // Update the profile information in the database

        $check_bp_username_query = "SELECT * FROM business_profile WHERE bp_username = '$bp_username' AND bp_user_id != '$bp_user_id'";
        $check_bp_username_result = mysqli_query($GLOBALS['connect'], $check_bp_username_query);

        if (mysqli_num_rows($check_bp_username_result) > 0) {
            // Set error message if bp_username already exists
            $_SESSION['error'] = "username already exists.";
            header("Location: /user/businessman/dashboard/form/edit-profile.php");
            exit;
        }
        
        $update_query = "UPDATE business_profile SET 
                        bp_username = '$bp_username', 
                        bp_fname = '$bp_fname', 
                        bp_lname = '$bp_lname', 
                        bp_birth_date = '$bp_birth_date', 
                        bp_gender = '$bp_gender',  
                        bp_bio = '$bp_bio' 
                        WHERE bp_user_id = '$bp_user_id'";

        // Execute the update query
        if (mysqli_query($GLOBALS['connect'], $update_query)) {
            // Set success message
            
            // Handle profile image update
            if ($_FILES['bp_profile_img_url']['error'] == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES['bp_profile_img_url']['tmp_name'];
                $target_path = "../../../../database/data/user/";
                $file_name = basename($_FILES['bp_profile_img_url']['name']);
                $target_file = $target_path.$file_name;
                
                // Move uploaded image to target location
                if (move_uploaded_file($tmp_name, $target_file)) {
                    // Update profile image path in database
                    $update_img_query = "UPDATE business_profile SET bp_profile_img_url = '$target_file' WHERE bp_user_id = '$bp_user_id'";
                    $update_blog_img_query = "UPDATE blog_data SET blg_user_img_url= '$file_name' WHERE bp_user_id = '$bp_user_id'";
                    // die($update_blog_img_query);
                    mysqli_query($GLOBALS['connect'], $update_img_query);
                    mysqli_query($GLOBALS['connect'],$update_blog_img_query);
                } else {
                    // Handle error if image upload fails
                    $_SESSION['error'] = "Error uploading profile image.";
                }
            }
            
            // Redirect back to the profile page upon successful update
            $_SESSION['greet-message'] = "Profile updated successfully.";
            header("Location: /user/businessman/dashboard/form/edit-profile.php");
            exit;
        } else {
            // Display an error message if update fails
            $_SESSION['error'] = "Error updating profile: " . mysqli_error($GLOBALS['connect']);
            header("Location: /user/businessman/dashboard/form/edit-profile.php");
            exit;
        }
    } else {
        // Redirect back to the profile page if input validation fails
        header("Location: /user/businessman/dashboard/form/edit-profile.php");
        exit;

    }
} else {
    // Redirect to the profile page if the form is not submitted
    header("Location: /user/businessman/dashboard/form/edit-profile.php");
    exit;
}
?>
