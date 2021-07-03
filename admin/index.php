
<?php
include("../includes/connection.php");
if(!empty($_SESSION) && isset($_SESSION['name'])  && isset($_SESSION['status']) &&  $_SESSION['session_name'] == 'admin')
{
    //print_r($_SESSION['session_name']);
    
    if($_SESSION['status'] == 1)
    {
        header('location:dashboard.php');
        
    }   
}


$email = $password = "";
$email_err = $password_err = "";
$msg="";
$name="";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
 
    // Check if username is empty
    if(empty(trim($_POST["email"])))
    {
        $email_err = "Please enter your email.";
    }
     else
    {
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"])))
    {
        $password_err = "Please enter your password.";
    } 
    else
    {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    //if(empty($username_err) && empty($password_err))
     if (isset($_POST['login']))
        {
            if(!empty($_POST["email"]) && !empty($_POST["password"]))
            {
                $result = mysqli_query($conn,'SELECT * from admin where email="'.$email.'" and password="'.md5($password).'"');
                if (mysqli_num_rows($result) == 1)
	            {
                   while($row = mysqli_fetch_assoc($result))
                   {
                        $name = $row["name"];
                        $_SESSION['name']= $name;
                        $_SESSION['status']= $row['status'];
                        $_SESSION['session_name'] = 'admin';

                        if($row['status']==1)
                        {
                            header('location:dashboard.php');
                        }
                        else
                         {
                            $msg= "Inactive Email or Password !!";
                         }  
                     
                   }
                  
                }
                else
                   {
                        $msg= "Invalid Email or Password !!";
                   }  
            }
        } 
}

?>

<?php include("template/login/head.php"); ?>


	    <!-- begin login -->
        <div class="login bg-black animated fadeInDown">
            <!-- begin brand -->
            <div class="login-header">
                <div class="brand">
                    <span class="logo"></span> <b>Typing</b> Master
                    <small>Login</small>
                </div>
                <div class="icon">
                    <i class="fa fa-lock"></i>
                </div>
            </div>
            <!-- end brand -->
            <!-- begin login-content -->
            <div class="login-content">
            <form action="" method="POST" class="margin-bottom-0">
				<div class="form-group m-b-20 <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                    <input type="text" name="email" value="<?php echo $email; ?>"  class="form-control form-control-lg inverse-mode" placeholder="Enter a Email Address" />
                    <h4><span class="help-block"><?php echo $email_err; ?></span></h4>
                </div>
                <div class="form-group m-b-20 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <input type="password" name="password" class="form-control form-control-lg inverse-mode" placeholder="Enter a Password"  />
                    <h4> <span class="help-block"><?php echo $password_err; ?></span> </h4>
                </div>
                <div class="form-group m-b-20 <?php echo (!empty($msg)) ? 'has-error' : ''; ?>">
                <h4><span class="help-block"><?php  echo $msg; ?></span> </h4>
                </div>
                
                <div class="checkbox checkbox-css m-b-20">
                        <input type="checkbox" id="remember_checkbox" /> 
                        <label for="remember_checkbox">
                            Remember Me
                        </label>
                </div>
                <div class="login-buttons">
                    <button type="submit" name="login" value="login" class="btn btn-success btn-block btn-lg">Sign me in</button>
                </div>
            </form>
            </div>
            <!-- end login-content -->
        </div>
        <!-- end login -->
        
<?php include("template/login/footer.php"); ?>        
	
