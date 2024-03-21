<?php
// Establish database connection
$conn = $GLOBALS['connect'];
// Function to fetch notifications and display them by time


function fetchAndDisplayNotifications($conn) {
    // Array to hold notifications categorized by time
    if(isset($_SESSION['n_status'])){

        if($_SESSION['n_status'] == 0){
            $update_notification = "UPDATE notification 
            SET n_status = 1 
            WHERE n_user_id = '{$_SESSION['current_user']}' 
            AND n_type IN ('interact', 'warning', 'greeting', 'achievement', 'response')";
    
            $result = mysqli_query($GLOBALS['connect'],$update_notification);
            $_SESSION['n_status'] = 1;
        }
    }
   
      // die($result);
      // echo $update_notification;
    $notificationsByTime = array(
        'Today' => array(),
        'Yesterday' => array(),
        '1 Day Ago' => array(),
        '2 Days Ago' => array(),
        '3 Days Ago' => array(),
        '4 Days Ago' => array(),
        '5 Days Ago' => array(),
        'This Week' => array(),
        'This Month' => array(),
        'This Year' => array()
    );

    
    // Fetch notifications from the database
    $query = "SELECT * FROM notification WHERE n_user_id = '{$_SESSION['current_user']}' AND n_type IN ('interact', 'warning', 'greeting', 'achievement', 'response')  ORDER BY n_time DESC";
    $result = mysqli_query($conn, $query);
    // Check if there are any notifications
    if ($result && mysqli_num_rows($result) > 0) {
        // Get current date and time
        $currentDate = new DateTime();
        $currentTime = $currentDate->getTimestamp();

        // Get the current month
        $currentMonth = $currentDate->format('m');

        // Loop through each notification
        while ($row = mysqli_fetch_assoc($result)) {
            // Calculate elapsed time since notification
            $notificationTime = strtotime($row['n_time']);
            $elapsedTime = $currentTime - $notificationTime;

            // Determine time category
            $timeCategory = getTimeCategory($elapsedTime);

            // Generate notification structure based on type
            $userInfo = getBusinessUserInfo($conn, $row['n_user_id']);
            $notificationStructure = generateNotificationStructure($row, $userInfo);

            // Categorize notification by time
            $notificationsByTime[$timeCategory][] = $notificationStructure;
        }

        // Remove "This Month" category if it has no notifications
        if (empty($notificationsByTime['This Month'])) {
            unset($notificationsByTime['This Month']);
        }
    }

    // Display notifications for each time category
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

// Function to determine time category
function getTimeCategory($elapsedTime) {
    // Define time intervals in seconds
    $day = 86400;
    $week = $day * 7;
    $month = $day * 30;
    $year = $day * 365;

    // Get the current date
    $currentDate = new DateTime();
    $currentMonth = $currentDate->format('m');

    // Determine time category
    if ($elapsedTime < $day) {
        return 'Today';
    } elseif ($elapsedTime < ($day * 2)) {
        return 'Yesterday';
    } elseif ($elapsedTime < ($day * 6)) {
        return floor($elapsedTime / $day) . ' Days Ago';
    } elseif ($elapsedTime < $week) {
        return 'This Week';
    } elseif ($elapsedTime < ($month)) { // Exclude if it's not the current month
        return 'This Month';
    } elseif ($elapsedTime < $year) {
        return 'This Year';
    } else {
        return 'Older';
    }
}



// Function to fetch business user info
function getBusinessUserInfo($conn, $userId) {
    $query = "SELECT bp_username AS username, bp_profile_img_url AS profile_img FROM business_profile WHERE b_id = '$userId'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return array(
            'username' => $row['username'],
            'profile_img' => $row['profile_img']
        );
    } else {
        return false;
    }
}

// Function to generate notification structure based on notification type
function generateNotificationStructure($notification, $userInfo) {
    // Generate structure for different notification types
    switch ($notification['n_type']) {
        case 'greeting':
        case 'interact':
        case 'achievement':
            return '<div class="interact1">
                        <div class="d-flex border align-items-center p-3 rounded shadow my-2" style="gap:10px">
                            <div class="user-profile-img">
                                <img src="' . $userInfo['profile_img'] . '" alt="" class="rounded-circle" style="height:45px;width:45px">
                            </div>
                            <div class="notification-content d-flex justify-content-center align-items-center">
                                <p class="my-auto">
                                    <span class="username fw-bold"><i>@' . $userInfo['username'] . '</i></span> ' . $notification['n_content'] . '<span class="elapse-time text-secondary px-1" style="font-size:14px">' . elapsedTime($notification['n_time']) . '</span>
                                </p>
                            </div>
                        </div>
                    </div>';
            break;
        case 'warning':
            return '<div class="warning">
                        <div class="d-flex border align-items-center p-3 rounded shadow my-2 alert alert-danger" style="gap:10px">
                            <i class="fa-solid fa-info text-danger my-auto p-2 px-3 alert alert-danger rounded-circle"></i>
                            <div class="notification-content d-flex justify-content-center align-items-center">
                                <p class="my-auto">
                                    <span class="username fw-bold"><i>@' . $userInfo['username'] . '</i></span> ' . $notification['n_content'] . '<span class="elapse-time text-secondary px-1" style="font-size:14px">' . elapsedTime($notification['n_time']) . '</span>
                                </p>
                            </div>
                        </div>
                    </div>';
            break;
        default:
            return ''; // Return empty string for unrecognized types
    }
}

// Function to calculate elapsed time
function elapsedTime($timestamp) {
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

?>
