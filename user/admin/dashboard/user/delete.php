<?php
      if(isset($_GET['id'])){
        $id = $_GET['id'];

        $query = "DELETE from customer_register where c_id = '$id'";
        $result = mysqli_query($GLOBALS['connect'],$query);

        $query = "DELETE from customer_verification where c_id = '$id'";
        $result = mysqli_query($GLOBALS['connect'],$query);

      }

      if(isset($_GET['b_id'])){
        $id = $_GET['b_id'];

        $query = "DELETE from business_register where b_id = '$id'";
        $result = mysqli_query($GLOBALS['connect'],$query);
        die($query);

        $query = "DELETE from business_verification where b_id = '$id'";
        $result = mysqli_query($GLOBALS['connect'],$query);

      }
?>