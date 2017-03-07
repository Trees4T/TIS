<?php
$kode=$id_member;
$nama_member=$conn->query("select nama from t4t_partisipan where id='$kode'")->fetch();

$actual_link0 = "$_SERVER[REQUEST_URI]";
$actual_link1 = explode("?", $actual_link0);
$actual_link  = $actual_link1[1];

$tahun_bulan = date("Y-m");

?>
<div class="">
<div class="page-title">
            <div class="title_left">
              <h3> Unpaid <small>(This Month)</small></h3>
            </div>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

              </div>
            </div>
          </div>


    <div class="x_panel">
    <div class="col-md-12">
        <div class="x_panel">
            <!-- <div class="x_title">

                <ul class="nav navbar-right panel_toolbox">

                </ul>
                <div class="clearfix"></div>
            </div> -->
            <div class="x_content">
                 <?php
        if ($_SESSION['success']==7) {
        ?>
          <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong><i class="fa fa-check-circle"></i> Success!</strong> FEE <b><?php echo $_SESSION['bl'] ?></b> has been updated.
          </div>
        <?php
        }
        if ($_SESSION['success']==3) {
        ?>
          <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong><i class="fa fa-check-circle"></i> Success!</strong> <b><?php echo $_SESSION['bl'] ?></b> has been unpaid.
          </div>
        <?php
        }
        if ($_SESSION['success']==5) {
        ?>
          <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong><i class="fa fa-check-circle"></i> Success!</strong> <b><?php echo $_SESSION['bl'] ?></b> has been paid.
          </div>
        <?php
        }
        if ($_SESSION['success']==8) {
        ?>
          <div class="alert alert-danger alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong><i class="fa fa-ban"></i> Warning!</strong> Fee <b><?php echo $_SESSION['bl'] ?></b> failed to update.
          </div>
        <?php
        }

        unset($_SESSION['success']);
        unset($_SESSION['bl']);
        ?>

                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Unpaid</a>
                        </li>


                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

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

                                        $shipment=$conn->query("select * from t4t_shipment where wkt_shipment like '%$th%' and acc_paid=0 and acc=1 and wkt_shipment like '%$tahun_bulan-%' order by wkt_shipment ");
                                        while ($load_shipment=$shipment->fetch()) {


                                        ?>
                                                    <tr>
                                                        <td align="center" width="10%"><?php echo $load_shipment['wkt_shipment'] ?></td>
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
<!-- MODAL -->
<?php
include 'modal/shipment-detail.php';
include 'modal/fee-update.php';
include 'modal/unpaid-to-paid.php';
?>
<!-- MODAL -->




                                        <?php
                                        }
                                        ?>
                                                </tbody>

                                            </table>
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


                        </div>


                </div>

            </div>
        </div>
       </div>

    </div>
</div>

<!-- js -->
                  </div>

    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <script src="../js/bootstrap.min.js"></script>
        <!-- bootstrap progress js -->
    <script src="../js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="../js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="../js/icheck/icheck.min.js"></script>
    <script src="../js/custom.js"></script>

    <!-- pace -->
    <script src="../js/pace/pace.min.js"></script>

    <!-- PNotify -->
    <script type="text/javascript" src="../js/notify/pnotify.core.js"></script>
    <script type="text/javascript" src="../js/notify/pnotify.buttons.js"></script>
    <script type="text/javascript" src="../js/notify/pnotify.nonblock.js"></script>
    <?php
      if ($_SESSION['mail']=='1') {
    ?>
    <script type="text/javascript">
        var permanotice, tooltip, _alert;
        $(function () {
            new PNotify({
                title: "Message Success",
                type: "success",
                text: " Message has been sent to <?php echo $_SESSION['company_name'] ?>",
                //addclass: "stack-bottomright",
                hide: false,
                closer: true,
                sticker: true,
                nonblock: {
                    nonblock: false
                },
                before_close: function (PNotify) {
                    // You can access the notice's options with this. It is read only.
                    //PNotify.options.text;

                    // You can change the notice's options after the timer like this:
                    PNotify.update({
                        title: PNotify.options.title + " - Enjoy your Stay",
                        before_close: null
                    });
                    PNotify.queueRemove();
                    return false;
                }
            });

        });
    </script>
    <?php

      }
      if ($_SESSION['mail']=='0') {

    ?>
    <script type="text/javascript">
        var permanotice, tooltip, _alert;
        $(function () {
            new PNotify({
                title: "Message Failed",
                type: "error",
                text: " Message could not be sent to <?php echo $_SESSION['company_name'] ?>",
                //addclass: "stack-bottomright",
                hide: false,
                closer: true,
                sticker: true,
                nonblock: {
                    nonblock: false
                },
                before_close: function (PNotify) {
                    // You can access the notice's options with this. It is read only.
                    //PNotify.options.text;

                    // You can change the notice's options after the timer like this:
                    PNotify.update({
                        title: PNotify.options.title + " - Enjoy your Stay",
                        before_close: null
                    });
                    PNotify.queueRemove();
                    return false;
                }
            });

        });
    </script>
    <?php
      }

      unset($_SESSION['mail']);
      unset($_SESSION['company_name']);
    ?>
</body>

</html>
