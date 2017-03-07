<?php
include '../koneksi/koneksi.php';
session_start();
$ambil_bl = $conn->query("SELECT wins_used from t4t_shipment where bl='DMCQSEM0027700'")->fetch();
echo $ambil_bl[0]."<br><br>";
$pecah = explode(",", $ambil_bl[0]);
$jml_pecah = count($pecah);


for ($i=0; $i < $jml_pecah ; $i++) {
  $pecah[$i]."<br>";
  $pecah_2 = explode("-", $pecah[$i]);

  if (isset($pecah_2[1])) {

    for ($j=$pecah_2[0]; $j <= $pecah_2[1] ; $j++) {
       echo $n = $j." ";

    }

  }else{
     echo $n = $pecah_2[0];
     $_SESSION['n_ship2']=$n;
  }

}

?>
