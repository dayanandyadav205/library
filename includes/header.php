<div>
<img src="assets/img/logo.jpg" height="100px"/>
            </div>
<?php if($_SESSION['login'])
{
?> 

            <div class="right-div">
            <nav>
                <a href="logout.php">Log Out</a>
                </nav>
            </div>

            <?php }?>
        </div>
    </div>
    <!-- LOGO HEADER END-->
<?php if($_SESSION['login'])
{
?>    
<section >
    <nav> 
            <a href="dashboard.php">DASHBOARD</a>
            <a href="issued-books.php">Issued Books</a>
            <a href="my-profile.php">My Profile</a>
            <a href="change-password.php">Change Password</a>
    </nav> 
                           
                    </div>
                </div>

            </div>
        </div>
    </section>
    <?php } else { ?>
        <section>
        <nav>                                     
            <a href="index.php">Home</a>
            <a href="signup.php">User Registration</a>
            <a href="adminlogin.php">Admin Login</a>
        </nav>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php } ?>