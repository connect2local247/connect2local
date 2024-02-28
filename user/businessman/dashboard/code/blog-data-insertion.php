<?php
        include "../../../../includes/table_query/db_connection.php";
        require "../../../../includes/code_generator/primary_key_generator.php";
        require "../../../../includes/table_query/get_data_query.php";
        
        session_start();

        // Clear session variables
        if (isset($_SESSION['error'])) {
            unset($_SESSION['error']);
        }

        if (isset($_SESSION['greet-message'])) {
            unset($_SESSION['greet-message']);
        }

        function get_name($business_id){
            $query = "SELECT b_fname,b_lname FROM business_register WHERE B_ID = '$business_id'";

            $result = mysqli_query($GLOBALS['connect'],$query);

            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);

                $fname = $row['b_fname'];
                $lname = $row['b_lname'];

                return $fname." ".$lname;
            } 

            return "";
        }

        function is_length_valid($title, $description)
        {
            if(strlen($title) > 50){
                $_SESSION['error'] = "Maximum Length Reached For Title";
                return false;
            }
            $_SESSION['blog-title'] = $title;
            $_SESSION['blog-description'] = $description;

            return true;
        }

        function formatFileSize($bytes) {
            $sizes = array('Bytes', 'KB', 'MB', 'GB', 'TB');
            $i = intval(floor(log($bytes, 1024)));
            return number_format($bytes / pow(1024, $i), 2) . ' ' . $sizes[$i];
        }

        function insert_link_data($blog_id,$blogger_id,$username){
            if(isset($_SESSION['linkDataArray'])){

            foreach ($_SESSION['linkDataArray'] as $key => $value) {   
                $insert_query = "INSERT INTO blog_link_data (blg_id,bp_user_id,link_title,link_url) VALUES ('$blog_id','$blogger_id','{$value["title"]}','{$value["url"]}')";

                // die($insert_query);
                $result = mysqli_query($GLOBALS['connect'],$insert_query);
                // echo $value['title']." :- ".$value['url']."<br>";
             }
        }
    }

    function get_blog_count($user_id){
        $fetch_query = "SELECT bpi_blog_count FROM business_profile_interaction WHERE bp_user_id = '$user_id'";

        $result = mysqli_query($GLOBALS['connect'],$fetch_query);
        // die($fetch_query);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);

            return $row["bpi_blog_count"];
        }

        return;
    }
        function insert_data($title,$description){
            $blog_id = generateUniqueBlogID();
            $blogger_id = $_SESSION['bp_user_id'];
            $blogger_name = get_name($blogger_id);
            $content_filename = $_SESSION['file-name'];
            $content_type = $_SESSION['file-type'];
            $content_size = $_SESSION['file-size'];
            $blogger_username = get_username("business_profile",$blogger_id,"bp_username","bp_user_id");
            $blogger_user_img = get_single_data("business_profile","bp_profile_img_url","bp_user_id",$blogger_id);
            $blogger_category = get_single_data("business_profile","bp_category","bp_user_id",$blogger_id);
            $share_link = "http://connect2local/pages/blog/blog.php?blog_id=$blog_id";
            $blogger_profile_url = "https://connect2local/modules/user-orofile/business_profile.php?blogger_id=$blogger_id";
            $_SESSION['blog_id'] = $blog_id;
            $insert_blog_data_query = "INSERT INTO `blog_data`(`blg_id`, `blg_title`, `blg_username`, `blg_user_img_url`, `blg_content_url`, `blg_content_size`, `blg_description`, `blg_author_name`, `blg_content_type`, `blg_category`, `blg_like_count`, `blg_comment_count`, `blg_share_link`, `blgr_profile_url`, `blg_release_time`, `bp_user_id`) VALUES ('$blog_id','$title','$blogger_username','$blogger_user_img','$content_filename','$content_size','$description','$blogger_name','$content_type','$blogger_category','0','0','$share_link','$blogger_profile_url',NOW(),'$blogger_id')";
            // die($insert_blog_data_query);
            $result = mysqli_query($GLOBALS['connect'],$insert_blog_data_query);

            if($result){
                insert_link_data($blog_id,$blogger_id,$blogger_username);
                return true;
            } else{
                $_SESSION['error'] = "Something Went Wrong... Please Try Again.";
            }
            return false;
        }

        if (isset($_POST['submit'])) {
            $blog_title = $_POST['blog-title'];
            $blog_description = $_POST['blog-description'];

           
            
            // die();
            
            
            // Check if a file was uploaded
            if (isset($_FILES['file-upload'])) {
            $blog_post_file = $_FILES['file-upload'];
            print_r($blog_post_file);
                $_SESSION['file-name'] = $blog_post_file['name'];
                $_SESSION['file-size'] = formatFileSize($blog_post_file['size']);
                $_SESSION['file-type'] = $blog_post_file['type'];

                echo $_SESSION['file-size'];
                echo "<br>";
                echo $_SESSION['file-name'];
                // die();
                $maxFileSize = 2048 * 1024 * 1024; // 10 MB
                $file_type = $_FILES['file-upload']['type'];



                
                // Check if the uploaded file size exceeds the limit
                if ($_FILES['file-upload']['size'] > $maxFileSize) {
                    // Handle the error, e.g., display a message or redirect with an error
                    $_SESSION['error'] =  "File size exceeds the limit";
                    header("location:/user/businessman/dashboard/dashboard.php?content=create");
                    exit;
                }
                // Check for file upload errors
                if ($_FILES['file-upload']['error'] !== UPLOAD_ERR_OK) {
                    // Handle the specific error cases
                    $_SESSION['error'] = 'File upload failed with error code: ' . $_FILES['file-upload']['error'];
                    header("location:/user/businessman/dashboard/dashboard.php?content=create");
                    exit();
                }

                // Handle the file upload logic here
                $targetDirectory = "/connect2local/database/data/blog/content/";
                $targetFile = $targetDirectory . basename($blog_post_file["name"]);


                if (move_uploaded_file($blog_post_file["tmp_name"], $targetFile)) {
                    // File uploaded successfully
                    echo "File is valid, and was successfully uploaded.";
                } else {
                    $_SESSION['error'] = "Sorry, there was an error uploading your file.";
                    header("location:/user/businessman/dashboard/dashboard.php?content=create");
                    exit();
                }
            }


            if (is_length_valid($blog_title, $blog_description)) {
                if(insert_data($blog_title,$blog_description)){
                    $blog_count = get_blog_count($_SESSION['bp_user_id']);
                    $query = "UPDATE business_profile_interaction SET bpi_blog_count = $blog_count + 1 ";
                    
                    $result = mysqli_query($GLOBALS['connect'],$query);

                    if($result){
                        $_SESSION['greet-message'] = "Your Blog Uploaded Successfully.";
                    }
                }
            }

            if (isset($_SESSION['greet-message'])) {
                if (isset($_SESSION['blog-title'])) {
                    $_SESSION['blog-title'] = "";
                }
                if (isset($_SESSION['blog-description'])) {
                    $_SESSION['blog-description'] = "";
                }
                if(isset($_SESSION['linkDataArray'])){
                    $_SESSION['linkDataArray'] = array();
                }
            }
            header("location:/user/businessman/dashboard/dashboard.php?content=create");
            exit();
        }
?>