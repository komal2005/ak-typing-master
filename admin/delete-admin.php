<?php

include('../includes/connection.php');
//include("template/list admin/header.php");

   if(isset($_GET['id']))
   {
        $id = $_GET['id'];
        $delete = "DELETE FROM `admin` WHERE id='$id'";
        $result = mysqli_query($conn,$delete);

        if($result)
        {
           
            header('location:list-admin.php');
        }   
   }
									
  
?>



<?php include("template/inner/footer.php"); ?> 