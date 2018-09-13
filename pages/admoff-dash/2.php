<?php
session_start();
include '../../koneksi/koneksi.php';
include '../../action/function/class.office.php';
$office = new office();

$date_start = date("Y-m-d", strtotime($office->last30days()));
$date_end   = date("Y-m-d");

$kode=$_SESSION['kode'];
$waktu=date("Y-m");
$jumlah=$conn->query("SELECT count(*) from t4t_order where acc=0 and date(wkt_order) BETWEEN '$date_start' and '$date_end' ")->fetch();

 ?>
 <div class="left"></div>
                        <div class="right">

                       <span class="count_top"><i class="fa fa-info-circle"></i> Unapproved Order <br><small>(Last 30 days)</small></span>
<div class="count <?php if ($jumlah[0]>=1) {
    echo "red";
}else{
    echo "green";
} ?>" align="center"><?php echo $jumlah[0] ?></div>
<a href="admin-office.php?6b047c7a0554fd1c19425832229e78c0389c11dad9dbec4ec57715897ea30234"><i class="fa fa-angle-double-left"></i> More Information</a>


 </div>
