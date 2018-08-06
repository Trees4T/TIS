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
  echo $no.'. BL.'.$bl.'<br>';
  ?>
  <table>
    <thead>
      <tr>
        <th>Wkt. Shipment</th>
        <th>BL.</th>
        <th>No. Shipment</th>
      </tr>
    </thead>
    <tbody>

  <?php
        $wins = $conn->query("SELECT bl,wkt_shipment,no_shipment from t4t_shipment where bl='$bl'");
        while ($win = $wins->fetch()) {
        //  echo $win['bl']." - ".$win['wkt_shipment'];

          ?>
          <tr>

            <td><?php echo $win['wkt_shipment'].' '; ?></td>
            <td><?php echo $win['bl'] ?></td>
            <td><?php echo $win['no_shipment'].' '; ?></td>
          </tr>
          <?php
        }

?>
</tbody>
</table>
  <?php
  echo "<br>";echo "<br>";
$no++;
}


?>
