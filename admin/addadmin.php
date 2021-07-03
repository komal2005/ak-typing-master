<?php

 include('../includes/connection.php');
 
 $msg="";
 if($_SESSION['name']==NULL)
	{
		header("location:index.php");
	}
 
 if(isset($_POST["add"]))
{

	$name              =  isset($_POST["name"]) ? $_POST['name']:'';
	$email             =  isset($_POST["email"]) ? $_POST['email']:'';
    $password          =  isset( $_POST["password"]) ? $_POST['password']:'';
	$status            =  isset($_POST["status"]) ? $_POST['status']:'';

	//echo $name." " . $email ." ". $password ." ". $status;
	$select = mysqli_query($conn,'SELECT email from admin where email="'.$email.'"');
	
       if (mysqli_num_rows($select) == 1)
		{
            if($_POST['email']==$email)
        	 {
				$msg= "Email already exists!";
			 }
		}
		else
        {
    		$insert = "INSERT INTO `admin`(`name`, `email`, `password`, `status`) 
               			VALUES ('$name','$email','".md5($password)."','$status')";

			$result=mysqli_query($conn,$insert);
			if($result)
			{
				if(mysqli_affected_rows($conn)>0)
				{
           			header('location:list-admin.php');
			
    			}
			}
		}
		
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
				<li class="breadcrumb-item active">addadmin</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Add Admin form </h1>
			<!-- end page-header -->
			<!-- begin row -->
			<div class="row">
                <!-- begin col-6 -->
			    <div class="col-lg-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                        <!-- begin panel-heading -->
                        <div class="panel-heading">
                            <h4 class="panel-title"><center>Add Admin Form</center></h4>
                        </div>
                        <!-- end panel-heading -->
                        <!-- begin panel-body -->
                        <div class="panel-body">
                            <form class="form-horizontal"  data-parsley-validate="true" name="demo-form" method="post">
							
            				<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="fullname"> Name * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="text" id="name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '';?>" 
										placeholder="Enter Name" data-parsley-required="true" />
									</div>
								</div>
								<div class="form-group row m-b-15  <?php echo ($msg) ? 'has-error' : ''; ?>">
									<label class="col-md-4 col-sm-4 col-form-label" for="email">Email * :</label>
									<div class="col-md-8 col-sm-8">
										<input class="form-control" type="email" id="email" name="email"  value="<?php echo isset($_POST['email']) ? $_POST['email'] : '';?>" data-parsley-type="email" 
										placeholder="Enter Email" data-parsley-required="true"  />
										<h5><span class="help-block"><?php  echo $msg; ?></span></h5>
									</div>
								</div>
								
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label" for="password">Password :</label>
									<div class="col-md-8 col-sm-8" class="invalid">
										<input  class="form-control" type="password" id="password" name="password"   value="<?php echo isset($_POST['password']) ? $_POST['password'] : '';?>"   
										data-parsley-minlength="8" data-parsley-maxlength="15" placeholder="Enter password"  data-parsley-required />
									</div>
								</div>
								<div class="form-group row m-b-15">
									<label class="col-md-4 col-sm-4 col-form-label">Status :</label>
									<div class="col-md-8 col-sm-8">
										<select class="form-control" id="select-required"  name="status" data-parsley-required="true">
											<option value="">please select Status</option>
											<option value="0">0-Inactive</option>
											<option value="1">1-Active</option>
										</select>
									</div>
								</div>
								<div class="form-group row m-b-0">
									<label class="col-md-4 col-sm-4 col-form-label">&nbsp;</label>
									<div class="col-md-8 col-sm-8">
										<button type="submit" name="add" class="btn btn-primary"><center>Submit</center></button>
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


<?php include('template/inner/footer.php');?>                     

 













