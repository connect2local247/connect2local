<div class="modal fade" id="notificationModal" tabindex="1" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content text-bg-dark border-0" style="z-index:10;min-height:70vh;min-width:50vw">
            <div class="modal-header border-0">
                <h1 class="modal-title fs-5" id="notificationModalLabel">Notification</h1>
                <i class="fa-solid fa-xmark" data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            <div class="modal-body border-0 text-bg-dark">
                <div class="container" id="notificationContainer">
                    <?php
                    // Establish database connection
                    $conn = $GLOBALS['connect'];

   // Function to fetch username, full name, and profile image based on user type
function getUserInfo($conn, $userId) {
  // Initialize variables
  $username = '';
  $fullName = '';
  $profileImg = '';

  // Check if the user ID starts with 'C2L' to determine if it's a customer
 
  // Check if the user ID starts with 'C2LB' to determine if it's a business
  if (strpos($userId, 'C2LB') === 0) {
      $query = "SELECT bp_username AS username, CONCAT(bp_fname, ' ', bp_lname) AS full_name, IFNULL(bp_profile_img_url, '/asset/image/user/profile.png') AS profile_img 
                FROM business_profile 
                JOIN business_register ON business_profile.b_id = business_register.b_id 
                WHERE business_profile.b_id = '$userId'";
  } elseif (strpos($userId, 'C2L') === 0) {
    $query = "SELECT cp_username AS username, CONCAT(cp_fname, ' ', cp_lname) AS full_name, IFNULL(cp_profile_img_url, '/asset/image/user/profile.png') AS profile_img 
              FROM customer_profile 
              JOIN customer_register ON customer_profile.c_id = customer_register.c_id 
              WHERE customer_profile.c_id = '$userId'";
              echo "$query<br><br>";
}

  // Execute the query
  $result = mysqli_query($conn, $query);

  // Check if query was successful and if there are any rows returned
  if ($result && mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      // Assign fetched values to variables
      $username = $row['username'];
      $fullName = $row['full_name'];
      $profileImg = $row['profile_img'];
  }

  // Return associative array containing username, full name, and profile image URL
  return array(
      'username' => $username,
      'full_name' => $fullName,
      'profile_img' => $profileImg
  );
}

                    // Function to fetch notifications and display them in categories
                    function fetchAndDisplayNotifications($conn) {
                        // Array to hold notifications categorized by time
                        $notificationsByTime = array(
                            'new' => array(),
                            'yesterday' => array(),
                            'day' => array(),
                            'week' => array(),
                            'month' => array(),
                            'year' => array()
                        );

                        // Fetch notifications from the database
                        $query = "SELECT * FROM notification WHERE n_type IN ('report', 'request') ORDER BY n_time DESC";
                        $result = mysqli_query($conn, $query);

                        // Check if there are any notifications
                        if ($result && mysqli_num_rows($result) > 0) {
                            // Loop through each notification
                            while ($row = mysqli_fetch_assoc($result)) {
                                // Fetch user info based on user type
                                $userInfo = getUserInfo($conn, $row['n_user_id']);
                                $username = $userInfo['username'];
                                $fullName = $userInfo['full_name'];
                                $profileImg = $userInfo['profile_img'];

                                // Calculate elapsed time
                                $elapsedTime = elapsedTime($row['n_time']);

                                // Generate notification structure based on type
                                $notificationStructure = generateNotificationStructure($row, $username, $fullName, $profileImg, $elapsedTime);

                                // Categorize notification by time
                                $notificationsByTime[elapsedNotificationTime($row['n_time'])][] = $notificationStructure;
                            }
                        }

                        // Display notifications in each category
                        foreach ($notificationsByTime as $timeCategory => $notifications) {
                            if (!empty($notifications)) {
                                echo "<h4>$timeCategory</h4>";
                                foreach ($notifications as $notification) {
                                    echo $notification; // Output the notification structure
                                }
                            }
                        }
                    }

                    // Function to generate notification structure based on notification type
                    function generateNotificationStructure($notification, $username, $fullName, $profileImg, $elapsedTime) {
                        // Check if notification type is request
                        if ($notification['n_type'] == 'request') {
                            // Generate structure for request notification
                            return '<div class="d-flex border align-items-center p-3 rounded shadow my-2 position-relative" style="gap:10px">
                                        <div class="user-profile-img">
                                            <img src="' . $profileImg . '" alt="" class="rounded-circle" style="height:45px;width:45px">
                                        </div>
                                        <div class="notification-content d-flex justify-content-center align-items-center">
                                            <p class="my-auto pe-4">
                                                <span class="username fw-bold"><i>@' . ($username ? $username : $fullName) . '</i></span> has requested to add their business<span class="elapse-time text-secondary px-1" style="font-size:14px">' . $elapsedTime . '</span>
                                            </p>
                                            <i class="fa-solid fa-info-circle fs-4 text-info position-absolute end-0 me-3"></i>
                                        </div>
                                    </div>';
                        } elseif ($notification['n_type'] == 'report') {
                            // Generate structure for report notification
                            return '<div class="d-flex border align-items-center p-3 rounded shadow my-2" style="gap:10px">
                                        <div class="user-profile-img">
                                            <img src="' . $profileImg . '" alt="" class="rounded-circle" style="height:45px;width:45px">
                                        </div>
                                        <div class="notification-content d-flex justify-content-center align-items-center">
                                            <p class="my-auto">
                                                <span class="username fw-bold"><i>@' . ($username ? $username : $fullName) . '</i></span> report on <span class="business-name fw-semibold text-primary"><i><u>' . $notification['business_name'] . '</u></i></span>
                                                <br>
                                                <span class="reported-content">' . $notification['n_content'] . '</span>
                                                <span class="elapse-time text-secondary px-1" style="font-size:14px">' . $elapsedTime . '</span>
                                            </p>
                                        </div>
                                    </div>';
                        }
                    }

                    // Function to calculate elapsed time
                    function elapsedTime($timestamp) {
                        // Calculate the difference between current time and timestamp
                        $timeDiff = time() - strtotime($timestamp);

                        // Define time intervals in seconds
                        $intervals = array(
                            31536000 => 'y', // Year
                            2592000 => 'mo', // Month
                            604800 => 'w',   // Week
                            86400 => 'd',    // Day
                            3600 => 'hr',    // Hour
                            60 => 'min',     // Minute
                            1 => 's'         // Second
                        );

                        // Initialize elapsed time string
                        $elapsed = '';

                        // Iterate through each interval
                        foreach ($intervals as $seconds => $abbrev) {
                            // Calculate the number of complete intervals
                            $interval = floor($timeDiff / $seconds);

                            // If there are complete intervals, add to elapsed time string
                            if ($interval > 0) {
                                $elapsed .= $interval . $abbrev;
                                // Add "ago" if the interval is not "just now"
                               
                                break;
                            }
                        }

                        // Return elapsed time
                        return $elapsed;
                    }
                    function elapsedNotificationTime($timestamp) {
                      // Calculate the difference between current time and timestamp
                      $timeDiff = time() - strtotime($timestamp);
                  
                      // Define time intervals in seconds
                      $intervals = array(
                          31536000 => 'year',
                          2592000 => 'month',
                          604800 => 'week',
                          86400 => 'day',
                          3600 => 'hour',
                          60 => 'minute',
                          1 => 'second'
                      );
                  
                      // Initialize elapsed time string
                      $elapsed = '';
                  
                      // Iterate through each interval
                      foreach ($intervals as $seconds => $label) {
                          // Calculate the number of complete intervals
                          $interval = floor($timeDiff / $seconds);
                  
                          // If there are complete intervals, add to elapsed time string
                          if ($interval > 0) {
                              $elapsed .= $interval . ' ' . ($interval > 1 ? $label . 's' : $label);
                              break;
                          }
                      }
                  
                      // Return elapsed time
                      return $elapsed ? $elapsed . ' ago' : 'just now';
                  }
                  
                    // Call the function to fetch and display notifications
                    fetchAndDisplayNotifications($conn);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
