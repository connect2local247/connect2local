<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include "./asset/link/cdn-link.html"; ?>
    <style>
        .collapsed-content {
            display: none;
        }
    </style>
</head>
<body style="height:100vh;width:100%" class="d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="card col-lg-4 col-md-5 col-12 text-bg-dark">
                <div class="card-content">
                    <div class="card-header border-bottom border-secondary">
                        <img src="/asset/image/user/businessman.png" class="bg-light p-1 rounded-circle" style="height:50px;width:50px" alt="">
                        <span class="ms-2 fs-5">bhavesh_1724</span>
                    </div>
                    <div class="card-body">
                            <div class="card-img">
                                    <img src="/asset/image/background/home-bg.jpg" style="height:100%;width:100%" class="rounded-2 mb-2" alt="">
                            </div>
                            <div class="option d-flex justify-content-between align-items-center">
                                    <ul class="nav d-flex ms-2" style="gap:15px">
                                        <li class="blog-option nav-item fs-5"><i class="fa-regular fa-thumbs-up"></i> <span class="count fs-5">10</span></li>
                                        <li class="blog-option nav-item fs-5"><i class="fa-regular fa-comment"></i> <span class="count fs-5">5</span></li>
                                        <li class="blog-option nav-item fs-5"><i class="fa-solid fa-share"></i> <span class="count fs-5"></span></li>
                                    </ul>
                                    
                            </div>
                    </div>
                    <div class="card-footer border-top border-secondary position-relative">
                    <span class="description text-secondary">
                        Description
                    </span>
                    <p class="content my-2" style="text-align: justify" id="blogContent">
                        <!-- Your initial content goes here -->
                        In the dynamic realm of business, a proficient business consultant serves as a strategic navigator, offering invaluable insights and solutions. With a keen understanding of market trends and organizational intricacies, they meticulously analyze operations, identify bottlenecks, and prescribe tailored strategies to optimize efficiency and foster growth. Armed with a diverse toolkit of industry knowledge, these consultants function as catalysts for positive change, steering businesses towards sustainable success. Whether it's streamlining processes, enhancing employee engagement, or crafting innovative market entry plans, a skilled business consultant is the linchpin for companies aspiring to navigate the complexities of the corporate landscape with finesse and foresight.
                        <span class="collapsed-content" style="display: none;"></span>
                    </p>
                    <button onclick="toggleReadMore()" id="readMoreBtn" class="btn btn-link" style="display:none;">Read More</button>
                    <div class="info text-secondary border-top border-secondary px-2">
                        Posted on <i>January 1, 2023</i> by Bhavesh Parmar
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var content = document.getElementById('blogContent');
        var collapsedContent = content.querySelector('.collapsed-content');
        var readMoreBtn = document.getElementById('readMoreBtn');

        // Check content length
        if (content.innerText.length > 450) {
            readMoreBtn.style.display = 'inline';
            collapsedContent.innerText = content.innerText.substring(450);
            content.innerText = content.innerText.substring(0, 450);
        }

        function toggleReadMore() {
            if (collapsedContent.style.display === 'none') {
                collapsedContent.style.display = 'inline';
                readMoreBtn.innerText = 'Read Less';
            } else {
                collapsedContent.style.display = 'none';
                readMoreBtn.innerText = 'Read More';
            }
        }
    </script>
</body>
</html>