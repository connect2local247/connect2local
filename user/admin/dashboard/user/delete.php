<?php
      if(isset($_GET['id'])){
        $id = $_GET['id'];

        $query = "delete from customer_register where c_id = '$id'";
        $result = mysqli_query($GLOBALS['connect'],$query);

        $query = "delete from customer_verification where c_id = '$id'";
        $result = mysqli_query($GLOBALS['connect'],$query);

      }
?>