<?php
    session_start();

    include "../../../includes/table_query/db_connection.php";
    include "../../../includes/security_function/secure_function.php";
    include "blog/blog-data.php";
    // include "../../../testblog.php";
    if(isset($_SESSION['bp_user_id'])){
      $bp_user_id = $_SESSION['bp_user_id'];
      
      $query = "SELECT * FROM business_profile WHERE bp_user_id = '$bp_user_id'";
      $result = mysqli_query($GLOBALS['connect'],$query);

      if(mysqli_num_rows($result) > 0){
          $row = mysqli_fetch_assoc($result);

          $name = $row['bp_fname']." ".$row['bp_lname'];
          $profile_img = $row['bp_profile_img_url'];
      }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <?php include "../../../asset/link/cdn-link.html"; ?>
  <link rel="stylesheet" href="/asset/css/style.css">
  <style>

    .profile-section {
      padding: 20px;
      border-bottom: 1px solid #ccc;
    }
    .profile-img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      margin-bottom: 10px;
    }
    .main-content {
      overflow-y: auto; /* Display scrollbar when content exceeds height */
    }
    /* Offcanvas styling */
   
  .vertical-bar::-webkit-scrollbar {
  width: 0px;  /* Remove scrollbar space */
  background: transparent;  /* Optional: just make scrollbar invisible */
}
.blog-overflow::-webkit-scrollbar{
  width:0;
  background:transparent;
}
  </style>
  
</head>
<body class="vertical-bar">
<nav class="navbar text-bg-dark py-4 border-bottom">
            <div class="container">
                <div class="home-icon fs-5">
                    <i class="fa-solid fa-bars d-xxl-none d-xl-none d-lg-none d-inline" onclick="toggleUserMenu()"></i>
                    <i class="fa-solid fa-house mx-3 " onclick="location.href='/index.php'"></i>
                   
                </div>
            <div class="nav-menu fs-5 d-flex" style="gap:15px">
                <i class="fa-solid fa-bell"></i>
                <i class="fa-solid fa-user"></i>
              
                <i class="fa-solid fa-square-plus" onclick="location.href='/user/businessman/dashboard/form/add-blog.php'"></i>
              
                <i class="fa-solid fa-square-plus" data-bs-target="#setUserNamePromptModal" data-bs-toggle="modal"></i>
                
            </div>
            </div>
</nav>
<div class="d-flex">
  <div class="col-xxl-2 col-lg-3 col-md-5 col-sm-7 col-9 sidebar-container d-xxl-block d-xl-block d-lg-none  d-none position-fixed" >
            <div class="bg-dark text-light vertical-bar col-12" style="min-height:calc(100vh - 102px);margin-top:100px" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                <div class="offcanvas-body pt-5">
                    <div class="sidebar d-flex flex-column align-items-center">
                        <div class="profile-container">
                            <div class="profile-image d-flex flex-column justify-content-center align-items-center">
                                <img src="<?php if(isset($profile_img)) echo $profile_img;else echo '/asset/image/user/profile.png'; ?>" style="height:100px;width:100px;" class="rounded-circle " alt="">
                                <span class="text-white fs-4 fw-semibold"><?php if(isset($name)) echo $name ?></span>
                                <a href="/user/businessman/dashboard/form/edit-profile.php" class="nav-link text-warning d-block text-center mt-1">Edit Profile</a>
                            </div>
                        </div>
                        <ul class="verticle-menu list-unstyled fs-5 mt-5">
    <li class="list-item mt-3"><a href="dashboard.php?content=dashboard" class="nav-link" data-menu-item-id="dashboard"><i class="fas fa-tachometer-alt"></i> &nbsp; Dashboard</a></li>
    <li class="list-item mt-3"><a href="dashboard.php?content=account" class="nav-link" data-menu-item-id="account"><i class="fa-regular fa-address-card"></i> &nbsp; Account</a></li>
    <li class="list-item mt-3"><a href="#" class="nav-link" data-menu-item-id="notification"><i class="fa-solid fa-bell"></i> &nbsp; Notification</a></li>
    <li class="list-item mt-3"><a href="#" class="nav-link" data-menu-item-id="blog"><i class="fa-solid fa-camera-retro"></i> &nbsp; Blog</a></li>
    <li class="list-item mt-3"><a href="dashboard.php?content=create" class="nav-link" data-menu-item-id="create"><i class="fa-regular fa-square-plus"></i> &nbsp; Create</a></li>
    <li class="list-item mt-3"><a href="#" class="nav-link" data-menu-item-id="search"><i class="fa-solid fa-magnifying-glass"></i> &nbsp; Search</a></li>
    <li class="list-item mt-3"><a href="#" class="nav-link" data-menu-item-id="setting"><i class="fa-solid fa-gear"></i> &nbsp; Setting</a></li>
    <li class="list-item mt-3"><a href="#" class="nav-link" data-menu-item-id="logout"><i class="fa-solid fa-right-from-bracket"></i> &nbsp; Logout</a></li>
</ul>

                    </div>
                </div>
              
            </div>
  </div>
  <div class="col offset-xxl-2 offset-xl-3 offset-0 d-flex flex-column vertical-bar p-1 menu-content" style="max-height:calc(100vh - 102px);margin-top:100px">
    
                        <?php
                                if(isset($_GET['content'])){
                                    $url = $_GET['content'];
                                    switch($url){
                                        case "dashboard": include "content/dashboard_content.php";
                                        break;

                                        case "account": include "account/account.php";
                                        break;

                                        case "create": include "form/add-blog2.php";
                                        break;
                                    }
                                } else{
                                    include "content/dashboard_content.php";
                                }
                        ?>
  <!-- <script>
    // JavaScript code to handle menu clicks and load content dynamically
    document.addEventListener('DOMContentLoaded', function() {
        const menuItems = document.querySelectorAll('.nav-link');
        
        menuItems.forEach(item => {
            item.addEventListener('click', function() {
                const menuItemId = this.dataset.menuItemId;
                loadContent(menuItemId);
            });
        });
        
        function loadContent(menuItemId) {
            // Send AJAX request to server to fetch content
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_content.php?menuItemId=' + menuItemId, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        document.querySelector('.menu-content').innerHTML = xhr.responseText;
                    } else {
                        // console.log('Error fetching content');
                    }
                }
            };
            xhr.send();
        }
    });
</script> -->

    
</div>

          </div>
          
          
<script>
  // Toggle offcanvas function
  function toggleOffcanvas() {
    var offcanvas = document.getElementById('offcanvasWithBothOptions');
    offcanvas.classList.toggle('show');
  }
</script>


</body>
</html>
