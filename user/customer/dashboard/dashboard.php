
<?php
    session_start();

    include "../../../includes/table_query/db_connection.php";

    // include "../../../includes/security_function/secure_function.php";
    include "../../../modules/blog/blog-data.php";
    require "../../../includes/code_generator/primary_key_generator.php";
    include "../../../modules/notification/customer-notification.php";
    include "../../../includes/security_function/secure_function.php";
    include "../../../includes/table_query/delete_user.php";
   
    if(isset($_GET['delete_status'])){
    
      if(deleteCustomerUser($_GET['current_user_id'])){
        mysqli_query($GLOBALS['connect'],"DELETE FROM customer_register WHERE b_id = '{$_GET['current_user_id']}'");
        session_destroy();
        header("location:/index.php");
        exit;
      }
    }
    if(isset($_SESSION['c_id'])){
      $c_id = $_SESSION['c_id'];
      // $p_user_id = $c_id;
     
      $current_user_id = $c_id;
      if(isset($current_user_id)){
        $_SESSION['current_user'] = $current_user_id;
      }
      $query = "SELECT * FROM customer_profile WHERE c_id = '$c_id'";
      $result = mysqli_query($GLOBALS['connect'],$query);
      // die($query);
      if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        
        
        // $_SESSION['cp_user_id'] = $row['cp_user_id'];
        // echo $_SESSION['cp_user_id'];
        // echo "<script>alert('{$row['cp_user_id']}')</script>";
        $profile_img = $row['cp_profile_img_url'];
        $username = $row['cp_username'];
        $query = "SELECT * FROM customer_register WHERE c_id = '$c_id'";
        
        $result = mysqli_query($GLOBALS['connect'],$query);
          if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $name = $row['c_fname']." ".$row['c_lname'];
          }
      }
    }

    if(isset($_GET['block_user_id'])){
      $block_user_id = $_GET['block_user_id'];
      $check_following_query = "SELECT * FROM follower_data WHERE fd_user_id='$block_user_id' AND block_status = 0";
      $check_following_result = mysqli_query($GLOBALS['connect'], $check_following_query);

      if(mysqli_num_rows($check_following_result) > 0){
          $update_status = "UPDATE follower_data SET block_status = 1 WHERE fd_user_id='$block_user_id' and follower_user_id='{$_SESSION['cp_user_id']}'";
          $result = mysqli_query($GLOBALS['connect'],$update_status);
      }
      $insert_blocked_user = "INSERT INTO blocked_user_data(bu_business_id,bu_user_id,bu_status) VALUES ('$block_user_id','$current_user_id',1)";
      $result = mysqli_query($GLOBALS['connect'],$insert_blocked_user);
      // die($insert_blocked_user);
      if($result){
          header("location:?block_status=yes");
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
<body class="vertical-bar" style="width:100%;box-sizing:border-box;">
<?php include "../../../modules/notification/notification.php"; ?>
<?php include "../../../component/logout.php"; ?>
<nav class="navbar text-bg-dark py-4 border-bottom">
            <div class="container">
                <div class="home-icon fs-5">
                    <i class="fa-solid fa-bars d-xxl-none d-xl-none d-lg-none d-inline" onclick="toggleUserMenu()"></i>
                    <i class="fa-solid fa-house mx-3 " onclick="location.href='/index.php'"></i>
                   
                </div>
                <div>
                  <?php if(isset($profile_img) && isset($name)): ?>
    <img src="<?php if(isset($profile_img)) echo $profile_img; else echo '/asset/image/user/profile.png'; ?>" alt="" class="rounded-circle" style="height:40px;width:40px">
    <span class="mx-1 fs-5 text-white"><?php if(isset($name)) echo $name?></span>
    <?php endif; ?>
</div>
                <div class="nav-menu fs-4 d-flex align-items-center" style="gap:15px">
                <?php 
                $get_notification = "SELECT n_user_id 
                FROM notification 
                WHERE n_user_id = '{$_SESSION['current_user']}' 
                AND n_type IN ('greeting','response') 
                AND n_status = 0;
                ";
                // echo $get_notification;
                $result = mysqli_query($GLOBALS['connect'],$get_notification);

                $_SESSION['n_status'] = 0;
                if(mysqli_num_rows($result) > 0){
            ?>  
            <i class="fa-solid fa-bell fs-4 position-relative" data-bs-target="#notificationModal" data-bs-toggle="modal"><span class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-danger" style="padding:5px"><span class="visually-hidden">unread messages</span></span></i>
              <?php
                }
                else if(isset($_SESSION['n_status']) && $_SESSION['n_status'] == 1){
                  
                 ?>
            <i class="fa-solid fa-bell fs-4 position-relative" data-bs-target="#notificationModal" data-bs-toggle="modal"></i>

                 <?php
                } else{
                  ?>
            <i class="fa-solid fa-bell fs-4 position-relative" data-bs-target="#notificationModal" data-bs-toggle="modal"></i>
                
                <?php }
                ?>
    <i class="fa-solid fa-right-from-bracket" data-bs-target="#logoutModal" data-bs-toggle="modal"></i>
</div>
  </nav>
<div class="d-flex">
<div class="col-xxl-2 col-lg-3 col-md-5 col-sm-7 col-9 sidebar-container d-xxl-block d-xl-block d-lg-none d-none  vertical-bar position-fixed"  style="min-height:calc(100vh - 102px);height:103vh;overflow:scroll;z-index:10" id="dashVertical">

            <div class="bg-dark text-light vertical-bar col-12" style="min-height:calc(100vh - 102px);margin-top:100px;overflow:scroll" data-bs-scroll="true" tabindex="-1"  aria-labelledby="dashNavLabel">
                <div class="offcanvas-body pt-5">
                    <div class="sidebar d-flex flex-column align-items-center">
                        <div class="profile-container">
                            <div class="profile-image d-flex flex-column justify-content-center align-items-center">
                                <img src="<?php if(isset($profile_img)){ $_SESSION['profile-image'] = $profile_img; echo $profile_img; } else{echo '/asset/image/user/profile.png'; $_SESSION['profile-image'] ='/asset/image/user/profile.png'; }?>" style="height:100px;width:100px;" class="rounded-circle " alt="">
                                <span class="text-white fs-4 fw-semibold"><?php if(isset($name)) echo $name ?></span>
                                <a href="/user/customer/dashboard/form/edit-profile.php" class="nav-link text-warning d-block text-center mt-1">Edit Profile</a>
                            </div>
                        </div>
                        <ul class="verticle-menu list-unstyled fs-5 mt-5">
    <li class="list-item mt-3"><a href="dashboard.php?content=dashboard" class="nav-link" data-menu-item-id="dashboard"><i class="fas fa-tachometer-alt"></i> &nbsp; Dashboard</a></li>
    <li class="list-item mt-3"><a href="dashboard.php?content=account" class="nav-link" data-menu-item-id="account"><i class="fa-regular fa-address-card"></i> &nbsp; Account</a></li>
    <li class="list-item mt-3"><a href="dashboard.php?content=notification" class="nav-link" data-menu-item-id="notification"><i class="fa-solid fa-bell"></i> &nbsp; Notification</a></li>
    <li class="list-item mt-3"><a href="dashboard.php?content=view" class="nav-link" data-menu-item-id="blog"><i class="fa-solid fa-camera-retro"></i> &nbsp; Blog</a></li>
    <!-- <li class="list-item mt-3"><a href="dashboard.php?content=create" class="nav-link" data-menu-item-id="create"><i class="fa-regular fa-square-plus"></i> &nbsp; Create</a></li> -->
    <li class="list-item mt-3"><a href="dashboard.php?content=search" class="nav-link" data-menu-item-id="search"><i class="fa-solid fa-magnifying-glass"></i> &nbsp; Search</a></li>
    <li class="list-item mt-3"><a href="dashboard.php?content=setting" class="nav-link" data-menu-item-id="setting"><i class="fa-solid fa-gear"></i> &nbsp; Setting</a></li>
    <li class="list-item mt-3"><a href="#" class="nav-link" data-bs-target="#logoutModal" data-bs-toggle="modal" data-menu-item-id="logout"><i class="fa-solid fa-right-from-bracket"></i> &nbsp; Logout</a></li>
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
                                        case "dashboard": include "content/customer_content.php";
                                        break;

                                        case "account": include "account/account.php";
                                        break;

                                        

                                        case "search" : include "../../../modules/search/search-business.php";
                                        break;

                                        case "view" : include "../../../modules/blog/view-blog.php";
                                        break;

                                        case "notification":fetchAndDisplayNotifications($GLOBALS['connect']);
                                        break;

                                        case "setting": include "setting/setting.php"; 
                                        break;
                                    }
                                } else{
                                    include "content/customer_content.php";
                                }
                        ?>
    
</div>

          </div>
          
          
          <script>
  // Toggle offcanvas function
  function toggleUserMenu() {
    var offcanvas = document.getElementById('dashVertical');
    var isVisible = offcanvas.classList.contains('d-none');
    console.log(offcanvas);
      offcanvas.classList.toggle('d-none');
    // if (isVisible) {
    //     offcanvas.classList.remove('d-none');
    // } else {
    //     offcanvas.classList.add('d-block');
    // }
}

</script>


</body>
</html>
