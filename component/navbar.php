<nav class="navbar position-fixed px-3">
                <div class="brand-logo">       
                    <a href="index.php" class="nav-link mx-3"><img src="/asset/image/logo.png" alt="This is logo" height="90" width="100"></a>        
                </div>
                <div class="menu d-xxl-block d-xl-none d-lg-none d-md-none d-none">   
                    <ul class="nav">
                        <li class="nav-item"><a href="/index.php" class="nav-link text-white">Home</a></li>
                        <li class="nav-item"><a href="/webpage/about/about.php" class="nav-link text-white">About</a></li>
                        <li class="nav-item"><a href="/webpage/services/service.php" class="nav-link text-white">Service</a></li>
                        <li class="nav-item"><a href="/webpage/contact/contact.php" class="nav-link text-white">Contact</a></li>
                        <li class="nav-item"><a href="/webpage/blog/user-blog.php" class="nav-link text-white">Blog</a></li>
                        <li class="nav-item"><a href="/webpage/help/help.php" class="nav-link text-white">Help</a></li>
                        <li class="nav-item"><a href="/webpage/policy/term-condition.php" class="nav-link text-white">Term & Condition</a></li>
                        <li class="nav-item"><a href="/webpage/policy/privacy-policy.php" class="nav-link text-white">Privacy Policy</a></li>
                    </ul>
                </div>

                <div class="register d-flex align-items-center" style="gap:7px">
                <?php

if(isset($_SESSION['registered'])) {
    // If the user is logged in, show the Logout button
    if(isset($_SESSION['profile-image'])):

        if(isset($_SESSION['c_id'])){
                    
            $user = 'customer';
            
         }
         else if(isset($_SESSION['bp_user_id'])){
             $user = "businessman";
           
         } else{
             if(isset($_SESSION['current_user'])){
                 $user = "admin";
             }
         }
    ?>
        <img src="<?php echo $_SESSION['profile-image']?>" style="height:45px;width:45px" class="rounded-circle mx-3" alt="user image" onclick="location.href='/user/<?php echo $user; ?>/dashboard/dashboard.php?content=dashboard'">
    <?php
    endif;
    echo '<button class="btn px-4 py-2 text-white user-auth-btn d-xxl-block d-xl-block d-lg-block d-md-block d-sm-none d-none" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</button>';
} else {
    // If the user is not logged in, show the Sign Up and Login buttons
    echo '<button class="btn px-4 py-2 text-white user-auth-btn d-xxl-block d-xl-block d-lg-block d-md-block d-sm-none d-none" onclick="location.href=\'/component/register-choice.php\'">Sign Up</button>';
    echo '<button class="btn px-4 py-2 text-white user-auth-btn d-xxl-block d-xl-block d-lg-block d-md-block d-sm-none d-none" onclick="location.href=\'/component/login-choice.php\'">Login</button>';
}
?>

                    <button class="btn text-white py-2 px-3 mx-4 d-xxl-block d-xl-block d-lg-block d-md-block d-sm-block d-none" onclick="location.href='/user/businessman/add_business/form/add-business-form.php'" id="add-new-btn"><i class="fa-solid fa-plus shadow border rounded-circle p-1 "></i> Add Business</button>
                    <div class="menu-bar-icon">
                                <i class="fa-solid fa-bars fs-4 text-white d-xxl-none d-xl-block d-lg-block d-md-block d-sm-block d-block" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"></i>
                    </div>
                </div>
               


            
<div class="offcanvas offcanvas-end bg-dark" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title text-white ps-3" id="offcanvasRightLabel">Menu</h5>
    <i class="fa-solid fa-xmark text-white" data-bs-dismiss="offcanvas" aria-label="Close" style="cursor:pointer"></i>
  </div>
  <div class="offcanvas-body">
      <div class="d-flex justify-content-center my-4 d-xxl-none d-xl-none d-lg-none d-md-none d-sm-none d-block">
  
      <div class="card card-bg">
          <div class="card-content border border-light rounded" >
              <div class="card-body">
                  <img src="/asset/image/svg/add-business.svg" class="rounded" style="height:120px;width:100%;" alt="">
              </div>
              <div class="card-footer border-top border-light" id="add-new-btn">
  
                  <button class="btn text-white py-2 px-3 mx-4 " onclick="location.href='/user/businessman/add_business/form/add-business-form.php'" >Add Business</button>
              </div>
          </div>
      </div>
      </div>
  <div class="register d-flex justify-content-center" style="gap:15px" >
  <?php
// Check if the user session is active
if(isset($_SESSION['registered'])) {
    // If active, display the logout button
    echo '<button class="btn text-white border border-light px-4 py-2 rounded-pill d-xxl-block d-xl-none d-lg-none d-md-none d-sm-block d-block user-auth-btn" onclick="location.href=\'/component/logout.php\'" style="width:120px;height:45px">Logout</button>';
} else {
    // If not active, display the sign-up and login buttons
    echo '<button class="btn text-white border border-light px-4 py-2 rounded-pill d-xxl-block d-xl-none d-lg-none d-md-none d-sm-block d-block user-auth-btn" onclick="location.href=\'/component/register-choice.php\'" style="width:120px;height:45px">Sign Up</button>';
    echo '<button class="btn text-white border border-light px-4 py-2 rounded-pill d-xxl-block d-xl-none d-lg-none d-md-none d-sm-block d-block user-auth-btn" onclick="location.href=\'/component/login-choice.php\'" style="width:120px">Login</button>';
}
?>

                </div>
                <div class="menu d-flex justify-content-center  mt-5 ms-5">   
                    <ul class="list-unstyled d-flex flex-column" style="gap:15px;">
                        <li class="nav-item"><a href="/index.php" class="nav-link text-white fs-5"><i class="fa-solid fa-house mx-1"></i> Home</a></li>
                        <li class="nav-item"><a href="/webpage/about/about.php" class="nav-link text-white fs-5"><i class="fa-solid fa-address-card mx-1"></i> About</a></li>
                        <li class="nav-item"><a href="/webpage/services/service.php" class="nav-link text-white fs-5"><i class="fas fa-cogs mx-1"></i> Service</a></li>
                        <li class="nav-item"><a href="/webpage/contact/contact.php" class="nav-link text-white fs-5"><i class="fas fa-phone mx-1"></i> Contact</a></li>
                        <li class="nav-item"><a href="/webpage/blog/user-blog.php" class="nav-link text-white fs-5"><i class="fas fa-pencil-alt mx-1"></i> Blog</a></li>
                        <li class="nav-item"><a href="/webpage/help/help.php" class="nav-link text-white fs-5"><i class="fas fa-question-circle mx-1"></i> Help</a></li>
                        <li class="nav-item"><a href="/webpage/policy/term-condition.php" class="nav-link text-white fs-5"><i class="fas fa-file-alt mx-1"></i> Term & Condition</a></li>
                        <li class="nav-item"><a href="/webpage/policy/privacy-policy.php" class="nav-link text-white fs-5"><i class="fas fa-shield-alt mx-1"></i> Privacy Policy</a></li>
                    </ul>
                </div>            
  </div>
</div>
</nav> 
