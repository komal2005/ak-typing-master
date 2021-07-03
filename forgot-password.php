  <?php 
include("includes/connection.php");
$msg1="";
$msg2="";
if($_SESSION['user_id']==NULL)
{
    header("location:index.php");
}         
if(isset($_POST['submit']))
{

        if(!empty($_POST['email']) )
        {
           
            $email= $_POST['email'];
            
           
           
            $sql="select * from users where  email='$email' AND status='1' LIMIT 1 ";
           // echo $sql;
             $result = mysqli_query($conn, $sql);
            $row=mysqli_fetch_assoc($result);
             
             if(mysqli_num_rows($result)>0 )
             {
                echo  $activation_password=substr(md5(time()),0,10);
                $update="UPDATE `users` SET `password`='".md5($activation_password)."' WHERE email='$email' AND status='1'";
                echo $update;
                if(mysqli_query($conn,$update))
                {


                    $send=$email;
                    $subject="Email Verification";
                    $message="Name:".$row['name']."<br>Email:".$email."<br>Password:".$activation_password;
                    $headers="From:komalnakum2005@gmail.com";
                    $headers .= 'MIME-Version: 1.0;'."\r\n";
                    $headers .= 'Content-type: text/html; charset=UTF-8'."\r\n";
                    mail($send,$subject,$message,$headers);
                    //header("location:login.php");
                    $msg1="We have sent a Changed Password to Email Address Provided";
                }
                    
                else
                {
                    echo "Error:<br>" . mysqli_error($conn);
                } 
             }  
             else
            {

                $msg2="Your Email is not Available in our database";           
            } 


         
        } 

                   
}
    

?>

<?php


include("frontend/head.php");
include("frontend/header.php");
?>

 <!-- BEGIN #slider -->
            <!-- begin #content -->
            <div id="content" >
            <!-- begin row -->
            <div class="row">
                <div class="col-lg-3"></div>
                <!-- begin col-6 -->
                <div class="col-lg-6">
                    <!-- begin panel -->
                    <br>
                    <br>
                    <br>
                    <br>

                    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                       
                         <!-- BEGIN checkout-header -->
                        <div class="checkout-header">
                            <!-- BEGIN row -->
                            <div class="row">
                                <!-- BEGIN col-3 -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="step">
                                        <a href="checkout_cart.html">
                                            <div class="info">
                                               <center> <div class="title">Forgot Password Form</div></center>
                                                
                                            </div>
                                        </a>
                                    </div>
                                </div>
                              
                            </div>
                            <!-- END row -->
                        </div>
                        
                        <!-- begin panel-body -->
                        <div class="panel-body">
                            <form class="form-horizontal" data-parsley-validate="true" name="demo-form" method="post">
                            <div class="form-group row m-b-15 <?php echo (!empty($msg2)) ? 'has-error' : ''; echo (!empty($msg1)) ? 'has-success' : '';?>">
                                <label class="col-md-2 col-sm-2 col-form-label" ></label>
                                <div class="col-md-8 col-sm-8">
                                    <center><h4><span class="help-block"><?php echo $msg2;?></h4></span></center>
                                    <center><h4><span class="help-block"><?php echo $msg1;?></h4></span></center>
                            </div>
                            
                            </div>
                                 <div class="form-group row m-b-15">
                                    <label class="col-md-4 col-sm-4 col-form-label" for="email">Email Address * :</label>
                                    <div class="col-md-8 col-sm-8">
                                        <input class="form-control" type="email" id="email" name="email" data-parsley-type="email" placeholder="Email" data-parsley-required="true" data-parsley-no-focus value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"/>
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
                <div class="col-lg-3"></div>
            </div>
            <!-- end row -->
            </div>
            <!-- end #content -->

        
<?php 
include("frontend/footer.php");
    ?>