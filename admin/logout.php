<?php
include("../includes/connection.php");

if(isset($_SESSION['name']))
{
	unset($_SESSION['name']);
	header("location:index.php"); 
}

?>