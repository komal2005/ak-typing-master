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

      
$total_pages_sql = "SELECT COUNT(*) FROM admin";
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
            $fAdmin=mysqli_query($conn,"SELECT  COUNT(*) FROM `admin` WHERE `name` LIKE '%$search%' OR `email` LIKE '%$search%'  ");
            $total_rows = mysqli_fetch_array($fAdmin)[0];

            $sql="SELECT * FROM `admin` WHERE `name` LIKE '%$search%' OR `email` LIKE '%$search%' LIMIT $offset, $no_of_records_per_page";
          $fAdminSearch=mysqli_query($conn,$sql);
               
                $total_pages = ceil($total_rows / $no_of_records_per_page);

           $aAdmins = [];
        if (mysqli_num_rows($fAdminSearch))
        {
            while($row =mysqli_fetch_array($fAdminSearch))
            {
                $aAdmins[] = $row;
             
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
        $fAdmin = mysqli_query($conn,"SELECT * FROM admin LIMIT $offset, $no_of_records_per_page ");

        $aAdmins = [];
        if (mysqli_num_rows($fAdmin))
        {
            while($row =mysqli_fetch_array($fAdmin))
            {
                $aAdmins[] = $row;
            }
        }

}
?>

<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
		<li class="breadcrumb-item"><a href="javascript:;">admin</a></li>
		<li class="breadcrumb-item"><a href="javascript:;">list-admin</a></li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">Admin Users </h1>
	<!-- end page-header -->
			
	<!-- begin row -->
	<div class="row">     
	<!-- begin col-12 -->
	<div class="col-lg-12">
	<!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="table-basic-7">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <h4 class="panel-title">List of Admin </h4>
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
                &nbsp<a href="list-admin.php" class="btn btn-primary">Reset</a>
                </div>
                </form>      
        </div> 
             <table id='data-table-default' class='table table-striped table-boardered'><thead>
				<tr>
	                <th class='text-nowrap'>Id</th>
	                <th class='text-nowrap'>Name</th>
                    <th class='text-nowrap'>Email</th>
                    <th class='text-nowrap'>Status</th>
                    <th class='text-nowrap'></th>
	           </tr>
			</thead>
            <tbody>
            <?php if(!empty($aAdmins)){
                foreach ($aAdmins as $aAdmin){
            ?>
            <tr>
                <td><?php echo $aAdmin['id'];?></td>
                <td><?php echo $aAdmin['name'];?></td>
                <td><?php echo $aAdmin['email']?></td>
                <td><?php echo ($aAdmin['status'] == 1) ? 'Active' : 'Inactive';?></td>
                <td><a href="edit-admin.php?id=<?php echo $aAdmin['id'];?>" >Edit</a></td>
                <td><a href="delete-admin.php?id=<?php echo $aAdmin['id'];?>"  onclick="return confirm('Are you Sure?');"> Delete</a></td>
            </tr>

            <?php } } else 
                        {
                            $msg="No Record Found";
                        }
                ?>

            </tbody></table>
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
                            //echo "<li><a href='list-admin.php?pageno=".$i."'> $i</a></li>";
                             if(isset($_GET['search']))
                             {
                                echo "<li><a href='list-admin.php?action=search&search=".$_GET['search']."&pageno=".$i."'> $i</a></li>";  
                             }
                             else
                             {
                                echo "<li><a href='list-admin.php?pageno=".$i."'> $i</a></li>"; 
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