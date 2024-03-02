<?php
// Include your database connection file
include '../../../../includes/table_query/db_connection.php';
$conn = $GLOBALS['connect'];
// Check if action and requestId are set in the POST data
if (isset($_POST['action']) && isset($_POST['requestId'])) {
    $action = $_POST['action'];
    $requestId = $_POST['requestId'];

    // Prepare the SQL statement based on the action
    if ($action === 'accept') {
        $updateQuery = "UPDATE business_add_status SET approval_status = 1, approval_time = NOW() WHERE request_id = ?";
    } elseif ($action === 'reject') {
        $updateQuery = "UPDATE business_add_status SET approval_status = 0, approval_time = NOW() WHERE request_id = ?";
    } else {
        // Invalid action
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
        exit;
    }

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("s", $requestId);
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Request updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update request']);
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // Missing action or requestId
    echo json_encode(['success' => false, 'message' => 'Missing action or requestId']);
}
?>
