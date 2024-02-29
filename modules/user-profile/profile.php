<?php
session_start();
include "../../includes/table_query/db_connection.php";
require "../../includes/security_function/secure_function.php";
require "../blog/blog-data.php";

if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $user_id = $_SESSION['bp_user_id'];
    fetch_profile($user_id);
}

function fetch_profile($user_id) {
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
                bp.bp_user_id = '$user_id';";

    $result = mysqli_query($GLOBALS['connect'], $query);

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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Include Bootstrap CSS -->
    <?php include "../../asset/link/cdn-link.html"; ?>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/asset/css/style.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }
        .profile-card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .profile-card h2 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            color: #333;
        }
        .profile-card p {
            font-size: 1.2rem;
            color: #666;
        }
        .profile-card .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 20px;
        }
        .profile-card .profile-image img {
            width: 100%;
            height: auto;
            display: block;
        }
        .social-links {
            margin-top: 20px;
        }
        .social-links a {
            color: #555;
            font-size: 24px;
            margin-right: 10px;
            transition: all 0.3s ease;
        }
        .social-links a:hover {
            color: #007bff;
        }
        .contact-info {
            margin-top: 20px;
        }
        .contact-info ul {
            list-style: none;
            padding: 0;
        }
        .contact-info ul li {
            margin-bottom: 10px;
        }
        .contact-info ul li a {
            color: #555;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .contact-info ul li a:hover {
            color: #007bff;
        }
        .user-blog h2 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 20px;
        }
        .blog-card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: all 0.3s ease;
        }
        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .blog-card h5 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 10px;
        }
        .blog-card p {
            font-size: 1.1rem;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <!-- Profile Information -->
            <div class="col-lg-4">
                <div class="profile-card text-center">
                    <!-- Profile Image -->
                    <div class="profile-image">
                        <?php if($profileImg != "" || $profileImg != NULL): ?>
                            <img src="/database/data/user/<?php echo $profileImg ?>" alt="Profile Picture">
                        <?php else: ?>
                            <img src="/asset/image/user/profile.png" alt="Default Profile Picture">
                        <?php endif; ?>
                    </div>
                    <!-- User Name -->
                    <h2><?php echo "$fname $lname" ?></h2>
                    <p>@<?php echo $username ?></p>
                    <!-- Social Links -->
                    <div class="social-links">
                        <a href="<?php echo $igUrl ?>"><i class="fab fa-instagram"></i></a>
                        <a href="<?php echo $fbUrl ?>"><i class="fab fa-facebook"></i></a>
                        <a href="<?php echo $linkedinUrl ?>"><i class="fab fa-linkedin"></i></a>
                        <a href="<?php echo $xUrl ?>"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <!-- Profile Content -->
            <div class="col-lg-8">
                <div class="profile-details">
                    <h3>About Me</h3>
                    <p><?php echo $bio ?></p>
                    <!-- Contact Information -->
                    <div class="contact-info">
                        <h3>Contact Information</h3>
                        <ul>
                            <li><i class="fas fa-envelope"></i> <a href="mailto:<?php echo decryptData($email,$bKey) ?>"><?php echo decryptData($email,$bKey) ?></a></li>
                            <li><i class="fas fa-phone"></i> <a href="tel:<?php echo decryptData($phone,$bKey)?>"><?php echo decryptData($phone,$bKey)?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- User Blog Section -->
        <div class="user-blog mt-5">
            <h2>User Blog</h2>
            <div class="row">
                <?php
                $bp_user_id = $_SESSION['bp_user_id'];
                $query = "SELECT blg_id FROM blog_data WHERE bp_user_id = '$bp_user_id'";
                $result = mysqli_query($GLOBALS['connect'], $query);
                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $blog_id = $row['blg_id'];
                ?>
                <div class="col-lg-4 col-md-6 mt-4">
                    <div class="blog-card">
                        <h5>Blog ID: <?php echo $blog_id; ?></h5>
                        <!-- Fetch Blog Content using fetch_blog() function -->
                        <?php fetch_blog($blog_id); ?>
                    </div>
                </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Include Bootstrap JS and Font Awesome -->
    <?php include "../../asset/link/bootstrap-link.html"; ?>
</body>
</html>

<?php
    }
}
?>
