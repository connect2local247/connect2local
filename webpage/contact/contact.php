<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Page</title>
   <?php include "../../asset/link/cdn-link.html"; ?>
    <link rel="stylesheet" href="/asset/css/style.css">
    <link rel="stylesheet" href="/asset/css/form.css">
</head>
<body id="form-body">

    <header>
        <?php
                include "../../component/navbar.php";
        ?>
    </header>
    <div class="container p-3">
        <form action="#" class="d-flex justify-content-center align-items-center" style="height:90vh;width:100%">
            <fieldset class="border rounded-2 col-lg-7 p-3 d-flex flex-column" id="register-form">
                <legend class="text-center fw-bold fs-2 text-white">Contact Us</legend>

                <div class="mt-2">
                    <div class="row">
                        <div class="col-6">
                            <input type="text" name="fname" id="fname" placeholder="First Name" class="form-control border-2 py-2 px-4 border-dark">
                        </div>
                        <div class="col-6">
                            <input type="text" name="lname" id="lname" placeholder="Last Name" class="form-control border-2 py-2 px-4 border-dark">
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <input type="email" name="email" id="email" placeholder="Your Email Address" class="form-control border-2 py-2 px-4 border-dark" required>
                </div>

                <div class="mt-2">
                    <textarea name="message" id="" cols="10" rows="5" placeholder="write your message here..." class="form-control border-2 py-2 px-4 border-dark" required></textarea>
                </div>
                <div class="mt-4 d-flex justify-content-center">
                    <input type="submit"  id="register-btn" value="Submit" class="btn px-5 py-2 text-bg-primary">
                </div>
            </fieldset>
        </form>
    </div>
    <?php

            include "../../component/footer.php";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>