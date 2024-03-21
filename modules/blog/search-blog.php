<?php
session_start();
include "../../includes/table_query/db_connection.php";
include "blog-data.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize the input
    $connection = $GLOBALS['connect'];
    $current_user_id = $_SESSION['current_user'];
    $searchQuery = filter_input(INPUT_POST, 'search-blog', FILTER_SANITIZE_STRING);

    // Fetch the bp_user_id if the current user is a business user
    $bp_user_id = null;
    if ($current_user_id) {
        $query_fetch_bp_user_id = "SELECT bp_user_id FROM business_profile WHERE b_id = '$current_user_id'";
        $result_fetch_bp_user_id = mysqli_query($connection, $query_fetch_bp_user_id);
        $bp_user_id_row = mysqli_fetch_assoc($result_fetch_bp_user_id);
        $bp_user_id = isset($bp_user_id_row['bp_user_id']) ? $bp_user_id_row['bp_user_id'] : null;
    }

    // Perform database query to search for blogs based on the title
    // Exclude blogs owned by blocked users and the current user
    $query = "SELECT DISTINCT bd.blg_id 
              FROM blog_data bd
              WHERE bd.blg_title LIKE '%$searchQuery%'
              AND bd.bp_user_id != '$bp_user_id'
              AND bd.bp_user_id NOT IN (
                  SELECT bu_business_id
                  FROM blocked_user_data
                  WHERE bu_user_id = '$current_user_id'
              )";
    
    $result = mysqli_query($connection, $query);
    $_SESSION['query'] = "$query";

    $blogs = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Capture the output of fetch_blog function using output buffering
            ob_start();
            fetch_blog($row['blg_id'], $current_user_id); // Assuming fetch_blog function prints the blog content directly
            $blog_content = ob_get_clean();

            // Add the blog content to the array
            $row['blog_content'] = $blog_content;
            $blogs[] = $row;
        }
    }

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($blogs);
}
?>
