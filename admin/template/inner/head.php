<?php
$urisegments = explode("/",parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
  $countofsegment = count($urisegments );

switch($urisegments[$countofsegment-1])
{
	case 'dashboard.php':
		$title = "Dashboard"; 
		break;
	case 'addadmin.php':
		$title = "Add Admin"; 
		break;
	case 'addteachers.php':
		$title = "Add Teachers";
		break;
	case 'addtest.php':
		$title = "Add Test Type";
		break;
	case 'list-admin.php':
		$title = "List Admin";
		break;
	case 'list-teacher.php':
		$title = "List Teacher";
		break;
	case 'list-user.php':
		$title = "List User";
		break;
	case 'list-test.php':
		$title = "List Test Type";
		break;
	case 'edit-admin.php':
		$title = "Edit Admin";
		break;	
	case 'edit-teacher.php':
		$title = "Edit Teacher";
		break;
	case 'edit-test.php':
		$title = "Edit Test";
		break;
}

?>


<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8"  />
	<title>Typing Master | <?php echo $title; ?></title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	

	<link href="assets/img/logo/logo-admin1.jpg" rel="icon" type="image/jpg" />
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css" rel="stylesheet" />
	<link href="assets/plugins/animate/animate.min.css" rel="stylesheet" />
	<link href="assets/css/default/style.min.css" rel="stylesheet" />
	<link href="assets/css/default/style-responsive.min.css" rel="stylesheet" />
	<link href="assets/css/default/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="assets/plugins/jquery-jvectormap/jquery-jvectormap.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
  <!-- <link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />-->
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="assets/plugins/parsley/src/parsley.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	
                                        
	
	</head>
<body>