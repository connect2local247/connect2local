<div class="container">
        <div class="search-bar  mt-1 position-relative">
            <form id="searchForm"  method="post" class="p-2">
                <div class="search-bar-container position-relative p-2 rounded-top d-flex justify-content-center">
                    <div class="search-container position-relative w-75">
                        <input type="text" class="form-control border border-dark rounded-pill p-2 pe-3 ps-2" name="search-business" id="search-business" placeholder="Search here...">
                        <button type="submit" class="btn py-2 px-3 position-absolute top-0 end-0" style="z-index:10" name="search"><i class="fa-solid fa-magnifying-glass text-bg-light"></i></button>
                    </div>
                    <!-- Use a select tag for filter options -->
                    <div class="select-container">
                        <label for="filterDropdown" class="visually-hidden">Filter By</label>
                        <select class="form-select mx-1 text-bg-dark p-2" id="filterDropdown" name="filter">
                            
                            <option value="category">Category</option>
                            <option value="business name">Business Name</option>
                            <option value="bp_username">Username</option>
                        </select>
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
        document.getElementById('filterDropdown').addEventListener('change', function () {
            const selectedFilter = this.value;
            document.getElementById('search-business').placeholder = `Search ${selectedFilter} here...`;
        });

        $(document).ready(function () {
            $('#searchForm').submit(function (e) {
                e.preventDefault();

                const searchQuery = $('#search-business').val().trim();
                if (searchQuery === '') {
                    return; // Do nothing if the search bar is empty
                }

                const filterOption = $('#filterDropdown').val(); // Get the selected filter
                const formData = { 'search-business': searchQuery, 'filter': filterOption };

                $.ajax({
                    type: 'POST',
                    url: '/modules/search/search.php',
                    data: formData,
                    dataType: 'json',
                    success: function (results) {
                        displayResults(results, filterOption);
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });

        function displayResults(results, filterOption) {
            const resultsContainer = $('#searchResults');
            resultsContainer.empty();

            if (results.length > 0) {
                results.forEach(function (business) {
                    const profileImgUrl = business.hasOwnProperty('bp_profile_img_url') ? business.bp_profile_img_url : '/asset/image/user/profile.png';

                    const resultHtml = `
                <div class="business-search-card border shadow p-3 mt-1 rounded">
                    <div class="row">   
                        <div class="business-image col-lg-1 col-3 d-flex justify-content-end position-relative">
                            <img src="${profileImgUrl}" class="position-absolute end-0 top-0 rounded-circle" style="height:50px;width:50px">
                        </div>
                        <div class="result-content col-lg-9 col-8 d-flex flex-column">
                            <span class="bp_username fw-bold" style="font-size:17px">${business.bp_username}</span>
                            <span class="business-name" style="font-size:13px;">${business.business_name}</span>
                        </div>
                        <div class="col-lg-2 col-2 d-flex align-items-center justify-content-center">
                            <button class="btn border border-info text-primary rounded-pill">View Profile</button>
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
