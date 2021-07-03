<?php  
include("../includes/connection.php");
//include("template/view_test/header.php");
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$delete="DELETE FROM `tests` WHERE id='$id'";
	$result=mysqli_query($conn,$delete);

		if($result)
		{			
			header("location:list-test.php");
		}


}

?>



<?php
	include("template/inner/footer.php");
?>