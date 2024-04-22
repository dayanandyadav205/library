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
$author=$_POST['author'];
$sql="INSERT INTO  tblauthors(AuthorName) VALUES(:author)";
$query = $dbh->prepare($sql);
$query->bindParam(':author',$author,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$_SESSION['msg']="Author Listed successfully";
header('location:manage-authors.php');
}
else 
{
$_SESSION['error']="Something went wrong. Please try again";
header('location:manage-authors.php');
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
    <title>Online Library Management System | Add Author</title>
   <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
 
</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div>
                <h4 >Add Author</h4>
                
                            </div>


<div>
<form role="form" method="post">
<div class="form-group">
<label>Author Name</label>
<input class="form-control" type="text" name="author" autocomplete="off"  required />
</div>

<button type="submit" name="create" class="btn btn-info">Add Author</button>

                                    </form>
                       

  
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
  
</body>
</html>
<?php } ?>
