<?php
        include "includes/table_query/db_connection.php";
        include "includes/code_generator/primary_key_generator.php";

        $connect = $GLOBALS['connect'];

        function get_comment_data($blog_id){
          $comment_data = array();

          $current_user_id = $_SESSION['current_user'];

          $fetch_data_query = "SELECT * FROM comments WHERE blg_id = '$blog_id' and commentor_id = '$current_user_id'";
          $result = mysqli_query($connect,$fetch_data_query);

          if(mysqli_num_rows($result) > 0){
                $data = mysqli_fetch_assoc($result);
                array_push($comment_data,array("id" => $data['comment_id'],"blog_id" => $data['blg_id'], "user_id" => $data['commentor_id'],"time" => $data['comment_time']));
          }
        }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <?php include "asset/link/cdn-link.html"; ?>
</head>
<body>
    <div class="container">
            <div class="comment-container p-3 rounded shadow border">
              <div class="info-container d-flex align-items-center" style="gap:7px">
                <div class="profile-image">
                      <img src="/asset/image/user/profile.png" style="width:35px;height:35px;" class="rounded-circle" alt="" srcset="">
                </div>
                <div class="username">
                     <span class="fw-semibold">
                            @bhavesh_1724 : <p class="comment-content fw-normal d-inline" style="font-size:17px">Hi your blog is awesome</p>
                            <span class="time fw-normal text-secondary" style="font-size:13px">1 min</span>
                     </span>                    
                </div>
              </div>
            </div>
    </div>
</body>
</html>
