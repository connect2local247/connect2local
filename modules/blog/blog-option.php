
<div class="blog-option-container position-absolute top-0 end-0 mt-5 border me-1 text-bg-light p-2 rounded d-none" style="width:70%;z-index:5" id="<?php echo "blogPopUp".$unique_identifier; ?>">
<?php //echo $data['blog_id'];?>

                            <ul class="list-unstyled text-center" >
                                <?php
                                    $fetch_user_id = "SELECT bp_user_id from business_profile WHERE b_id = '$current_user_id'";
                                    $result = mysqli_query($GLOBALS['connect'],$fetch_user_id);

                                    if(mysqli_num_rows($result) > 0){
                                        $data = mysqli_fetch_assoc($result);
                                        $bp_user_id = $data['bp_user_id'];
                                    }
                                    if(isset($bp_user_id)){
                                        $query = "SELECT bp_user_id from blog_data where blg_id = '$blog_id' and bp_user_id = '$bp_user_id' ";
                                        $result = mysqli_query($GLOBALS['connect'],$query);
                                    }

                                    if(mysqli_num_rows($result) > 0){
                                ?>
                                <li class="list-item mt-2 shadow border p-2 rounded d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#editBlogModal<?php echo $unique_identifier ?>"> <i class="fa-solid fa-file-pen fs-5"></i>&nbsp;Edit</li>
                                <li class="list-item mt-2 shadow border p-2 rounded d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#deleteBlogModal<?php echo $unique_identifier ?>"> <i class="fa-solid fa-trash fs-5"></i>&nbsp;Delete</li>
                                <?php
                                    }
                                ?>
<!-- 
                                <li class="list-item mt-2 shadow border p-2 rounded d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-floppy-disk fs-5"></i>&nbsp;
                                    <button onclick="location.href='?save_blog_id=<?php echo $blog_id ?>&save_user_id=<?php echo $user_id ?>'" class="saveButton btn fs-4">Save</button>
                                </li> -->
                                <?php
                                        if(!isset($bp_user_id)){

                                        
                                    $query = "SELECT bp_user_id from blog_data where blg_id = '$blog_id' and bp_user_id != '$current_user_id' ";
                                    $result = mysqli_query($GLOBALS['connect'],$query);

                                    if(mysqli_num_rows($result) > 0){
                                ?>
                                <li class="list-item mt-2 shadow border p-2 rounded d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#blockModal<?php echo $unique_identifier ?>"><i class="fa-solid fa-ban fs-5"></i>&nbsp;Block</li>
                                <li class="list-item mt-2 shadow border p-2 rounded d-flex align-items-center justify-content-center text-danger" data-bs-toggle="modal" data-bs-target="#reportModal<?php echo $unique_identifier ?>">&nbsp;Report</li>
                                <li class="list-item"></li>
                            </ul>
                            <?php
                                    }
                                }
                                ?>
                        </div>