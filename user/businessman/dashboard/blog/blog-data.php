<?php

include "../../../../includes/table_query/db_connection.php";
$blog_id = "BLG0000001";
function fetch_blog($blog_id){
    $get_blog_data_query = "SELECT * FROM blog_data WHERE BLG_ID = '$blog_id' ";
    
    $result = mysqli_query($GLOBALS['connect'],$get_blog_data_query);
    
    if(mysqli_num_rows(($result))){
        $row = mysqli_fetch_assoc($result);
        return $row;
        // $title = $row['BLG_TITLE'];
        // $description = $row['BLG_DESCRIPT'];
        // $username = $row['BLG_USERNAME'];
        // $user_image = $row['BLG_USER_IMG_URL'];
        // $content_url = $row['BLG_CONTENT_URL'];
        // $content_size = $row['BLG_CONTENT_SIZE'];
        // $content_type = $row['BLG_CONTENT_TYPE'];
        // $category = $row['BLG_CATEGORY'];
        // $like_count = $row['BLG_LIKE_COUNT'];
        // $comment_count = $row['BLG_COMMENT_COUNT'];
        // $blogger_profile = $row['BLGR_PROFILE_URL'];
        // $blogger_name = $row['BLG_AUTHOR_NAME'];
        // $share_link = $row['BLG_SHARE_LINK'];
        // $release_date = $row['BLG_RELEASE_DATE'];
        // $update_date = $row['BLG_UPDATE_TIME'];
        // $user_id = $row['USER_ID'];
    }
}
?>