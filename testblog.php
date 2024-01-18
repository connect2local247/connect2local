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
                            <span class="user-name fw-bold">bhavesh_1724</span>
                        </div>
                        <i class="fa-solid fa-ellipsis-vertical" data-bs-target="#blogDetailModal" data-bs-toggle="modal"></i>
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
                                <ul class="nav">
                                    <li class="item d-flex flex-column align-items-center" style="font-size:13px">
                                        <i class="fa-regular fa-heart fs-5 mx-2 blog-interaction-icons"></i>
                                        <span class="interaction-count">100</span>
                                    </li>
                                    <li class="item d-flex flex-column align-items-center" style="font-size:13px">
                                        <i class="fa-regular fa-comment fs-5 mx-2 blog-interaction-icons"></i>
                                        <span class="interaction-count">10</span>
                                    </li>
                                    <li class="item d-flex flex-column align-items-center" style="font-size:13px">
                                        <i class="fa-regular fa-share-from-square fs-5 mx-2 blog-interaction-icons"></i>
                                    </li>
                                </ul>
                            </div>
                            <div class="visiting-link">
                                    <i class="fa-solid fa-link fs-5 blog-interaction-icons"></i>
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                        <div class="holded-text text-secondary">
                            Description
                        </div>
                        <p class="blog-description-content mt-1" style="text-align:justify">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum voluptate ratione nam accusamus id vel tempora quisquam dolorem eius consequatur. 
                        </p>
                        <button class="btn btn-primary">Read More</button>

                        <div class="blog-detail">
                            <i class="text-secondary" style="font-size:14px">Posted on January 17, 2023 by Bhavesh Parmar </i>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>