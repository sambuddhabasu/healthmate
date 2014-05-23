<?php
require_once('include.php');
$headers = array(
	"Content-Type: application/json",
	"X-Parse-Application-Id: ILpd42UJgjIz3RcVo0tRNkVCykkk3L2wrPau4yqK",
	"X-Parse-REST-API-Key: nOfAPyuNWiyYZlLaUs3CiVooXWRpCuDXcIypTezl"
	);
$postField = '{"first_name": "' . $_POST['first_name'] . '", "last_name": "' . $_POST['last_name'] . '", "email": "' . $_POST['email'] . '", "username": "' . $_POST['email'] . '", "password": "' . $_POST['password'] . '", "gender": "' . $_POST['gender'] . '", "user_type": "' . $_POST['user_type'] . '"}';
$rest = curl_init();
curl_setopt($rest, CURLOPT_URL, $PARSE_URL . "login?username=sammygamer@live.com&password=iiit123");
curl_setopt($rest, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($rest, CURLOPT_HTTPHEADER, $headers);
curl_setopt($rest, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($rest);
$response = json_decode($response);
print_r($response);
curl_close($rest);
?>