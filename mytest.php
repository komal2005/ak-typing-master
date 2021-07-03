<?php 
include("includes/connection.php");


if($_SESSION['user_id']==NULL)
{
  header("location:index.php");
}

include("frontend/head.php");
include("frontend/header.php");
$msg="";


$total_pages_sql = "SELECT COUNT(*) FROM test_result where student_id='".$_SESSION['user_id']."'";
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
    $no_of_records_per_page = 1;
    $offset = ($pageno-1) * $no_of_records_per_page;
             

    $search = mysqli_real_escape_string($conn,$_GET['search']);
    $sql =  $sql = "SELECT  tests.*, teachers.name as teacher_name, teachers.id as teacher_id,test_result.*  FROM test_result
              LEFT JOIN teachers
              ON test_result.teacher_id = teachers.id
              LEFT JOIN tests
              ON test_result.test_id = tests.id
              WHERE test_result.student_id='".$_SESSION['user_id']."' AND tests.name   LIKE '%$search%' OR tests.description LIKE '%$search%' GROUP BY tests.id ";

      $fTests=mysqli_query($conn,$sql);
       $total_rows_array = mysqli_num_rows($fTests);
       $total_pages = ceil($total_rows_array / $no_of_records_per_page);
   
       $sql = "SELECT tests.*, teachers.name as teacher_name, teachers.id as teacher_id,test_result.* FROM test_result
              LEFT JOIN teachers
              ON test_result.teacher_id = teachers.id
              LEFT JOIN tests
              ON test_result.test_id = tests.id
              WHERE test_result.student_id='".$_SESSION['user_id']."' AND  tests.name  LIKE '%$search%' OR tests.description LIKE '%$search%'  GROUP BY tests.id ORDER BY tests.created_at DESC LIMIT $offset, $no_of_records_per_page ";
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
      $total_pages = ceil($total_rows / $no_of_records_per_page);

     $sql = "SELECT tests.*, teachers.name as teacher_name, teachers.id as teacher_id,test_result.* FROM test_result
              LEFT JOIN teachers
              ON test_result.teacher_id = teachers.id
              LEFT JOIN tests
              ON test_result.test_id = tests.id
              WHERE test_result.student_id='".$_SESSION['user_id']."' GROUP BY tests.id  ORDER BY tests.created_at DESC   LIMIT $offset, $no_of_records_per_page ";

      $fTestResult = mysqli_query($conn,$sql);

      $aTests = [];
      if (mysqli_num_rows($fTestResult))
      {
          while($row =mysqli_fetch_array($fTestResult))
          {
              $aTests[] = $row;
          }
      }

}
?>
  <!-- BEGIN #checkout-payment -->
  <div class="section-container" id="checkout-info">
     <!-- BEGIN container -->
      <div class="container">
        <!-- BEGIN checkout -->
        <div class="checkout">
               
        <!-- begin col-6 -->
        <div class="col-lg-12">
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-validation-1">
         <!-- BEGIN checkout-header -->
           <div class="checkout-header login-header">
            <!-- BEGIN row -->
              <div class="row">
                <!-- BEGIN col-3 -->
                <div class="col-md-12 col-sm-12">
                  <div class="step">
                    <div class="info">
                        <center> <div class="title">My Tests </div></center>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END row -->
          </div>
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
                    <input type="submit" class="btn btn-inverse" value="Search"/>
                    &nbsp<a href="mytest.php" class="btn btn-inverse">Reset</a>
                    </div>
                  </form>      
              </div>
              <table id='data-table-default' class='table table-striped table-boardered'>
              <thead>
              <tr>                          
              <th class='text-nowrap'>Test Name</th>
              <th class='text-nowrap'>Test Description</th>
              <th class='text-nowrap'>Test Created By</th>
              <th class='text-nowrap'>Applied On</th>                           
              </tr>
              </thead>
              <tbody>
              <?php  
              if (!empty($aTests)){
              foreach ($aTests as $aTest) { ?>
                <tr>
                <td><?php echo $aTest['name']?></td>
                <td><?php echo $aTest['description']?></td>
                <td><?php echo $aTest['teacher_name']; ?></td>
                <td><?php echo date('g:i A dS F Y', strtotime($aTest['created_on'])); ?> </td>
              </tr>
              <?php } }else{
                $msg= "No Record Found";
              } ?>
              </tbody></table>

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
                          //echo "<li><a href='mytest.php?pageno=".$i."'> $i</a></li>";
                            if(isset($_GET['search']))
                            {
                              echo "<li><a href='mytest.php?action=search&search=".$_GET['search']."&pageno=".$i."'> $i</a></li>";  
                            }else
                            {
                              echo "<li><a href='mytest.php?pageno=".$i."'> $i</a></li>"; 
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
            <!-- end col-6 -->
          </div>
          <!-- END checkout -->
        </div>
        <!-- END container -->
  </div>
  <!-- END #checkout-info -->


  <?php 
include("frontend/footer.php");
    ?>   

