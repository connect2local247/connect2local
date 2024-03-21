<?php
if(isset($_GET['unblock_id'])){
    $business_user_id = $_GET['unblock_id'];

    $query = "DELETE FROM blocked_user_data WHERE bu_business_id = '$business_user_id' and bu_user_id = '$current_user_id'";
    $result = mysqli_query($GLOBALS['connect'],$query);
    
    if($result){
        unset($_GET['unblock_id']);
        // session_write_close(); // Write session data and close the session
        echo "<script> window.location.href='/user/customer/dashboard/dashboard.php?content=setting' </script>";
        exit;
    } else {
        echo "<script>alert('Error: Unable to unblock user')</script>";
        header("location:/user/customer/dashboard/dashboard.php");
        exit;
    }
}
?>
