<?php
        session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect2Local - User Verification</title>
    <link rel="stylesheet" href="/asset/css/form.css">
    <?php include "/connect2local/asset/link/cdn-link.html"; ?>
</head>
<body id="form-body" style="height:100vh;width:100%">
    

        
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

        }

        ?>
                </div>




                </div>
        </div>
        <form action="/user/businessman/login/code/email_verification_check.php" method="POST" class="d-flex flex-column justify-content-center align-items-center p-2" style="height:90vh;width:100%;">
            <div class="mb-1">
                <?php
                        if(isset($_SESSION['message'])){

                ?>
                <p id="message" class="border shadow rounded bg-white border-secondary p-3 fs-5"><i class="fa-solid fa-envelope text-warning px-2 fs-5"></i><?php echo $_SESSION['message'];}?></p>

                <script>
        var message = document.getElementById('message');

        setTimeout(() => {
            // Apply fade-out effect
            message.style.transition = "opacity 1.5s linear";
            message.style.opacity = "0";

            // Hide the element after the animation completes
            setTimeout(() => {
                message.classList.add("d-none");
            }, 1500);

            // Unset the session message
            <?php unset($_SESSION['message']); ?>
        }, 4000);
    </script>
    
            </div>
            <fieldset class="border border-dark p-4 rounded-2 bg-dark bg-gradient col-lg-5 col-md-9 col-12">
                <legend class="text-center fs-3 fw-bold my-4 text-white">User Verification</legend>
                <div class="mt-2">
                    <input type="email" name="email" class="form-control py-2 border border-dark" placeholder="Enter Email Address" id="email" required>
                </div>
                <div class="mt-2 d-flex justify-content-end px-2">
                    <?php
                                if(isset($_SESSION['verification-email']) && $_SESSION['verification-email'] != ""){
                                    $email = $_SESSION['verification-email'];
                                    ?>
                    <a href="/user/businessman/login/code/resend-link.php?resend_link=1&email=<?php echo $email; ?>" class="nav-link text-white">Resend Link</a>
                    
                    <?php
                                }
                    ?>
                </div>
                <div class="mt-4 d-flex justify-content-center">
                    <input type="submit" name="submit" value="Submit" id="submit-btn" class="btn text-bg-primary bg-gradient py-2 px-5 rounded-pill" >
                </div>
            </fieldset>
        </form>

</body>
</html>