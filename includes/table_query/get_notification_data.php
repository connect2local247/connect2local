<?php
      function sent_notification($type,$content,$user_id){
            $query = "INSERT INTO notification(n_content,n_user_id,n_type,n_time) VALUES ('$content','$user_id','$type',NOW())";
            $result = mysqli_query($GLOBALS['connect'],$query);

            if($result){
              return true;
            }
            return false;
      }
?>