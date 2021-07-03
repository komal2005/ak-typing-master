<?php 
include("../includes/connection.php"); 

$fTestResult=mysqli_query($conn,"SELECT * FROM test_result");
$aTestResult=mysqli_fetch_assoc();


?>