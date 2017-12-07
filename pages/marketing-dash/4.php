<?php 
session_start();
include '../../koneksi/koneksi.php';
$kode=$_SESSION['kode'];
$jumlah=$conn->query("select count(*) from t4t_order where acc=0 ")->fetch();
 ?>
 <div class="left"></div>
                        <div class="right">
                            
                       <span class="count_top"><i class="fa fa-info-circle"></i> Unapproved Order</span>
<div class="count <?php if ($jumlah[0]>=1) {
    echo "red";
}else{
    echo "green";
} ?>" align="center"><?php echo $jumlah[0] ?></div>
<a href="admin-office.php?6b047c7a0554fd1c19425832229e78c044a7852422548942c9236cfef6d71005"><i class="fa fa-angle-double-left"></i> More Information</a>


 </div>
