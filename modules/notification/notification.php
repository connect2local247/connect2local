<div class="modal fade" id="notificationModal" tabindex="1" aria-labelledby="notificationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content text-bg-dark border-0" style="z-index:10;min-height:70vh;min-width:50vw">
      <div class="modal-header border-0">
        <h1 class="modal-title fs-5" id="notificationModalLabel">Notification</h1>
        <i class="fa-solid fa-xmark" data-bs-dismiss="modal" aria-label="Close"></i>
      </div>
      <div class="modal-body border-0 text-bg-dark">
                        <div class="container">
                        <?php
                            $conn = $GLOBALS['connect'];
                            // Create connection
                        

                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Fetch notifications from the database
                            $sql = "SELECT * FROM notification ORDER BY n_time DESC"; // Assuming 'notification' is the name of your table
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    // Display notification based on its type (request or report)
                                    if ($row['n_type'] === 'request') {
                                        echo displayRequestNotification($row);
                                    } elseif ($row['n_type'] === 'report') {
                                        echo displayReportNotification($row);
                                    }
                                }
                            } else {
                                echo "No notifications found.";
                            }

                            // Close database connection
                            $conn->close();

                            // Function to format and display request notifications
                            function displayRequestNotification($notification) {
                                $profileImg = $notification['bp_profile_img_url'] ?? '/asset/image/user/profile.png';
                                $username = $notification['cp_username'] ?? ($notification['cp_fname'] . ' ' . $notification['cp_lname']);
                                $elapsedTime = $notification['elapsed_time'];

                                // Format the notification HTML
                                $notificationHTML = "
                                    <div class='d-flex border align-items-center p-3 rounded shadow my-2 position-relative' style='gap:10px'>
                                        <div class='user-profile-img'>
                                            <img src='{$profileImg}' alt='' class='rounded-circle' style='height:45px;width:45px'>
                                        </div>
                                        <div class='notification-content d-flex justify-content-center align-items-center'>
                                            <p class='my-auto pe-4'>
                                                <span class='username fw-bold'><i>@{$username}</i></span> has requested to add their business
                                                <span class='elapse-time text-secondary px-1' style='font-size:14px'>{$elapsedTime}</span>
                                            </p>
                                            <i class='fa-solid fa-info-circle fs-4 text-info position-absolute end-0 me-3'></i>
                                        </div>
                                    </div>
                                ";
                                return $notificationHTML;
                            }

                            // Function to format and display report notifications
                            function displayReportNotification($notification) {
                                $profileImg = $notification['cp_profile_img_url'] ?? '/asset/image/user/profile.png';
                                $username = $notification['cp_username'] ?? ($notification['cp_fname'] . ' ' . $notification['cp_lname']);
                                $elapsedTime = $notification['elapsed_time'];

                                // Format the notification HTML
                                $notificationHTML = "
                                    <div class='d-flex border align-items-center p-3 rounded shadow my-2' style='gap:10px'>
                                        <div class='user-profile-img'>
                                            <img src='{$profileImg}' alt='' class='rounded-circle' style='height:45px;width:45px'>
                                        </div>
                                        <div class='notification-content d-flex justify-content-center align-items-center'>
                                            <p class='my-auto'>
                                                <span class='username fw-bold'><i>@{$username}</i></span> report on 
                                                <span class='business-name fw-semibold text-primary'><i><u>{$notification['bi_business_name']}</u></i></span>
                                                <br>
                                                <span class='reported-content'>{$notification['n_content']}</span>
                                                <span class='elapse-time text-secondary px-1' style='font-size:14px'>{$elapsedTime}</span>
                                            </p>
                                        </div>
                                    </div>
                                ";
                                return $notificationHTML;
                            }
                        ?>
                        </div>
      </div>
    </div>
  </div>
</div>
