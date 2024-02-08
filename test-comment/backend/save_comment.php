<?php
// Get the JSON data from the frontend
$data = json_decode(file_get_contents('php://input'), true);

// Validate and sanitize the comment text
$commentText = filter_var($data['text'], FILTER_SANITIZE_STRING);

// Get the parent comment ID (if it's a reply)
$parentId = isset($data['parentId']) ? $data['parentId'] : null;

// Connect to the database (Update the credentials accordingly)
$conn = new mysqli('localhost', 'root', '', 'connect2local');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert the comment or reply into the database
$sql = "INSERT INTO comments (text, parent_id) VALUES ('$commentText', $parentId)";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => $conn->error]);
}

// Close the database connection
$conn->close();
?>
