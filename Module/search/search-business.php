<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Business</title>
    <link rel="stylesheet" href="/asset/css/style.css">
    <?php include "../../asset/link/cdn-link.html"; ?>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="search-bar border mt-1 position-relative">
            <form id="searchForm" method="post" class="p-2">
                <div class="search-bar-container position-relative border p-2 rounded-top d-flex justify-content-center">
                    <div class="search-container position-relative w-75">
                        <input type="text" class="form-control border border-dark rounded-pill p-2 ps-3" name="search-business" id="search-business" placeholder="Search here...">
                        <button type="submit" class="btn py-2 px-3 position-absolute top-0 end-0" name="search"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-dark dropdown-toggle mx-1" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                            Filter
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" data-filter="category">Category</a></li>
                            <li><a class="dropdown-item" href="#" data-filter="business name">Business Name</a></li>
                            <li><a class="dropdown-item" href="#" data-filter="username">Username</a></li>
                            <li><a class="dropdown-item" href="#" data-filter="by opening hour">Opening hours</a></li>
                        </ul>
                    </div>
                </div>
                <div class="result-container w-100 p-1 position-relative" id="searchResults">
                    <!-- <div class="results border p-3 position-absolute top-0 w-100 start-0 text-center border-top-0 rounded-bottom" id="searchResults">
                         Search results will be dynamically added here
                    </div> -->
                </div>
            </form>
        </div>
    </div>

    <script>
        // JavaScript to update the placeholder based on the selected filter
        document.querySelectorAll('.dropdown-item').forEach(item => {
            item.addEventListener('click', () => {
                const selectedFilter = item.getAttribute('data-filter');
                document.getElementById('search-business').placeholder = `Search ${selectedFilter} here...`;
            });
        });

        $(document).ready(function () {
    $('#searchForm').submit(function (e) {
        e.preventDefault();

        const searchQuery = $('#search-business').val().trim();
        if (searchQuery === '') {
            return; // Do nothing if the search bar is empty
        }

        const filterOption = $('#filterDropdown').val(); // Assuming you have an id for the filter dropdown
        const formData = { 'search-business': searchQuery, 'filter': filterOption };

        $.ajax({
            type: 'POST',
            url: 'search.php',
            data: formData,
            dataType: 'json',
            success: function (results) {
                displayResults(results);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

function displayResults(results) {
    const resultsContainer = $('#searchResults');
    resultsContainer.empty();

    if (results.length > 0) {
        results.forEach(function (business) {
            const resultHtml = `
                <div class="business-search-card border shadow p-3 mt-1 rounded">
                    <div class="row">   
                        <div class="business-image col-lg-1 col-3 d-flex justify-content-end position-relative">
                            <img src="/asset/image/user/profile.png" class="position-absolute end-0 top-0" style="height:50px;width:50px">
                        </div>
                        <div class="result-content col-lg-11 col-9 d-flex flex-column">
                            <span class="username fw-bold" style="font-size:17px">${business['USERNAME']}</span>
                            <span class="business-name" style="font-size:13px;">${business['BUSINESS_NAME']}</span>
                        </div>
                    </div>
                </div>
            `;
            resultsContainer.append(resultHtml);
        });
    } else {
        resultsContainer.html("<div class='text-secondary text-center'>No Results Found</div>");
    }
}


    </script>
</body>
</html>
