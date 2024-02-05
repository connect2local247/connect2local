<?php 
            include "./includes/table_query/db_connection.php";
            require "./includes/table_query/get_data_query.php";
            include "./includes/blog_function/time_function.php";

            $blog_id = ""; 
            if(isset($_GET['blog_id'])){
                $blog_id = $_GET['blog_id'];
                $get_blog_data_query = "SELECT * FROM blog_data WHERE BLG_ID = '$blog_id' ";

                $result = mysqli_query($GLOBALS['connect'],$get_blog_data_query);

                if(mysqli_num_rows(($result))){
                    $row = mysqli_fetch_assoc($result);

                    $title = $row['BLG_TITLE'];
                    $description = $row['BLG_DESCRIPT'];
                    $username = $row['BLG_USERNAME'];
                    $user_image = $row['BLG_USER_IMG_URL'];
                    $content_url = $row['BLG_CONTENT_URL'];
                    $content_size = $row['BLG_CONTENT_SIZE'];
                    $content_type = $row['BLG_CONTENT_TYPE'];
                    $category = $row['BLG_CATEGORY'];
                    $like_count = $row['BLG_LIKE_COUNT'];
                    $comment_count = $row['BLG_COMMENT_COUNT'];
                    $blogger_profile = $row['BLGR_PROFILE_URL'];
                    $blogger_name = $row['BLG_AUTHOR_NAME'];
                    $share_link = $row['BLG_SHARE_LINK'];
                    $release_date = $row['BLG_RELEASE_DATE'];
                    $update_date = $row['BLG_UPDATE_TIME'];
                    $user_id = $row['USER_ID'];
                
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include "./asset/link/cdn-link.html"; ?>
    <link rel="stylesheet" href="/asset/css/style.css">
</head>
<body>
    <div class="container">
        <div class="card col-lg-3 col-md-5 col-12 border-0">
            <div class="card-content border border-dark rounded shadow position-relative">
                <div class="card-header d-flex justify-content-between px-3 align-items-center position-relative">
                        <div class="user-data d-flex align-items-center " style="gap:10px">
                            <?php 
                                    if($user_image != "" || $user_image != NULL){

                            ?>
                            <img src="<?php echo $user_image;?>" alt="user image" style="height:50px;width:50px" class="rounded-circle bg-light">
                            <?php
                                    } else {
                            ?>
                                    <img src="/asset/image/user/profile.png" alt="user image" style="height:50px;width:50px" class="rounded-circle bg-light">
                            <?php
                                 }
                            ?>
                            <span class="user-name fw-bold">@<?php echo $username; ?></span>
                           
                            <div class="blog-option-container position-absolute top-0 end-0 mt-5 border me-1 text-bg-light p-2 rounded d-none" style="width:70%"id="blogDetailPopup" >
                            <ul class="list-unstyled text-center" >
                                <li class="list-item mt-2 shadow border p-2 rounded d-flex align-items-center justify-content-center"><i class="fa-solid fa-circle-info"></i>&nbsp;Info</li>
                                <li class="list-item mt-2 shadow border p-2 rounded d-flex align-items-center justify-content-center"> <i class="fa-solid fa-floppy-disk fs-4"></i>&nbsp;Save</li>
                                <li class="list-item mt-2 shadow border p-2 rounded d-flex align-items-center justify-content-center"><i class="fa-solid fa-ban"></i>&nbsp;Block</li>
                                <li class="list-item mt-2 shadow border p-2 rounded d-flex align-items-center justify-content-center text-danger">&nbsp;Report</li>
                                <li class="list-item"></li>
                            </ul>
                        </div>
                        </div>
                        <script>
                            blogDetail = document.getElementById('blogDetailPopup');
                            
                            function toggleBlogPopUp(){
                                blogDetail.classList.toggle('d-none');
                            }
                        </script>
                        <i class="fa-solid fa-ellipsis-vertical px-3 py-2" onclick="toggleBlogPopUp()"></i>
                        <?php //include "./component/blog-modal.php"; ?>
                        
                </div>
                <div class="card-body d-flex flex-column justify-content-center">
                        <div class="content">
                            <?php
                                    if (isset($content_type) && isset($content_url) && isset($title)) {
                                        if (strpos($content_type, "image") !== false) {
                                    ?>
                                            <img src="/database/data/blog/content/<?php echo $content_url ?>" class="rounded-2" style="height:100%;width:100%;" alt="<?php echo $title ?>">
                                    <?php
                                        } else {
                                    ?>
                                            <video class="rounded-2" style="height:100%;width:100%;" controls>
                                                <source src="/database/data/blog/content/<?php echo $content_url; ?>" type="<?php echo $content_type ?>">
                                            </video>
                                    <?php
                                        }
                                    } else{
                                        echo "Content not available";
                                    }
                            ?>

                        </div>
                        <div class="interaction-option  d-flex justify-content-between px-1  py-2 rounded">
                            <div class="interaction-icon">
                                <ul class="nav" style="gap:10px">
                                    <li class="item d-flex flex-column align-items-center" style="font-size:13px">
                                        <i class="fa-regular fa-heart fs-5 mx-2 blog-interaction-icons"></i>
                                        <?php 
                                            if($like_count != 0){
                                        ?>
                                            <span class="interaction-count"><?php echo $like_count ?></span>
                                        <?php
                                            } else{
                                        ?>
                                            <span class="interaction-count">Like</span>
                                        <?php
                                            }
                                        ?>
                                    </li>

                                    <?php 
                                            if($comment_count != 0){
                                    ?>
                                    <li class="item d-flex flex-column align-items-center" style="font-size:13px" >
                                        <i class="fa-regular fa-comment fs-5 mx-2 blog-interaction-icons" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#comment-section" 
                                        aria-expanded="false" 
                                        aria-controls="comment-section"></i>
                                        <span class="interaction-count"><?php echo $comment_count ?></span>
                                    </li>
                                    <?php
                                            } else{
                                    ?>
                                    <li class="item d-flex flex-column align-items-center" style="font-size:13px" >
                                        <i class="fa-regular fa-comment fs-5 mx-2 blog-interaction-icons" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#comment-section" 
                                        aria-expanded="false" 
                                        aria-controls="comment-section"></i>
                                        <span class="interaction-count">Comment</span>
                                    </li>
                                    <?php
                                            }
                                    ?>
                                    <li class="item d-flex flex-column align-items-center" style="font-size:13px">
                                        <i class="fa-regular fa-share-from-square fs-5 mx-2 blog-interaction-icons"></i>
                                        <span class="interaction-count">Share</span>
                                    </li>
                                </ul>
                            </div>
                            <?php
// Sample data - You can replace this with your actual data
$links = [
    ['title' => 'Youtube', 'url' => 'https://youtube.com'],
    ['title' => 'Google', 'url' => 'https://google.com'],
    // Add more links as needed
];
?>

<div class="visiting-link">
    <i class="fa-solid fa-link fs-5 blog-interaction-icons"></i>
    <div class="link-container position-absolute top-0 w-100 start-0 text-bg-light border">
        <ul class="list-unstyled p-1">
            <?php foreach ($links as $link) : ?>
                <li class="list-item d-flex align-items-center justify-content-between border rounded" style="height:35px">
                    <i class="fa-solid fa-link border-end px-2 py-1" title="<?php echo $link['url']; ?>"></i>
                    <a href="<?php echo $link['url']; ?>" class="nav-link m-auto" title="<?php echo $link['url']; ?>" target="_blank"><?php echo $link['title']; ?></a>
                    <i class="fa-solid fa-copy border-start px-2 py-1 copy-link" data-clipboard-text="<?php echo $link['url']; ?>" title="Copy"></i>
                    <i class="fa-solid fa-share border-start px-2 py-1 share-link" data-share-url="<?php echo $link['url']; ?>" title="Share"></i>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<!-- Include Clipboard.js library for copy functionality -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
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
        this.style.color = 'blue';

        // Copy the link to the clipboard
        var textToCopy = this.getAttribute('data-clipboard-text');
        navigator.clipboard.writeText(textToCopy).then(function () {
            // Show the notification
            showNotification();
        }).catch(function (err) {
            console.error('Unable to copy text: ', err);
        });
    });
}

