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
<div class="col-md-6"><h1>LogIn</h1></div>
<div class="col-md-3"></div>
</div>
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6">

<form>
<div class="form-group">
  <label class="control-label" for="inputDefault">Email</label>
  <input type="text" class="form-control" id="email" name="email">
</div>
<div class="form-group">
  <label class="control-label" for="inputDefault">Password</label>
  <input type="password" class="form-control" id="password" name="password">
</div>
<div class="form-group">
<button type="button" class="btn btn-primary" onClick="login();">LogIn</button>
</div>
</form>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="static/js/bootstrap.min.js"></script>
    <script>
    function login() {
	    var xhr = new XMLHttpRequest();
	    var email = document.getElementById('email').value;
	    var password = document.getElementById('password').value;
		xhr.open("GET", "<?php echo $ROOT_URL; ?>" + "api_login.php?email=" + email + "&password=" + password, true);
		xhr.onreadystatechange = function() {
		  if (xhr.readyState == 4) {
		    // JSON.parse does not evaluate the attacker's scripts.
//		    console.log(xhr.responseText);
		    if(xhr.responseText == 0) {
		    	console.log("Invalid credentials");
		    }
		    else if(xhr.responseText == 1) {
		    	console.log("doctor");
		    	window.location.href = "<?php echo $ROOT_URL; ?>" + "index_doctor.php";
		    }
		    else if(xhr.responseText == 2) {
		    	console.log("patient");
		    	window.location.href = "<?php echo $ROOT_URL; ?>" + "index_patient.php";
		    }
		  }
		}
		xhr.send();
	}
    </script>

</body>
</html>