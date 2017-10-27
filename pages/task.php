<?php
session_start();

ob_start();
include '../koneksi/koneksi.php';

$list_order = $conn->query("SELECT no_order, wkt_order, id_comp from t4t_order where acc=1 and wkt_order like '%2017%'");

while ($data = $list_order->fetch()) {
  //echo $no_order = $data[0]."<br>";
  $cek_no_order = $conn->query("SELECT no_shipment from t4t_shipment where no_order like '$data[0]%' or no_order like '%, $data[0]%' limit 1")->fetch();
  if ($cek_no_order==true) {
    # code...
  }else{
    echo $no_order = $data[0]." - ".$data[2]."<br>";
  }
  //echo "<b>".$cek_no_order['no_shipment']."</b><br><br>";
}
?>
