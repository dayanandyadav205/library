<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | User Dash Board</title>
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
 
</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div>
      <h4 class="header-line">User DASHBOARD</h4>
                
                            </div>
        </div>   
             <div>

<a href="listed-books.php">

 <div>
 
<?php 
$sql ="SELECT id from tblbooks ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$listdbooks=$query->rowCount();
?>
<h3><?php echo htmlentities($listdbooks);?></h3>
Books Listed
</div></div></a>
          
<?php 
$rsts=0;
 $sid=$_SESSION['stdid'];
$sql2 ="SELECT id from tblissuedbookdetails where StudentID=:sid and (RetrunStatus=:rsts || RetrunStatus is null || RetrunStatus='')";
$query2 = $dbh -> prepare($sql2);
$query2->bindParam(':sid',$sid,PDO::PARAM_STR);
$query2->bindParam(':rsts',$rsts,PDO::PARAM_STR);
$query2->execute();
$results2=$query2->fetchAll(PDO::FETCH_OBJ);
$returnedbooks=$query2->rowCount();
?>

                            <h3><?php echo htmlentities($returnedbooks);?></h3>
                          Books Not Returned Yet
                        </div>
                    </div>

<a href="issued-books.php">

 <div>

      <h3>&nbsp;</h3>
Issued Books
</div></div></a>

        </div>    
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
<?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
  
</body>
</html>
<?php } ?>
