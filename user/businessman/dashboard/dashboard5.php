<?php
    session_start();

    include "../../../includes/table_query/db_connection.php";
    include "../../../includes/security_function/secure_function.php";
    include "blog/blog-data.php";
    // include "../../../testblog.php";
    if(isset($_SESSION['bp_user_id'])){
      $bp_user_id = $_SESSION['bp_user_id'];
      
      $query = "SELECT * FROM business_profile WHERE bp_user_id = '$bp_user_id'";
      $result = mysqli_query($GLOBALS['connect'],$query);

      if(mysqli_num_rows($result) > 0){
          $row = mysqli_fetch_assoc($result);

          $name = $row['bp_fname']." ".$row['bp_lname'];
          $profile_img = $row['bp_profile_img_url'];
      }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <?php include "../../../asset/link/cdn-link.html"; ?>
  <link rel="stylesheet" href="/asset/css/style.css">
  <style>

    .profile-section {
      padding: 20px;
      border-bottom: 1px solid #ccc;
    }
    .profile-img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      margin-bottom: 10px;
    }
    .main-content {
      overflow-y: auto; /* Display scrollbar when content exceeds height */
    }
    /* Offcanvas styling */
   
  .vertical-bar::-webkit-scrollbar {
  width: 0px;  /* Remove scrollbar space */
  background: transparent;  /* Optional: just make scrollbar invisible */
}
.blog-overflow::-webkit-scrollbar{
  width:0;
  background:transparent;
}
  </style>
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
</head>
<body class="vertical-bar">
<nav class="navbar text-bg-dark py-4 border-bottom">
            <div class="container">
                <div class="home-icon fs-5">
                    <i class="fa-solid fa-bars d-xxl-none d-xl-none d-lg-none d-inline" onclick="toggleUserMenu()"></i>
                    <i class="fa-solid fa-house mx-3 "></i>
                   
                </div>
            <div class="nav-menu fs-5 d-flex" style="gap:15px">
                <i class="fa-solid fa-bell"></i>
                <i class="fa-solid fa-user"></i>
              
                <i class="fa-solid fa-square-plus" onclick="location.href='/user/businessman/dashboard/form/add-blog.php'"></i>
              
                <i class="fa-solid fa-square-plus" data-bs-target="#setUserNamePromptModal" data-bs-toggle="modal"></i>
                
            </div>
            </div>
</nav>
<div class="d-flex">
  <div class="col-xxl-2 col-lg-3 col-md-5 col-sm-7 col-9 sidebar-container d-xxl-block d-xl-block d-lg-none  d-none position-fixed" >
            <div class="bg-dark text-light vertical-bar col-12" style="min-height:calc(100vh - 102px);margin-top:100px" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                <div class="offcanvas-body pt-5">
                    <div class="sidebar d-flex flex-column align-items-center">
                        <div class="profile-container">
                            <div class="profile-image d-flex flex-column justify-content-center align-items-center">
                                <img src="<?php if(isset($profile_img)) echo $profile_img; else "/asset/image/user/profile.png"; ?>" style="height:100px;width:100px;" class="rounded-circle " alt="">
                                <span class="text-white fs-4 fw-semibold"><?php if(isset($name)) echo $name ?></span>
                                <a href="/user/businessman/dashboard/form/edit-profile.php" class="nav-link text-warning d-block text-center mt-1">Edit Profile</a>
                            </div>
                        </div>
                        <ul class="verticle-menu list-unstyled fs-5 mt-5">
    <li class="list-item mt-3"><a href="#" class="nav-link" data-menu-item-id="dashboard"><i class="fas fa-tachometer-alt"></i> &nbsp; Dashboard</a></li>
    <li class="list-item mt-3"><a href="#" class="nav-link" data-menu-item-id="account"><i class="fa-regular fa-address-card"></i> &nbsp; Account</a></li>
    <li class="list-item mt-3"><a href="#" class="nav-link" data-menu-item-id="notification"><i class="fa-solid fa-bell"></i> &nbsp; Notification</a></li>
    <li class="list-item mt-3"><a href="#" class="nav-link" data-menu-item-id="blog"><i class="fa-solid fa-camera-retro"></i> &nbsp; Blog</a></li>
    <li class="list-item mt-3"><a href="#" class="nav-link" data-menu-item-id="create"><i class="fa-regular fa-square-plus"></i> &nbsp; Create</a></li>
    <li class="list-item mt-3"><a href="#" class="nav-link" data-menu-item-id="search"><i class="fa-solid fa-magnifying-glass"></i> &nbsp; Search</a></li>
    <li class="list-item mt-3"><a href="#" class="nav-link" data-menu-item-id="setting"><i class="fa-solid fa-gear"></i> &nbsp; Setting</a></li>
    <li class="list-item mt-3"><a href="#" class="nav-link" data-menu-item-id="logout"><i class="fa-solid fa-right-from-bracket"></i> &nbsp; Logout</a></li>
