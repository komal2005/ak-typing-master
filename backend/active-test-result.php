<?php 
include("../includes/connection.php");
$msg="";


if($_SESSION['name_user']==NULL)
{
  header("location:index.php");
}


//GET Result of ID
if(isset($_GET['id']))
{
		 $_SESSION['getid']=$id=$_GET['id'];
}

if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }
    $no_of_records_per_page = 5;
    $offset = ($pageno-1) * $no_of_records_per_page;
    $total_pages_sql = "SELECT COUNT(*) FROM test_result where test_id='".$_SESSION['getid']."'";
    $result = mysqli_query($conn,$total_pages_sql);
     $total_rows = mysqli_fetch_array($result)[0];
     $total_pages = ceil($total_rows / $no_of_records_per_page);

// Fetch test Result
$fTestResult=mysqli_query($conn,"SELECT* from test_result where test_id='".$_SESSION['getid']."' LIMIT $offset, $no_of_records_per_page  ");
$aTestResult = [];
if (mysqli_num_rows($fTestResult))
{
    while($row =mysqli_fetch_array($fTestResult))
    {
        $aTestResult[] = $row;
    }
}
		 
if(mysqli_num_rows($fTestResult)==0)
{
    $msg=" Active Test NOT Available ";
}

include("template/inner/head.php");
include("template/inner/header.php");
include("template/inner/sidebar.php");
?>
<!-- begin #content -->
<div id="content" class="content">
  <!-- begin page-header -->
  <h1 class="page-header">Active Test Score</small></h1>
  <!-- end page-header -->
      
    <!-- begin row -->
    <div class="row">


       <?php 
      foreach ($aTestResult as $aTest) 
      {
        //Fetch Users Name email
      $fUsers=mysqli_query($conn,"Select * from users where id='".$aTest['student_id']."' ");
      $fUserResult = mysqli_fetch_assoc($fUsers);
       ?>

     
          <!-- begin col-4 -->
          <div class="col-lg-4">
          <!-- begin panel -->
           <div class="panel panel-inverse" data-sortable-id="ui-widget-14">
              <div class="panel-heading">
                  <center> <h4 class="panel-title"><?php  echo $fUserResult['name'];?></h4></center>
              </div>
              <div class="panel-body">
                           
                  <center>                
                  <p><strong>Email: </strong><?php echo $fUserResult['email']; ?></p>
                  <p><strong>Time Of Submitting: </strong><?php print_r(date('g:i A dS F Y',strtotime($aTest['created_on']))); ?></p>
                  <p><strong>Accuracy: </strong><?php echo $aTest['accuracy']; ?></p>
                  <p><strong>Speed: </strong><?php echo $aTest['speed']; ?></p>
                  <p><strong>Time: </strong><?php echo $aTest['time']; ?></p>
                  </center>

              </div>

          </div>
          <!-- end panel -->
          </div>
          <!-- End col-4 -->
     <?php }?>
    </div>
     <!-- end Row -->
      <!-- For Message Print -->
      <div class="col-md-12 col-sm-12 <?php echo (!empty($msg)) ? 'has-error' : ''; ?>">
      <center><h2 class="abc"><span class="help-block"><?php echo $msg;?></h2></span></center>
      </div>
      <?php if($total_rows==0)
      {

      }else{ ?>
      <!-- Being Pagination -->
      <ul class="pagination justify-content-end">
          <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
              <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Previous</a>
          </li>
          <?php
              for($i=1; $i<=$total_pages; $i++)
              {   
                  if($i==$pageno)
                  {
                      echo '<li class="active"><a>'.$i.'</a></li>'; 
                  }
                  else
                  {
                      echo "<li><a href='active-test-result.php?pageno=".$i."'> $i</a></li>";
                  }     
              }
                                             
          ?>
          <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
          </li>
      </ul>
      <!-- End Pagination -->
    <?php } ?>
</div>
<!-- end Content -->
<?php
include("template/inner/footer.php");

?>