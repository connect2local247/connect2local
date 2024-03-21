<?php
include "../../includes/table_query/db_connection.php";
session_start();

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchQuery = $_POST["search-business"];
    $filterOption = isset($_POST["filter"]) ? $_POST["filter"] : "bi_category";
    $_SESSION['filter'] = $filterOption;

    // Perform search and handle errors
    try {
        $results = performSearch($searchQuery, $filterOption);
        $_SESSION['filterOption'] = $filterOption;

        // Send the results back as a JSON response
        header('Content-Type: application/json');
        echo json_encode($results);
    } catch (Exception $e) {
        // Handle any exceptions
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(array('error' => $e->getMessage()));
    }
}

function performSearch($searchQuery, $filterOption) {
    // Include database connection
    include "../../includes/table_query/db_connection.php";

    // Check the connection
    if ($connect->connect_error) {
        throw new Exception("Connection failed: " . $connect->connect_error);
    }

    // Use prepared statements to prevent SQL injection
    $searchCondition = getSearchCondition($filterOption);

    // Prepare SQL query
    $stmt = $connect->prepare("
        SELECT
            bi.business_name,
            bi.bi_operate_time,
            bi.bi_category,
            bp.b_id,
            bp.bp_user_id,
            bp.bp_username,
            bp.bp_profile_img_url
        FROM
            business_info AS bi
        JOIN
            business_profile AS bp ON bi.b_id = bp.b_id
        WHERE
            $searchCondition
    ");

    if (!$stmt) {
        throw new Exception("Error in SQL query: " . $connect->error);
    }

    // Bind parameters and execute
    $searchParam = "%" . $searchQuery . "%";
    $current_user_id = $_SESSION['current_user'];
    if (!bindParams($stmt, $searchParam, $filterOption, $current_user_id)) {
        throw new Exception("Error binding parameters");
    }

    if (!$stmt->execute()) {
        throw new Exception("Error executing query: " . $stmt->error);
    }

    // Get the result
    $result = $stmt->get_result();

    if (!$result) {
        throw new Exception("Error fetching result: " . $stmt->error);
    }

    // Fetch results into an array
    $resultsArray = array();
    while ($row = $result->fetch_assoc()) {
        // Check if the user is blocked
        $bp_user_id = $row['bp_user_id'];
        if (!isUserBlocked($bp_user_id, $current_user_id)) {
            $resultsArray[] = $row;
        }
    }

    // Close statement and connection
    $stmt->close();
    $connect->close();

    return $resultsArray;
}

// Helper function to check if a user is blocked
function isUserBlocked($bp_user_id, $current_user_id) {
    include "../../includes/table_query/db_connection.php";
    $stmt = $connect->prepare("
        SELECT COUNT(*) as count
        FROM blocked_user_data
        WHERE bu_business_id = ? AND bu_user_id = ?
    ");
    $stmt->bind_param("ss", $bp_user_id, $current_user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return $row['count'] > 0;
}

// Helper function to bind parameters based on the filter option
function bindParams($stmt, $searchParam, $filterOption, $current_user_id) {
    switch ($filterOption) {
        case 'business name':
        case 'by opening hour':
        case 'bi_category':
        case 'bp_username':
            return $stmt->bind_param("s", $searchParam);
        default:
            return $stmt->bind_param("ssss", $searchParam, $searchParam, $searchParam, $current_user_id);
    }
}
function getSearchCondition($filterOption) {
    switch ($filterOption) {
        case 'business name':
            return "bi.business_name LIKE ?";
        case 'by opening hour':
            return "bi.bi_operate_time LIKE ?";
        case 'bi_category':
            return "bi.bi_category LIKE ?";
        case 'bp_username':
            // Use a combination of LIKE and REGEXP to handle special characters and digits
            return "bp.bp_username LIKE CONCAT('%', ?, '%') AND bp.bp_username REGEXP ?";
        default:
            // Default to an empty string for no specific condition
            return "bi.business_name LIKE ? OR bi.bi_operate_time LIKE ? OR bi.bi_category LIKE ? OR bp.bp_username LIKE ?";
    }
}


?>
