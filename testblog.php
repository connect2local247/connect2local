<?php 
            include "./includes/table_query/db_connection.php";
            require "./includes/table_query/get_data_query.php";
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
                            <img src="/asset/image/user/customer.png" alt="user image" style="height:50px;width:50px" class="rounded-circle bg-light">
                            <span class="user-name fw-bold">Bhavesh_1724</span>
                        </div>
                        <i class="fa-solid fa-ellipsis-vertical px-3 py-2" data-bs-target="#blogDetailModal" data-bs-toggle="modal"></i>
                        <?php include "./component/blog-modal.php"; ?>
                </div>
                <div class="card-body d-flex flex-column justify-content-center">
                        <div class="content">
                            <!-- <?php
                                // functionality pending for image or video show content as blog
                            ?> -->
                            <img src="/asset/image/background/home-bg.jpg" class="rounded-2" style="height:100%;width:100%;" alt="">
                        </div>
                        <div class="interaction-option  d-flex justify-content-between px-1  py-2 rounded">
                            <div class="interaction-icon">
                                <ul class="nav" style="gap:10px">
                                    <li class="item d-flex flex-column align-items-center" style="font-size:13px">
                                        <i class="fa-regular fa-heart fs-5 mx-2 blog-interaction-icons"></i>
                                        <span class="interaction-count">Like</span>
                                    </li>
                                    <li class="item d-flex flex-column align-items-center" style="font-size:13px" >
                                        <i class="fa-regular fa-comment fs-5 mx-2 blog-interaction-icons" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#comment-section" 
                                        aria-expanded="false" 
                                        aria-controls="comment-section"></i>
                                        <span class="interaction-count">Comment</span>
                                    </li>

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
    <!-- Existing comments display logic here -->
</div>

                </div>
                <div class="card-footer">
                        <div class="holded-text text-secondary">
                            Description
                        </div>
                        <p class="blog-description-content mt-1" style="text-align: justify" id="blog-description">
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi hic magnam sequi ex iusto quae aperiam quo odio fugiat! Labore Lorem ipsum dolor sit. Lorem ipsum dolor, sit amet consectetur adipisicing. <button class="border-0 text-bg-light mx-1"id="read-more-btn" style="display:none"><u>Read More</u></button>
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
                            <i class="text-secondary" style="font-size:14px">Posted on January 17, 2023 by Bhavesh Parmar </i>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>