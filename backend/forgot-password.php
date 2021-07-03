  <?php 
include("../includes/connection.php");

$msg2="";
$msg1="";

if($_SESSION['name_user']==NULL)
{
  header("location:index.php");
}
            
if(isset($_POST['submit']))
{

        if(!empty($_POST['email']) )
        {
           
            $email= $_POST['email'];
            
           
           
            $sql="select * from teachers where  email='$email' AND status='1' LIMIT 1 ";
           // echo $sql;
             $result = mysqli_query($conn, $sql);
            $row=mysqli_fetch_assoc($result);
             
             if(mysqli_num_rows($result)>0 )
             {
                echo  $activation_password=substr(md5(time()),0,10);
                $update="UPDATE `teachers` SET `password`='".md5($activation_password)."' WHERE email='$email' AND status='1'";
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


include("template/inner/head.php");
//include("template/inner/header.php");
//include("template/inner/sidebar.php");

?>

            <!-- begin #content -->
            <div id="content" class="content">
            <!-- begin row -->
            <div class="row">
                
                <!-- begin col-6 -->
                <div class="col-lg-10">
                    <!-- begin panel -->
                    <br>
                    <br>
                    <br>
                    <br>

                    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                        <!-- begin panel-heading -->
                        <div class="panel-heading">
                            <center><h4 class="panel-title">Change Password Form</h4></center>
                        </div>
                        <!-- end panel-heading -->
                        
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
                                    <label class="col-md-4 col-sm-4 col-form-label">&nbsp;</label>
                                    <div class="col-md-8 col-sm-8">
                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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
<?php 
//include("template/inner/footer.php");

    ?>