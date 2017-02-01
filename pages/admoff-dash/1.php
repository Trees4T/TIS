<?php 
session_start();
include '../../koneksi/koneksi.php';
$kode=$_SESSION['kode'];
$waktu=date("Y-m");
$jumlah=mysql_fetch_array(mysql_query("select count(*) from t4t_shipment where acc=0 and wkt_shipment like '%$waktu%' "));
 ?>
 <div class="left"></div>
 
 <div class="right">                         
	<span class="count_top"><i class="fa fa-info-circle"></i> Unapproved Shipment (this month)</span>
	<div class="count <?php if ($jumlah[0]>=1) {
	    echo "red";
	}else{
	    echo "green";
	} ?>" align="center"><?php echo $jumlah[0] ?>
	</div>
<a href="admin-office.php?0f47d9d32e95aaa88b367c1ddd52202a3e08d1996696a136920c680e00fa9159"><i class="fa fa-angle-double-left"></i> More Information</a>


 </div>
