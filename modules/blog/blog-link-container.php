
<!-- Include Clipboard.js library for copy functionality -->


<div class="link-container top-0 w-100 start-0 text-bg-light border-top border-dark collapse pt-3" id="link-container<?php echo $unique_identifier; ?>">
<?php
$fetch_link_query = "SELECT link_title, link_url FROM blog_link_data WHERE blg_id = '$blog_id'";
$result = mysqli_query($GLOBALS['connect'], $fetch_link_query);
$count = mysqli_num_rows($result);
if (mysqli_num_rows($result) >= 1) {
    $links = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $links[] = $row;
    }
?>
    <ul class="list-unstyled p-1">
        <?php foreach ($links as $link) : ?>
            <li class="list-item d-flex align-items-center justify-content-between border rounded m-1" style="height:35px">
                <i class="fa-solid fa-link border-end px-2 py-1" title="<?php echo $link['link_title']; ?>"></i>
                <a href="<?php echo $link['link_url']; ?>" class="nav-link m-auto" title="<?php echo $link['link_url']; ?>" target="_blank"><?php echo $link['link_title']; ?></a>
                <i class="fa-solid fa-copy border-start px-2 py-1 copy-link" data-clipboard-text="<?php echo $link['link_url']; ?>" onclick="copyLink()" title="Copy"></i>
            </li>
        <?php endforeach; ?>
    </ul>

<?php
} else {
    echo "<div class='link-container text-dark text-center border-bottom border-dark' id='link-container<?php echo $unique_identifier; ?>'><p>No links available</p></div>";
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>

<script>
    function copyLink() {
        // Initialize Clipboard.js
        new ClipboardJS('.copy-link');
        var copy_links = document.querySelectorAll('.copy-link');
var copyNotification = document.getElementById('copyNotification');

for (var i = 0; i < copy_links.length; i++) {
    copy_links[i].addEventListener('click', function () {
        // Reset all links to black
        for (var j = 0; j < copy_links.length; j++) {
            copy_links[j].style.color = 'black';
        }
        // Set the clicked link to blue
        this.style.color = 'royalblue';

        // Copy the link to the clipboard
        var textToCopy = this.getAttribute('data-clipboard-text');
    });
}
}
</script>
</div>


</div>