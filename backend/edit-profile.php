
<?php
include("../includes/connection.php"); 


if(isset($_POST["submit"]))
{
    //echo $id=$_GET['id'];
    $name               =  $_POST["name"];
    $email              =  $_POST["email"];
   
   
        
     	 $update="UPDATE `teachers` SET `name`='$name',`email`='$email' where id='".$_SESSION['id']."'";
        
    
        if(mysqli_query($conn,$update))
        {
			if(isset($_SESSION['id']) && ($_SESSION['name_user']))

			{
				session_destroy();
    			header("location:index.php");  
    
			}
        }
        else
        {
             echo "Error: " . $update . "<br>" . mysqli_error($conn);
        }
}
$teacher_select="select * from teachers where id='".$_SESSION['id']."'";
$teacher_result=mysqli_query($conn,$teacher_select);
$teacher_row=mysqli_fetch_assoc($teacher_result);


include("template/inner/head.php");
include("template/inner/header.php");
include("template/inner/sidebar.php");
?>



		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
				<li class="breadcrumb-item active">Edit Profile</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Edit Profile <small> header small text goes here...</small></h1>
			<!-- end page-header -->
			<!-- begin row -->
			<div class="row">
                <!-- begin col-6 -->
			    <div class="col-lg-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                        <!-- begin panel-heading -->
                        <div class="panel-heading">
                            
                            <h1 class="panel-title">Edit Profile Form</h1>
                        </div>
                        <!-- end panel-heading -->
                        <!-- begin panel-body -->
                        <div class="panel-body">
                            <form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post">
                            
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="test_name">  Name * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="text" id="name" name="name"  
										value="<?php echo $teacher_row['name'];?>" placeholder="Enter Name" data-parsley-required="true" />
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="test_description">Email * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="email" id="email" name="email"
										 value="<?php echo $teacher_row['email'];?>" placeholder="Enter Email" data-parsley-required="true"/>
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