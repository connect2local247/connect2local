<?php
            session_start();

            if(isset($_SESSION['error'])){
                unset($_SESSION['error']);
            }

            if(isset($_SESSION['greet-message'])){
                unset($_SESSION['greet-message']);
            }
            function is_length_valid($title,$description){

                if (empty($title)) {
                    $_SESSION['error'] = "Title cannot be empty";
                    return false;
                }
                
                if (empty($description)) {
                    $_SESSION['error'] = "Description cannot be empty";
                    return false;
                }
                
                if (mb_strlen($title) > 50) {
                    $_SESSION['error'] = "Maximum Length Reached for Title (50 characters limit)";
                    return false;
                } 
                
                if (mb_strlen($description) > 1000) {
                    $_SESSION['error'] = "Maximum Length Reached for Description (1000 characters limit)";
                    return false;
                }
                
                
                return true;
            }

            if(isset($_POST['submit'])){
                $blog_title = $_POST['blog-title'];
                $blog_description = $_POST['blog-description'];

                if (isset($_SESSION['link-array'])) {
                    echo '<pre>';
                    print_r($_SESSION['link-array']);
                    echo '</pre>';
                }
                die();
                $_SESSION['blog-title'] = $blog_title;
                $_SESSION['blog-description'] = $blog_description;

                if(is_length_valid($blog_title,$blog_description)){
                    $_SESSION['greet-message'] = "Your Blog Uploaded Successfully.";
                }

                header("location:/user/businessman/dashboard/form/add-blog.php");
            }

?>