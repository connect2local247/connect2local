<div class="interaction-option  d-flex justify-content-between px-1  py-2 rounded">
        <div class="interaction-icon">
            <ul class="nav" style="gap:10px">
                <li class="item d-flex flex-column align-items-center" style="font-size:13px">
                    <i class="fa-regular fa-heart fs-5 mx-2 blog-interaction-icons"></i>
                    <?php 
                    if($row['BLG_LIKE_COUNT'] != 0){
                    ?>
                        <span class="interaction-count"><?php echo $row['BLG_LIKE_COUNT'] ?></span>
                    <?php
                    } else{
                    ?>
                        <span class="interaction-count">Like</span>
                    <?php
                    }
                    ?>
                </li>

                <?php 
                if($row['BLG_COMMENT_COUNT'] != 0){
                ?>
                    <li class="item d-flex flex-column align-items-center" style="font-size:13px" >
                        <i class="fa-regular fa-comment fs-5 mx-2 blog-interaction-icons" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#comment-section<?php echo $blog_id ?>" 
                        aria-expanded="false" 
                        aria-controls="comment-section"></i>
                        <span class="interaction-count"><?php echo $row['BLG_COMMENT_COUNT'] ?></span>
                    </li>
                <?php
                } else{
                ?>
                    <li class="item d-flex flex-column align-items-center" style="font-size:13px" >
                        <i class="fa-regular fa-comment fs-5 mx-2 blog-interaction-icons" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#comment-section<?php echo $blog_id ?>" 
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
            <i class="fa-solid fa-link fs-5 blog-interaction-icons" data-bs-target="#link-container<?php echo $row['BLG_ID'] ?>" data-bs-toggle="collapse"></i>
        </div>
    </div>
