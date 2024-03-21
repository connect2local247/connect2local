<?php if(isset($_SESSION['registered'])): ?>
<div class="blog-option-container position-absolute top-0 end-0 mt-5 border me-1 text-bg-light p-2 rounded d-none" style="width:70%;z-index:5" id="<?php echo "blogPopUp".$unique_identifier; ?>">
    <ul class="list-unstyled text-center">
        <?php
            // Fetch user and business profile data
            $fetch_user_id = "SELECT bp_user_id,b_id from business_profile WHERE b_id = '$current_user_id'";
            $result = mysqli_query($GLOBALS['connect'],$fetch_user_id);

            if(mysqli_num_rows($result) > 0){
                $data = mysqli_fetch_assoc($result);
                $bp_user_id = $data['bp_user_id'];
                $b_id = $data['b_id'];
            }

            // Check if the current user is a business
            if(isset($bp_user_id)){
                // Query to check if the blog belongs to the current user
                $query = "SELECT bp_user_id from blog_data where blg_id = '$blog_id' and bp_user_id = '$bp_user_id' ";
                $result = mysqli_query($GLOBALS['connect'],$query);

                // If the blog belongs to the current user
                if(mysqli_num_rows($result) > 0){
                    // Display "Edit" and "Delete" options
                    ?>
                    <li class="list-item mt-2 shadow border p-2 rounded d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#editBlogModal<?php echo $unique_identifier ?>"> <i class="fa-solid fa-file-pen fs-5"></i>&nbsp;Edit</li>
                    <li class="list-item mt-2 shadow border p-2 rounded d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#deleteBlogModal<?php echo $unique_identifier ?>"> <i class="fa-solid fa-trash fs-5"></i>&nbsp;Delete</li>
                    <?php
                } else{
                    ?>
                     <li class="list-item mt-2 shadow border p-2 rounded d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#blockModal<?php echo $unique_identifier ?>"><i class="fa-solid fa-ban fs-5"></i>&nbsp;Block</li>
                <li class="list-item mt-2 shadow border p-2 rounded d-flex align-items-center justify-content-center text-danger" data-bs-toggle="modal" data-bs-target="#reportModal<?php echo $unique_identifier ?>">&nbsp;Report</li>
                    <?php
                }
            }

            // If the current user is a business and the blog is not owned by them
            else{
                // Display "Block" and "Report" options
                ?>
                <li class="list-item mt-2 shadow border p-2 rounded d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#blockModal<?php echo $unique_identifier ?>"><i class="fa-solid fa-ban fs-5"></i>&nbsp;Block</li>
                <li class="list-item mt-2 shadow border p-2 rounded d-flex align-items-center justify-content-center text-danger" data-bs-toggle="modal" data-bs-target="#reportModal<?php echo $unique_identifier ?>">&nbsp;Report</li>
                <?php
            }
        ?>
    </ul>
</div>
<?php endif; ?>