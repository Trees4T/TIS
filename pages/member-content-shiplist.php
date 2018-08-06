<?php
include '../koneksi/koneksi.php';
session_start();
?>

<!-- start accordion -->
<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
    <?php
    $kode=$_SESSION['kode'];
    $tahun=$conn->query("select substr(bl_tgl,1,4) as th,bl_tgl,bl,kota_tujuan,fee,acc from t4t_shipment where id_comp='$kode' group by th order by th desc");
    //echo mysql_error();
    while ($load_tahun=$tahun->fetch()) {

    ?>

    <div class="panel">
        <a href="?<?php echo paramEncrypt('hal=member-content-shiplist2&id_member='.$kode.'&pilih_tahun='.$load_tahun['th'].'') ?>" class="panel-heading" role="tab" id="heading<?php echo $load_tahun['th'] ?>" aria-expanded="true" aria-controls="collapse<?php echo $load_tahun['th'] ?>">
            <h4 class="panel-title">
            <i class="fa fa-caret-square-o-down"></i>
            <?php
            echo $load_tahun['th'];
            ?>
            </h4>
        </a>

    </div>
    <!-- end panel -->


        <?php } ?>
</div>
<!-- end of accordion -->
