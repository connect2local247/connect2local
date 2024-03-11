<!-- Modal -->
<div class="modal fade" id="shareBlogModal<?php echo $unique_identifier ?>" tabindex="-1" aria-labelledby="shareBlogModalLabel<?php echo $unique_identifier ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-bg-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="shareBlogModalLabel<?php echo $unique_identifier ?>">Share Blog</h5>
        <i class="fa-solid fa-xmark" data-bs-dismiss="modal" aria-label="Close"></i>
      </div>
      <div class="modal-body">
        <?php $blog_link = "http://connect2local/modules/blog/shared-blog.php?shared_blog_id=$blog_id"; ?>
        <div class="input-group d-flex justify-content-around align-items-center text-bg-light p-2 rounded">
          <input type="text" class="form-control w-50" style="background:transparent;border:none" value="<?php echo $blog_link; ?>" id="blogLink<?php echo $unique_identifier?>" readonly>
          <i class="fa-solid fa-clipboard fs-4 clipboard" onclick="copyToClipboard('<?php echo $unique_identifier ?>')"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function copyToClipboard(identifier) {
    var inputElement = document.getElementById('blogLink' + identifier);
    inputElement.select();
    document.execCommand('copy');
    inputElement.setSelectionRange(0, 0);
    clipboard = document.querySelectorAll('.clipboard');
    for (var i = 0; i < clipboard.length; i++) {
    clipboard[i].addEventListener('click', function () {
        // Reset all links to black
        for (var j = 0; j < clipboard.length; j++) {
            clipboard[j].style.color = 'black';
        }
        // Set the clicked link to blue
        this.style.color = 'royalblue';
    });
}
  }
</script>
