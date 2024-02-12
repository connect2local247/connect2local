<div class="card-footer">
    <div class="holded-text text-secondary">
        Description
    </div>
    <p class="blog-description-content mt-1" style="text-align: justify" id="blog-description">
        <?php echo $row['BLG_DESCRIPT']; ?> 
        <!-- <button class="border-0 text-bg-light mx-1" id="read-more-btn" style="display:none"><u>Read More</u></button> -->
    </p>

    <script src="/asset/js/read-more.js"></script>

    <div class="blog-detail">
        <i class="text-secondary" style="font-size:14px">Posted on <?php echo date('F d, Y', strtotime($row['BLG_RELEASE_DATE'])); ?> by <?php echo $row['BLG_AUTHOR_NAME']; ?> </i>
    </div>
</div>
