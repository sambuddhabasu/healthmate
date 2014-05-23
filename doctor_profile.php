<?php
session_start();
require_once('include.php');
$headers = array(
	"Content-Type: application/json",
	"X-Parse-Application-Id: ILpd42UJgjIz3RcVo0tRNkVCykkk3L2wrPau4yqK",
	"X-Parse-REST-API-Key: nOfAPyuNWiyYZlLaUs3CiVooXWRpCuDXcIypTezl"
	);
$rest = curl_init();
curl_setopt($rest, CURLOPT_URL, $PARSE_URL . "classes/Doctor/" . $_GET['id']);
curl_setopt($rest, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($rest, CURLOPT_HTTPHEADER, $headers);
curl_setopt($rest, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($rest);
$response = json_decode($response);
curl_close($rest);
require_once('header.php');
//print_r($response);
?>
<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $APP_NAME; ?></title>
<link rel="stylesheet" type="text/css" href="static/css/bootstrap.css" media="screen" />
</head>
<body>
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<h2><?php echo $response->Fname . " " . $response->Lname; ?></h2>
		</div>
		<div class="col-md-3"></div>
	</div>
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<h4>Specialised In: <?php echo $response->category; ?></h4>
		</div>
		<div class="col-md-3"></div>
	</div>
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<h4>Works for <?php echo $response->hospital; ?> hospital</h4>
		</div>
		<div class="col-md-3"></div>
	</div>
</body>
</html>