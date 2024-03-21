<?php
// Handle form submission to update user's two-step authentication setting
if(isset($_POST['flexSwitchCheckChecked'])) {
  $two_step_enabled = isset($_POST['flexSwitchCheckChecked']) ? 1 : 0;
  // echo "hello";
  // Update the database with the new two-step authentication setting
  $update_query = "UPDATE business_verification SET two_step_status = '$two_step_enabled' WHERE b_id = '$current_user_id'";
  mysqli_query($GLOBALS['connect'], $update_query);
  header("location:/user/businessman/dashboard/dashboard.php?content=setting");
}
?>
