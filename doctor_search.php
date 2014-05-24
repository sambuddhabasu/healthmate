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
	<div class="col-md-2">
		<h4>Doctors near</h4>
	</div>
	<div class="col-md-4">
		<input type="text" class="form-control" id="near" name="near">
	</div>
	<div class="col-md-3"></div>
</div>
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-2">
		<h4>specialised in</h4>
	</div>
	<div class="col-md-4">
		<input type="text" class="form-control" id="category" name="category">
	</div>
	<div class="col-md-3"></div>
</div>
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-3">
		<button type="button" class="btn btn-primary" onClick="search();">Search</button>
	</div>
	<div class="col-md-3">
		<img id="loading" />
	</div>
</div>

<br>

<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6" id="main_message">
	</div>
	<div class="col-md-3"></div>
</div>

<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6" id="main_contents">
	</div>
	<div class="col-md-3"></div>
</div>


<script>
function search() {
	document.getElementById('loading').src = "<?php echo $ROOT_URL; ?>" + "static/images/loading.gif";
	document.getElementById('loading').width = "50";
	var near = document.getElementById('near').value;
	var category = document.getElementById('category').value;
	var xhr = new XMLHttpRequest();
	xhr.open("GET", "<?php echo $ROOT_URL; ?>" + "api_doctor_search.php?near=" + near + "&category=" + category, true);
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4) {
			document.getElementById('loading').src = "";
			results = JSON.parse(xhr.responseText);
			response = "<div id='row'>";
			for(i=0;i<results.length;i++) {
				response += '<h2><a href="<?php echo $ROOT_URL; ?>doctor_profile.php?id=' + results[i].objectId + '">' + results[i].Fname + ' ' + results[i].Lname + '</a></h2><h4>Specialised in: ' + results[i].category + '</h4><h4>Works for: ' + results[i].hospital + '</h4></div><hr><div id="row">';
				console.log(results[i]);
			}
			response += "</div>";
			document.getElementById('main_contents').innerHTML = response;
			document.getElementById('main_message').innerHTML = "<h1>Showing you all the results</h1>";
		}
	}
	xhr.send();
}
</script>
</body>
</html>