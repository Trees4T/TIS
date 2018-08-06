<?php
error_reporting(0);
session_start();
require_once '../../action/function/class.backdoor.php';
$backdoor = new backdoor();


 if ($_GET['delete']=='true') {
 $backdoor->truncate_pm();
 }

 if ($_GET['type']=='MF' && $_GET['pos']==TRUE) {

   $exp_pos = explode(",", $_GET['pos']);
   echo $start = $exp_pos[0]; echo "<br>";
   echo $end   = $exp_pos[1];

   for ($i=$start; $i <= $end ; $i++) {
   $pm_man = $backdoor->pm_manufacture($i);
   foreach ($pm_man as $pm_mans) {
     echo $id_mapdata   = $pm_mans->id_mapdata;
     echo $id_part      = $pm_mans->id_part;
     echo $id_shipment  = $pm_mans->id_shipment;
     echo $name         = $pm_mans->name;
     echo $geo          = $pm_mans->geo;
     echo $total_trees  = $pm_mans->total_trees;
     echo $species      = $pm_mans->species;
     echo $area         = $pm_mans->area;
     echo $village      = $pm_mans->village;
     echo $district     = $pm_mans->district;
     echo $municipality = $pm_mans->municipality;
     echo $farmer       = $pm_mans->farmer;
     echo $planting_year= $pm_mans->planting_year;
     echo "</br>";

     $backdoor->planting_maps_insert($id_mapdata,$id_part,$id_shipment,$name,$geo,$total_trees,$species,$area,$village,$district,$municipality,$farmer,$planting_year);

    }
  }
 }



if($_GET['type']=='RT' && $_GET['pos']==TRUE){
$exp_pos = explode(",", $_GET['pos']);
echo $start = $exp_pos[0]; echo "<br>";
echo $end   = $exp_pos[1];
 echo "</br>";
  $pm_ret = $backdoor->pm_retailer($_GET['pos']);

  foreach ($pm_ret as $pm_rets) {
     echo $id_mapdata   = $pm_rets->id_mapdata;
     echo $id_part      = $pm_rets->id_part;
     echo $id_shipment  = $pm_rets->id_shipment;
     echo $name         = $pm_rets->name;
     echo $geo          = $pm_rets->geo;
     echo $total_trees  = $pm_rets->total_trees;
     echo $species      = $pm_rets->species;
     echo $area         = $pm_rets->area;
     echo $village      = $pm_rets->village;
     echo $district     = $pm_rets->district;
     echo $municipality = $pm_rets->municipality;
     echo $farmer       = $pm_rets->farmer;
     echo $planting_year= $pm_rets->planting_year;
     echo "</br>";

    //$backdoor->planting_maps_insert($id_mapdata,$id_part,$id_shipment,$name,$geo,$total_trees,$species,$area,$village,$district,$municipality,$farmer,$planting_year);

  }

}

?>
