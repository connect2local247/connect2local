<?php
include "../../includes/table_query/db_connection.php";
include "blog-data.php";
session_start();
if(isset($_GET['shared_blog_id']))
{
    $shared_blog_id = $_GET['shared_blog_id'];
}
// Function to get the appropriate user ID based on the user type
function getCurrentUserID() {
    if (isset($_SESSION['business_id'])) {
        // If the current user is a business user, fetch the b_id
        return $_SESSION['business_id'];
    } elseif (isset($_SESSION['c_id'])) {
        // If the current user is a customer, fetch the c_id
        return $_SESSION['c_id'];
    }
    return null;
}

// Function to check if the shared blog is blocked by the current user
function isBlockedByCurrentUser($shared_blog_id, $current_user_id) {
    if (!$current_user_id) {
        return false;
    }

    // Query to check if the shared blog is blocked by the current user
    $query_check_block = "SELECT * FROM blocked_user_data WHERE bu_user_id = '$current_user_id' AND bu_business_id = (SELECT bp_user_id FROM blog_data WHERE blg_id = '$shared_blog_id')";
    $result_check_block = mysqli_query($GLOBALS['connect'], $query_check_block);
    return mysqli_num_rows($result_check_block) > 0;
}

// Function to get random blog IDs excluding the shared blog and user's blogs
function getRandomBlogIDs($shared_blog_id, $current_user_id) {
    $blogIDs = [];
    
    if (!$current_user_id) {
        return $blogIDs;
    }
    
    // Check if the shared blog is blocked by the current user
    if (isBlockedByCurrentUser($shared_blog_id, $current_user_id)) {
        $_SESSION['blocked_blog'] = 1;
        // echo "<div class='alert alert-warning d-flex align-self-center w-100 border border-4 border-danger text-center' role='alert'>This shared blog is blocked by you.</div>";
        return $blogIDs;
    }

    // Query to select random blog IDs from the blog_data table excluding the shared blog and blocked blogs
    $query = "SELECT blg_id 
              FROM blog_data 
              WHERE blg_id != '$shared_blog_id' 
              AND NOT EXISTS (
                  SELECT 1 FROM blocked_user_data 
                  WHERE bu_user_id = '$current_user_id' 
                  AND bu_business_id = (SELECT bp_user_id FROM blog_data WHERE blg_id = '$shared_blog_id')
              ) 
              ORDER BY RAND()";

    $result = mysqli_query($GLOBALS['connect'], $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $blogIDs[] = $row['blg_id'];
    }

    return $blogIDs;
}

// Function to display blogs based on their IDs
function displayBlogs($blog_ids, $current_user_id) {
    foreach ($blog_ids as $blog_id) {
        echo "<div class='blog-container p-5 h-100 d-flex align-items-center justify-content-center w-100'>";
        fetch_blog($blog_id, $current_user_id);
        echo "</div>";
    }
}

// Get the shared blog ID
$shared_blog_id = isset($_GET['shared_blog_id']) ? $_GET['shared_blog_id'] : null;

// Get the current user's ID
$current_user_id = getCurrentUserID();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include "../../asset/link/cdn-link.html"; ?>
    <style>
        /* .blog-conatiner{
          display:flex;
          border:1px solid red;
          height:100vh;
          width:90%;
          justify-content:center;
          align-items:center;
        } */
       
    </style>
    <link rel="stylesheet" href="/asset/css/style.css">
</head>
<body>
<div class="container ">

    <div class="col-lg-6 border  m-auto text-bg-dark overflow-auto vertical-bar position-relative" style="height:100vh;max-height:100vh;">
    <div class="back text-start position-absolute top-0 text-white ms-3 fs-4 mt-3">
        <i class="fa-solid fa-arrow-left" onclick='window.history.back();'></i>
        
    </div>
            <?php
                        if(isset($_SESSION['blocked_blog'])){
                            echo "<div class='blog-container p-5 h-100 d-flex align-items-center justify-content-center w-100 fs-3 fw-bold'>
                            This User is Blocked By You</div>";
                        }

                        
            ?>
        <div class="blog-container p-5 h-100 d-flex align-items-center justify-content-center w-100">
            <?php
            // Display the shared blog if available
            if ($shared_blog_id && $current_user_id) {
                
                // Check if the shared blog is blocked by the current user
                if (!isBlockedByCurrentUser($shared_blog_id, $current_user_id)) {
                    // Get random blog IDs excluding the shared blog and blocked blogs
                    $random_blog_ids = getRandomBlogIDs($shared_blog_id, $current_user_id);
                    fetch_blog($shared_blog_id, $current_user_id);
                    
                    // if (empty($random_blog_ids)) {
                        
                    //     fetch_blog($shared_blog_id, $current_user_id);
                    // }
                }
            } else {
                echo "<div class='alert alert-danger' role='alert'>Invalid shared blog ID.</div>";
            }
            echo "</div>";

            // Get random blog IDs excluding the shared blog and user's blogs
            $random_blog_ids = getRandomBlogIDs($shared_blog_id, $current_user_id);

            // Display random blogs
            displayBlogs($random_blog_ids, $current_user_id);
        
            ?>

          
    </div>
</div>
</body>
</html>
