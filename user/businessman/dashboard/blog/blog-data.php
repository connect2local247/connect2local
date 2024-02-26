<?php

// $blog_id = "blg0000001";
// echo $blog_id; 
function fetch_blog($blog_id){
    $get_blog_data_query = "SELECT * FROM blog_data WHERE blg_id = '$blog_id' ";
    
    $result = mysqli_query($GLOBALS['connect'],$get_blog_data_query);
    
    if(mysqli_num_rows(($result)) > 0){
        $row = mysqli_fetch_assoc($result);

        // return $row;
        $title = $row['blg_title'];
        $description = $row['blg_description'];
        $username = $row['blg_username'];
        $user_image = $row['blg_user_img_url'];
        $content_url = $row['blg_content_url'];
        $content_size = $row['blg_content_size'];
        $content_type = $row['blg_content_type'];
        $category = $row['blg_category'];
        $like_count = $row['blg_like_count'];
        $comment_count = $row['blg_comment_count'];
        $blogger_profile = $row['blgr_profile_url'];
        $blogger_name = $row['blg_author_name'];
        $share_link = $row['blg_share_link'];
        $release_date = $row['blg_release_time'];
        $update_date = $row['blg_update_time'];
        $user_id = $row['bp_user_id'];

        $unique_identifier = uniqid('blog_');
        $data = array(
            "blog_id" => $blog_id ,
            "identifier" => $unique_identifier
        );
        include "blog.php"; 
    }
}
?>