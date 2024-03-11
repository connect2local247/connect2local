<?php
// Include the necessary files
include_once "../../../modules/blog/blog-data.php";
// Check if the blog_id parameter is set in the POST request
if(isset($_POST['blog_id'])) {
    // Get the blog ID from the POST request
    $blog_id = $_POST['blog_id'];

    // Call the fetch_blog function with the provided blog ID
    $blog = fetch_blog($blog_id);

    // Return the blog data as JSON
    echo json_encode($blog);
}
?>
