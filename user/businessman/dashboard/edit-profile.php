<?php
        session_start();

        function get_user_data(){
                $business_id = $_SESSION['business_id'];
                

                $get_data_query = "SELECT * FROM business_profile WHERE B_ID = '$business_id'";

                $result = mysqli_query($GLOBALS['connect'],$get_data_query);

                if(mysqli_num_rows($result) > 0){
                    
                }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <?php include "../../../asset/link/cdn-link.html"; ?>
</head>
<body class="text-bg-dark w-100" style="height:100vh">
            <form action="/user/businessman/dashboard/code/edit-profile-validation.php" method="POST" class="d-flex p-2">   
                    <div class="card text-bg-dark border m-auto col-lg-4">
                        <div class="card-content">
                            <div class="card-header border-bottom text-center">
                                <h1>Edit Profile</h1>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="mt-2 m-auto">
                                    <div class="image-container border p-4 rounded-3 position-relative">
                                        <img src="/asset/image/user/profile.png" class="rounded" style="height:150px;width:150px" alt="">
                                        <input type="file" id="profilePhotoInput" style="display:none;" accept="image/*">

                                        <i class="fa-solid fa-pen-to-square fs-5 position-absolute bottom-0 me-4 mb-2" id="penIcon"></i>

                                        <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    // Get the pen icon and profile photo input elements
                                                    var penIcon = document.getElementById('penIcon');
                                                    var profilePhotoInput = document.getElementById('profilePhotoInput');

                                                    // Add click event listener to the pen icon
                                                    penIcon.addEventListener('click', function() {
                                                        // Trigger the file input when the pen icon is clicked
                                                        profilePhotoInput.click();
                                                    });

                                                    // Add change event listener to the file input
                                                    profilePhotoInput.addEventListener('change', function() {
                                                        // Handle the file selection and update the profile photo accordingly
                                                        var selectedFile = profilePhotoInput.files[0];
                                                        if (selectedFile) {
                                                            // You can use FileReader to display the selected image preview
                                                            var reader = new FileReader();
                                                            reader.onload = function(e) {
                                                                // Update the profile photo with the selected image preview
                                                                document.querySelector('.image-container img').src = e.target.result;
                                                            };
                                                            reader.readAsDataURL(selectedFile);
                                                        }
                                                    });
                                                });
                                            </script>

                                    </div>
                                </div>

                                <div class="mt-5">
                            <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12 g-2">
                                        <input type="text" name="fname" id="fname" value="" placeholder="First Name" class="form-control" required>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12 g-2">
                                    <input type="text" name="lname" id="lname" value="" placeholder="Last Name" class="form-control" required>
                                    </div>
                            </div>
                        </div>

                        <div class="mt-2">
                            <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12 g-2">
                                        <input type="date" name="birth-date" id="birth-date" value="" class="form-control" required>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12 g-2">
                                    <select class="form-select border-dark p-2" name="gender" required>
                                        <option value="" disabled selected>Select gender</option>
                                        <option value="Male" <?php if (isset($_SESSION['gender']) && $_SESSION['gender'] === 'Male') echo 'selected'; ?>>Male</option>
                                        <option value="Female" <?php if (isset($_SESSION['gender']) && $_SESSION['gender'] === 'Female') echo 'selected'; ?>>Female</option>
                                        <option value="Other" <?php if (isset($_SESSION['gender']) && $_SESSION['gender'] === 'Other') echo 'selected'; ?>>Other</option>
                                    </select>
                                    </div>
                            </div>
                        </div>

                        <div class="mt-2">
                            <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12 g-2">
                                        <input type="text" name="address"  id="address" value="" placeholder="Shop Address" class="form-control" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 g-2">
                                        <select name="category" class="form-select" required>
                                        <option value="" disabled selected>Select Category</option>
                                <?php
                                $categories = array(
                                    'Advertising',
                                    'Clothing',
                                    'Construction',
                                    'Automobile',
                                    'Bicycle',
                                    'Stationary',
                                    'Electronics',
                                    'Education',
                                    'Environment',
                                    'Fashion',
                                    'Beauty Parlor',
                                    'Legal Services',
                                    'Gift Articles',
                                    'Mobile And Computer',
                                    'Restaurants',
                                    'Delivery Services',
                                    'Hospital And Medical Store',
                                    'Others'
                                );

                                foreach ($categories as $category) {
                                    echo '<option value="' . $category . '" ' . isSelected($category) . '>' . $category . '</option>';
                                }

                                function isSelected($category) {
                                    return (isset($_SESSION['category']) && $_SESSION['category'] === $category) ? 'selected' : '';
                                }
                                ?>
                            </select>

                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-3 col-12 ">
                            <div class="col-12 g-2">
                                <textarea name="bio" id="bio" cols="5" rows="3" class="form-control w-100 border-dark" placeholder="Write Something..."></textarea>
                            </div>
                        </div>

                        <div class="mt-4 d-flex">
                            <input type="submit" name="submit" value="Update" class="btn btn-primary m-auto px-5 py-3 rounded-pill">
                        </div>
                            </div>
                        </div>
                    </div>
            </form>
</body>
</html>