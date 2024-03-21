<?php
// Perform any server-side logic here
$response = ['success' => true, 'message' => 'Notification from server!'];
header('Content-Type: application/json');
echo json_encode($response);

?>