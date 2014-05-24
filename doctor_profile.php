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
<link href='static/fullcalendar/fullcalendar.css' rel='stylesheet' />
<link href='static/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<style>

	#calendar {
		width: 900px;
		margin: 0 auto;
		}

</style>
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
			<h4>Works for: <?php echo $response->hospital; ?> hospital</h4>
		</div>
		<div class="col-md-3"></div>
	</div>
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<h2>Book Appointments</h2>
		</div>
		<div class="col-md-4"></div>
	</div><br>
	<div id="calendar"></div>

<script src='static/lib/jquery.min.js'></script>
<script src='static/lib/jquery-ui.custom.min.js'></script>
<script src='static/fullcalendar/fullcalendar.min.js'></script>
<script>

var xhr = new XMLHttpRequest();
	xhr.open("GET", "<?php echo $ROOT_URL; ?>" + "api_get_doctor_schedule.php?id=" + "<?php echo $_GET['id']; ?>", true);
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4) {

			var response = xhr.responseText;
			response = JSON.parse(response);
			console.log(response);

			for(i=0;i<response.length;i++) {
				var date = response[i].date;
				date = date.split('-');
				response[i].start = new Date(date[0], date[1], date[2]);
				response[i].title = "Busy";
			}

			var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		var calendar = $('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			selectable: true,
			selectHelper: true,
			select: function(start, end, allDay) {
				var reason = prompt('Enter Reason:');
					calendar.fullCalendar('renderEvent',
						{
							title: reason,
							start: start,
							allDay: allDay
						},
						true // make the event "stick"
					);
				calendar.fullCalendar('unselect');
				var year = start.getFullYear();
				var month = start.getMonth();
				var day = start.getDate();
				var start = year.toString() + "-" +  month.toString() + "-" + day.toString();
				console.log(start);
				var check = new XMLHttpRequest();
				check.open("GET", "<?php echo $ROOT_URL; ?>" + "api_post_doctor_schedule.php?id=" + "<?php echo $_GET['id']; ?>&date=" + start + "&reason=" + reason, true);
				check.onreadystatechange = function() {
					if (check.readyState == 4) {
						window.location.href = "<?php echo $ROOT_URL; ?>" + "index_patient.php";
					}
				}
				check.send();
			},
			editable: false,
			events: response
		});

			}
		}
		xhr.send();


</script>

</body>
</html>