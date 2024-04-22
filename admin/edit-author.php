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
$athrid=intval($_GET['athrid']);
$author=$_POST['author'];
$sql="update  tblauthors set AuthorName=:author where id=:athrid";
$query = $dbh->prepare($sql);
$query->bindParam(':author',$author,PDO::PARAM_STR);
$query->bindParam(':athrid',$athrid,PDO::PARAM_STR);
$query->execute();
$_SESSION['updatemsg']="Author info updated successfully";
header('location:manage-authors.php');



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
                <h4 class="header-line">Add Author</h4>
                
                            </div>

</div>

<div>
<form role="form" method="post">
<div class="form-group">
<label>Author Name</label>
<?php 
$athrid=intval($_GET['athrid']);
$sql = "SELECT * from  tblauthors where id=:athrid";
$query = $dbh -> prepare($sql);
$query->bindParam(':athrid',$athrid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>   
<input class="form-control" type="text" name="author" value="<?php echo htmlentities($result->AuthorName);?>" required />
<?php }} ?>
</div>

<button type="submit" name="update" class="btn btn-info">Update </button>

                                    </form>
                          
    
  
     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
   
</body>
</html>
<?php } ?>