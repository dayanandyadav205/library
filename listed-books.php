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
    <div> <h4 class="header-line">Manage Issued Books</h4>
    </div>
        
                        <div>
                          Issued Books 
                        </div>
                    
<?php $sql = "SELECT tblbooks.BookName,tblcategory.CategoryName,tblauthors.AuthorName,tblbooks.ISBNNumber,tblbooks.BookPrice,tblbooks.id as bookid,tblbooks.bookImage,tblbooks.isIssued from  tblbooks join tblcategory on tblcategory.id=tblbooks.CatId join tblauthors on tblauthors.id=tblbooks.AuthorId";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
<div style="float:left; height:300px;">   


                                   
                                        
<img src="admin/bookimg/<?php echo htmlentities($result->bookImage);?>" width="100">
                                                <br /><b><?php echo htmlentities($result->BookName);?></b><br />
                                                <?php echo htmlentities($result->CategoryName);?><br />
                                            <?php echo htmlentities($result->AuthorName);?><br />
                                            <?php echo htmlentities($result->ISBNNumber);?><br />
                                                <?php if($result->isIssued=='1'): ?>
<p style="color:red;">Book Already issued</p>
<?php endif;?>
                            </div>

                                <?php $cnt=$cnt+1;}} ?>  
                      
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
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
