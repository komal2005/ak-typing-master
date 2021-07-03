<?php
$page=basename($_SERVER['PHP_SELF']);
?>
<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				
				<!-- begin sidebar nav -->
				<ul class="nav">
					<li class="has-sub <?php echo $page=='dashboard.php' ? 'active':'';?>">
						<a href="dashboard.php">
					        
						    <i class="fa fa-th-large"></i>
						    <span>Dashboard</span>
					    </a>
					</li>
					<li class="has-sub <?php echo $page=='add-test.php' || $page=='list-test.php' || $page=='active-test.php' || $page=='completed-test.php' || $page=='active-test-result.php' || $page=='test-score.php'? 'active':'';?> ">
						<a href="javascript:;">
					        <b class="caret"></b>
						    <i class="fa fa-th-large"></i>
						    <span>My Tests</span>
					    </a>
						<ul class="sub-menu">
						    <li class="<?php  echo ($page=='add-test.php') ? 'active':'';?>" ><a  href="add-test.php">Add Test</a></li>
						    <li class="<?php  echo ($page=='list-test.php') ? 'active':'';?>"><a href="list-test.php">List Test</a></li>
						     <li class="<?php  echo ($page=='active-test.php' || $page=='active-test-result.php' ) ? 'active':'';?>" ><a  href="active-test.php">Active Test</a></li>
						    <li class="<?php  echo ($page=='completed-test.php' || $page=='test-score.php' ) ? 'active':'';?>"><a href="completed-test.php">Completed Test</a></li>
						</ul>
					</li>

					
						
					<!-- begin sidebar minify button -->
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
			        <!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		