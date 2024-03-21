<div class="card" id="blog-card">

<?php
if (!function_exists('determine_user_type')) {
    // Define the determine_user_type function
    function determine_user_type($user_id) {
        // Regular expression to match user types
        $pattern = '/^C2L\d+$/'; // Matches 'C2L' followed by one or more digits
        $business_pattern = '/^C2LB\d+$/'; // Matches 'C2LB' followed by one or more digits

        // Check if the user ID matches any pattern
        if (preg_match($pattern, $user_id)) {
            return 'Customer';
        } elseif (preg_match($business_pattern, $user_id)) {
            return 'Business';
        } elseif ($user_id == 1) {
            return 'Admin';
        }
    }
}
if (!function_exists('timeElapsedString')) {
    function timeElapsedString($datetime) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
    
        if ($diff->y > 0) {
            return $diff->y . 'y';
        } elseif ($diff->m > 0) {
            return $diff->m . 'm';
        } elseif ($diff->d > 6) {
            return floor($diff->d / 7) . 'w';
        } elseif ($diff->d > 0) {
            return $diff->d . 'd';
        } elseif ($diff->h > 0) {
            return $diff->h . 'h';
        } elseif ($diff->i > 0) {
            return $diff->i . 'm';
        } else {
            return 'just now';
        }
    }
    
}


      if(isset(($_GET['edit_blog_id']))){
            $edit_blog_id = $_GET['edit_blog_id'];

            if(isset($_POST['edit-submit'])){
                $query = "UPDATE blog_data SET blg_title = '{$_POST['title']}', blg_description = '{$_POST['description']}' WHERE blg_id = '$edit_blog_id' AND bp_user_id = '$user_id'";
                $result = mysqli_query($GLOBALS['connect'],$query);
            }
      }

    //   if(isset($_GET['save_blog_id']) && isset($_GET['save_user_id'])){
    //     $save_blog_id = $_GET['save_blog_id'];
    //     $save_user_id = $_GET['save_user_id'];
    
    //     unset($_GET['save_blog_id']);
    //     unset($_GET['save_user_id']);
    //     $checkExistQuery = "SELECT user_id, blg_id FROM blog_save_data WHERE blg_id = '$save_blog_id' AND user_id = '$save_user_id'";
    //     $checkResult = mysqli_query($GLOBALS['connect'], $checkExistQuery);
    //     if(mysqli_num_rows($checkResult) <= 0){
    //         $query = "INSERT INTO blog_save_data (user_id, blg_id) VALUES ('$save_blog_id', '$save_user_id')";
    //         $result = mysqli_query($GLOBALS['connect'], $query);
    //         echo "<script>alert('Blog saved successfully.')</script>";
    //         unset($save_blog_id);
    //         unset($save_user_id);
    //     } else{
    //         echo "<script>alert('Already saved by you.')</script>";
    //     }
    // }

    // if(isset($_GET['block_blog_id'])){
    //     $block_blog_id = $_GET['block_blog_id'];

      
    //       $query = "DELETE from blog_link_data WHERE blg_id = '$block_blog_id'";
    //       $result = mysqli_query($GLOBALS['connect'],$query);
    
    //   }
    
      
?>
                  <?php include "delete-blog.php"; ?>
                  <?php include "edit-blog.php"; ?>  
                  <?php include "share-modal.php"; ?>
                  <?php include "block-user.php"; ?>
                  <div class="card-content text-bg-light border border-dark rounded shadow position-relative p-2" onclick="activateCard(this)">
                      <?php include "blog-header.php" ?>
                      <?php include "blog-body.php" ?>
                      <?php include "blog-footer.php" ?>
                      
                    </div>
                    <?php include "report-blog.php"; ?>

            <script>
    // Function to activate the clicked card
    function activateCard(card) {
        // Deactivate all other cards
        document.querySelectorAll('.card-content').forEach(function(item) {
            item.classList.remove('active');
        });
        // Activate the clicked card
        card.classList.add('active');
    }
</script>
<!-- <?php
        echo "<style>
        /* Style for active card */
        .card-content.active {
            /* outline: 1px solid black; Example border color change for active state */
            background:linear-gradient(royalblue,skyblue) !important;
            color:white;
            border-color:white;
            cursor: pointer;
        }
    </style>
        "
?> -->

<style>
    /* Style for active card */
    .card-content.active {
        background: rgb(227,23,75);
background: linear-gradient(180deg, rgba(227,23,75,0.6979166666666667) 31%, rgba(0,185,255,0.7679446778711485) 100%);
        color: white !important;
        border-color: white;
        cursor: pointer;
    }
</style>
        </div>
   