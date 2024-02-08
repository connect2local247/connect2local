<?php
        session_start();

        include "../../../includes/table_query/db_connection.php";
        require "../../../includes/table_query/get_data_query.php";

        function check_exist_username($username){
            $query = "SELECT USERNAME FROM business_profile WHERE USERNAME = '$username'";
            $result = mysqli_query($GLOBALS['connect'],$query);

            if(mysqli_num_rows($result) > 0){
                echo "<script> alert('Username Already Exists. please Try Again');</script>";
                return false;
            }
            return true;
        }
        if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $id = $_SESSION['user_id'];
            $username_pattern = "/^[a-zA-Z0-9_.]{3,30}$/";
            if(preg_match($username_pattern,$username)){
                if(check_exist_username($username)){
                    $update_user_name_query = "UPDATE business_profile SET USERNAME = '$username' WHERE USER_ID = '$id'";
                    if(!mysqli_query($GLOBALS['connect'],$update_user_name_query)){
                        echo "<script> alert('Username not updated yet. please Try Again');</script>";
                    }
                }
            } else{
                    echo "<script> document.querySelector('.form-error').classList.remove('d-none');</script>";
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

    <style>
        @keyframes slideIn {
            from {
                transform: translateX(-100%);
            }
            to {
                transform: translateX(0);
            }
        }

        /* Add animation for sliding out */
        @keyframes slideOut {
            from {
                transform: translateX(0);
            }
            to {
                transform: translateX(-100%);
            }
        }
        @media  only screen and (max-width:1023px){
            #user-vertical-menu {
            animation-duration: 0.3s;
            animation-timing-function: ease-in-out;
            display: none; /* Initially hide the menu */
        }

        /* Apply slideIn animation when menu is shown */
        #user-vertical-menu.d-block {
            animation-name: slideIn;
            display: block; /* Make sure the menu is visible during the animation */
        }

        /* Apply slideOut animation when menu is hidden */
        #user-vertical-menu.d-none {
            animation-name: slideOut;
        }
        #user-vertical-menu {
            animation-duration: 0.3s;
            animation-timing-function: ease-in-out;
            display: none; /* Initially hide the menu */
        }

        /* Apply slideIn animation when menu is shown */
        #user-vertical-menu.d-block {
            animation-name: slideIn;
            display: block; /* Make sure the menu is visible during the animation */
        }

        /* Apply slideOut animation when menu is hidden */
        #user-vertical-menu.d-none {
            animation-name: slideOut;
        }
    
        }
        /* Apply the animation to the user menu */
        
    </style>
</head>
<body>

    <div class="modal fade alert alert-primary" id="setUserNamePromptModal" tabindex="-1" aria-labelledby="setUserNamePromptModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content ">
                    <div class="modal-header fw-bold fs-4 ">
                        Error
                    </div>
                    <div class="modal-body">
                        <!-- <form action="#" method="post" id="addLinkForm"> -->
                            <div class="mt-2 text-center alert alert-danger">
                                <!-- <div class="alert alert-danger d-none form-error" role="alert">
                                    Please enter a valid username. It must be 3 to 30 characters long and can contain letters, numbers, periods, and underscores.
                                </div>
                                <input type="text" class="form-control py-2" name="username" id="username" placeholder="Enter Username" required> -->
                                Please set your username to post blog
                            </div>
                    </div>
                    <div class="modal-footer d-flex border-top justify-content-end">
                            <a href="/user/businessman/dashboard/form/edit-profile.php" class="link text-dark fw-bold ">Edit</a>
                            <button class="btn" data-bs-dismiss="modal" data-bs-target="">Cancel</button>

                    </div>
                </div>
            </div>
        </div>   
    <header>
        <nav class="navbar text-bg-dark py-4 border-bottom">
            <div class="container">
                <div class="home-icon fs-5">
                    <i class="fa-solid fa-bars d-xxl-none d-xl-none d-lg-none d-inline" onclick="toggleUserMenu()"></i>
                    <i class="fa-solid fa-house mx-3 "></i>
                   
                </div>
            <div class="nav-menu fs-5 d-flex" style="gap:15px">
                <i class="fa-solid fa-bell"></i>
                <i class="fa-solid fa-user"></i>
                <?php 
                        if(get_username("business_profile",$_SESSION['business_id'],"USERNAME","B_ID") != NULL){
                ?>
                <i class="fa-solid fa-square-plus" onclick="location.href='/user/businessman/dashboard/form/add-blog.php'"></i>
                <?php

                        } else{

                
                ?>
                <i class="fa-solid fa-square-plus" data-bs-target="#setUserNamePromptModal" data-bs-toggle="modal"></i>
                <?php   
                        }
                ?>
            </div>
            </div>
        </nav>
        <div class="user-menu-container text-bg-dark col-xxl-2 col-xl-3 col-lg-4 col-md-4 col-sm-6 col-10 d-flex flex-column align-items-center p-3 d-xxl-block d-xl-block d-lg-block d-none position-absolute top-5" id="user-vertical-menu" style="height:calc(100vh - 80px);">
        <script>
    function toggleUserMenu() {
        var userMenu = document.getElementById("user-vertical-menu");
        userMenu.classList.toggle("d-none");
        userMenu.classList.toggle("d-block");
    }
