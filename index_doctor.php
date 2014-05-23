<?php
session_start();
require_once('include.php');
if($_SESSION['is_logged'] == 0) {
	header("Location: " . $ROOT_URL . "index.php");
}
else if($_SESSION['is_logged'] == 0) {
	if($_SESSION['user_type'] == 2) {
		header("Location: " . $ROOT_URL . "index_patient.php");
	}
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $APP_NAME; ?></title>
<link rel="stylesheet" type="text/css" href="static/css/bootstrap.css" media="screen" />
<style>
#map-canvas {
	height: 300px;
	width: 100%;
}
</style>
</head>
<body>
<?php
require_once('header.php');
?>

<?php
if($_SESSION['category_present'] == 0) {
?>
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<h3>Please complete your profile</h3>
		<form>
			<div class="form-group">
		    <label class="control-label" for="inputDefault">Specialised In</label>
		    <input type="text" class="form-control" id="category" name="category">
			</div>
			<div class="form-group">
		    <label class="control-label" for="inputDefault">Hospital Name</label>
		    <input type="text" class="form-control" id="hospital" name="hospital">
			</div>
			<label class="control-label" for="inputDefault">Locate Yourself</label>
			<div id="map-canvas"></div><br>
			<div class="form-group">
				<button type="button" class="btn btn-primary" onClick="complete();">Complete</button>
			</div>
		</form>
	</div>
	<div class="col-md-3"></div>
</div>
<?php
}
else {
?>
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6">
<p>Completed your profile</p>
</div>
<div class="col-md-3"></div>
</div>
<?php
}
?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script>
function initialize() {
  var myLatlng = new google.maps.LatLng(-25.363882,131.044922);
  var mapOptions = {
    zoom: 4,
    center: myLatlng
  }
  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  google.maps.event.addListener(map, 'click', function(event) {
  latLng = event.latLng;
  placeMarker(event.latLng);
});

function placeMarker(location) {
    var marker = new google.maps.Marker({
        position: location, 
        map: map
    });
}
}

google.maps.event.addDomListener(window, 'load', initialize);
function complete() {
	var category = document.getElementById('category').value;
	var hospital = document.getElementById('hospital').value;
	latLng = latLng.toString();
	var pos = latLng.indexOf(',');
	latitude = latLng.substring(1, pos);
	longitude = latLng.substring(pos+2, latLng.length-1);
	var xhr = new XMLHttpRequest();
	xhr.open("GET", "<?php echo $ROOT_URL; ?>" + "api_doctor_complete_profile.php?category=" + category + "&hospital=" + hospital + "&latitude=" + latitude + "&longitude=" + longitude, true);
	xhr.onreadystatechange = function() {
	  if (xhr.readyState == 4) {
	    // JSON.parse does not evaluate the attacker's scripts.
	    window.location.href = "<?php echo $ROOT_URL; ?>" + "index_doctor.php";
	  }
	}
	xhr.send();
}
</script>
</body>
</html>