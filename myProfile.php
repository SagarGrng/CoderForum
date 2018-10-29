<?php
include 'database.php';
include_once 'header.php';
$folder = "profileImages/";

class UserProfile
{
  public function getUserProfile($conn){
    $name = $_SESSION['uname'];
    $query = "select *from admin where username ='$name'";
    $result = mysqli_query($conn,$query);
    global $userArr;
    $userArr = mysqli_fetch_array($result);
  }
  public function fetchData($conn){
    $name = $_SESSION['uname'];
    $query = "select *from discussion where created_by ='$name'";
    $data = mysqli_query($conn,$query);
    global $dataArr;
    $dataArr = mysqli_fetch_all($data,MYSQLI_ASSOC);
  }
}
//create object of the class and run function
$user = new UserProfile();
$userProfile = $user->getUserProfile($conn);
$userProfile = $user->fetchData($conn);

?>
<div class="profile-div">
  <div class="container">
    <div class="col-lg-6 user-profile-col">
      <div class="row">
        <img src="<?php echo $folder.$userArr['picture'];?>" alt="" width="100px" height="80px">
        <p><?php echo $userArr['username'];?></p>
      </div>
    </div>
    <p id="line-break"></p>
    <div class="row user-profile-setting-col">
      <p>Overview</p>
        <p>Edit Account</p>
    </div>
  </div>
</div>
<div class="container" id="second-profile-div">
  <div class="row">
    <div class="col-lg-8">
    <?php foreach ($dataArr as $d) { ?>
      <div class="row user-profie-data-row">
        <div class="col-lg-1">
          <img src="<?php echo $folder.$userArr['picture'];?>" alt="" width="40px" height="30px">
          <p><?php echo $userArr['username'];?></p>
        </div>
        <div class="col-lg-11">
          <p class="user-profile-data-title"><?php echo $d['title'];?></p>
          <p><?php echo $d['sub_title'];?></p>
          <p><?php echo $d['description'];?></p>
          <p class="text-right created-at-p"><?php echo $d['created_at'];?></p>
        </div>
      </div>
  <?php  } ?>
    </div>
    <div class="col-lg-3 user-profile-overview-div">

    </div>
  </div>
</div>


<?php
    include 'footer.php';
?>
