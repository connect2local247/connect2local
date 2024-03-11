<div class="modal fade" id="editBlogModal<?php echo $unique_identifier; ?>" tabindex="-1" aria-labelledby="editBlogModalLabel<?php echo $unique_identifier; ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-bg-dark">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editBlogModalLabel<?php echo $unique_identifier; ?>">Edit</h1>
        <i class="fa-solid fa-xmark fs-5 text-white" data-bs-dismiss="modal" aria-label="Close"></i>
      </div>
      <div class="modal-body">
        
        <form action="?edit_blog_id=<?php echo $blog_id ?>&edit_user_id=<?php echo $user_id ?>&profile_id=<?php echo $_SESSION['current_user']?>" method="POST">
          <div class="content d-flex" id="existingContent">
            <?php
              // Check if content is an image
              if (strpos($content_url, '.jpg') !== false || strpos($content_url, '.jpeg') !== false || strpos($content_url, '.png') !== false || strpos($content_url, '.gif') !== false) {
                echo '<img src="/database/data/blog/content/' .$content_url . '" alt="Blog Image" class="mx-auto rounded-2" style="max-width:100%; max-height:200px;">';
              }
              // Check if content is a video
              elseif (strpos($content_url, '.mp4') !== false || strpos($content_url, '.avi') !== false || strpos($content_url, '.mov') !== false || strpos($content_url, '.wmv') !== false) {
                echo '<video controls style="max-width:100%; max-height:200px;" class="mx-auto rounded-2"><source src="/database/data/blog/content/' .$content_url . '" type="video/mp4">Your browser does not support the video tag.</video>';
              }
            ?>
          </div>
          <div class="mt-2">
            <label for="title<?php echo $unique_identifier ?>" class="form-label">Title</label>
            <input type="text" name="title" id="title<?php echo $unique_identifier; ?>" class="form-control" placeholder="Blog Title" value="<?php echo $title ?>" required>
          </div>

          <div class="col-12 g-2 position-relative mt-2">
                            <textarea name="description" id="description" cols="3" rows="3" class="form-control w-100 border-dark positon-relative" placeholder="Write Something..." maxlength="150"><?php echo isset($description) ? $description : ''; ?> </textarea>
                            <div id="description-counter" class="text-secondary text-end position-absolute bottom-0 end-0 me-1 mb-1">0/150</div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger px-4" data-bs-dismiss="modal">Cancel</button>
          <input type="submit" value="Update" name="edit-submit" class="btn btn-info px-4">
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  var descriptionTextarea = document.getElementById('description');
    // Get the description counter element
    var descriptionCounter = document.getElementById('description-counter');

    // Update the counter initially
    updateCounter();

    // Add input event listener to description textarea
    descriptionTextarea.addEventListener('input', function() {
        // Limit the character count to 150
        if (this.value.length > 150) {
            this.value = this.value.substring(0, 150);
        }
        // Update the counter
        updateCounter();
    });

    // Function to update the counter
    function updateCounter() {
        descriptionCounter.textContent = descriptionTextarea.value.length + '/' + 150;
    }
  </script>