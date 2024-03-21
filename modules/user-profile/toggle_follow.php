<?php
// Start the session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['cp_user_id'])){
    $follower_id = $_SESSION['cp_user_id'];
   

    $get_username = "SELECT cp_username FROM customer_profile WHERE cp_user_id = '$follower_id'";
    $result = mysqli_query($GLOBALS['connect'],$get_username);

    if(mysqli_num_rows($result) > 0){
        $data = mysqli_fetch_assoc($result);
       

        $username = $data['cp_username'];
    }
} else if(isset($_SESSION['bp_user_id'])){
    $follower_id = $_SESSION['bp_user_id'];  
    $get_username = "SELECT bp_username FROM business_profile WHERE bp_user_id = '$follower_id'";
    $result = mysqli_query($GLOBALS['connect'],$get_username);

    if(mysqli_num_rows($result) > 0){
        $data = mysqli_fetch_assoc($result);
      
        $username = $data['bp_username'];

    }  
} else {
    $follower_id = $_GET['profile_id'];
}
if(isset($_SESSION['registered'])){
    


// Check if user is logged in and set the follower ID accordingly

// Check if follow status is set and handle follow/unfollow/unblock logic accordingly
if(isset($_GET['follow_status'])){
    // Follow status is set, so we handle the follow/unfollow/unblock logic
    $follow_status = $_GET['follow_status'];

    if ($follow_status == 1) {
        // User wants to follow
        $check_following_query = "SELECT * FROM follower_data WHERE fd_user_id='$userId' AND fd_follower_id='$follower_id' AND block_status = 0";
        $check_following_result = mysqli_query($GLOBALS['connect'], $check_following_query);

        if(mysqli_num_rows($check_following_result) == 0){
            // The user is not already following, so we can insert the follow record
            $insert_follow_query = "INSERT INTO follower_data(fd_user_id, fd_follower_id, block_status) VALUES('$userId', '$follower_id', 0)";
            $insert_follow_result = mysqli_query($GLOBALS['connect'], $insert_follow_query);

            if($insert_follow_result){
                $is_following = "Following";
            } else {
                $is_following = "Follow";
            }
        } else {
            // The user is already following, so we don't need to insert a new record
            $is_following = "Following";
        }
    } else {
        // User wants to unfollow
        $delete_follow_query = "DELETE FROM follower_data WHERE fd_user_id='$userId' and fd_follower_id='$follower_id'";
        $delete_follow_result = mysqli_query($GLOBALS['connect'], $delete_follow_query);
        $is_following = "Follow";
    }
} else {
    $is_following = "Follow";
    if(isset($_SESSION['cp_user_id'])){
        $check_following_query = "SELECT * FROM follower_data WHERE fd_user_id='$userId' AND fd_follower_id='{$_SESSION['cp_user_id']}' AND block_status = 0";
        $check_following_result = mysqli_query($GLOBALS['connect'], $check_following_query);

        if(mysqli_num_rows($check_following_result) > 0){
        $is_following = "Following";
        }
    } else if(isset($_SESSION['bp_user_id'])){
        $check_following_query = "SELECT * FROM follower_data WHERE fd_user_id='$userId' AND fd_follower_id='{$_SESSION['bp_user_id']}' AND block_status = 0";
        $check_following_result = mysqli_query($GLOBALS['connect'], $check_following_query);

        if(mysqli_num_rows($check_following_result) > 0){
        $is_following = "Following";
        }
        
    }

    
    // Default state when follow_status is not set or is 0
}
}else{
    echo '<script>alert("You are not registered")</script>';
    $is_following = "Follow";
}
// Check if the user is blocked
$check_blocked_query = "SELECT * FROM follower_data WHERE fd_user_id='$userId' AND fd_follower_id='$follower_id' AND block_status = 1";
$check_blocked_result = mysqli_query($GLOBALS['connect'], $check_blocked_query);
$is_blocked = mysqli_num_rows($check_blocked_result) > 0;

// Output the follow button with appropriate text and behavior
?>
<?php if($is_blocked): ?>
    <!-- Unblock button -->
    <button class="btn btn-block mx-auto btn-outline-info text-center follow-btn" onclick="location.href='?profile_id=<?php echo $profile_id; ?>&viewer_id=1&follow_status=<?php echo $is_following == 'Follow' ? 1 : 0; ?>&unblock=1'">
        Unblock
    </button>
<?php else: ?>
    <!-- Follow button -->
    <button class="btn btn-block mx-auto btn-outline-info text-center follow-btn" onclick="location.href='?profile_id=<?php echo $profile_id; ?>&viewer_id=1&follow_status=<?php echo $is_following == 'Follow' ? 1 : 0; ?>'">
        <?php echo $is_following; ?>
    </button>
    
<?php send_notification($profile_id,$username,$is_following); endif; ?>
