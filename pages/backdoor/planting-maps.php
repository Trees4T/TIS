<?php
error_reporting(0);
session_start();
require_once '../../action/function/class.office.php';
$office = new office();

$notif = $notif;

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php if ($_GET['lvl']=='administrator'): ?>

      <?php
      if (isset($_POST['backdoor-pmman'])) {
       $office->truncate_pm();


  			$pm_man = $office->pm_manufacture();

  			foreach ($pm_man as $pm_mans) {
  				 $id_mapdata   = $pm_mans->id_mapdata;
  				 $id_part      = $pm_mans->id_part;
  				 $id_shipment  = $pm_mans->id_shipment;
  				 $name         = $pm_mans->name;
  				 $geo          = $pm_mans->geo;
  				 $latitude_dms = $pm_mans->latitude_dms;
  				 $longitude_dms= $pm_mans->longitude_dms;
  				 $latitude     = $pm_mans->latitude;
  				 $longitude    = $pm_mans->longitude;
  				 $total_trees  = $pm_mans->total_trees;
  				 $species      = $pm_mans->species;
  				 $area         = $pm_mans->area;
  				 $village      = $pm_mans->village;
  				 $district     = $pm_mans->district;
  				 $municipality = $pm_mans->municipality;
  				 $farmer       = $pm_mans->farmer;
  				 $planting_year= $pm_mans->planting_year;
  				 "</br>";

  				$office->backdoor_planting_maps_insert($id_mapdata,$id_part,$id_shipment,$name,$geo,$latitude_dms,$longitude_dms,$latitude,$longitude,$total_trees,$species,$area,$village,$district,$municipality,$farmer,$planting_year);
          $notif='Ok';
        }



      }elseif(isset($_POST['backdoor-pmret'])){
        $pm_ret = $office->pm_retailer();

  			foreach ($pm_ret as $pm_rets) {
  				 $id_mapdata   = $pm_rets->id_mapdata;
  				 $id_part      = $pm_rets->id_part;
  				 $id_shipment  = $pm_rets->id_shipment;
  				 $name         = $pm_rets->name;
  				 $geo          = $pm_rets->geo;
  				 $latitude_dms = $pm_rets->latitude_dms;
  				 $longitude_dms= $pm_rets->longitude_dms;
  				 $latitude     = $pm_rets->latitude;
  				 $longitude    = $pm_rets->longitude;
  				 $total_trees  = $pm_rets->total_trees;
  				 $species      = $pm_rets->species;
  				 $area         = $pm_rets->area;
  				 $village      = $pm_rets->village;
  				 $district     = $pm_rets->district;
  				 $municipality = $pm_rets->municipality;
  				 $farmer       = $pm_rets->farmer;
  				 $planting_year= $pm_rets->planting_year;
  				 "</br>";

  				$office->backdoor_planting_maps_insert($id_mapdata,$id_part,$id_shipment,$name,$geo,$latitude_dms,$longitude_dms,$latitude,$longitude,$total_trees,$species,$area,$village,$district,$municipality,$farmer,$planting_year);
          $notif2='Ok';
  			}
      }



      ?>

      <form class="" action="" method="post">
        <button type="submit" class="btn btn-warning" style="width:250px" name="backdoor-pmman">Update Planting Maps Manufaturer</button> <?php echo $notif ?>
        <br><br>
        <button type="submit" name="backdoor-pmret" style="width:250px" >Update Planting Maps Retailer</button> <?php echo $notif2 ?>
      </form>
    <?php endif; ?>

    <?php
    $notif='';
    $notif2='';
     ?>
  </body>
</html>
