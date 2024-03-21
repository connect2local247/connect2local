<?php
        session_start();

        include "../../includes/table_query/db_connection.php";
        include "../../includes/security_function/secure_function.php";
        include "../blog/blog-data.php";
        include "profile_function.php";
        require "../../includes/code_generator/primary_key_generator.php";
        

        if(isset($_SESSION['business_id'])){

            $fetch_user_id = "SELECT bp_user_id from business_profile WHERE b_id = '{$_SESSION['business_id']}'";
            $result = mysqli_query($GLOBALS['connect'],$fetch_user_id);
        
        if(mysqli_num_rows($result) > 0){
            $data = mysqli_fetch_assoc($result);
            $bp_user_id = $data['bp_user_id'];
        }
    }
        if(isset(($_GET['edit_blog_id']))){
            $edit_blog_id = $_GET['edit_blog_id'];
            
            if(isset($_POST['edit-submit'])){
                $query = "UPDATE blog_data SET blg_title = '{$_POST['title']}', blg_description = '{$_POST['description']}' WHERE blg_id = '$edit_blog_id' AND bp_user_id = '$bp_user_id'";
                $result = mysqli_query($GLOBALS['connect'],$query);
            }
        }
        $connect = $GLOBALS['connect'];
        // $user_id = "C2LBU00001";
        if(isset($_GET['profile_id'])){
            // Sanitize input to prevent SQL injection
            $profile_id = $_GET['profile_id'];

                
            if(isset($_GET['delete_blog_id'])){
                $blog_id = $_GET['delete_blog_id'];
                $query = "DELETE FROM blog_data WHERE blg_id = '$blog_id'";
                $result = mysqli_query($GLOBALS['connect'],$query);

                $query = "DELETE FROM blog_like_data WHERE blg_id = '$blog_id'";
                $result = mysqli_query($GLOBALS['connect'],$query);

                $query = "DELETE FROM blog_link_data WHERE blg_id = '$blog_id'";
                $result = mysqli_query($GLOBALS['connect'],$query);

                $query = "DELETE FROM blog_report WHERE blg_id = '$blog_id'";
                $result = mysqli_query($GLOBALS['connect'],$query);

                unset($_GET['delete_blog_id']);
                header("location:?profile_id=$profile_id");
            }

            if(isset($_GET['block_user_id'])){
                $block_user_id = $_GET['block_user_id'];
                $check_following_query = "SELECT * FROM follower_data WHERE fd_user_id='$block_user_id' AND block_status = 0";
                $check_following_result = mysqli_query($GLOBALS['connect'], $check_following_query);
          
                if(mysqli_num_rows($check_following_result) > 0){
                    $update_status = "UPDATE follower_data SET block_status = 1 WHERE fd_user_id='$block_user_id' and follower_user_id='$bp_user_id'";
                    $result = mysqli_query($GLOBALS['connect'],$update_status);
                }
                $insert_blocked_user = "INSERT INTO blocked_user_data(bu_business_id,bu_user_id,bu_status) VALUES ('$block_user_id','{$_SESSION['current_user']}',1)";
                $result = mysqli_query($GLOBALS['connect'],$insert_blocked_user);
                // die($insert_blocked_user);
                if($result){
                    if(isset($_SESSION['c_id'])){
                        header("location:/user/customer/dashboard/dashboard.php");
                        exit;
                    }

                    if(isset($_SESSION['b_id'])){
                        header("location:/user/businessman/dashboard/dashboard.php");
                        exit;
                    }
                }
            
              }

            include "profile-share-modal.php";
            if(isset($_GET['viewer_id'])){
                $viewer_id = $_GET['viewer_id'];
            }
            $profile_id = mysqli_real_escape_string($GLOBALS['connect'], $_GET['profile_id']);
        
            // Query to fetch bp_user_id from business_profile
            $query = "SELECT bp_user_id FROM business_profile WHERE b_id = '$profile_id'";
            
            // Execute the query
            $result = mysqli_query($GLOBALS['connect'], $query);
        
            // Check if query was successful
            if ($result) {
                // Fetch the result row
                $row = mysqli_fetch_assoc($result);
                
                // Extract bp_user_id
                $bp_user_id = $row['bp_user_id'];
        
                // Now you can use $bp_user_id as needed
            } else {
                // Handle query error
                echo "Error: " . mysqli_error($GLOBALS['connect']);
            }
       
        

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
                bp.bp_user_id = '$bp_user_id';
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
            $blogCount = getBlogCount($bp_user_id);
            $followerCount = getFollowerCount($bp_user_id);
            $followingCount = getFollowingCount($bp_user_id);

            // return $row;
        }

        if($followerCount == 100){
                $check_exist = "SELECT * FROM notification WHERE n_user_id = '$profile_id' and n_type = 'achievement' and n_content='Congratulations !!! You have reached to 100 followers'";
                $result = mysqli_query($GLOBALS['connect'],$check_exist);
                // die($check_exist);
                // die($check_exist);
                if(mysqli_num_rows($result) > 0){
                    
                        // $delete_query = "DELETE FROM notification WHERE n_user_id = '$profile_id' and n_type = 'achievement' and n_content='Congratulations !!! You have reached to 100 followers'";
                        
                        // $result = mysqli_query($GLOBALS['connect'],$delete_query);

                    // return 1;

                } else{
                    $query = "INSERT INTO notification(n_content,n_type,n_user_id,n_time) VALUES ('Congratulations !!! You have reached to 100 followers','achievement','$profile_id',NOW())";
                    // die($query);
                    $result = mysqli_query($GLOBALS['connect'],$query);

                    // if($result){
                    //     return 0;
                    // }
                }
        } else if($followerCount < 100){
            $check_exist = "SELECT * FROM notification WHERE n_user_id = '$profile_id' and n_type = 'achievement' and n_content='Congratulations !!! You have reached to 100 followers'";
            $result = mysqli_query($GLOBALS['connect'],$check_exist);
            // die($check_exist);
            // die($check_exist);
            if(mysqli_num_rows($result) > 0){
                
                    $delete_query = "DELETE FROM notification WHERE n_user_id = '$profile_id' and n_type = 'achievement' and n_content='Congratulations !!! You have reached to 100 followers'";
                    
                    $result = mysqli_query($GLOBALS['connect'],$delete_query);

                // return 1;

            }  
        }
        // return 0;
        $blogQuery = "SELECT blg_id FROM blog_data WHERE bp_user_id = '$bp_user_id'";
        $blogResult = mysqli_query($connect,$blogQuery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Profile</title>
    <link rel="stylesheet" href="/asset/css/style.css">
    <?php include "../../asset/link/cdn-link.html"; ?>
    <style>
        .tab-pane {
            display: none;
        }

        .tab-pane.active {
            display: block;
        }
      
        .business-details-table {
        border-collapse: collapse;
    }

    .business-details-table td {
        padding: 5px;
        text-style:none !important;
        color:black !important;
    }

    </style>
</head>

<body class="text-bg-dark">
    <?php include "contact-drawer.php"; ?>
    <div class="container">
    <div class="row border p-4 mt-5 rounded-2">
    <div class="back text-start">
        <?php

                if(isset($_SESSION['c_id'])){
                    
                   $user = 'customer';
                   
                }
                else if(isset($_SESSION['bp_user_id'])){
                    $user = "businessman";
                  
                } else{
                    if(isset($_SESSION['current_user'])){
                        $user = "admin";
                    }
                }
        ?>
        <?php if(isset($_SESSION['current_user'])){?>
        <i class="fa-solid fa-arrow-left" onclick='location.href="/user/<?php echo $user ?>/dashboard/dashboard.php?content=dashboard"'></i>
        <?php }else{
            ?>
        <i class="fa-solid fa-arrow-left" onclick='window.history.back();'></i>
            <?php }?>
    </div>
    <div class="menu-dots text-end">
            <!-- <i class="fa-solid fa-ellipsis-vertical" ></i> -->
        </div>
            <div class="row mt-2 d-flex align-items-center">
                    <div class="col-3 d-flex justify-content-lg-end ">
                            <img src="<?php if(isset($profileImg)){echo $profileImg;}else{echo '/asset/image/user/profile.png';} ?>" style="height:100px;width:100px" class="rounded-circle" alt="">
                    </div>
                    <div class="col-9">
                            <div class="username fw-semibold fs-4 d-lg-block d-md-block d-none"><?php echo $fname." ".$lname; if(isset($username)) echo " | $username" ?></div>
                            <ul class="interact-count d-flex  fw-semibold text-center mt-2" style="gap:15px">
                                <li class="blog-count d-flex flex-column"><span class="count"><?php if(isset($blogCount)) echo $blogCount?></span> Blog</li>
                                <li class="blog-count d-flex flex-column"><span class="count"><?php if(isset($followerCount)) echo $followerCount ?></span>Follower</li>
                                <li class="blog-count d-flex flex-column"><span class="count"><?php if(isset($followingCount)) echo $followingCount?></span>Following</li>
                            </ul>
                            <div class="bio ps-4 d-lg-block d-md-block d-none mt-2">
                                <p style="white-space:pre-line"><?php if(isset($bio)) echo $bio; ?></p>
                            </div>
                    </div>
            </div>
            <div class="row mt-2">
                <div class="username fw-semibold d-lg-none d-md-none d-block"><?php echo $fname." ".$lname; if(isset($username)) echo " | $username" ?>
            </div>
            <div class="bio ps-3 d-lg-none d-md-none d-block">
                <p style="white-space:pre-line" class=""><?php if(isset($bio)) echo $bio; ?></p>
            </div>
            </div>
            <div class="row mt-2 d-flex justify-content-around">
    <div class="col-4 d-flex">
        <?php if(!isset($viewer_id)){?>
        <button class="btn btn-block mx-auto btn-outline-info text-center" style="width:110px" onclick="location.href='/user/businessman/dashboard/form/edit-profile.php'">Edit</button>
        <?php }else{?>
           

<!-- 
<script>

$(document).ready(function() {
        $('.follow-btn').click(function() {
            var button = $(this);
            var user_id = button.data('userid');
            var action = button.data('action');

            // Perform AJAX request to toggle follow status
            $.ajax({
                type: 'POST',
                url: '/modules/user-profile/toggle_follow.php',
                data: { user_id: user_id, action: action },
                success: function(response) {
                    // Toggle button text and action based on response
                    if (action === 'follow') {
                        button.text('Unfollow');
                        button.data('action', 'unfollow');
                    } else {
                        button.text('Follow');
                        button.data('action', 'follow');
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error
                }
            });
        });
    });
</script> -->
<!-- HTML for Follow/Unfollow button -->

<?php include "toggle_follow.php"; ?>
<!-- <button class="btn btn-block mx-auto btn-outline-info text-center follow-btn" onclick="location.href='?follow_status=1'">
    <?php //echo $is_following ? 'Unfollow' : 'Follow'; ?>
</button> -->

        <?php } ?>
    </div>
    <div class="col-4 d-flex">
        <button class="btn btn-block mx-auto btn-outline-info text-center" style="width:110px" data-bs-target="#shareProfileModal" data-bs-toggle="modal">Share</button>
    </div>
    <div class="col-4 d-flex">
        <button class="btn btn-block mx-auto btn-outline-info text-center" style="width:110px" data-bs-target="#contactInfo" data-bs-toggle="offcanvas">Contact</button>
    </div>
</div>

    </div>
    

       
        <!-- <div class="user-content d-flex flex-column justify-content-center align-items-center">
            <img src="/asset/image/user/profile.png" style="height:150px;width:150px" class="mx-auto rounded-circle"
                 alt="">
            <span class="fs-3 fw-semibold"><?php echo $fname." ".$lname ?></span>
            <span class="username"><i>@<?php echo $username; ?></i></span>
            <button class="btn btn-primary bg-gradient my-2">Edit Profile</button>
        </div> -->
    </div>
    <div class="container mt-5">
  <ul class="nav nav-tabs d-flex justify-content-around fs-4" id="myTabs">
    <li class="nav-item">
      <a class="nav-link active" data-bs-toggle="tab" href="#tab1"><i
                            class="fa-solid fa-table-cells text-info"></i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="tab" href="#tab2"><i class="fa-solid fa-circle-info text-info"></i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="tab" href="#tab3"><i class="fa-solid fa-icons text-info"></i></a>
    </li>
  </ul>
    <div class="tab-content">
        <div id="tab1" class="tab-pane active">
                    <div class="row">
                        <?php
                                if(mysqli_num_rows($blogResult)){
                                     while($row = mysqli_fetch_assoc($blogResult)){
                                            $blog_id = $row['blg_id'];

                                            ?>
                                            <div class="col-lg-4 col-md-6 col-12 g-3">
                                                
                                                <?php 
                                                    if(isset($_SESSION['current_user'])){
                                                        fetch_blog($blog_id,$_SESSION['current_user']);
                                                    } else{
                                                        fetch_blog($blog_id,$profile_id);
                                                    }
                                                ?>
                                            </div>
                                            <?php
                                     }
                                }else{
                        ?>
                            <div class="col-12 py-1">
                                <div class="default-info d-flex flex-column m-auto text-center py-2 text-info">
                                    <i class="fa-solid fa-camera" style="font-size:8rem;"></i>
                                    <span class="fs-1 fw-bold">No Blog</span> 
                                </div>
                            </div>
                        <?php
                                }   
                        ?>
                    </div>
        </div>
        <div id="tab2" class="tab-pane">
    <div class="business-info d-flex flex-column justify-content-center align-items-center">
        <ul class="list-group w-100 justify-content-center">
            <?php if (!empty($businessName)) : ?>
                <li class="list-group-item my-2 d-flex border-0 border-bottom border-dark">
                    <div class="item-content">
                        <b><i class="fa-solid fa-building"></i></b> <?php echo $businessName; ?>
                    </div>
                </li>
            <?php endif; ?>
            <?php if (!empty($operateTime)) : ?>
                <li class="list-group-item my-2 d-flex border-0 border-bottom border-dark">
                    <div class="item-content">
                        <b><i class="fa-solid fa-business-time"></i></b> <?php echo $operateTime; ?>
                    </div>
                </li>
            <?php endif; ?>
            <?php if (!empty($address)) : ?>
                <li class="list-group-item my-2 d-flex border-0 border-bottom border-dark">
                    <div class="item-content">
                        <b><i class="fa-solid fa-address-card"></i></b> <?php echo $address; ?>
                    </div>
                </li>
            <?php endif; ?>
            <?php if (!empty($category)) : ?>
                <li class="list-group-item my-2 d-flex border-0 border-bottom border-dark">
                    <div class="item-content">
                        <b><i class="fa-solid fa-list"></i></b> <?php echo $category; ?>
                    </div>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>
<div id="tab3" class="tab-pane">
    <ul class="list-group w-100 justify-content-center">
    <?php if (!empty($webUrl)) : ?>
            <li class="list-group-item my-2 d-flex border-0 border-bottom border-dark">
                <div class="item-content">
                    <b><i class="fa-solid fa-globe"></i></b> <a href="<?php echo $webUrl?>" class="nav-link d-inline">Website</a> 
                </div>
            </li>
        <?php endif; ?>

        <?php if (!empty($igUrl)) : ?>
            <li class="list-group-item my-2 d-flex border-0 border-bottom border-dark">
                <div class="item-content">
                    <b><i class="fa-brands fa-instagram"></i></b> <a href="<?php echo $igUrl?>" class="nav-link d-inline">Instagram</a> 
                </div>
            </li>
        <?php endif; ?>
        <?php if (!empty($fbUrl)) : ?>
            <li class="list-group-item my-2 d-flex border-0 border-bottom border-dark">
                <div class="item-content">
                    <b><i class="fa-brands fa-facebook"></i></b> <a href="<?php echo $fbUrl?>" class="nav-link d-inline">Facebook</a>
                </div>
            </li>
        <?php endif; ?>
        <?php if (!empty($xUrl)) : ?>
            <li class="list-group-item my-2 d-flex border-0 border-bottom border-dark">
                <div class="item-content">
                    <b><i class="fa-brands fa-twitter"></i></b> <a href="<?php echo $xUrl?>" class="nav-link d-inline">Twitter</a>
                </div>
            </li>
        <?php endif; ?>
        <?php if (!empty($linkedinUrl)) : ?>
            <li class="list-group-item my-2 d-flex border-0 border-bottom border-dark">
                <div class="item-content">
                    <b><i class="fa-brands fa-linkedin"></i></b> <a href="<?php echo $linkedinUrl?>" class="nav-link d-inline">Linkedin</a>
                </div>
            </li>
        <?php endif; ?>
        <?php
            if((empty($webUrl) && empty($igUrl) && empty($fbUrl) && empty($xUrl) && empty($linkedinUrl))){
                ?>
                    <div class="col-12 py-4">
                        <div class="default-info d-flex flex-column m-auto text-center py-2 text-info">
                            <i class="fa-solid fa-icons" style="font-size:7rem;"></i>
                            <span class="fs-1 fw-bold">No Link's Available</span> 
                        </div>
                    </div>
                <?php
                        }   
                ?>
    </ul>
        </div>
</div>



<script>
  function moveTab(direction) {
    const tabs = document.querySelectorAll('.nav-link');
    const activeTab = document.querySelector('.nav-link.active');
    let currentIndex = Array.from(tabs).indexOf(activeTab);

    if (direction === 'left') {
      if (currentIndex > 0) {
        tabs[currentIndex].parentNode.insertBefore(tabs[currentIndex], tabs[currentIndex - 1]);
      }
    } else if (direction === 'right') {
      if (currentIndex < tabs.length - 2) {
        tabs[currentIndex].parentNode.insertBefore(tabs[currentIndex + 1], tabs[currentIndex]);
      }
    }

  }
</script>
<?php 
        }    
?>
</body>
</html>
