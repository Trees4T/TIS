<?php 
session_start();
include '../../koneksi/koneksi.php';
$kode=$_SESSION['kode'];
$unpaid=mysql_fetch_array(mysql_query("select count(*) from t4t_shipment where id_comp='$kode' and acc_paid=0 "));
 ?>
 <div class="left"></div>
                        <div class="right">
                            
                       <span class="count_top"><i class="fa fa-info-circle"></i> Unpaid Shipments</span>
<div class="count <?php if ($unpaid[0]>=1) {
    echo "red";
}else{
    echo "green";
} ?>" align="center"><?php echo $unpaid[0] ?></div>
<a href="?<?php echo paramEncrypt('hal=member-paid-unpaid')?>"><span>go to paid & unpaid <i class="fa fa-angle-double-right"></i></span></a>

 </div>
