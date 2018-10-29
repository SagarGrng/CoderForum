<?php
include 'dbconnect.php';
include 'header.php';
$addedmsg = '';
if(!isset($_SESSION)) {
  session_start();
}
    // echo "Success";
    //get data and insert in database
    if(isset($_POST['submit'])){
      $category = $_POST['category_name'];
      $title = $_POST['title'];
      $subTitle = $_POST['sub-title'];
      $status = $_POST['myRadio'];
      $description = htmlspecialchars($_POST['description']);
      $created_by = htmlspecialchars($_SESSION['uname']);
      //get details of file to be uploaded
      $file1 = $_FILES['uploadFile1'];
      $file2 = $_FILES['uploadFile2'];
      $file3 = $_FILES['uploadFile3'];
      $file1name = $_FILES['uploadFile1']['name'];
      $file2name = $_FILES['uploadFile2']['name'];
      $file3name = $_FILES['uploadFile3']['name'];
      $file1TmpName = $_FILES['uploadFile1']['tmp_name'];
      $file2TmpName = $_FILES['uploadFile2']['tmp_name'];
      $file3TmpName = $_FILES['uploadFile3']['tmp_name'];
      $file1Size = $_FILES['uploadFile1']['size'];
      $file2Size = $_FILES['uploadFile2']['size'];
      $file3Size = $_FILES['uploadFile3']['size'];
      //set folder location according to catoegory
      $folder = 'images/';
      // if($category==="jeans"){
      //   $folder = "images/Jeans/";
      // }if($category==="tops"){
      //   $folder = "images/Tops/";
      // }
      // check file size
      if($file1Size <= 5000000 && $file2Size <= 5000000 && $file3Size <= 5000000){
        //move the uploaded file to folder
        move_uploaded_file($file1TmpName,$folder.$file1name);//takes two parameters first the file temp location and second the folder to place the file along with file
        move_uploaded_file($file2TmpName,$folder.$file2name);
        move_uploaded_file($file3TmpName,$folder.$file2name);
        // insert all data
        $query = "insert into discussion(title,sub_title,description,status,image1,image2,image3,created_by) values('$title','$subTitle','$description','$status','$file1name','$file2name','$file3name','$created_by')";
        if(mysqli_query($conn,$query)){
          //success
          $addedmsg = "<div class='alert alert-success' role='alert'>Added to Database</div>";
        }
        else {
          echo "Error".mysqli_error($conn);
        }
      }else{
          $addedmsg = "<div class='alert alert-warning' role='alert'>File Size must be lessthat 5 MB.</div>";
      }
}




 ?>
<div class="container" id="start-a-topic-div" style="margin-top:5%;">
    <p>Start a New Topic</p>
</div>
 <div class="container start-a-topic-container">
   <form action="" method="post" enctype="multipart/form-data">
     <div  class="form-group">
       <label>Select Topic Category</label>
       <select class="form-control" name="category_name">
         <option value="discussion">General Duscussion</option>
         <option value="help">Help Post</option>
       </select>
     </div>
     <div class="form-group">
       <input type="text" name="title" value="" class="form-control" placeholder="Title">
     </div>
     <div class="form-group">
       <input type="text" name="sub-title" value="" class="form-control" placeholder="Sub Title">
     </div>
     <div class="form-group">
       <textarea name="description" class="form-control"rows="10" cols="80" placeholder="Description"></textarea>
     </div>
     <div class="form-group">
       <label class="form-group">Set the Topic status as:</label>
       <input type="radio" name="myRadio" value="open"checked>Open
       <input type="radio" name="myRadio" value="close">Close
     </div>
     <div class="form-group">
       <label>Select upto 3 images (Optional if you want only)</label>
       <input type="file" name="uploadFile1" value="" class="form-control" placeholder="Image1">
       <input type="file" name="uploadFile2" value="" class="form-control" placeholder="Image2">
       <input type="file" name="uploadFile3" value="" class="form-control" placeholder="Image3">
     </div>
     <input type="submit" name="submit" value="Post" class="btn-post">
   </form>
   <p><?php echo $addedmsg; ?></p>
 </div>
</body>
<!-- must include popper.js and jquery to run bootsrapdropdown menu -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
</html>
