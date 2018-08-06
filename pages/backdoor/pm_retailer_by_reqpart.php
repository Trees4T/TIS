<?php
error_reporting(0);
session_start();
require_once '../../action/function/class.backdoor.php';
$backdoor = new backdoor();

$buyer = $_GET['buyer'];
$data = $backdoor->pm_retailer_bypart($buyer);
foreach ($data as $datas) {


  echo $id_mapdata  = $datas->no;
  echo "-";
  echo $id_part = $_GET['id'];
  echo "-";
  echo $id_shipment = $datas->no_shipment;
  echo "-";
  echo $name  = $_GET['name'];
  echo "-";
  echo $geo = $datas->geo;
  echo "-";
  echo $total_trees = $datas->jml_phn;
  echo "-";

  $get_koordinat = $backdoor->get_koordinat($geo);
    $get_spec = $backdoor->get_species($get_koordinat->id_pohon2);
  echo $species = $get_spec->nama_latin;
  echo "-";
  echo $area  = $datas->luas;
  echo "-";
  echo $village = $datas->desa;
  echo "-";
  echo $district  = $datas->ta;
  echo "-";
  echo $municipality  = $datas->mu;
  echo "-";
  echo $farmer  = $datas->petani;
  echo "-";
  echo $planting_year = $get_koordinat->thn_tanam;

  echo "</br>";



  $backdoor->planting_maps_insert($id_mapdata,$id_part,$id_shipment,$name,$geo,$total_trees,$species,$area,$village,$district,$municipality,$farmer,$planting_year);
}
?>
