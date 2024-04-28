<div>
     
                <a>

                    <img src="assets/img/logo.jpg">
                </a>

            </div>
<?php if($_SESSION['login'])
{
?> 
            <div class="right-div">
                <a href="logout.php" class="btn btn-danger pull-right">Log Out</a>
            </div>
            <?php }?>
        </div>
    </div>
    <!-- LOGO HEADER END-->
<?php if($_SESSION['login'])
{
?>    
    <section>
        <div class="menu-bar">
                        <ul>
                            <li><a href="dashboard.php">DASHBOARD</a></li>
                            <li><a href="issued-books.php">Issued Books</a></li>
                             <li>
                                <a href="#"> Account <i class="fa fa-angle-down"></i></a>
                                <ul>
                                    <li><a href="my-profile.php">My Profile</a></li>
                                     <li><a href="change-password.php">Change Password</a></li>
                                </ul>
                            </li>

                        </ul>
            </div>
    </section>
    <?php } else { ?>
        <section>
                <div class="menu-bar">
                        <ul>                        
                            <li><a href="index.php">Home</a></li>
                            <li><a href="signup.php">User Registration</a></li>
                            <li><a href="adminlogin.php">Admin Login</a></li>
                        </ul>
                </div>
        </section>

    <?php } ?>