<?php
        session_start();
        include "../../includes/table_query/db_connection.php";
        require "../../includes/table_query/get_data_query.php";
        include "../../includes/blog_function/time_function.php";
        include "../../testblog.php";
?>  
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <?php include "../../asset/link/cdn-link.html"; ?>
  <link rel="stylesheet" href="/asset/css/style.css">
  <style>
      .business-info-btn{
        background:linear-gradient(red,yellow)
      }
  </style>
</head>
<body>
<div class="profile-container border">
    <div class="container border rounded-1 border-dark text-bg-light bg-gradient p-2">
        <div class="row border-bottom border-dark px-1 py-4 mx-1">
            <div class="col-lg-5 p-3 d-flex justify-content-center align-items-center flex-column col-12" style="gap:15px">
                <img src="/asset/image/user/profile.png" class="rounded-circle border p-1" style="height:200px;width:200px" alt="">
                <span class="fs-4" style="font-weight:500">Bhavesh Parmar</span>
                <!-- <div class="social-link fs-4 d-flex" style="gap:15px">
                    <a href="#" class="social-media-link text-white"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="social-media-link text-white"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" class="social-media-link text-white"><i class="fa-brands fa-linkedin"></i></a>
                    <a href="#" class="social-media-link text-white"><i class="fa-brands fa-twitter"></i></a>
                </div> -->
                <button class="btn text-bg-primary bg-gradient shadow px-3">Follow</button>
            </div>
            <div class="col-7 d-flex flex-column justify-content-center" style="gap:20px">
                <div class="user-name fs-4 ms-1">
                    Bhavesh_1724
                </div>
                <div class="user-profile-activity-info m-0">
                    <ul class="list-unstyled d-flex fw-bold m-0" style="gap:10%">
                        <li class="list-item d-flex flex-column justify-content-center text-center"><span class="blog-count">1</span> <span>Blog</span></li>
                        <li class="list-item d-flex flex-column justify-content-center text-center"><span class="blog-count">1</span> <span>Followers</span></li>
                        <li class="list-item d-flex flex-column justify-content-center text-center"><span class="blog-count">1</span> <span>Following</span></li>
                    </ul>
                </div>
                <div class="business-info fs-5">
                        <span class="business-name text-secondary">LAB Solutions</span>
                        <span class="category text-secondary">(Advertising)</span>
                </div>
                <div class="profile-description">
                    <p class="" style="white-space:pre-line">
                        Offering Services
                        ▶ Frontend Design
                        ▶ Ecommerce Store
                        ▶ Wordpress Site
                        ▶ PHP
                        ▶ Bug & Error Fixing
                        Email : bhaveshwebstudio@gmail.com
                        #webdeveloper
                    </p>
                </div>

                <div class="business-info">
                      <button class="btn border business-info-btn text-white" style="width:100px;height:40px">Contact</button>
                      <button class="btn border business-info-btn text-white" style="width:100px;height:40px">Email</button>
                      <button class="btn border business-info-btn text-white" style="width:100px;height:40px">Address</button>
                </div>
            </div>
        </div>
        <section class="user-blog mt-5 mb-4 py-5 px-4">  
            <?php
                    $user_id = $_SESSION['user_id']; // Assuming user ID is available in session
                    $query = "SELECT BLG_ID FROM blog_data WHERE USER_ID = '$user_id'";
                    $result = mysqli_query($GLOBALS['connect'],$query);
                    
                    if(mysqli_num_rows($result) > 0){
                        $row_count = mysqli_num_rows($result);

                        for($i = 0; $i < $row_count; $i++){   
                            echo "<div class='row'>";
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<div class='col-3'>";
                            $blog_id = $row['BLG_ID'];
                            generateBlog($blog_id);
                            echo "</div>";
                        }
                        echo "</div>";
                    }
                    }
            ?>
        
</section>
    </div>
</div>



</body>
</html>