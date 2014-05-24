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
if(isset($response->time)) {
	echo "[]";
}
else {
	$response = array(
		'title' => 'Some Event',
		'year' => '2014',
		'month' => '4',
		'day' => '20',
		'hour' => '4',
		'minute' => '35'
		);
	echo json_encode($response);
}
?>