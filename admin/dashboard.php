<?php
include('../includes/connection.php');

if($_SESSION['name']==NULL)
{
	header("location:index.php");
}

include('template/inner/head.php');
include('template/inner/header.php');
include('template/inner/sidebar.php');	
?>

<script type="text/javascript">
    function noBack() { window.history.forward(); }
    noBack();
    window.onload = noBack;
    window.onpageshow = function (evt) { if (evt.persisted) noBack(); }
    window.onunload = function () { void (0); }
</script>

		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
				<li class="breadcrumb-item active">Dashboard</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Dashboard </h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
				<!-- begin col-3 -->
				<div class="col-lg-3 col-md-6">
					<div class="widget widget-stats bg-red">
						<div class="stats-icon"><i class="fa fa-desktop"></i></div>
						<div class="stats-info">
							<h4>TOTAL ADMIN</h4>
						<?php
							$select = "SELECT `id` FROM `admin` ORDER BY id";
							$result = mysqli_query($conn,$select);

							$row = mysqli_num_rows($result);

							echo '<p>' .$row. '</p>';
						?>
						</div>
						<div class="stats-link">
							<a href="list-admin.php">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-lg-3 col-md-6">
					<div class="widget widget-stats bg-orange">
						<div class="stats-icon"><i class="fa fa-link"></i></div>
						<div class="stats-info">
							<h4>TOTAL TEACHERS</h4>
						<?php
							$select = "SELECT `id` FROM `teachers` ORDER BY id";
							$result = mysqli_query($conn,$select);

							$row = mysqli_num_rows($result);

							echo '<p>' .$row. '</p>';
						?>	
						</div>
						<div class="stats-link">
							<a href="list-teacher.php">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-lg-3 col-md-6">
					<div class="widget widget-stats bg-grey-darker">
						<div class="stats-icon"><i class="fa fa-users"></i></div>
						<div class="stats-info">
							<h4>TOTAL USERS</h4>
						<?php
							$select = "SELECT `id` FROM `users` ORDER BY id";
							$result = mysqli_query($conn,$select);

							$row = mysqli_num_rows($result);

							echo '<p>' .$row. '</p>';
						?>	
						</div>
						<div class="stats-link">
							<a href="list-user.php">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-lg-3 col-md-6">
					<div class="widget widget-stats bg-black-lighter">
						<div class="stats-icon"><i class="fa fa-clock"></i></div>
						<div class="stats-info">
							<h4>TOTAL TEST TYPE</h4>
						<?php
							$select = "SELECT `id` FROM `test_type` ORDER BY id";
							$result = mysqli_query($conn,$select);

							$row = mysqli_num_rows($result);

							echo '<p>' .$row. '</p>';
						?>
						</div>
						<div class="stats-link">
							<a href="list-test.php">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
						</div>
					</div>
				</div>
				<!-- end col-3 -->
			</div>
			<!-- end row -->



			<!-- begin row -->
			<div class="row">
				
				
			</div>
			<!-- end row -->
		</div>
		<!-- end #content -->
		
       
		
	
	<?php include('template/inner/footer.php');?>


    