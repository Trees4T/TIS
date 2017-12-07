<?php
include '../../koneksi/koneksi.php';
session_start();
?>

    <div id="myTabContent" class="tab-content">
        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
            <!-- start accordion -->
            <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                <?php
                $kode=$_SESSION['kode'];
                $tahun_cek=$conn->query("select substr(bl_tgl,1,4) as th from t4t_shipment where id_comp='$kode' and acc_paid=0 group by th order by th desc");
                //echo mysql_error();

                if ($cek=$tahun_cek->fetch()=="") {
                    echo "No result found.";
                }else{
                    $tahun=$conn->query("select substr(bl_tgl,1,4) as th from t4t_shipment where id_comp='$kode' and acc_paid=0 group by th order by th desc");
                while ($load_tahun=$tahun->fetch()) {

                ?>

                <div class="panel">
                    <a href="?<?php echo paramEncrypt('hal=member-content-paidunpaid2&id_member='.$kode.'&pilih_tahun='.$load_tahun['th'].'&sts_paid=0') ?>" class="panel-heading" role="tab" id="heading<?php echo $load_tahun['th'] ?>" aria-expanded="true" aria-controls="collapse<?php echo $load_tahun['th'] ?>">
                        <h4 class="panel-title">
                        <i class="fa fa-caret-square-o-down"></i>
                        <?php
                        echo $load_tahun[0];
                        ?>
                        </h4>
                    </a>
                  <!-- isi   -->
                </div>




                    <?php }

                    }
                    ?>
            </div>
            <!-- end of accordion -->
        </div>


        <div role="tabpanel2" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
            <!-- start accordion -->
            <div class="accordion" id="accordion2" role="tablist" aria-multiselectable="true">
                <?php
                $kode=$_SESSION['kode'];
                $tahun2_cek=$conn->query("select substr(bl_tgl,1,4) as th from t4t_shipment where id_comp='$kode' and acc_paid=1 group by th order by th desc");

                if ($cek3=$tahun2_cek->fetch()=="") {
                    echo "No result found.";
                }else{
                $tahun2=$conn->query("select substr(bl_tgl,1,4) as th from t4t_shipment where id_comp='$kode' and acc_paid=1 group by th order by th desc");
                while ($load_tahun2=$tahun2->fetch()) {

                ?>

                <div class="panel">
                    <a href="?<?php echo paramEncrypt('hal=member-content-paidunpaid2&id_member='.$kode.'&pilih_tahun='.$load_tahun2['th'].'&sts_paid=1') ?>" class="panel-heading" role="tab" id="heading<?php echo $load_tahun['th'] ?>" aria-expanded="true" aria-controls="collapse<?php echo $load_tahun['th'] ?>">
                        <h4 class="panel-title">
                        <i class="fa fa-caret-square-o-down"></i>
                        <?php
                        echo $load_tahun2['th'];
                        ?>
                        </h4>
                    </a>
                    <!-- isi -->
                </div>

                    <?php }
                }
                     ?>
            </div>
            <!-- end of accordion -->
        </div>

    </div>
</div>
