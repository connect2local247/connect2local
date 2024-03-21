$(document).ready(function(){
  $('#submitButton').on('click', function(){
      // Get the password entered by the user
      var password = $('#password').val();

      // Here, you should compare the entered password with the actual password from the server
      var correctPassword = '<?php echo $password; ?>'; // Replace this with the actual decrypted password from the server

      if(password === correctPassword){
          // If password is correct, enable the "Yes" button in the second modal
          $('#submitSecondModal').prop('disabled', false);
      } else {
          // If password is incorrect, show an alert message
          alert('Incorrect password. Please try again.');
      }
  });
});

