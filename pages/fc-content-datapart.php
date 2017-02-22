<?php
include '../koneksi/koneksi.php';
session_start();

?>
<!-- start accordion -->
<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
    <?php
    $kode_fc=$_SESSION['kode'];

    $q_desa= $conn->query("select * from t4t_lahan where kd_fc='$kode_fc' group by id_desa");
    while ($load_desa = $q_desa->fetch(PDO::FETCH_OBJ)) {


    ?>

    <div class="panel">
        <a class="panel-heading" role="tab" id="heading<?php echo $load_desa->id_desa ?>" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $load_desa->id_desa ?>" aria-expanded="true" aria-controls="collapse<?php echo $F['id_desa'] ?>">
            <h4 class="panel-title">
            <i class="fa fa-caret-square-o-down"></i>
            <?php
            $id_desa  =$load_desa->id_desa;

        $q_nama_desa = $conn->query("SELECT * from t4t_desa where id_desa='$id_desa'");
        $nama_desa   = $q_nama_desa->fetch(PDO::FETCH_OBJ);
            $id_kec   =$nama_desa->id_kec;
            $id_kab   =$nama_desa->kab_code;

        $nama_kec = $conn->query("SELECT * from t4t_kec where id_kec='$id_kec'")->fetch(PDO::FETCH_OBJ);
        $nama_kab = $conn->query("SELECT * from t4t_kab where kab_code='$id_kab'")->fetch(PDO::FETCH_OBJ);
        $jml_part = $conn->query("SELECT count(*) as count from t4t_lahan where id_desa='$id_desa'")->fetch(PDO::FETCH_OBJ);

            echo "Desa ".$nama_desa->desa; echo " - Kec. ".$nama_kec->kecamatan; echo " - Kab. ".$nama_kab->nama;
            ?>

            <span class='badge bg-green'><?php echo $jml_part->count ?> partisipan</span>
            </h4>
        </a>
        <div id="collapse<?php echo $load_desa->id_desa ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading<?php echo $load_desa->id_desa ?>">
            <div class="panel-body">
                <table class="table table-striped responsive-utilities jambo_table" id="data_partisipan<?php echo $load_desa->id_desa ?>">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Partisipan</th>
                            <th>Lokasi</th>
                            <th><center>Aksi</center></th>
                        </tr>
                    </thead>

                    <tbody>
            <?php
            $no=1;

            $q_partisipan=$conn->query("SELECT * from t4t_lahan where id_desa='$id_desa'");
            while ($load_part=$q_partisipan->fetch(PDO::FETCH_OBJ)) {


            ?>
                        <tr>
                            <th scope="row"><?php echo $no; ?></th>
                            <td>
                            <?php
                            $kd_petani  =$load_part->kd_petani;
                            $nama_petani= $conn->query("select * from t4t_petani where kd_petani='$kd_petani' and id_desa='$id_desa'")->fetch(PDO::FETCH_OBJ);

                            echo "<b>".$nama_petani->nm_petani;"<b>"
                            ?> <br>
                            <div class="avatar-view-petani" title="">
                                        <img src="../images/default.png" alt="Avatar" width="100%">
                            </div>
                            </td>
                            <td>
                            <?php
                            echo "Desa ".$nama_desa->desa; echo " - Kec. ".$nama_kec->kecamatan; echo " - Kab. ".$nama_kab->nama;
                            ?>
                            </td>

                            <td align="center"><a href="?<?php echo paramEncrypt('hal=fc-planning-petani-detail&kd_petani='.$kd_petani.'&id_desa='.$id_desa.'&nama_desa='.$nama_desa->desa.'&nama_kec='.$nama_kec->kecamatan.'&nama_kab='.$nama_kab->nama.'') ?>"><i class="fa fa-chevron-circle-right"></i> Lihat Detail </a></td>
                        </tr>
            <?php
            $no++;
            } ?>
                    </tbody>

                </table>


            </div>
        </div>
    </div>
<!-- Datatables -->
<script src="../js/datatables/js/jquery.dataTables.js"></script>
<script src="../js/datatables/tools/js/dataTables.tableTools.js"></script>

<script>
$(function() {
$('#data_partisipan<?php echo $load_desa->id_desa ?>').DataTable( {
        // "bJQueryUI":true,
      "bPaginate":true,
      "sPaginationType": "full_numbers",
      "iDisplayLength":5
} );

} );
</script>
<!-- end datatable -->
    <?php

    } ?>
</div>
<!-- end of accordion -->
