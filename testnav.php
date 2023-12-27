<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include "./asset/link/cdn-link.html"; ?>
    <link rel="stylesheet" href="/asset/css/style.css">

    <style>

/* @media only screen and (max-width:1024px) {
    #nav-animation{
        width:35% !important;
        overflow-y: scroll !important;
    }
} */
    </style>
</head>
<body>
    <nav class="navbar bg-dark" style="z-index:1">
    <div class="container d-flex align-items-center ">
                <div class="brand-logo">    
                    <a href="index.php" class="nav-link"><img src="/asset/image/logo.png" alt="This is logo" height="90" width="100"></a>        
                </div>
                <!-- <div class="menu">   
                    <ul class="nav">
                        <li class="nav-item"><a href="#" class="nav-link text-white">Home</a></li>
                        <li class="nav-item"><a href="#" class="nav-link text-white">About</a></li>
                        <li class="nav-item"><a href="#" class="nav-link text-white">Service</a></li>
                        <li class="nav-item"><a href="#" class="nav-link text-white">Contact</a></li>
                        <li class="nav-item"><a href="#" class="nav-link text-white">Blog</a></li>
                        <li class="nav-item"><a href="#" class="nav-link text-white">Help</a></li>
                        <li class="nav-item"><a href="#" class="nav-link text-white">Term & Condition</a></li>
                        <li class="nav-item"><a href="#" class="nav-link text-white">Privacy Policy</a></li>
                    </ul>
                </div> -->

                <div class="menu-icon">
                    <i class="fa-solid fa-bars text-white fs-5"></i>
                </div>
                <!-- <div class="register">
                    <button class="btn text-bg-primary bg-gradient px-4 py-2 rounded-pill user-auth-btn" onclick="location.href='/component/choice.php'">Sign Up</button>
                    <button class="btn  text-bg-primary bg-gradient px-4 py-2 rounded-pill user-auth-btn">Login</button>
                </div> -->
            </div>
    </nav>

    <div class="col-lg-3 col-md-5 col-12 bg-dark position-fixed p-3" style="height:100vh;z-index:10;" id="nav-animation">
                <i class="fa-solid fa-xmark fs-5 position-absolute end-0 top-2 text-white px-4"></i>
                <div class="brand-logo d-flex justify-content-center">    
                    <a href="index.php" class="nav-link"><img src="/asset/image/logo.png" alt="This is logo" height="200" width="200"></a>        
                </div>

                <div class="register d-flex justify-content-center" style="gap:15px">
                    <button id="sign-up-btn" class="btn text-white border border-primary px-4 py-2 rounded-pill " onclick="location.href='/component/choice.php'" style="width:120px;height:45px">Sign Up</button>
                    <button id="login-btn" class="btn  border text-white border-danger px-4 py-2 rounded-pill " style="width:120px">Login</button>
                </div>
            <div class="menu d-flex justify-content-center  mt-5 ms-5">   
                    <ul class="list-unstyled d-flex flex-column" style="gap:15px;">
                        <li class="nav-item"><a href="#" class="nav-link text-white fs-5"><i class="fa-solid fa-house mx-1"></i> Home</a></li>
                        <li class="nav-item"><a href="#" class="nav-link text-white fs-5"><i class="fa-solid fa-address-card mx-1"></i> About</a></li>
                        <li class="nav-item"><a href="#" class="nav-link text-white fs-5"><i class="fas fa-cogs mx-1"></i> Service</a></li>
                        <li class="nav-item"><a href="#" class="nav-link text-white fs-5"><i class="fas fa-phone mx-1"></i> Contact</a></li>
                        <li class="nav-item"><a href="#" class="nav-link text-white fs-5"><i class="fas fa-pencil-alt mx-1"></i> Blog</a></li>
                        <li class="nav-item"><a href="#" class="nav-link text-white fs-5"><i class="fas fa-question-circle mx-1"></i> Help</a></li>
                        <li class="nav-item"><a href="#" class="nav-link text-white fs-5"><i class="fas fa-file-alt mx-1"></i> Term & Condition</a></li>
                        <li class="nav-item"><a href="#" class="nav-link text-white fs-5"><i class="fas fa-shield-alt mx-1"></i> Privacy Policy</a></li>
                    </ul>
                </div>
    </div>

</body>
</html>