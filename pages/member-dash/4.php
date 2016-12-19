<?php 
session_start();
include '../../koneksi/koneksi.php';
$kode=$_SESSION['kode'];
$contrib=mysql_fetch_array(mysql_query("select sum(fee) from t4t_shipment where id_comp='$kode' and acc_paid='1' "));
 ?>
<div class="left"></div>
                        <div class="center">
                            <span class="count_top"><i class="fa fa-dollar"></i> Total Contribution</span>
                            <div class="count" align="right"><?php echo $contrib[0] ?></div>
                          
                        </div>
