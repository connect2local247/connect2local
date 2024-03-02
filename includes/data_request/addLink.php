<?php
session_start();
if(!isset($_SESSION['linkDataArray'])){
    $_SESSION['linkDataArray'] = array();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $linkTitle = $_POST['link-title'];
    $linkURL = $_POST['link-url'];

    // die();
    // Add the new link to the session data
    $linkDataArrayAssoc = [
        'title' => $linkTitle,
        'url' => $linkURL
    ];

    // Append the new associative array to the existing array
    $_SESSION['linkDataArray'][] = $linkDataArrayAssoc;
//     error_log('Request Method: ' . $_SERVER['REQUEST_METHOD']);
// var_dump($_POST); // Check the received POST data
// var_dump($_SESSION['linkDataArray']); // Check the content of linkDataArray
// addLink.php
$response  = '<span class="d-flex align-items-center p-1 my-1 rounded text-bg-light shadow justify-content-between border">';
$response .= '<i class="fa-solid fa-link fs-5 border-end px-2" title="' . $linkTitle . '"></i>';
$response .= '<a href="' . $linkURL . '" class="nav-link" target="_blank">' . $linkTitle . '</a>';
$response .= '<i class="fa-solid fa-xmark fs-5 border-start px-2" onclick="deleteCurrentLink()"></i>';
$response .= '</span>';

echo $response;
exit();



    // header("location:/user/businessman/dashboard/form/add-blog.php");
}
?>
