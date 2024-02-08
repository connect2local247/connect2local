<?php

        session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include "../../../../asset/link/cdn-link.html";?>
    <link rel="stylesheet" href="/asset/css/form.css">
</head>
<body id="form-body">
<script>
            path = "/user/customer/register/form/email_verification.php";
        </script>
        <?php 

                include "../../../../component/form-alert.php";
                unset($_SESSION['error']);
        ?>
                
        <form action="/user/customer/register/code/data-validation.php" method="post" class="p-2 col-lg-9 col-md-10 col-12 d-flex align-items-center" style="width:100%;height:100vh;">
           
        <fieldset class="border p-3 text-white rounded-2 col-lg-6 col-md-10 col-12 border-light" id="register-form" style="margin:auto;">
                    <legend class="text-center mb-5 mt-2 fs-2 fw-bold">Register Form</legend>

                    <div class="mt-5">
                            <div class="row">
                                <div class="col-6">
                                    <input type="text" name="fname" id="fname" class="form-control p-2 border-dark border-2" placeholder="First Name" value="<?php if(isset($_SESSION['fname'])) echo $_SESSION['fname'];?>"  required>
                                </div>

                                <div class="col-6">
                                    <input type="text" name="lname" id="lname" class="form-control p-2 border-dark border-2" placeholder="Last Name" value="<?php if(isset($_SESSION['lname'])) echo $_SESSION['lname'];?>" required>
                                </div>
                            </div>
                    </div>

                    <div class="mt-4">
                            <div class="row">
                                <div class="col-6">
                                    <input type="date" name="birth-date" id="birth-date" class="form-control p-2 border-dark border-2" value="<?php if(isset($_SESSION['birth-date'])) echo $_SESSION['birth-date'];?>" required>
                                </div>

                                <div class="col-6">
                                    <select class="form-select border-dark border-2 p-2" name="gender" required>
                                        <option value="" disabled selected>Select gender</option>
                                        <option value="Male" <?php if (isset($_SESSION['gender']) && $_SESSION['gender'] === 'Male') echo 'selected'; ?>>Male</option>
                                        <option value="Female" <?php if (isset($_SESSION['gender']) && $_SESSION['gender'] === 'Female') echo 'selected'; ?>>Female</option>
                                        <option value="Other" <?php if (isset($_SESSION['gender']) && $_SESSION['gender'] === 'Other') echo 'selected'; ?>>Other</option>
                                    </select>
                                </div>
                            </div>
                    </div>

                    <div class="mt-4">
                            <div class="row">
                                <div class="col-6">
                                    <input type="tel" name="contact" id="contact" class="form-control p-2 border-dark border-2" placeholder="Phone Number" value="<?php if(isset($_SESSION['contact'])) echo $_SESSION['contact'];?>" required>
                                </div>

                                <div class="col-6">
                                    <input type="email" name="email" id="email" class="form-control p-2 border-dark border-2" placeholder="Email Address" value="<?php if(isset($_SESSION['email'])) echo $_SESSION['email'];?>" required>            
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="mt-4">
                            <div class="row">
                                <div class="col-6 position-relative">
    <input type="password" name="password" id="password" class="form-control p-2 border-dark border-2" placeholder="Password" value="<?php if(isset($_SESSION['password'])) echo $_SESSION['password'];?>" required>
    <i id="togglePassword" class="fas fa-eye text-secondary position-absolute top-0 end-0 py-2 fs-5 mt-1 me-4"></i>

    <script src="/asset/js/password-display-toggle.js"></script>
</div>


                                <div class="col-6">
                                    <input type="password" name="conf-password" id="conf-password" class="form-control p-2 border-dark border-2" placeholder="Confirm Password" value="<?php if(isset($_SESSION['conf-password'])) echo $_SESSION['conf-password'];?>" required>
                                </div>
                            </div>
                    </div>

                    <div class="mt-3 d-flex align-items-center justify-content-between px-2">
                        <div class="radio-group d-flex align-items-center" style="gap:7px;height:50px">
                            <input type="checkbox" name="agree-terms" id="agree-terms" class="form-input-checkbox" required>
                            <label for="agree-terms" class="form-label"><a href="/local business/webpage/policy/term-condition.php" class="text-white nav-link">Term & Condition</a></label>
                        </div>
                            <a href="/user/customer/login/form/login.php" class="nav-link">Have an Account ?</a>                    
                    </div>

                    <div class="mt-3 d-flex justify-content-center">
                            <input type="submit" value="Register" name="submit" class="btn border text-white bg-primary bg-gradient py-3 px-5 fs-5 rounded-pill" id="register-btn">
                    </div>
                </fieldset>
        </form>

        <?php include "/connect2local/component/form-footer.php"; ?>
</body>
</html>