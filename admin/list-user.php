<?php 


include('../includes/connection.php');

if($_SESSION['name']==NULL)
    {
        header("location:index.php");
    }

include('template/inner/head.php');
include('template/inner/header.php');
include('template/inner/sidebar.php');
$msg="";

$total_pages_sql = "SELECT COUNT(*) FROM users";
$result = mysqli_query($conn,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
    

if(isset($_GET['action']) && $_GET['action'] =='search')
{

    if (isset($_GET['pageno'])) 
    {
            $pageno = $_GET['pageno'];
    } 
    else 
    {
            $pageno = 1;
    }
        $no_of_records_per_page = 5;
        $offset = ($pageno-1) * $no_of_records_per_page;

         
          $search = mysqli_real_escape_string($conn,$_GET['search']);
            $fUsers=mysqli_query($conn,"SELECT  COUNT(*) FROM `users` WHERE `name` LIKE '%$search%' OR `email` LIKE '%$search%'  ");
            $total_rows = mysqli_fetch_array($fUsers)[0];

            $sql="SELECT * FROM `users` WHERE `name` LIKE '%$search%' OR `email` LIKE '%$search%' LIMIT $offset, $no_of_records_per_page";
          $fUsersSearch=mysqli_query($conn,$sql);
               
                $total_pages = ceil($total_rows / $no_of_records_per_page);

           $aUsers = [];
        if (mysqli_num_rows($fUsersSearch))
        {
            while($row =mysqli_fetch_array($fUsersSearch))
            {
                $aUsers[] = $row;
             
            }
        }


}

else
{
        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 5;
        $offset = ($pageno-1) * $no_of_records_per_page;
        $total_pages = ceil($total_rows / $no_of_records_per_page);
        $fUsers = mysqli_query($conn,"SELECT * FROM users LIMIT $offset, $no_of_records_per_page ");

        $aUsers = [];
        if (mysqli_num_rows($fUsers))
        {
            while($row =mysqli_fetch_array($fUsers))
            {
                $aUsers[] = $row;
            }
        }

}
?>


<!-- begin #content -->
<div id="content" class="content">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb pull-right">
		<li class="breadcrumb-item"><a href="javascript:;">admin</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">list-user</a></li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">Users </h1>
	<!-- end page-header -->
			
	<!-- begin row -->
    <div class="row">     
	   <!-- begin col-12 -->
		<div class="col-lg-12">
		<!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="table-basic-7">
            <!-- begin panel-heading -->
            <div class="panel-heading">
                <h4 class="panel-title">List of users </h4>
            </div>
            <!-- end panel-heading -->
                        
             <!-- begin panel-body -->
             <div class="panel-body">
                         
 	      <!-- begin table-responsive -->
            <div class="table-responsive">

            <!-- Being Search Functionality -->
            <div class="col-sm-6">
                <form class="form-inline my-2 my-lg-0" method="GET">
                <div class="form-group">
                    Search  :
                    &nbsp <input type="text" name="search" class="form-control"  placeholder="Enter keyword" >
                    &nbsp <input type="hidden" name="action" class="form-control" value="search" placeholder="Enter keyword" >
                    <input type="submit" class="btn btn-primary" value="Search"/>
                    &nbsp<a href="list-user.php" class="btn btn-primary">Reset</a>
                </div>
                </form>      
             </div> 
            <table id='data-table-default' class='table table-striped table-boardered'><thead>
			<tr>
			     <th class='text-nowrap'>Id</th>
			     <th class='text-nowrap'>Name</th>
                <th class='text-nowrap'>Email</th>
                <th class='text-nowrap'>Phone-no</th>
                <th class='text-nowrap'>Status</th>
                <th class='text-nowrap'></th>
			</tr>
			</thead>
            <tbody>
            <?php if(!empty($aUsers)){
                foreach ($aUsers as $aUser) { ?>
                <tr>
                <td><?php echo $aUser['id'];?></td>
                <td><?php echo $aUser['name'];?></td>
                <td><?php echo $aUser['email'];?></td>
                <td><?php echo $aUser['phone_no'];?></td>
                <td><?php echo ($aUser['status'] == 1) ? 'Active' : 'Inactive';?></td>
                <td><a href="block-user.php?id=<?php echo $aUser['id'];?>" ><?php echo ($aUser['is_block_by_admin'] == 0) ? 'Block' : 'Unblock';?></a></td>
                </tr>
                <?php } }
                         else
                        {
                             $msg="No Record Found";
                        }
                ?>
                                         
            </tbody> 
            </table>
        <!-- For Message Printing -->
        <div class="col-md-8 col-sm-8 <?php echo (!empty($msg)) ? 'has-error' : ''; ?>">
            <h4><span class="help-block"><?php echo $msg;?></h4></span>
        </div>

        <!-- Being Pagination -->
        <ul class="pagination justify-content-end">
            <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Previous</a>
            </li>
                                          
            <?php
            for($i=1; $i<=$total_pages; $i++)
            {   
                if($i==$pageno)
                {
                    echo '<li class="active"><a>'.$i.'</a></li>'; 
                }
                else
                {
                    //echo "<li><a href='list-user.php?pageno=".$i."'> $i</a></li>";
                    if(isset($_GET['search']))
                    {
                        echo "<li><a href='list-user.php?action=search&search=".$_GET['search']."&pageno=".$i."'> $i</a></li>";  
                    }
                    else
                    {
                        echo "<li><a href='list-user.php?pageno=".$i."'> $i</a></li>"; 
                    }
                }     
            }
                                             
            ?>
            <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                    <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
            </li>
        </ul>
        <!-- End Pagination -->

    				</div>
					<!-- end table-responsive -->
                </div>
                <!-- end panel-body -->
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-12 --> 
    </div>    
    <!-- end row -->   
</div>
<!-- end content -->   
                      
<!-- begin scroll to top btn -->
<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
<!-- end scroll to top btn -->
    

    
<?php include('template/inner/footer.php');?>














