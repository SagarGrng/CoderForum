<?php
include 'database.php';
include 'header.php';
global $folder;
$folder = "profileImages/";

//set link according to user login status
if(isset($_POST['start-new'])){
  if(!empty($_SESSION['sessionMsg'])){
    header("Location:addTopic.php");
  }else{
    header("Location:loginhere.php");
  }
}
//fetch all post from discussion
function fetchData(){
  include 'database.php';
  $query = "select *from discussion ORDER BY created_at DESC";
  $data = mysqli_query($conn,$query);
  global $dataArr;
  $dataArr = mysqli_fetch_all($data,MYSQLI_ASSOC);
}
fetchData();

?>
<hr>
<div class="container first-div">
  <div class="row">
    <!-- first column -->
    <div class="col-lg-8 ">
      <!-- styling div css -->
      <div class="second-div">
        <form class="" method="post">
        <input type="submit" name="start-new" value="Start a New Topic" class="start-input" id="start-topic-href">
        </form>
      </div>
      <!-- show data from db -->
      <?php foreach ($dataArr as $d) { ?>
        <div class="row discussion-data-row">
          <div class="col-lg-1">
            <img src="
            <?php
            include 'database.php';
            $userName = $d['created_by'];
            $query = "select *from admin where username = '$userName'";
            $data = mysqli_query($conn,$query);
            $dataArr = mysqli_fetch_array($data);
            $imgRoot = $dataArr['picture'];
            echo $folder.$imgRoot;
            ?>" alt="" width="40px" height="30px">
          </div>
          <div class="col-lg-11">
          <p><a href="viewpost.php?id=<?php echo $d['id']; ?>"><b><?php echo $d['title'];?></b></a><br><small><?php echo "<b>".$d['created_by']."</b>"." at ".$d['created_at']; ?></small></p>
            <p id="data-font"><?php echo $d['sub_title'];?></p>
            <p id="data-font"class="data-description"><?php echo $d['description'];?></p><a href="viewpost.php?id=<?php echo $d['id']; ?>">read more...</a>
            <p class="text-right created-at-p"><?php echo $d['created_at'];?></p>
          </div>
        </div>
    <?php  } ?>
    </div>
    <!-- second column -->
    <div class="col-lg-3 overview-div">
      <p>Categories</p>
      <ul>
        <li><a href="#">Discussion</a></li>
        <li><a href="#">Discussion</a></li>
        <li><a href="#">Discussion</a></li>
        <li><a href="#">Discussion</a></li>
      </ul>
    </div>
  </div>
</div>


<?php
    include 'footer.php';
?>
