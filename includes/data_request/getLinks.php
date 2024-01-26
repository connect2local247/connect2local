<?php
session_start();

if (!isset($_SESSION['linkData'])) {
    $_SESSION['linkData'] = array();
}

// Return the existing link data
foreach ($_SESSION['linkData'] as $link) {
    echo '<a href="' . $link['url'] . '" class="added-link">' . $link['title'] . '</a>
          <button class="btn btn-danger btn-sm ms-2" onclick="deleteLink(\'' . $link['title'] . '\', \'' . $link['url'] . '\')">Delete</button><br>';
}
?>
