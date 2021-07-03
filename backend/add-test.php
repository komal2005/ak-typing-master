<?php
include("../includes/connection.php");

if($_SESSION['name_user']==NULL)
{
	header("location:index.php");
}

$select= "select * from test_type where status='1'";
$select_run=mysqli_query($conn,$select);
 	 		
if(isset($_POST["submit"]))
{
	  
											
	//$_SESSION['id']=$row['id'];
       
	$test_name         =  $_POST["test_name"];
	$test_description  =  $_POST["test_description"];
    $test_content      =  mysqli_real_escape_string($conn,$_POST["test_content"]);
    $test_valid_from   =  date('Y-m-d H:i:s',strtotime($_POST['test_valid_from']));
	$test_valid_to     =  date('Y-m-d H:i:s',strtotime($_POST['test_valid_to']));

	$selectBox		   = $_POST["selectBox"];
	

	$insert="INSERT  into tests(`teacher_id`,`test_type_id`, `name`, `description`, `content`,`valid_from`, `valid_to` )values('".$_SESSION['id']."','$selectBox','$test_name','$test_description','$test_content','$test_valid_from','$test_valid_to')";
	//echo $insert;
		$result=mysqli_query($conn,$insert);
	//print_r($result);
		if($result)
		{
			if(mysqli_affected_rows($conn)>0)
			{
					header("location:list-test.php");
			}
		
		}
		else
		{
			 echo "Error: " . $insert . "<br>" . mysqli_error($conn);
		}
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
				<li class="breadcrumb-item active">Add test</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Add Test </h1>
			<!-- end page-header -->
			<!-- begin row -->
			<div class="row">
                <!-- begin col-6 -->
			    <div class="col-lg-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                        <!-- begin panel-heading -->
                        <div class="panel-heading">
                            
                            <h1 class="panel-title">Add Test Form</h1>
                        </div>
                        <!-- end panel-heading -->
                        <!-- begin panel-body -->
                        <div class="panel-body">
                            <form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post">
                            
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="test_name"> Test Name * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="text" id="test_name" name="test_name" placeholder="Enter Test Name" data-parsley-required="true" />
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="test_description">Test Description * :</label>
									<div class="col-md-8 col-sm-8">
										<textarea class="form-control" id="test_description" name="test_description" rows="4" placeholder="Enter Test Description" data-parsley-required="true"></textarea>
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="test_content">Test Content* :</label>
									<div class="col-md-8 col-sm-8">
										<textarea class="form-control" id="test_content" name="test_content" rows="4"  placeholder="Enter Test Content" data-parsley-required="true"></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4  col-form-label">Test Valid From * :</label>
									<div class="col-md-8 ">    
                                        <div class="input-group date" id="datetimepicker1">
                                        	<input type="text"  class="form-control" data-parsley-required="true" name="test_valid_from"/>
                                        <span></span>
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>                                             
                                        </div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-md-4  col-form-label">Test Valid To * :</label>
									<div class="col-md-8 ">
										    
                                        <div class="input-group date" id="datetimepicker4">
                                        	<input type="text" class="form-control"  data-parsley-required="true" name="test_valid_to"/>
                                        
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>                                             
                                        </div>
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label">Test Type Id * :</label>
									<div class="col-md-8 col-sm-8">
										<select class="form-control" id="select-required" name="selectBox" data-parsley-required="true">
											<option value="">Please choose</option>
											<?php while($row=mysqli_fetch_array($select_run)){  ?>
											
											<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?> </option>
											<?php } ?>
											
											
										</select>
									</div>
								</div>
								
								<div class="form-group row m-b-0">
									<label class="col-md-4 col-sm-4 col-form-label">&nbsp;</label>
									<div class="col-md-8 col-sm-8">
										<button type="submit" name="submit" class="btn btn-primary"><center>Submit</center></button>
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
