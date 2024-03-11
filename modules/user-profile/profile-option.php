<div class="profile-option-container position-absolute top-0 end-0 mt-5 border me-1 text-bg-light p-2 rounded d-none" style="width:70%;z-index:5">
<?php echo $data['blog_id'];?>
<ul class="list-unstyled text-center" >
                              <?php if(isset($viewer_id)){?>
                                
                                <li class="list-item mt-2 shadow border p-2 rounded d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#blockModal"><i class="fa-solid fa-ban fs-5"></i>&nbsp;Block</li>
                                <li class="list-item mt-2 shadow border p-2 rounded d-flex align-items-center justify-content-center text-danger" data-bs-toggle="modal" data-bs-target="#reportModal">&nbsp;Report</li>
                                <li class="list-item"></li>


                                <?php
                                   }

                                    $query = "SELECT bp_user_id from blog_data where blg_id = '$blog_id' and bp_user_id = '$current_user_id' ";
                                    $result = mysqli_query($GLOBALS['connect'],$query);

                                    if(mysqli_num_rows($result) > 0){
                                ?>
                                <li class="list-item mt-2 shadow border p-2 rounded d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#editBlogModal"> <i class="fa-solid fa-file-pen fs-5"></i>&nbsp;Edit</li>
                                <li class="list-item mt-2 shadow border p-2 rounded d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#deleteBlogModal"> <i class="fa-solid fa-trash fs-5"></i>&nbsp;Delete</li>
                                <?php
                                    }
                                ?>
                                <?php
                                    $query = "SELECT bp_user_id from blog_data where blg_id = '$blog_id' and bp_user_id != '$current_user_id' ";
                                    $result = mysqli_query($GLOBALS['connect'],$query);

                                    if(mysqli_num_rows($result) > 0){
                                ?>
                                
                            </ul>
                            <?php
                                    }
                                ?>
                        </div>