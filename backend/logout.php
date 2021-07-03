<?php 
include("../includes/connection.php");

if(isset($_SESSION['name_user']) )
{
	unset($_SESSION['name_user']);
	header("location:index.php"); 
}


?>