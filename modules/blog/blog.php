<div class="card"  onclick="activateCard(this)"  id="blog-card">
<?php
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
                  <?php include "report-blog.php"; ?>
            <div class="card-content text-bg-light border border-dark rounded shadow position-relative p-2">
                    <?php include "blog-header.php" ?>
                    <?php include "blog-body.php" ?>
                    <?php include "blog-footer.php" ?>
                                       
            </div>

            <script>
    // Function to activate the clicked card
    function activateCard(card) {
        // Deactivate all other cards
        document.querySelectorAll('.card').forEach(function(item) {
            item.classList.remove('active');
        });
        // Activate the clicked card
        card.classList.add('active');
    }
</script>
<?php
        echo "<style>
        /* Style for active card */
        .card.active {
            /* outline: 1px solid black; Example border color change for active state */
            background:linear-gradient(royalblue,skyblue) !important;
            color:white;
            border-color:white;
            cursor: pointer;
        }
    </style>
        "
?>

<style>
    /* Style for active card */
    .card.active {
        background: linear-gradient(royalblue, skyblue) !important;
        color: white;
        border-color: white;
        cursor: pointer;
    }
</style>
        </div>
   