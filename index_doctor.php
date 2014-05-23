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
<script>
function complete() {
	var category = document.getElementById('category').value;
	var hospital = document.getElementById('hospital').value;
	var xhr = new XMLHttpRequest();
	xhr.open("GET", "<?php echo $ROOT_URL; ?>" + "api_doctor_complete_profile.php?category=" + category + "&hospital=" + hospital, true);
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