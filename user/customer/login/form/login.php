<?php
        session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect2local - Login</title>
    <link rel="stylesheet" href="/asset/css/form.css">
    <?php include "/connect2local/asset/link/cdn-link.html"; ?>
</head>
<body id="form-body">

        <script>
            path = "/user/customer/dashboard/dashboard.php";
        </script>
        <?php 

                include "../../../../component/form-alert.php";
                unset($_SESSION['error']);
        ?>

        <form action="/user/customer/login/code/login-validation.php" method="post" class="d-flex flex-column align-items-center justify-content-center p-2" style="height:90vh;width: 100%;">
            <fieldset class="p-3 border rounded col-lg-7 col-md-10 col-12  text-white" id="register-form">
                <legend class="my-4 fw-bold fs-2 text-center text-uppercase">Login</legend>
                <div class="mt-3">
                    <label for="email" class="form-label ps-1">Email</label>
                    <input type="email" name="email" class="form-control border border-2 border-dark py-2" id="email" placeholder="Email Address" value="<?php if(isset($_SESSION['email'])) echo $_SESSION['email'] ?>" required>
                </div>

                <div class="mt-3">
                    <label for="password" class="form-label ps-1">Password</label>
                    <div class="mt-1 position-relative">
                        <input type="password" name="password" id="password" class="form-control py-2 border-2 border-dark" placeholder="Password" required>
        <i id="togglePassword" class="fas fa-eye text-secondary position-absolute top-0 end-0 py-2 fs-5 mt-1 me-4"></i>
                    </div>

                <script src="/asset/js/password-display-toggle.js"></script>
                </div>

                <div class="mt-3 d-flex align-items-center justify-content-between px-2">
                    <a href="/user/customer/register/form/customer_register.php" class="nav-link" style="font-size:15px;color:skyblue;">Create an Account</a>
                    <a href="/user/customer/login/form/verification-email.php" class="nav-link" style="font-size:15px;color:skyblue;">Forgot Password</a>
                 </div>

                 <div class="mt-5 d-flex justify-content-center">
                    <input type="submit" value="Login" name="submit" class="px-5 py-3 rounded-pill border text-white" id="register-btn" style="width:150px;">
                 </div>
            </fieldset>
        </form>
    
        <?php include "/connect2local/component/form-footer.php"; ?>
    
</body>
</html>