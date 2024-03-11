<?php
        include "../../../includes/email_template/email_sending.php";
        if((isset($_GET['request_id']) && isset($_GET['name']) && isset($_GET['business_name']) && isset($_GET['email']))){
            $request_id = $_GET['request_id'];
            $name = $_GET['name'];
            $email = $_GET['email'];
            $business_name = $_GET['business_name'];
            if(isset($_GET['action'])){
              $action = $_GET['action'];

              if($action == "accept"){
                      $query = "UPDATE business_add_status SET approval_status = 1,approval_time=NOW() WHERE request_id = '$request_id'";
                      $result = mysqli_query($GLOBALS['connect'],$query);

                      if(!$result){
                          echo "<script>alert('Request Not Updated')</script>";
                      } else{
                        $subject = "Business Request Approved - Connect2Local";
                        $acceptance_template = "
                        <div style='max-width: 600px; margin: 0 auto; padding: 20px; font-family: \"Arial\", sans-serif; background-color: #f8f8f8;'>
                        
                            <div style='text-align: center;'>
                                <img src='https://live.staticflickr.com/65535/53417631216_2be8f41b9e_n.jpg' alt='Connect2local' style='max-width: 100px;'>
                            </div>
                        
                            <div style='text-align: center;'>
                                <h1 style='color: #333; margin-top: 10px;'>Connect2Local</h1>
                            </div>
                        
                            <div>
                                <p>Hello $name,</p>
                        
                                <p>We are thrilled to inform you that your business request for adding $business_name has been approved! Welcome aboard to Connect2Local.</p>
                        
                                <p>You can now enjoy the benefits of our platform. We'll be in touch with further instructions and details.</p>
                        
                                <p>If you have any questions or need assistance, please feel free to reach out to our support team.</p>
                        
                                <p style='color: #555; margin-top: 20px;'>Best regards,<br>Connect2Local Team</p>
                            </div>
                        
                        </div>
                        ";
                        send_mail($name,$email,$subject,$acceptance_template);                        
                      }
              }
              if($action == "reject"){
                $query = "UPDATE business_add_status SET approval_status = 0,approval_time=NOW() WHERE request_id = '$request_id'";
                $result = mysqli_query($GLOBALS['connect'],$query);

                if($result){
                  $subject = "Business Request Denied - Connect2Local";
                  $rejection_template = "
                  <div style='max-width: 600px; margin: 0 auto; padding: 20px; font-family: \"Arial\", sans-serif; background-color: #f8f8f8;'>

                      <div style='text-align: center;'>
                          <img src='https://live.staticflickr.com/65535/53417631216_2be8f41b9e_n.jpg' alt='Connect2local' style='max-width: 100px;'>
                      </div>

                      <div style='text-align: center;'>
                          <h1 style='color: #333; margin-top: 10px;'>Connect2Local</h1>
                      </div>

                      <div>
                          <p>Hello $name,</p>

                          <p>We regret to inform you that your business request for adding $business_name has been denied.</p>

                          <p>We appreciate your interest in Connect2Local, but unfortunately, we are unable to proceed with your request at this time.</p>

                          <p>If you have any questions or would like further clarification, please feel free to reach out to our support team.</p>

                          <p style='color: #555; margin-top: 20px;'>Best regards,<br>Connect2Local Team</p>
                      </div>

                  </div>
                  ";
                  send_mail($name,$email,$subject,$acceptance_template); 
                } else{
                  echo "<script>alert('Request Not Updated')</script>";
                }
              }
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Business Information</title>
  <style>
    body {
      background-color: #333; /* Set background color of the page */
      color: white; /* Set text color */
      font-family: Arial, sans-serif; /* Set font family */
    }
    .table-container {
      margin-bottom: 20px; /* Add margin at the bottom */
    }
    table {
      width: 100%; /* Set table width to fill the container */
      border-collapse: collapse; /* Collapse borders */
      border: 2px solid #fff; /* Set border color and width */
      margin-bottom: 20px; /* Add margin at the bottom */
    }
    th, td {
      padding: 10px; /* Add padding to cells */
      text-align: center; /* Center-align text */
      border: 1px solid #fff; /* Set border color and width for cells */
    }
    th {
      background-color: #555; /* Set background color for header cells */
    }
    tr:nth-child(even) {
      background-color: #666; /* Set background color for even rows */
    }
    tr:nth-child(odd) {
      background-color: #444; /* Set background color for odd rows */
    }
    .accept-btn, .reject-btn {
      padding: 5px 10px; /* Add padding to buttons */
      border: none; /* Remove button border */
      cursor: pointer; /* Set cursor to pointer */
      background: linear-gradient(to right, #1abc9c, #16a085); /* Gradient background color for buttons */
      color: #fff; /* White text color for buttons */
    }
    .reject-btn {
      background: linear-gradient(to right, #e74c3c, #c0392b); /* Gradient background color for reject button */
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
  <div class="table-container w-100 overflow-auto vertical-bar">

  
  <h2>New Requests</h2>
<?php

    // Fetch requests for the given approval status
    $getNewRequestQuery = "SELECT * FROM business_add_status WHERE approval_status = 0 AND approval_time IS NULL";
    $result = mysqli_query($GLOBALS['connect'], $getNewRequestQuery);
    // die($getNewRequestQuery);
    if(mysqli_num_rows($result) > 0){
      echo "<div class='table-container'>
              <table class=' w-100 overflow-auto vertical-bar'>
                <tr>
                  <th>Business Code</th>
                  <th>Name</th>
                  <th>Business Name</th>
                  <th>Category</th>
                  <th>Address</th>
                  <th>Email</th>
                  <th>Contact</th>";
      
        echo "<th>Action</th>";
      
      echo "</tr>";
      
      while($row = mysqli_fetch_assoc($result)){
        // Fetch business info for the request
        $business_code = $row['business_code'];
        $query = "SELECT * FROM business_info WHERE business_code = '$business_code'";
        $result2 = mysqli_query($GLOBALS['connect'], $query);
        while($data = mysqli_fetch_assoc($result2)){
          $business_name = $data['business_name'];
          $name = $data['bi_fname']." ".$data['bi_lname'];
          $email = decryptData($data['bi_email'],$data['b_key']);
          $contact = decryptData($data['bi_contact'],$data['b_key']);
          $category = $data['bi_category'];
          $address  = $data['bi_address'];

          // Output each row of data as a table row with accept and reject buttons
          echo "<tr>
        <td>".$business_code."</td>
        <td>".$name."</td>
        <td>".$business_name."</td>
        <td>".$category."</td>
        <td>".$address."</td>
        <td>".$email."</td>
        <td>".$contact."</td>
        <td>
            <button class='accept-btn' onclick='location.href=\"?action=accept&request_id=".$row['request_id']."&content=request&email=$email&name=$name&business_name=$business_name\"'><i class='fas fa-check'></i></button>
            <button class='reject-btn' onclick='location.href=\"?action=reject&content=request&&email=$email&name=$name&business_name=$business_name&request_id=".$row['request_id']."\"'><i class='fas fa-times'></i></button>                  
        </td>";

            }
          }
          
          echo "</tr>";
    
      echo "</table></div>";
        } else {
      echo "<div class='table-container'>
            
              <p>No records found.</p>
            </div>";
    }



      // Fetch requests for the given approval status
      $getAcceptedRequestQuery = "SELECT * FROM business_add_status WHERE approval_status = 1 or approval_time != NULL";
      $result = mysqli_query($GLOBALS['connect'], $getAcceptedRequestQuery);
      // die($getNewRequestQuery);
      if(mysqli_num_rows($result) > 0){
        echo "<div class='table-container'>
                <h2>Accepted Requests</h2>
                <table class=' w-100 overflow-auto vertical-bar'>
                  <tr>
                    <th>Business Code</th>
                    <th>Name</th>
                    <th>Business Name</th>
                    <th>Category</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Contact</th>";
        
          echo "<th>Action</th>";
        
        echo "</tr>";
        
        while($row = mysqli_fetch_assoc($result)){
          // Fetch business info for the request
          $business_code = $row['business_code'];
          $query = "SELECT * FROM business_info WHERE business_code = '$business_code'";
          $result2 = mysqli_query($GLOBALS['connect'], $query);
          while($data = mysqli_fetch_assoc($result2)){
            $business_name = $data['business_name'];
            $name = $data['bi_fname']." ".$data['bi_lname'];
            $email = decryptData($data['bi_email'],$data['b_key']);
            $contact = decryptData($data['bi_contact'],$data['b_key']);
            $category = $data['bi_category'];
            $address  = $data['bi_address'];
  
            // Output each row of data as a table row with accept and reject buttons
            echo "<tr>
          <td>".$business_code."</td>
          <td>".$name."</td>
          <td>".$business_name."</td>
          <td>".$category."</td>
          <td>".$address."</td>
          <td>".$email."</td>
          <td>".$contact."</td>
          <td>
             Accepted                
          </td>";
  
              }
            }
            
            echo "</tr>";
      
        echo "</table></div>";
          } else {
        echo "<div class='table-container'>
               
                <p>No records found.</p>
              </div>";
      }


      $getRejectedRequestQuery = "SELECT * FROM business_add_status WHERE approval_status = 0 AND approval_time IS NOT NULL";

      $result = mysqli_query($GLOBALS['connect'], $getRejectedRequestQuery);
      // die($getNewRequestQuery);
      if(mysqli_num_rows($result) > 0){
        echo "<div class='table-container'>
                <h2>Rejected Requests</h2>
                <table class=' w-100 overflow-auto vertical-bar'>
                  <tr>
                    <th>Business Code</th>
                    <th>Name</th>
                    <th>Business Name</th>
                    <th>Category</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Contact</th>";
        
          echo "<th>Action</th>";
        
        echo "</tr>";
        
        while($row = mysqli_fetch_assoc($result)){
          // Fetch business info for the request
          $business_code = $row['business_code'];
          $query = "SELECT * FROM business_info WHERE business_code = '$business_code'";
          $result2 = mysqli_query($GLOBALS['connect'], $query);
          while($data = mysqli_fetch_assoc($result2)){
            $business_name = $data['business_name'];
            $name = $data['bi_fname']." ".$data['bi_lname'];
            $email = decryptData($data['bi_email'],$data['b_key']);
            $contact = decryptData($data['bi_contact'],$data['b_key']);
            $category = $data['bi_category'];
            $address  = $data['bi_address'];
  
            // Output each row of data as a table row with accept and reject buttons
            echo "<tr>
          <td>".$business_code."</td>
          <td>".$name."</td>
          <td>".$business_name."</td>
          <td>".$category."</td>
          <td>".$address."</td>
          <td>".$email."</td>
          <td>".$contact."</td>
          <td>
            Rejected              
          </td>";
  
              }
            }
            
            echo "</tr>";
      
        echo "</table></div>";
          } else {
        echo "<div class='table-container'>
                
                <p>No records found.</p>
              </div>";
      }
?>

</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
  // Function to handle accepting or rejecting a request
  function handleAction(action, requestId) {
    // Send AJAX request to PHP script
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/user/admin/dashboard/business-request/process-request.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
          // Update UI based on the action and response
          if (action === "accept") {
            // Move row to accepted requests table
            var row = document.getElementById("row-" + requestId);
            if (row) {
              row.remove(); // Remove the row from the table
            } else {
              console.error("Row not found for request ID: " + requestId);
            }
          } else if (action === "reject") {
            // Move row to rejected requests table
            var row = document.getElementById("row-" + requestId);
            if (row) {
              row.remove(); // Remove the row from the table
            } else {
              console.error("Row not found for request ID: " + requestId);
            }
          }
          alert(response.message); // Show success message
        } else {
          alert("Failed to process request. Please try again.");
        }
      }
    };
    xhr.send("action=" + action + "&requestId=" + requestId);
  }

  // Add event listeners to accept and reject buttons
  var acceptButtons = document.querySelectorAll(".accept-btn");
  var rejectButtons = document.querySelectorAll(".reject-btn");

  acceptButtons.forEach(function(button) {
    button.addEventListener("click", function() {
      var requestId = this.getAttribute("data-request-id");
      handleAction("accept", requestId);
    });
  });

  rejectButtons.forEach(function(button) {
    button.addEventListener("click", function() {
      var requestId = this.getAttribute("data-request-id");
      handleAction("reject", requestId);
    });
  });
});
</script>

</body>
</html>
