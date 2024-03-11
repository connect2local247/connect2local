<?php
// Include database connection
session_start();
include "../../includes/table_query/db_connection.php";
$conn = $GLOBALS['connect'];

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user is logged in
    if (!isset($_SESSION['current_user'])) {
        // If user is not logged in, return an error response
        $response = array(
            'success' => false,
            'message' => 'User not logged in'
        );
        echo json_encode($response);
        exit;
    }

    // Get user ID and blog ID from the POST data
    $current_user = $_SESSION['current_user'];
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

    // Check if the user has already liked the blog post
    $query = "SELECT * FROM blog_like_data WHERE like_user_id = '$current_user' AND blg_id = '$blog_id'";
   
    $result = mysqli_query($conn, $query);
    $num_rows = mysqli_num_rows($result);

    if ($num_rows > 0) {
        // User has already liked the blog post, delete the like entry
        $query = "DELETE FROM blog_like_data WHERE like_user_id = '$current_user' AND blg_id = '$blog_id'";
        $delete_result = mysqli_query($conn, $query);
        if (!$delete_result) {
            // Return error response if delete operation fails
            $response = array(
                'success' => false,
                'message' => 'Failed to delete like entry',
                'debug' => mysqli_error($conn)
            );
            echo json_encode($response);
            exit;
        }
        $liked = false;
    } else {
        // User has not liked the blog post yet, insert a new like entry
        $query = "INSERT INTO blog_like_data (like_user_id, blg_id, like_status) VALUES ('$current_user', '$blog_id', 1)";
        $insert_result = mysqli_query($conn, $query);
        if (!$insert_result) {
            // Return error response if insert operation fails
            $response = array(
                'success' => false,
                'message' => 'Failed to insert like entry',
                'debug' => mysqli_error($conn)
            );
            echo json_encode($response);
            exit;
        }
        $liked = true;
    }

    // Update blog_data table's blg_like_count
    $like_count_query = "SELECT COUNT(*) AS like_count FROM blog_like_data WHERE blg_id = '$blog_id'";
    $like_count_result = mysqli_query($conn, $like_count_query);
    $row = mysqli_fetch_assoc($like_count_result);
    $like_count = $row['like_count'];

    $update_count_query = "UPDATE blog_data SET blg_like_count = $like_count WHERE blg_id = '$blog_id'";
    $update_count_result = mysqli_query($conn, $update_count_query);
    if (!$update_count_result) {
        // Return error response if update operation fails
        $response = array(
            'success' => false,
            'message' => 'Failed to update like count in blog_data table',
            'debug' => mysqli_error($conn)
        );
        echo json_encode($response);
        exit;
    }

    // Return success response with updated like count and like status
    $response = array(
        'success' => true,
        'liked' => $liked,
        'like_count' => $like_count
    );
    echo json_encode($response);
} else {
    // If request method is not POST, return an error response
    $response = array(
        'success' => false,
        'message' => 'Invalid request method'
    );
    echo json_encode($response);
}
?>
