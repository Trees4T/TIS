<?php include '../koneksi/koneksi.php';
session_start();
$kode=$_SESSION['kode_member'];
$nama_member=$conn->query("select name from t4t_participant where id='$kode'")->fetch();

$actual_link=$_SESSION['link'];
 ?>
<div id="myTabContent" class="tab-content">
    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
        <!-- start accordion -->
        <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
            <?php
            $tahun_cek=$conn->query("select substr(wkt_shipment,1,4) as th,bl_tgl,bl,kota_tujuan,fee,acc from t4t_shipment where id_comp='$kode' and acc_paid=0 and acc=1  group by th order by th desc");
            //echo mysql_error();

            if ($cek=$tahun_cek->fetch()=="") {
                echo "No result found.";
            }else{
                $tahun=$conn->query("select substr(wkt_shipment,1,4) as th,bl_tgl,bl,kota_tujuan,fee,acc from t4t_shipment where id_comp='$kode' and acc_paid=0 and acc=1 group by th order by th desc");
            while ($load_tahun=$tahun->fetch()) {

            ?>

            <div class="panel">
                <a class="panel-heading" role="tab" id="heading<?php echo $load_tahun['th'] ?>" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $load_tahun['th'] ?>" aria-expanded="true" aria-controls="collapse<?php echo $load_tahun['th'] ?>">
                    <h4 class="panel-title">
                    <i class="fa fa-caret-square-o-down"></i>
                    <?php
                    echo $load_tahun[0];
                    ?>
                    </h4>
                </a>

                <div id="collapse<?php echo $load_tahun['th'] ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading<?php echo $load_tahun['th'] ?>">
                    <div class="panel-body">
                        <table class="table table-striped responsive-utilities jambo_table" border="1" id="unpaid_list<?php echo $load_tahun['th'] ?>">
                            <thead>
                                <tr>
                                    <th rowspan="2" width="10%"><center>Shipment Date<center></th>
                                    <th rowspan="2"><center>BL</center></th>
                                    <th rowspan="2"><center>Shipment No.</center></th>
                                    <th rowspan="2"><center>Order No.</center></th>
                                    <th colspan="5"><center>Container Size</center></th>
                                    <th rowspan="2"><center>Dest. City</center></th>
                                    <th rowspan="2"><center>Fee</center></th>
                                    <th rowspan="2"><center>Paid</center></th>
                                </tr>
                                <tr>
                                    <th width="5%"><center>20'</center></th>
                                    <th width="5%"><center>40'</center></th>
                                    <th width="5%"><center>40' HC</center></th>
                                    <th width="5%"><center>45'</center></th>
                                    <th width="5%"><center>60'</center></th>
                                </tr>
                            </thead>

                            <tbody>
                    <?php
                    $th=$load_tahun['th'];

                    $shipment=$conn->query("select * from t4t_shipment where wkt_shipment like '%$th%' and id_comp='$kode' and acc_paid=0 and acc=1 order by wkt_shipment desc");
                    while ($load_shipment=$shipment->fetch()) {


                    ?>
                                <tr>
                                    <td align="center"><?php echo $load_shipment['wkt_shipment'] ?></td>
                                    <td align="center"><?php echo $load_shipment['bl'] ?></td>
                                    <td align="center">
                                      <a href="#" data-toggle="modal" data-target="#detail<?php echo $load_shipment['no'] ?>">
                                            <?php echo $load_shipment['no_shipment'] ?>
                                      </a>
                                    </td>
                                    <td align=""><?php echo $load_shipment['no_order'] ?></td>
                                    <td align="center">
                                        <?php
                                        $no_shipment=$load_shipment['no_shipment']; //definisi no shipment
                                        $a=$conn->query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='1'")->fetch();
                                        echo $a[0];
                                        ?>
                                    </td>
                                    <td align="center">
                                        <?php
                                        $b=$conn->query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='2'")->fetch();
                                        echo $b[0];
                                        ?>
                                    </td>
                                    <td align="center">
                                        <?php
                                        $b=$conn->query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='3'")->fetch();
                                        echo $b[0];
                                        ?>
                                    </td>
                                    <td align="center">
                                        <?php
                                        $c=$conn->query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='4'")->fetch();
                                        echo $c[0];
                                        ?>
                                    </td>
                                    <td align="center">
                                        <?php
                                        $d=$conn->query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='5'")->fetch();
                                        echo $d[0];
                                        ?>
                                    </td>
                                    <td align="center"><?php echo $load_shipment['kota_tujuan'] ?></td>
                                    <td align="center">
                                      <?php
                                      if ($load_shipment['fee']=='0') {
                                        ?>
                                        <a href="#" data-toggle="modal" data-target="#fee<?php echo $load_shipment['no'] ?>"><font color="red">
                                          <?php echo $load_shipment['fee']; ?>
                                        </font></a>
                                        <?php
                                      }else{
                                        ?>
                                        <a href="#" data-toggle="modal" data-target="#fee<?php echo $load_shipment['no'] ?>">
                                        <?php
                                      echo $load_shipment['fee'];
                                        ?>
                                        </a>
                                        <?php
                                      }
                                      ?>
                                    </td>
                                    <td align="center">
                                        <?php
                                        $approve=$conn->query("select acc_paid from t4t_shipment where no_shipment='$no_shipment'")->fetch();
                                        if ($approve[0]=="1") {
                                            ?>
                                            <i class="fa fa-check-square-o"></i>
                                            <?php
                                        }else{
                                            ?>
                                            <a href="#" data-toggle="modal" data-target="#unpaid<?php echo $load_shipment['no'] ?>"><div class="font-15">&empty;</div></a>
                                            <?php
                                        }

                                        ?>

                                    </td>
                                </tr>
<!-- Modal unpaid -->
<?php
include 'modal/unpaid-to-paid.php';
include 'modal/shipment-detail.php';
include 'modal/fee-update.php';
?>
<!-- end modal Unpaid -->
                    <?php
                    }
                    ?>
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
$('#unpaid_list<?php echo $load_tahun['th'] ?>').DataTable( {
// "bJQueryUI":true,
"bPaginate":true,
"sPaginationType": "full_numbers",
"iDisplayLength":10
} );

} );
</script>
<!-- end datatable -->

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
            $tahun2_cek=$conn->query("select substr(wkt_shipment,1,4) as th,bl_tgl,bl,kota_tujuan,fee,acc from t4t_shipment where id_comp='$kode' and acc_paid=1  group by th order by th desc");

            if ($cek3=$tahun2_cek->fetch()=="") {
                echo "No result found.";
            }else{
            $tahun2=$conn->query("select substr(wkt_shipment,1,4) as th,bl_tgl,bl,kota_tujuan,fee,acc from t4t_shipment where id_comp='$kode' and acc_paid=1  group by th order by th desc");
            while ($load_tahun2=$tahun2->fetch()) {

            ?>

            <div class="panel">
                <a class="panel-heading" role="tab" id="heading2<?php echo $load_tahun2['th'] ?>" data-toggle="collapse" data-parent="#accordion2" href="#collapse2<?php echo $load_tahun2['th'] ?>" aria-expanded="true" aria-controls="collapse2<?php echo $load_tahun2['th'] ?>">
                    <h4 class="panel-title">
                    <i class="fa fa-caret-square-o-down"></i>
                    <?php
                    echo $load_tahun2['th'];
                    ?>
                    </h4>
                </a>
                <div id="collapse2<?php echo $load_tahun2['th'] ?>" class="panel-collapse collapse " role="tabpanel2" aria-labelledby="heading2<?php echo $load_tahun2['th'] ?>">
                    <div class="panel-body">
                        <table class="table table-striped responsive-utilities jambo_table" border="1" id="paid_list<?php echo $load_tahun2['th'] ?>">
                            <thead>
                                <tr>
                                    <th rowspan="2" width="10%"><center>Shipment Date<center></th>
                                    <th rowspan="2"><center>BL</center></th>
                                    <th rowspan="2"><center>Shipment No.</center></th>
                                    <th rowspan="2"><center>Order No.</center></th>
                                    <th colspan="5"><center>Container Size</center></th>
                                    <th rowspan="2"><center>Dest. City</center></th>
                                    <th rowspan="2"><center>Fee</center></th>
                                    <th rowspan="2"><center>Paid</center></th>
                                </tr>
                                <tr>
                                    <th width="5%"><center>20'</center></th>
                                    <th width="5%"><center>40'</center></th>
                                    <th width="5%"><center>40' HC</center></th>
                                    <th width="5%"><center>45'</center></th>
                                    <th width="5%"><center>60'</center></th>
                                </tr>
                            </thead>

                            <tbody>
                    <?php
                    $th=$load_tahun2['th'];

                    $shipment=$conn->query("select * from t4t_shipment where wkt_shipment like '%$th%' and id_comp='$kode' and acc_paid=1 order by wkt_shipment desc");
                    while ($load_shipment=$shipment->fetch()) {


                    ?>
                                <tr>
                                    <td align="center"><?php echo $load_shipment['wkt_shipment'] ?></td>
                                    <td align="center"><?php echo $load_shipment['bl'] ?></td>
                                    <td align="center">
                                      <a href="#" data-toggle="modal" data-target="#detail<?php echo $load_shipment['no'] ?>">
                                            <?php echo $load_shipment['no_shipment'] ?>
                                      </a>
                                    </td>
                                    <td align=""><?php echo $load_shipment['no_order'] ?></td>
                                    <td align="center">
                                        <?php
                                        $no_shipment=$load_shipment['no_shipment']; //definisi no shipment
                                        $a=$conn->query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='1'")->fetch();
                                        echo $a[0];
                                        ?>
                                    </td>
                                    <td align="center">
                                        <?php
                                        $b=$conn->query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='2'")->fetch();
                                        echo $b[0];
                                        ?>
                                    </td>
                                    <td align="center">
                                        <?php
                                        $b=$conn->query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='3'")->fetch();
                                        echo $b[0];
                                        ?>
                                    </td>
                                    <td align="center">
                                        <?php
                                        $c=$conn->query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='4'")->fetch();
                                        echo $c[0];
                                        ?>
                                    </td>
                                    <td align="center">
                                        <?php
                                        $d=$conn->query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='5'")->fetch();
                                        echo $d[0];
                                        ?>
                                    </td>
                                    <td align="center"><?php echo $load_shipment['kota_tujuan'] ?></td>
                                    <td align="center">
                                      <?php
                                      if ($load_shipment['fee']=='0') {
                                        ?>
                                        <a href="#" data-toggle="modal" data-target="#fee<?php echo $load_shipment['no'] ?>"><font color="red">
                                          <?php echo $load_shipment['fee']; ?>
                                        </font></a>
                                        <?php
                                      }else{
                                        ?>
                                        <a href="#" data-toggle="modal" data-target="#fee<?php echo $load_shipment['no'] ?>">
                                        <?php
                                      echo $load_shipment['fee'];
                                        ?>
                                        </a>
                                        <?php
                                      }
                                      ?>
                                    </td>
                                    <td align="center">
                                        <?php
                                        $approve=$conn->query("select acc_paid from t4t_shipment where no_shipment='$no_shipment'")->fetch();
                                        if ($approve[0]=="1") {
                                            ?>
                                            <a href="#" data-toggle="modal" data-target="#paid<?php echo $load_shipment['no'] ?>"><i class="fa fa-check-square-o"></i></a>
                                            <?php
                                        }else{
                                            ?>
                                            <i class="fa fa-minus"></i>
                                            <?php
                                        }

                                        ?>
                                    </td>
                                </tr>
<!-- Modal Paid -->
<?php
include 'modal/paid-to-unpaid.php';
include 'modal/shipment-detail.php';
include 'modal/fee-update.php';
?>
<!-- end modal Paid -->
                    <?php
                    }
                    ?>
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
$('#paid_list<?php echo $load_tahun2['th'] ?>').DataTable( {
// "bJQueryUI":true,
"bPaginate":true,
"sPaginationType": "full_numbers",
"iDisplayLength":10
} );

} );
</script>
<!-- end datatable -->
                <?php }
            }
                 ?>
        </div>
        <!-- end of accordion -->
    </div>

</div>
