 <?php
include("includes/connection.php");
 if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
 {
    header("location:dashboard.php");
 }

include("frontend/head.php");
include("frontend/header.php");
?>
 <div class="demo frontend" >

<CENTER><h1>Welcome To Typing Master</h1></CENTER>

 </div>
                  
  
<?php 
include("frontend/footer.php");
    ?>