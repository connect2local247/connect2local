<div class="modal fade" id="reportModal<?php echo $unique_identifier ?>" tabindex="-1" aria-labelledby="reportModalLabel<?php echo $unique_identifier ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-bg-dark">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="reportModalLabel<?php echo $unique_identifier ?>">Delete</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            Are you sure to delete blog ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary bg-gradient" onclick="location.href='?block_blog_id=<?php echo $blog_id ?>&block_user_id=<?php echo $user_id?>'">Yes</button>
      </div>
    </div>
  </div>
</div>