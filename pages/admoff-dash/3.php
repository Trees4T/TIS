<?php 
session_start();
include '../../koneksi/koneksi.php';
$kode=$_SESSION['kode'];
$jumlah=$conn->query("select count(*) from t4t_shipment where acc=0 ")->fetch();
 ?>
 <div class="left"></div>
                        <div class="right">
                            
                       <span class="count_top"><i class="fa fa-info-circle"></i> Unapproved Shipment</span>
<div class="count <?php if ($jumlah[0]>=1) {
    echo "red";
}else{
    echo "green";
} ?>" align="center"><?php echo $jumlah[0] ?></div>
<a href="admin-office.php?0f47d9d32e95aaa88b367c1ddd52202a2ff6c033407ab044cfb02eefb0ecd202"><i class="fa fa-angle-double-left"></i> More Information</a>


 </div>