function showNotification() {
    // Display the notification
    copyNotification.style.opacity = 1;

    // Hide the notification after a delay
    setTimeout(function () {
        copyNotification.style.opacity = 0;
    }, 1500); // Adjust the delay as needed
}



        // Handle click events for share functionality
        var shareIcons = document.querySelectorAll('.share-link');
        shareIcons.forEach(function (icon) {
            icon.addEventListener('click', function () {
                var shareUrl = this.getAttribute('data-share-url');

                if (navigator.share) {
                    // Use Web Share API if available
                    navigator.share({
                        title: 'Check out this link',
                        text: 'Shared link from your website',
                        url: shareUrl,
                    })
                        .then(() => console.log('Shared successfully'))
                        .catch((error) => console.error('Error sharing:', error));
                } else {
                    // Fallback for browsers that don't support Web Share API
                    alert('Your browser does not support the Web Share API. You can manually share the link.');
                }
            });
        });
    });
</script>

                        </div>

                        <div class="comment-section collapse border-secondary border-top p-2" id="comment-section">
                            <span class="h5">Comments</span>
    <form method="post" class="mt-3">
        <div class="mb-3">
            <textarea class="form-control" name="comment" placeholder="Add a comment..." rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Post</button>
    </form>
    <div class="container reply mt-3">
            <div class="row d-flex position-relative shadow text-bg-light border p-1 rounded-2" style="gap:7px">
                <div class="col-2 border" id="profile-img" style="height:50px">
                    <img src="/asset/image/user/profile.png" style="height:40px;width:40px" class="border rounded-circle" alt="">
                </div>
                <div class="col-9 text-dark" style="font-size:14px">
                    <span class="username fw-bold">@bhavesh_1724</span>
                    <p class="comment-content">
                        Lorem ipsum dolor sit amet.
                    </p>
                </div>
                <div class="comment-interaction">
                    <ul class="d-flex list-unstyled ms-2" style="gap:10px;font-size:12px">
                        <li class="list-item d-flex align-items-center" style="gap:4px">
                            <i class="fa-solid fa-heart "></i>
                            <a class=" mb-1 fw-bold text-dark nav-link" style="font-size:12px;">Like</a>
                        </li>
                        <li class="list-item d-flex align-items-center" style="gap:4px">
                        <i class="fa-solid fa-reply "></i>
                        <a class=" mb-1 fw-bold text-dark nav-link" style="font-size:12px;" >Reply</a>

                        </li>
                        <li class="list-item d-flex align-items-center" style="gap:4px">
                        <a class=" mb-1 fw-bold text-dark nav-link" style="font-size:12px;" >View Reply</a>
                        </li>
                    </ul>
                </div>
                <i class="posted-time position-absolute text-end top-0 align-items-center mt-1" style="font-size:13px;">13 mins ago</i>
            </div>
    </div>
    <!-- Existing comments display logic here -->
