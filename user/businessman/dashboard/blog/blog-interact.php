<div class="interaction-option  d-flex justify-content-between px-1  py-2 rounded">
                            <div class="interaction-icon">
                                <ul class="nav" style="gap:10px">
                                    <li class="item d-flex flex-column align-items-center" style="font-size:13px">
                                        <i class="fa-regular fa-heart fs-5 mx-2 blog-interaction-icons"></i>
                                        <?php 
                                            if($like_count != 0){
                                        ?>
                                            <span class="interaction-count"><?php echo $like_count ?></span>
                                        <?php
                                            } else{
                                        ?>
                                            <span class="interaction-count">Like</span>
                                        <?php
                                            }
                                        ?>
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
                                    <li class="item d-flex flex-column align-items-center" style="font-size:13px">
                                        <i class="fa-regular fa-share-from-square fs-5 mx-2 blog-interaction-icons"></i>
                                        <span class="interaction-count">Share</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="visiting-link">
    <i class="fa-solid fa-link fs-5 blog-interaction-icons" data-bs-target="#link-container<?php echo $unique_identifier ?>" data-bs-toggle="collapse"></i>
</div>
                                        </div>
