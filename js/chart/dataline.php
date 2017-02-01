<?php
$con=mysqli_connect("localhost","root","","proj_reglinier");

if (!$con) {
  die('Could not connect: ' . mysql_error());
}


// Data for Sugar
$query = mysqli_query($con,"SELECT bima FROM hasil order by triwulan ");
$rows = array();
$rows['name'] = 'Shipment';
while($tmp= mysqli_fetch_array($query)) {
    $rows['data'][] = $tmp['bima'];
}

// Data for Rice
$query = mysqli_query($con,"SELECT gresik FROM hasil order by triwulan ");
$rows1 = array();
$rows1['name'] = 'Fee';
while($tmp = mysqli_fetch_array($query)) {
    $rows1['data'][] = $tmp['gresik'];
}

// Data for Wheat Flour
$query = mysqli_query($con,"SELECT putih FROM hasil order by triwulan ");
$rows2 = array();
$rows2['name'] = 'Item Qty';
while($tmp = mysqli_fetch_array($query)) {
    $rows2['data'][] = $tmp['putih'];
}


$result = array();
array_push($result,$rows);
array_push($result,$rows1);
array_push($result,$rows2);

print json_encode($result, JSON_NUMERIC_CHECK);

mysqli_close($con);
?> 
