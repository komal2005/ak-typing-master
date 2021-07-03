 
 <?php

$page=basename($_SERVER['PHP_SELF']);

?>

<!-- BEGIN #page-container -->
    <div id="page-container" class="fade">
        
        <!-- BEGIN #header -->
        <div id="header" class="header">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN header-container -->
                <div class="header-container">
                    <!-- BEGIN navbar-header -->
                    <div class="navbar-header">
                        <!--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>-->
                        <div class="header-logo">
                            <?php if(empty($_SESSION['user_id'])){?>
                            <a href="index.php">
                                <span class="brand"></span>
                                <span>Typing </span>Master
                            
                            </a>
                            <?php } else{ ?>
                                <a href="dashboard.php">
                                <span class="brand"></span>
                                <span>Typing </span>Master
                            
                            </a>

                            

                            <?php } ?>
                        </div>

                    </div>
                  
                    <!-- END navbar-header -->
                    
                    <!-- BEGIN header-nav -->
                    <div class="header-nav">
                        <ul class="nav pull-right">
                          
                         
                            
                            <li class="dropdown dropdown-hover"<?php if( isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) ){ ?> >
                           

                                    <a href="#" data-toggle="dropdown">
                                         <i class="fa fa-angle-down"></i> 
                                        <span ><img src="assets/img/user/user-1.jpg" class="user-img" alt="" /></span>
                                    </a>
                                    <ul class="dropdown-menu" >
                                        <li><a href="mytest.php">My Tests</a></li>
                                        <li><a href="edit-profile.php">Edit Profile</a></li>
                                        <li><a href="change-password.php">Change Password</a></li>
                                        <li><a href="logout.php">Logout</a></li>
                                        
                                    </ul>  
                                 <?php }else{ ?>
                            </li>
                            <li class="<?php  echo ($page=='register.php') ? 'active':'';?>">
                                <a href="register.php">Register 
                                </a>
                            </li>
                            <li class="divider"></li>
                           <li class="<?php  echo ($page=='login.php') ? 'active':'';?>" >
                                <a href="login.php" >Login
                                </a>
                            <?php } ?>
                            </li>

                        </ul>
                    </div>
                    <!-- END header-nav -->
                </div>
                <!-- END header-container -->
            </div>
            <!-- END container -->
        </div>
        <!-- END #header -->
    
    
    </div>
    <!-- END #page-container -->