<?php
         include "../../includes/table_query/db_connection.php";
         require "../../modules/blog/blog-data.php";
         session_start();
         ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/asset/css/style.css">
    <?php
        include "../../asset/link/cdn-link.html";
        ?>
</head>
<body>
  <?php
          if(isset($_GET['share_blog_id'])){
            ?>
              <div class="shared-blog">
                <?php
                        if(isset($_SESSION['business_id'])){
                          
                          $current_user_id = $_SESSION['business_id'];
                        } else if(isset($_SESSION['c_id'])){
                          
                          $current_user_id = $_SESSION['c_id'];
                        }
                        if (!function_exists('fetch_blog')) {
                          function fetch_blog($blog_id, $current_user_id) {
                              // Function definition here
                          }
                      }
                      fetch_blog($_GET['share_blog_id'],$current_user_id);
                      include "../../modules/blog/view-blog.php";
                    ?>
                 
              </div>
            <?php
          } else{
              include "../../component/navbar.php";
              
              ?>
      <div class="container" style="margin-top:100px;">
        
        <?php include "../../modules/blog/view-blog.php"; ?>
      </div>
      <?php
      }
      ?>
</body>
</html>