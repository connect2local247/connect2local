<?php
// Include your database connection here
session_start();
include "../../includes/table_query/db_connection.php";
include "blog-data.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize the input
    $connection = $GLOBALS['connect'];
    $current_user_id = $_SESSION['current_user'];
    $searchQuery = filter_input(INPUT_POST, 'search-blog', FILTER_SANITIZE_STRING);
    // Perform database query to search for blogs based on the title
    // Replace with your actual database query
    $query = "SELECT bd.blg_id, bd.blg_title 
              FROM blog_data bd
              LEFT JOIN blocked_user_data bu ON bd.bp_user_id = bu.bu_business_id
              WHERE bd.blg_title LIKE '%$searchQuery%'
              AND (bu.bu_user_id != '$current_user_id' OR bu.bu_user_id IS NULL)";
    $result = mysqli_query($connection, $query);

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
