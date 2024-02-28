<div class="modal fade" id="notificationModal" tabindex="1" aria-labelledby="notificationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content text-bg-dark border-0" style="z-index:10;min-height:70vh;min-width:50vw">
      <div class="modal-header border-0">
        <h1 class="modal-title fs-5" id="notificationModalLabel">Notification</h1>
        <i class="fa-solid fa-xmark" data-bs-dismiss="modal" aria-label="Close"></i>
      </div>
      <div class="modal-body border-0">
           <?php
                $query = "SELECT * FROM notification";
                $result = mysqli_query($GLOBALS['connect'],$query);
                $notifications = mysqli_fetch_all($result, MYSQLI_ASSOC);
                // Array to store new and seen notifications
                $newNotifications = array();
                $seenNotifications = array();
                while($row = mysqli_fetch_assoc($result)) {
                    if ($row['n_status'] == 0) {
                        $newNotifications[] = $row;
                    } else {
                        $seenNotifications[] = $row;
                    }
                }
                // Display new notifications
                if (!empty($newNotifications)) {
                    echo "<h3>New Notifications</h3>";
                    include "notification-design.php"; // Modify this according to your design
                }
                // Display seen notifications
                if (!empty($seenNotifications)) {
                    echo "<h3>Seen Notifications</h3>";
                    include "notification-design.php"; // Modify this according to your design
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
