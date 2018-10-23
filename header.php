<?php
include 'dbconnect.php';
// include 'register.php';
session_start();
$log = '';
$ifLogged = '';
$signInMsg = '';
//check if the session variable (uname) has user
//if has then set $user to name or else set $user to emtpy to make sure no warning appears
if(isset($_SESSION['uname'])){
  $user = $_SESSION['uname'];
  $log = "Logout";
  $ifLogged = 'logout.php';
  $signInMsg = $user;
}else{
  $user='';
  $log = "Login";
  $ifLogged='loginhere.php';
  $signInMsg = "Sign In";
}
//
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <meta charset="utf-8">
    <title>CMS</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-sm navbar-light bg-light" id="myNavbar">
      <div class="container">
        <a href="home.php" class="navbar-brand">CODER ROOM</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#my-navbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="my-navbar">
          <ul class="navbar-nav">
            <li class="navbar-nav">
                <a href="index.php">Home</a>
            </li>
            <li class="navbar-nav">
                <a href="index.php">Login</a>
            </li>
          </ul>
        </div>
        <div class="search-div" style="float:right;">
        <input type="text" name="Search" placeholder="search..."class="form-control"><a href="#"></a>
      </div>
      </div>
      <!-- dropdown menu in header -->
      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <a href="loginhere.php"></a>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <!-- <a class="dropdown-item" href="#">Another action</a> -->
          <p class="dropdown-item"></p>
          <a class="dropdown-item" href=""></a>
          <!-- <a class="dropdown-item" href="#">Something else here</a> -->
        </div>
      </div>
    </nav>
