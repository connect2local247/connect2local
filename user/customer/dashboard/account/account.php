<?php
    // include "../../../includes/table_query/find_encrypt_data.php";

$connect = $GLOBALS['connect'];
$customer_id = $_SESSION['c_id'];
$fetch_customer_data_query = "SELECT customer_register.c_contact, customer_register.c_email, customer_register.c_password, customer_verification.c_key
                    FROM customer_register
                    INNER JOIN customer_verification ON customer_register.c_id = customer_verification.c_id
                    WHERE customer_register.c_id = '$customer_id'";

$result = mysqli_query($connect, $fetch_customer_data_query);
if ($row = mysqli_fetch_assoc($result)) {
  $phone = $row['c_contact'];
  $email = $row['c_email'];
  $password = $row['c_password'];
  $cKey = $row['c_key'];
}



// die($fetch_customer_data_query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <?php include "../../../asset/link/cdn-link.html"; ?>
    <link rel="stylesheet" href="/asset/css/form.css">
    <link rel="stylesheet" href="/asset/css/style.css">
</head>
<body class="p-3">
    <script>
                path = "/user/customer/dashboard/dashboard.php?content=account";
    </script>
    <div class="container py-4 px-2 border text-bg-light shadow mt-4 rounded-2 col-xxl-6 col-xl-6 col-lg-7 col-md-10">
        <div class="heading text-center">
            <h1 class="h1 fw-bold">Account</h1>
            <?php include "../../../component/form-alert.php";  ?>
            <form action="/user/customer/dashboard/account/update_account.php?key=<?php echo $cKey ?>&customer_id=<?php echo $customer_id ?>" method="POST" id="updateForm" class="px-3">
                
               

                
            <div class="mt-2">
    <div class="input-group position-relative">
        <input type="email" name="email" id="email" class="form-control border-0 border-bottom rounded-0 border-dark ps-5 z-1" placeholder="Email" value="<?php echo decryptData($email,$cKey) ?>" pattern="^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$" required >
        <span class="input-group-text border-0 position-absolute start-0 me-2 z-3"><i class="fa-solid fa-envelope"></i></span>
    </div>
</div>
<div class="mt-2">
    <div class="input-group position-relative">
        <input type="tel" name="phone" id="phone" class="form-control border-0 border-bottom rounded-0 border-dark ps-5 z-1" placeholder="Phone Number" value="<?php echo decryptData($phone,$cKey) ?>" pattern="^\d{10}$" required >
        <span class="input-group-text border-0 position-absolute start-0 me-2 z-3"><i class="fa-solid fa-phone"></i></span>
    </div>
</div>
<div class="mt-2">
    <div class="input-group position-relative">
        <input type="password" name="password" id="password" class="form-control border-0 border-bottom rounded-0 border-dark ps-5 z-1" placeholder="Password" value="<?php echo decryptData($password,$cKey) ?>" pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@#_$])[\w@#_$]{8,16}" required >
        <span class="input-group-text border-0 position-absolute start-0 me-2 z-3"><i class="fa-solid fa-lock"></i></span>
    </div>
</div>

<div class="mt-4 d-flex justify-content-center">
        <input type="submit" name="submit" id="submit" class="btn btn-primary px-4 py-2" value="Update">
    </div>
            </form>
        </div>
    </div>

    

</body>
</html>

