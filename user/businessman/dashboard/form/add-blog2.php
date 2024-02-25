<div class="modal fade" id="linkModal" tabindex="-1" aria-labelledby="linkModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="linkModalLabel">Add Link</h1>
                    <i class="fa-solid fa-xmark fs-5" data-bs-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body">
                    <form  method="POST" id="addLinkForm">
                        <div class="mt-2">
                            <input type="text" class="form-control" name="link-title" id="link-title" placeholder="Link Title" required>
                        </div>

                        <div class="mt-2">
                            <input type="text" class="form-control" name="link-url" id="link-url" placeholder="Link URL" required>
                        </div>
                </div>
                <div class="modal-footer d-flex">
                <input type="button" value="Add Link" class="btn btn-primary m-auto" onclick="submitLinkForm()">


                        

                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    include "../../../component/form-alert.php";
    unset($_SESSION['error']);
    ?>
    <form action="/user/businessman/dashboard/code/blog-data-insertion.php" onsubmit="return validateForm()" class="col-lg-7 col-md-9 col-12 d-flex  flex-column align-items-center justify-content-center" method="post" style="margin-top:100px;height:calc(100vh - 150px); width:85%" enctype="multipart/form-data">
    <fieldset class=" border p-2 rounded col-lg-7 col-md-9 col-12 position-relative">
            <div class="add-link-icon position-absolute end-0 me-2">
                <i class="fa-solid fa-plus border rounded p-2 bg-white shadow" data-bs-target="#linkModal" data-bs-toggle="modal"></i>
            </div>
            <legend class="fs-3 fw-bold text-center">Add Blog</legend>
            <div class="mt-4 d-flex">
                <div class="image-container p-1 m-auto position-relative">
                    
                        <div id="media-container" class="m-auto" style="max-width: 100%; max-height: 150px;"></div>
                    
                </div>
            </div>
            <div class="form-group">
                <div class="mt-2">
                    <label for="blog-title" class="form-label">Title</label>
                    <input type="text" name="blog-title" id="blog-title" class="form-control" placeholder="Blog Title" value="<?php if(isset($_SESSION['blog-title'])) echo $_SESSION['blog-title']; ?>" required>
                </div>

                <div class="mt-2 position-relative">
                    <label for="blog-description" class="form-label">Description</label>
                    <textarea name="blog-description" class="form-control" id="blog-description" cols="30" rows="4" placeholder="Write Description Here..." maxlength="1000"><?php if(isset($_SESSION['blog-description'])) echo $_SESSION['blog-description']; ?></textarea>
                    <div id="charCount" class="text-secondary position-absolute bottom-0 end-0 me-2 mb-2">0/1000</div>
                </div>

                <div class="mt-2">
                    <label for="file-upload" class="form-label">Upload Image/Video</label>
                    <input type="file" name="file-upload" id="file-upload" class="form-control" accept="image/*, video/*" onchange="previewFile()" required>
                </div>

                <?php
                        if(isset($_SESSION['linkDataArray'])){ 
                            
                        if(count($_SESSION['linkDataArray']) <= 0){
                            unset($_SESSION['linkDataArray']);
                        } else{

                            
                ?>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
  <script>
                function deleteCurrentLink() {
                // Get the index of the clicked link
                var linkIndex = $(event.target).closest('span').index();
                console.log('linkIndex:', linkIndex);
                // Remove the link from the linkContainer
                $('#linkContainer').children().eq(linkIndex).remove();

                // Make an AJAX request to update the session data on the server
                $.ajax({
                    type: 'POST',
                    url: '/includes/data_request/update_session.php', // replace with the actual server script
                    data: { linkIndex: linkIndex },
                    success: function(response) {
                        var linkContainer = document.getElementById('linkContainer')
                        
                        if(linkContainer.children.length <= 0){
                                linkContainer.classList.add('d-none');
                                //unset($_SESSION['linkDataArray']);
                        }
                        
                    }
                });
            }
            </script>
                <div id="linkContainer" class="mt-2 border rounded shadow p-2">
                        <?php
                    
                                    foreach ($_SESSION['linkDataArray'] as $linkDataAssoc) {
                                        // Access individual elements (title and url) in the associative array
                                        $title = $linkDataAssoc['title'];
                                        $url = $linkDataAssoc['url'];
                                        $_SESSION['example_data'] = 1;
                                        session_write_close();
                                        ?>
                            <span class="d-flex align-items-center p-1 my-1 rounded text-bg-light shadow justify-content-between border"><i class="fa-solid fa-link fs-5 border-end px-2" title="<?php echo $title; ?>"></i><a href="<?php echo $url; ?>" class="nav-link" target="_blank"><?php echo $title; ?></a><i class="fa-solid fa-xmark fs-5 border-start px-2" onclick="deleteCurrentLink()"></i></span>
                            
                            <?php
                          

                                    }
                                }
                       
                        }
                            
                        ?>
                </div>
                <div class="mt-4 d-flex">
                    <input type="submit" value="Submit" name="submit" class="btn btn-primary bg-gradient m-auto">
                </div>
            </div>
        </fieldset>
    </form>
    <script>
    // JavaScript code for AJAX form submission
    $(document).ready(function(){
        $('#addBlogForm').submit(function(e){
            e.preventDefault(); // Prevent default form submission
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    // Handle the response
                    if (response.includes("greet-message")) {
                        // Session is set, show modal
                        $('#greetModal').modal('show'); // Assuming you have a modal with ID 'greetModal'
                    } else {
                        // Handle other responses or actions if needed
                    }
                }
            });
        });
    });
