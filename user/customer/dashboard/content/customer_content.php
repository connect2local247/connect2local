<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
 
      <?php include "../../../modules/search/search-business.php"; ?>
  
      <!-- <div class="container">
    <div class="row">
        <div class="col-12">
            <div class="business-profiles d-flex justify-content-center vertical-bar m-auto flex-nowrap overflow-x-scroll" style="max-width: 100%; gap: 15px;flex:0 0 auto">
                <?php
                $query = "SELECT business_name, bp_profile_img_url
                          FROM business_info AS bi
                          INNER JOIN business_profile AS bp ON bi.b_id = bp.b_id
                          WHERE bp.bp_profile_img_url IS NOT NULL AND bp.bp_profile_img_url != ''
                          ORDER BY RAND()";
                $result = mysqli_query($GLOBALS['connect'], $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='business-profile justify-m-auto' style='flex:0 0 auto'>";
                    echo "<img src='" . $row['bp_profile_img_url'] . "' class='img-fluid rounded-circle' style='height: 10vh; width: 10vh;' alt='Profile Image'>";
                    echo "<p class='mt-2 fw-semibold text-center'>" . $row['business_name'] . "</p>";
                    echo "</div>";   
                    echo "<div class='business-profile' style='flex:0 0 auto'>";
                    echo "<img src='" . $row['bp_profile_img_url'] . "' class='img-fluid rounded-circle' style='height: 10vh; width: 10vh;' alt='Profile Image'>";
                    echo "<p class='mt-2 fw-semibold text-center'>" . $row['business_name'] . "</p>";
                    echo "</div>"; 
                }
                ?>
            </div>
        </div>
    </div>
</div> -->

      </div>
      <!-- <div class="row justify-content-center align-items-center text-center vertical-bar" style="height: 300px; overflow: auto;">
      <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-5 col-6 gx-3 gy-2 p-2 border shadow rounded-pill">Advertising</div>
      <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-5 col-6 gx-3 gy-2 p-2 border shadow rounded-pill">Clothing</div>
      <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-5 col-6 gx-3 gy-2 p-2 border shadow rounded-pill">Construction</div>
      <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-5 col-6 gx-3 gy-2 p-2 border shadow rounded-pill">Automobile</div>
      <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-5 col-6 gx-3 gy-2 p-2 border shadow rounded-pill">Bicycle</div>
      <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-5 col-6 gx-3 gy-2 p-2 border shadow rounded-pill">Stationary</div>
      <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-5 col-6 gx-3 gy-2 p-2 border shadow rounded-pill">Electronics</div>
      <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-5 col-6 gx-3 gy-2 p-2 border shadow rounded-pill">Education</div>
      <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-5 col-6 gx-3 gy-2 p-2 border shadow rounded-pill">Environment</div>
      <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-5 col-6 gx-3 gy-2 p-2 border shadow rounded-pill">Fashion</div>
      <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-5 col-6 gx-3 gy-2 p-2 border shadow rounded-pill">Beauty Parlor</div>
      <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-5 col-6 gx-3 gy-2 p-2 border shadow rounded-pill">Legal Services</div>
      <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-5 col-6 gx-3 gy-2 p-2 border shadow rounded-pill">Gift Articles</div>
      <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-5 col-6 gx-3 gy-2 p-2 border shadow rounded-pill">Mobile And Computer</div>
      <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-5 col-6 gx-3 gy-2 p-2 border shadow rounded-pill">Restaurants</div>
      <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-5 col-6 gx-3 gy-2 p-2 border shadow rounded-pill">Delivery Services</div>
      <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-5 col-12 gx-3 gy-2 p-2 border shadow rounded-pill">Hospital And Medical Store</div>
      <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-5 col-6 gx-3 gy-2 p-2 border shadow rounded-pill">Others</div>
        </div> -->

</body>
</html>