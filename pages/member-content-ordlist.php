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
                            <table class="table table-striped responsive-utilities jambo_table" border="1" id="order_list<?php echo $load_tahun['th'] ?>">
                                <thead>
                                    <tr>
                                        <th><center>Order Date<center></th>
                                        <th><center>No. Order</center></th>
                                        <th><center>Type Product</center></th>
                                        <th><center>Qty Wins</center></th>
                                        <th><center>Start Wins</center></th>
                                        <th><center>End Wins</center></th>
                                        <th><center>Approved</center></th>
                                    </tr>
                                </thead>

                                <tbody>
                        <?php
                        $th=$load_tahun['th'];

                        $order=$conn->query("select no,wkt_order,no_order,jml_wins,acc,tipe_prod,wins1,wins2 from t4t_order where wkt_order like '%$th%' and id_comp='$kode'");
                        while ($load_order=$order->fetch()) {
                            $id_order=$load_order['no'];

                        ?>
                                    <tr>
                                        <td align="center"><?php echo $load_order['wkt_order'] ?></td>

                                        <?php
                                        if ($load_order['acc']==0) {
                                        ?>
                                         <td align="center"><a href="?<?php echo paramEncrypt('hal=member-order-pending-edit&id_order='.$load_order['no'].'')?>"><?php echo $load_order['no_order'] ?></a></td>
                                        <?php
                                        }elseif ($load_order['acc']==1) {
                                        ?>
                                         <td align="center"><a href="#" data-toggle="modal" data-target="#myModal<?php echo $load_order['no'] ?>"><?php echo $load_order['no_order'] ?></a></td>
                                        <?php
                                        }
                                         ?>

                                         <td align="center">
                                             <?php
                                             echo $load_order['tipe_prod'];
                                             ?>
                                         </td>

                                        <td align="center">
                                            <?php
                                            echo $load_order['jml_wins'];
                                            ?>
                                        </td>

                                        <td align="center">
                                            <?php
                                            echo $load_order['wins1'];
                                            ?>
                                        </td>
                                        <td align="center">
                                            <?php
                                            echo $load_order['wins2'];
                                            ?>
                                        </td>
                                        <td align="center">
                                            <?php
                                            $approve=$conn->query("select acc from t4t_order where no_order='$no_order'")->fetch();
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
#inc
include 'modal/admoff-no-order.php';
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
          $('#order_list<?php echo $load_tahun['th'] ?>').DataTable( {
                    // "bJQueryUI":true,
                  "bPaginate":true,
                  "sPaginationType": "full_numbers",
                  "iDisplayLength":5
          } );

      } );
    </script>
    <!-- end datatable -->

                    <?php } ?>
            </div>
            <!-- end of accordion -->
