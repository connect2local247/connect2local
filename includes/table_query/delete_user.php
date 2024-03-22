<?php
      function deleteCustomerUser($c_id) {
        $conn = $GLOBALS['connect'];
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    
        try {
            // Get cp_user_id associated with c_id
            $result = mysqli_query($conn, "SELECT cp_user_id FROM customer_profile WHERE c_id = '$c_id'");
            $row = mysqli_fetch_assoc($result);
            $cp_user_id = $row['cp_user_id'];
    
            // Delete user data from blog_report
            mysqli_query($conn, "DELETE FROM blog_report WHERE reporter_user_id = '$cp_user_id'");
    
            // Delete user data from blog_like_data
            mysqli_query($conn, "DELETE FROM blog_like_data WHERE like_user_id = '$c_id'");
    
            // Delete user data from blocked_user_data
            mysqli_query($conn, "DELETE FROM blocked_user_data WHERE bu_user_id = '$c_id'");
    
            // Delete user data from notification
            mysqli_query($conn, "DELETE FROM notification WHERE n_user_id = '$c_id'");
    
            // Delete user data from follower_data
            mysqli_query($conn, "DELETE FROM follower_data WHERE fd_follower_id = '$cp_user_id'");
    
                // Delete user data from customer_profile
                mysqli_query($conn, "DELETE FROM customer_profile WHERE cp_user_id = '$cp_user_id'");
                // Delete user data from customer_register
                mysqli_query($conn, "DELETE FROM customer_register WHERE c_id = '$c_id'");
                // Delete user data from customer_verification
                mysqli_query($conn, "DELETE FROM customer_verification WHERE c_id = '$c_id'");
          
    
            return true;
        } catch(Exception $e) {
            echo "An error occurred: " . $e->getMessage();
        } finally {
            // Close the connection
            // mysqli_close($conn);
        }
    }
    function deleteBusinessUser($b_id) {
      // Connect to the database
      $conn = $GLOBALS['connect'];
  
      // Check connection
      if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
      }
  
      try {
          // Check if the business user exists in business_profile
          $result = mysqli_query($conn, "SELECT bp_user_id FROM business_profile WHERE b_id = '$b_id'");
        //   die("SELECT bp_user_id FROM business_profile WHERE b_id = '$b_id'");
          if (mysqli_num_rows($result) > 0) {
              $row = mysqli_fetch_assoc($result);
              $bp_user_id = $row['bp_user_id'];
              // Delete user data from business_profile
              mysqli_query($conn, "DELETE FROM business_profile WHERE b_id = '$b_id'");
              mysqli_query($conn, "DELETE FROM business_register WHERE b_id = '$b_id'");
              mysqli_query($conn, "DELETE FROM business_verification WHERE b_id = '$b_id'");

              // Delete user data from business_info
              mysqli_query($conn, "DELETE FROM business_info WHERE b_id = '$b_id'");
  
              $business_info_result = mysqli_query($conn, "SELECT business_code FROM business_info WHERE b_id = '$b_id'");
    if (mysqli_num_rows($business_info_result) > 0) {
        $business_info_row = mysqli_fetch_assoc($business_info_result);
        $business_code = $business_info_row['business_code'];

        // Delete records from business_add_status using the fetched business_code
        mysqli_query($conn, "DELETE FROM business_add_status WHERE business_code = '$business_code'");
    }
  
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

  
              
          }
      } catch(Exception $e) {
          echo "An error occurred: " . $e->getMessage();
      } finally {
        
      }
  }
?>