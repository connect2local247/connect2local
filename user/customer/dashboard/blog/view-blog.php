<?php
      include "../../../modules/blog/blog-data.php";

      function getRandomBlogIDs($minCount = 5, $maxCount = 10) {
      
          // Query to select random blog IDs from the blog_data table
          $query = "SELECT blg_id FROM blog_data ORDER BY RAND() LIMIT " . mt_rand($minCount, $maxCount);
          $result = mysqli_query($GLOBALS['connect'], $query);

          $blogIDs = [];
          while ($row = mysqli_fetch_assoc($result)) {
              $blogIDs[] = $row['blg_id'];
          }

          return $blogIDs;
}




?>
<div class="container">
        <div class="search-bar  mt-1 position-relative">
            <form id="searchBlog"  method="post" class="p-2" style="overflow-x: auto; white-space: nowrap;">
                <div class="search-bar-container position-relative p-2 rounded-top d-flex justify-content-center">
                  <div class="search-container position-relative w-75">
                    <input type="text" class="form-control border border-dark rounded-pill p-2 pe-3 ps-2" name="search-blog" id="search-blog" placeholder="Search blog here...">
                    <button type="submit" class="btn py-2 px-3 position-absolute top-0 end-0" style="z-index:10" name="search"><i class="fa-solid fa-magnifying-glass text-bg-light"></i></button>
                  </div>
                </div>
                <div class="row result-container w-100 p-1 position-relative vertical-bar " style="max-width:100%;" id="searchResults">
                        
                <?php
// Counter variable to keep track of the number of fetched blogs
$counter = 0;

// Loop to generate and access random blog IDs
for ($i = 0; $i < 10; $i++) { // Change 10 to the maximum number of blogs you want
    // Generate a random number between 5 and 10 for the number of IDs to fetch
    $count = mt_rand(5, 10);

    // Query to select random blog IDs from the blog_data table
    $query = "SELECT blg_id FROM blog_data ORDER BY RAND() LIMIT $count";
    $result = mysqli_query($GLOBALS['connect'], $query);

    while ($row = mysqli_fetch_assoc($result)) {
        // Increment the counter
        $counter++;

        echo "<div class='col-lg-4 col-md-6 col-12 g-3' id='suggested-content'>";
        fetch_blog($row['blg_id'], $_SESSION['c_id']);
        echo "</div>";

        // Break out of the loop if 10 blogs have been fetched
        if ($counter >= 10) {
            break 2; // Break out of both the inner and outer loops
        }
    }
}
?>

                            
                        
                </div>
            </form>

            <script>
              $(document).ready(function () {
    $('#searchBlog').submit(function (e) {
        e.preventDefault();

        const searchQuery = $('#search-blog').val().trim();
        if (searchQuery === '') {
            return; // Do nothing if the search bar is empty
        }

        const formData = { 'search-blog': searchQuery };

        $.ajax({
            type: 'POST',
            url: '/user/customer/dashboard/blog/search-blog.php', // Modify the URL according to your file structure
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
                  <div class='col-lg-4 col-md-6 col-12 g-3'>
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
        </div>
    </div>