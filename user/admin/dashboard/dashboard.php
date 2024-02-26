<?php
    session_start();
    include "../../../includes/table_query/db_connection.php";
    include "../../../includes/security_function/secure_function.php";
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

  </style>
  
</head>
<body class="vertical-bar text-bg-dark">
<nav class="navbar text-bg-dark py-4 border-bottom">
            <div class="container">
                <div class="home-icon fs-5">
                    <i class="fa-solid fa-bars d-xxl-none d-xl-none d-lg-none d-inline" onclick="toggleOffcanvas()"></i>
                    <i class="fa-solid fa-house mx-3 " onclick="location.href='/index.php'"></i>
                   
                </div>
                <div class="username fs-3 fw-semibold">
                    Admin
                </div>
            <div class="nav-menu fs-5 d-flex align-items-center" style="gap:15px">
                <i class="fa-solid fa-bell fs-4 position-relative"><span class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-danger" style="padding:5px"><span class="visually-hidden">unread messages</span></span></i>
                <img src="/asset/image/user/profile.png" alt="" class="admin-img" class="rounded-circle" style="height:30px;">
                
            </div>
            </div>
</nav>
<div class="d-flex">
  <div class="col-xxl-2 col-lg-3 col-md-5 col-sm-7 col-9 sidebar-container d-xxl-block d-xl-block d-lg-none  d-none position-fixed" >
            <div class="bg-dark text-light vertical-bar col-12" style="min-height:calc(100vh - 102px);margin-top:100px" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
            <div class="offcanvas-body pt-5">
    <div class="sidebar d-flex flex-column align-items-center">
        <ul class="verticle-menu list-unstyled fs-5 mt-5">
            <li class="list-item mt-3"><a href="dashboard.php?content=dashboard" class="nav-link" data-menu-item-id="dashboard"><i class="fas fa-tachometer-alt"></i> &nbsp; Dashboard</a></li>
            <li class="list-item mt-3"><a href="dashboard.php?content=account" class="nav-link" data-menu-item-id="account"><i class="fa-regular fa-address-card"></i> &nbsp; Account</a></li>
            <li class="list-item mt-3"><a href="#" class="nav-link" data-menu-item-id="notification"><i class="fa-solid fa-bell"></i> &nbsp; Notification</a></li>
            <li class="list-item mt-3"><a href="#" class="nav-link" data-menu-item-id="report"><i class="fa-solid fa-file-alt"></i> &nbsp; Report</a></li>
            <li class="list-item mt-3"><a href="dashboard.php?content=create" class="nav-link" data-menu-item-id="create"><i class="fa-solid fa-user"></i> &nbsp; User</a></li>
            <li class="list-item mt-3"><a href="#" class="nav-link" data-menu-item-id="search"><img src="/asset/image/svg/add-business.svg" style="height:30px;">&nbsp; Request</a></li>
            <li class="list-item mt-3"><a href="#" class="nav-link" data-menu-item-id="setting"><i class="fa-solid fa-gear"></i> &nbsp; Setting</a></li>
            <li class="list-item mt-3"><a href="#" class="nav-link" data-menu-item-id="logout"><i class="fa-solid fa-right-from-bracket"></i> &nbsp; Logout</a></li>
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
                                    switch($url){
                                        case "dashboard": include "content/content.php";
                                        break;

                                        case "account": include "account/account.php";
                                        break;

                                        case "create": include "user/user-data.php";
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
  function toggleOffcanvas() {
    var offcanvas = document.getElementById('offcanvasWithBothOptions');
    offcanvas.classList.toggle('show');
  }
</script>


</body>
</html>
