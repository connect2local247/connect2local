<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>

<div class="link-container top-0 w-100 start-0 text-bg-light border-top border-dark collapse pt-3" id="link-container<?php echo $row['BLG_ID'] ?>">
        <?php
        $fetch_link_query = "SELECT LINK_TITLE, LINK_URL FROM blog_link_data WHERE BLG_ID = '$blog_id'";
        $result = mysqli_query($GLOBALS['connect'], $fetch_link_query);

        if (mysqli_num_rows($result) > 0) {
            $links = [];
            while ($rows = mysqli_fetch_assoc($result)) {
                $links[] = $rows;
            }
        ?>
            <ul class="list-unstyled p-1">
                <?php foreach ($links as $link) : ?>
                    <li class="list-item d-flex align-items-center justify-content-between border rounded m-1" style="height:35px">
                        <i class="fa-solid fa-link border-end px-2 py-1" title="<?php echo $link['LINK_TITLE']; ?>"></i>
                        <a href="<?php echo $link['LINK_URL']; ?>" class="nav-link m-auto" title="<?php echo $link['LINK_URL']; ?>" target="_blank"><?php echo $link['LINK_TITLE']; ?></a>
                        <i class="fa-solid fa-copy border-start px-2 py-1 copy-link" data-clipboard-text="<?php echo $link['LINK_URL']; ?>" title="Copy"></i>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php
        } else {
            echo "<div class='link-container top-0 w-100 start-0 text-bg-light border-top border-dark collapse pt-3' id='link-container'><p>No links available</p></div>";
        }
        ?>

<script src="/asset/js/copy-link.js"></script>
</div>