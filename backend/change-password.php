   <?php 
include("../includes/connection.php");

$msg="";

if($_SESSION['name_user']==NULL)
{
    header("location:index.php");
}

if(isset($_POST["submit"]))
{
    //echo $id=$_GET['id'];
    $current_password               =  $_POST["current_password"];
    $new_password                   =  $_POST["new_password"];
    $new_confirm_password           =  $_POST["new_confirm_password"];
    
        
        $update="UPDATE `teachers` SET `password`='".md5($new_password)."' where id='".$_SESSION['id']."'";
        //echo $update;
    
        if(mysqli_query($conn,$update))
        {
            $msg= "Your Password Change Successfully";
            //header("location:dashboard.php");
        }
        else
        {
             echo "Error: " . $update . "<br>" . mysqli_error($conn);
        }
}

include("template/inner/head.php");
include("template/inner/header.php");
include("template/inner/sidebar.php");
?>

 <!-- BEGIN #slider -->
<div id="slider" class="section-container p-0 bg-white-darker">
    <!-- BEGIN carousel -->
    <div id="main-carousel" class="carousel slide" data-ride="carousel">
         <!-- BEGIN carousel-inner -->
         <div class="carousel-inner"> 
            <!-- begin #content -->
            <div id="content" class="content">
            <!-- begin row -->
            
            <div class="row">
            <!-- begin col-12 -->    
                    
                 <div class="col-lg-12">
                    <!-- begin panel --><br>
                    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                        <!-- begin panel-heading -->
                        <div class="panel-heading">
                            <center><h4 class="panel-title">Change Password Form</h4></center>
                        </div>
                        <!-- end panel-heading -->
                        <!-- begin panel-body -->
                       
                        <div class="panel-body">
                            <div class="form-group row m-b-15 <?php echo (!empty($msg)) ? 'has-success' : ''; ?>">
                            <label class="col-md-2 col-sm-2 col-form-label" ></label>
                                <div class="col-md-8 col-sm-8">
                                     <center><h4><span class="help-block"><?php echo $msg;?></h4></span></center>
                                </div>
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
                                <div class="form-group row m-b-0">
                                    <label class="col-md-4 col-sm-4 col-form-label">&nbsp;</label>
                                    <div class="col-md-8 col-sm-8">
                                        <button type="submit" name="submit" class="btn btn-primary"><center>Submit</center></button>
                                    </div>
                                </div>
                            </form>
                        
                        </div>
                        <!-- end panel-body -->
                       
                    </div>
                    <!-- end panel -->

                </div>
                <!-- end col-6 -->
               
            </div>
            <!-- end row -->
           </div>
            <!-- end #content -->
            
         </div>
        <!-- END carousel-inner -->
               
    </div>
    <!-- END carousel -->

 </div>
<!-- END #slider -->
<?php 
include("template/inner/footer.php");
    ?>