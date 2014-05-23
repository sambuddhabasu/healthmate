<?php
require_once('include.php');
//print_r($_GET);
$headers = array(
	"Content-Type: application/json",
	"X-Parse-Application-Id: ILpd42UJgjIz3RcVo0tRNkVCykkk3L2wrPau4yqK",
	"X-Parse-REST-API-Key: nOfAPyuNWiyYZlLaUs3CiVooXWRpCuDXcIypTezl"
	);
$postField = '{"Fname": "' . $_GET['first_name'] . '", "Lname": "' . $_GET['last_name'] . '", "email": "' . $_GET['email'] . '", "username": "' . $_GET['email'] . '", "password": "' . md5($_GET['password']) . '", "gender": "' . $_GET['gender'] . '", "userType": "' . $_GET['user_type'] . '"}';
$rest = curl_init();
curl_setopt($rest, CURLOPT_URL, $PARSE_URL . "users");
curl_setopt($rest, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($rest, CURLOPT_POSTFIELDS, $postField);
curl_setopt($rest, CURLOPT_HTTPHEADER, $headers);
curl_setopt($rest, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($rest);
$response = json_decode($response);
curl_close($rest);
if(isset($response->error)) {
	echo "0";
}
else {
	if($_GET['user_type'] == "Doctor") {
		$url = $PARSE_URL . "classes/Doctor";
		$newRest = curl_init();
		curl_setopt($newRest, CURLOPT_URL, $url);
		curl_setopt($newRest, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($newRest, CURLOPT_POSTFIELDS, $postField);
		curl_setopt($newRest, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($newRest, CURLOPT_RETURNTRANSFER, true);
		$newResponse = curl_exec($newRest);
//		print_r($newResponse);
		echo "1";
	}
	else if($_GET['user_type'] == "Patient") {
		$url = $PARSE_URL . "classes/Patient";
		$newRest = curl_init();
		curl_setopt($newRest, CURLOPT_URL, $url);
		curl_setopt($newRest, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($newRest, CURLOPT_POSTFIELDS, $postField);
		curl_setopt($newRest, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($newRest, CURLOPT_RETURNTRANSFER, true);
		$newResponse = curl_exec($newRest);
//		print_r($newResponse);
		echo "1";
	}
//	print_r($response);
//	header("Location: " . $ROOT_URL . "account_created.php");
}
?>