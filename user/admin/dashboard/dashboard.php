<?php
    session_start();
    include "../../../includes/table_query/db_connection.php";
    include "../../../includes/security_function/secure_function.php";
    include "../../../modules/notification/admin-notification.php";
    $current_user_id = 1;

    if(isset($current_user_id)){
      $_SESSION['current_user'] = $current_user_id;
    }


  function send_notification($user_id,$report_type){
    // $check_exist = "SELECT * FROM notification WHERE n_user_id = '$user_id' and n_type = 'warning' and n_content='your blog in under copyright violation'";
    // $result = mysqli_query($GLOBALS['connect'],$check_exist);
    
    // // die($check_exist);
   
        if($report_type == "copyright_violation"){
          $query = "INSERT INTO notification(n_content,n_type,n_user_id,n_time) VALUES ('your blog in under copyright violation ','warning','$user_id',NOW())";
        $result = mysqli_query($GLOBALS['connect'],$query);

        } else if($report_type == "harm" || $report_type == "inappropriate_content"){
          $query = "INSERT INTO notification(n_content,n_type,n_user_id,n_time) VALUES ('your blog is not appropriate for users ','response','$user_id',NOW())";
          $result = mysqli_query($GLOBALS['connect'],$query);
        }
      
}

      if((isset($_GET['report_id']) && isset($_GET['report_status']))){
        $report_id = $_GET['report_id'];
        $status = $_GET['report_status'];

        if($status == "true"){
          $get_id = "SELECT b_id FROM business_profile WHERE bp_user_id = '{$_GET['current_user_id']}'";
          $result = mysqli_query($GLOBALS['connect'],$get_id);
          // die($get_id);
          $count = mysqli_num_rows($result);

          if($count > 0){
            $data = mysqli_fetch_assoc($result);
            $id = $data['b_id'];
            // die($id);
          }
          $update_query = "UPDATE blog_report SET report_status = 1 WHERE report_id = '$report_id'";
          $result = mysqli_query($GLOBALS['connect'],$update_query);

          send_notification($id,$_GET['report_type']);
        }else{
          $delete_query = "DELETE FROM blog_report WHERE report_id = '$report_id'";    
          $result = mysqli_query($GLOBALS['connect'],$delete_query);
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
      overflow:auto; /* Display scrollbar when content exceeds height */
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
.active:hover{
  color:skyblue;
}
  </style>
  
</head>
<body class="vertical-bar text-bg-dark">
  <?php include "../../../modules/notification/notification.php";?>
  <?php include "../../../component/logout.php"; ?>
<nav class="navbar text-bg-dark py-4 border-bottom">
            <div class="container">
                <div class="home-icon fs-5">
                    <i class="fa-solid fa-bars d-xxl-none d-xl-none d-lg-none d-inline" onclick="toggleUserMenu()"></i>
                    <i class="fa-solid fa-house mx-3 " onclick="location.href='/index.php'"></i>
                   
                </div>
                <div class="username fs-3 fw-semibold">
 
                    Admin 
                </div>
                <div class="d-flex align-items-center" style="gap:15px">
                <?php 
                $get_notification = "SELECT n_user_id 
                FROM notification 
                WHERE n_type IN ('report','request') 
                AND n_status = 0
                ";
                // echo $get_notification;
                $result = mysqli_query($GLOBALS['connect'],$get_notification);

                $_SESSION['n_admin_status'] = 0;
                if(mysqli_num_rows($result) > 0){
            ?>  
            <i class="fa-solid fa-bell fs-4 position-relative" data-bs-target="#notificationModal" data-bs-toggle="modal"><span class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-danger" style="padding:5px"><span class="visually-hidden">unread messages</span></span></i>
              <?php
                }
                else if(isset($_SESSION['n_admin_status']) && $_SESSION['n_admin_status'] == 1){
                  
                 ?>
            <i class="fa-solid fa-bell fs-4 position-relative" data-bs-target="#notificationModal" data-bs-toggle="modal"></i>

                 <?php
                } else{
                  ?>
            <i class="fa-solid fa-bell fs-4 position-relative" data-bs-target="#notificationModal" data-bs-toggle="modal"></i>
                
                <?php }
                ?>
                
                            <!-- HTML -->
<div class="dropdown">
    <div class="d-inline-block position-relative">
        <img src="<?php if(isset($profile_img)) echo $profile_img; else echo '/asset/image/user/profile.png'; ?>" alt="" class="rounded-circle" style="height:40px;width:40px" id="profileButton">
        <div class="dropdown-menu position-absolute" aria-labelledby="profileDropdown" id="profileDropdownMenu" style="left: 50%; transform: translateX(-50%);">
        <a class="dropdown-item" href="/modules/user-profile/profile.php?profile_id=<?php echo $current_user_id ?>">Edit</a> 

            <button class="dropdown-item" id="logoutButton" type="button" data-bs-target="#logoutModal" data-bs-toggle="modal">Logout</button>
        </div>
    </div>
</div>
</div>
 <!-- jQuery
 Bootstrap JS  -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

 <!-- JavaScript  -->
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
            </div>
            </div>
</nav>
<div class="d-flex">
  <div class="col-xxl-2 col-lg-3 col-md-5 col-sm-7 col-9 sidebar-container d-xxl-block d-xl-block d-lg-none  d-none position-fixed"  id="dashVertical" style="z-index:10">
            <div class="bg-dark text-light vertical-bar col-12 border border-0 border-end" style="min-height:calc(100vh - 102px);margin-top:100px" data-bs-scroll="true" tabindex="-1" aria-labelledby="dashVerticalLabel">
            <div class="offcanvas-body pt-5">
    <div class="sidebar d-flex flex-column align-items-center">
        <ul class="verticle-menu list-unstyled fs-5 mt-5">
            <li class="list-item mt-3"><a href="dashboard.php?content=dashboard" class="nav-link active" data-menu-item-id="dashboard"><i class="fas fa-tachometer-alt"></i> &nbsp; Dashboard</a></li>
            <li class="list-item mt-3"><a href="dashboard.php?content=account" class="nav-link active" data-menu-item-id="account"><i class="fa-regular fa-address-card"></i> &nbsp; Account</a></li>
            <li class="list-item mt-3"><a href="dashboard.php?content=notification" class="nav-link active" data-menu-item-id="notification"><i class="fa-solid fa-bell"></i> &nbsp; Notification</a></li>
            <li class="list-item mt-3"><a href="dashboard.php?content=report" class="nav-link active" data-menu-item-id="report"><i class="fa-solid fa-file-alt"></i> &nbsp; Report</a></li>
            <li class="list-item mt-3"><a href="dashboard.php?content=create" class="nav-link active" data-menu-item-id="create"><i class="fa-solid fa-user"></i> &nbsp; User</a></li>
            <li class="list-item mt-3"><a href="dashboard.php?content=request" class="nav-link active" data-menu-item-id="search"><img src="/asset/image/svg/add-business.svg" style="height:30px;">&nbsp; Request</a></li>
            <li class="list-item mt-3"><a href="#" class="nav-link active" data-menu-item-id="setting"><i class="fa-solid fa-gear"></i> &nbsp; Setting</a></li>
            <li class="list-item mt-3"><a href="#" class="nav-link active" data-menu-item-id="logout" data-bs-target="#logoutModal" data-bs-toggle="modal"><i class="fa-solid fa-right-from-bracket"></i> &nbsp; Logout</a></li>
        </ul>
    </div>
</div>

</div>

</div>

              
            </div>
  </div>
  <div class="col offset-xxl-2 offset-xl-3 offset-0 d-flex flex-column vertical-bar p-1 menu-content" style="max-height:calc(100vh - 102px);margin-top:100px">
    
                        <?php
                        
                                if(isset($_GET['content'])){
                                    $url = $_GET['content'];
                                    // echo $url;
                                    switch($url){
                                        case "dashboard": include "content/content.php";
                                        break;

                                        case "request": include "business-request/business-request.php";
                                        break;

                                        case "create": include "user/user-data.php";
                                        break;

                                        case "account": include "account/account.php";
                                        break;

                                        case "report": include "report/blog-reports.php"; 
                                        break;

                                        case "notification":echo "<div class='p-3'>".fetchAndDisplayNotifications($GLOBALS['connect'])."</div>";
                                        break;
                                    }
                                } else{
                                    include "/connect2local/user/admin/dashboard/content/content.php";
                                }
                        ?>

</div>

          </div>
          
          
<script>
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
