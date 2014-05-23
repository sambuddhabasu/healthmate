<?php
session_start();
require_once('include.php');
$headers = array(
	"Content-Type: application/json",
	"X-Parse-Application-Id: ILpd42UJgjIz3RcVo0tRNkVCykkk3L2wrPau4yqK",
	"X-Parse-REST-API-Key: nOfAPyuNWiyYZlLaUs3CiVooXWRpCuDXcIypTezl"
	);
$rest = curl_init();
curl_setopt($rest, CURLOPT_URL, $PARSE_URL . "classes/Doctor");
curl_setopt($rest, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($rest, CURLOPT_HTTPHEADER, $headers);
curl_setopt($rest, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($rest);
$response = json_decode($response);
curl_close($rest);

$patient = curl_init();
curl_setopt($patient, CURLOPT_URL, $PARSE_URL . "classes/Patient/" . $_SESSION['object_id']);
curl_setopt($patient, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($patient, CURLOPT_HTTPHEADER, $headers);
curl_setopt($patient, CURLOPT_RETURNTRANSFER, true);
$patientResponse = curl_exec($patient);
$patientResponse = json_decode($patientResponse);
curl_close($patient);
$myLat = (float)$patientResponse->latitude;
$myLng = (float)$patientResponse->longitude;
//echo $myLat . " " . $myLng;
$results = $response->results;

function bubble_sort($arr) {
    $size = count($arr);
    for ($i=0; $i<$size; $i++) {
        for ($j=0; $j<$size-1-$i; $j++) {
        	$checkLat1 = (float)$results[$j]->latitude;
        	$checkLng1 = (float)$results[$j]->longitude;
        	$checkLat2 = (float)$results[$j+1]->latitude;
        	$checkLng2 = (float)$results[$j+1]->longitude;
        	$dist1 = pow($checkLat1 - $myLat, 2) + pow($checkLng1 - $myLng, 2);
        	$dist2 = pow($checkLat2 - $myLat, 2) + pow($checkLng2 - $myLng, 2);
            if($dist2 < $dist1) {
                swap($arr, $j, $j+1);
            }
        }
    }
    return $arr;
}

function swap(&$arr, $a, $b) {
    $tmp = $arr[$a];
    $arr[$a] = $arr[$b];
    $arr[$b] = $tmp;
}

$results = bubble_sort($results);
$results = json_encode($results);
echo $results;

?>