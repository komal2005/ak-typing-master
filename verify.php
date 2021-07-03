<?php
include("includes/connection.php");
if(isset($_GET['activation_key']))
{
	$activation_key=$_GET['activation_key'];
	$resultset=mysqli_query($conn,"select status,activation_key from users where status='0' AND  activation_key='".$activation_key."'  ");
	if(mysqli_num_rows($resultset)==1)
	{
		$update=mysqli_query($conn,"UPDATE `users` SET `status`='1' WHERE activation_key='".$activation_key."' LIMIT 1");
		if($update)
		{
			//echo "Your Account Must be Verified,You must be now login";
			header("location:email-verify.html");
		}
		else{
			echo $mysqli_error();
		}
	}
	else{
		echo "This Account Invalid And Already Verified";
	}
}
else
{
	die("Something Went Wrong");
}

?>
