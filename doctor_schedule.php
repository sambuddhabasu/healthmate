<?php
session_start();
require_once('include.php');
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
<?php
require_once('header.php');
?>

<div id='calendar'></div>

<script src='static/lib/jquery.min.js'></script>
<script src='static/lib/jquery-ui.custom.min.js'></script>
<script src='static/fullcalendar/fullcalendar.min.js'></script>
<script>

var xhr = new XMLHttpRequest();
	xhr.open("GET", "<?php echo $ROOT_URL; ?>" + "api_get_doctor_schedule.php?id=" + "<?php echo $_SESSION['object_id']; ?>", true);
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4) {
			var response = xhr.responseText;
			response = JSON.parse(response);
			console.log(response);

			for(i=0;i<response.length;i++) {
				var date = response[i].date;
				date = date.split('-');
				response[i].start = new Date(date[0], date[1], date[2]);
				response[i].title = response[i].reason;
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
			selectable: false,
			selectHelper: true,
			editable: false,
			events: response
		});


			}
		}
		xhr.send();


</script>

</body>
</html>