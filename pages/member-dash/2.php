<?php 
session_start();
include '../../koneksi/koneksi.php';
$kode=$_SESSION['kode'];
$jml_win=$conn->query("select count(*) from t4t_wins where id_part='$kode' and bl!='' and no_shipment!='' ")->fetch();
 ?>
<div class="left"></div>
    <div class="center">
        <span class="count_top"><i class="fa fa-globe"></i> Total WIN Used</span>
        <div class="count" align="right"><?php echo number_format($jml_win[0]) ?></div>
        
    </div>
