<?php 
include("../includes/connection.php");  


$msg="";

if($_SESSION['name_user']==NULL)
{
  header("location:index.php");
}
  
include("template/inner/head.php");
include("template/inner/header.php");
include("template/inner/sidebar.php");
     
$total_pages_sql = "SELECT COUNT(*) FROM tests";
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
           $sql="SELECT tests.*, teachers.name as teacher_name
            FROM tests
              LEFT JOIN teachers
              ON tests.teacher_id = teachers.id
              WHERE tests.name LIKE '%$search%' OR tests.description LIKE '%$search%' GROUP BY tests.id ORDER BY tests.created_at DESC ";
            $fTests=mysqli_query($conn,$sql);
           $total_rows_array = mysqli_num_rows($fTests);
          $total_pages = ceil($total_rows_array / $no_of_records_per_page);
             

            $sql="SELECT tests.*, teachers.name as teacher_name
            FROM tests
              LEFT JOIN teachers
              ON tests.teacher_id = teachers.id
              WHERE tests.name LIKE '%$search%' OR tests.description LIKE '%$search%' GROUP BY tests.id ORDER BY tests.created_at DESC LIMIT $offset, $no_of_records_per_page ";
          $fTestsSearch=mysqli_query($conn,$sql);

            $aTests = [];
      if (mysqli_num_rows($fTestsSearch))
      {
        while($row =mysqli_fetch_assoc($fTestsSearch))
        {

          $aTests[] = $row;
         
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
         $sql="SELECT tests.*,teachers.name as teacher_name 
          FROM tests 
          LEFT JOIN teachers
          ON tests.teacher_id = teachers.id
           ORDER BY tests.created_at DESC LIMIT $offset, $no_of_records_per_page ";
        $fTests = mysqli_query($conn,$sql);

        $aTests = [];
        if (mysqli_num_rows($fTests))
        {
            while($row =mysqli_fetch_assoc($fTests))
            {
                $aTests[] = $row;

                
            }
        }

}
?>

<!-- begin #content -->
<div id="content" class="content">
      <!-- begin breadcrumb -->
      <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">List Test Tables</li>
      </ol>
      <!-- end breadcrumb -->
      <!-- begin page-header -->
      <h1 class="page-header">List Test</h1>
      <!-- end page-header -->

      <!-- begin row -->
      <div class="row">     
        <!-- begin col-12 -->
        <div class="col-lg-12">
          <!-- begin panel -->
          <div class="panel panel-inverse" data-sortable-id="table-basic-7">
          <!-- begin panel-heading -->
          <div class="panel-heading">
              <h4 class="panel-title">List Test Data Table </h4>
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
                         &nbsp<a href="list-test.php" class="btn btn-primary">Reset</a>
                    </div>
                </form>      
            </div>
        
        
          <table id='data-table-default' class='table table-striped table-boardered'>
            <thead>
              <tr>
             
              <th class='text-nowrap'>Teacher Name</th>
              <th class='text-nowrap'>Test Type Name</th>
              <th class='text-nowrap'>Test Name</th>
              <th class='text-nowrap'>Description</th>
              <th class='text-nowrap'>Content</th>
              <th class='text-nowrap'>Valid From</th>
              <th class='text-nowrap'>Valid To</th>
              <th class='text-nowrap'></th>
              </tr>
            </thead>
            
              <tbody>
                <?php 
                if(!empty($aTests)){
                  foreach($aTests as $aTest){

                  $fTestType=mysqli_query($conn,"SELECT * FROM test_type where id='".$aTest['test_type_id']."'");
                  $fTestTypeResult=mysqli_fetch_array($fTestType);
                    ?>

                     
                  <tr>
                 
                   <td><?php echo $aTest['teacher_name'];?></td>
                  <td><?php echo $fTestTypeResult[1];?></td>
                  <td><?php echo $aTest['name'];?></td>
                  <td><?php echo $aTest['description'];?></td>
                  <td><?php echo $aTest['content'];?></td>
                  <td><?php echo $aTest['valid_from'];?></td>
                  <td><?php echo $aTest['valid_to'];?></td>
                  <td><a href="update-test.php?id=<?php echo $aTest['id'];?>">Edit</a></td>
                  <td><a href="delete-test.php?id=<?php echo $aTest['id'];?>"  onclick="return confirm('Are you sure?');">Delete</a></td>
                  </tr>
          <?php } 
                }else{ 
                  $msg="No Record Found"?>
                  <?php } ?>
              </tbody>
          </table>
          <div class="col-md-8 col-sm-8 <?php echo (!empty($msg)) ? 'has-error' : ''; ?>">
                <br>
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
                        //echo "<li><a href='list-test.php?pageno=".$i."'> $i</a></li>";
                        if(isset($_GET['search'])){
                        echo "<li><a href='list-test.php?action=search&search=".$_GET['search']."&pageno=".$i."'> $i</a></li>";  
                      }else{
                        echo "<li><a href='list-test.php?pageno=".$i."'> $i</a></li>"; 
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
<!-- end #content -->
    

<?php
  include("template/inner/footer.php");
?>