</script>
<script>
        function submitLinkForm() {
    // Get the form data
    var formData = $('#addLinkForm').serialize();

    // Make an AJAX request
    $.ajax({
        type: 'POST',
        url: '/includes/data_request/addLink.php',
        data: formData,
        success: function(response) {
            console.log('Response:', response);
            console.log('AJAX request successful');

            // Append the new link to the link container
            $('#linkContainer').append(response);
            console.log("link added")
            // Clear the form fields if needed
            $('#link-title').val('');
            $('#link-url').val('');

            // Check if link container is empty and hide it if needed
            if ($('#linkContainer').children().length < 0) {
                $('#linkContainer').removeClass('d-none');
            }

            // Close the modal or perform any other actions
            $('#linkModal').modal('hide');
        },
        error: function(error) {
            // Handle errors if needed
            console.log('Error:', error);
        }
    });
}
</script>

<script>
    function validateForm() {
        // Get the file input element
        var fileInput = document.getElementById('file-upload');

        // Check if a file is selected
        if (fileInput.files.length > 0) {
            // Get the file name
            var fileName = fileInput.files[0].name;

            // Check if the file extension is 'mov'
            if (fileName.endsWith('.mov')) {
                alert('Sorry, MOV files are not allowed.');
                return false; // Prevent form submission
            }
        }

        return true; // Allow form submission
    }

    function previewFile() {
        var mediaContainer = document.getElementById('media-container');
        var fileInput = document.getElementById('file-upload');
        var file = fileInput.files[0];

        console.log(mediaContainer)
        // var fileInfoContainer = document.getElementById('file-info');
        // fileInfoContainer.innerHTML = 'File: ' + file.name + ', Size: ' + file.size + ', Type: ' + file.type;

        // Remove previous content
        while (mediaContainer.firstChild) {
            mediaContainer.removeChild(mediaContainer.firstChild);
        }

        if (file) {
            // Show mediaContainer only if a file is selected
            mediaContainer.style.display = 'block';

            if (file.type.includes('image')) {
                // If it's an image, display using img tag
                var img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.style.maxWidth = '100%';
                img.style.maxHeight = '150px';
                mediaContainer.appendChild(img);
            } else if (file.type.includes('video')) {
                // If it's a video, display using video tag
                var video = document.createElement('video');
                video.src = URL.createObjectURL(file);
                video.style.maxWidth = '100%';
                video.style.maxHeight = '150px';
                video.controls = true;
                mediaContainer.appendChild(video);
            }
        } else {
            // Hide mediaContainer if no file is selected
            mediaContainer.style.display = 'none';
        }
    }

    $(document).ready(function(){
        var maxChars = 1000;
        var textarea = $('#blog-description');
        var charCount = $('#charCount');

        // Function to update character counter
        function updateCharCount() {
            var currentChars = textarea.val().length;
            charCount.text(currentChars + '/' + maxChars);

            // Store the current character count in local storage
            localStorage.setItem('charCount', currentChars);
        }

        // Check if there's a stored character count in local storage
        var storedCharCount = localStorage.getItem('charCount');
        if (storedCharCount) {
            charCount.text(storedCharCount + '/' + maxChars);
        }

        // Attach input event to update character counter
        textarea.on('input', function () {
            updateCharCount();
            var currentChars = textarea.val().length;

            if (currentChars >= maxChars) {
                textarea.addClass('border-danger border-2');
            } else {
                textarea.removeClass('border-danger border-2');
            }
        });

        
    });
</script>
