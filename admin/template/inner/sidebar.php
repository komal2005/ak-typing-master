
<?php 
		$page=basename($_SERVER['PHP_SELF']);
		//$page1=basename($_SERVER['PHP_SELF']);
		//echo  $page;
		
 ?>
<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				
				<!-- begin sidebar nav -->
				<ul class="nav">
					<li class="has-sub <?php echo $page=='dashboard.php'  ? 'active':'';?>">
						<a href="dashboard.php">
						    <i class="fa fa-th-large"></i>
						    <span>Dashboard</span>
					    </a>
					</li>
					<li class="has-sub <?php echo $page=='addadmin.php' ||  $page=='list-admin.php' ? 'active':'';?>">
						<a href="javascript:;">
					        <b class="caret"></b>
						    <i class="fas fa-user"></i>
						    <span>Admin Users </span> 
						</a>
						<ul class="sub-menu" >
							<li class="<?php echo ($page == 'addadmin.php')? 'active':'';?>" ><a href="addadmin.php">Add Admin </a></li>
							<li  class="<?php echo ($page == 'list-admin.php')? 'active':'';?>" ><a href="list-admin.php">List Admin</a></li>
					
						</ul>
					</li>

					<li class="has-sub <?php echo $page=='addteachers.php' ||  $page=='list-teacher.php' ? 'active':'';?>" >
						<a href="javascript:;">
					        <b class="caret"></b>
						    <i class="fas fa-user"></i>
						    <span>Teachers </span> 
						</a>
						<ul class="sub-menu" >
							<li class="<?php echo ($page == 'addteachers.php')? 'active':'';?>" ><a href="addteachers.php" >Add Teacher </a></li>
							<li class="<?php echo ($page == 'list-teacher.php')? 'active':'';?>" ><a href="list-teacher.php">List Teacher </a></li>	
						</ul>
					</li>
					<li class="has-sub <?php echo  $page=='list-user.php' ? 'active':'';?>" >
						<a href="javascript:;">
					        <b class="caret"></b>
						    <i class="fas fa-user"></i>
						    <span>Users </span> 
						</a>
						<ul class="sub-menu" >
							
							<li class="<?php echo ($page == 'list-user.php')? 'active':'';?>" ><a href="list-user.php">List User </a></li>	
						</ul>
					</li>
					<li class="has-sub <?php echo $page=='addtest.php' ||  $page=='list-test.php' ? 'active':'';?>">
						<a href="javascript:;">
					        <b class="caret"></b>
						    <i class="fas fa-user"></i>
						    <span>Test Type</span>
						</a>
					    <ul class="sub-menu">
							 <li class="<?php echo ($page == 'addtest.php')? 'active':'';?>"><a href="addtest.php">Add Test Type</a></li>
							 <li class="<?php echo ($page == 'list-test.php')? 'active':'';?>"><a href="list-test.php">List Test Type</a></li>	        
						</ul>
					</li>
				
					
			        <!-- begin sidebar minify button -->
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify">
					<i class="fa fa-angle-double-left"></i></a></li>
			        <!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->