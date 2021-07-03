  <?php 
include("includes/connection.php");

$msg2="";
if(isset($_POST['submit']))
{

        if(!empty($_POST['email']) && !empty($_POST['password']) )
        {
           
            $email= $_POST['email'];
            
            $password=$_POST['password'];
           
            $sql="select * from users where  email='$email' AND  password='".md5($password)."'  LIMIT 1 ";
            //echo $sql;
             $result = mysqli_query($conn, $sql);
         
             
             if(mysqli_num_rows($result)>0 )
             {
                while($row = mysqli_fetch_assoc($result)) 
                {
                   
                    
                    if($row['status']==1)
                    {
                        if($row['is_block_by_admin']==0)
                        {
                            $_SESSION['user_id']=$row['id'];
                            //$_SESSION['name']=$row['name'];
                            header("location:dashboard.php");
                        }
                        else
                        {
                            $msg2="Your Account is Block By Admin";
                        }
                        
                    }
                    else 
                    {
                        $msg2="Inactive Email and Password,Please Verify Your Email";
                    }
                }
               
             }
              else
             {

                 $msg2= "Invalid Email and Password";            
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
                                               <center> <div class="title">Login Form</div></center>
                                                
                                            </div>
                                        
                                    </div>
                                </div>
                              
                            </div>
                            <!-- END row -->
                        </div>
                        
                        <!-- begin panel-body -->
                        <div class="panel-body">
                            <form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post">
                                <div class="form-group row m-b-15 <?php echo (!empty($msg2)) ? 'has-error' : ''; ?>">
                                    <center><h4><span class="help-block"><?php echo $msg2; ?></span></h4></center>
                                </div>

                                 <div class="form-group row m-b-15">
                                    <label class="col-md-4 col-sm-4 col-form-label" for="email">Email * :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control" type="email" id="email" name="email" data-parsley-type="email" placeholder="Email" data-parsley-required="true" data-parsley-no-focus value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"/>
                                    </div>
                                </div>
                               
                                <div class="form-group row m-b-15">
                                    <label class="col-md-4 col-sm-4 col-form-label" for="password">Password * :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control" type="password" id="password" name="password" placeholder="Password" data-parsley-required="true" data-parsley-no-focus />
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    
                                    
                                        <center><a href="forgot-password.php" >Forgot Password? Click Here</a></center>
                                    
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
<?php 
include("frontend/footer.php");
    ?>