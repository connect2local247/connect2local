<?php
include "../../../modules/search/search-business.php";

function fetchSuggestedBlogs($current_user_id) {
    // Query to fetch suggested blogs
    $sql = "SELECT blg_title, blg_content_url, blg_content_type 
            FROM blog_data 
            WHERE bp_user_id != '$current_user_id' 
            AND NOT EXISTS (
                SELECT 1 
                FROM blocked_user_data 
                WHERE bu_user_id = '$current_user_id' 
                AND bu_business_id = blog_data.bp_user_id
            )
            AND blg_content_type LIKE 'video%' 
            ORDER BY RAND() 
            LIMIT 9";
    $result = mysqli_query($GLOBALS['connect'], $sql);

    $blogs = array(); // Array to store suggested blog titles and content

    if (mysqli_num_rows($result) > 0) {
        // Output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            $blog_title = $row["blg_title"];
            $content_url = $row["blg_content_url"];
            $content_type = $row['blg_content_type'];
            $blogs[] = array("title" => $blog_title, "content_url" => $content_url, "content_type" => $content_type);
        }
    } else {
        $blogs[] = array("title" => "No Suggested Blog Found", "content_url" => "", "content_type" => "");
    }

    return $blogs;
}

function fetchUserBlogs($current_user_id) {
    // Query to fetch the current user's blogs
    $sql = "SELECT blg_title, blg_content_url, blg_content_type 
            FROM blog_data 
            WHERE bp_user_id = '$current_user_id'";
    $result = mysqli_query($GLOBALS['connect'], $sql);

    $blogs = array(); // Array to store user's blog titles and content

    if (mysqli_num_rows($result) > 0) {
        // Output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            $blog_title = $row["blg_title"];
            $content_url = $row["blg_content_url"];
            $content_type = $row['blg_content_type'];
            $blogs[] = array("title" => $blog_title, "content_url" => $content_url, "content_type" => $content_type);
        }
    }

    return $blogs;
}

function fetchNewBlogs($current_user_id, $limit) {
    // Query to fetch new blogs from other users
    $sql = "SELECT blg_title, blg_content_url, blg_content_type 
            FROM blog_data 
            WHERE bp_user_id != '$current_user_id' 
            AND NOT EXISTS (
                SELECT 1 
                FROM blocked_user_data 
                WHERE bu_user_id = '$current_user_id' 
                AND bu_business_id = blog_data.bp_user_id
            )
            ORDER BY blg_id DESC 
            LIMIT $limit";
    $result = mysqli_query($GLOBALS['connect'], $sql);

    $blogs = array(); // Array to store new blogs titles and content

    if (mysqli_num_rows($result) > 0) {
        // Output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            $blog_title = $row["blg_title"];
            $content_url = $row["blg_content_url"];
            $content_type = $row['blg_content_type'];
            $blogs[] = array("title" => $blog_title, "content_url" => $content_url, "content_type" => $content_type);
        }
    }

    return $blogs;
}

function fetchTopBlogs($current_user_id, $limit) {
    // Query to fetch top blogs based on like count
    $sql = "SELECT blg_title, blg_content_url, blg_content_type 
            FROM blog_data 
            WHERE bp_user_id != '$current_user_id' 
            AND NOT EXISTS (
                SELECT 1 
                FROM blocked_user_data 
                WHERE bu_user_id = '$current_user_id' 
                AND bu_business_id = blog_data.bp_user_id
            )
            ORDER BY blg_like_count DESC 
            LIMIT $limit";
    $result = mysqli_query($GLOBALS['connect'], $sql);

    $blogs = array(); // Array to store top blogs titles and content

    if (mysqli_num_rows($result) > 0) {
        // Output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            $blog_title = $row["blg_title"];
            $content_url = $row["blg_content_url"];
            $content_type = $row['blg_content_type'];
            $blogs[] = array("title" => $blog_title, "content_url" => $content_url, "content_type" => $content_type);
        }
    }

    return $blogs;
}

// Fetch suggested blogs
$current_user_id = $_SESSION['current_user'];
$suggestedBlogs = fetchSuggestedBlogs($current_user_id);

// Fetch user's blogs
$userBlogs = fetchUserBlogs($current_user_id);

// Fetch new blogs from other users
$newBlogs = fetchNewBlogs($current_user_id, 9);

// Fetch top blogs based on like count
$topBlogs = fetchTopBlogs($current_user_id, 3);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Categories</title>
    <!-- Bootstrap CSS is already present in the system -->
    <style>
        .content-box {
            width: 100%;
            height: 200px;
            position: relative;
            overflow: hidden;
        }

        .content img,
        .content video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .blog-title {
            text-align: center;
            margin-top: 10px;
            font-size: 1rem;
        }

        @media(min-width:576px){
            .swiper-size{
                width:45% !important;
            }
        }

        @media(min-width:992px){
            .swiper-size{
                width:32% !important;
            }
        }
    </style>
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
</head>
<body>
<div class="container">
<?php if(empty($newBlogs) && empty($topBlogs)) :?>
    <div class="default-info d-flex flex-column m-auto text-center py-2 text-white">
        <i class="fa-solid fa-camera" style="font-size:8rem;"></i>
        <span class="fs-1 fw-bold">No Blog Available</span> 
    </div>
<?php endif; ?>
    <div class="row">
        <div class="col">
        <!-- <span class="fs-4 fw-semibold d-block my-3 ps-3">Your Blogs</span>
