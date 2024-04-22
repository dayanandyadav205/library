<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{ 

    ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System |  Issued Books</title>
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
   
</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div>
        <h4 class="header-line">Manage Issued Books</h4>
    </div>
    

            <div>
                <div>
                    <!-- Advanced Tables -->
                    <div>
                        <div>
                          Issued Books 
                        </div>
                        <div>
                            <div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Book Name</th>
                                            <th>ISBN </th>
                                            <th>Issued Date</th>
                                            <th>Return Date</th>
                                            <th>Fine in(INR)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php 
$sid=$_SESSION['stdid'];
$sql="SELECT tblbooks.BookName,tblbooks.ISBNNumber,tblissuedbookdetails.IssuesDate,tblissuedbookdetails.ReturnDate,tblissuedbookdetails.id as rid,tblissuedbookdetails.fine from  tblissuedbookdetails join tblstudents on tblstudents.StudentId=tblissuedbookdetails.StudentId join tblbooks on tblbooks.id=tblissuedbookdetails.BookId where tblstudents.StudentId=:sid order by tblissuedbookdetails.id desc";
$query = $dbh -> prepare($sql);
$query-> bindParam(':sid', $sid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>                                      
                                        <tr>
                                            <td ><?php echo htmlentities($cnt);?></td>
                                            <td ><?php echo htmlentities($result->BookName);?></td>
                                            <td ><?php echo htmlentities($result->ISBNNumber);?></td>
                                            <td ><?php echo htmlentities($result->IssuesDate);?></td>
                                            <td ><?php if($result->ReturnDate=="")
                                            {?>
                                            <span style="color:red">
                                             <?php   echo htmlentities("Not Return Yet"); ?>
                                                </span>
                                            <?php } else {
                                            echo htmlentities($result->ReturnDate);
                                        }
                                            ?></td>
                                              <td ><?php echo htmlentities($result->fine);?></td>
                                         
                                        </tr>
 <?php $cnt=$cnt+1;}} ?>                                      
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
          

     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
     
</body>
</html>
<?php } ?>
