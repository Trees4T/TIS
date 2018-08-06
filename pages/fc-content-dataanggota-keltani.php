
<!-- start accordion -->
<div class="accordion">
    <?php

    $desa = $fc->list_desa($kode_fc);
    foreach ($desa as $load_desa) {
    
    ?>

    <div class="panel">
        <a class="panel-heading" href="?<?php echo paramEncrypt('hal=fc-planning-lihat-data-anggota-keltani&id_desa='.$load_desa->id_desa.'&nama_desa='.$nama_desa->desa.'&nama_kec='.$nama_kec->kecamatan.'&nama_kab='.$nama_kab->nama.'') ?>">
            <h4 class="panel-title">
            <i class="fa fa-caret-square-o-down"></i>
            <?php
            $id_desa   = $load_desa->id_desa;
            $nama_desa = $fc->nama_desa($id_desa);

            $id_kec    = $nama_desa->id_kec;
            $nama_kec  = $fc->nama_kec($id_kec);

            $id_kab    = $nama_desa->kab_code;
            $nama_kab  = $fc->nama_kab($id_kab);

            $jml_kel   = $fc->jml_kel_tani($id_desa);

            echo "Desa ".$nama_desa->desa; echo " - Kec. ".$nama_kec->kecamatan; echo " - Kab. ".$nama_kab->nama;
            ?>

            <span class='badge bg-green'><?php echo $jml_kel->count ?> kelompok tani</span>
            </h4>
        </a>

    </div>

    <?php

    } ?>
</div>
<!-- end of accordion -->
