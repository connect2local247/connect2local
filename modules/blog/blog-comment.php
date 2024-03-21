<div class="comment-section collapse border-secondary border-top p-2" id="comment-section<?php echo $unique_identifier ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <span class="h5">Comments</span>
    <?php if(isset($_SESSION['registered'])): ?>
    <form id="comment-form<?php echo $unique_identifier ?>" class="mt-3">
        <div class="mb-3">
            <textarea id="comment-text<?php echo $unique_identifier ?>" class="form-control" name="comment" placeholder="Add a comment..." rows="3" required></textarea>
        </div>
        <input type="hidden" id="blog-id<?php echo $unique_identifier ?>" value="<?php echo $blog_id ?>"> 
        <input type="hidden" id="cc<?php echo $unique_identifier ?>" value="<?php echo "cc".$unique_identifier ?>"> <!-- Replace with actual blog ID -->
        <!-- Replace with actual blog ID -->
        <button type="submit" class="btn btn-primary">Post</button>
    </form>
    <?php endif; ?>
    <div id="comments-container<?php echo $unique_identifier ?>">
        <?php
        // Fetch comments from the database
        $query = "SELECT 
                    c.comment_id AS comment_id,
                    c.comment_content AS comment_content,
                    c.comment_time AS comment_time,
                    c.commentor_id AS commentor_id
                FROM 
                    comments c
                WHERE 
                    c.blg_id = '$blog_id'
                ORDER BY 
                    c.comment_time DESC";
        $result = mysqli_query($GLOBALS['connect'], $query);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Determine user type
                $user_type = determine_user_type($row['commentor_id']);

                // Set profile image and username based on user type
                $profile_image = '';
                $username = '';
                if ($user_type === 'Customer') {
                    $customer_profile = mysqli_fetch_assoc(mysqli_query($GLOBALS['connect'], "SELECT cp_profile_img_url AS profile_img, cp_username AS username FROM customer_profile WHERE c_id = '{$row['commentor_id']}'"));
                    $profile_image = $customer_profile['profile_img'];
                    $username = $customer_profile['username'];
                } elseif ($user_type === 'Business') {
                    $business_profile = mysqli_fetch_assoc(mysqli_query($GLOBALS['connect'], "SELECT bp_profile_img_url AS profile_img, bp_username AS username FROM business_profile WHERE b_id = '{$row['commentor_id']}'"));
                    // die("SELECT bp_profile_img_url AS profile_img, bp_username AS username FROM business_profile WHERE b_id = '{$row['commentor_id']}'");
                    $profile_image = $business_profile['profile_img'];
                    $username = $business_profile['username'];
                }

                // Display each comment
                echo '<div class="comment-container p-3 rounded shadow border">';
                echo '<div class="info-container d-flex align-items-center" style="gap:7px">';
                echo '<div class="profile-image">';
                echo '<img src="/database/data/user/' . $profile_image . '" style="width:35px;height:35px;" class="rounded-circle" alt="" srcset="">';
                echo '</div>';
                echo '<div class="username">';
                echo '<span class="fw-semibold">' . $username . ':</span>';
                echo '<p class="comment-content'.$unique_identifier.' fw-normal d-inline" style="font-size:17px">' . $row['comment_content'] . '</p>';
                echo '<span class="time fw-normal text-secondary" style="font-size:13px">' . timeElapsedString($row['comment_time']) . '</span>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            // No comments found
            echo '<div class="alert alert-info">No comments yet. Be the first to comment!</div>';
        }
        ?>
    </div>

    <script>
        $(document).ready(function() {
            // Submit comment form using AJAX
            $('#comment-form<?php echo $unique_identifier ?>').submit(function(e) {
                e.preventDefault(); // Prevent form submission

                var commentText = $('#comment-text<?php echo $unique_identifier ?>').val(); // Get comment text
                var blogID = $('#blog-id<?php echo $unique_identifier ?>').val(); // Get blog ID
                var uniqueIdentifier = $('#cc<?php echo $unique_identifier ?>').val();

                var formData = {
                    comment: commentText,
                    blog_id: blogID,
                    unique_identifier:uniqueIdentifier,
                };

                // AJAX request to insert comment
                $.ajax({
                    type: 'POST',
                    url: '/modules/blog/insert_comment.php', // PHP script for inserting comment
                    data: formData,
                    success: function(response) {
                        // Update comments container with new comment
                        $('#comments-container<?php echo $unique_identifier ?>').prepend(response);
                        // Clear comment textarea
                        $('#comment-text<?php echo $unique_identifier ?>').val('');
                    }
                });
            });
        });
    </script>

