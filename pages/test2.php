<?php

date_default_timezone_set('Asia/Jakarta');
//echo $waktu = date("dmyHis");

ob_start();
include '../koneksi/koneksi.php';

$list_bl = $conn->query("SELECT bl FROM t4t_wins WHERE id_part='MF030' GROUP BY bl");
$no=1;
while ($list = $list_bl->fetch()) {
  //echo $no.'. '.$list['bl'].'<br>';
  $bl=$list['bl'];
  $htc = $conn->query("SELECT * FROM t4t_htc where bl='$bl'");
  echo $no.'. BL.'.$bl.'.<br>';

        $wins = $conn->query("SELECT wins from t4t_wins where bl='$bl'");
        while ($win = $wins->fetch()) {
          echo $win['wins'].", ";
        }

?>

  <?php
  echo "<br>";echo "<br>";
$no++;
}


?>
