<?php
include '../koneksi/koneksi.php';
session_start();

?>
<!-- start accordion -->
<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
    <?php
    $kode_fc=$_SESSION['kode'];
    $kode_ta=$_SESSION['ta'];
    $desa=$conn->query("select * from t4t_lahan where kd_ta='$kode_ta' group by id_desa");
    while ($load_desa=$desa->fetch()) {


    ?>

    <div class="panel">
        <a class="panel-heading" role="tab" id="heading<?php echo $load_desa['id_desa'] ?>" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $load_desa['id_desa'] ?>" aria-expanded="true" aria-controls="collapse<?php echo $load_desa['id_desa'] ?>">
            <h4 class="panel-title">
            <i class="fa fa-caret-square-o-down"></i>
            <?php
            $id_desa  =$load_desa['id_desa'];
            $nama_desa=$conn->query("select * from t4t_desa where id_desa='$id_desa'")->fetch();
            $id_kec   =$nama_desa['id_kec'];
            $id_kab   =$nama_desa['kab_code'];
            $nama_kec =$conn->query("select * from t4t_kec where id_kec='$id_kec'")->fetch();
            $nama_kab =$conn->query("select * from t4t_kab where kab_code='$id_kab'")->fetch();
            // $jml_part =mysql_fetch_array(mysql_query("select count(*) from t4t_lahan where id_desa='$id_desa' and kd_fc='$kode_fc'"));
            $jml_tanaman=$conn->query("select sum(jml_realisasi) from t4t_lahan where id_desa='$id_desa'")->fetch();

            echo " Desa ".$nama_desa['desa']; echo " - Kec. ".$nama_kec['kecamatan']; echo " - Kab. ".$nama_kab['nama'];
            ?>


            </h4>
        </a>
        <div id="collapse<?php echo $load_desa['id_desa'] ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading<?php echo $load_desa['id_desa'] ?>">
            <div class="panel-body">
                <!-- isi accordion 1 -->
                <div class="accordion" id="accordion2" role="tablist" aria-multiselectable="true">
                   <?php
                   $tahun=$conn->query("select * from t4t_lahan where id_desa='$id_desa' and kd_ta='$kode_ta' group by thn_tanam order by thn_tanam desc ");
                   while ($load_tahun=$tahun->fetch()) {
                   ?>
                    <div class="panel">
                        <a class="panel-heading" role="tab" id="heading<?php echo $load_tahun['thn_tanam'].''.$load_tahun['id_desa'] ?>" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?php echo $load_tahun['thn_tanam'].''.$load_tahun['id_desa'] ?>" aria-expanded="true" aria-controls="collapse<?php echo $load_tahun['thn_tanam'].''.$load_tahun['id_desa'] ?>">
                            <h4 class="panel-title">
                           <i class="fa fa-caret-square-o-down"></i> Lahan pada tahun <?php echo $load_tahun['thn_tanam'] ?>
                           <?php
                           $th=$load_tahun['thn_tanam'];
                           $jml_tanaman2=$conn->query("select sum(jml_realisasi) from t4t_lahan where id_desa='$id_desa' and thn_tanam='$th' ")->fetch();
                           ?>

                            </h4>
                        </a>
                        <div id="collapse<?php echo $load_tahun['thn_tanam'].''.$load_tahun['id_desa'] ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading<?php echo $load_tahun['thn_tanam'].''.$load_tahun['id_desa'] ?>">
                            <div class="panel-body">
                    <!-- isi table -->
                    <table class="table table-striped responsive-utilities jambo_table" border="1" id="monitoring_list<?php echo $load_tahun['thn_tanam'].''.$load_tahun['id_desa'] ?>">
                    <thead>
                            <tr>
                                <th><center>No. Lahan<center></th>
                                <th><center>Monitoring I</center></th>
                                <th><center>Monitoring II</center></th>
                                <th><center>Monitoring III</center></th>
                                <th><center>Monitoring IV</center></th>
                                <th><center>Monitoring V</center></th>
                                <th><center>Monitoring VI</center></th>
                                <th><center>Monitoring VII</center></th>
                            </tr>
                        </thead>

                        <tbody>
                <?php
                $th=$load_tahun['thn_tanam'];

                $lahan=$conn->query("select * from t4t_lahan where id_desa='$id_desa' and kd_ta='$kode_ta' and thn_tanam='$th'");
                while ($load_lahan=$lahan->fetch()) {

                ?>
                            <tr>
                                <td align="center"><?php echo $load_lahan['no_lahan'] ?></td>
                                <td align="center">
                                <?php

                                     $link1=paramEncrypt('hal=fc-monitoring-detail&id_lahan='.$load_lahan['no'].'&mon=1');
                                     $link2=paramEncrypt('hal=fc-monitoring-detail&id_lahan='.$load_lahan['no'].'&mon=2');
                                     $link3=paramEncrypt('hal=fc-monitoring-detail&id_lahan='.$load_lahan['no'].'&mon=3');
                                     $link4=paramEncrypt('hal=fc-monitoring-detail&id_lahan='.$load_lahan['no'].'&mon=4');
                                     $link5=paramEncrypt('hal=fc-monitoring-detail&id_lahan='.$load_lahan['no'].'&mon=5');
                                     $link6=paramEncrypt('hal=fc-monitoring-detail&id_lahan='.$load_lahan['no'].'&mon=6');
                                     $link7=paramEncrypt('hal=fc-monitoring-detail&id_lahan='.$load_lahan['no'].'&mon=7');



                                 if ($load_lahan['accmon1']==0) {
                                    echo "<a href='?".$link1."'>";
                                    echo "<div class='font-big'><i class='fa fa-circle-o'></i></div>";
                                    echo "</a>";
                                 }elseif ($load_lahan['accmon1']==1) {
                                     echo "<div class='font-hijau-big'><i class='fa fa-check-circle'></i></div>";
                                 }
                                ?></td>
                            <td align="center">
                                <?php
                                 if ($load_lahan['accmon2']==0) {
                                    echo "<a href='?".$link2."'>";
                                    echo "<div class='font-big'><i class='fa fa-circle-o'></i></div>";
                                    echo "</a>";
                                 }elseif ($load_lahan['accmon2']==1) {
                                     echo "<div class='font-hijau-big'><i class='fa fa-check-circle'></i></div>";
                                 }
                                ?></td>
                            <td align="center">
                                <?php
                                 if ($load_lahan['accmon3']==0) {
                                    echo "<a href='?".$link3."'>";
                                    echo "<div class='font-big'><i class='fa fa-circle-o'></i></div>";
                                    echo "</a>";
                                 }elseif ($load_lahan['accmon3']==1) {
                                     echo "<div class='font-hijau-big'><i class='fa fa-check-circle'></i></div>";
                                 }
                                ?></td>
                            <td align="center">
                                <?php
                                 if ($load_lahan['accmon4']==0) {
                                    echo "<a href='?".$link4."'>";
                                    echo "<div class='font-big'><i class='fa fa-circle-o'></i></div>";
                                    echo "</a>";
                                 }elseif ($load_lahan['accmon4']==1) {
                                     echo "<div class='font-hijau-big'><i class='fa fa-check-circle'></i></div>";
                                 }
                                ?></td>
                            <td align="center">
                                <?php
                                 if ($load_lahan['accmon5']==0) {
                                    echo "<a href='?".$link5."'>";
                                    echo "<div class='font-big'><i class='fa fa-circle-o'></i></div>";
                                    echo "</a>";
                                 }elseif ($load_lahan['accmon5']==1) {
                                     echo "<div class='font-hijau-big'><i class='fa fa-check-circle'></i></div>";
                                 }
                                ?></td>
                            <td align="center">
                                <?php
                                 if ($load_lahan['accmon6']==0) {
                                    echo "<a href='?".$link6."'>";
                                    echo "<div class='font-big'><i class='fa fa-circle-o'></i></div>";
                                    echo "</a>";
                                 }elseif ($load_lahan['accmon6']==1) {
                                     echo "<div class='font-hijau-big'><i class='fa fa-check-circle'></i></div>";
                                 }
                                ?></td>
                            <td align="center">
                                <?php
                                 if ($load_lahan['accmon7']==0) {
                                    echo "<a href='?".$link7."'>";
                                    echo "<div class='font-big'><i class='fa fa-circle-o'></i></div>";
                                    echo "</a>";
                                 }elseif ($load_lahan['accmon7']==1) {
                                     echo "<div class='font-hijau-big'><i class='fa fa-check-circle'></i></div>";
                                 }
                                ?></td>

                            </tr>


                <?php
                }
                ?>
                        </tbody>

                    </table>
                    <!-- end isi table -->
                    </div>
                        </div>
                    </div>
<!-- Datatables -->
<script src="../js/datatables/js/jquery.dataTables.js"></script>
<script src="../js/datatables/tools/js/dataTables.tableTools.js"></script>

<script>
$(function() {
$('#monitoring_list<?php echo $load_tahun['thn_tanam'].''.$load_tahun['id_desa'] ?>').DataTable( {
        // "bJQueryUI":true,
      "bPaginate":true,
      "sPaginationType": "full_numbers",
      "iDisplayLength":100
} );

} );
</script>
<!-- end datatable -->
                    <?php } ?>
                </div>
                <!-- end isi accordion 1 -->
            </div>
        </div>
    </div>
    <?php

    } ?>
</div>
<!-- end of accordion -->
