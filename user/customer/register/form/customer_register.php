<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include "../../../../asset/link/cdn-link.html";?>
</head>
<body>
    <div class="container">
        <form action="" method="post" class="col-lg-9 col-md-10 col-12">
                <fieldset class="border p-4">
                    <legend class="text-center mb-5 mt-2">Register Form</legend>

                    <div class="mt-5">
                            <div class="row">
                                <div class="col-6">
                                    <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name"  required>
                                </div>

                                <div class="col-6">
                                    <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name" required>
                                </div>
                            </div>
                    </div>

                    <div class="mt-4">
                            <div class="row">
                                <div class="col-6">
                                    <input type="date" name="birth-date" id="birth-date" class="form-control" required>
                                </div>

                                <div class="col-6">
                                    <select class="form-select" name="gender" required>
                                        <option value="" disabled selected>Select gender</option>
                                        <option value="Male" <?php if (isset($_SESSION['gender']) && $_SESSION['gender'] === 'Male') echo 'selected'; ?>>Male</option>
                                        <option value="Female" <?php if (isset($_SESSION['gender']) && $_SESSION['gender'] === 'Female') echo 'selected'; ?>>Female</option>
                                        <option value="Other" <?php if (isset($_SESSION['gender']) && $_SESSION['gender'] === 'Other') echo 'selected'; ?>>Other</option>
                                    </select>
                                </div>
                            </div>
                    </div>

                    <div class="mt-4">
                            <div class="row">
                                <div class="col-6">
                                    <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name" required>
                                </div>

                                <div class="col-6">
                                    <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name" required>
                                </div>
                            </div>
                    </div>


                    <div class="mt-4">
                            <div class="row">
                                <div class="col-6">
                                    <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name" required>
                                </div>

                                <div class="col-6">
                                    <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name" required>
                                </div>
                            </div>
                    </div>

                </fieldset>
        </form>
    </div>
</body>
</html>