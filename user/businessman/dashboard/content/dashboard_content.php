<div class="content-container p-1 bg-dark">
<?php include "profile/profile.php"; fetch_profile($_SESSION['bp_user_id']);?>
    </div> 
                
    <section class="user-blog mt-5 mb-4 py-5 px-4">  
            <div class="row">

            
            <?php
             $bp_user_id = $_SESSION['bp_user_id']; // Assuming user ID is available in session
             $query = "SELECT blg_id FROM blog_data WHERE bp_user_id = '$bp_user_id'";
             $result = mysqli_query($GLOBALS['connect'],$query);
            
             if(mysqli_num_rows($result) > 0){
                 $counter = 0; // Counter to keep track of blog items
                 while($row = mysqli_fetch_assoc($result)) {
                     $blog_id = $row['blg_id'];
                     // Open a new row if the counter is divisible by 3 (for large screens)
                    
            ?>
           <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xxl-3 g-3">
           <?php
                        include "blog/delete-blog.php";
                        include "blog/edit-blog.php";
                       ?>
                <?php echo $blog_id;fetch_blog($blog_id)?> 
            </div> 
            <?php    
                    $counter++;  //Increment the counter
                }   
            }
            ?>
            </div>
        
    </section> 
    
      <?php include "../../../component/footer.php"; ?>