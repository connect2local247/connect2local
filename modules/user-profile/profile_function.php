<?php
function getBlogCount($user_id) {
    // Connect to your database
    $conn = $GLOBALS['connect'];
    
    // Escape user_id to prevent SQL injection
    $user_id = mysqli_real_escape_string($conn, $user_id);

    // Construct the SQL query
    $sql = "SELECT COUNT(*) AS count FROM blog_data WHERE bp_user_id = '$user_id'";

    // Execute the SQL query
    $result = mysqli_query($conn, $sql);

    // Check if query was successful
    if (!$result) {
        die("Error executing query: " . mysqli_error($conn));
    }

    // Fetch the row
    $row = mysqli_fetch_assoc($result);

    // Get the count of blogs
    $blog_count = $row['count'];

    // Free result set
    mysqli_free_result($result);

    // Return the count of blogs
    return $blog_count;
}

function getFollowerCount($user_id) {
    // Connect to your database
    $conn = $GLOBALS['connect'];

    // Escape user_id to prevent SQL injection
    $user_id = mysqli_real_escape_string($conn, $user_id);

    // Construct the SQL query
    $sql = "SELECT COUNT(*) AS count FROM follower_data WHERE fd_user_id = '$user_id' and block_status = 0";

    // Execute the SQL query
    $result = mysqli_query($conn, $sql);

    // Check if query was successful
    if (!$result) {
        die("Error executing query: " . mysqli_error($conn));
    }

    // Fetch the row
    $row = mysqli_fetch_assoc($result);

    // Get the count of followers
    $follower_count = $row['count'];

    // Free result set
    mysqli_free_result($result);

    // Return the count of followers
    return $follower_count;
}

function getFollowingCount($user_id) {
    // Connect to your database
    $conn = $GLOBALS['connect'];

    // Escape user_id to prevent SQL injection
    $user_id = mysqli_real_escape_string($conn, $user_id);

    // Construct the SQL query
    $sql = "SELECT COUNT(*) AS count FROM follower_data WHERE fd_follower_id = '$user_id' and block_status = 0";

    // Execute the SQL query
    $result = mysqli_query($conn, $sql);

    // Check if query was successful
    if (!$result) {
        die("Error executing query: " . mysqli_error($conn));
    }

    // Fetch the row
    $row = mysqli_fetch_assoc($result);

    // Get the count of following
    $following_count = $row['count'];

    // Free result set
    mysqli_free_result($result);

    // Return the count of following
    return $following_count;
}

function send_notification($business_id,$username,$is_following){
    $check_exist = "SELECT * FROM notification WHERE n_user_id = '$business_id' and n_type = 'interact' and n_content='{$username} started following you'";
    $result = mysqli_query($GLOBALS['connect'],$check_exist);
    
    // die($check_exist);
    if(mysqli_num_rows($result) > 0){
        echo "<script>console.log('$is_following')</script>";
        if($is_following == 'Follow'){
            $delete_query = "DELETE FROM notification WHERE n_user_id = '$business_id' and n_type = 'interact' and n_content='{$username} started following you'";
            
            $result = mysqli_query($GLOBALS['connect'],$delete_query);

        }
        return 1;

    } else{
        if($is_following == 'Following'):
        $query = "INSERT INTO notification(n_content,n_type,n_user_id,n_time) VALUES ('{$username} started following you','interact','$business_id',NOW())";
        // die($query);
        $result = mysqli_query($GLOBALS['connect'],$query);

        if($result){
            return 0;
        }
    endif;
    }
}
?>
