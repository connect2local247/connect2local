<?php
      session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Blog</title>
    <link rel="stylesheet" href="/asset/css/form.css">
    <?php include "../../../../asset/link/cdn-link.html"; ?>
  </head>
  <body class="text-bg-dark">
        <script>
            path = "/user/businessman/dashboard/dashboard.php";
        </script>
        <?php 

                if(isset($_SESSION['greet-message'])){
                    if(isset($_SESSION['blog-title'])){
                       $_SESSION['blog-title'] = "";
                    } 
                    if(isset($_SESSION['blog-description'])){
                      $_SESSION['blog-description'] = "";
                    }
                }

                include "../../../../component/form-alert.php";
                unset($_SESSION['error']);
        ?>
    <!-- Link Modal -->
    <div class="modal" id="linkModal" tabindex="-1" role="dialog" aria-labelledby="linkModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content text-bg-light">
          <div class="modal-header">
            <h5 class="modal-title" id="linkModalLabel">Add Link</h5>
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button> -->
            <i class="fa-solid fa-xmark" data-dismiss="modal" arid-hidden="true"></i>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="linkTitle">Title:</label>
              <input type="text" class="form-control" placeholder="Enter title here.." id="linkTitle">
            </div>
            <div class="form-group">
              <label for="linkUrl">URL:</label>
              <input type="text" class="form-control" placeholder="Paste your URL here.." id="linkUrl">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="addLinkBtn">Add Link</button>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <form action="/user/businessman/dashboard/code/blog-data-insertion.php" method="post" class="add-blog d-flex justify-content-center p-2">
        <fieldset class="border rounded col-lg-6 col-md-8 col-12 p-3 position-relative">
          <legend class="fw-bold text-center h2 my-3">Add Blog</legend>
          <div class="add-link-icon border rounded text-bg-dark bg-gradient shadow p-1 px-2 position-absolute end-0 me-2">
            <i class="fa-solid fa-plus" data-toggle="modal" data-target="#linkModal" id="#addLinkBtn"></i>
          </div>
          <div class="blog-content-container p-2 d-flex m-auto ">
            <div class="image-container m-auto border p-2 rounded-2 position-relative">
              <img src="/asset/image/background/blog.png" style="height:150px;width:150px;" alt="">
              <i class="fa-solid fa-camera position-absolute bottom-0 end-0 fs-5 me-1 mb-1 text-white border p-1 rounded bg-dark"></i>
            </div>
          </div>
          <div class="mt-5">
            <input type="text" name="blog-title" id="blog-title" class="form-control" placeholder="Blog Title" value="<?php if(isset($_SESSION['blog-title'])) echo $_SESSION['blog-title']; ?>" required>
          </div>
          <div class="mt-2">
            <!-- Video input can be added here if needed -->
          </div>
          <div class="mt-2 position-relative">
            <textarea id="blog-description" name="blog-description" class="form-control position-relative" placeholder="Description" rows="4"><?php if(isset($_SESSION['blog-description'])) echo $_SESSION['blog-description']; ?></textarea>
            <div id="charCount" class="text-secondary position-absolute bottom-0 end-0 me-2 mb-1">0/1000</div>
          </div>
          <div id="addedLinksContainer" class="mt-3 bg-light p-3 rounded" style="display: none;">
            <!-- This div will contain the added links -->
          </div>
          <div class="mt-4 d-flex">
            <input type="submit" name="submit" class="btn btn-primary px-5 py-2 rounded m-auto" value="Submit">
          </div>
        </fieldset>
      </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- ... (your existing HTML code) ... -->

<script>
  $(document).ready(function() {
    var maxChars = 1000;
    var linkCount = 0;
    var displayAddedLinksContainer = document.getElementById('addedLinksContainer');
    var textarea = $('#blog-description');

    textarea.on('input', function() {
      var charCount = $(this).val().length;
      $('#charCount').text(charCount + '/' + maxChars);

      if (charCount >= maxChars) {
        $(this).addClass('border-danger border-2');
        // $('.add-link-icon').addClass('error');
        // showErrorModal();
      } else {
        $(this).removeClass('error');
        $('.add-link-icon').removeClass('error');
      }
    });

    function showErrorModal() {
      $('#errorModal').modal('show');
    }

    // Handle Add Link button click
$('#addLinkBtn').on('click', function() {
  var linkTitle = $('#linkTitle').val();
  var linkUrl = $('#linkUrl').val();
  if (linkUrl != "" && linkTitle != "") {
    // Create the link HTML
    var linkHtml = '<a href="' + linkUrl + '" class="text-bg-light d-block p-1 shadow d-flex my-1" style="gap:10px;text-decoration:none;overflow:hidden" target="_blank"><i class="fa-solid fa-link border-end p-1 mx-1" title="' + linkTitle + '"></i> ' + linkUrl + '</a>';

    // Insert the link at the cursor position in the textarea
    var cursorPos = textarea[0].selectionStart;
    var textBefore = textarea.val().substring(0, cursorPos);
    var textAfter = textarea.val().substring(cursorPos);
    textarea.val(textBefore + textAfter);

    // Close the modal
    $('#linkModal').modal('hide');

    // Clear the input fields
    $('#linkTitle').val('');
    $('#linkUrl').val('');

    // Display the added link below the textarea
    displayAddedLinksContainer.style.display = "block";
    $('#addedLinksContainer').append(linkHtml);
    linkCount++;
  } else {
    alert("Can't be Empty Link Title and URL");
  }
});

  });
</script>

<!-- ... (your existing HTML code) ... -->



</body>
</html>
