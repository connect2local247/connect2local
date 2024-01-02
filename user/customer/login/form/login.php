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
<body>

                <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" style="background:linear-gradient(#040014,#0B1419)">
                        <div class="modal-body rounded" >
                        <div id="animation container" class="m-auto" style="height:50px;width:50px">
                            <script>
                                var animation = bodymovin.loadAnimation({
                                    container : document.getElementById('animation container'),
                                    loop:false,
                                    autoplay:true,
                                    rendor:'svg',
                                    path:"/asset/animation/success.json",
                                    name:"demo animation",
                                    background:"transparent"
                                })
                            </script>
                        </div>
                        <div id="greet-message" class="d-none text-center text-white"><?php if(isset($_SESSION['greet-message'])) echo $_SESSION['greet-message'];?></div>
                        </div>
                        </div>
                    </div>
                </div>

        
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
                                                    window.location.href='/user/customer/dashboard/dashboard.php';
                                                },3000);
                                            });
                                            </script>";
                                            
                                            unset($_SESSION['greet-message']);
                                            unset($_SESSION['error']);
                                        }
                                            
                            ?>




                        </div>
                    </div>
        <form action="/user/customer/login/code/login-validation.php" method="post" class="d-flex flex-column align-items-center justify-content-center p-2" style="height:90vh;width: 100%;">
            <fieldset class="p-3 border rounded col-lg-7 col-md-10 col-12 border-dark text-bg-dark bg-gradient">
                <legend class="my-4 fw-bold fs-2 text-center text-uppercase">Login</legend>
                <div class="mt-3">
                    <label for="email" class="form-label ps-1">Email</label>
                    <input type="email" name="email" class="form-control border border-dark py-2" id="email" placeholder="Email Address" value="<?php if(isset($_SESSION['email'])) echo $_SESSION['email'] ?>" required>
                </div>

                <div class="mt-3">
                    <label for="password" class="form-label ps-1">Password</label>
                    <div class="mt-1 position-relative">
                        <input type="password" name="password" id="password" class="form-control p-2 border-dark" placeholder="Password" required>
        <i id="togglePassword" class="fas fa-eye text-secondary position-absolute top-0 end-0 py-2 fs-5 mt-1 me-4"></i>
                    </div>

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

                <div class="mt-3 d-flex align-items-center justify-content-between px-2">
                    <a href="#" class="nav-link text-warning" style="font-size:15px">Create an Account</a>
                    <a href="/user/customer/login/form/verification-email.php" class="nav-link text-warning" style="font-size:15px">Forgot Password</a>
                 </div>

                 <div class="mt-5 d-flex justify-content-center">
                    <input type="submit" value="Login" name="submit" class="px-5 py-2 rounded text-bg-primary bg-gradient" style="border:grey; width:150px;height:45px;">
                 </div>
            </fieldset>
        </form>
    
    
</body>
</html>