<?php
// include '../koneksi/koneksi.php';
// session_start();

?>
<!-- start accordion -->
<div class="accordion" id="accordion" role="tablist" aria-multiSELECTable="true">
    <?php
    $list_desa = $fc->list_desa($kode_fc);

    foreach ($list_desa as $load_desa) {
    ?>

    <div class="panel">
        <a class="panel-heading" href="?<?php echo paramEncrypt('hal=fc-content-realtanam-detail&id_desa='.$load_desa->id_desa.'') ?>">
            <h4 class="panel-title">
            <i class="fa fa-caret-square-o-down"></i>
            <?php
            $id_desa   = $load_desa->id_desa;
            $nama_desa = $fc->nama_desa($id_desa);

            $id_kec    = $nama_desa->id_kec;
            $nama_kec  = $fc->nama_kec($id_kec);

            $id_kab    = $nama_desa->kab_code;
            $nama_kab  = $fc->nama_kab($id_kab);

            $jml_tanaman  = $fc->jml_tanam_realtanam($id_desa);

            echo "Desa ".$nama_desa->desa; echo " - Kec. ".$nama_kec->kecamatan; echo " - Kab. ".$nama_kab->nama;
            ?>

            <span class="badge bg-green"><?php echo number_format($jml_tanaman->jml) ?> pohon</span>
            </h4>
        </a>

    </div>
    <?php

    } ?>
</div>
<!-- end of accordion -->
