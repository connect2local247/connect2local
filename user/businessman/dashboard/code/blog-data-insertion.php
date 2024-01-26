<?php
session_start();

// Clear session variables
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}

if (isset($_SESSION['greet-message'])) {
    unset($_SESSION['greet-message']);
}

function is_length_valid($title, $description)
{
    // Your validation logic here
}
if (isset($_POST['submit'])) {
    $blog_title = $_POST['blog-title'];
    $blog_description = $_POST['blog-description'];

    echo $blog_title;
    
    
    // Check if a file was uploaded
    if (isset($_FILES['file-upload'])) {
        $blog_post_file = $_FILES['file-upload'];
       print_r($blog_post_file);
        $_SESSION['file-name'] = $blog_post_file['name'];
        $_SESSION['file-size'] = $blog_post_file['size'];
        $_SESSION['file-type'] = $blog_post_file['type'];

        echo "<br>";
        echo $_SESSION['file-name'];
        // die();
        $maxFileSize = 2048 * 1024 * 1024; // 10 MB
        $file_type = $_FILES['file-upload']['type'];



        
        // Check if the uploaded file size exceeds the limit
        if ($_FILES['file-upload']['size'] > $maxFileSize) {
            // Handle the error, e.g., display a message or redirect with an error
            $_SESSION['error'] =  "File size exceeds the limit";
            header("location:/user/businessman/dashboard/form/add-blog2.php");
            exit;
        }
        // Check for file upload errors
        if ($_FILES['file-upload']['error'] !== UPLOAD_ERR_OK) {
            // Handle the specific error cases
            $_SESSION['error'] = 'File upload failed with error code: ' . $_FILES['file-upload']['error'];
            header("location:/user/businessman/dashboard/form/add-blog2.php");
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
            header("location:/user/businessman/dashboard/form/add-blog2.php");
            exit();
        }
    }

    // Store other data in session
    $_SESSION['blog-title'] = $blog_title;
    $_SESSION['blog-description'] = $blog_description;

    if (is_length_valid($blog_title, $blog_description)) {
        $_SESSION['greet-message'] = "Your Blog Uploaded Successfully.";
    }

    header("location:/user/businessman/dashboard/form/add-blog2.php");
    exit();
}
?>