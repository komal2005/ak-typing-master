<?php 
include("includes/connection.php");

echo  $accuracy=$_POST['accuracy'];
$speed=$_POST['speed'];
$time=$_POST['time'];

$accuracy=mysqli_escape_string($conn,$_POST['accuracy']);
$speed=mysqli_escape_string($conn,$_POST['speed']);
$time=mysqli_escape_string($conn,$_POST['time']);


 $sql = "SELECT * FROM tests where id='".$_SESSION['testid']."'";
   $res_data = mysqli_query($conn,$sql);
   $row =mysqli_fetch_array($res_data);
 echo   $row['teacher_id'];


  //$select=mysqli_query($conn,"select * from test_result where id='".$_SESSION['testid']."'");
  //$row1=mysqli_fetch_assoc($select);
   // if(mysqli_num_rows($select)==1)
    //{
        //if($row1['test_id']==$_SESSION['testid'])
        //{
            //echo "Hello";
        //}
        
   // }
    //else
    //{
    $insert=mysqli_query($conn,"INSERT INTO `test_result`( `student_id`, `teacher_id`, `test_id`, `accuracy`, `speed`, `time`) VALUES ('".$_SESSION['user_id']."','".$row['teacher_id']."','".$_SESSION['testid']."','$accuracy','$speed','$time')");

    //}

?>