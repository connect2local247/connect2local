<?php
      include "../../includes/table_query/db_connection.php";
      include "../../modules/blog/blog-data.php";

      if(!isset($_SESSION['current_user'])){
          $current_user_id = 1;
      }
      session_start();
      function generateRandomBlogIDs($minCount = 5, $maxCount = 10) {
        // Assuming $_SESSION['current_user'] contains the ID of the current user
        $current_user_id = isset($_SESSION['current_user']) ? $_SESSION['current_user'] : null;
    
        // Fetch the bp_user_id if the current user is a business user
        $bp_user_id = null;
        if ($current_user_id) {
            $query_fetch_bp_user_id = "SELECT bp_user_id FROM business_profile WHERE b_id = '$current_user_id'";
            $result_fetch_bp_user_id = mysqli_query($GLOBALS['connect'], $query_fetch_bp_user_id);
            $bp_user_id_row = mysqli_fetch_assoc($result_fetch_bp_user_id);
            $bp_user_id = isset($bp_user_id_row['bp_user_id']) ? $bp_user_id_row['bp_user_id'] : null;
        }
    
        // Query to select random blog IDs from the blog_data table excluding the current user's blogs
        // and blogs blocked by the current user
        $query = "SELECT DISTINCT bd.blg_id 
                  FROM blog_data bd
                  LEFT JOIN blocked_user_data bu ON bd.bp_user_id = bu.bu_business_id
                  WHERE bd.bp_user_id != '$bp_user_id' 
                  AND (bu.bu_user_id != '$current_user_id' OR bu.bu_user_id IS NULL)
                  ORDER BY RAND() LIMIT " . mt_rand($minCount, $maxCount);
        $result = mysqli_query($GLOBALS['connect'], $query);
    
        $blogIDs = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $blogIDs[] = $row['blg_id'];
        }
    
        return $blogIDs;
    }
      
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <?php include "../../asset/link/cdn-link.html"; ?>
  <link rel="stylesheet" href="/asset/css/style.css">
</head>
<body id="home-body" class="text-white">
<?php
        include "../../component/navbar.php";
?>

<div class="container" style="margin-top:100px;min-height:calc(100vh - 30px)">
    <div class="search-bar mt-1 position-relative">
        <form id="searchBlog" method="post" class="p-2" style="width:100%;overflow-x:auto; white-space:nowrap;">
            <div class="search-bar-container position-relative p-2 rounded-top d-flex justify-content-center">
                <div class="search-container position-relative w-100">
                    <input type="text" class="form-control border border-dark rounded-pill p-2 pe-3 ps-2" name="search-blog" id="search-blog" placeholder="Search blog here...">
                    <button type="submit" class="btn py-2 px-3 position-absolute top-0 end-0" style="z-index:10" name="search"><i class="fa-solid fa-magnifying-glass text-bg-light"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="row result-container w-100 p-1 position-relative vertical-bar" style="max-width:100%;" id="searchResults">
        <?php
        // Fetch random blog IDs
        $randomBlogIDs = generateRandomBlogIDs(5,10);
        if (empty($randomBlogIDs)) {
            echo '<div class="default-info d-flex flex-column m-auto text-center py-2 text-white">
            <i class="fa-solid fa-camera" style="font-size:8rem;"></i>
            <span class="fs-1 fw-bold">No Blog Available</span> 
        </div>';
        }
        // Fetch blogs using fetched IDs
        foreach ($randomBlogIDs as $blogID) {
            // Check if the blog owner is blocked by the current user
            $is_blocked_query = "SELECT 1 FROM blocked_user_data WHERE bu_user_id = '$current_user_id' AND bu_business_id = (SELECT bp_user_id FROM blog_data WHERE blg_id = '$blogID')";
            $is_blocked_result = mysqli_query($GLOBALS['connect'], $is_blocked_query);
            if (mysqli_num_rows($is_blocked_result) == 0) {
                echo "<div class='col-xxl-4 col-xl-6 col-lg-6 col-md-6 col-12 gx-2 gy-2' id='suggested-content'>";
                fetch_blog($blogID, isset($_SESSION['current_user']) ? $_SESSION['current_user'] : null);
                echo "</div>";
            }
        }
        ?>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        $('#searchBlog').submit(function (e) {
            e.preventDefault();

            const searchQuery = $('#search-blog').val().trim();
            if (searchQuery === '') {
                return; // Do nothing if the search bar is empty
            }

            const formData = {'search-blog': searchQuery};

            $.ajax({
                type: 'POST',
                url: '/webpage/blog/search-blog.php', // Modify the URL according to your file structure
                data: formData,
                dataType: 'json',
                success: function (results) {
                    displayBlogResults(results);
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });

    function displayBlogResults(results) {
        const resultsContainer = $('#searchResults');
        resultsContainer.empty();
        $('#suggestedContent').hide();

        if (results.length > 0) {
            results.forEach(function (blog) {
                const resultHtml = `
                  <div class='col-xxl-4 col-xl-6 col-lg-6 col-md-6 col-12 g-3'>
                      ${blog.blog_content}
                  </div>
            `;
                resultsContainer.append(resultHtml);
            });
        } else {
            resultsContainer.html("<div class='text-secondary mx-auto text-center fs-2 fw-semibold'>No Results Found</div>");
        }
    }
</script>
<?php include "../../component/footer.php" ?>
</body>
</html>
