<?php
    session_start();

    include "../../../includes/table_query/db_connection.php";
    include "../../../includes/security_function/secure_function.php";
    require "../../../modules/blog/blog-data.php";
    require "../../../includes/code_generator/primary_key_generator.php";
    include "../../../modules/notification/business-notification.php";
    include "../../../includes/table_query/delete_user.php";

   
    if(isset($_GET['delete_status'])){
    
      if(deleteBusinessUser($_GET['current_user_id'])){
        mysqli_query($GLOBALS['connect'],"DELETE FROM business_register WHERE b_id = '{$_GET['current_user_id']}'");
        session_destroy();
        header("location:/index.php");
        exit;
      }
    }
    // include "../../../testblog.php";
    if(isset($_SESSION['bp_user_id'])){
      $bp_user_id = $_SESSION['bp_user_id'];
      $current_user_id = $_SESSION['business_id'];
      if(isset($current_user_id)){
        $_SESSION['current_user'] = $current_user_id;
      }
      $query = "SELECT * FROM business_profile WHERE bp_user_id = '$bp_user_id'";
      $result = mysqli_query($GLOBALS['connect'],$query);

      if(mysqli_num_rows($result) > 0){
          $row = mysqli_fetch_assoc($result);

          $name = $row['bp_fname']." ".$row['bp_lname'];
          $profile_img = $row['bp_profile_img_url'];
      }
    }

    if(isset($_GET['block_user_id'])){
      $block_user_id = $_GET['block_user_id'];
      $check_following_query = "SELECT * FROM follower_data WHERE fd_user_id='$block_user_id' AND block_status = 0";
      $check_following_result = mysqli_query($GLOBALS['connect'], $check_following_query);

      if(mysqli_num_rows($check_following_result) > 0){
          $update_status = "UPDATE follower_data SET block_status = 1 WHERE fd_user_id='$block_user_id' and follower_user_id='{$_SESSION['bp_user_id']}'";
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
  <link rel="stylesheet" href="/asset/css/form.css">
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
<body class="vertical-bar text-bg-dark">
  <?php include "../../../component/logout.php" ?>
  <?php include "../../../component/username-modal.php"; ?>
  <?php include "../../../modules/notification/notification.php"; ?>
<nav class="navbar text-bg-dark py-4 border-bottom" style="z-index:10">
            <div class="container">
                <div class="home-icon fs-5">
                    <i class="fa-solid fa-bars d-xxl-none d-xl-none d-lg-none d-inline" onclick="toggleUserMenu()"></i>
                    <i class="fa-solid fa-house mx-3 " onclick="location.href='/index.php'"></i>
                   
                </div>
            <div class="nav-menu fs-5 d-flex align-items-center" style="gap:15px">
            <?php 
                $get_notification = "SELECT n_user_id 
                FROM notification 
                WHERE n_user_id = '{$_SESSION['current_user']}' 
                AND n_type IN ('interact', 'warning', 'greeting', 'achievement', 'response') 
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
              
                   $get_business_code = "SELECT business_code FROM business_info WHERE b_id = '$current_user_id'";
                   $result = mysqli_query($GLOBALS['connect'],$get_business_code);
                    // die($get_business_code);
                  //  die($get_business_code);
                   if(mysqli_num_rows($result) <= 0){
                        
                          

                     
              ?>
              <a href="/user/businessman/add_business/form/add-business-form.php?source=dashboard&business_id=<?php echo $current_user_id ?>&user_id=<?php echo $bp_user_id ?>" class="nav-link">
                <img src="/asset/image/svg/add-business.svg" alt="" style="height:35px;width:35px;">
              </a>

              <!-- <i class="fa-solid fa-square-plus fs-4" onclick="location.href='/user/businessman/dashboard/form/add-blog.php'"></i> -->
              <?php
                       } else{
                                    $row = mysqli_fetch_assoc($result);

                                    $business_code = $row['business_code'];

                                    $check_status = "SELECT approval_status FROM business_add_status WHERE business_code='$business_code' AND approval_status = 0";

                                    // die($check_status);
                                    if(mysqli_num_rows(mysqli_query($GLOBALS['connect'],$check_status)) > 0){
                       
               
              ?>
              <!-- <a href="/user/businessman/add_business/form/add-business-form.php?source=dashboard&business_id=<?php echo $current_user_id ?>&user_id=<?php echo $bp_user_id ?>" class="nav-link">

                <img src="/asset/image/svg/add-business.svg" alt="" style="height:35px;width:35px;">
              </a> -->
              <?php
                       }
                      }
              ?>
              <!-- HTML -->
<div class="dropdown">
    <div class="d-inline-block position-relative">
        <img src="<?php if(isset($profile_img)) echo $profile_img; else echo '/asset/image/user/profile.png'; ?>" alt="" class="rounded-circle" style="height:40px;width:40px" id="profileButton">
        <div class="dropdown-menu position-absolute" aria-labelledby="profileDropdown" id="profileDropdownMenu" style="left: 50%; transform: translateX(-50%);">
            <a class="dropdown-item" href="/modules/user-profile/profile.php?profile_id=<?php echo $current_user_id ?>">View Profile</a>
            <button class="dropdown-item" id="logoutButton" type="button" data-bs-target="#logoutModal" data-bs-toggle="modal">Logout</button>
        </div>
    </div>
</div>

<!-- jQuery -->
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript -->
<script>
$(document).ready(function () {
    // Hide the dropdown menu initially
    $('#profileDropdownMenu').hide();

    // Show the dropdown menu when profile image is clicked
    $('#profileButton').click(function() {
        $('#profileDropdownMenu').toggle();
    });

  
});
</script>
                <!-- <i class="fa-solid fa-square-plus" data-bs-target="#setUserNamePromptModal" data-bs-toggle="modal"></i> -->
                
            </div>
            </div>
</nav>
<div class="d-flex">
<div class="col-xxl-2 col-lg-3 col-md-5 col-sm-7 col-9 sidebar-container d-xxl-block d-xl-block d-lg-none d-none position-fixed vertical-bar"  style="min-height:calc(100vh - 102px);height:103vh;overflow:scroll;z-index:10;margin-top:100px;" id="dashVertical">
            <div class="bg-dark text-light col-12 border border-0 border-end vertical-bar" style="min-height:calc(100vh - 102px);height:103vh;overflow:scroll" data-bs-scroll="true" tabindex="-1" aria-labelledby="offcanvasWithBothOptionsLabel">
                <div class="offcanvas-body pt-5">
                    <div class="sidebar d-flex flex-column align-items-center vertical-bar " style="overflow:scroll">
                        <div class="profile-container">
                            <div class="profile-image d-flex flex-column justify-content-center align-items-center">
                                <img src="<?php if(isset($profile_img)) echo $profile_img;else echo '/asset/image/user/profile.png'; ?>" style="height:100px;width:100px;" class="rounded-circle " alt="">
                                <span class="text-white fs-4 fw-semibold"><?php if(isset($name)) echo $name ?></span>
                                <a href="/user/businessman/dashboard/form/edit-profile.php" class="nav-link text-warning d-block text-center mt-1">Edit Profile</a>
                            </div>
                        </div>
                        <ul class="verticle-menu list-unstyled fs-5 mt-5">
    <li class="list-item mt-3"><a href="dashboard.php?content=dashboard" class="nav-link" data-menu-item-id="dashboard"><i class="fas fa-tachometer-alt"></i> &nbsp; Dashboard</a></li>
    <li class="list-item mt-3">
      <?php if(isset($check_status)): ?>
    <?php if(mysqli_num_rows(mysqli_query($GLOBALS['connect'],$check_status)) == 0): ?>
    <a href="dashboard.php?content=account" class="nav-link" data-menu-item-id="account">
        <i class="fa-regular fa-address-card"></i> &nbsp; Account
    </a>
    <?php else: ?>
    <a href="#" class="nav-link disabled text-secondary" aria-disabled="true" data-menu-item-id="account">
      <i class="fa-solid fa-lock text-secondary"></i>
        &nbsp; Account
    </a>
    <?php endif; ?>
    <?php endif; ?>
</li>
    <li class="list-item mt-3"><a href="?content=notification" class="nav-link" data-menu-item-id="notification"><i class="fa-solid fa-bell"></i> &nbsp; Notification</a></li>
    <li class="list-item mt-3"><a href="?content=view" class="nav-link" data-menu-item-id="blog"><i class="fa-solid fa-camera-retro"></i> &nbsp; Blog</a></li>
    <li class="list-item mt-3">
    <?php
      $query = "SELECT bp_username FROM business_profile WHERE b_id = '$current_user_id' AND bp_username IS NOT NULL LIMIT 1";

     if(isset($check_status)){ 
    if((mysqli_query($GLOBALS['connect'],$query) && mysqli_num_rows(mysqli_query($GLOBALS['connect'],$query)) > 0)){
    ?>
    <?php if(mysqli_num_rows(mysqli_query($GLOBALS['connect'],$check_status)) == 0){ ?>
    <a href="dashboard.php?content=create" class="nav-link" data-menu-item-id="create">
        <i class="fa-regular fa-square-plus"></i> &nbsp; Create
    </a>
    
    <?php } else{?>
    <a href="#" class="nav-link disabled text-secondary" aria-disabled="true" data-menu-item-id="create">
      <i class="fa-solid fa-lock text-secondary"></i>
        &nbsp; Create
    </a>
    <?php }}else{ ?>
      <span class="nav-link" data-bs-target="#setUserNameModal" data-bs-toggle="modal" data-menu-item-id="create">
        <i class="fa-regular fa-square-plus"></i> &nbsp; Create
      </span>
      <?php }} ?>
</li>
    <li class="list-item mt-3"><a href="?content=search" class="nav-link" data-menu-item-id="search"><i class="fa-solid fa-magnifying-glass"></i> &nbsp; Search</a></li>
   <li class="list-item mt-3">
    <?php if(isset($check_status)): ?>
    <?php if(mysqli_num_rows(mysqli_query($GLOBALS['connect'],$check_status)) == 0): ?>
    <a href="dashboard.php?content=setting" class="nav-link" data-menu-item-id="setting">
        <i class="fa-solid fa-gear"></i> &nbsp; Setting
    </a>
    <?php else: ?>
    <a href="#" class="nav-link disabled text-secondary" aria-disabled="true" data-menu-item-id="setting">
      <i class="fa-solid fa-lock text-secondary"></i>
       &nbsp; Setting
    </a>
    <?php endif; ?>
    <?php endif;?>
</li>
    <li class="list-item mt-3"><a href="#" class="nav-link" data-menu-item-id="logout" data-bs-target="#logoutModal" data-bs-toggle="modal"><i class="fa-solid fa-right-from-bracket"></i> &nbsp; Logout</a></li>
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

                                        case "create": include "form/add-blog.php";
                                        break;

                                        case "search" : include "../../../modules/search/search-business.php";
                                        break;

                                        case "view" : include "../../../modules/blog/view-blog.php";
                                        break;

                                        case "notification":echo "<div class=' p-3'>".fetchAndDisplayNotifications($GLOBALS['connect'])."</div>";
                                        break;

                                        case "setting" : include "setting/setting.php";
                                        break;
                                    }
                                } else{
                                    include "content/dashboard_content.php";
                                }
                        ?> 
</div>

          </div>
          
          <script>
  // Toggle offcanvas function
  function toggleUserMenu() {
    var offcanvas = document.getElementById('dashVertical');
    var isVisible = offcanvas.classList.contains('d-none');
    // console.log(offcanvas);
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
