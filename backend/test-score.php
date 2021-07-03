<?php 
include("../includes/connection.php");

if($_SESSION['name_user']==NULL)
{
  header("location:index.php");
}

include("template/inner/head.php");
include("template/inner/header.php");
include("template/inner/sidebar.php");

if(isset($_GET['id']))
{
		echo $id=$_GET['id'];
		$fTestScore=mysqli_query($conn,"Select * from test_result where id='$id' ");
		  $fScore = mysqli_fetch_assoc($fTestScore);

		   $sql = mysqli_query($conn,"SELECT * FROM tests where id='".$fScore['test_id']."'");
       		$result =mysqli_fetch_array($sql);
}

?>
<!-- begin #content -->
    <div id="content" class="content">
     <!-- begin page-header -->
      <h1 class="page-header">Test Score</small></h1>
      <!-- end page-header -->
       
      <!-- begin row -->
      <div class="row">
       
          <!-- begin col-4 -->
          <div class="col-lg-4">
              <!-- begin panel -->
            
                    <div class="panel panel-inverse" data-sortable-id="ui-widget-14">
                        <div class="panel-heading">
                           <center> <h4 class="panel-title"><?php echo $result['name'];?></h4></center>
                        </div>
                        <div class="panel-body">
                           
                                        <center>
                                      
                                       <p><strong>Accuracy: </strong><?php echo $fScore['accuracy']; ?></p>
                                       <p><strong>Speed: </strong><?php echo $fScore['speed']; ?></p>
                                       <p><strong>Time: </strong><?php echo $fScore['time']; ?></p>
                                         </center>

                                        
                        </div>

                    </div>
                    <!-- end panel -->
            </div>
            <!-- End col-4 -->
          
              </div>
      <!-- end Row -->
     

</div>
<!-- end Content -->
<?php
include("template/inner/footer.php");

?>