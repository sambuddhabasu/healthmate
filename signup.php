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
<div class="col-md-6"><h1>SignUp</h1></div>
<div class="col-md-3"></div>
</div>
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6">

<form>
<div class="form-group">
  <label class="control-label" for="inputDefault">First Name</label>
  <input type="text" class="form-control" id="first_name" name="first_name">
</div>
<div class="form-group">
  <label class="control-label" for="inputDefault">Last Name</label>
  <input type="text" class="form-control" id="last_name" name="last_name">
</div>
<div class="form-group">
  <label class="control-label" for="inputDefault">Email</label>
  <input type="text" class="form-control" id="email" name="email">
</div>
<div class="form-group">
  <label class="control-label" for="inputDefault">Password</label>
  <input type="password" class="form-control" id="password" name="password">
</div>
<div class="form-group">
  <label class="control-label" for="inputDefault">Confirm Password</label>
  <input type="password" class="form-control" id="confirm_password" name="confirm_password">
</div>
<div class="form-group">
	<label class="control-label" for="inputDefault">Gender</label><br />
	<div class="btn-group">
	  <select class="btn btn-primary dropdown-toggle" id="gender" name="gender">
	  	<option value="Male">Male</option>
 		<option value="Female">Female</option>
	  </select>
	</div>
</div>
<div class="form-group">
	<label class="control-label" for="inputDefault">User Type</label><br />
	<div class="btn-group">
	  <select class="btn btn-primary dropdown-toggle" id="user_type" name="user_type">
	  	<option value="Doctor">Doctor</option>
 		<option value="Patient">Patient</option>
	  </select>
	</div>
</div>
<div class="form-group">
<button type="button" class="btn btn-primary" onClick="signup();">SignUp</button>
</div>
</form>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="static/js/bootstrap.min.js"></script>
    <script>
    function signup() {
	    var xhr = new XMLHttpRequest();
	    var first_name = document.getElementById('first_name').value;
	    var last_name = document.getElementById('last_name').value;
	    var email = document.getElementById('email').value;
	    var password = document.getElementById('password').value;
	    var gender = document.getElementById('gender').value;
	    var user_type = document.getElementById('user_type').value;
		xhr.open("GET", "<?php echo $ROOT_URL; ?>" + "api_signup.php?first_name=" + first_name + "&last_name=" + last_name + "&email=" + email + "&password=" + password + "&gender=" + gender + "&user_type=" + user_type, true);
		xhr.onreadystatechange = function() {
		  if (xhr.readyState == 4) {
		    // JSON.parse does not evaluate the attacker's scripts.
		    console.log(xhr.responseText);
		  }
		}
		xhr.send();
	}
    </script>

</body>
</html>