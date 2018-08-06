<?php
include '../../koneksi/koneksi.php';
session_start();
?>
<!-- start accordion -->
            <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                <?php
                $kode=$_SESSION['kode'];
                $tahun=$conn->query("select substr(t4t_order.wkt_order,1,4) AS `th`,no_order,wkt_order from t4t_order where id_comp='$kode' group by th order by th desc");

                while ($load_tahun=$tahun->fetch()) {

                ?>

                <div class="panel">
                    <a href="?<?php echo paramEncrypt('hal=member-content-ordlist2&id_member='.$kode.'&pilih_tahun='.$load_tahun['th'].'') ?>" class="panel-heading" role="tab" id="heading<?php echo $load_tahun['th'] ?>" aria-expanded="true" aria-controls="collapse<?php echo $load_tahun['th'] ?>">
                        <h4 class="panel-title">
                        <i class="fa fa-caret-square-o-down"></i>
                        <?php
                        echo $load_tahun['th'];
                        ?>
                        </h4>
                    </a>

                </div>


                    <?php } ?>
            </div>
            <!-- end of accordion -->
