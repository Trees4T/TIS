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
