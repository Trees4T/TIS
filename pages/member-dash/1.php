<?php
session_start();
include '../../koneksi/koneksi.php';
require_once '../../action/function/class.office.php';
$office = new office();

$kode=$_SESSION['kode'];
$unpaid=$office->jml_unpaid($kode);
 ?>
 <div class="left"></div>
                        <div class="right">

                       <span class="count_top"><i class="fa fa-info-circle"></i> Unpaid Shipments</span>
<div class="count <?php if ($unpaid->jml >= 1) {
    echo "red";
}else{
    echo "green";
} ?>" align="center"><?php echo $unpaid->jml ?></div>
<a href="?<?php echo paramEncrypt('hal=member-paid-unpaid')?>"><span>go to paid & unpaid <i class="fa fa-angle-double-right"></i></span></a>

 </div>
