<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

// code for block student    
if(isset($_GET['inid']))
{
$id=$_GET['inid'];
$status=0;
$sql = "update tblstudents set Status=:status  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query -> execute();
header('location:reg-students.php');
}



//code for active students
if(isset($_GET['id']))
{
$id=$_GET['id'];
$status=1;
$sql = "update tblstudents set Status=:status  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query -> execute();
header('location:reg-students.php');
}


    ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Student History</title>
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
 
</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div>
        <?php $sid=$_GET['stdid']; ?>
                <h4>#<?php echo $sid;?>Book Issued History</h4>
    </div>


        </div>
            <div>
                <div >
                    <!-- Advanced Tables -->
                    <div >
                        <div>

<?php echo $sid;?> Details
                        </div>
                        <div >
                            <div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Student ID</th>
                                            <th>Student Name</th>
                                            <th>Issued Book  </th>
                                            <th>Issued Date</th>
                                            <th>Returned Date</th>
                                            <th>Fine (if any)</th>
          
                                        </tr>
                                    </thead>
                                    <tbody>
<?php 

$sql = "SELECT tblstudents.StudentId ,tblstudents.FullName,tblstudents.EmailId,tblstudents.MobileNumber,tblbooks.BookName,tblbooks.ISBNNumber,tblissuedbookdetails.IssuesDate,tblissuedbookdetails.ReturnDate,tblissuedbookdetails.id as rid,tblissuedbookdetails.fine,tblissuedbookdetails.RetrunStatus,tblbooks.id as bid,tblbooks.bookImage from  tblissuedbookdetails join tblstudents on tblstudents.StudentId=tblissuedbookdetails.StudentId join tblbooks on tblbooks.id=tblissuedbookdetails.BookId where tblstudents.StudentId='$sid' ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>                                      
                                        <tr>
                                            <td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($result->StudentId);?></td>
                                            <td ><?php echo htmlentities($result->FullName);?></td>
                                            <td><?php echo htmlentities($result->BookName);?></td>
                                            <td><?php echo htmlentities($result->IssuesDate);?></td>
                                            <td><?php if($result->ReturnDate==''): echo "Not returned yet";
                                            else: echo htmlentities($result->ReturnDate); endif;?></td>
                                             <td><?php if($result->ReturnDate==''): echo "Not returned yet";
                                              else: echo $result->fine; endif;
                                             ?></td>
                                            
                            
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
