<!-- Modal -->
<div class="modal fade" id="shareProfileModal" tabindex="-1" aria-labelledby="shareProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="shareProfileModalLabel">Share Profile</h5>
        <i class="fa-solid fa-xmark" data-bs-dismiss="modal" aria-label="Close"></i>
      </div>
      <div class="modal-body">
        <?php $profile_link = "http://connect2local/modules/user-profile/profile.php?profile_id=$profile_id&viewer_id=1"; ?>
        <div class="input-group d-flex justify-content-around align-items-center text-bg-light p-2 rounded">
          <input type="text" class="form-control w-50" style="background:transparent;border:none" value="<?php echo $profile_link; ?>" id="profileLink" readonly>
          <i class="fa-solid fa-clipboard fs-4 clipboard" onclick="copyProfileBoard()"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
<script>
  function copyProfileBoard() {
    var inputElement = document.getElementById('profileLink');
    if (inputElement) {
      inputElement.select();
      document.execCommand('copy');
      inputElement.setSelectionRange(0, 0);
      var clipboard = document.querySelector('.clipboard');
      if (clipboard) {
        clipboard.style.color = 'royalblue';
      }
    }
  }
</script>
