<?php
      if(isset($_GET['id'])){
        $id = $_GET['id'];
        deleteCustomerUser($id);
        // $query = "DELETE from customer_register where c_id = '$id'";
        // $result = mysqli_query($GLOBALS['connect'],$query);

        // $query = "DELETE from customer_verification where c_id = '$id'";
        // $result = mysqli_query($GLOBALS['connect'],$query);

      }

      if(isset($_GET['b_id'])){
        $id = $_GET['b_id'];
        // Check if the business user exists in business_profile
        $conn = $GLOBALS['connect'];
        $result = mysqli_query($conn, "SELECT bp_user_id FROM business_profile WHERE b_id = '$b_id'");
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $bp_user_id = $row['bp_user_id'];

            // Delete user data from business_profile
            mysqli_query($conn, "DELETE FROM business_profile WHERE b_id = '$b_id'");

            // Delete user data from business_info
            mysqli_query($conn, "DELETE FROM business_info WHERE b_id = '$b_id'");

            // Delete user data from business_add_status
            mysqli_query($conn, "DELETE FROM business_add_status WHERE business_code IN (SELECT business_code FROM business_info WHERE b_id = '$b_id')");

            // Delete user data from blog_data
            mysqli_query($conn, "DELETE FROM blog_data WHERE bp_user_id = '$bp_user_id'");

            // Delete user data from follower_data
            mysqli_query($conn, "DELETE FROM follower_data WHERE fd_user_id = '$b_id' OR fd_follower_id = '$b_id'");

            // Delete user data from blog_like_data
            mysqli_query($conn, "DELETE FROM blog_like_data WHERE like_user_id = '$b_id'");

            // Delete user data from blog_link_data
            mysqli_query($conn, "DELETE FROM blog_link_data WHERE bp_user_id = '$bp_user_id'");

            // Delete user data from blog_report
            mysqli_query($conn, "DELETE FROM blog_report WHERE bp_user_id = '$bp_user_id'");

            // Delete user data from notification
            mysqli_query($conn, "DELETE FROM notification WHERE n_user_id = '$b_id'");

            // Delete user data from blocked_user_data
            mysqli_query($conn, "DELETE FROM blocked_user_data WHERE bu_user_id = '$b_id'");

            mysqli_query($conn, "DELETE FROM business_profile_interaction WHERE bp_user_id = '$bp_user_id'");

            mysqli_query($conn, "DELETE FROM business_register WHERE b_id = '$bp_user_id'");
        }
      }
?>