<?php 
session_start();
include '../../koneksi/koneksi.php';
$kode=$_SESSION['kode'];
$jml_phn=$conn->query("select sum(b.jml_phn) from t4t_shipment a,t4t_htc b where a.bl=b.bl and a.id_comp='$kode' ")->fetch();
 ?>
<div class="left"></div>
                        <div class="center">
                            <span class="count_top"><i class="fa fa-tree"></i> Total Trees Planted</span>
                            <div class="count green" align="right"><?php echo number_format($jml_phn[0]) ?></div>
                           
                        </div>