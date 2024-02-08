<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the linkIndex is set in the POST data
    if (isset($_POST['linkIndex'])) {
        $linkIndex = $_POST['linkIndex'];
        if (isset($_SESSION['linkDataArray'])) {
            // Retrieve the session data
            $linkDataArray = $_SESSION['linkDataArray'];

            // Check if the linkIndex is valid
            if ($linkIndex >= 0 && $linkIndex < count($linkDataArray)) {
                // Remove the element at the specified index
                array_splice($linkDataArray, $linkIndex, 1);

                // Update the session data
                $_SESSION['linkDataArray'] = $linkDataArray;

                // Send a response indicating success (you can customize this)
                echo json_encode(['status' => 'success']);
            } else {
                // Send a response indicating an invalid linkIndex
                echo json_encode(['status' => 'error', 'message' => 'Invalid linkIndex']);
            }
        } else {
            // Send a response indicating that the session data is not set
            echo json_encode(['status' => 'error', 'message' => 'Session data not set']);
        }
    } else {
        // Send a response indicating that linkIndex is not set in POST data
        echo json_encode(['status' => 'error', 'message' => 'linkIndex not set in POST data']);
    }
} else {
    // Send a response indicating an invalid request method
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
