<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 
if(isset($_GET['del']))
{
$id=$_GET['del'];
$sql = "delete from tblcategory  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
$_SESSION['delmsg']="Category deleted scuccessfully ";
header('location:manage-categories.php');

}


    ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Manage Categories</title>
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
   
</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div>
        <h4 class="header-line">Manage Categories</h4>
    </div>
     <div>
    <?php if($_SESSION['error']!="")
    {?>

<div>
 <strong>Error :</strong> 
 <?php echo htmlentities($_SESSION['error']);?>
<?php echo htmlentities($_SESSION['error']="");?>
</div>
</div>
<?php } ?>
<?php if($_SESSION['msg']!="")
{?>

<div>
 <strong>Success :</strong> 
 <?php echo htmlentities($_SESSION['msg']);?>
<?php echo htmlentities($_SESSION['msg']="");?>
</div>
</div>
<?php } ?>
<?php if($_SESSION['updatemsg']!="")
{?>

<div>
 <strong>Success :</strong> 
 <?php echo htmlentities($_SESSION['updatemsg']);?>
<?php echo htmlentities($_SESSION['updatemsg']="");?>
</div>
</div>
<?php } ?>


   <?php if($_SESSION['delmsg']!="")
    {?>

<div>
 <strong>Success :</strong> 
 <?php echo htmlentities($_SESSION['delmsg']);?>
<?php echo htmlentities($_SESSION['delmsg']="");?>
</div>
</div>
<?php } ?>

</div>


        </div>
            <div>
               
                    <!-- Advanced Tables -->
        
                        <div>
                            <div >
                                <table>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Creation Date</th>
                                            <th>Updation Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php $sql = "SELECT * from  tblcategory";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>                                      
                                        <tr>
                                            <td ><?php echo htmlentities($cnt);?></td>
                                            <td ><?php echo htmlentities($result->CategoryName);?></td>
                                            <td><?php if($result->Status==1) {?>
                                            <a href="#">Active</a>
                                            <?php } else {?>
                                            <a href="#">Inactive</a>
                                            <?php } ?></td>
                                            <td ><?php echo htmlentities($result->CreationDate);?></td>
                                            <td ><?php echo htmlentities($result->UpdationDate);?></td>
                                            <td >

                                            <a href="edit-category.php?catid=<?php echo htmlentities($result->id);?>"><button>Edit</button> 
                                          <a href="manage-categories.php?del=<?php echo htmlentities($result->id);?>" onclick="return confirm('Are you sure you want to delete?');"" >  <button> Delete</button>
                                            </td>
                                        </tr>
 <?php $cnt=$cnt+1;}} ?>                                      
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>


            
    </div>
    </div>

     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    
</body>
</html>
<?php } ?>