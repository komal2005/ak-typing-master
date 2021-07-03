
<?php
include('../includes/connection.php');

if($_SESSION['name']==NULL)
	{
		header("location:index.php");
	}

if(isset($_GET['id']))
{
$id=$_GET['id'];
$select=mysqli_query($conn,"select * from users where id='$id'");
$row=mysqli_fetch_assoc($select);
if($row['is_block_by_admin']=='1')
{
    mysqli_query($conn,"update users set is_block_by_admin='0' where id='$id' ");
}
else
{
    mysqli_query($conn,"update users set is_block_by_admin='1' where id='$id' ");
}
}

?>
<script type="text/javascript">
   window.location="list-user.php";
</script>
