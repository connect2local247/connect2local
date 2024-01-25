<?php
session_start();

if (!isset($_SESSION['link-array'])) {
    $_SESSION['link-array'] = array();
}

if (isset($_POST['link-submit'])) {
    $link_title = $_POST['link-title'];
    $link_url = $_POST['link-url'];

    $link_container = [
        "title" => "$link_title",
        "url" =>  "$link_url"
    ];

    array_push($_SESSION['link-array'], $link_container);
}

if (isset($_POST['delete-link'])) {
    $index = $_POST['delete-link'];
    if (isset($_SESSION['link-array'][$index])) {
        unset($_SESSION['link-array'][$index]);
    }
}

// Print the session array for debugging
print_r($_SESSION['link-array']);
?>
<!-- Rest of your HTML code -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Blog</title>
    <?php include "../../../../asset/link/cdn-link.html"; ?>
</head>
<body class="text-bg-dark">
    <script>
        path = "/user/businessman/dashboard/dashboard.php";
    </script>
     <div>
        <h2>Session Values:</h2>
        <?php
        // Print link-array session values
        if (isset($_SESSION['link-array'])) {
            echo '<pre>';
            print_r($_SESSION['link-array']);
            echo '</pre>';
        }
        ?>
    </div>
    <?php
    if (isset($_SESSION['greet-message'])) {
        if (isset($_SESSION['blog-title'])) {
            $_SESSION['blog-title'] = "";
        }
        if (isset($_SESSION['blog-description'])) {
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
                    <h5 class="modal-title" id="linkModalLabel">Add Link <?php if(isset($_SESSION['link-array'])) print_r($_SESSION['link-array']); ?></h5>
                    <i class="fa-solid fa-xmark" data-dismiss="modal" aria-hidden="true"></i>
                </div>
                <form id="linkForm" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="linkTitle">Title:</label>
                            <input type="text" name="link-title" class="form-control" placeholder="Enter title here.." id="linkTitle">
                        </div>
                        <div class="form-group">
                            <label for="linkUrl">URL:</label>
                            <input type="text" name="link-url" class="form-control" placeholder="Paste your URL here.." id="linkUrl">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" name="link-submit" class="btn btn-primary" value="Add Link" id="addLinkBtn">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <form action="/user/businessman/dashboard/code/blog-data-insertion.php" method="post" enctype="multipart/form-data"
            class="add-blog d-flex justify-content-center p-2">
            <fieldset class="border rounded col-lg-6 col-md-8 col-12 p-3 position-relative">
                <legend class="fw-bold text-center h2 my-3">Add Blog</legend>
                <div
                    class="add-link-icon border rounded text-bg-dark bg-gradient shadow p-1 px-2 position-absolute end-0 me-2">
                    <i class="fa-solid fa-plus" data-toggle="modal" data-target="#linkModal" id="#addLinkBtn"></i>
                </div>
                <div class="blog-content-container p-2 d-flex m-auto ">
                    <div
                        class="image-container m-auto border p-2 rounded-2 position-relative">
                        <label for="image-upload" style="cursor: pointer;">
                            <img src="/asset/image/background/blog.png" style="height:150px;width:150px;" alt="">
                            <i
                                class="fa-solid fa-camera position-absolute bottom-0 end-0 fs-5 me-1 mb-1 text-white border p-1 rounded bg-dark"></i>
                        </label>
                        <input type="file" name="image-upload" id="image-upload" style="display:none;">
                    </div>
                </div>
                <div class="mt-5">
                    <input type="text" name="blog-title" id="blog-title" class="form-control" placeholder="Blog Title"
                        value="<?php if (isset($_SESSION['blog-title'])) echo $_SESSION['blog-title']; ?>" required>
                </div>
                <div class="mt-2">
                    <!-- Video input can be added here if needed -->
                </div>
                <div class="mt-2 position-relative">
                    <textarea id="blog-description" name="blog-description"
                        class="form-control position-relative" placeholder="Description"
                        rows="4"><?php if (isset($_SESSION['blog-description'])) echo $_SESSION['blog-description']; ?></textarea>
                    <div id="charCount" class="text-secondary position-absolute bottom-0 end-0 me-2 mb-1">0/1000</div>
                </div>
                <div id="addedLinksContainer" class="mt-3 bg-light p-3 rounded">
    <?php
    // Generate HTML for the added links
    foreach ($_SESSION['link-array'] as $index => $link) {
        echo '<span class="text-bg-dark d-block p-1 shadow d-flex my-1 position-relative" style="gap:10px;text-decoration:none;overflow:hidden" target="_blank">';
        echo '<i class="fa-solid fa-link border-end p-1 mx-1" title="' . $link['title'] . '"></i>';
        echo '<a href="' . $link['url'] . '" class=" nav-link">' . $link['url'] . '</a>';
        echo '<i class="fa-solid fa-xmark border-start position-absolute end-0 p-1 mx-1" onclick="deleteCurrentLink(this, ' . $index . ')"></i>';
        echo '</span>';
    }
    ?>
</div>
                <div class="mt-4 d-flex">
                    <input type="submit" name="submit" class="btn btn-primary px-5 py-2 rounded m-auto" value="Submit">
                </div>
            </fieldset>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
        var linkCount = 0;
        var displayAddedLinksContainer = document.getElementById('addedLinksContainer');
        var linkIndex = 0;
        function deleteCurrentLink(element) {
        // Call the server to delete the link from the session
        $.post('/user/businessman/dashboard/code/delete-link.php', { 'delete-link': index }, function (data) {
            // If successful, hide the link on the client side
            $(element).parent().addClass('d-none');
            linkCount--;

            // Hide the added links container if there are no links
            if (linkCount === 0) {
                displayAddedLinksContainer.style.display = "none";
            }
        });
    }

        $(document).ready(function () {
            var maxChars = 1000;

            var textarea = $('#blog-description');

            textarea.on('input', function () {
                var charCount = $(this).val().length;
                $('#charCount').text(charCount + '/' + maxChars);

                if (charCount >= maxChars) {
                    $(this).addClass('border-danger border-2');
                } else {
                    $(this).removeClass('error');
                    $('.add-link-icon').removeClass('error');
                }
            });

            // Handle Add Link button click
            $('#addLinkBtn').on('click', function () {
                var linkTitle = $('#linkTitle').val();
                var linkUrl = $('#linkUrl').val();

                if (linkUrl != "" && linkTitle != "") {
                    // Create the link HTML
                    var linkHtml = '<span class="text-bg-light d-block p-1 shadow d-flex my-1 position-relative" style="gap:10px;text-decoration:none;overflow:hidden" target="_blank"><i class="fa-solid fa-link border-end p-1 mx-1" title="' + linkTitle + '"></i> <a href="' + linkUrl + '">' + linkUrl + '</a><i class="fa-solid fa-xmark border-start position-absolute end-0 p-1 mx-1" onclick="deleteCurrentLink(this)"></i></span>';




                    // Display the added link below the textarea
                    displayAddedLinksContainer.style.display = "block";
                    $('#addedLinksContainer').append(linkHtml);
                    linkCount++;
                    console.log(linkCount);
                    // Clear the input fields
                    $('#linkTitle').val('');
                    $('#linkUrl').val('');
                } else {
                    alert("Can't be Empty Link Title and URL");
                }

            });


        });
    </script>
</body>

</html>
