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
            $query = "SELECT B_FNAME,B_LNAME FROM business_register WHERE B_ID = '$business_id'";

            $result = mysqli_query($GLOBALS['connect'],$query);

            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);

                $fname = $row['B_FNAME'];
                $lname = $row['B_LNAME'];

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

        function insert_link_data(){
            foreach ($_SESSION['linkDataArray'] as $key => $value) {   
                $insert_query = "INSERT INTO blog_link_data (BLG_ID,BLGR_ID,USERNAME,LINK_TITLE,LINK_URL) VALUES ('$blog_id','$blogger_id','$username','{$value["title"]}','{$value["url"]}')";
                $result = mysqli_query($GLOBALS['connect'],$insert_query);
                // echo $value['title']." :- ".$value['url']."<br>";
             }
        }

        function insert_data($title,$description){
            $blog_id = generateUniqueBlogID();
            $blogger_id = $_SESSION['user_id'];
            $blogger_name = get_name($blogger_id);
            $content_filename = $_SESSION['file-name'];
            $content_type = $_SESSION['file-type'];
            $content_size = $_SESSION['file-size'];
            $blogger_username = get_username("business_profile",$blogger_id,"USERNAME","B_ID");
            $blogger_user_img = get_single_data("business_profile","$blogger_id","BLG_USER_IMG_URL","B_ID");
            $blogger_category = get_single_data("business_profile","$blogger_id","CATEGORY","B_ID");
            $share_link = "http://connect2local/pages/blog/blog.php?blog_id='$blog_id'";
            $blogger_profile_url = "https://connect2local/pages/profile/blogger-profile.php?blogger_id='$blogger_id'";
            
            $insert_blog_data_query = "INSERT INTO `blog_data`(`BLG_ID`, `BLG_TITLE`, `BLG_USERNAME`, `BLG_USER_IMG_URL`, `BLG_CONTENT_URL`, `BLG_CONTENT_SIZE`, `BLG_DESCRIPT`, `BLG_AUTHOR_NAME`, `BLG_CONTENT_TYPE`, `BLG_CATEGORY`, `BLG_LIKE_COUNT`, `BLG_COMMENT_COUNT`, `BLG_SHARE_LINK`, `BLGR_PROFILE_URL`, `BLG_RELEASE_DATE`, `USER_ID`) VALUES ('$blog_id','$title','$blogger_username','$blogger_user_img','$content_filename','$content_size','$description','$blogger_name','$content_type','$blogger_category','0','0','$share_link','$blogger_profile_url',NOW(),'$blogger_id')";

            $result = mysqli_query($GLOBALS['connect'],$insert_blog_data_query);

            if($result){
                insert_link_data();
                return true;
            } else{
                $_SESSION['error'] = "Something Went Wrong... Please Try Again.";
            }
            return false;
        }

        if (isset($_POST['submit'])) {
            $blog_title = $_POST['blog-title'];
            $blog_description = $_POST['blog-description'];

           
            
            
            
            
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
                    header("location:/user/businessman/dashboard/form/add-blog2.php");
                    exit;
                }
                // Check for file upload errors
                if ($_FILES['file-upload']['error'] !== UPLOAD_ERR_OK) {
                    // Handle the specific error cases
                    $_SESSION['error'] = 'File upload failed with error code: ' . $_FILES['file-upload']['error'];
                    header("location:/user/businessman/dashboard/form/add-blog2.php");
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
                    header("location:/user/businessman/dashboard/form/add-blog2.php");
                    exit();
                }
            }


            if (is_length_valid($blog_title, $blog_description)) {
                if(insert_data($blog_title,$blog_description)){
                    $_SESSION['greet-message'] = "Your Blog Uploaded Successfully.";
                }
            }

            header("location:/user/businessman/dashboard/form/add-blog2.php");
            exit();
        }
?>