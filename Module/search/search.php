<?php
            include "../../includes/table_query/db_connection.php";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $searchQuery = $_POST["search-business"];
                $filterOption = isset($_POST["filter"]) ? $_POST["filter"] : "category";

                // Perform your search logic here based on $searchQuery and $filterOption
                $results = performSearch($searchQuery, $filterOption);

                // Send the results back as a JSON response
                header('Content-Type: application/json');
                echo json_encode($results);
            }

            function performSearch($searchQuery, $filterOption) {
                $conn = $GLOBALS['connect'];

                // Check the connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Use prepared statements to prevent SQL injection
                $stmt = $conn->prepare("
                    SELECT
                        bi.BUSINESS_NAME,
                        bi.OPERATE_TIME,
                        bi.CATEGORY,
                        bp.B_ID,
                        bp.USER_ID,
                        bp.USERNAME,
                        bp.PROFILE_IMG
                    FROM
                        business_info AS bi
                    JOIN
                        business_profile AS bp ON bi.B_ID = bp.B_ID
                    WHERE
                        -- Add your search conditions here based on user input
                        (bi.BUSINESS_NAME LIKE ? OR
                        bi.OPERATE_TIME LIKE ? OR
                        bi.CATEGORY LIKE ? OR
                        bp.USERNAME LIKE ?)
                ");

                // Bind parameters and execute
                $searchParam = "%" . $searchQuery . "%";
                $stmt->bind_param("ssss", $searchParam, $searchParam, $searchParam, $searchParam);
                $stmt->execute();

                // Get the result
                $result = $stmt->get_result();

                // Fetch results into an array
                $resultsArray = array();
                while ($row = $result->fetch_assoc()) {
                    $resultsArray[] = $row;
                }

                // Close statement and connection
                $stmt->close();
                $conn->close();

                return $resultsArray;
            }

?>