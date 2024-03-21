<?php
session_start();
include "../../includes/table_query/db_connection.php";
include "../../modules/blog/blog-data.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize the input
    $connection = $GLOBALS['connect'];
    $searchQuery = filter_input(INPUT_POST, 'search-blog', FILTER_SANITIZE_STRING);

    // Perform database query to search for blogs based on the title
    $query = "SELECT DISTINCT bd.blg_id 
              FROM blog_data bd
              WHERE bd.blg_title LIKE CONCAT('%', ?, '%')";

    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "s", $searchQuery);
    
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $blogs = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Capture the output of fetch_blog function using output buffering
            ob_start();
            fetch_blog($row['blg_id'],'1'); // Assuming fetch_blog function prints the blog content directly
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
