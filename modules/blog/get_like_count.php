
<?php
// Include database connection
include "../../includes/table_query/db_connection.php";
$conn = $GLOBALS['connect'];

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $blog_id = isset($_POST['blog_id']) ? $_POST['blog_id'] : null;

    // Check if blog ID is provided
    if (!$blog_id) {
        // If blog ID is not provided, return an error response
        $response = array(
            'success' => false,
            'message' => 'Blog ID not provided'
        );
        echo json_encode($response);
        exit;
    }

    // Get total like count for the blog post
    $query = "SELECT COUNT(*) AS like_count FROM blog_like_data WHERE blg_id = '$blog_id'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $like_count = $row['like_count'];

        // Return success response with updated like count
        $response = array(
            'success' => true,
            'like_count' => $like_count
        );
        echo json_encode($response);
    } else {
        // If query fails, return an error response
        $response = array(
            'success' => false,
            'message' => 'Failed to fetch like count',
            'debug' => mysqli_error($conn)
        );
        echo json_encode($response);
    }
} else {
    // If request method is not POST, return an error response
    $response = array(
        'success' => false,
        'message' => 'Invalid request method'
    );
    echo json_encode($response);
}
?>
