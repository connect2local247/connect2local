
                    <?php
                    // Establish database connection
                    $conn = $GLOBALS['connect'];

   // Function to fetch username, full name, and profile image based on user type
function getUserInfo($conn, $userId) {

    if(isset($_SESSION['n_admin_status']) && $_SESSION['n_admin_status'] == 0){
        
        $update_notification = "UPDATE notification 
            SET n_status = 1 
            WHERE n_user_id = '$userId' 
            AND n_type IN ('report','request')";
            $result = mysqli_query($GLOBALS['connect'],$update_notification);
            $_SESSION['n_admin_status'] = 1;
    }
        
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
    $get_fullname = "SELECT c_fname,c_lname FROM customer_register WHERE c_id = '$userId'";
$result = mysqli_query($conn,$get_fullname);
$count = mysqli_num_rows($result);
if($count > 0): 
    $row = mysqli_fetch_assoc($result); 
    $fname = $row['c_fname']; 
    $lname = $row['c_lname']; 
endif;

$query = "SELECT cp_username AS username, CONCAT('$fname', ' ', '$lname') AS full_name, IFNULL(cp_profile_img_url, '/asset/image/user/profile.png') AS profile_img 
          FROM customer_profile 
          JOIN customer_register ON customer_profile.c_id = customer_register.c_id 
          WHERE customer_profile.c_id = '$userId'";

            //   echo "$query<br><br>";
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
function fetchAndDisplayNotifications($conn) {
    // Array to hold notifications categorized by time
    $notificationsByTime = array(
        'new' => array(),
        'today' => array(),
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

            // Determine the category for the notification
            $category = elapsedNotificationTime($row['n_time']);
            
            // If the category is 'day' and the elapsed time is less than or equal to 1, set it to 'today'
            if ($category == 'day' && $elapsedTime <= 1) {
                $category = 'today';
            }

            // Categorize notification by time
            $notificationsByTime[$category][] = generateNotificationStructure($row, $username, $fullName, $profileImg, $elapsedTime);
        }
    }

    // Merge today's notifications into the 'today' category
    $notificationsByTime['today'] = array_merge($notificationsByTime['today'], $notificationsByTime['new']);

    // Remove 'new' category
    unset($notificationsByTime['new']);

    // Display notifications in each category
    echo "<div class='container'>";
    foreach ($notificationsByTime as $timeCategory => $notifications) {
        if (!empty($notifications)) {
            echo "<h4>$timeCategory</h4>";
            foreach ($notifications as $notification) {
                echo $notification; // Output the notification structure
            }
        }
    }
    echo "</div>";
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
                                            <i class="fa-solid fa-info-circle fs-4 text-info position-absolute end-0 me-3" onclick="location.href=\'/modules/user-profile/profile.php?profile_id='.$notification['n_user_id'].'&viewer_id=1\'"></i>
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
                                                <span class="username fw-bold"><i>@' . ($username ? $username : $fullName) . '</i></span> 
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
                        
                        // If the time difference is less than 24 hours, categorize as "today"
                        if ($timeDiff < 86400) {
                            return 'today';
                        } else {
                            // Otherwise, categorize based on elapsed time intervals
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
                    }
                    
                    
                  
                  
                    ?>
