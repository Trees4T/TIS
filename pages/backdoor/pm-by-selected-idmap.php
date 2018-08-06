<?php
include '../../koneksi/koneksi.php';
require_once '../../action/function/class.backdoor.php';
$backdoor = new backdoor();

if ($_GET['type']=="MF") {
  $data = $conn->query("SELECT NO FROM t4t_t4t.t4t_htc WHERE no_shipment='MF233882015' OR no_shipment='MF233972015' OR
                        no_shipment='MF233982015'
                        OR no_shipment='MF233992015' OR no_shipment='MF234002015'
                        OR no_shipment='MF234012015' OR no_shipment='MF234022015'
                        OR no_shipment='MF233892015' OR no_shipment='MF233902015'
                        OR no_shipment='MF233912015' OR no_shipment='MF233922015'
                        OR no_shipment='MF233932015' OR no_shipment='MF233942015'
                        OR no_shipment='MF233952015' OR no_shipment='MF233962015'");

  foreach ($data as $datas) {
    $pm_man = $backdoor->pm_manufacture($datas[0]);
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
?>
