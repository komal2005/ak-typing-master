<?php 

include("../includes/connection.php");

if($_SESSION['name_user']==NULL)
{
  header("location:index.php");
}

if(isset($_POST['updatebtn']))
{
	//$id=$_POST['id'];
	$id=$_GET['id'];
	$edit_test_name         =  $_POST["test_name"];
	$edit_test_description  =  $_POST["test_description"];
    $edit_test_content      =  mysqli_real_escape_string($conn,$_POST["test_content"]);
	$edit_test_valid_from   =  date('Y-m-d H:i:s',strtotime($_POST['test_valid_from']));
	$edit_test_valid_to   =  date('Y-m-d H:i:s',strtotime($_POST['test_valid_to']));
	$selectBox			=$_POST["selectBox"];
	
	
	$update_query="UPDATE `tests` SET `name`='$edit_test_name',`test_type_id`='$selectBox',`description`='$edit_test_description',`content`='$edit_test_content',`valid_from`='$edit_test_valid_from',`valid_to`='$edit_test_valid_to' WHERE id='$id' ";
	$update_run=mysqli_query($conn,$update_query);

	if($update_run)
	{
		header("location:list-test.php");
	}
	
	else
	{
		header("location:update-test.php");
	}
}
 
 if(isset($_GET['id']))
{
		$id=$_GET['id'];
		$select="Select * from tests where id='$id' ";
		  $result=mysqli_query($conn,$select);
		 $row = mysqli_fetch_assoc($result);
}

		                        				                    
?>


<?php 
include("template/inner/head.php");
include("template/inner/header.php");
include("template/inner/sidebar.php");
?>

		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
				<li class="breadcrumb-item active">Update Test</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Update Test </h1>
			<!-- end page-header -->
			<!-- begin row -->
			<div class="row">
                <!-- begin col-6 -->
			    <div class="col-lg-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                        <!-- begin panel-heading -->
                        <div class="panel-heading">
                            
                            <h1 class="panel-title">Update Test Form</h1>
                        </div>
                        <!-- end panel-heading -->
                        <!-- begin panel-body -->
                        <div class="panel-body">

                        	
		                  <form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post">
		       
											
										<div class="form-group row m-b-15">
											<label class="col-md-4 col-sm-4 col-form-label" for="test_name"> Test Name * :</label>
											<div class="col-md-8 col-sm-8">
												<input class="form-control" type="text" id="test_name" name="test_name"  value="<?php echo $row['name']; ?>" data-parsley-required="true" />
											</div>
										</div>
										<div class="form-group row m-b-15">
											<label class="col-md-4 col-sm-4 col-form-label" for="test_description">Test Description * :</label>
											<div class="col-md-8 col-sm-8">
												<textarea class="form-control" id="test_description" name="test_description" rows="4"  value="" data-parsley-required="true"><?php echo $row['description']; ?></textarea>
											</div>
										</div>
										<div class="form-group row m-b-15">
											<label class="col-md-4 col-sm-4 col-form-label" for="test_content">Test Content * :</label>
											<div class="col-md-8 col-sm-8">
												<textarea class="form-control" id="test_content" name="test_content" rows="4" value="" data-parsley-required="true"> <?php echo $row['content']; ?></textarea>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-md-4  col-form-label">Test Valid From * :</label>
											<div class="col-md-8 ">    
		                                        <div class="input-group date" id="datetimepicker1">
		                                        	<input type="text" class="form-control" data-parsley-required="true" name="test_valid_from"  value="<?php echo  date('m/d/Y H:i:s',strtotime($row['valid_from']));  ?>">
		                                        
		                                            <div class="input-group-addon">
		                                                <i class="fa fa-calendar"></i>
		                                            </div>                                             
		                                        </div>
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-md-4  col-form-label">Test  Valid To * :</label>
											<div class="col-md-8 ">
												    
		                                        <div class="input-group date" id="datetimepicker4">
		                                        	<input type="text" class="form-control" data-parsley-required="true" name="test_valid_to"  value="<?php echo date('m/d/Y H:i:s',strtotime($row['valid_to'])); ?>"/>
		                                        
		                                            <div class="input-group-addon">
		                                                <i class="fa fa-calendar"></i>
		                                            </div>                                             
		                                        </div>
											</div>
										</div>
										<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label">Test Type Id * :</label>
									<div class="col-md-8 col-sm-8">
										<?php $query=mysqli_query($conn,"select * from test_type where status='1'");
											$rowcount=mysqli_num_rows($query); ?>
										<select class="form-control" id="select-required" name="selectBox" data-parsley-required="true" 
										value="" >
										<option >Please choose</option>
										<?php  
										for($i=1;$i<=$rowcount;$i++)
											{
												$data=mysqli_fetch_array($query);
											?>
											<option value="<?php echo $data['id']?>"  
											<?php 
											if($row['test_type_id']==$data['id'])
											{
												echo "Selected";
											}
											?> >
											<?php echo $data['name']; ?></option>
												<?php } ?>
																							
																		
										</select>
									</div>
								</div>
								
										<div class="form-group row m-b-0">
											<label class="col-md-4 col-sm-4 col-form-label">&nbsp;</label>
											<div class="col-md-8 col-sm-8">
												<a href="list-test.php" class="btn btn-danger">Cancle </a>
												<button type="submit" name="updatebtn" class="btn btn-primary"><center>update</center></button>
											</div>
										</div>

										
		                  </form>    
                           
                        </div>
                        <!-- end panel-body -->
                </div>
                <!-- end col-12 -->
                </div>
             <!-- end row -->
             </div>
		<!-- end #content -->   


 

<?php 

include("template/inner/footer.php");
?>
