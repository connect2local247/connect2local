<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="/asset/css/style.css">
  <?php include "../../../asset/link/cdn-link.html"; ?>
</head>
<body>
      <header>
      <nav class="navbar text-bg-dark px-4 d-flex justify-content-between">
    <div class="container">
        <div class="home-icon d-flex align-items-center fs-4" style="gap:13px">
            <i class="fa-solid fa-bars"></i>
            <a href="/index.php" class="nav-link"><i class="fa-solid fa-house"></i></a>
        </div>
        <div class="user-info-container d-flex align-items-center " style="column-gap:10px">
            <?php
            $profile_img = "antivirus.jpg";
            if(isset($profile_img) || $profile_img != NULL || $profile_img != ""){
            ?>
            <img src="/database/data/user/antivirus.jpg" alt="user-image" style="height:40px;width:40px" class="rounded-circle">
            <?php
            } else{
                echo "";
            }
            ?>
            <span class="fw-semibold" style="font-size:1.2rem">Bhavesh Parmar</span>
        </div>
        <div class="menu-icon fs-4 d-flex align-items-center" style="gap:12px">
            <i class="fa-solid fa-bell"></i>
            <i class="fa-solid fa-square-plus"></i>
            <img src="/asset/image/svg/add-business.svg" alt="" class="" style="height:36px;width:36px">
        </div> 
    </div> 
</nav>

          </header>
          <section class="sidebar">
                    <div class="vertical-menu">
                                  
                    </div>                  
          </section>
</body>
</html>