
<!-- Modal -->
<div class="modal fade" id="blockModal<?php echo $unique_identifier ?>" tabindex="-1" aria-labelledby="blockModalLabel<?php echo $unique_identifier ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-bg-dark">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="blockModalLabel<?php echo $unique_identifier ?>">Block</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            Are you sure to block that user ?
            <?php 
                 $get_profile_id = "SELECT b_id FROM business_profile WHERE bp_user_id = '$user_id'";
                 $result = mysqli_query($GLOBALS['connect'],$get_profile_id);
                 
                 if(mysqli_num_rows($result)){
                    $data = mysqli_fetch_assoc($result);
                    $profile_id = $data['b_id'];
                 }
            ?>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary bg-gradient" onclick="location.href='?block_user_id=<?php echo $user_id?>&profile_id=<?php echo $profile_id; ?>&viewer_id=1'">Yes</button>
      </div>
    </div>
  </div>
</div>