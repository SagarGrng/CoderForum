<?php
include 'dbconnect.php';
//make current started session to resume
session_start();
//destroy session
session_destroy();
header("Location:index.php");
?>
