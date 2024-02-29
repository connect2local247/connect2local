<div class="modal fade" id="notificationModal" tabindex="1" aria-labelledby="notificationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content text-bg-dark border-0" style="z-index:10;min-height:70vh;min-width:50vw">
      <div class="modal-header border-0">
        <h1 class="modal-title fs-5" id="notificationModalLabel">Notification</h1>
        <i class="fa-solid fa-xmark" data-bs-dismiss="modal" aria-label="Close"></i>
      </div>
      <div class="modal-body border-0 text-bg-dark">
          <?php
          
                $query = "SELECT * FROM notification WHERE 1";

                $result = mysqli_query($GLOBALS['connect'],$query);

                if(mysqli_num_rows($result) > 0){
                   

                    while( $row = mysqli_fetch_assoc($result)){
                        $type = $row['n_type'];
                        $status = $row['n_status'];
                        $content = $row['n_content'];
                        $user_id = $row['n_user_id'];

                        include "notification-design.php";
                    }
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
