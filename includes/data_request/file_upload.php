<?php
session_start();

// Clear session variables
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}

if (isset($_SESSION['greet-message'])) {
    unset($_SESSION['greet-message']);
}

// Check if a file was uploaded
if (isset($_FILES['file-upload'])) {
    $blog_post_file = $_FILES['file-upload'];

    // Store file information in session
    $_SESSION['file-name'] = $blog_post_file['name'];
    $_SESSION['file-size'] = $blog_post_file['size'];
    $_SESSION['file-type'] = $blog_post_file['type'];

    // Handle the file upload logic here
    $maxFileSize = 2048 * 1024 * 1024; // 2GB

    // Check if the uploaded file size exceeds the limit
    if ($_FILES['file-upload']['size'] > $maxFileSize) {
        // Handle the error, e.g., display a message or redirect with an error
        $_SESSION['error'] =  "File size exceeds the limit";
        exit;
    }

    // Check for file upload errors
    if ($_FILES['file-upload']['error'] !== UPLOAD_ERR_OK) {
        // Handle the specific error cases
        $_SESSION['error'] = 'File upload failed with error code: ' . $_FILES['file-upload']['error'];
        exit();
    }

    // Handle the file upload logic here
    $targetDirectory = "/connect2local/database/data/blog/content/";
    $targetFile = $targetDirectory . basename($blog_post_file["name"]);

    if (move_uploaded_file($blog_post_file["tmp_name"], $targetFile)) {
        // File uploaded successfully
        echo "File is valid, and was successfully uploaded.";
    } else {
        $_SESSION['error'] = "Sorry, there was an error uploading your file.";
        exit();
    }
}
?>