</ul>

                    </div>
                </div>
              
            </div>
  </div>
  <div class="col offset-xxl-2 offset-xl-3 offset-0 d-flex flex-column vertical-bar p-1 menu-content" style="max-height:calc(100vh - 102px);margin-top:100px">
    
  <script>
    // JavaScript code to handle menu clicks and load content dynamically
    document.addEventListener('DOMContentLoaded', function() {
        const menuItems = document.querySelectorAll('.nav-link');
        
        menuItems.forEach(item => {
            item.addEventListener('click', function() {
                const menuItemId = this.dataset.menuItemId;
                loadContent(menuItemId);
            });
        });
        
        function loadContent(menuItemId) {
            // Send AJAX request to server to fetch content
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_content.php?menuItemId=' + menuItemId, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        document.querySelector('.menu-content').innerHTML = xhr.responseText;
                    } else {
                        // console.log('Error fetching content');
                    }
                }
            };
            xhr.send();
        }
    });
</script>

    
</div>

          </div>
          <script>
        var blogDescription = document.getElementById('blog-description<?php echo $unique_identifier; ?>');
        
        var paragraphText = blogDescription.textContent.trim();
        var maxLength = 150;

        if (paragraphText.length > maxLength) {
            var shortText = paragraphText.substring(0, maxLength);
            var remainingText = paragraphText.substring(maxLength);
            
            blogDescription.innerHTML = shortText + '<span id="remaining-text<?php echo $unique_identifier; ?>" style="display:none;">' + remainingText + '</span>' + ' <button class="border-0 bg-light  text-primary mx-1" onclick="toggleText(\'<?php echo $unique_identifier; ?>\')" id="read-more-btn<?php echo $unique_identifier; ?>" style="text-decoration:underline;font-weight:500;background:transparent !important;">Read More</button>';
            
            function toggleText(unique_identifier) {
                var remainingTextSpan = document.getElementById('remaining-text' + unique_identifier);
                var readMoreBtn = document.getElementById('read-more-btn' + unique_identifier);
                console.log(readMoreBtn);
                if (readMoreBtn.innerHTML == "Read More") {
                    remainingTextSpan.style.display = 'inline';
                    readMoreBtn.innerHTML = 'Read Less';
                } else {
                    remainingTextSpan.style.display = 'none';
                    readMoreBtn.innerHTML = 'Read More';
                }
            }
        }
    </script>
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
  // Toggle offcanvas function
  function toggleOffcanvas() {
    var offcanvas = document.getElementById('offcanvasWithBothOptions');
    offcanvas.classList.toggle('show');
  }
</script>
<script>
    // Function to activate the clicked card
    function activateCard(card) {
        // Deactivate all other cards
        document.querySelectorAll('.card').forEach(function(item) {
            item.classList.remove('active');
        });
        // Activate the clicked card
        card.classList.add('active');
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
    function copyLink() {
        // Initialize Clipboard.js
        new ClipboardJS('.copy-link');
        var copy_links = document.querySelectorAll('.copy-link');
var copyNotification = document.getElementById('copyNotification');

for (var i = 0; i < copy_links.length; i++) {
    copy_links[i].addEventListener('click', function () {
        // Reset all links to black
        for (var j = 0; j < copy_links.length; j++) {
            copy_links[j].style.color = 'black';
        }
        // Set the clicked link to blue
        this.style.color = 'royalblue';

        // Copy the link to the clipboard
        var textToCopy = this.getAttribute('data-clipboard-text');
    });
}
}
</script>
 
<script>
                        var animation = bodymovin.loadAnimation({
                            container : document.getElementById('animation container'),
                            loop:false,
                            autoplay:true,
                            rendor:'svg',
                            path:"/asset/animation/success.json",
                            name:"demo animation",
                            background:"transparent"
                        })
                    </script>
                    <!-- Your JavaScript code -->
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
                    console.log(response);
                    if (response === "success") {
                        // Animation
                        var animation = bodymovin.loadAnimation({
                            container : document.getElementById('animation-container'),
                            loop: false,
                            autoplay: true,
                            renderer: 'svg',
                            path: "/asset/animation/success.json",
                            name: "demo animation",
                            background: "transparent"
                        });

                        // Show the modal
                        $('#exampleModalToggle').modal('show');
                    } else {
                        // Handle other responses or actions if needed
                    }
                }
            });
        });
    });
</script>


</body>
</html>
