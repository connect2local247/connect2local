
<!-- Modal -->
<div class="modal fade" id="deleteBlogModal<?php echo $unique_identifier ?>" tabindex="-1" aria-labelledby="deleteBlogModalLabel<?php echo $unique_identifier ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-bg-dark">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="deleteBlogModalLabel<?php echo $unique_identifier ?>">Delete</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            Are you sure to delete blog ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" onclick="location.href='?delete_blog_id=<?php echo $blog_id ?>&profile_id=<?php echo $current_user_id?>'">Delete</button>
      </div>
    </div>
  </div>
</div>