<div class="swiper-container overflow-scroll vertical-bar" style="max-width:90vw">
    <div class="swiper-wrapper border border-dark">
        <?php foreach ($userBlogs as $blog): ?>
            <div class="swiper-slide border border-primary swiper-size">
                <div class="card border border-success col-12">
                    <div class="card-body border border-danger">
                        <div class="content-box">
                            <?php if (!empty($blog['content_url'])): ?>
                                <object data="/database/data/blog/content/<?php echo $blog['content_url']; ?>" type="<?php echo $blog['content_type']; ?>" width="100%" height="100%" class="h-100 w-100" id="videoObject_<?php echo $blog['content_url']; ?>">
                                    <p>Your browser doesn't support HTML5 video. Here is a <a href="/database/data/blog/content/<?php echo $blog['content_url']; ?>">link to the video</a> instead.</p>
                                </object>
                            <?php else: ?>
                                <p class="text-center">Content not available</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="blog-title"><?php echo $blog['title']; ?></div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div> -->
            <!-- Display new blogs from other users -->
            <?php if(!empty($newBlogs)): ?>
                <span class="fs-4 fw-semibold d-block my-3 ps-3">New Blogs</span>
                <?php endif; ?>
            <div class="swiper-container overflow-scroll vertical-bar" style="max-width:90vw">
                <div class="swiper-wrapper border border-dark">
                    <?php foreach ($newBlogs as $blog): ?>
                        <div class="swiper-slide border border-primary swiper-size">
                            <div class="card border border-success col-12">
                                <div class="card-body border border-danger">
                                    <div class="content-box">
                                        <?php if (!empty($blog['content_url'])): ?>
                                            <object data="/database/data/blog/content/<?php echo $blog['content_url']; ?>" type="<?php echo $blog['content_type']; ?>" width="100%" height="100%" class="h-100 w-100" id="videoObject_<?php echo $blog['content_url']; ?>">
                                                <p>Your browser doesn't support HTML5 video. Here is a <a href="/database/data/blog/content/<?php echo $blog['content_url']; ?>">link to the video</a> instead.</p>
                                            </object>
                                        <?php else: ?>
                                            <p class="text-center">Content not available</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="blog-title"><?php echo $blog['title']; ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <!-- Display suggested blogs -->
            <!-- <span class="fs-4 fw-semibold d-block my-3 ps-3">Suggested Blogs</span>
            <div class="swiper-container overflow-scroll vertical-bar" style="max-width:90vw">
                <div class="swiper-wrapper border border-dark">
                    <?php foreach ($suggestedBlogs as $blog): ?>
                        <div class="swiper-slide border border-primary swiper-size">
                            <div class="card border border-success col-12">
                                <div class="card-body border border-danger">
                                    <div class="content-box">
                                        <?php if (!empty($blog['content_url'])): ?>
                                            <object data="/database/data/blog/content/<?php echo $blog['content_url']; ?>" type="<?php echo $blog['content_type']; ?>" width="100%" height="100%" class="h-100 w-100" id="videoObject_<?php echo $blog['content_url']; ?>">
                                                <p>Your browser doesn't support HTML5 video. Here is a <a href="/database/data/blog/content/<?php echo $blog['content_url']; ?>">link to the video</a> instead.</p>
                                            </object>
                                        <?php else: ?>
                                            <p class="text-center">Content not available</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="blog-title"><?php echo $blog['title']; ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
             -->
            <!-- Display user's blogs -->
            <?php if (!empty($userBlogs)): ?>
            <span class="fs-4 fw-semibold d-block my-3 ps-3">Your Blogs</span>
            <div class="swiper-container overflow-scroll vertical-bar" style="max-width:90vw">
                <div class="swiper-wrapper border border-dark">
                    <?php foreach ($userBlogs as $blog): ?>
                        <div class="swiper-slide border border-primary swiper-size">
                            <div class="card border border-success col-12">
                                <div class="card-body border border-danger">
                                    <div class="content-box">
                                        <?php if (!empty($blog['content_url'])): ?>
                                            <object data="/database/data/blog/content/<?php echo $blog['content_url']; ?>" type="<?php echo $blog['content_type']; ?>" width="100%" height="100%" class="h-100 w-100" id="videoObject_<?php echo $blog['content_url']; ?>">
                                                <p>Your browser doesn't support HTML5 video. Here is a <a href="/database/data/blog/content/<?php echo $blog['content_url']; ?>">link to the video</a> instead.</p>
                                            </object>
                                        <?php else: ?>
                                            <p class="text-center">Content not available</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="blog-title"><?php echo $blog['title']; ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <?php endif; ?>


            <!-- Display top blogs based on like count -->
            <?php if(!empty($topBlogs)): ?>
            <span class="fs-4 fw-semibold d-block my-3 ps-3">Top Blogs</span>
            <?php endif; ?>
            <div class="swiper-container overflow-scroll vertical-bar" style="max-width:90vw">
                <div class="swiper-wrapper border border-dark">
                    <?php foreach ($topBlogs as $blog): ?>
                        <div class="swiper-slide border border-primary swiper-size">
                            <div class="card border border-success col-12">
                                <div class="card-body border border-danger">
                                    <div class="content-box">
                                        <?php if (!empty($blog['content_url'])): ?>
                                            <object data="/database/data/blog/content/<?php echo $blog['content_url']; ?>" type="<?php echo $blog['content_type']; ?>" width="100%" height="100%" class="h-100 w-100" id="videoObject_<?php echo $blog['content_url']; ?>">
                                                <p>Your browser doesn't support HTML5 video. Here is a <a href="/database/data/blog/content/<?php echo $blog['content_url']; ?>">link to the video</a> instead.</p>
                                            </object>
                                        <?php else: ?>
                                            <p class="text-center">Content not available</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="blog-title"><?php echo $blog['title']; ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</div>
<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var swipers = document.querySelectorAll('.swiper-container');
        swipers.forEach(function (swiper) {
            new Swiper(swiper, {
                slidesPerView: 'auto',
                spaceBetween: 20,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        });
    });
</script>

</body>
</html>
