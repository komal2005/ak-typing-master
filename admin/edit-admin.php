<?php
include('../includes/connection.php');
if($_SESSION['name']==NULL)
	{
		header("location:index.php");
	}

if(isset($_POST['updatebtn']))
{
	$id				   =  $_GET['id'];
	$name              =  $_POST["name"] ;
	$email             =  $_POST["email"];
	$status            =  $_POST["status"];

	$update="UPDATE `admin` SET name='$name',email='$email',status='$status' WHERE id='$id'";
	$result=mysqli_query($conn,$update);
	if($result)
	{
        header('location:list-admin.php');
	}
}

if(isset($_GET['id']))
	{
		$id = $_GET['id'];
		$select = "select * FROM admin where id='$id' ";

		$result = mysqli_query($conn,$select);
		$row=mysqli_fetch_assoc($result);								
									
	}
?>
 
 <?php
 include('template/inner/head.php');
 include('template/inner/header.php');
 include('template/inner/sidebar.php'); 
  ?>


			<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="javascript:;">admin</a></li>
				<li class="breadcrumb-item active">edit-admin</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Edit Admin form </h1>
			<!-- end page-header -->
			<!-- begin row -->
			<div class="row">
                <!-- begin col-6 -->
			    <div class="col-lg-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                        <!-- begin panel-heading -->
                        <div class="panel-heading">
                            <h4 class="panel-title"><center>Edit Admin Form</center></h4>
                        </div>
                        <!-- end panel-heading -->
                        <!-- begin panel-body -->
                        <div class="panel-body">
                         <form  action="" class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post">
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="fullname"> Name * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="text" id="name" name="name" value="<?php echo $row['name']; ?>"
										placeholder="Enter Name" data-parsley-required="true" />
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="email">Email * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="email" id="email" name="email" data-parsley-type="email" value="<?php echo $row['email']; ?>"
										placeholder="Enter Email" data-parsley-required="true" />
									</div>
								</div>
								
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label">Status :</label>
									<div class="col-md-8 col-sm-8">
										<select class="form-control" id="select-required"  name="status" data-parsley-inputs
										 value="<?php echo $row['status']; ?>" data-parsley-required="true">
											<option>please select status</option>
											<option value="0" <?php echo $row['status'] == 0 ? 'selected="selected"':'';?>>Inactive</option>	
											<option value="1" <?php echo $row['status'] == 1 ? 'selected="selected"':'';?>>Active</option>
										</select>
									</div>
                               </div>	
                               <div class="form-group row m-b-0">
									<label class="col-md-4 col-sm-4 col-form-label">&nbsp;</label>
									<div class="col-md-8 col-sm-8">
                                       <button type="submit" name="updatebtn" class="btn btn-primary"><center>update</center></button>
									   <a href="list-admin.php" class="btn btn-danger"><center>cancel</center></a>
                                    </div>
                                </div>
                            </form> 
                        </div>
                        <!-- end panel-body -->   
                    </div> 
                    <!--  end panel -->  
                </div>
                 <!-- end col-12 -->
            </div>
            <!-- end row -->
        </div>
		<!-- end #content -->    
             
<?php include("template/inner/footer.php"); ?>  