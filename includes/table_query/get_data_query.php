<?php
     function get_username($table_name,$id,$username_col,$id_col){
            $username_query = "SELECT $username_col FROM $table_name WHERE  $id_col = '$id' ";
            $result = mysqli_query($GLOBALS['connect'],$username_query);

            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);

                return $row[$username_col];
            }

            $_SESSION['error'] = "Username doesn't exist.";
            return "";
     }

     function get_user_id($table_name,$id,$user_id_col,$reference_id){
        $query = "SELECT $user_id_col FROM $table_name WHERE  $reference_id = '$id' ";
        $result = mysqli_query($GLOBALS['connect'],$query);

        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            return $row[$user_id_col];
        }

        $_SESSION['error'] = "User doesn't exist.";
        return "";
     }

     function get_single_data($table_name,$col_name,$unique_col,$unique_id){
            $query = "SELECT $col_name FROM $table_name WHERE $unique_col = '$unique_id'";
            $result = mysqli_query($GLOBALS['connect'],$query);

        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            return $row[$col_name];
        }

        return "";

     }
     
     function get_blog_data(){
        return 0;
     }
?>