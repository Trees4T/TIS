<?php
$ip = '151.225.219.162';
// $LocationArray = json_decode( file_get_contents('http://ip2location-api.com/api/json/'.$ip.''), true);
//
// 	echo $LocationArray['city'];
// 	echo " ";
// 	echo $LocationArray['country'];

include '../koneksi/koneksi.php';
include_once('../action/function/class.office.php');

$office = new office();

// $get_long = $office->Dot2LongIP($ip);

for ($i=0; $i < 100; $i++) {
	$get = $office->get_iplocation($ip);
	echo $get->city_name;
	echo $get->country_name;
}



echo $office->is_connected();
	 ?>
