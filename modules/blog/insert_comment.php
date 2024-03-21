<?php

session_start();

include "../../includes/table_query/db_connection.php";
include "../../includes/code_generator/primary_key_generator.php";
include "../../includes/blog_function/time_function.php";

// Function to determine user type
function determine_user_type($user_id) {
    // Regular expression to match user types
    $pattern = '/^C2L\d+$/'; // Matches 'C2L' followed by one or more digits
    $business_pattern = '/^C2LB\d+$/'; // Matches 'C2LB' followed by one or more digits

    // Check if the user ID matches any pattern
    if (preg_match($pattern, $user_id)) {
        return 'Customer';
    } elseif (preg_match($business_pattern, $user_id)) {
        return 'Business';
    } elseif ($user_id == 1) {
        return 'Admin';
    }
}

// Check if the comment is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    $comment = $_POST['comment'];
    $connect = $GLOBALS['connect'];
    $blog_id = $_POST['blog_id'];
    $unique_identifier = $_POST['unique_identifier'];
    if(isset($_SESSION['current_user'])){
        $current_user_id = $_SESSION['current_user']; // Replace with actual user ID
        $current_user_type = determine_user_type($current_user_id); // Determine user type
    } else {
        $current_user_id = 1;
        $current_user_type = determine_user_type($current_user_id); // Determine user type
    }
    
    $comment_id = generateUniqueID("comments","BLGC","comment_id");
    
    // Insert the comment into the database
    $query = "INSERT INTO comments (comment_id, blg_id, commentor_id, comment_content, comment_time) 
              VALUES ('$comment_id', '$blog_id', '$current_user_id', '$comment', NOW())";
    
    $result = mysqli_query($connect, $query);

    if ($result) {
        // Fetch profile image and username of the user based on user type
        if ($current_user_type === 'Customer') {
            // Fetch customer profile data
            $customer_profile_query = "SELECT cp_profile_img_url AS profile_img, cp_username AS username FROM customer_profile WHERE c_id = '$current_user_id'";
            $customer_profile_result = mysqli_query($connect, $customer_profile_query);
            
            if ($customer_profile_result && mysqli_num_rows($customer_profile_result) > 0) {
                $profile_data = mysqli_fetch_assoc($customer_profile_result);
                $profile_image = $profile_data['profile_img'];
                $username = $profile_data['username'];
            } else {
                // Set default profile image and username for customer
                $profile_image = "/asset/image/user/profile.png"; // Replace with default customer profile image URL
                $username = "Customer";
            }
        } elseif ($current_user_type === 'Business') {
            // Fetch business profile data
            $business_profile_query = "SELECT bp_profile_img_url AS profile_img, bp_username AS username FROM business_profile WHERE b_id = '$current_user_id'";
            $business_profile_result = mysqli_query($connect, $business_profile_query);
            
            if ($business_profile_result && mysqli_num_rows($business_profile_result) > 0) {
                $profile_data = mysqli_fetch_assoc($business_profile_result);
                $profile_image = $profile_data['profile_img'];
                $username = $profile_data['username'];
            } else {
                // Set default profile image and username for business
                $profile_image = "/asset/image/user/profile.png"; // Replace with default business profile image URL
                $username = "Business";
            }
        } else {
            // Set default profile image and username for other user types
            $profile_image = "default_profile_image_url"; // Replace with default profile image URL
            $username = "Unknown";
        }
        
        // Construct HTML for the new comment
        $html = '<div class="comment-container p-3 rounded shadow border">';
        $html .= '<div class="info-container d-flex align-items-center" style="gap:7px">';
        $html .= '<div class="profile-image">';
        $html .= '<img src="' . $profile_image . '" style="width:35px;height:35px;" class="rounded-circle" alt="Profile Image">'; // Display profile image
        $html .= '</div>';
        $html .= '<div class="username">';
        $html .= '<span class="fw-semibold">' . $username . ':</span>'; // Display username
        $html .= '<p class="comment-content'.$unique_identifier.' fw-normal d-inline" style="font-size:17px">' . $comment . '</p>';
        $html .= '<span class="time fw-normal text-secondary" style="font-size:13px">' . timeElapsedString(date('Y-m-d H:i:s')) . '</span>'; // Display current time
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';

        echo $html;
    } else {
        // If there's an error, display the error message
        echo 'Failed to insert comment: ' . mysqli_error($connect);
    }
} else {
    echo 'Invalid request.';
}
?>
