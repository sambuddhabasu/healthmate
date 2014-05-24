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

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
<form id="fileupload" name="fileupload" enctype="multipart/form-data" method="post">
    <input type="file" name="fileselect" id="fileselect"></input>
    <input id="uploadbutton" type="button" value="Upload to Parse"/>
</form>
</div>
<div class="col-md-3"></div>
</div>


<script type="text/javascript">
  $(function() {
    var file;

    // Set an event listener on the Choose File field.
    $('#fileselect').bind("change", function(e) {
      var files = e.target.files || e.dataTransfer.files;
      // Our file var now holds the selected file
      file = files[0];
    });

    // This function is called when the user clicks on Upload to Parse. It will create the REST API request to upload this image to Parse.
    $('#uploadbutton').click(function() {
      var serverUrl = 'https://api.parse.com/1/files/' + file.name;

      $.ajax({
        type: "POST",
        beforeSend: function(request) {
          request.setRequestHeader("X-Parse-Application-Id", 'ILpd42UJgjIz3RcVo0tRNkVCykkk3L2wrPau4yqK');
          request.setRequestHeader("X-Parse-REST-API-Key", 'nOfAPyuNWiyYZlLaUs3CiVooXWRpCuDXcIypTezl');
          request.setRequestHeader("Content-Type", file.type);
        },
        url: serverUrl,
        data: file,
        processData: false,
        contentType: false,
        success: function(data) {
        	var xhr = new XMLHttpRequest();
				xhr.open("GET", "<?php echo $ROOT_URL; ?>" + "api_doctor_picture.php?link=" +  data.url, true);
				xhr.onreadystatechange = function() {
					if (xhr.readyState == 4) {
						console.log(xhr.responseText);
					}
				}
				xhr.send();
         // alert("File available at: " + data.url);
        },
        error: function(data) {
          var obj = jQuery.parseJSON(data);
          alert(obj.error);
        }
      });
    });


  });
</script>

</body>
</html>