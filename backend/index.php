<?php 
include("../includes/connection.php");


if(!empty($_SESSION) && isset($_SESSION['name_user'])  && isset($_SESSION['status']) && isset($_SESSION['password']) &&  $_SESSION['session_name'] == 'backend')
{
   // echo $_SESSION['session_name'];
    if($_SESSION['status']==1)
    {
         header("location:dashboard.php"); 
    }
    
}

$email="";
$email_error="";
$password="";
$password_error="";
$msg2="";
if(isset($_POST['submit']))
{
        
         if(empty(trim($_POST['email'])))
         {
            $email_error="Please Enter Email Address";
         }
         else
         {
            $email=trim($_POST['email']);
         }

        if(trim(empty($_POST['password'])))

         {
            $password_error="Please Enter Password";
         }
          else
         {
            $password=trim($_POST['password']);
         }


        if(!empty($_POST['email']) && !empty($_POST['password']) )
        {
            //$email= $_POST['email'];
            
           // $password=$_POST['password'];
           
            $sql="SELECT  * from teachers where  email='$email' AND  password='".md5($password)."'";
            
             $result = mysqli_query($conn, $sql);
         
             
             if(mysqli_num_rows($result) ==1 )
             {
                while($row = mysqli_fetch_assoc($result)) 
                {
                    $_SESSION['id']=$row['id'];
                    $_SESSION['name_user']=  $row["name"];
                    $_SESSION['email']=$email;
                     $_SESSION['password']=$password;
                    $_SESSION['status']=$row['status'];
                    $_SESSION['session_name'] = 'backend';
                    if($row['status']==1)
                    {
                       header("location:dashboard.php"); 
                    }
                    else 
                    {
                        $msg2="Inactive Email and Password";
                    }
                }
               
             }
             else
             {

                 $msg2= "Invalid Email and Password";            
             }
             
        }    
                    
}
include("template/login/head.php"); 
?>

<!-- begin login -->
<div class="login bg-black animated fadeInDown">
    <!-- begin brand -->
    <div class="login-header">
        <div class="brand">
            <span class="logo"></span> <b>Typing</b> Master
        </div>
        <div class="icon">
            <i class="fa fa-lock"></i>
        </div>
    </div>
    <!-- end brand -->
            
    <!-- begin login-content -->
    <div class="login-content">
        <form action="" method="post" class="margin-bottom-0">

            <div class="form-group m-b-20 <?php echo (!empty($email_error)) ? 'has-error' : ''; ?>">
                <input type="email" class="form-control form-control-lg inverse-mode" placeholder="Email Address" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                <h4><span class="help-block"><?php echo $email_error; ?></span></h4>
            </div>
                   
            <div class="form-group m-b-20  <?php echo (!empty($password_error)) ? 'has-error' : ''; ?>">
                <input type="password" class="form-control form-control-lg inverse-mode" placeholder="Password"  name="password">
                <h4><span class="help-block"><?php echo $password_error; ?></span></h4>
            </div>
                  
            <div class="form-group m-b-20 <?php echo (!empty($msg2)) ? 'has-error' : ''; ?>">
                <h4><span class="help-block"><?php echo $msg2; ?></span></h4>
            </div>

            <div class="form-group m-b-20">
                <a href="forgot-password.php">Forgot Password ? Click Here</a>
            </div>
            <div class="login-buttons">
                <button type="submit" name="submit" class="btn btn-success btn-block btn-lg">Sign me in</button>
            </div>
        </form>
    </div>
    <!-- end login-content -->
</div>
<!-- end login -->
        
       
     <?php 

   include("template/login/footer.php");

   ?>
   