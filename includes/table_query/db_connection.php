<?php
        $servername = "localhost";
        $username ="root";
        $password = "";
        $database = "connect2local";

        $connect = mysqli_connect($servername,$username,$password,$database);

        if(!$connect){
            die($connect);
        }

?>