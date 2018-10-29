<?php
/**
 *
 */
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "coder_forum";
    $conn = mysqli_connect($server,$username,$password,$database);
    if(mysqli_connect_errno()){
      echo "Failed to connect".mysqli_connect_errno();
    }

 ?>
