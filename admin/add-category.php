<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['create']))
{
$category=$_POST['category'];
$status=$_POST['status'];
$sql="INSERT INTO  tblcategory(CategoryName,Status) VALUES(:category,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':category',$category,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$_SESSION['msg']="Brand Listed successfully";
header('location:manage-categories.php');
}
else 
{
$_SESSION['error']="Something went wrong. Please try again";
header('location:manage-categories.php');
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
    <title>Online Library Management System | Add Categories</title>
    <!-- GENERAL STYLES  -->
    <link href="assets/css/style.css" rel="stylesheet" />
   
</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="container">
                <h4 class="header-line">Add category</h4>
                <form role="form" method="post">
                <div class="form-group">
                <label>Category Name</label>
                <input class="form-control" type="text" name="category" autocomplete="off" required />
                </div>
                <div class="form-group">
                <label>Status</label>
                <div class="radio">
                <label>
                <input type="radio" name="status" id="status" value="1" checked="checked">Active
                </label>
                </div>
                <div class="radio">
                <label>
                <input type="radio" name="status" id="status" value="0">Inactive
                </label>
                </div>
                <button type="submit" name="create" class="btn btn-info">Create </button>
            </form>
                                        

    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
  
</body>
</html>
<?php } ?>
