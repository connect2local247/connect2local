<?php
// Include the PHP script containing the functions
include 'test.php';

// Call the profile function to get information about a user
$username = 'bhavesh_web_studio';
$profile_info = profile($username);

// Check if the profile information is retrieved successfully
if($profile_info !== 0) {
    // Convert JSON string to an array
    $profile_data = json_decode($profile_info, true);

    // Access the profile data
    echo "Username: " . $profile_data['id'] . "<br>";
    echo "Profile Picture: <img src='" . $profile_data['profile_pic'] . "'><br>";
    echo "Followers: " . $profile_data['followers'] . "<br>";
    echo "Bio: " . $profile_data['bio'] . "<br>";
    // echo "Total Posts: " . $profile_data['total_posts'] . "<br>";
    // echo "Follows Count: " . $profile_data['follows_count'] . "<br>";

    // // Loop through the latest posts and display their images
    // echo "Latest Posts: <br>";
    // foreach($profile_data['lastest_posts'] as $post_image) {
    //     echo "<img src='" . $post_image . "'><br>";
    // }
} else {
    echo "Profile information not found.";
}

// // Call the post function to get information about a post
// $post_code = 'C3MiJ9tyrNG';
// $post_info = post($post_code);

// // Check if the post information is retrieved successfully
// if($post_info !== 0) {
//     // Convert JSON string to an array
//     $post_data = json_decode($post_info, true);

//     // Access the post data
//     echo "Total Likes: " . $post_data['total_likes'] . "<br>";
//     echo "Total Comments: " . $post_data['total_comments'] . "<br>";
//     echo "Media: <br>";
//     if($post_data['media']) {
//         // Display media (image or video)
//         echo "<img src='" . $post_data['media'] . "'><br>";
//     }
//     echo "Caption: " . $post_data['caption'] . "<br>";

//     // Loop through comments and display them
//     echo "Comments: <br>";
//     foreach($post_data['comments'] as $comment) {
//         echo $comment . "<br>";
//     }
// } else {
//     echo "Post information not found.";
// }
?>
