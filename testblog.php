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
            <div class="card-content border border-dark rounded shadow">
                <div class="card-header d-flex justify-content-between px-3 align-items-center">
                        <div class="user-data d-flex align-items-center" style="gap:10px">
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
                        </div>
                        <i class="fa-solid fa-ellipsis-vertical px-3 py-2" data-bs-target="#blogDetailModal" data-bs-toggle="modal"></i>
                        <?php include "./component/blog-modal.php"; ?>
                </div>
                <div class="card-body d-flex flex-column justify-content-center">
                        <div class="content">
                            <?php

                                    if(strpos($content_type, "image")){
                            ?>
                            <img src="<?php echo $content_url ?>" class="rounded-2" style="height:100%;width:100%;" alt="<?php echo $title ?>">
                            <?php
                                    } else{

                            ?>
                            <video class="rounded-2" style="height:100%;width:100%;" controls>
                                <source src="<?php echo $content_url; ?>" type="<?php echo $content_type ?>">
                            </video>
                            <?php
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
                            <div class="visiting-link">
                                    <i class="fa-solid fa-link fs-5 blog-interaction-icons"></i>
                            </div>
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