<?php 
        include "/connect2local/includes/table_query/db_connection.php";
        require "/connect2local/includes/table_query/get_encrypted_data.php";
        require "/connect2local/includes/security_function/secure_function.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Connect2Local - Reset Password</title>
    <?php include "/connect2local/asset/link/cdn-link.html"; ?>
</head>
<body>

<?php

        if(isset($_GET['verification_token'])){
            if($_GET['verification_token'] != ""){
               $verification_token = $_GET['verification_token'];
                $query = "SELECT C_VERIFY_TOKEN FROM customer_verification WHERE C_VERIFY_TOKEN = '$verification_token' ";
                

                $result = mysqli_query($GLOBALS['connect'],$query);

                // echo $query."<br>";
                // echo mysqli_num_rows($result);
                // die($result);
                $email = get_email_from_token($verification_token,"customer_verification","customer_register","C_VERIFY_TOKEN","C_KEY","C_ID");

               
                if(mysqli_num_rows($result) > 0){
                    // get_email_from_token($verification_token,$table_name,$register_table,$col_name_token,$key_col_name,$col_name_id)
?>

<form action="/user/customer/login/code/reset-password-logic.php" method="POST" class="d-flex flex-column align-items-center justify-content-center" style="height:100vh;width: 100%;">
           
        <div class="my-4">
        <?php
        if (isset($_SESSION['error'])) {
            $error = $_SESSION['error'];
            echo "<p id='error-message' class='text-bg-dark text-center p-2 rounded m-auto' style='line-height:30px'><i class='fa-solid fa-triangle-exclamation text-warning px-1 fs-5'></i> $error</p>";
        } else{  
            if(isset($_SESSION['greet-message'])){

        ?>
            <div class="modal" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-body text-bg-dark rounded">
            <div class="spinner-border text-primary d-flex m-auto" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div id="greet-message" class="d-none text-center"><i class="fa-solid fa-check text-white rounded-circle bg-gradient" style="padding:5px; background-color:royalblue"></i><?php if(isset($_SESSION['greet-message'])) echo $_SESSION['greet-message'];?></div>
            </div>
            </div>
        </div>
        </div>
            <?php
                        unset($_SESSION['greet-message']);
                        echo "
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                var successModal = new bootstrap.Modal(document.getElementById('exampleModalToggle'));
                                var spinner = document.querySelector('.spinner-border');
                                var greetMessage = document.querySelector('#greet-message');
                                let modalBody = document.querySelector('.modal-body');
                                successModal.show();
                        
                                setTimeout(function () {
                                    modalBody.removeChild(spinner);
                                    greetMessage.classList.remove('d-none');
                                }, 3000); // Close the modal after 3 seconds (3000 milliseconds)

                                setTimeout(function(){
                                    window.location.href='/connect2local/user/customer/activities/login/form/login.php';
                                },5000);
                            });
                        </script>
                        ";
                        
                        unset($_SESSION['error']);
                        }
                    }                    
            ?>
            </div>
            <fieldset class="p-4 border rounded position-relative col-lg-4 col-md-7 col-11 bg-dark border-dark" id="form-fieldset">
                <legend class="my-4 fw-bold fs-4 text-center text-white">Reset Password</legend>
                <div class="mt-3">
                    <input type="email" name="email" class="form-control py-2 border border-dark" id="email" value="<?php echo $email ?>" readonly>
                </div>

                <div class="mt-3">
                    <input type="password" name="password" id="password" class="form-control py-2 border border-dark" placeholder="New Password" value="<?php if(isset($_SESSION['password'])) echo $_SESSION['password'];?>" required>
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
            $_SESSION['error'] = "Something Went Wrong... Please Try Again";
        }
    }
} else{
    
?>



<?php

    }
?>

<div class="error">
    <h1><?php
        if(isset($_SESSION['error'])){
            echo $_SESSION['error'];
        }
    ?>
    </h1>
</div>

</body>
</html>