<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect2Local - About Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/asset/css/style.css">
    <?php include "../../asset/link/cdn-link.html";?>

    <style>
        section.intro-content{
            background:linear-gradient(rgba(4, 1, 22, 0.725), rgba(0, 15, 8, 0.73)),
    url("/asset/image/background/about-bg.jpg") no-repeat;
            background-size:100% 100%;
        }
    </style>
</head>
<body id="home-body" class='text-white'>
    
    <header>
            <?php
                include "../../component/navbar.php";
            ?> 
    </header>
    <section class="intro-content" >
        <div class="container d-flex justify-content-center align-items-center text-white" style="width:100%;height:calc(100vh - 80px);s">
            <div class="row">
            <div class="col-lg-6 col-md-8 col-12">
    <h1 class="text-lg-start text-md-start text-center">About Us</h1>
    <p style="text-align:justify;font-size:17px;">
        Welcome to Connect2Local, your trusted platform for discovering and connecting with businesses in your local community. At Connect2Local, we believe in the power of local businesses to enrich our lives and strengthen our communities. Our mission is to provide a seamless experience for users to explore a wide range of businesses, from local favorites to hidden gems, all in one convenient location.
    </p>
</div>

            </div>
        </div>
    </section>
    <section class="container about-us my-4">
          
            <div class="row my-4">
                <div class="col-lg-6 col-md-6 col-12 g-3" style="">
                        <img src="/asset/image/webpage/home-content2.jpg" class="d-flex mx-auto border rounded-2 shadow body-teriatory" style="background:linear-gradient(rgba(0, 98, 255, 0.469), rgba(0, 27, 159, 0.469))!important;height:100%;width:90%;">
                </div>
                <div class="col-lg-6 col-md-6 col-12 text-xs-center g-3">
                        <h1 class="h4 fw-bold text-white my-2">What is Connect2Local ?</h1>
                        <p class="text-white fs-5" style="text-align:justify">Welcome to Connect2Local, your go-to hub for discovering and supporting businesses in Kadi, India. We've crafted a user-friendly business directory where local establishments can connect with residents effortlessly. With features like blogging and social media integration, businesses can effortlessly showcase what they offer. Join us in building a stronger local community where businesses thrive and customers discover the best of what Kadi has to offer. Explore, connect, and support local with Connect2Local!</p>
                </div>
            </div>
            <div class="row my-5 d-flex flex-lg-reverse">
    <!-- Image first on small screens, content second on small screens -->
    <div class="col-lg-6 col-md-6 col-12 order-lg-last g-3">
        <img src="/asset/image/webpage/home-content1.jpg" class="d-flex m-auto border rounded-2 shadow body-teriatory" style="background:linear-gradient(rgba(0, 98, 255, 0.469), rgba(0, 27, 159, 0.469))!important;height:100%;width:90%;">
    </div>
    <div class="col-lg-6 col-md-6 col-12 order-lg-first g-3">
        <h1 class="h4 fw-bold text-white my-2">Why choose Connect2Local?</h1>
        <p class="text-white fs-5" style="text-align:justify;width:100%">Connect2Local offers a unique solution to the problem faced by digital marketers and businesses: providing clickable and shareable links to their products within blog posts. With Connect2Local, businesses can seamlessly integrate links to their products or services directly into their blog posts, making it easier for potential customers to discover and purchase their offerings. This innovative feature sets Connect2Local apart from other platforms and empowers businesses to effectively promote their products while engaging with their audience through valuable content.</p>
    </div>
</div>




<div class="row my-5">
    <!-- Image first on smaller screens -->
    <div class="col-lg-6 col-md-6 col-12 order-lg-first g-3">
        <img src="/asset/image/background/about-bg1.jpg" class="d-flex m-auto border rounded-2 shadow body-teriatory" style="background:linear-gradient(rgba(0, 98, 255, 0.469), rgba(0, 27, 159, 0.469))!important;height:100%;width:90%;">
    </div>
    <!-- Content second on smaller screens -->
    <div class="col-lg-6 col-md-6 col-12 order-md-first g-3">
        <h1 class="h4 fw-bold text-white my-2">What does Connect2Local offer?</h1>
        <p class="text-white fs-5" style="text-align:justify;width:90%">
            Connect2Local provides:
            <ul class="fs-5 d-flex flex-column" style="gap:10px">
                <li>Searches across diverse business categories</li>
                <li>Blogging for businesses</li>
                <li>Addition of businesses in various categories</li>
                <li>Clickable, shareable links within blog posts</li>
                <li>Help and support for businesses and users</li>
                <li>Option to report or block inappropriate content</li>
            </ul>
        </p>
    </div>
</div>


</div>

        </section>
        <section class="team-member">
    <div class="container">
        <fieldset class="border text-center p-2">
            <h1 class="h2 fw-bold text-center my-4">Meet Our Team</h1>
            <p class="w-75 m-auto">Meet Bhavesh and Het, our dedicated team members who have contributed to building our platform.</p>
            <div class="row">
                <div class="offset-lg-1 col-lg-4 col-md-5 offset-md-1 offset-1 col-10 g-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-center">
                            <img src="/asset/image/webpage/Bhavesh.png" class="rounded" alt="" style="width:90%;height:300px;">
                        </div>
                        <div class="card-body d-flex flex-column text-center" style="gap:5px;">
                            <div class="content d-flex flex-column">
                                <h1 class="h5 fw-bold text-center">Bhavesh Parmar</h1>
                            </div>
                            <div class="content">
                                <p>I'm Bhavesh. I've helped develop our platform, focusing on user experience and functionality.</p>
                            </div>
                            <ul class="list-unstyled">
                                <li class="nav-item"></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="offset-lg-2 col-lg-4  col-md-5 offset-1 col-10 g-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-center">
                            <img src="/asset/image/webpage/het.png" class="rounded" alt="" style="width:90%;height:300px;">
                        </div>
                        <div class="card-body d-flex flex-column text-center" style="gap:5px;">
                            <div class="content d-flex flex-column">
                                <h1 class="h5 fw-bold text-center">Het Nayak</h1>
                            </div>
                            <div class="content">
                                <p>I'm Het. I lead analysis and testing, ensuring our platform meets high standards.</p>
                            </div>
                            <ul class="list-unstyled">
                                <li class="nav-item"></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
</section>


    

            <?php
                    include "../../component/footer.php";
            ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>