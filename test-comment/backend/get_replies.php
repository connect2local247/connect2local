<?php
// Get the comment ID from the query parameters
$commentId = $_GET['commentId'];

// Connect to the database (Update the credentials accordingly)
$conn = new mysqli('localhost', 'root', '', 'connect2local');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve replies from the database
$sql = "SELECT text FROM comments WHERE parent_id = '$commentId'";
$result = $conn->query($sql);

$replies = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $replies[] = $row['text'];
    }
}

// Return replies as JSON
echo json_encode($replies);

// Close the database connection
$conn->close();
?>
