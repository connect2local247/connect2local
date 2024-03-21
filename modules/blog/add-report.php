<?php


if(isset($_POST['submit'])){
  // include "../../includes/table_query/db_connection.php";
  function send_notification($current_user_id){
        $query = "INSERT INTO notification(n_content,n_type,n_user_id,n_time) VALUES ('has submitted a report ','report','$current_user_id',NOW())";
        $result = mysqli_query($GLOBALS['connect'],$query);
    }

    $conn = $GLOBALS['connect'];
    // Get the current user ID
    // $user_id = $_POST['user_id'];
    // die($conn);
    // Generate a unique report ID using imported function
    $report_id = generateUniqueID("blog_report", "BLGR", "report_id");

    if(isset($_SESSION['cp_user_id'])){
      $reporter_id = $_SESSION['cp_user_id'];
      // $reporter_user_id = $_SESSION['user_id']; // Assuming you have the reporter's user ID stored in session
    } else{
   
          $reporter_id = isset($bp_user_id) ? $bp_user_id : "";
        

    }
    if(isset($_POST['description']) && !empty($_POST['description'])) {
      $report_content = substr($_POST['description'], 0, 150); // Use description if provided
  } else {
      $report_content = $_POST['report_option']; // Use selected option if description is not provided
  }

    // Get other report data from the form
    // $report_content = isset($_POST['description']) ? substr($_POST['description'], 0, 150) : $_POST['report_option']; // Assuming the selected report option is stored in $_POST['report_option']

    // Optional: Check if description is set, and limit it to 150 characters
    // $report_description = : '';

    // Insert the report into the database
    // Assuming you have a database connection already established
    // Also assuming you have proper error handling in place
    $query = "SELECT blg_id,reporter_user_id from blog_report WHERE blg_id = '$blog_id' and reporter_user_id = '$reporter_id'";
    $result = mysqli_query($conn,$query);
    // die($query);
    if(mysqli_num_rows($result) <= 0){

    
   
    $sql = "INSERT INTO blog_report (report_id,blg_id, bp_user_id, reporter_user_id, report_time, report_status, report_content)
            VALUES ('$report_id','$blog_id', '$user_id', '$reporter_id', NOW(), 0, '$report_content')";

    if (mysqli_query($conn, $sql)) {
        // header("location:/modules/blog/blog.php");
        send_notification($current_user_id);
        echo "<script>alert('$current_user_id Report added successfully.'); </script>";
        unset($_POST['submit']);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  } else{
    echo "<script>alert('You have already Reported'); </script>";
    unset($_POST['submit']);

  }

}
?>
