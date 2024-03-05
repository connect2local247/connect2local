
<div class="modal fade" id="notificationModal" tabindex="1" aria-labelledby="notificationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content text-bg-dark border-0" style="z-index:10;min-height:70vh;min-width:50vw">
      <div class="modal-header border-0">
        <h1 class="modal-title fs-5" id="notificationModalLabel">Notification</h1>
        <i class="fa-solid fa-xmark" data-bs-dismiss="modal" aria-label="Close"></i>
      </div>
      <div class="modal-body border-0 text-bg-dark">
      <?php



$query = "SELECT * FROM notification WHERE n_user_id = '{$current_user_id}' AND n_status = 0 ORDER BY n_time DESC";
$result = mysqli_query($GLOBALS['connect'], $query);

if (mysqli_num_rows($result) > 0) {
    // Initialize arrays for each category
    $new_notifications = array();
    $yesterday_notifications = array();
    $week_notifications = array();
    $other_notifications = array();

    // Current time
    $current_time = time();

    while ($row = mysqli_fetch_assoc($result)) {
        // Determine the time difference in seconds
        $time_difference = $current_time - strtotime($row['n_time']);
        $hours_difference = floor($time_difference / 3600);

        // Categorize based on time and type
        if ($hours_difference <= 24) {
            $new_notifications[] = $row;
        } elseif ($hours_difference <= 24 * 7) {
            $yesterday_notifications[] = $row;
        } elseif ($hours_difference <= 24 * 7 * 4) { // Assuming a month has 4 weeks
            $week_notifications[] = $row;
        } else {
            $other_notifications[] = $row;
        }
    }
    
    // Output accordion structure
    ?>
    <div id="accordion">
        <h3 class="fs-4 fw-semibold">New Notifications</h3>
        <div>
            <?php foreach ($new_notifications as $notification) : include "notification-design.php";?>
                <!-- Structure for new notifications -->
                
            <?php endforeach; ?>
        </div>
        <h3 class="fs-4 fw-semibold">Yesterday's Notifications</h3>
        <div>
            <?php foreach ($yesterday_notifications as $notification) : include "notification-design.php";?>
                <!-- Structure for yesterday's notifications -->
            <?php endforeach; ?>
        </div>
        <h3 class="fs-4 fw-semibold">Week Ago Notifications</h3>
        <div>
            <?php foreach ($week_notifications as $notification) : include "notification-design.php"; ?>
                <!-- Structure for week ago notifications -->
            <?php endforeach; ?>
        </div>
        <h3 class="fs-4 fw-semibold">Other Notifications</h3>
        <div>
            <?php foreach ($other_notifications as $notification) : include "notification-design.php";?>
                <!-- Structure for other notifications -->
            <?php endforeach; ?>
        </div>
    </div>
    <?php
}
?>
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>
