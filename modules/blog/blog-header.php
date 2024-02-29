<div class="card-header d-flex justify-content-between px-3 align-items-center position-relative">
                      
                        <div class="user-data d-flex align-items-center " style="gap:10px">
                            <?php 
                                    if($user_image != "" || $user_image != NULL){

                            ?>
                            <img src="/database/data/user/<?php echo $user_image;?>" alt="user image" style="height:50px;width:50px" class="rounded-circle bg-light">
                            <?php
                                    } else {
                            ?>
                                    <img src="/asset/image/user/profile.png" alt="user image" style="height:50px;width:50px" class="rounded-circle bg-light">
                            <?php
                                 }
                            ?>
                            <span class="user-name fw-bold">@<?php echo $username; ?></span>
                        
                        <?php include "blog-option.php" ?>
                        </div>
                        
                        <i class="fa-solid fa-ellipsis-vertical px-3 py-2" onclick="document.getElementById('blogPopUp<?php echo $unique_identifier; ?>').classList.toggle('d-none')"></i>     
</div>
