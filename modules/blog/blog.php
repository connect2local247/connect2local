<div class="card<?php echo $unique_identifier?>"  onclick="activateCard(this)">
<?php
      if(isset($_GET['blog_id'])){
        $blog_id = $_GET['blog_id'];

        $query = "DELETE from blog_data WHERE blg_id = '$blog_id' AND bp_user_id = '$user_id'";
        $result = mysqli_query($GLOBALS['connect'],$query);


          $query = "DELETE from blog_link_data WHERE blg_id = '$blog_id'";
          $result = mysqli_query($GLOBALS['connect'],$query);
    
      }
      
?>
            <?php
                    include "delete-blog.php";
                    include "edit-blog.php";
                    ?>
            <div class="card-content border border-dark rounded shadow position-relative p-2">
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
        .card$unique_identifier.active {
            /* outline: 1px solid black; Example border color change for active state */
            background:linear-gradient(royalblue,skyblue);
            color:white;
            border-color:white;
            cursor: pointer;
        }
    </style>
        "
?>

        </div>
   