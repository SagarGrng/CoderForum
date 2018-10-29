<?php
require_once ('header.php');
global $folder;
$folder = "profileImages/";
global $id;
$id = $_GET['id'];

class Posts{
  public function fetchData($conn,$id){//fetch all post from discussion
      $query = "select *from discussion where id=".$id;
      $d = mysqli_query($conn,$query);
      global $data;
      $data = mysqli_fetch_array($d);
      $timestamp1 = strtotime($data['created_at']); //convert string time to integer
      global $date1,$date2;
      $date1 = date('m-d-Y H:i:sa',$timestamp1);
      $timestamp2 = strtotime($data['created_at']);
      $date2 = date('Y-m-d H:i:sa',$timestamp2);
  }
  //post comment function
  public function postComment($conn,$id){
    if(isset($_POST['submit'])){
      $comment = $_POST['comment'];
      $uname = $_POST['uid'];
      $pid = $_POST['postid'];
      $date = $_POST['date'];

      $query = "insert into comment(uname,post_id,date,comm) values('$uname','$pid','$date','$comment')";
      $result = mysqli_query($conn,$query);
      header("Location:viewpost.php?id=$id");
    }
  }
  public function displayComment($conn){
    $query = "select *from comment where post_id=".$_GET['id'];
    $data = mysqli_query($conn,$query);
    global $dataArr;
    $dataArr = mysqli_fetch_all($data);
  }
  //reply comment function
  public function replyComment($conn,$id){
    if(isset($_POST['reply'])){
      $userName = $_POST['user_name'];
      $commentId = $_POST['comment_id'];
      $replyDate = $_POST['reply_date'];
      $replyComment = $_POST['replies'];
      $query = "insert into replies(comment_id,user_name,date,reply) values('$commentId','$userName','$replyDate','$replyComment')";
      $result = mysqli_query($conn,$query);
      header("Location:viewpost.php?id=$id");
    }
  }
  // display replies function
  public function displayReplies($conn,$key){
    $query = "select *from replies where comment_id=".$key[0];
    $data = mysqli_query($conn,$query);
    $replyArr = mysqli_fetch_all($data);
    $replyArr;
   foreach ($replyArr as $key) {
     echo "<li>Replied <b>".$key[4]."</b>"." by ".$key[2]." on ".$key[3]."</li>";
   }
  }
}
$post = new Posts();
$postData = $post->fetchData($conn,$id);
$postData = $post->postComment($conn,$id);
$postData = $post->displayComment($conn);
$postData = $post->replyComment($conn,$id);
?>
<!-- styling div css -->
<div class="second-div-on-viewpost">
  <div class="container col-lg-8 second-div-post-details">
    <a href="#"><i class="fas fa-home"></i><?php echo " > ".$data['sub_title']; ?></a><br><br><br>
    <a href="#"><?php echo $data['sub_title']; ?></a>
  </div>
</div>
<div class="container first-div">
  <div class="row">
    <!-- first column -->
    <div class="col-lg-8 ">
      <!-- show data from db -->
        <div class="row discussion-data-row">
          <div class="col-lg-1">
            <img src="
            <?php
            $userName = $data['created_by'];
            $query = "select *from admin where username = '$userName'";
            $results = mysqli_query($conn,$query);
            $resultArr = mysqli_fetch_array($results);
            $imgRoot = $resultArr['picture'];
            echo $folder.$imgRoot;
            ?>" alt="" width="40px" height="30px">
          </div>
          <div class="col-lg-11">
            <p><b><?php echo $data['title'];?></b><br><small><?php echo "<b>Posted by ".$data['created_by']."</b>"." on ".$date1; ?></small></p>
            <p id="data-font"><?php echo $data['sub_title'];?></p>
            <p id="data-font"class="data-description"><?php echo $data['description'];?></p>
            <form class="" action="" method="post">
              <input type="hidden" name="uid" value="<?php echo $_SESSION['uname']; ?>">
              <input type="hidden" name="date" value="<?php echo date('Y-m-d H:i:s'); ?>">
              <input type="hidden" name="postid" value="<?php echo $data['id']; ?>">
              <textarea name="comment" rows="3" cols="60"></textarea><br>
              <input type="submit" name="submit" value="Post my comment">
            </form>
            <p><br><b>Recent Comments</b></p>
            <p class="comments"><?php
             foreach ($dataArr as $key) {
               echo ("<li style='border-top:1px solid black;'><b>".$key[4]."</b>"." by ".$key[1]." on ".$key[3]."</li><br>"); ?>
               <button type="button" name="button" id="show_replies">Show Replies</button>
                <div class="container col-lg-10" id="comment_replies_div">
                  <form class="" action="" method="post">
                     <!-- //show replies from database -->
                     <?php
                     $postData = $post->displayReplies($conn,$key);
                     ?>
                   <br>
                   <!-- set a form to get and post replies for each comment -->
                   <input type="hidden" name="user_name" value="<?php echo $_SESSION['uname']; ?>">
                   <input type="hidden" name="comment_id" value="<?php echo $key[0]; ?>">
                   <input type="hidden" name="reply_date" value="<?php echo date('Y-m-d H:i:s'); ?>">
                   <textarea name="replies" rows="2" cols="40"></textarea><br>
                   <input type="submit" name="reply" value="Reply Comment">
                 </form>
               </div>
               <br>
          <?php   }
             ?></p>
          </div>
        </div>
    </div>
    <!-- second column -->
  </div>
</div>


<?php
    include 'footer.php';
?>
