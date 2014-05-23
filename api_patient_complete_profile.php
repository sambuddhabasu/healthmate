<?php
session_start();
require_once('include.php');
$headers = array(
	"Content-Type: application/json",
	"X-Parse-Application-Id: ILpd42UJgjIz3RcVo0tRNkVCykkk3L2wrPau4yqK",
	"X-Parse-REST-API-Key: nOfAPyuNWiyYZlLaUs3CiVooXWRpCuDXcIypTezl"
	);
$rest = curl_init();
$postField = '{"allergy": "' . $_GET['allergy'] . '", "latitude": "' . $_GET['latitude'] . '", "longitude": "' . $_GET['longitude'] . '"}';
echo $url;
curl_setopt($rest, CURLOPT_URL, $PARSE_URL . "classes/Patient/" . $_SESSION['object_id']);
curl_setopt($rest, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($rest, CURLOPT_POSTFIELDS, $postField);
curl_setopt($rest, CURLOPT_HTTPHEADER, $headers);
curl_setopt($rest, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($rest);
$response = json_decode($response);
curl_close($rest);
print_r($response);
$_SESSION['allergy_present'] = 1;
?>