</script>
            <div class="user-profile d-flex flex-column align-items-center">
                <img src="/asset/image/user/profile.png" alt="" style="height: 100px; width:100px;">
                <span class="user-name fs-3 fw-bold">Your Name</span>
                <a href="/user/businessman/dashboard/form/edit-profile.php" style="font-size:14px; text-decoration:none;">Edit Profile</a>
            </div>
            <div class="user-menu mt-3 d-flex align-items-center justify-content-center" style="width:100%">
                <ul class="list-unstyled ms-5 d-flex flex-column" style="gap:10px;">
                    <li class="nav-item">Dashboard</li>
                    <li class="nav-item">Account</li>
                    <li class="nav-item">Blog</li>
                    <li class="nav-item">Setting</li>
                    <li class="nav-item">Review & Rating</li>
                    <li class="nav-item">Report</li>
                    <li class="nav-item">Logout</li>
                </ul>
            </div>
        </div>
    </header>

    <section class="content-container border border-dark  offset-xxl-2 col-xxl-10" style="height:calc(100vh - 80px);">
            <div class="profile-container border">
                <div class="container border rounded-1 border-dark text-bg-dark p-2">
                        <div class="row">
                            <div class="col-lg-5 p-3 d-flex justify-content-center align-items-center flex-column col-12" style="gap:15px">
                                    <img src="/asset/image/user/profile.png" class="rounded-circle border p-1" style="height:200px;width:200px" alt="">
                                    <div class="social-link fs-4 d-flex" style="gap:15px">
                                        <a href="#" class="social-media-link text-white"><i class="fa-brands fa-instagram"></i></a>
                                        <a href="#" class="social-media-link text-white"><i class="fa-brands fa-facebook"></i></a>
                                        <a href="#" class="social-media-link text-white"><i class="fa-brands fa-linkedin"></i></a>
                                        <a href="#" class="social-media-link text-white"><i class="fa-brands fa-twitter"></i></a>
                                    </div>
                                    <button class="btn text-bg-primary bg-gradient shadow  px-3">Edit Profile</button>
                            </div>
                            <div class="col-7 d-flex flex-column justify-content-center" style="gap:20px">
                                    <div class="user-name fs-4 ms-1">
                                        Bhavesh_1724
                                    </div>
                                    <div class="user-profile-activity-info m-0">
                                        <ul class="list-unstyled d-flex fw-bold m-0" style="gap:10%">
                                            <li class="list-item d-flex flex-column justify-content-center text-center"><span class="blog-count">1</span> <span>Blog</span></li>
                                            <li class="list-item d-flex flex-column justify-content-center text-center"><span class="blog-count">1</span> <span>Follower</span></li>
                                            <li class="list-item d-flex flex-column justify-content-center text-center"><span class="blog-count">1</span> <span>Following</span></li>
                                        </ul>
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
                            </div>
                        </div>
                </div>
            </div>
    </section>
</body>
</html>