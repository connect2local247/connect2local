<?php include "add-report.php"; ?>

<div class="modal fade" id="reportModal<?php echo $unique_identifier ?>" tabindex="-1" aria-labelledby="reportModalLabel<?php echo $unique_identifier ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-bg-dark">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="reportModalLabel<?php echo $unique_identifier ?>">Report</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php echo $blog_id ?>
        <form action="#" method="post">
          <div class="mb-3">
            <label for="report_option">Select Issue:</label>
            <select class="form-select" id="report_option<?php echo $unique_identifier ?>" name="report_option" required>
              <option value="spam">Spam</option>
              <option value="inappropriate_content">Inappropriate Content</option>
              <option value="copyright_violation">Copyright Violation</option>
              <option value="other">Other</option>
            </select>
          </div>
          <div id="description_div<?php echo $unique_identifier ?>" class="mb-3" style="display: none;">
            <label for="description">Description (Optional):</label>
            <textarea class="form-control" id="description" name="description" rows="3" maxlength="150" placeholder="Describe your issue ..."></textarea>
            <small class="form-text text-muted">Maximum 150 characters.</small>
          </div>
          <!-- <input type="hidden" name="blog_id" value="<?php echo $blog_id ?>">
          <input type="hidden" name="user_id" value="<?php echo $user_id ?>"> -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <input type="submit" class="btn btn-primary bg-gradient" name="submit" value="Report">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
document.getElementById('report_option<?php echo $unique_identifier ?>').addEventListener('change', function() {
  var descriptionDiv = document.getElementById('description_div<?php echo $unique_identifier ?>');
  if (this.value === 'other') {
    descriptionDiv.style.display = 'block';
  } else {
    descriptionDiv.style.display = 'none';
  }
});
</script>
