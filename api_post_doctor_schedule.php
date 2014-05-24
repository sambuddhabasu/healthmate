<?php
session_start();
require_once('include.php');
$headers = array(
	"Content-Type: application/json",
	"X-Parse-Application-Id: ILpd42UJgjIz3RcVo0tRNkVCykkk3L2wrPau4yqK",
	"X-Parse-REST-API-Key: nOfAPyuNWiyYZlLaUs3CiVooXWRpCuDXcIypTezl"
	);
$postField = '{"date": "' . $_GET['date'] . '", "docId": "' . $_GET['id'] . '", "patientId": "' . $_SESSION['object_id'] . '", "time": "00:00", "reason": "' . $_GET['reason'] . '"}';
$rest = curl_init();
curl_setopt($rest, CURLOPT_URL, $PARSE_URL . "classes/Appointments/");
curl_setopt($rest, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($rest, CURLOPT_HTTPHEADER, $headers);
curl_setopt($rest, CURLOPT_POSTFIELDS, $postField);
curl_setopt($rest, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($rest);
$response = json_decode($response);
curl_close($rest);
?>