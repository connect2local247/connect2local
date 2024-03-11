<?php 
            session_start();
            include "includes/table_query/db_connection.php";
            include "modules/blog/blog-data.php";
            include "component/logout.php";
            // $user_id = "C2LB000003";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect2Local - Home Page</title>
    <link rel="stylesheet" href="/asset/css/style.css">
    <?php
        include "./asset/link/cdn-link.html";
    ?>


</head>
<body id="home-body">
    <?php include "./component/navbar.php";?>  
    <header>    
        <section class="intro d-flex align-items-center p-3 border-bottom border-secondary ">
        <div class="container">
            <div class="row">
                <div class="col-xxl-7 col-xlg-7 col-lg-7 col-md-10 col-sm-12 col-12 d-flex align-items-center">
                    <div class="content p-3 text-white">
                        <h1 class="h1 fw-bold mb-3">Welcome to Connect2local</h1>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ullam sint quia, sapiente, id corrupti dolores minima nostrum eligendi nam minus voluptate ea illum nemo eos?</p>
                        <button class="btn border text-white px-5 py-3 rounded-pill" id="modal-btn">Get Started</button>
                    </div>
                </div>

            </div>
        </div>
        </section>
    </header>
    <div class="container"> 
        <section class="about-us my-4">
            <h1 class="text-center text-white my-5 h2 fw-bold">About Us</h1>

            <div class="row my-4">
                <div class="col-6 g-3" style="">
                        <img src="/asset/image/webpage/home-content2.jpg" class="border rounded-2 shadow body-teriatory" style="background:linear-gradient(rgba(0, 98, 255, 0.469), rgba(0, 27, 159, 0.469))!important;height:100%;width:90%;">
                </div>
                <div class="col-6 g-3">
                        <h1 class="h4 fw-bold text-white my-2">What is Connect2Local ?</h1>
                        <p class="text-white fs-5" style="text-align:justify">Welcome to Connect2Local, your go-to hub for discovering and supporting businesses in Kadi, India. We've crafted a user-friendly business directory where local establishments can connect with residents effortlessly. With features like blogging and social media integration, businesses can effortlessly showcase what they offer. Join us in building a stronger local community where businesses thrive and customers discover the best of what Kadi has to offer. Explore, connect, and support local with Connect2Local!</p>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-6 g-3">
                <h1 class="h4 fw-bold text-white my-2" >What is Connect2Local ?</h1>
                        <p class="text-white fs-5" style="text-align:justify;width:90%">Welcome to Connect2Local, your go-to hub for discovering and supporting businesses in Kadi, India. We've crafted a user-friendly business directory where local establishments can connect with residents effortlessly. With features like blogging and social media integration, businesses can effortlessly showcase what they offer. Join us in building a stronger local community where businesses thrive and customers discover the best of what Kadi has to offer. Explore, connect, and support local with Connect2Local!</p>
                </div>
                <div class="col-6 g-3">
                <img src="/asset/image/webpage/home-content1.jpg" class="border rounded-2 shadow body-teriatory" style="background:linear-gradient(rgba(0, 98, 255, 0.469), rgba(0, 27, 159, 0.469))!important;height:100%;width:90%;">
                </div>
            </div>

            <div class="d-flex mt-4">
                <button class="m-auto btn text-white border px-5 py-3" id="modal-btn">Read More</button>
            </div>
        </section>
        </div>
        <hr class="border">
        <div class="container">
        <section class="our-services p-3 my-5 mx-2 ">
                <h1 class="fs-2 fw-bold text-center text-white mb-5">Our Services</h1>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-12 g-4">
                        <div class="card col-lg-11 col-md-12 col-12 category-bg">
                            <div class="card-content border rounded-1 shadow body-teriatory">
                                <div class="card-body d-flex justify-content-center align-items-center" style="height:250px">
                                    <img src="/asset/image/svg/download.svg" alt="Advertising image" class="category-img ">
                                </div>
                                <div class="card-footer text-white text-center border-top">
                                    <a href="" class="nav-link">Advertising</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-12 g-4">
                        <div class="card col-lg-11 col-md-12 col-12 category-bg">
                            <div class="card-content border rounded-1 shadow body-teriatory">
                                <div class="card-body d-flex justify-content-center align-items-center" style="height:250px;">
                                    <img src="/asset/image/svg/construction.svg" alt="Advertising image" class="category-img ">
                                </div>
                                <div class="card-footer text-center border-top text-white">
                                    <a href="" class="nav-link">Contstruction</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-12 g-4">
                        <div class="card col-lg-11 col-md-12 col-12 category-bg">
                            <div class="card-content border rounded-1 shadow body-teriatory">
                                <div class="card-body d-flex justify-content-center align-items-center" style="height:250px;">
                                    <img src="/asset/image/svg/automobile.svg" alt="Advertising image" class="category-img ">
                                </div>
                                <div class="card-footer text-center border-top text-white">
                                    <a href="" class="nav-link">Automobile</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-12 g-4">
                        <div class="card col-lg-11 col-md-12 col-12 category-bg">
                            <div class="card-content border rounded-1 shadow body-teriatory">
                                <div class="card-body d-flex justify-content-center align-items-center" style="height:250px;">
                                    <img src="/asset/image/svg/bank.svg" alt="Advertising image" class="category-img ">
                                </div>
                                <div class="card-footer text-center border-top text-white">
                                    <a href="" class="nav-link">Banking & Finance</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-12 g-4">
                        <div class="card col-lg-11 col-md-12 col-12 category-bg">
                            <div class="card-content border rounded-1 shadow body-teriatory">
                                <div class="card-body d-flex justify-content-center align-items-center" style="height:250px;">
                                    <img src="/asset/image/svg/education.svg" alt="Advertising image" class="category-img ">
                                </div>
                                <div class="card-footer text-center border-top text-white">
                                    <a href="" class="nav-link">Education</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-12 g-4">
                        <div class="card col-lg-11 col-md-12 col-12 category-bg">
                            <div class="card-content border rounded-1 shadow body-teriatory">
                                <div class="card-body d-flex justify-content-center align-items-center" style="height:250px;">
                                    <img src="/asset/image/svg/fashion.svg" alt="Advertising image" class="category-img ">
                                </div>
                                <div class="card-footer text-center border-top text-white">
                                    <a href="" class="nav-link">Fashion</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-12 g-4">
                        <div class="card col-lg-11 col-md-12 col-12 category-bg">
                            <div class="card-content border rounded-1 shadow body-teriatory">
                                <div class="card-body d-flex justify-content-center align-items-center" style="height:250px;">
                                    <img src="/asset/image/svg/transportation.svg" alt="Advertising image" class="category-img ">
                                </div>
                                <div class="card-footer text-center border-top text-white">
                                    <a href="" class="nav-link">Transportation</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-12 g-4">
                        <div class="card col-lg-11 col-md-12 col-12 category-bg">
                            <div class="card-content border rounded-1 shadow body-teriatory">
                                <div class="card-body d-flex justify-content-center align-items-center" style="height:250px;">
                                    <img src="/asset/image/svg/hotel.svg" alt="Advertising image" class="category-img ">
                                </div>
                                <div class="card-footer text-center border-top text-white">
                                    <a href="" class="nav-link">Hotel</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-12 g-4">
                        <div class="card col-lg-11 col-md-12 col-12 category-bg">
                            <div class="card-content border rounded-1 shadow body-teriatory">
                                <div class="card-body d-flex justify-content-center align-items-center" style="height:250px;">
                                    <img src="/asset/image/svg/electronic.svg" alt="Advertising image" class="category-img ">
                                </div>
                                <div class="card-footer text-center border-top text-white">
                                    <a href="" class="nav-link">Electronic</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

        <section class="blog-overview p-3">
    <h1 class="fs-2 fw-bold text-center text-white">Our Blog</h1>
    <div class="container">
        <div class="row">
            <?php
            $query = "SELECT * FROM blog_data ORDER BY RAND() LIMIT 3";
            $result = mysqli_query($GLOBALS['connect'], $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="col-lg-4 col-md-6 col-12 g-4">';
                    fetch_blog($row['blg_id'], 0);
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>
</section>

    </div>

    <?php include "./component/footer.php";?>
</body>
</html>

</html>