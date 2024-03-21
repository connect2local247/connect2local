<?php
        session_start();
        require "../../includes/email_template/email_sending.php";


        if(isset($_POST['submit'])){
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $description = $_POST['description'];
            $subject = "Message From $fname $lname";
            send_contact_mail($fname." ".$lname,$email,$subject,$description); 
        }
?>