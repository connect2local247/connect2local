<?php
// Assuming you have included necessary PHP files and initialized session if required

// Check if the menuItemId parameter is set
if(isset($_GET['menuItemId'])) {
    $menuItemId = $_GET['menuItemId'];

    // Process $menuItemId to determine which content to fetch
    switch ($menuItemId) {
        case 'dashboard':
            include "content/dashboard_content.php";
            break;
        case 'account':
            include "account/account.php";
            break;
        case 'notification':
            // Include or echo the content for the notification
            break;
        case 'blog':
            // Include or echo the content for the blog
            break;
        case 'create':
            include "form/add-blog.php";
            break;
        case 'search':
            // Include or echo the content for searching
            break;
        case 'setting':
            // Include or echo the content for setting
            break;
        case 'logout':
            // Include or echo the content for logging out
            break;
        default:
            echo "Invalid menu item ID.";
            break;
    }
} else {
    // Handle case when menuItemId parameter is not set
    echo "Menu item ID is not provided.";
}
?>
