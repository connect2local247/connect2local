<div class="card-header d-flex justify-content-between px-3 align-items-center position-relative">
    <div class="user-data d-flex align-items-center " style="gap:10px">
        <?php 
        if($row['BLG_USER_IMG_URL'] != "" || $row['BLG_USER_IMG_URL'] != NULL){
        ?>
        <img src="/database/data/user/<?php echo $row['BLG_USER_IMG_URL']; ?>" alt="user image" style="height:50px;width:50px" class="rounded-circle bg-light">
        <?php
        } else {
        ?>
        <img src="/asset/image/user/profile.png" alt="user image" style="height:50px;width:50px" class="rounded-circle bg-light">
        <?php
        }
        ?>
        <span class="user-name fw-bold">@<?php echo $row['BLG_USERNAME']; ?></span>
        
        <!-- <div class="blog-option-container position-absolute top-0 end-0 mt-5 border me-1 text-bg-light p-2 rounded d-none" style="width:70%;z-index:5" id="<?php echo "blogPopUp".$blog_id; ?>">
            <ul class="list-unstyled text-center" >
                <li class="list-item mt-2 shadow border p-2 rounded d-flex align-items-center justify-content-center"><i class="fa-solid fa-circle-info"></i>&nbsp;Info</li>
                <li class="list-item mt-2 shadow border p-2 rounded d-flex align-items-center justify-content-center"> <i class="fa-solid fa-floppy-disk fs-4"></i>&nbsp;Save</li>
                <li class="list-item mt-2 shadow border p-2 rounded d-flex align-items-center justify-content-center"><i class="fa-solid fa-ban"></i>&nbsp;Block</li>
                <li class="list-item mt-2 shadow border p-2 rounded d-flex align-items-center justify-content-center text-danger">&nbsp;Report</li>
                <li class="list-item"></li>
            </ul>
        </div>
    </div> -->
        <?php include "blog-option.php" ?>
    
    <i class="fa-solid fa-ellipsis-vertical px-3 py-2" onclick="document.getElementById('blogPopUp<?php echo $blog_id; ?>').classList.toggle('d-none')"></i>
    <?php //include "./component/blog-modal.php"; ?>
</div>
