<?php
session_start();
include '../../koneksi/koneksi.php';
$kode=$_SESSION['kode'];
$waktu=date("Y-m");
$jumlah=$conn->query("select count(*) from t4t_shipment where acc_paid=0 and wkt_shipment like '%$waktu%' ")->fetch();
 ?>
 <div class="left"></div>

 <div class="right">
	<span class="count_top"><i class="fa fa-info-circle"></i> Unpaid Shipment (This Month)</span>
	<div class="count <?php if ($jumlah[0]>=1) {
	    echo "red";
	}else{
	    echo "green";
	} ?>" align="center"><?php echo $jumlah[0] ?>
	</div>
<a href="finance-office.php?16253c7a85a4738778c48ff3a448ab6dcd05d19dab3011067fc7f431208e0a22"><i class="fa fa-angle-double-left"></i> More Information</a>


 </div>
