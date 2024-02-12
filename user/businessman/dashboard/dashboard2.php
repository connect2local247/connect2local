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
    <link rel="stylesheet" href="/asset/css/style.css">
    <?php include "../../../asset/link/cdn-link.html"; ?>
    <style>
    /* Add animation for slide left */
    @keyframes slideLeft {
        from {
            transform: translateX(-100%);
        }
        to {
            transform: translateX(0);
        }
    }

    .sidebar {
        color: #fff;
        animation: slideLeft 0.5s; /* Apply animation */
        z-index: 1050;
    }
</style>

</head>
<body>
    <nav class="navbar bg-dark" style="height:70px">
    <div class="container">
        <div class="home-icon text-white fs-4 ">
            <i class="fa-solid fa-bars mx-1 d-xxl-none d-xl-none d-inline"></i>
            <i class="fa-solid fa-house"></i>
        </div>
        <div class="user-profile d-flex align-items-center">
            <img src="/asset/image/user/profile.png" style="height:40px;width:40px;" class="mx-1" alt="">
            <span class="text-white fw-semibold">Bhavesh Parmar</span>
        </div>
        <div class="add-business-icon">
            <img src="/asset/image/svg/add-business.svg" style="height:40px;width:40px" alt="">
        </div>
    </div>
    </nav>
   
    <div class="d-flex">
        <div class="col-xxl-2 col-lg-3 col-md-5 col-sm-7 col-9 sidebar-container d-xxl-block d-xl-block d-none" >
            <div class="bg-dark text-light" style="min-height:100vh;position:relative;top:100px" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                <div class="offcanvas-body pt-5">
                    <div class="sidebar d-flex flex-column align-items-center">
                        <div class="profile-container">
                            <div class="profile-image">
                                <img src="/asset/image/user/profile.png" style="height:100px;width:100px;" class="rounded-circle " alt="">
                                <a href="#" class="nav-link text-warning d-block text-center mt-1">Edit Profile</a>
                            </div>
                        </div>
                        <ul class="verticle-menu list-unstyled fs-5 mt-5">
                            <li class="list-item mt-3"><a href="#" class="nav-link"><i class="fas fa-tachometer-alt"></i> &nbsp; Dashboard</a></li>
                            <li class="list-item mt-3"><a href="#" class="nav-link"><i class="fa-regular fa-address-card"></i> &nbsp; Account</a></li>
                            <li class="list-item mt-3"><a href="#" class="nav-link"><i class="fa-solid fa-bell"></i> &nbsp; Notification</a></li>
                            <li class="list-item mt-3"><a href="#" class="nav-link"><i class="fa-solid fa-camera-retro"></i> &nbsp; Blog</a></li>
                            <li class="list-item mt-3"><a href="#" class="nav-link"><i class="fa-regular fa-square-plus"></i> &nbsp; Create</a></li>
                            <li class="list-item mt-3"><a href="#" class="nav-link"><i class="fa-solid fa-magnifying-glass"></i> &nbsp; Search</a></li>
                            <li class="list-item mt-3"><a href="#" class="nav-link"><i class="fa-solid fa-gear"></i> &nbsp; Setting</a></li>
                            <li class="list-item mt-3"><a href="#" class="nav-link"><i class="fa-solid fa-right-from-bracket"></i> &nbsp; Logout</a></li>
                        </ul>
                    </div>
                </div>
              
            </div>
        </div>
        <div class="col-* text-bg-dark">
                <div class="content-container p-1 border border-danger" style="width:calc(100vw - 334px);position:relative;top:100px">
                    <?php include "profile/profile.php"; fetch_profile($_SESSION['user_id']);?>
                </div>
        </div>
    </div>


<script>
    bars = document.querySelector(".fa-bars");
    sidebarContainer = document.querySelector(".sidebar-container")

bars.addEventListener("click", function(){
    sidebarContainer.classList.toggle("d-none")
})
    
</script>

</body>
</html>