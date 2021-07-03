   <?php 
include("includes/connection.php");

if($_SESSION['user_id']==NULL)
{
    header("location:index.php");
}
if(isset($_POST["submit"]))
{
    //echo $id=$_GET['id'];
    $user_name               =  $_POST["user_name"];
    $user_email              =  $_POST["user_email"];
    $user_phone_no           =  $_POST["user_phone_no"];
    
        
        $update="UPDATE `users` SET `name`='$user_name',`email`='$user_email',`phone_no`='$user_phone_no' where id='".$_SESSION['user_id']."'";
        
    
        if(mysqli_query($conn,$update))
        {
            header("location:dashboard.php");
        }
        else
        {
             echo "Error: " . $update . "<br>" . mysqli_error($conn);
        }
}

$register_select="select * from users where id='".$_SESSION['user_id']."'";
$register_result=mysqli_query($conn,$register_select);
$register_row=mysqli_fetch_assoc($register_result);

include("frontend/head.php");
include("frontend/header.php");

?>

 
  <!-- BEGIN #checkout-payment -->
        <div class="section-container" id="checkout-info">
             <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN checkout -->
                <div class="checkout">
                <div class="col-lg-3"></div>
                <!-- begin col-6 -->
                <div class="col-lg-6">

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
                                               <center> <div class="title">Edit Profile  Form</div></center>
                                                
                                            </div>
                                        
                                    </div>
                                </div>
                              
                            </div>
                            <!-- END row -->
                        </div>
                       <!-- begin panel-body -->
                        <div class="panel-body">
                          
                            <form class="form-horizontal" data-parsley-validate="true" method="post">

                                <div class="form-group row m-b-15">
                                    <label class="col-md-4 col-sm-4 col-form-label" for="name"> Name * :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control" type="text" id="name" name="user_name" placeholder="Enter Name" data-parsley-required="true" value="<?php echo  $register_row['name'];?>" data-parsley-no-focus/>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-4 col-sm-4 col-form-label" for="email">Email * :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control" type="email" id="email" name="user_email" data-parsley-type="email" placeholder="Enter Email" data-parsley-required="true" value="<?php echo  $register_row['email'];?>"data-parsley-no-focus/>
                                    </div>
                                </div>
                                
                                <div class="form-group row m-b-15">
                                    <label class="col-md-4 col-sm-4 col-form-label" for="phone_no">Phone Number * :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control" type="text" data-parsley-maxlength="10" id="phone_no" name="user_phone_no" data-parsley-type="number" placeholder="Number"  data-parsley-required="true" data-parsley-no-focus value="<?php echo  $register_row['phone_no'];?>" >
                                    </div>
                                </div>
                                  <div class="form-group row m-b-15">
                                        <center><button type="submit" name="submit" class="btn btn-inverse btn1">Submit</button></center>
                                </div>
                                 
                               </form>
                        
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