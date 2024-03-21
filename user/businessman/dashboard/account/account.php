<?php
$connect = $GLOBALS['connect'];
$business_id = $_SESSION['business_id'];
$fetch_data_query = "SELECT business_info.business_name,business_info.bi_category, business_info.bi_email, business_info.bi_contact, business_info.bi_operate_time, business_info.bi_address, business_register.b_password, business_info.b_key, business_info.bi_web_url, business_info.bi_ig_url, business_info.bi_fb_url, business_info.bi_twitter_url, business_info.bi_linkedin_url
                    FROM business_info
                    INNER JOIN business_register ON business_info.b_id = business_register.b_id
                    WHERE business_info.b_id = '$business_id'";
$result = mysqli_query($connect, $fetch_data_query);
// die($fetch_data_query);
if ($row = mysqli_fetch_assoc($result)) {
    $business_name = $row['business_name'];
    $operate_time = $row['bi_operate_time'];
    $category = $row['bi_category'];
    $phone = $row['bi_contact'];
    $email = $row['bi_email'];
    $password = $row['b_password'];
    $bKey = $row['b_key'];
    $web_url = $row['bi_web_url'];
    $address = $row['bi_address'];
    $insta_url = $row['bi_ig_url'];
    $fb_url = $row['bi_fb_url'];
    $twitter_url = $row['bi_twitter_url'];
    $linkedin_url = $row['bi_linkedin_url'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <?php include "../../../asset/link/cdn-link.html"; ?>
    <link rel="stylesheet" href="/asset/css/style.css">
    <link rel="stylesheet" href="/asset/css/form.css">
</head>
<body class="p-3">
   
    
    <div class="container py-4 px-2 border text-bg-light shadow mt-4 rounded-2 col-xxl-6 col-xl-6 col-lg-7 col-md-10">
        <div class="heading text-center">
            <h1 class="h1 fw-bold text-center">Account</h1>
            <form action="update_account.php" method="POST" id="updateForm" class="px-3">
                <div class="mt-4">
                    <div class="input-group position-relative">
                        <input type="text" name="business-name" id="business-name" class="form-control border-0 border-bottom rounded-0 border-dark ps-5 z-1" placeholder="Business Name" value="<?php echo $business_name ?>" required>
                        <span class="input-group-text border-0 position-absolute start-0 me-2 z-3"><i class="fa-solid fa-building"></i></span>
                    </div>
                </div>
               

                <div class="mt-2">
                    <div class="input-group position-relative">
                        <input type="text" name="operate-time" id="operate-time" class="form-control border-0 border-bottom rounded-0 border-dark ps-5 z-1" placeholder="Operate Time" value="<?php echo $operate_time ?>">
                        <span class="input-group-text border-0 position-absolute start-0 me-2 z-3"><i class="fa-solid fa-business-time"></i></span>
                    </div>
                </div>
                <div class="mt-2">
    <div class="input-group position-relative">
        <input type="email" name="email" id="email" class="form-control border-0 border-bottom rounded-0 border-dark ps-5 z-1" placeholder="Email" value="<?php echo decryptData($email,$bKey) ?>" pattern="^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$" required>
        <span class="input-group-text border-0 position-absolute start-0 me-2 z-3"><i class="fa-solid fa-envelope"></i></span>
        <button class="btn border-0 position-absolute end-0 text-info me-2 z-3" onclick="changeCredential('email',event)">Change</button>
    </div>
</div>
<div class="mt-2">
    <div class="input-group position-relative">
        <input type="tel" name="phone" id="phone" class="form-control border-0 border-bottom rounded-0 border-dark ps-5 z-1" placeholder="Phone Number" value="<?php echo decryptData($phone,$bKey) ?>" pattern="^\d{10}$" required>
        <span class="input-group-text border-0 position-absolute start-0 me-2 z-3"><i class="fa-solid fa-phone"></i></span>
        <button class="btn border-0 position-absolute end-0 text-info me-2 z-3" onclick="changeCredential('phone',event)">Change</button>
    </div>
</div>
                <div class="mt-2">
                    <div class="input-group position-relative">
                        <textarea name="address" id="address" class="form-control border-0 border-bottom rounded-0 border-dark ps-5 z-1" placeholder="Address" required><?php echo $address ?></textarea>
                        <span class="input-group-text border-0 position-absolute start-0 me-2 z-3"><i class="fa-solid fa-map-marker-alt"></i></span>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="input-group position-relative">
                        <input type="text" name="web-url" id="web-url" class="form-control border-0 border-bottom rounded-0 border-dark ps-5 z-1" placeholder="Web URL" value="<?php echo $web_url ?>">
                        <span class="input-group-text border-0 position-absolute start-0 me-2 z-3"><i class="fa-solid fa-link"></i></span>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="input-group position-relative">
                        <input type="text" name="insta-link" id="insta-link" class="form-control border-0 border-bottom rounded-0 border-dark ps-5 z-1" placeholder="Instagram Link" value="<?php echo $insta_url ?>">
                        <span class="input-group-text border-0 position-absolute start-0 me-2 z-3"><i class="fab fa-instagram"></i></span>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="input-group position-relative">
                        <input type="text" name="fb-link" id="fb-link" class="form-control border-0 border-bottom rounded-0 border-dark ps-5 z-1" placeholder="Facebook Link" value="<?php echo $fb_url ?>">
                        <span class="input-group-text border-0 position-absolute start-0 me-2 z-3"><i class="fab fa-facebook"></i></span>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="input-group position-relative">
                        <input type="text" name="twitter-link" id="twitter-link" class="form-control border-0 border-bottom rounded-0 border-dark ps-5 z-1" placeholder="Twitter Link" value="<?php echo $twitter_url ?>">
                        <span class="input-group-text border-0 position-absolute start-0 me-2 z-3"><i class="fab fa-twitter"></i></span>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="input-group position-relative">
                        <input type="text" name="linkedin-link" id="linkedin-link" class="form-control border-0 border-bottom rounded-0 border-dark ps-5 z-1" placeholder="LinkedIn Link" value="<?php echo $linkedin_url ?>">
                        <span class="input-group-text border-0 position-absolute start-0 me-2 z-3"><i class="fab fa-linkedin"></i></span>
                    </div>
                </div>
                <div class="mt-2">
    <div class="input-group position-relative">
        <input type="password" name="password" id="password" class="form-control border-0 border-bottom rounded-0 border-dark ps-5 z-1" placeholder="Password" value="<?php echo decryptData($password,$bKey) ?>" pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@#_$])[\w@#_$]{8,16}" required>
        <span class="input-group-text border-0 position-absolute start-0 me-2 z-3"><i class="fa-solid fa-lock"></i></span>
        <button class="btn border-0 position-absolute end-0 text-info me-2 z-3" onclick="changeCredential('password',event)">Change</button>
    </div>
</div>
<div class="mt-4 d-flex justify-content-center">
        <input type="submit" name="submit" id="submit" class="btn btn-primary px-4 py-2" value="Update">
    </div>
            </form>
        </div>
    </div>

    <div class="toast-container p-3" style="position: fixed; top: 50%; left: 55%; transform: translate(-50%, -50%); ">
    <div id="errorToast" class="toast border border-info text-bg-dark" style="width: 400px;min-height:150px" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-dark">
            <strong class="me-auto text-white">Error</strong>
            <i class="fa-solid fa-xmark text-light" data-bs-dismiss="toast" aria-label="Close"></i>
        </div>
        <div class="toast-body bg-dark text-white fs-5">
        
        </div>
    </div>
</div>
<script>
    function changeCredential(type, event) {
        // Prevent default form submission behavior
        event.preventDefault();

        var value = '';
        var inputField;
        var pattern;

        if (type === 'email') {
            inputField = document.getElementById('email');
            pattern = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
        } else if (type === 'phone') {
            inputField = document.getElementById('phone');
            pattern = /^\d{10}$/;
        } else if (type === 'password') {
            inputField = document.getElementById('password');
            pattern = /(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@#_$])[\w@#_$]{8,16}/;
        }

        value = inputField.value;

        // Validate input against pattern
        if (!pattern.test(value)) {
            alert('Invalid ' + type);
            return;
        }

        // Construct the redirect URL based on the type of change
        var redirectUrl = '/user/businessman/dashboard/account/update_credential.php?';

        if (type === 'email' || type === 'phone') {
            redirectUrl += 'business_id=<?php echo $business_id ?>&key=<?php echo $bKey ?>&' + type + '=' + encodeURIComponent(value);
        } else if (type === 'password') {
            redirectUrl += 'business_id=<?php echo $business_id ?>&key=<?php echo $bKey ?>&password=' + encodeURIComponent(value);
        }

        // Redirect to the specified URL
        window.location.href = redirectUrl;
    }
</script>


    <!-- <script>
$(document).ready(function() {
    $('#updateForm').submit(function(e) {
        e.preventDefault(); // Prevent default form submission

        // Serialize form data
        var formData = $(this).serialize();

        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: '/user/businessman/dashboard/account/update_account.php',
            data: formData,
            dataType: 'json', // Specify JSON data type for response parsing
            success: function(response) {
                // Check if response contains an error
                if (response.status === 'error') {
                    // Display error toast
                    $('#errorToast .toast-body').text(response.message);
                    $('#errorToast').toast('show');
                } else {
                    // No error, do something else if needed
                    // alert('Account data updated successfully!');
                }
            },
            error: function(xhr, status, error) {
                // Handle AJAX errors if any
                console.error(xhr.responseText);
            }
        });
    });
});
</script>
<script>
    function updateCredential(type, value) {
        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: '/user/businessman/dashboard/account/update_credential.php',
            data: { type: type, value: value },
            dataType: 'json', // Specify JSON data type for response parsing
            success: function(response) {
                if (response.status === 'success') {
                    // Display success message
                    alert(response.message);
                    console.log(response.message);
                    // Optionally, update UI or display a success message
                } else {
                    // Display error message on the UI
                    $('#errorToast .toast-body').text(response.message);
                    $('#errorToast').toast('show');
                }
            },
            error: function(xhr, status, error) {
                // Handle AJAX errors if any
                console.error(xhr.responseText);
            }
        });
    }
</script> -->
<script>
                path = "/user/customer/dashboard/dashboard.php?content=account";
    </script>
        <?php
                if(isset($_SESSION['error'])){
                    include "../../../component/form-alert.php"; 
                    unset($_SESSION['error']);
                }
        ?>
</body>
</html>
<?php
}
?>
