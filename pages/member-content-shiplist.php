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
        <a class="panel-heading" role="tab" id="heading<?php echo $load_tahun['th'] ?>" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $load_tahun['th'] ?>" aria-expanded="true" aria-controls="collapse<?php echo $load_tahun['th'] ?>">
            <h4 class="panel-title">
            <i class="fa fa-caret-square-o-down"></i>
            <?php
            echo $load_tahun['th'];
            ?>
            </h4>
        </a>
        <div id="collapse<?php echo $load_tahun['th'] ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading<?php echo $load_tahun['th'] ?>">
            <div class="panel-body">
                <table class="table table-striped responsive-utilities jambo_table" border="1" id="shipment_list<?php echo $load_tahun['th'] ?>">
                    <thead>
                        <tr>
                            <th rowspan="2"><center>BL Date<center></th>
                            <th rowspan="2"><center>No. BL</center></th>
                            <th rowspan="2"><center>Dest. City</center></th>
                            <th colspan="5"><center>Container Size</center></th>
                            <th rowspan="2"><center>Contribution Fee ($USD)</center></th>
                            <th rowspan="2"><center>Approved</center></th>
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

            $shipment=$conn->query("select * from t4t_shipment where bl_tgl like '%$th%' and id_comp='$kode' order by bl_tgl desc");
            while ($load_shipment=$shipment->fetch()) {
            ?>
                        <tr>
                            <td align="center"><?php echo $load_shipment['bl_tgl'] ?></td>

                             <?php
                            if ($load_shipment['acc']==0) {
                            ?>
                             <td align="center"><a href="?<?php echo paramEncrypt('hal=member-shipment-pending-edit&id_ship='.$load_shipment['no'].'')?>"><?php echo $load_shipment['bl'] ?></a></td>
                            <?php
                            }elseif ($load_shipment['acc']==1) {
                            ?>
                            <td align="center"><a href="#" data-toggle="modal" data-target="#myModal<?php echo $load_shipment['no'] ?>"> <?php echo $load_shipment['bl'] ?></a></td>
                            <?php } ?>

                            <td align="center"><?php echo $load_shipment['kota_tujuan'] ?></td>
                            <td align="center">
                                <?php
                                $no_shipment=$load_shipment['no_shipment']; //definisi no shipment
                                $a=$conn->query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='1'")->fetch();
                                if ($a[0]==true) {
                                  echo $a[0];
                                }else{
                                  echo "0";
                                }
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                $b=$conn->query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='2'")->fetch();
                                if ($b[0]==true) {
                                  echo $b[0];
                                }else{
                                  echo "0";
                                }
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                $c=$conn->query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='3'")->fetch();
                                if ($c[0]==true) {
                                  echo $c[0];
                                }else{
                                  echo "0";
                                }
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                $d=$conn->query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='4'")->fetch();
                                if ($d[0]==true) {
                                  echo $d[0];
                                }else{
                                  echo "0";
                                }
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                $e=$conn->query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='5'")->fetch();
                                if ($e[0]==true) {
                                  echo $e[0];
                                }else{
                                  echo "0";
                                }
                                ?>
                            </td>
                            <td align="center"><?php echo $load_shipment['fee'] ?></td>
                            <td align="center">
                                <?php
                                $approve=$conn->query("select acc from t4t_shipment where no_shipment='$no_shipment'")->fetch();
                                if ($approve[0]=="1") {
                                    ?>
                                    <i class="fa fa-check-square-o"></i>
                                    <?php
                                }else{
                                    ?>
                                    <i class="fa fa-square-o"></i>
                                    <?php
                                }

                                ?>
                            </td>
                        </tr>


            <?php
//modal
include 'modal/member-bl-detail.php';


            }
            ?>
            <!-- Datatables -->
            <script src="../js/datatables/js/jquery.dataTables.js"></script>
            <script src="../js/datatables/tools/js/dataTables.tableTools.js"></script>

            <script>
            $(function() {
            $('#shipment_list<?php echo $load_tahun['th'] ?>').DataTable( {
                    // "bJQueryUI":true,
                  "bPaginate":true,
                  "sPaginationType": "full_numbers",
                  "iDisplayLength":10
            } );

            } );
            </script>
            <!-- end datatable -->
                    </tbody>

                </table>
            </div>
            <!-- end panel body -->
        </div>
    </div>
    <!-- end panel -->


        <?php } ?>
</div>
<!-- end of accordion -->
