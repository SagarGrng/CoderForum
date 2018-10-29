<?php
include 'database.php';
$msgSuccess= '';

/**
 *
 */
class Login
{
  function getUsers($conn)
  {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    //get users from database
    $query = "select *from admin";
    //run query
    $result = mysqli_query($conn,$query);
    //get in array
    $usersList = mysqli_fetch_all($result,MYSQLI_ASSOC);
    //free result and close conn
    mysqli_free_result($result);
    mysqli_close($conn);
    // var_dump($usersList); //see arrays informations
    //check if username and passowrd matches by looping thorug each array
    foreach ($usersList as $users) {
      // code...
      $dbuser = $users['username'];
      $dbpass = $users['password'];
      if($user === $dbuser && $pass === $dbpass){
        $msgSuccess= "<div class='alert alert-success' role='alert'>Login Success</div>";
        session_start();
        $_SESSION['uname'] = $user;
        header("Location:index.php");
       }
      else{
        $msgSuccess= "<div class='alert alert-danger' role='alert'>Login Failed! Please Check Details</div>";
      }//end if statement here
    }//end for each here

  }
}
$sign = new Login();
if(isset($_POST['submit'])){
  $sign->getUsers($conn);
}
?>
<?php include_once 'header.php' ?>
<!--login form-->
<div class="container login-here-div">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="col-lg-6">
      <p class="text-center all-ptitles" style="">CUSTOMER LOGIN</p>
    <form class="form-group login-here-div-form" action="" method="post">
      <p class="text-center">Login with your credentials</p>
      <input class="form-control"type="text" name="username" value="" required="" placeholder="Username"><br>
      <input type="text" class="form-control" name="password" value="" required="" placeholder="Password"><br>
      <input type="submit" name="submit" class="btn btn-primary sign-in-btn" value="SIGN IN">
      <p><?php echo $msgSuccess; ?></p>
    </form>
    </div>
    <p>Not A Member?</p>
    <a href="registerhere.php">Sign Up Here!</a>
    </div>
  </div>
</div>
</body>
<!-- must include popper.js and jquery to run bootsrapdropdown menu -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
</html>
