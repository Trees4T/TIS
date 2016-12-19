<?php
include '../../koneksi/koneksi.php';
session_start();
error_reporting(0);
// Fungsi header dengan mengirimkan raw data excel
//header("Content-type: application/vnd-ms-excel");
$tanggal=date("Ymd");

$awal =$_POST['awal'];
$akhir=$_POST['akhir']; 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=$awal-to-$akhir-trees-planted-report.xls");
header("Content-Type: application/xls");     
header("Pragma: no-cache"); 
header("Expires: 0");


// Tambahkan table
?>
<table id="example" class="table table-striped responsive-utilities jambo_table">
            <thead>
                <tr class="headings">
                    <th width="25%"><center>Shipment Time</center> </th>
                    <th width="25%"><center>BL Date</center> </th>
                    <th><center>BL</center> </th>
                    <th width="20%"><center>Trees QTY</center></th>
                </tr>
            </thead>

            <tbody>
<?php

$kode=$_SESSION['kode'];
$no=1;
$tree_planted=mysql_query("select s.wkt_shipment,s.bl,s.id_comp,s.no,h.bl,sum(h.jml_phn),s.bl_tgl from t4t_shipment s join t4t_htc h on s.bl=h.bl AND s.id_comp='$kode' and s.wkt_shipment between '$awal' and '$akhir' group by s.bl order by h.no desc");
while ($data=mysql_fetch_array($tree_planted)) {
    
echo mysql_error();
 ?>

    <tr class="even pointer">
        <td class=" " align="center"><?php echo $data[0] ?></td>
        <td class=" " align="center"><?php echo $data[6] ?></td>
        <td class=" "><?php echo $data[1] ?></td>
        <td class=" " align="center"><?php echo $data[5] ?></td>
        
        
    </tr>
              
<?php 
  $no++;  }
 ?>      
                
            </tbody>

</table>