</div>

                </div>
                <div class="card-footer">
                        <div class="holded-text text-secondary">
                            Description
                        </div>
                        <p class="blog-description-content mt-1" style="text-align: justify" id="blog-description">
    <?php echo $description; ?> <button class="border-0 text-bg-light mx-1"id="read-more-btn" style="display:none"><u>Read More</u></button>
</p>

<script>
    blogDescription = document.getElementById('blog-description')
    readMoreBtn = document.getElementById('read-more-btn')

    paragraphText = blogDescription.textContent;
    buttonText = readMoreBtn.textContent;
    buttonLength = buttonText.length;

    maxLength = paragraphText.length - buttonLength;
    console.log(buttonText)
    console.log(maxLength)
    console.log();

    
    if(maxLength < 150){
            readMoreBtn.style = "display:none";
    } else{
        var shortText = paragraphText.substring(0,maxLength - 2);
        var remainingText = paragraphText.substring();

        console.log(shortText);
        // console.log(shortText);
        readMoreBtn.style="display:inline";
    }
</script>



                        <div class="blog-detail">
                            <i class="text-secondary" style="font-size:14px">Posted on <?php echo date('F d, Y', strtotime($release_date)); ?> by Bhavesh Parmar </i>
                        </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php
                }
        }
    ?>
</body>
</html>