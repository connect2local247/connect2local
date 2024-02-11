<?php
        session_start();
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

@media (max-width: 767.98px) {
    .sidebar-col {
        display: none;
    }
}

@media (min-width: 768px) {
    .offcanvas {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        width: 300px; /* Adjust width as needed */
        transition: transform 0.3s ease;
        transform: translateX(-100%);
        z-index: 1050;
    }

    .offcanvas.show {
        transform: translateX(0);
    }
}

    </style>

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-4 sidebar-col" >
            <div class="offcanvas offcanvas-start bg-dark text-light show" style="height:calc(100vh - 70px);margin-top:70px" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                <div class="offcanvas-body">
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
        <div class="col-*">
            <!-- Your main content here -->
        </div>
    </div>
</div>




</body>
</html>