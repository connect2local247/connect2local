<?php
      session_start();

      include "../../../../includes/table_query/db_connection.php";
      include "../../../../includes/security_function/secure_function.php";

      $connect = $GLOBALS['connect'];
      $business_id = $_SESSION['business_id'];
$fetch_data_query = "SELECT business_info.BUSINESS_NAME, business_info.EMAIL, business_info.PHONE, business_info.OPERATE_TIME, business_register.B_PASSWORD, business_info.B_KEY
                     FROM business_info
                     INNER JOIN business_register ON business_info.B_ID = business_register.B_ID
                     WHERE business_info.B_ID = '$business_id'";
$result = mysqli_query($connect, $fetch_data_query);

if ($row = mysqli_fetch_assoc($result)) {
    $business_name = $row['BUSINESS_NAME'];
    $operate_time = $row['OPERATE_TIME'];
    $phone = $row['PHONE'];
    $email = $row['EMAIL'];
    $password = $row['B_PASSWORD'];
    $bKey = $row['B_KEY'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <?php include "../../../../asset/link/cdn-link.html"; ?>
</head>
<body class="p-3">
        <div class="container py-4 px-2 border shadow mt-4 rounded-2 col-xxl-6 col-xl-6 col-lg-7 col-md-10">
            <div class="heading text-center">
              <h1 class="h1 fw-bold">Account</h1>
              <form action="" class="px-3">
    <div class="mt-4">
        <div class="input-group position-relative">
            <input type="text" name="business-name" id="business-name" class="form-control border-0 border-bottom rounded-0 border-dark ps-5 z-1" placeholder="Business Name" value="<?php echo $business_name ?>" required>
            <span class="input-group-text border-0 position-absolute start-0 me-2 z-3"><i class="fa-solid fa-building"></i></span>
        </div>
    </div>
    <div class="mt-2">
        <div class="input-group position-relative">
            <input type="text" name="operate-time" id="operate-time" class="form-control border-0 border-bottom rounded-0 border-dark ps-5 z-1" placeholder="Operate Time" value="<?php echo $operate_time ?>" required>
            <span class="input-group-text border-0 position-absolute start-0 me-2 z-3"><i class="fa-solid fa-business-time"></i></span>
        </div>
    </div>
    <div class="mt-2">
        <div class="input-group position-relative">
            <input type="email" name="email" id="email" class="form-control border-0 border-bottom rounded-0 border-dark ps-5 z-1" placeholder="Email" value="<?php echo decryptData($email,$bKey) ?>" required>
            <span class="input-group-text border-0 position-absolute start-0 me-2 z-3"><i class="fa-solid fa-envelope"></i></span>
        </div>
    </div>
    <div class="mt-2">
        <div class="input-group position-relative">
            <input type="tel" name="phone" id="phone" class="form-control border-0 border-bottom rounded-0 border-dark ps-5 z-1" placeholder="Phone Number" value="<?php echo decryptData($phone,$bKey) ?>" required>
            <span class="input-group-text border-0 position-absolute start-0 me-2 z-3"><i class="fa-solid fa-phone"></i></span>
        </div>
    </div>
    <div class="mt-2">
        <div class="input-group position-relative">
            <input type="password" name="password" id="password" class="form-control border-0 border-bottom rounded-0 border-dark ps-5 z-1" placeholder="Password" value="<?php echo decryptData($password,$bKey) ?>" required>
            <span class="input-group-text border-0 position-absolute start-0 me-2 z-3"><i class="fa-solid fa-lock"></i></span>
        </div>
    </div>
    <div class="mt-4 d-flex justify-content-center">
        <input type="submit" name="submit" id="submit" class="btn btn-primary px-4 py-2" value="Update" required>
    </div>
</form>


            </div>
        </div>

        <?php
      }
        ?>
</body>
</html>