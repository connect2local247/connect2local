<?php
            session_start();
            include "../../includes/table_query/db_connection.php";
             require "../../includes/security_function/secure_function.php";
             require "../blog/blog-data.php";
            
             if(isset($_GET['user_id'])){
                $user_id = $_GET['user_id'];
                $user_id = $_SESSION['bp_user_id'];
                fetch_profile($user_id);
             }
             function fetch_profile($user_id){

                $query = "SELECT 
                bi.bi_fname AS First_Name,
                bi.bi_lname AS Last_Name,
                bi.business_name AS Business_Name,
                bi.bi_address AS Business_Address,
                bi.bi_category AS Category,
                bi.bi_operate_time AS Operate_Time,
                bi.bi_contact AS Phone,
                bi.bi_email AS Email,
                bi.bi_web_url AS Website_Url,
                bi.bi_ig_url AS Instagram_url,
                bi.bi_fb_url AS Facebook_url,
                bi.bi_twitter_url AS X_url,
                bi.bi_linkedin_url AS Linkedin_url,
                bi.b_key AS B_key,
                bi.b_id AS B_id,
                bp.bp_username AS Username,
                bp.bp_user_id AS User_id,
                bp.b_id AS B_id,
                bp.bp_profile_img_url AS Profile_url,
                bp.bp_bio AS Bio,
                bpi.bpi_blog_count AS Blog_count,
                bpi.bpi_follower_count AS Follower_count,
                bpi.bpi_following_count AS Following_count
            FROM 
                business_info bi
            LEFT JOIN 
                business_profile bp ON bi.B_id = bp.B_id
            LEFT JOIN 
                business_profile_interaction bpi ON bp.bp_user_id = bpi.bp_user_id
            WHERE
                bp.bp_user_id = '$user_id';
            ";

        $result = mysqli_query($GLOBALS['connect'], $query);

        // Storing fetched data into variables
        if ($row = mysqli_fetch_assoc($result)) {
            $fname = $row['First_Name'];
            $lname = $row['Last_Name'];
            $businessName = $row['Business_Name'];
            $address = $row['Business_Address'];
            $category = $row['Category'];
            $operateTime = $row['Operate_Time'];
            $phone = $row['Phone'];
            $email = $row['Email'];
            $webUrl = $row['Website_Url'];
            $igUrl = $row['Instagram_url'];
            $fbUrl = $row['Facebook_url'];
            $xUrl = $row['X_url'];
            $linkedinUrl = $row['Linkedin_url'];
            $bKey = $row['B_key'];
            $bId = $row['B_id'];
            $username = $row['Username'];
            $userId = $row['User_id'];
            $profileId = $row['B_id'];
            $profileImg = $row['Profile_url'];
            $bio = $row['Bio'];
            $blogCount = $row['Blog_count'];
            $followerCount = $row['Follower_count'];
            $followingCount = $row['Following_count'];

            
        // Now you can use these variables as needed

        ?>  
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <?php include "../../asset/link/cdn-link.html"; ?>
        </head>
        <body>
            
        <div class="container">

        
    <div class="text-bg-dark shadow">
            <div class="profile-container p-4 rounded">
                <div class="row rounded ">

            
                        <div class="business-info col-5  p-2 text-center">
                                <div class="profile-image d-flex justify-content-center">
                                    <?php

                                            if($profileImg != "" || $profileImg != NULL){

                                            
                                    ?>
                                    <img src="/database/data/user/<?php echo $profileImg ?>" class="border rounded-circle" style="height:100px;width:100px" alt="">
                                    <?php
                                            } else{

                                            
                                    ?>
                                    <img src="/asset/image/user/profile.png" class="border rounded-circle" style="height:100px;width:100px" alt="">
                                    <?php
                                            }
                                    ?>
                                </div>
                                <div class="business-name">
                                    <span class="fs-4"  style="font-weight:500"><?php echo "$fname $lname" ?></span>
                                </div>
                                <!-- <p class="">Monday - Friday: 9:00 AM - 5:00 PM</p> -->
                                <div class="follow-btn mt-1">
                                    <button class="btn btn-primary px-4 bg-gradient">Follow</button>
                                </div>
                                <div class="info mt-4 d-flex justify-content-center">
                                    <table class="">
                                        <tr class="border">
                                            <th class="border-end px-3" style="font-size:15px;font-weight:500">Business Name</th>
                                            <td class="px-3" style="font-size:15px"><?php echo "$businessName" ?></td>
                                        </tr>
                                        <tr class="border">
                                            <th class="border-end px-3" style="font-size:15px;font-weight:500">Opening Hours</th>
                                            <td class="px-3" style="font-size:15px"><?php echo $operateTime ?></td>
                                        </tr>
                                        <tr class="border">
                                            <th class="border-end px-3" style="font-size:15px;font-weight:500">Address</th>
                                            <td class="px-3" style="font-size:15px;white-space:pre-line"><?php echo $address ?></td>
                                        </tr>
                                        <tr class="border">
                                            <th class="border-end px-3" style="font-size:15px;font-weight:500">Category</th>
                                            <td class="px-3" style="font-size:15px"><?php echo $category ?></td>
                                        </tr>

                                    </table>
                                </div>
                                <!-- <div class="profile-name text-center">
                                    <span class="fs-5"></span>
                                </div> -->
                            </div>
                            <div class="profile-info col-6 p-2 ">
                                <div class="profile-name d-flex flex-column">
                                    <span class="fs-5 fw-bold"><?php echo $username ?></span>
                                </div>
                                <div class="user-profile-activity-info mt-3">
                    <ul class="list-unstyled d-flex fw-bold m-0" style="gap:10%">
                        <li class="list-item d-flex flex-column justify-content-center text-center"><span class="blog-count"><?php echo $blogCount ?></span> <span>Blog</span></li>
                        <li class="list-item d-flex flex-column justify-content-center text-center"><span class="follower-count"><?php echo $followerCount ?></span> <span>Follower</span></li>
                        <li class="list-item d-flex flex-column justify-content-center text-center"><span class="following-count"><?php echo $followerCount ?></span> <span>Following</span></li>
                    </ul>
                </div>
                                <div class="category mt-2">
                                    <span class="text-secondary">Advertising</span>
                                </div>
                                <div class="description" style="white-space:pre-line;margin-top:-20px">
                                <?php echo $bio ?>
                                </div>
                                <div class="contact-info mt-2">
    <a href="mailto:<?php echo decryptData($email,$bKey) ?>" class="btn btn-light"><i class="fa-solid fa-envelope"></i>&nbsp;Email</a>
    <a href="tel:<?php echo decryptData($phone,$bKey)?>" class="btn btn-light"><i class="fa-solid fa-phone"></i>&nbsp;Phone</a>
</div>


                                
                        </div>
                        
                    </div>
                </div>
                <div class="social-link fs-4 d-flex  justify-content-center border-top py-2 border-secondary" style="gap:15px">
                        <a href="<?php echo $igUrl ?>" class="social-media-link text-white"><i class="fa-brands fa-instagram"></i></a>
                        <a href="<?php echo $fbUrl?>" class="social-media-link text-white"><i class="fa-brands fa-facebook"></i></a>
                        <a href="<?php echo $linkedinUrl?>" class="social-media-link text-white"><i class="fa-brands fa-linkedin"></i></a>
                        <a href="<?php echo $xUrl ?>" class="social-media-link text-white"><i class="fa-brands fa-twitter"></i></a>
                </div>
        </div>
        <?php
            }
        }
        ?>
        <section class="user-blog mt-5 mb-4 py-5 px-4">  
            <div class="row">

            
            <?php
             $bp_user_id = $_SESSION['bp_user_id']; // Assuming user ID is available in session
             $query = "SELECT blg_id FROM blog_data WHERE bp_user_id = '$bp_user_id'";
             $result = mysqli_query($GLOBALS['connect'],$query);
            
             if(mysqli_num_rows($result) > 0){
                 $counter = 0; // Counter to keep track of blog items
                 while($row = mysqli_fetch_assoc($result)) {
                     $blog_id = $row['blg_id'];
                     // Open a new row if the counter is divisible by 3 (for large screens)
                    
            ?>
           <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xxl-3 g-3">
         
                <?php echo $blog_id;fetch_blog($blog_id)?> 
            </div> 
            <?php    
                    $counter++;  //Increment the counter
                }   
            }
            ?>
            </div>
        
    </section> 
        </div>
</body>
</html>