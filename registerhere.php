<?php
include 'dbconnect.php';
$msgRegister= '';
//get new user registration detaisl
if(isset($_POST['register'])){
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $newuser = $_POST['newusername'];
    $newpass = $_POST['newpassword'];
    // get files details
    $profile = $_FILES['my-file'];
    $profileName = $_FILES['my-file']['name'];
    $profileTmpName = $_FILES['my-file']['tmp_name'];
    $profileSize = $_FILES['my-file']['size'];
    $folder = "profileImages/";
    if($profileSize <= 1000000){
      move_uploaded_file($profileTmpName,$folder.$profileName);
      //get existing usersand match
      $query = "select *from admin";
      //run query
      $result = mysqli_query($conn,$query);
      //get in array
      $usersList = mysqli_fetch_assoc($result);
      //free result and close conn
      mysqli_free_result($result);
      //get databse data
      $exuser = $usersList['username'];
      $expass = $usersList['password'];
      $exemail = $usersList['email'];
      $exname = $usersList['name'];
      //insert query
      $query = "insert into admin(name,username,password,email,picture) values('$fullname','$newuser','$newpass','$email','$profileName')";
      //check if user already exists
      if($newuser === $exuser && $newpass === $expass && $email === $exemail && $fullname === $exname){
          $msgRegister= "<div class='alert alert-danger' role='alert'>User already exists</div>";
      }else{
      if(mysqli_query($conn,$query)){
        //success
        $msgRegister= "<div class='alert alert-success' role='alert'>Registration Success</div>";
        header("Location:loginhere.php");
      }else{
        $msgRegister= "<div class='alert alert-danger' role='alert'>Registration Failed</div>";
      }
    }
  }else{
    $msgRegister= "<div class='alert alert-danger' role='alert'>File size must be less than 1mb.</div>";
  }

}
?>
<?php include 'header.php' ?>

<!-- register form -->
<div class="container register-here-div">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="col-lg-6">
        <p class="text-center all-ptitles">CUSTOMER REGISTRATION</p>
      <form class="form-group register-here-div-form" action="" method="post" enctype="multipart/form-data">
        <p class="text-center">Please carefully provide your credentials</p>
        <div class="row">
          <div class="col">
            <input class="form-control"type="text" name="fullname" value="" required="" placeholder="Full Name"><br>
          </div>
          <div class="col">
            <input class="form-control"type="text" name="email" value="" required="" placeholder="Email"><br>
          </div>
          </div>
          <div class="form-group">
            <input class="form-control"type="text" name="newusername" value="" required="" placeholder="Choose Username">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="newpassword" value="" required="" placeholder="Choose Password"><br>
          </div>
                <label>Upload a Profile Picture</label>
                <input type="file" name="my-file" value="" class="form-control" placeholder="Image1">
        <input type="submit" name="register" class="btn btn-primary register-here-btn" value="REGISTER ME">
        <p><?php echo $msgRegister; ?></p>
      </form>
    </div>
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
