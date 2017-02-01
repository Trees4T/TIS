<?php 
session_start();
include '../../koneksi/koneksi.php';
$kode=$_SESSION['kode'];
$waktu=date("Y-m");
$jumlah=mysql_fetch_array(mysql_query("select count(*) from t4t_shipment where acc_paid=0 and acc=1  "));

 ?>
 <div class="left"></div>
                        <div class="right">
                            
                       <span class="count_top"><i class="fa fa-info-circle"></i> Unpaid Shipment (All)</span>
<div class="count <?php if ($jumlah[0]>=1) {
    echo "red";
}else{
    echo "green";
} ?>" align="center"><?php echo $jumlah[0] ?></div>
<a href="finance-office.php?16253c7a85a4738778c48ff3a448ab6df4eb5470839ea5ce1c43cf3b9feff63d"><i class="fa fa-angle-double-left"></i> More Information</a>


 </div>
