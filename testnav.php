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

 <!-- Menubar -->

                <!-- <div class="menu-icon">
                    <i class="fa-solid fa-bars text-white fs-5" id="menu-btn"></i>
                    <script>
                        menuButton=document.getElementById("menu-btn")
                        menuButton.addEventListener("click" , function(){
                            
                        })
                    </script>
                </div> -->
                <!-- <div class="register">
                    <button class="btn text-bg-primary bg-gradient px-4 py-2 rounded-pill user-auth-btn" onclick="location.href='/component/choice.php'">Sign Up</button>
                    <button class="btn  text-bg-primary bg-gradient px-4 py-2 rounded-pill user-auth-btn">Login</button>
                </div> -->
            </div>
            <i class="text-white px-5 fa-solid fa-bars" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"></i>

<div class="offcanvas offcanvas-end bg-dark" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Offcanvas right</h5>
    <i class="fa-solid fa-xmark text-white" data-bs-dismiss="offcanvas" aria-label="Close" style="cursor:pointer"></i>
  </div>
  <div class="offcanvas-body">
  <div class="register d-flex justify-content-center" style="gap:15px" >
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
</div>
    </nav>

    <!-- <div class="col-lg-3 col-md-5 col-12 bg-dark position-fixed p-3 d-flex flex-column align-items-center justify-content-center" style="height:100vh;z-index:10;" id="nav-animation">
                <i class="fa-solid fa-xmark fs-5 position-absolute start-0 top-0 mt-4 ps-3 text-white px-4"></i>
                <div class="brand-logo d-flex justify-content-center">    
                    <a href="index.php" class="nav-link"><img src="/asset/image/logo.png" alt="This is logo" height="200" width="200"></a>        
                </div> -->

                <!-- <div class="register d-flex justify-content-center" style="gap:15px">
                    <button id="sign-up-btn" class="btn text-white border border-primary px-4 py-2 rounded-pill " onclick="location.href='/component/choice.php'" style="width:120px;height:45px">Sign Up</button>
                    <button id="login-btn" class="btn  border text-white border-danger px-4 py-2 rounded-pill " style="width:120px">Login</button>
                </div> -->
             <!-- <div class="menu d-flex justify-content-center  mt-5 ms-5">   
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
    </div> --> 
<?php

$address_pattern = '/^([A-Za-z0-9\s-]+),\s*([A-Za-z0-9\s-]+)$/';

$example_address = "Soni solution, A-24 Dhaval Plaza";

if (preg_match($address_pattern, $example_address, $matches)) {
    $shopName = $matches[1];
    $blockAndStreet = $matches[2];

    // Now you can use these variables as needed
    echo "Shop Name: $shopName\n";
    echo "Block and Street: $blockAndStreet\n";
} else {
    echo "Address does not match the expected format.";
}
?>



</body>
</html>