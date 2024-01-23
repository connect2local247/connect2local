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

            <div class="modal" id="linkModal" tabindex="-1" role="dialog" aria-labelledby="linkModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content text-dark">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="linkModalLabel">Add Link</h5>
                    <i class="fa-solid fa-xmark" data-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                    <label for="linkTitle">Title:</label>
                    <input type="text" class="form-control" id="linkTitle">
                    </div>
                    <div class="form-group">
                    <label for="linkUrl">URL:</label>
                    <input type="text" class="form-control" id="linkUrl">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addLinkBtn">Add</button>
                </div>
                </div>
            </div>
            </div>

        <div class="container">
            <form action="" class="add-blog d-flex justify-content-center p-2">
                <fieldset class="border rounded col-lg-6 col-md-8 col-12 p-3 position-relative">
                     <legend class="fw-bold text-center h2 my-3">Add Blog</legend>
                     <div class="add-link-icon border rounded text-bg-dark bg-gradient shadow p-1 px-2 position-absolute end-0 me-2">
                        <i class="fa-solid fa-plus" data-toggle="modal" data-target="#linkModal"></i>
                        
                     </div>
                     <div class="blog-content-container p-2 d-flex m-auto ">
                            <div class="image-container m-auto border p-2 rounded-2 position-relative">
                                <img src="/asset/image/background/blog.png" class="" style="height:150px;width:150px;" alt="">
                                <i class="fa-solid fa-camera position-absolute bottom-0 end-0 fs-5 me-1 mb-1 text-white border p-1 rounded bg-dark"></i>
                            </div>
                            <div class="video-container d-none">

                            </div>
                     </div>
                     <div class="mt-5">
                         <input type="text" name="blog-title" id="blog-title" class="form-control" placeholder="Blog Title" value="" required>
                     </div>
                     <div class="mt-2">
                            
                     </div>
                     <div class="mt-2 position-relative">
                            <textarea id="blog-description" class="form-control position-relative" placeholder="Description" rows="4"></textarea>
                            <div id="charCount" class="text-secondary position-absolute bottom-0 end-0 me-2 mb-1">0/1000</div>
                            

                            
                            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.1/dist/umd/popper.min.js"></script>
                            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
                            <script>
                             $(document).ready(function() {
    var maxChars = 1000;

    $('#myTextarea').on('input', function() {
      var charCount = $(this).val().length;
      $('#charCount').text(charCount + '/' + maxChars);

      if (charCount > maxChars) {
        $(this).addClass('error');
      } else {
        $(this).removeClass('error');
      }
    });

    // Handle Add Link button click
    $('#addLinkBtn').on('click', function() {
      var linkTitle = $('#linkTitle').val();
      var linkUrl = $('#linkUrl').val();

      // Create the link HTML
      var linkHtml = '<a href="' + linkUrl + '" target="_blank">' + linkTitle + '</a>';

      // Insert the link at the cursor position in the textarea
      var textarea = $('#myTextarea')[0];
      var cursorPos = textarea.selectionStart;
      var textBefore = textarea.value.substring(0, cursorPos);
      var textAfter = textarea.value.substring(cursorPos);
      textarea.value = textBefore + linkHtml + textAfter;

      // Close the modal
      $('#linkModal').modal('hide');
    });
  });
                            </script>
                     </div>
                     <div class="mt-4 d-flex">
                            <input type="submit" class="btn btn-primary px-5 py-2 rounded m-auto" value="Submit">
                     </div>
                </fieldset>
            </form>
        </div>

      
</body>
</html>