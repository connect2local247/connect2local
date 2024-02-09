<?php
        session_start();
        include "../../includes/table_query/db_connection.php";
        require "../../includes/table_query/get_data_query.php";
        include "../../includes/blog_function/time_function.php";
        include "../../testblog.php";
        include "../../testshare.php";
        require "../../includes/security_function/secure_function.php";
?>  
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <?php include "../../asset/link/cdn-link.html"; ?>
  <link rel="stylesheet" href="/asset/css/style.css">
</head>
<body>
        <?php
            $user_id = $_SESSION['user_id'];
            // die($user_id);
            fetch_profile($user_id);
//             error_reporting(E_ALL);
// ini_set('display_errors', 1);

        ?> 
   

   
    <section class="user-blog mt-5 mb-4 py-5 px-4">  
    <div class="container">
        <div class="row">
            <?php
            // $user_id = $_SESSION['user_id']; // Assuming user ID is available in session
            $query = "SELECT BLG_ID FROM blog_data WHERE USER_ID = '$user_id'";
            $result = mysqli_query($GLOBALS['connect'],$query);
            
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)) {
                    $blog_id = $row['BLG_ID'];
            ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-4">
                <?php generateBlog($blog_id); ?>
            </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</section>

</body>
</html>