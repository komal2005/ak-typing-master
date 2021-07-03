<?php

include('../includes/connection.php');
//include("template/list teacher/header.php");

if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $delete = "DELETE FROM `teachers` WHERE id='$id'";
    $result = mysqli_query($conn,$delete);

    if($result)
    {
        $msg = "Your Data is DELETED";
        header('location:list-teacher.php');
    }
}

?>
<?php include("template/inner/footer.php"); ?> 