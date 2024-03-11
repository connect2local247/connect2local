<div class="interaction-option  d-flex justify-content-between px-1  py-2 rounded">
                            <div class="interaction-icon">
                                <ul class="nav" style="gap:10px">
                                <?php if(!isset($_SESSION['current_user'])){
                                        echo " <li class='item d-flex flex-column align-items-center' style='font-size:13px' onclick='alert(`You are not login yet`)'>";
                                }else{
                                ?>
                                <li class="item d-flex flex-column align-items-center" style="font-size:13px" onclick="toggleLike('<?php echo $unique_identifier ?>','<?php echo $blog_id ?>')">
                                <?php
                                }
                                     $query = "SELECT * FROM blog_like_data WHERE like_user_id = '$current_user_id' AND blg_id = '$blog_id'";
   
                                     $result = mysqli_query($GLOBALS['connect'], $query);
                                     $num_rows = mysqli_num_rows($result);
                                     if($num_rows > 0){
                                        
                                     
                                ?>
    <i class="fa-solid fa-heart text-primary fs-5 mx-2 blog-interaction-icons" id="like-icon-<?php echo $unique_identifier ?>"></i>
    <span class="interaction-count" id="like-count-<?php echo $unique_identifier ?>"><?php echo $like_count ?></span>
    
    <?php
                                     }else{
                                         
                                         
                                         ?>
            <i class="fa-regular fa-heart fs-5 mx-2 blog-interaction-icons" id="like-icon-<?php echo $unique_identifier ?>"></i>
            <span class="interaction-count" id="like-count-<?php echo $unique_identifier ?>"><?php echo $like_count ?></span>
            
            <?php
                                     }
                                     ?>
                                     <script src="/asset/js/like.js"></script>
</li>


                                    <?php 
                                            if($comment_count != 0){
                                    ?>
                                    <li class="item d-flex flex-column align-items-center" style="font-size:13px" >
                                        <i class="fa-regular fa-comment fs-5 mx-2 blog-interaction-icons" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#comment-section<?php echo $unique_identifier; ?>" 
                                        aria-expanded="false" 
                                        aria-controls="comment-section"></i>
                                        <span class="interaction-count"><?php echo $comment_count ?></span>
                                    </li>
                                    <?php
                                            } else{
                                    ?>
                                    <li class="item d-flex flex-column align-items-center" style="font-size:13px" >
                                        <i class="fa-regular fa-comment fs-5 mx-2 blog-interaction-icons" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#comment-section<?php echo $unique_identifier ?>" 
                                        aria-expanded="false" 
                                        aria-controls="comment-section"></i>
                                        <span class="interaction-count">Comment</span>
                                    </li>
                                    <?php
                                            }
                                    ?>
                                    <li class="item d-flex flex-column align-items-center" style="font-size:13px" data-bs-target="#shareBlogModal<?php echo $unique_identifier; ?>" data-bs-toggle="modal">
                                        <i class="fa-regular fa-share-from-square fs-5 mx-2 blog-interaction-icons"></i>
                                        <span class="interaction-count">Share</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="visiting-link">
    <i class="fa-solid fa-link fs-5 blog-interaction-icons" data-bs-target="#link-container<?php echo $unique_identifier ?>" data-bs-toggle="collapse"></i>
</div>
</div>
                                        
                                    
