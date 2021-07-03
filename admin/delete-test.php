<?php

include('../includes/connection.php');
//include("template/list admin/header.php");

if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $delete = "DELETE FROM `test_type` WHERE id='$id'";
    $result = mysqli_query($conn,$delete);

    if($result)
    {
        $msg="Your Data is DELETED";
        header('location:list-test.php');
    }
}

?>
<?php include("template/inner/footer.php"); ?> 