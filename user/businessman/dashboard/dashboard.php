<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php include "/connect2local/asset/link/cdn-link.html";
    ?>
</head>
<body>
    <header>
        <nav class="navbar text-bg-dark py-4 border-bottom">
            <div class="container">
                <div class="home-icon fs-5">
                    <i class="fa-solid fa-bars d-none"></i>
                    <i class="fa-solid fa-house mx-3 "></i>

                </div>
            <div class="nav-menu fs-5 d-flex" style="gap:15px">
                <i class="fa-solid fa-bell"></i>
                <i class="fa-solid fa-user"></i>
                <i class="fa-solid fa-square-plus"></i>
            </div>
            </div>
        </nav>
        <div class="user-menu-container text-bg-dark col-xxl-3 col-xl-3 col-lg-4 col-md-5 d-flex flex-column align-items-center p-3" style="height:calc(100vh - 80px);">
            <div class="user-profile d-flex flex-column align-items-center">
                <img src="/asset/image/user/profile.png" alt="" style="height: 100px; width:100px;">
                <span class="user-name fs-3 fw-bold">Your Name</span>
                <a href="#" style="font-size:14px; text-decoration:none;">Edit Profile</a>
            </div>
            <div class="user-menu mt-3 d-flex align-items-center justify-content-center" style="width:100%">
                <ul class="list-unstyled ms-5 d-flex flex-column" style="gap:10px;">
                    <li class="nav-item">Dashboard</li>
                    <li class="nav-item">Account</li>
                    <li class="nav-item">Blog</li>
                    <li class="nav-item">Review & Rating</li>
                    <li class="nav-item">Report</li>
                    <li class="nav-item">Logout</li>
                </ul>
            </div>
        </div>
    </header>
</body>
</html>