<?php
session_start();

include "../../../../includes/table_query/db_connection.php";


// Function to validate input fields
function validate_input($username, $fname, $lname, $address) {
    $username_pattern = "/^[a-zA-Z0-9_.]{3,30}$/";
    $name_pattern = "/^[A-Z][a-z]{0,14}$/";

    if (preg_match($username_pattern, $username)) {
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
        $_SESSION['error'] = "Username must be 3-30 characters long and can contain letters, numbers, underscores, and periods.";
    }

    return false;
}


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $birth_date = $_POST['birth-date'];
    $gender = $_POST['gender'];
    $bio = $_POST['bio'];
    $user_id = $_SESSION['user_id'];


    // Validate input fields
    if (validate_input($username, $fname, $lname, $address)) {
        // Update the profile information in the database

        $check_username_query = "SELECT * FROM business_profile WHERE USERNAME = '$username' AND USER_ID != '$user_id'";
        $check_username_result = mysqli_query($GLOBALS['connect'], $check_username_query);

        if (mysqli_num_rows($check_username_result) > 0) {
            // Set error message if username already exists
            $_SESSION['error'] = "Username already exists.";
            header("Location: /user/businessman/dashboard/form/edit-profile.php");
            exit;
        }
        
        $update_query = "UPDATE business_profile SET 
                        USERNAME = '$username', 
                        FNAME = '$fname', 
                        LNAME = '$lname', 
                        BIRTH_DATE = '$birth_date', 
                        GENDER = '$gender',  
                        BIO = '$bio' 
                        WHERE USER_ID = '$user_id'";

        // Execute the update query
        if (mysqli_query($GLOBALS['connect'], $update_query)) {
            // Set success message
            
            // Handle profile image update
            if ($_FILES['profile_img']['error'] == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES['profile_img']['tmp_name'];
                $target_path = "../../../../database/data/user/";
                $file_name = basename($_FILES['profile_img']['name']);
                $target_file = $target_path.$file_name;
                
                // Move uploaded image to target location
                if (move_uploaded_file($tmp_name, $target_file)) {
                    // Update profile image path in database
                    $update_img_query = "UPDATE business_profile SET PROFILE_IMG = '$target_file' WHERE USER_ID = '$user_id'";
                    $update_blog_img_query = "UPDATE blog_data SET BLG_USER_IMG_URL = '$file_name' WHERE USER_ID = '$user_id'";
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
