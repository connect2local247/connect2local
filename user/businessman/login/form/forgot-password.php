<?php 
        include "/connect2local/includes/table_query/db_connection.php";
        require "/connect2local/includes/code_generator/code_generator.php";
        require "/connect2local/includes/table_query/get_encrypted_data.php";
        require "/connect2local/includes/security_function/secure_function.php";

        session_start();

        ini_set('display_errors', 0);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Connect2Local - Reset Password</title>
    <link rel="stylesheet" href="/asset/css/style.css">
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
<?php

        } else if (isset($_SESSION['greet-message'])) {
                                    
            unset($_SESSION['greet-message']);
            unset($_SESSION['error']);
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
                        window.location.href='/user/customer/login/form/login.php';
                    },3000);
                });
                </script>";
                
            }
                
?>

        ?>
                </div>




                </div>
        </div>

<?php

        if(isset($_GET['verification_token'])){
            if($_GET['verification_token'] != "" ){
               $verification_token = $_GET['verification_token'];
               $query = "SELECT B_VERIFICATION_TOKEN FROM business_verification WHERE B_VERIFICATION_TOKEN = '$verification_token' ";
               
               $result = mysqli_query($GLOBALS['connect'],$query);
               
               $_SESSION['verification-token'] = $verification_token;
               $email = get_email_from_token($verification_token,"business_verification","business_register","B_VERIFICATION_TOKEN","B_KEY","B_ID");
               
               
               if(mysqli_num_rows($result) > 0){
                   
?>

<form action="/user/businessman/login/code/reset-password-logic.php" method="POST" class="d-flex flex-column align-items-center justify-content-center" style="height:100vh;width: 100%;">
           
            <fieldset class="p-4 border rounded position-relative col-lg-4 col-md-7 col-11 bg-dark border-dark" id="form-fieldset">
                <legend class="my-4 fw-bold fs-4 text-center text-white">Reset Password</legend>
                <div class="mt-3">
                    <input type="email" name="email" class="form-control py-2 border border-dark" id="email" value="<?php echo $email ?>" readonly>
                </div>

                <div class="mt-3 position-relative">
                        <input type="password" name="password" id="password" class="form-control p-2 border-dark" placeholder="Password" value="<?php if(isset($_SESSION['password'])) echo $_SESSION['password'];?>" required>
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

                <div class="mt-3">
                    <input type="password" name="conf-password" id="password" class="form-control py-2 border border-dark" placeholder="Confirm Password" value="<?php if(isset($_SESSION['conf-password'])) echo $_SESSION['conf-password']; ?>" required>
                </div>

                <div class="mt-3 d-flex align-items-center justify-content-center px-2">
                    <input type="submit" value="Save" name="submit" class="px-5 py-2 rounded text-bg-danger bg-gradient" style="border:grey; width:150px;height:45px;">
                 </div>
            </fieldset>
        </form>

<?php

        } else{
?>


<div class="error text-center d-flex align-items-center justify-content-center" style="height:90vh;width:100%">
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-body text-center">
            <h1 class="text-danger mb-4">Verification Error</h1>
            <p class="lead">Oops! Something went wrong while Verifying your email address.</p>
            <p>Please try again. If the issue persists, contact us for assistance.</p>

            <div class="mt-4 d-flex justify-content-center" style="gap:7px">
                <a href="verification-email.php" class="nav-link text-primary">Try Again</a> |
                <a href="mailto:connect2local247@gmail.com" class="nav-link text-primary">Contact Us</a>
            </div>

            <p class="mt-3">If you need further assistance, click <a href="help.php" class="text-primary">here</a>.</p>
        </div>
    </div>
</div>
</div>

<?php
        }
    }
} else{
            
?>

<?php

    }
?>



</body>
</html>