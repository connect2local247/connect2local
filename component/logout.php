<?php
// Start PHP session
// session_start();

// Check if the 'status' parameter is set in the GET request
if(isset($_GET['status'])){
    // Check if the value of 'status' is 'yes'
    if($_GET['status'] === 'yes'){ 
      session_start();// Use '===' for strict comparison
        // Destroy the session
        session_unset(); // Unset all session variables
        // Redirect to index.php
        header("Location:/index.php");
        // Exit the script to prevent further execution
        exit;
    }
}
?>

<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-bg-dark">
      <div class="modal-header position-relative">
        <h5>Logout</h5>
        <i class="fa-solid fa-xmark position-absolute end-0 me-2 p-2 fs-5" data-bs-dismiss="modal" aria-label="Close"></i>
      </div>
      <div class="modal-body">
          <span>Are you sure to logout ?</span>
      </div>
      <div class="modal-footer">
          <button class="btn btn-danger" onclick="location.href='/component/logout.php?status=yes'">Yes</button>
          <button class="btn btn-primary" data-bs-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>