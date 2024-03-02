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
    $sql = "SELECT COUNT(*) AS count FROM followers WHERE user_id = '$user_id'";

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
    $sql = "SELECT COUNT(*) AS count FROM following WHERE user_id = '$user_id'";

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
?>
