<?php
session_start();
require_once('include.php');
$headers = array(
	"Content-Type: application/json",
	"X-Parse-Application-Id: ILpd42UJgjIz3RcVo0tRNkVCykkk3L2wrPau4yqK",
	"X-Parse-REST-API-Key: nOfAPyuNWiyYZlLaUs3CiVooXWRpCuDXcIypTezl"
	);
$doctor = curl_init();
curl_setopt($doctor, CURLOPT_URL, $PARSE_URL . "classes/Doctor");
curl_setopt($doctor, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($doctor, CURLOPT_HTTPHEADER, $headers);
curl_setopt($doctor, CURLOPT_RETURNTRANSFER, true);
$doctorResponse = curl_exec($doctor);
$doctorResponse = json_decode($doctorResponse);
curl_close($doctor);
$patient = curl_init();
curl_setopt($patient, CURLOPT_URL, $PARSE_URL . "classes/Patient");
curl_setopt($patient, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($patient, CURLOPT_HTTPHEADER, $headers);
curl_setopt($patient, CURLOPT_RETURNTRANSFER, true);
$patientResponse = curl_exec($patient);
$patientResponse = json_decode($patientResponse);
curl_close($patient);
$count_doctor = sizeof($doctorResponse->results);
$count_patient = sizeof($patientResponse->results);
$is_doctor = 0;
$is_patient = 0;
for ($i=0; $i<$count_doctor; $i++) {
  if($doctorResponse->results[$i]->email == $_GET['email'] && $doctorResponse->results[$i]->password == md5($_GET['password'])) {
		$is_doctor = 1;
		$_SESSION['first_name'] = $doctorResponse->results[$i]->Fname;
		if($doctorResponse->results[$i]->category == "") {
			$_SESSION['category_present'] = 0;
		}
		else {
			$_SESSION['category_present'] = 1;
			$_SESSION['category'] = $doctorResponse->results[$i]->category;
		}
		break;
	}
}
for ($i=0; $i<$count_patient; $i++) {
	if($patientResponse->results[$i]->email == $_GET['email'] && $patientResponse->results[$i]->password == md5($_GET['password'])) {
		$is_patient = 1;
		$_SESSION['first_name'] = $patientResponse->results[$i]->Fname;
		break;
	}
}
if($is_patient == 0 && $is_doctor == 0) {
	echo "0";
	$_SESSION['is_logged'] = 0;
}
else if($is_doctor == 1 && $is_patient == 0) {
	echo "1";
	$_SESSION['is_logged'] = 1;
	$_SESSION['user_type'] = 1;
}
else if($is_doctor == 0 && $is_patient == 1) {
	echo "2";
	$_SESSION['is_logged'] = 1;
	$_SESSION['user_type'] = 2;
}
?>