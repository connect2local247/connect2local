<?php
session_start();
require "../../includes/email_template/email_sending.php";
ini_set('SMTP', 'smtp.gmail.com');
ini_set('smtp_port', 587);

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    ini_set($email, 'connect2local247@gmail.com');
    $description = $_POST['description'];
    $subject = "Message From $fname $lname";
    // send_contact_mail($fname." ".$lname,$email,$subject,$description); 
    if (send_contact_mail($fname . " " . $lname, $email, $subject, $description)) {
        echo "<script>alert('Email sent successfully!')</script>";
    } else {
        $lastError = error_get_last();
        $errorMessage = $lastError ? $lastError['message'] : "Unknown error";
        error_log("Failed to send email: " . $errorMessage); // Log error
        echo "Failed to send email. Please check the error logs for more details.";
    }
}
?>



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
        <form action="#" method="post" class="d-flex justify-content-center align-items-center" style="height:80vh;width:100%">
            <fieldset class="border rounded-2 col-lg-8 p-3 d-flex flex-column" id="register-form">
                <legend class="text-center fw-bold fs-2 text-white">Contact Us</legend>

                <div class="mt-2">
    <div class="row">
        <div class="col-6">
            <input type="text" name="fname" id="fname" placeholder="First Name" class="form-control border-2 py-2 px-4 border-dark" pattern="[A-Za-z]{1,15}" required>
        </div>
        <div class="col-6">
            <input type="text" name="lname" id="lname" placeholder="Last Name" class="form-control border-2 py-2 px-4 border-dark" pattern="[A-Za-z]{1,15}" required>
        </div>
    </div>
</div>
<div class="mt-2">
    <input type="email" name="email" id="email" placeholder="Your Email Address" class="form-control border-2 py-2 px-4 border-dark" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}" required>
</div>


                <div class="mt-3 col-12">
    <div class="col-12 g-2 position-relative">
        <textarea name="description" id="description" cols="5" rows="3" class="form-control w-100 border-dark positon-relative" placeholder="Write Something..." maxlength="150" required><?php if(isset($description)){echo $description;}?></textarea>
        <div id="description-counter" class="text-secondary text-end position-absolute bottom-0 end-0 me-1 mb-1">0/150</div>
    </div>
</div>
                <div class="mt-4 d-flex justify-content-center">
                    <input type="submit" name="submit" id="register-btn" value="Submit" class="btn px-5 py-2 text-bg-primary">
                </div>
            </fieldset>
        </form>
    </div>
    <?php

            include "../../component/footer.php";
    ?>
   <script>
    var descriptionTextarea = document.getElementById('description');
    // Get the description counter element
    var descriptionCounter = document.getElementById('description-counter');

    // Update the counter initially
    updateCounter();

    // Add input event listener to description textarea
    descriptionTextarea.addEventListener('input', function() {
        // Limit the character count to 150
        if (this.value.length > 150) {
            this.value = this.value.substring(0, 150);
        }
        // Update the counter
        updateCounter();
    });

    // Function to update the counter
    function updateCounter() {
        if (descriptionTextarea.value.length === 0) {
            descriptionCounter.textContent = "0/150";
            descriptionTextarea.setAttribute("placeholder", "Write Something...");
        } else {
            descriptionCounter.textContent = (descriptionTextarea.value.length) + '/150';
            descriptionTextarea.removeAttribute("placeholder");
        }
    }
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>