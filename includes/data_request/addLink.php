<?php
session_start();
// unset($_SESSION['linkDataArray']);
if (!isset($_SESSION['linkDataArray'])) {
    $_SESSION['linkDataArray'] = array();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $linkTitle = $_POST['link-title'];
    $linkURL = $_POST['link-url'];

    // Add the new link to the session data
    $linkDataArrayAssoc = [
        'title' => $linkTitle,
        'url' => $linkURL
    ];

    // Append the new associative array to the existing array
    $_SESSION['linkDataArray'][] = $linkDataArrayAssoc;

    header("location:/user/businessman/dashboard/form/add-blog2.php");
    exit();
}
?>
