<?php
session_start();
require_once('include.php');
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

<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6">

<div class="form-group">
  <input type="text" class="form-control" id="search" name="search">
</div>

</div>
<div class="col-md-3">

<button type="button" class="btn btn-primary" onClick="search();">Search</button>

</div>
</div>

<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6">
	<h1>Showing all the doctors</h1>
</div>
<div class="col-md-3"></div>
</div>

<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6">
<?php
$headers = array(
	"Content-Type: application/json",
	"X-Parse-Application-Id: ILpd42UJgjIz3RcVo0tRNkVCykkk3L2wrPau4yqK",
	"X-Parse-REST-API-Key: nOfAPyuNWiyYZlLaUs3CiVooXWRpCuDXcIypTezl"
	);
$rest = curl_init();
curl_setopt($rest, CURLOPT_URL, $PARSE_URL . "classes/Doctor");
curl_setopt($rest, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($rest, CURLOPT_HTTPHEADER, $headers);
curl_setopt($rest, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($rest);
$response = json_decode($response);
curl_close($rest);
$results = $response->results;
for ($x=0; $x<sizeof($results); $x++) {
	if(isset($results[$x]->hospital)) {
?>

<a href="<?php echo $ROOT_URL . 'doctor_profile.php?id=' . $results[$x]->objectId; ?>"><h3><?php echo $results[$x]->Fname . " " . $results[$x]->Lname; ?></h3></a>
<h5>Speciality: <?php echo $results[$x]->category; ?></h5>
<h5>Hospital: <?php echo $results[$x]->hospital; ?></h5>
<hr>

<?php
	}
}
?>

</div>
<div class="col-md-3"></div>
</div>
<script>
function search() {
	var search_string = document.getElementById('search').value;
	window.location.href = "<?php echo $ROOT_URL; ?>" + "doctor_search.php";
}
</script>
</body>
</html>