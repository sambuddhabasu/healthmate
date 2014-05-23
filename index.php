<?php
session_start();
require_once('include.php');
if($_SESSION['is_logged'] == 1) {
	if($_SESSION['user_type'] == 1) {
		header("Location: " . $ROOT_URL . "index_doctor.php");
	}
	else if($_SESSION['user_type'] == 2) {
		header("Location: " . $ROOT_URL . "index_patient.php");
	}
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $APP_NAME; ?></title>
<link rel="stylesheet" type="text/css" href="static/css/bootstrap.css" media="screen" />
</head>
<body>
<?php
require_once('header.php');
?>
</body>
</html>