<div class="content p-2 blog-overflow blog-content">
                            <?php
                                    if (isset($content_type) && isset($content_url) && isset($title)) {
                                        if (strpos($content_type, "image") !== false) {
                                    ?>
                                            <img src="/database/data/blog/content/<?php echo $content_url ?>" class="rounded-2" style="height:100%;width:100%;" alt="<?php echo $title ?>">
                                    <?php
                                        } else {
                                    ?>
                                            <video class="rounded-2" style="height:100%;width:100%;" controls>
                                                <source src="/database/data/blog/content/<?php echo $content_url; ?>" type="<?php echo $content_type ?>">
                                            </video>
                                    <?php
                                        }
                                    } else{
                                        echo "Content not available";
                                    }
                            ?>

</div>