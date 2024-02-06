<?php
session_start();

include "../../../../includes/table_query/db_connection.php";

if (isset($_SESSION['user_id'])) {
    $business_id = $_SESSION['user_id'];

    $get_data_query = "SELECT * FROM business_profile WHERE USER_ID = '$business_id'";
    $result = mysqli_query($GLOBALS['connect'], $get_data_query);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $username = $row['USERNAME'];
        $fname = $row['FNAME'];
        $lname = $row['LNAME'];
        $birth_date = $row['BIRTH_DATE'];
        $gender = $row['GENDER'];
        $business_name = $row['BUSINESS_NAME'];
        $address = $row['ADDRESS'];
        $category = $row['CATEGORY'];
        $profile_img = $row['PROFILE_IMG'];
        $bio = $row['BIO'];
        $update_time = $row['UPDATE_TIME'];
        $business_id = $row['B_ID'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <?php include "../../../../asset/link/cdn-link.html"; ?>
</head>
<body class="text-bg-dark w-100" style="height:100vh">
    <form action="/user/businessman/dashboard/code/edit-profile-validation.php" method="POST" class="d-flex p-2" enctype="multipart/form-data">   
        <div class="card text-bg-dark border m-auto col-lg-4">
            <div class="card-content">
                <div class="card-header border-bottom text-center">
                    <h1>Edit Profile</h1>
                    <?php if(isset($username)): ?>
                        <p><?php echo $username; ?></p>
                    <?php endif; ?>
                </div>
                <div class="card-body d-flex flex-column">
                    <div class="mt-2 m-auto">
                        <div class="image-container border p-4 rounded-3 position-relative">
                            <?php if(isset($profile_img)): ?>
                                <img src="<?php echo $profile_img; ?>" class="rounded" style="height:150px;width:150px" alt="">
                            <?php else: ?>
                                <img src="/asset/image/user/profile.png" class="rounded" style="height:150px;width:150px" alt="">
                            <?php endif; ?>
                            <input type="file" name="profile_img" id="profilePhotoInput" style="display:none;" accept="image/*">
                            <i class="fa-solid fa-pen-to-square fs-5 position-absolute bottom-0 me-4 mb-2" id="penIcon"></i>
                        </div>
                        <div class="mt-2">
                            <input type="text" name="username" id="username" value="<?php echo isset($username) ? $username : ''; ?>" placeholder="Username" class="form-control" required>
                        </div>
                    </div>

                    <div class="mt-5">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12 g-2">
                                <input type="text" name="fname" id="fname" value="<?php echo isset($fname) ? $fname : ''; ?>" placeholder="First Name" class="form-control" required>
                            </div>

                            <div class="col-lg-6 col-md-6 col-12 g-2">
                                <input type="text" name="lname" id="lname" value="<?php echo isset($lname) ? $lname : ''; ?>" placeholder="Last Name" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="mt-2">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12 g-2">
                                <input type="date" name="birth-date" id="birth-date" value="<?php echo isset($birth_date) ? $birth_date : ''; ?>" class="form-control" required>
                            </div>

                            <div class="col-lg-6 col-md-6 col-12 g-2">
                                <select class="form-select border-dark p-2" name="gender" required>
                                    <option value="" disabled selected>Select gender</option>
                                    <option value="Male" <?php if (isset($gender) && $gender === 'Male') echo 'selected'; ?>>Male</option>
                                    <option value="Female" <?php if (isset($gender) && $gender === 'Female') echo 'selected'; ?>>Female</option>
                                    <option value="Other" <?php if (isset($gender) && $gender === 'Other') echo 'selected'; ?>>Other</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mt-2">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12 g-2">
                                <input type="text" name="address"  id="address" value="<?php echo isset($address) ? $address : ''; ?>" placeholder="Shop Address" class="form-control" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 g-2">
                                <select name="category" class="form-select" required>
                                    <option value="" disabled>Select Category</option>
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
                                        echo '<option value="' . $category . '" ' . (isset($category) && $category === $selectedCategory ? 'selected' : '') . '>' . $category . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-3 col-12 ">
                        <div class="col-12 g-2 position-relative">
                            <textarea name="bio" id="bio" cols="5" rows="3" class="form-control w-100 border-dark positon-relative" placeholder="Write Something..." maxlength="150"><?php echo isset($bio) ? $bio : ''; ?> </textarea>
                            <div id="bio-counter" class="text-secondary text-end position-absolute bottom-0 end-0 me-1 mb-1">0/150</div>
                        </div>
                    </div>

                    <div class="mt-4 d-flex">
                        <input type="submit" name="submit" value="Update" class="btn btn-primary m-auto px-5 py-3 rounded-pill">
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the bio textarea
            var bioTextarea = document.getElementById('bio');
            // Get the bio counter element
            var bioCounter = document.getElementById('bio-counter');

            // Add input event listener to bio textarea
            bioTextarea.addEventListener('input', function() {
                // Limit the character count to 150
                if (this.value.length > 150) {
                    this.value = this.value.substring(0, 150);
                }
                // Update the counter
                bioCounter.textContent = (0 + this.value.length)+ '/' + 150;
            });

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
</body>
</html>
