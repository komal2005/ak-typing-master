   <?php 
include("backend/includes/connection.php");


if(isset($_POST["submit"]))
{
    //echo $id=$_GET['id'];
    $user_name               =  $_POST["user_name"];
    $user_email              =  $_POST["user_email"];
    $user_phone_no           =  $_POST["user_phone_no"];
    
        
        $update="UPDATE `users` SET `name`='$user_name',`email`='$user_email',`phone_no`='$user_phone_no' where id='".$_SESSION['id']."'";
        
    
        if(mysqli_query($conn,$update))
        {
         
            header("location:login.php");
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
            <!-- begin col-6 -->    
            <div class="col-lg-3"> </div>              
                 <div class="col-lg-6">
                    <!-- begin panel --><br>
                    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                        <!-- begin panel-heading -->
                        <div class="panel-heading">
                            <center><h4 class="panel-title">Edit Profile Form</h4></center>
                        </div>
                        <!-- end panel-heading -->
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
include("frontend/footer.php");
    ?>