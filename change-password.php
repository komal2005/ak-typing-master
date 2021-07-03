   <?php 
include("includes/connection.php");
$msg2="";

if(isset($_POST["submit"]))
{
    //echo $id=$_GET['id'];
    $current_password               =  $_POST["current_password"];
    $new_password                   =  $_POST["new_password"];
    $new_confirm_password           =  $_POST["new_confirm_password"];
    
        
        $update="UPDATE `users` SET `password`='".md5($new_password)."' where id='".$_SESSION['user_id']."'";
        //echo $update;
    
        if(mysqli_query($conn,$update))
        {
            $msg2= "Your Password Change Successfully";
            //header("location:dashboard.php");
        }
        else
        {
             echo "Error: " . $update . "<br>" . mysqli_error($conn);
        }
}
if($_SESSION['name']==NULL)
{
    header("location:index.php");
}
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
                                               <center> <div class="title">Change Password Form</div></center>
                                                
                                            </div>
                                        
                                    </div>
                                </div>
                              
                            </div>
                            <!-- END row -->
                        </div>
                        <!-- begin panel-body -->
                       
                        <div class="panel-body">
                            <div class="form-group row m-b-15 <?php echo (!empty($msg2)) ? 'has-success' : ''; ?>">
                                    <center><h4><span class="help-block"><?php echo $msg2; ?></span></h4></center>
                             </div>
                            <form class="form-horizontal" data-parsley-validate="true" method="post">
                                <div class="form-group row m-b-15">
                                    <label class="col-md-4 col-sm-4 col-form-label" for="current_password">Current Password * :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control" type="password" data-parsley-minlength="8" data-parsley-maxlength="15" id="current_password" name="current_password"  placeholder="Enter password" data-parsley-required="true" data-parsley-no-focus/>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-4 col-sm-4 col-form-label" for="new_password">New Password * :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control" type="password" data-parsley-minlength="8" data-parsley-maxlength="15" id="new_password" name="new_password"  placeholder="Enter New password" data-parsley-required="true" data-parsley-no-focus/>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-4 col-sm-4 col-form-label" for="new_confirm_password">Confirm Password * :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control" type="password" id="new_confirm_password" name="new_confirm_password"  placeholder="Enter Confirm password" data-parsley-required="true" data-parsley-no-focus  data-parsley-equalto="#new_password" />
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