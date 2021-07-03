<?php  
$uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
	$countOfSegment = count($uriSegments);
	//cho $uriSegments[3];

	//echo $uriSegments[$countOfSegment - 1];

switch($uriSegments[$countOfSegment - 1])
{
		case 'login.php':
			$title = "Login";
			break;

		case 'register.php':
			$title = "Register";
			break;

		case 'dashboard.php':
			$title = "Dashboard";
			break;

		case 'edit-profile.php':
			$title = "Edit Profile";
			break;

		case 'change-password.php':
			$title = "Change Password";
			break;
		case 'forgot-password.php':
			$title = "Forgot Password";
			break;

		case 'enroll-test.php':
			$title = "Enroll Test";
			break;
		default:
			$title="Home Page";
			break;

		
}

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Typing Master  | <?php echo  $title; ?></title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	 <link href="assets/img/logo/logo-admin1.png" rel="icon" type="image/png" />

	 <!-- Typing Test Css-->
	<link href="assets/css/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/css/bootstrap-reset.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/css/style.css" rel="stylesheet">
    <link href="assets/css/css/style-responsive.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/flip/flipclock.css">
    <script src="assets/js/js/jquery.js"></script>
	<!-- Typing Test Css -->
	

	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="assets/plugins/bootstrap3/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/plugins/animate/animate.min.css" rel="stylesheet" />
	<link href="assets/css/e-commerce/style.min.css" rel="stylesheet" />
	<link href="assets/css/e-commerce/style-responsive.min.css" rel="stylesheet" />
	<link href="assets/css/e-commerce/theme/default.css" id="theme" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->

	
	<!-- ================== BEGIN PAGE LEVEL STYLE for Login Register ================== -->
	<link href="assets/plugins/parsley/src/parsley.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE for Login Register================== -->
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
  
	<style>
		
.style{
            
            border: 1px solid;
            padding-bottom:4%;
            
        }

.style1{
            height: 30px;
        }



.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: #242a30;
  
   text-align: center;
}

.frontend
{
margin-top:165px;
}


.login-header
{
	padding: 10px;
	color:white;
	background: #00acac;
	
}
.btn.btn-inverse {
    color: #fff;
    background: #00acac;
    border-color: #00acac;
}



</style>
</head>
<body class="bg-silver" >