<div class="card-header d-flex justify-content-between px-3 align-items-center position-relative">
                      
                        <div class="user-data d-flex align-items-center " style="gap:10px">
                            <?php 
                                    if($user_image != "" || $user_image != NULL){

                                        $query = "SELECT b_id,bp_username FROM business_profile WHERE bp_user_id = '$user_id'";
                                        $result = mysqli_query($GLOBALS['connect'],$query);

                                        if(mysqli_num_rows($result) > 0){
                                                $row = mysqli_fetch_assoc($result);
                                                $profile_id = $row['b_id'];
                                                $db_username = $row['bp_username'];
                                        }
                            ?>
                            <img src="/database/data/user/<?php echo $user_image;?>" alt="user image" style="height:50px;width:50px" class="rounded-circle bg-light" onclick="location.href='/modules/user-profile/profile.php?profile_id=<?php echo $profile_id?>&viewer_id=1'">
                            <?php
                                    } else {
                            ?>
                                    <img src="/asset/image/user/profile.png" alt="user image" style="height:50px;width:50px" class="rounded-circle bg-light">
                            <?php
                                 }
                            ?>
                            <span class="user-name fw-bold">@<?php if(isset($username)){echo $username;}else{echo $db_username;} ?></span>
                        
                        <?php include "blog-option.php" ?>
                        </div>
                        <?php if(isset($_SESSION['registered'])): ?>
                        <i class="fa-solid fa-ellipsis-vertical px-3 py-2" onclick="document.getElementById('blogPopUp<?php echo $unique_identifier; ?>').classList.toggle('d-none')"></i>    
                        <?php endif; ?> 
</div>
