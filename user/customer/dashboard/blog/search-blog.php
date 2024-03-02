<?php
// Include your database connection here
session_start();
include "../../../../includes/table_query/db_connection.php";
include "../../../../modules/blog/blog-data.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize the input
    $connection = $GLOBALS['connect'];
    $current_user_id = $_SESSION['c_id'];
    $searchQuery = filter_input(INPUT_POST, 'search-blog', FILTER_SANITIZE_STRING);
    // Perform database query to search for blogs based on the title
    // Replace with your actual database query
    $query = "SELECT blg_id, blg_title FROM blog_data WHERE blg_title LIKE '%$searchQuery%'";
    $result = mysqli_query($connection, $query);

    $blogs = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Capture the output of fetch_blog function using output buffering
            ob_start();
            fetch_blog($row['blg_id'],$current_user_id); // Assuming fetch_blog function prints the blog content directly
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
