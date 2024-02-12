<div class="content">
        <?php
        if (isset($row['BLG_CONTENT_TYPE']) && isset($row['BLG_CONTENT_URL']) && isset($row['BLG_TITLE'])) {
            if (strpos($row['BLG_CONTENT_TYPE'], "image") !== false) {
        ?>
                <img src="/database/data/blog/content/<?php echo $row['BLG_CONTENT_URL']; ?>" class="rounded-2" style="height:100%;width:100%;" alt="<?php echo $row['BLG_TITLE']; ?>">
        <?php
            } else {
        ?>
                <video class="rounded-2" style="height:100%;width:100%;" controls>
                    <source src="/database/data/blog/content/<?php echo $row['BLG_CONTENT_URL']; ?>" type="<?php echo $row['BLG_CONTENT_TYPE']; ?>">
                </video>
        <?php
            }
        } else{
            echo "Content not available";
        }
        ?>
    </div>