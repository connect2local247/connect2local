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
<body>
<!-- ERROR MSG DIV -->
        <div class="my-4">
                    <?php
            if (isset($_SESSION['error'])) {
                $error = $_SESSION['error'];
                ?>
                <div class="errorMessage col-lg-3 border rounded fs-5 position-absolute end-0 top-0 m-2 text-center d-flex flex-column align-items-center text-white" id="error-message" style="height:180px;background-color:rgb(96, 92, 92)">
                    <div class="w-100 h-100 text-center position-relative" style="background:linear-gradient(#2F2462,#001520);">
                        <div class="text-bg-dark bg-gradient p-2 rounded" id="submit-btn">
                        <i class="fa-solid fa-xmark position-absolute end-0 mt-2 me-3" id="close-mark"></i>
                        <span>Error Message</span>
                        </div>
                        <div style="height:70%;display:flex;align-items:center;justify-content:center">
                            <p> <i class="fa-solid fa-xmark text-bg-danger p-2 rounded-circle"></i> <?php echo "$error"; ?></p>
                        </div>
                        <div class="position-absolute bottom-0 rounded" id="loading" style="background:linear-gradient(skyblue,royalblue,skyblue); width:100%; height:10px"></div>
                    </div>

<!-- ERROR MSG LOADING SCRIPT -->

                    <script>
            const loading = document.getElementById('loading');
            const errorMessage = document.getElementById('error-message');
            const closeErrorPrompt = document.getElementById('close-mark');
            
            closeErrorPrompt.addEventListener('click',function(){
                errorMessage.classList.add('hidden');             
            })
            const decreaseWidth = () => {
                loading.style.width = (parseFloat(loading.style.width) - 1) + "%";
                
                if (parseFloat(loading.style.width) <= 0) {
                    clearInterval(intervalId);

                    
                    // Unset the session variable directly in the same file
                    <?php unset($_SESSION['error']); ?>

                    // Apply smooth transition to hide the error message
                    errorMessage.classList.add('hidden');
                }
            };

            const intervalId = setInterval(decreaseWidth, 35);
        </script>
                </div>
                
                <?php
        } else if (isset($_SESSION['greet-message'])) {
        ?>
            <?php
                            
                                echo "
                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        var successModal = new bootstrap.Modal(document.getElementById('exampleModalToggle'));
                                        var animation = document.getElementById('animation container');
                                        var greetMessage = document.querySelector('#greet-message');
                                        let modalBody = document.querySelector('.modal-body');
                                        successModal.show();
                                        
                                        setTimeout(function () {
                                            // spinner.style.display = 'none';
                                            modalBody.removeChild(animation);
                                            greetMessage.classList.remove('d-none');
                                        }, 2500); // Close the modal after 3 seconds (3000 milliseconds)
                                        
                                        setTimeout(function(){
                                            window.location.href='/connect2local/user/customer/activities/register/form/contact-info.php';
                                        },3000);
                                    });
                                    </script>";
                                    
                                    unset($_SESSION['greet-message']);
                                    unset($_SESSION['error']);
                                }
                                    
                    ?>
                </div>
            </div>     

<!-- BUSINESS REGISTER FORM -->

        <form action="/user/businessman/register/code/data-validation.php" method="post" class="p-2 col-lg-9 col-md-10 col-12 d-flex align-items-center" style="width:100%;height:100vh;">
           
        <fieldset class="border p-3 border-dark bg-gradient rounded-2 col-lg-6 col-md-10 col-12 text-bg-dark bg-gradient" style="margin:auto;">
                    <legend class="text-center mb-5 mt-2 fs-2 fw-bold">Register Form</legend>

                    <div class="mt-5">
                            <div class="row">
                                <div class="col-6">
                                    <input type="text" name="fname" id="fname" class="form-control p-2 border-dark" placeholder="First Name" value="<?php if(isset($_SESSION['fname'])) echo $_SESSION['fname'];?>"  required>
                                </div>

                                <div class="col-6">
                                    <input type="text" name="lname" id="lname" class="form-control p-2 border-dark" placeholder="Last Name" value="<?php if(isset($_SESSION['lname'])) echo $_SESSION['lname'];?>" required>
                                </div>
                            </div>
                    </div>

                    <div class="mt-4">
                            <div class="row">
                                <div class="col-6">
                                    <input type="date" name="birth-date" id="birth-date" class="form-control p-2 border-dark" value="<?php if(isset($_SESSION['birth-date'])) echo $_SESSION['birth-date'];?>" required>
                                </div>

                                <div class="col-6">
                                    <select class="form-select border-dark p-2" name="gender" required>
                                        <option value="" disabled selected>Select gender</option>
                                        <option value="Male" <?php if (isset($_SESSION['gender']) && $_SESSION['gender'] === 'Male') echo 'selected'; ?>>Male</option>
                                        <option value="Female" <?php if (isset($_SESSION['gender']) && $_SESSION['gender'] === 'Female') echo 'selected'; ?>>Female</option>
                                        <option value="Other" <?php if (isset($_SESSION['gender']) && $_SESSION['gender'] === 'Other') echo 'selected'; ?>>Other</option>
                                    </select>
                                </div>
                            </div>
                    </div>
