<?php
        session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/asset/css/style.css">

    <?php  include "/connect2local/asset/link/cdn-link.html"; ?>
</head>
<body class="d-flex justify-content-center align-items-center" style="height:100vh;width:100%">
    
            <div class="row justify-content-center rounded">
                      <div class="col-lg-6 col-md-6 col-8 g-3">
                        <div class="card col-12">
                            <div class="card-content border border-dark border-bottom-0 rounded" onclick="location.href='/user/customer/register/form/customer_register.php'">
                                <div class="card-body">
                                        <img src="/asset/image/user/customer.png" style="height:200px;width:100%" alt="">
                                </div>
                                <div class="card-footer border border-dark border-top border-start-0 border-end-0 text-center ">
                                        <a href="/user/customer/register/form/customer_register.php" class="nav-link fw-bold fs-5">Customer</a>
                                </div>
                            </div>
                        </div>
                      </div>  

                      <div class="col-lg-6 col-md-6 col-8 g-3">
                        <div class="card col-12">
                            <div class="card-content border border-dark border-bottom-0 rounded" onclick="location.href='/user/businessman/register/form/business_register.php'">
                                <div class="card-body">
                                        <img src="/asset/image/user/businessman.png" style="height:200px;width:100%" alt="">
                                </div>
                                <div class="card-footer border border-dark border-top border-start-0 border-end-0 text-center ">
                                        <a href="/user/businessman/register/form/business_register.php" class="nav-link fw-bold fs-5">Business</a>
                                </div>
                            </div>
                        </div>
                      </div> 
            </div>
</body>
</html>