   <?php 
include("includes/connection.php");

$msg2="";
$msg="";
if(isset($_POST["submit"]))
{

    $user_name               =  $_POST["user_name"];
    $user_email              =  $_POST["user_email"];
    $user_phone_no           =  $_POST["user_phone_no"];
    $user_password           =  $_POST["user_password"];
    $user_confirm_password   =  $_POST["user_confirm_password"];
   
    $activation_key=md5(time().$user_email);
    $select=mysqli_query($conn,"select * from users where email='".$user_email."'");
    if(mysqli_num_rows($select)==1)
    {
        if($_POST['user_email']==$user_email)
        {
            $msg="Email Already Exists!!";
        }
    }
    else{
        $insert = "INSERT INTO `users`(`name`, `email`, `password`, `phone_no`,`activation_key`) VALUES ('$user_name','$user_email','".md5($user_password)."','$user_phone_no','$activation_key')";

        //echo $insert;
    
   if(mysqli_query($conn,$insert))
   {

    

        $send=$user_email;
        $subject="Email Verification";
        $message="Name".$user_name."<br>Email:".$user_email."<br>Phone Number:".$user_phone_no."<br>Password:".$user_password."<br>"."<a href='http://localhost/typingmaster/verify.php?activation_key=$activation_key'>Verify Email</a>";
        $headers="From:komalnakum2005@gmail.com";
        $headers .= 'MIME-Version: 1.0;'."\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8'."\r\n";

        mail($send,$subject,$message,$headers);
        $msg2=" Your Registration Successfully,We have sent a Verification Email to Email Address Provided";    
        
        }
        else
        {
             echo "Error:<br>" . mysqli_error($conn);
        }
    }
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
                                               <center> <div class="title">Register Form</div></center>
                                                
                                            </div>
                                       
                                    </div>
                                </div>
                              
                            </div>
                            <!-- END row -->
                        </div>
                       <!-- begin panel-body -->
                       
                        <div class="panel-body">
                          
                            <form class="form-horizontal" data-parsley-validate="true" method="post">
                                 <div class="form-group row m-b-15 <?php echo (!empty($msg2)) ? 'has-success' : ''; ?>">
                                    <center><h4><span class="help-block"><?php echo $msg2; ?></span></h4></center>
                                </div>
                                
                                <div class="form-group row m-b-15">
                                    <label class="col-md-4 col-sm-4 col-form-label" for="name"> Name * :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control" type="text" id="name" name="user_name" placeholder="Enter Name" data-parsley-required="true" value="<?php echo isset($_POST['user_name']) ? $_POST['user_name'] : ''; ?>" data-parsley-no-focus/>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15 <?php echo (!empty($msg)) ? 'has-error' : ''; ?>">
                                    <label class="col-md-4 col-sm-4 col-form-label" for="email">Email * :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control" type="email" id="email" name="user_email" data-parsley-type="email" placeholder="Enter Email" data-parsley-required="true" value="<?php echo isset($_POST['user_email']) ? $_POST['user_email'] : ''; ?>" data-parsley-no-focus/>
                                        
                                   <h5><span class="help-block"><?php echo $msg; ?></span></h5>   
                                    </div>
                                </div>
                                
                                <div class="form-group row m-b-15">
                                    <label class="col-md-4 col-sm-4 col-form-label" for="phone_no">Phone Number * :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control" type="text" data-parsley-maxlength="10" id="phone_no" name="user_phone_no" data-parsley-type="number" placeholder="Number"  data-parsley-required="true" data-parsley-no-focus value="<?php echo isset($_POST['user_phone_no']) ? $_POST['user_phone_no'] : ''; ?>" >
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-4 col-sm-4 col-form-label" for="password">Password * :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control" type="password" data-parsley-minlength="8" data-parsley-maxlength="15" id="password" name="user_password"  placeholder="Enter password" data-parsley-required="true" data-parsley-no-focus/>
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-md-4 col-sm-4 col-form-label" for="confirm_password">Confirm Password * :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control" type="password" id="confirm_password" name="user_confirm_password"  placeholder="Enter Confirm password" data-parsley-required="true" data-parsley-no-focus  data-parsley-equalto="#password" />
                                    </div>
                                </div>
                               <div class="form-group row m-b-15">
                                        <center><button type="submit" name="submit" class="btn btn-inverse">Submit</button></center>
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
<br><br>
<?php 
include("frontend/footer.php");
    ?>