<?php
session_start();

include "../../../../includes/table_query/db_connection.php";

if (isset($_SESSION['cp_user_id'])) {
    $customer_id = $_SESSION['cp_user_id'];
    $get_data_query = "SELECT * FROM customer_profile WHERE cp_user_id = '$customer_id'";
    $result = mysqli_query($GLOBALS['connect'], $get_data_query);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $customer_id = $row['c_id'];

        $customerQuery = "SELECT c_fname,c_lname,c_gender,c_birth_date FROM customer_register  WHERE c_id = '$customer_id'";

        $customerResult = mysqli_query($GLOBALS['connect'],$customerQuery);

        if(mysqli_num_rows($customerResult) > 0){
            $data = mysqli_fetch_assoc($customerResult);
            $fname = $data['c_fname'];
            $lname = $data['c_lname'];
            $birth_date = $data['c_birth_date'];
            $gender = $data['c_gender'];
            $cp_username = $row['cp_username'];
            $cp_profile_img_url = $row['cp_profile_img_url'];
            $cp_update_time = $row['cp_update_time'];
        }
        // $opening_hours = $row['']
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

    <link rel="stylesheet" href="/asset/css/form.css">
</head>
<body class="text-bg-dark w-100" style="height:100vh">
    <script>
        path = "/user/customer/dashboard/dashboard.php";
    </script>
    <?php
    include "../../../../component/form-alert.php";
    unset($_SESSION['error']);
    ?>

    <form action="/user/customer/dashboard/code/edit-profile-validation.php" method="POST" class="d-flex p-2" enctype="multipart/form-data">   
        <div class="card text-bg-dark border m-auto col-lg-4">
            <div class="card-content">
                <div class="card-header border-bottom text-center">
                    <h1>Edit Profile</h1>
                    <?php if(isset($cp_username)): ?>
                        <p><?php echo $cp_username; ?></p>
                    <?php endif; ?>
                </div>
                <div class="card-body d-flex flex-column">
                    <div class="mt-2 m-auto">
                        <div class="image-container border p-4 rounded-3 position-relative">
                            <?php if(isset($cp_profile_img_url)): ?>

                                <img src="/database/data/user/<?php echo $cp_profile_img_url; ?>" class="rounded-circle" style="height:150px;width:150px" alt="">

                            <?php else: ?>
                                <img src="/asset/image/user/profile.png" class="rounded" style="height:150px;width:150px" alt="">
                            <?php endif; ?>
                            <input type="file" name="cp_profile_img_url" id="profilePhotoInput" style="display:none;" accept="image/*">
                            <i class="fa-solid fa-pen-to-square fs-5 position-absolute bottom-0 me-4 mb-2" id="penIcon"></i>
                        </div>
                        <div class="mt-2">
                            <input type="text" name="username" id="cp_username" value="<?php echo isset($cp_username) ? $cp_username : ''; ?>" placeholder="username" class="form-control" required>
                        </div>
                    </div>

                    <div class="mt-5">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12 g-2">
                                <input type="text" name="fname" id="cp_fname" value="<?php echo isset($fname) ? $fname : ''; ?>" placeholder="First Name" class="form-control" required>
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
                
                    <div class="mt-4 d-flex">
                        <input type="submit" name="submit" value="Update" class="btn btn-primary m-auto px-5 py-3 rounded-pill">
                    </div>
                </div>
            </div>
        </div>
    </form>

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
</body>
</html>
