<?php
        function getTotalUsers($conn) {
          // Initialize total count
          $totalCount = 0;
      
          // Query to count total customers
          $customerQuery = "SELECT COUNT(*) AS total_customers FROM customer_register";
          $customerResult = mysqli_query($conn, $customerQuery);
          if ($customerResult && mysqli_num_rows($customerResult) > 0) {
              $customerRow = mysqli_fetch_assoc($customerResult);
              $totalCount += (int)$customerRow['total_customers'];
          }
      
          // Query to count total businesses
          $businessQuery = "SELECT COUNT(*) AS total_businesses FROM business_register";
          $businessResult = mysqli_query($conn, $businessQuery);
          if ($businessResult && mysqli_num_rows($businessResult) > 0) {
              $businessRow = mysqli_fetch_assoc($businessResult);
              $totalCount += (int)$businessRow['total_businesses'];
          }
      
          // Return total count
          return $totalCount;
      }
      
      function getTotalRequests($conn) {
        // Query to count total requests
        $query = "SELECT COUNT(*) AS total_requests FROM business_add_status";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return (int)$row['total_requests'];
        } else {
            return 0;
        }
    }

    function getTotalReports($conn) {
      // Query to count total reports
      $query = "SELECT COUNT(*) AS total_reports FROM blog_report";
      $result = mysqli_query($conn, $query);
      if ($result && mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          return (int)$row['total_reports'];
      } else {
          return 0;
      }
  }
  
  function countBusinesses($conn) {
    // Query to count businesses
    $query = "SELECT COUNT(*) AS total_businesses FROM business_info WHERE business_code IS NOT NULL";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return (int)$row['total_businesses'];
    } else {
        return 0;
    }
}

function countDistinctCategories($conn) {
  // Query to count distinct categories
  $query = "SELECT COUNT(DISTINCT bi_category) AS total_categories FROM business_info";

  // Execute the query
  $result = mysqli_query($conn, $query);

  // Check if query was successful
  if ($result) {
      // Fetch the result row
      $row = mysqli_fetch_assoc($result);
      // Return the total count of categories
      return $row['total_categories'];
  } else {
      // Return an error message if the query fails
      return "Error: " . mysqli_error($conn);
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    .card-user {
      background: linear-gradient(135deg, #f6d365, #fda085);
    }

    .card-request {
      background: linear-gradient(135deg, #a8c0ff, #3f2b96);
    }

    .card-report {
      background: linear-gradient(135deg, #f093fb, #f5576c);
    }

    .card-business {
      background: linear-gradient(135deg, #08aeea, #2af598);
    }

    .card-category {
      background: linear-gradient(135deg, #ffdde1, #ee9ca7);
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-10 g-4">
        <div class="card card-user text-white" style="height:200px">
          <div class="card-body d-flex align-items-center justify-content-center flex-column fs-3">
            <p class="card-text"><?php echo getTotalUsers($GLOBALS['connect']) ?></p>
            <h5 class="card-title h3 fw-semibold">User</h5>
          </div>
        </div>
      </div>
      <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-10 g-4">
        <div class="card card-request text-white" style="height:200px">
          <div class="card-body d-flex align-items-center justify-content-center flex-column fs-3">
            <p class="card-text"><?php echo getTotalRequests($GLOBALS['connect']); ?></p>
            <h5 class="card-title h3 fw-semibold">Request</h5>
          </div>
        </div>
      </div>
      <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-10 g-4">
        <div class="card card-report text-white" style="height:200px">
          <div class="card-body d-flex align-items-center justify-content-center flex-column fs-3">
            <p class="card-text"><?php echo getTotalReports($GLOBALS['connect']); ?></p>
            <h5 class="card-title h3 fw-semibold">Report</h5>
          </div>
        </div>
      </div>
      <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-10 g-4">
        <div class="card card-business text-white" style="height:200px">
          <div class="card-body d-flex align-items-center justify-content-center flex-column fs-3">
            <p class="card-text"><?php echo countBusinesses($GLOBALS['connect']); ?></p>
            <h5 class="card-title h3 fw-semibold">Business</h5>
          </div>
        </div>
      </div>
      <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-4 col-10 g-4">
        <div class="card card-category text-white" style="height:200px">
          <div class="card-body d-flex align-items-center justify-content-center flex-column fs-3">
            <p class="card-text"><?php echo countDistinctCategories($GLOBALS['connect'])?></p>
            <h5 class="card-title h3 fw-semibold">Category</h5>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