<!-- SHOP ADDRESS DIV -->
                    <div class="mt-4">
                            <div class="row">
                                <div class="col-6">
                                    <input type="text" name="address" id="address" class="form-control p-2 border-dark" placeholder="Shop Address" value="<?php if(isset($_SESSION['address'])) echo $_SESSION['address'];?>" required>
                                </div>
<!-- BUSINESS CATEGORY DIV -->
                                <div class="col-6">
                                        <select name="category" class="form-select" required>
                                        <option value="" disabled selected>Select Category</option>
                                <?php
                                $categories = array(
                                    'Advertising',
                                    'Clothing',
                                    'Construction',
                                    'Automobile',
                                    'Bicycle',
                                    'Stationary',
                                    'Electronics',
                                    'Education',
                                    'Environment',
                                    'Fashion',
                                    'Beauty Parlor',
                                    'Legal Services',
                                    'Gift Articles',
                                    'Mobile And Computer',
                                    'Restaurants',
                                    'Delivery Services',
                                    'Hospital And Medical Store',
                                    'Others'
                                );

                                foreach ($categories as $category) {
                                    echo '<option value="' . $category . '" ' . isSelected($category) . '>' . $category . '</option>';
                                }

                                function isSelected($category) {
                                    return (isset($_SESSION['category']) && $_SESSION['category'] === $category) ? 'selected' : '';
                                }
                                ?>
                            </select>

                                </div>
                            </div>
                        </div>

                    <div class="mt-4">
                            <div class="row">
                                <div class="col-6">
                                    <input type="tel" name="contact" id="contact" class="form-control p-2 border-dark" placeholder="Phone Number" value="<?php if(isset($_SESSION['contact'])) echo $_SESSION['contact'];?>" required>
                                </div>

                                <div class="col-6">
                                    <input type="email" name="email" id="email" class="form-control p-2 border-dark" placeholder="Email Address" value="<?php if(isset($_SESSION['email'])) echo $_SESSION['email'];?>" required>
                                    
                                    
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="mt-4">
                            <div class="row">
                                <div class="col-6 position-relative">
    <input type="password" name="password" id="password" class="form-control p-2 border-dark" placeholder="Password" value="<?php if(isset($_SESSION['password'])) echo $_SESSION['password'];?>" required>
    <i id="togglePassword" class="fas fa-eye text-secondary position-absolute top-0 end-0 py-2 fs-5 mt-1 me-4"></i>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Toggle password visibility
            $("#togglePassword").click(function() {
                var passwordField = $("#password");
                var fieldType = passwordField.attr("type");

                // Toggle between 'text' and 'password' types
                passwordField.attr("type", fieldType === "password" ? "text" : "password");

                // Toggle eye icon based on password visibility
                $(this).toggleClass("fa-eye fa-eye-slash");
            });
        });
    </script>
</div>


                                <div class="col-6">
                                    <input type="password" name="conf-password" id="conf-password" class="form-control p-2 border-dark" placeholder="Confirm Password" value="<?php if(isset($_SESSION['conf-password'])) echo $_SESSION['conf-password'];?>" required>
                                </div>
                            </div>
                    </div>

<!-- TERM AND CONDITIONS DIV -->

                    <div class="mt-3 d-flex align-items-center justify-content-between px-2">
                        <div class="radio-group d-flex align-items-center" style="gap:7px;height:50px">
                            <input type="checkbox" name="agree-terms" id="agree-terms" class="form-input-checkbox" required>
                            <label for="agree-terms" class="form-label"><a href="/local business/webpage/policy/term-condition.php" class="text-white nav-link">Term & Condition</a></label>
                        </div>
                            <a href="#" class="nav-link">Have an Account ?</a>                    
                    </div>

                    <div class="mt-3 d-flex justify-content-center">
                            <input type="submit" value="Register" name="submit" class="btn border text-white bg-primary bg-gradient py-3 px-5 fs-5 rounded-pill">
                    </div>
                </fieldset>
        </form>

        
</body>
</html>