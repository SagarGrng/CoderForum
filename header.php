<?php
include 'database.php';
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
$_SESSION['sessionMsg'] = $signInMsg;
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
  <body id="myBody">
    <a href="#" id="sliding-nav-icon"><i class="fas fa-bars"></i></a>
    <header>
    <nav id="myNavbar">
      <a href="#" id="coders-room">CODERS ROOM</a>
      <div class="main-nav">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="loginhere.php" id="log-a-tag"><?php echo $signInMsg; ?></a></li>
          <li><a href="logout.php" id="log-out-tag">Logout</a></li>
        </ul>
      </div>
   </nav>
   <div class="sliding-nav" id="sliding-nav">
     <a href="#" id="close-sliding-nav"><i class="fas fa-times"></i></a>
     <ul>
       <a href="#" id="coders-room">CODERS ROOM</a>
        <li><a href="index.php">Home</a></li>
        <li><a href="index.php">Sign IN</a></li>
        <li><a href="index.php">Register</a></li>
     </ul>
   </div>
    </header>
