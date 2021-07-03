<?php 
include("includes/connection.php");
if(!isset($_SESSION['user_id']) && empty($_SESSION['user_id']))
{
    header("location:index.php");
}
include("frontend/head.php");
include("frontend/header.php");

$msg="";
	
	date_default_timezone_set('Asia/Kolkata')."<br>";


	if (isset($_GET['pageno'])) {
		$pageno = $_GET['pageno'];
	} else {
		$pageno = 1;
	}
	$no_of_records_per_page = 6;
	$offset = ($pageno-1) * $no_of_records_per_page;

	 $total_pages_sql = "SELECT COUNT(*) FROM tests  where   (valid_from>='".date('Y-m-d H:i:s')."' OR NOT   valid_to<='".date('Y-m-d H:i:s')."')  AND status='1'";
	$result = mysqli_query($conn,$total_pages_sql);
	   $total_rows = mysqli_fetch_array($result)[0];

   

	 $total_pages = ceil($total_rows / $no_of_records_per_page);

	// To fetch tests 
	   $sql = "SELECT * FROM tests WHERE (valid_from>='".date('Y-m-d H:i:s')."' OR NOT valid_to<='".date('Y-m-d H:i:s')."') AND status='1' ORDER BY created_at DESC  LIMIT $offset, $no_of_records_per_page";

	  $res_data = mysqli_query($conn,$sql);
        $aTests = [];
        if (mysqli_num_rows($res_data))
        {
            while($row =mysqli_fetch_array($res_data))
            {

                $aTests[] = $row;
                 
            }
        }
$total_pages_sql1 = "SELECT COUNT(*) FROM test_result WHERE student_id ='".$_SESSION['user_id']."'";
        $result1 = mysqli_query($conn,$total_pages_sql1);
      $total_rows1 = mysqli_fetch_array($result1)[0];
           
?>
<!-- BEGIN #about-us-content -->
<div id="about-us-content" class="section-container bg-silver">
    <!-- BEGIN container -->
    <div class="container">
        <!-- BEGIN about-us-content -->
        <div class="about-us-content">
                  
        <!-- BEGIN row -->
        <div class="row" >
        <?php 
        foreach ($aTests as $aTest) {
        $sql = "SELECT * FROM test_result WHERE test_id = '".$aTest['id']."' AND student_id ='".$_SESSION['user_id']."'";
        $result =mysqli_query($conn,$sql);
        $fTestResult=mysqli_fetch_assoc($result);

        $num_row =  mysqli_num_rows($result);
        if($num_row!=1)
        {
        $sql = "SELECT name from teachers where id ='".$aTest['teacher_id']."'";
        $result =mysqli_query($conn,$sql);
        $aTecherName = mysqli_fetch_row($result);
        ?>
	   <div class="col-lg-4" style="cursor: pointer;" >
		  <section class="panel">
		      <header class="login-header">
		          <center><strong> <?php echo $aTest['name'];?></strong></center>
		      </header>
		      <div class="panel-body">  
		          <center>
                    <p><strong>Test By: </strong><?php print_r($aTecherName[0]); ?></p>
		            <p><strong> Available Hour:  </strong><?php echo date(' g:i A dS F Y', strtotime($aTest['valid_from'])); echo "<br>To";  echo "<br>".$_SESSION['valid_to']=date('g:i A dS F Y', strtotime($aTest['valid_to']));?></p>
		         
                    <?php 
                    if($aTest['valid_from']>=date('Y-m-d H:i:s')){?>
                        <button type="button" disabled="disabled"> Enroll</button>
                    <?php   }else { ?>
		                                   
		              <button type="button" id='enroll' class="btn btn-inverse" onclick="location.href='enroll-test.php?id=<?php echo  $aTest['id']?>'"> ENROLL</button>
                            <?php } ?>
		          </center>
		      </div>

		 </section>
	 </div>

    <?php }}?>
    </div>
    <!-- END row -->
    <hr />
		<?php
           //echo  $num_row =  mysqli_num_rows($result);
           if($total_rows==0 )
            {
                
               $msg="Test Not Available";
            }
            else{
                    if($total_rows==$total_rows1)
                    {

                    $msg="All Test is Given";
                    }else { ?>
         <!--Being Pagination-->
        <div class="text-center">
        <ul class="pagination">
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?> " >
            <a class="btn btn-inverse" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
        </li>
            <?php  
            for($i=1;$i<=$total_pages;$i++)
            {
                if($i==$pageno)
                {
                    echo '<li class="active"><a>'.$i.'</a></li>';
                }
                else
                {
                    echo "<li><a href='dashboard.php?pageno=".$i."' >$i</a></li>";
                }
            }
            ?>

        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
        </li>
        </ul>
    </div>
    <!--End Pagination-->
                <?php } } ?>

            <!-- For Message Printing -->
            <div class="col-md-12 col-sm-12 <?php echo (!empty($msg)) ? 'has-error' : ''; ?>">
                <br>
                  <center><h2><span class="help-block"><?php echo $msg;?></h2></span></center>
            </div>
        </div>
        <!-- END about-us-content -->
    </div>
    <!-- END container -->
</div>
<!-- END #about-us-content -->

  <?php 
include("frontend/footer.php");
    ?>   

