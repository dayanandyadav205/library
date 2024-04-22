<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['update']))
{

$bookid=intval($_GET['bookid']);
$bookimg=$_FILES["bookpic"]["name"];
//currentimage
$cimage=$_POST['curremtimage'];
$cpath="bookimg"."/".$cimage;
// get the image extension
$extension = substr($bookimg,strlen($bookimg)-4,strlen($bookimg));
// allowed extensions
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
// Validation for allowed extensions .in_array() function searches an array for a specific value.
//rename the image file
$imgnewname=md5($bookimg.time()).$extension;
// Code for move image into directory
move_uploaded_file($_FILES["bookpic"]["tmp_name"],"bookimg/".$imgnewname);
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}
else
{
$sql="update  tblbooks set bookImage=:imgnewname where id=:bookid";
$query = $dbh->prepare($sql);
$query->bindParam(':bookname',$bookname,PDO::PARAM_STR);
$query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
$query->execute();
unlink($cpath);
echo "<script>alert('Book image updated successfully');</script>";
echo "<script>window.location.href='manage-books.php'</script>";

}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Edit Book</title>
    
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
   
</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    
                <h4>Add Book</h4>

<div>
<form role="form" method="post" enctype="multipart/form-data">
<?php 
$bookid=intval($_GET['bookid']);
$sql = "SELECT tblbooks.BookName,tblbooks.id as bookid,tblbooks.bookImage from  tblbooks  where tblbooks.id=:bookid";
$query = $dbh -> prepare($sql);
$query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
<input type="hidden" name="curremtimage" value="<?php echo htmlentities($result->bookImage);?>">

<div class="form-group">
<label>Book Image</label>
<img src="bookimg/<?php echo htmlentities($result->bookImage);?>" width="100">
</div></div>


<div class="form-group">
<label>Book Name<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="bookname" value="<?php echo htmlentities($result->BookName);?>" readonly />
</div></div>
 
 <div class="form-group">
 <label>Book Picture<span style="color:red;">*</span></label>
 <input class="form-control" type="file" name="bookpic" autocomplete="off"   required="required" />
 </div>
    
 <?php }} ?>
<div><button type="submit" name="update" class="btn btn-info">Update </button></div>

    </form>
                
</div>
     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
 
</body>
</html>
<?php } ?>
