<?php
session_start();

include "../../../../includes/table_query/db_connection.php";
require "../../../../includes/code_generator/code_generator.php";
require "../../../../includes/security_function/secure_function.php";
include "../../../../includes/table_query/update_data.php";


if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}
function getSecurityKeyFromDatabase()
{
    // Assuming $GLOBALS['connect'] is a valadmin_id database connection

    $get_code_query = "SELECT admin_otp FROM admin_login WHERE admin_id = 1";
    $result = mysqli_query($GLOBALS['connect'], $get_code_query);

    if (!$result) {
        // Handle the query error (e.g., log, return an error code, etc.)
        return 0;
    }

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $admin_otp = $row['admin_otp'];

        return $admin_otp;
    }

    return 0;
}

if (isset($_POST['submit'])) {
    $user_code = $_POST['user-code'];

    $admin_otp = getSecurityKeyFromDatabase();

//     echo $admin_otp;
//     die();
    if (isset($_SESSION['code_attempts'])) {
        if ($_SESSION['code_attempts'] > 5) {
            // Check if 24 hours have passed since the first attempt
            $first_attempt_time = isset($_SESSION['first_attempt_time']) ? $_SESSION['first_attempt_time'] : 0;
            $current_time = time();

            if ($current_time - $first_attempt_time < 24 * 3600) {
                $_SESSION['error'] = "Too Many attempts. Please try again after 24 hours";
                header("location:/user/admin/login/form/admin-verification.php");
                exit();
            }
        }
    }

    if ($user_code == $admin_otp) {
        $_SESSION['greet-message'] = "Security Key Has been Matched.";
        $_SESSION['registered'] = 1;
        updateDataAdmin();
        unset($_SESSION['error']);
        if (isset($_SESSION['code_attempts'])) {
            unset($_SESSION['code_attempts']);
        }
    } else {
        if (isset($_SESSION['code_attempts'])) {
            $_SESSION['code_attempts']++;

            // Set the timestamp of the first attempt
            if ($_SESSION['code_attempts'] === 1) {
                $_SESSION['first_attempt_time'] = time();
            }
        } else {
            $_SESSION['code_attempts'] = 1;
        }

        $_SESSION['error'] = "Security Key Doesn't Matched";
    }

    header("location:/user/admin/login/form/admin-verification.php");
    exit();
}
?>
