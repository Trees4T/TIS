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
  echo $no.'. BL NO./'.$bl.'<br>';


        // $wins = $conn->query("SELECT wins from t4t_wins where bl='$bl'");
        // while ($win = $wins->fetch()) {
        //   echo $win['wins'].", ";
        // }

?>
<table>
  <thead>
    <tr>
      <th>BL.</th>
      <th>No. Shipment</th>
      <th>Kd Lahan</th>
      <th>No Lahan</th>
      <th>Geo</th>
      <th>Silvilkultur</th>
      <th>Luas m2</th>
      <th>Petani</th>
      <th>Desa</th>
      <th>TA</th>
      <th>MU</th>
      <th>Jml. Pohon</th>
      <th>Wkt Shipment</th>

    </tr>
  </thead>
  <tbody>

<?php

  while ($data = $htc->fetch()) {
    $wkt_shipment = $conn->query("SELECT bl,wkt_shipment from t4t_shipment where bl='$data[bl]'")->fetch();
?>
<tr>
  <td><?php echo $bl ?></td>
  <td><?php echo $data['no_shipment'].' '; ?></td>
  <td><?php echo $data['kd_lahan'].' '; ?></td>
  <td><?php echo $data['no_lahan'].' '; ?></td>
  <td><?php echo $data['geo'].' '; ?></td>
  <td><?php echo $data['silvilkultur'].' '; ?></td>
  <td><?php echo $data['luas'].' '; ?></td>
  <td><?php echo $data['petani'].' '; ?></td>
  <td><?php echo $data['desa'].' '; ?></td>
  <td><?php echo $data['ta'].' '; ?></td>
  <td><?php echo $data['mu'].' '; ?></td>
  <td><?php echo $data['jml_phn'].' '; ?></td>
  <td><?php echo $wkt_shipment['wkt_shipment'].' '; ?></td>
</tr>
<?php



  }
  ?>

  </tbody>
  </table>
  <?php
  echo "<br>";
$no++;
}


?>
