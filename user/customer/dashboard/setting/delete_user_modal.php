<div class="modal fade" id="DeleteUserModal" aria-hidden="true" aria-labelledby="DeleteUserModalLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-bg-dark">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="DeleteUserModalLabel">Confirm It's You</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php
            $sql = "SELECT cr.c_email AS email, cr.c_password AS password,cv.c_key AS verification_key
            FROM customer_register AS cr
            INNER JOIN customer_verification AS cv ON cr.c_id =cv.c_id
            WHERE cr.c_id = '$current_user_id'";
    // die();

            $result = mysqli_query($GLOBALS['connect'],$sql);

            if(mysqli_num_rows($result) > 0){
                $data = mysqli_fetch_assoc($result);

                $key = $data['verification_key'];
                $email = decryptData($data['email'],$key);
                $password = decryptData($data['password'],$key);
            }
        ?>
       <form action="" method="POST" id="deleteUserForm">
            <div class="mt-2">
                <input type="email" class="form-control py-2 px-2" name="email" id="email" placheholder="Email Address" value="<?php if(isset($email)) echo $email ?>" readonly required>
            </div>
            <div class="mt-2">
               <input type="password" class="form-control py-2 px-2" name="password" id="password" placeholder="Password" required>
            </div>
        
      </div>
      <div class="modal-footer">
      <button id="submitButton" class="btn btn-primary">Submit</button>
    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </form>
      <script>
      $(document).ready(function(){
    $('#submitButton').on('click', function(e){
        // Prevent the default form submission behavior
        e.preventDefault();

        // Get the password entered by the user
        var password = $('#password').val();

        // Here, you should compare the entered password with the actual password from the server
        var correctPassword = '<?php echo $password; ?>'; // Replace this with the actual decrypted password from the server

        if(password == correctPassword){
            // If password is correct, close the first modal
            $('#DeleteUserModal').modal('hide');

            // Show the second modal
            $('#DeleteUserModal2').modal('show');

            // Add the data-bs-toggle attribute to enable toggling of the modal
            $(this).attr('data-bs-toggle', 'modal');
        } else {
            // If password is incorrect, show an alert message
            alert('Incorrect password. Please try again.');
            // Remove the data-bs-toggle attribute to disable toggling of the modal
            $(this).removeAttr('data-bs-toggle');
        }
    });
});



      </script>
      <!-- <script src="/asset/js/check_password.js"></script> -->
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="DeleteUserModal2" aria-hidden="true" aria-labelledby="DeleteUserModalLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-bg-dark">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="DeleteUserModalLabel2">Delete Account</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are You Sure to Delete Your Account ?
      </div>
      <div class="modal-footer">
        <!-- Disable the "Submit" button -->
        <button id="submitSecondModal" class="btn btn-primary">Yes</button>
        <button class="btn btn-primary" data-bs-dismiss="modal">No</button>
        <script>
$(document).ready(function(){
    $('#submitSecondModal').on('click', function(e){
        // Redirect the user to the dashboard page with the specified parameters
        window.location.href = "/user/customer/dashboard/dashboard.php?content=dashboard&delete_status=1&current_user_id=<?php echo $current_user_id ?>";
    });
});
</script>
      </div>
    </div>
  </div>
</div>

