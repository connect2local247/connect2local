<?php
session_start();

include "../../../../includes/table_query/db_connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $birth_date = $_POST['birth-date'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $category = $_POST['category'];
    $bio = $_POST['bio'];
    $user_id = $_SESSION['user_id'];

    // Update the profile information in the database
    $update_query = "UPDATE business_profile SET 
                    USERNAME = '$username', 
                    FNAME = '$fname', 
                    LNAME = '$lname', 
                    BIRTH_DATE = '$birth_date', 
                    GENDER = '$gender', 
                    ADDRESS = '$address', 
                    CATEGORY = '$category', 
                    BIO = '$bio' 
                    WHERE USER_ID = '$user_id'";

    // Execute the update query
    if (mysqli_query($GLOBALS['connect'], $update_query)) {
        // Redirect back to the profile page upon successful update
        header("Location: /user/businessman/dashboard/form/edit-profile.php");
        exit;
    } else {
        // Display an error message if update fails
        echo "Error updating profile: " . mysqli_error($GLOBALS['connect']);
    }
} else {
    // Redirect to the profile page if the form is not submitted
    header("Location: /user/businessman/dashboard/form/edit-profile.php");
    exit;
}
?>
