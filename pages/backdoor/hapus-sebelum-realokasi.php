<?php
error_reporting(0);
session_start();
require_once '../../koneksi/koneksi.php';
?>


<form class="" action="" method="post">
  <textarea name="shipment" rows="8" cols="50" required></textarea>
  <button type="submit" name="button"> Submit </button>
</form>

<?php
if (isset($_POST['shipment'])) {

$shipments = explode(',', $_POST['shipment']);
$jml = count($shipments);

$query_del_htc = "DELETE FROM t4t_htc WHERE ";
$query_del_win = "DELETE FROM t4t_wins WHERE ";
$query_del_tre = "UPDATE current_tree set used=0,bl='',no_shipment='' WHERE ";
$query_del_pms = "DELETE FROM t4t_web.planting_maps WHERE ";


for ($i=0; $i < $jml ; $i++) {
  echo "No. "; echo $i+1; echo " - ";
  echo $shipments[$i];

  $data = trim($shipments[$i]);
  //htc
  if ($i != $jml-1) {
      $query_del_htc .= "no_shipment='$data' OR ";
  }else{
      $query_del_htc .= "no_shipment='$data' ";
  }

  //wins
  if ($i != $jml-1) {
      $query_del_win .= "no_shipment='$data' OR ";
  }else{
      $query_del_win .= "no_shipment='$data' ";
  }

  //tree
  if ($i != $jml-1) {
      $query_del_tre .= "no_shipment='$data' OR ";
  }else{
      $query_del_tre .= "no_shipment='$data' ";
  }

  //planting maps
  if ($i != $jml-1) {
      $query_del_pms .= "id_shipment='$data' OR ";
  }else{
      $query_del_pms .= "id_shipment='$data' ";
  }


    echo "<br>";

}

$q1 = $conn->query($query_del_htc)->fetch();
$q2 = $conn->query($query_del_win)->fetch();
$q3 = $conn->query($query_del_tre)->fetch();
$q4 = $conn->query($query_del_pms)->fetch();

}
?>
