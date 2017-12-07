<?php
$kode=$id_member;
$nama_member=$conn->query("select name from t4t_participant where id='$kode'")->fetch();

$actual_link0 = "$_SERVER[REQUEST_URI]";
$actual_link1 = explode("?", $actual_link0);
$actual_link  = $actual_link1[1];
if ($sts_paid==1) {
  $nm_sts_paid = "Paid";
}else{
  $nm_sts_paid = "Unpaid";
}

?>
<div class="">
<div class="page-title">
            <div class="title_left">
              <h3><?php echo $nm_sts_paid ?> <small><br><a href="?<?php echo paramEncrypt('hal=finance-paid-unpaid-2&id_member='.$kode.'') ?>" data-toggle="tooltip" data-placement="bottom" title="Go to <?php echo $nama_member[0] ?> Paid & Unpaid list">
                <?php echo $nama_member[0] ?></a> </small>
                <span class='badge bg-green'><font color='white'> <?php echo $pil_th ?></font></span>
              </h3>
            </div>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

              </div>
            </div>
          </div>


    <div class="x_panel">
            <!-- <div class="x_title">

                <ul class="nav navbar-right panel_toolbox">

                </ul>
                <div class="clearfix"></div>
            </div> -->
            <div class="x_content">
        <?php
        if ($_SESSION['success']==9) {
        ?>
          <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong><i class="fa fa-check-circle"></i> Success!</strong> Payment Date <b><?php echo $_SESSION['ship'] ?></b> has been updated.
          </div>
        <?php
        }
        if ($_SESSION['success']==7) {
        ?>
          <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong><i class="fa fa-check-circle"></i> Success!</strong> FEE <b><?php echo $_SESSION['ship'] ?></b> has been updated.
          </div>
        <?php
        }
        if ($_SESSION['success']==3) {
        ?>
          <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong><i class="fa fa-check-circle"></i> Success!</strong> <b><?php echo $_SESSION['ship'] ?></b> has been unpaid.
          </div>
        <?php
        }
        if ($_SESSION['success']==5) {
        ?>
          <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong><i class="fa fa-check-circle"></i> Success!</strong> <b><?php echo $_SESSION['ship'] ?></b> has been paid.
          </div>
        <?php
        }
        if ($_SESSION['success']==2) {
        ?>
          <div class="alert alert-danger alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong><i class="fa fa-ban"></i> Warning!</strong> WINS Number <b><?php echo $_SESSION['ship'] ?></b> failed to update.
          </div>
        <?php
        }


        unset($_SESSION['success']);
        unset($_SESSION['bl']);

        if ($sts_paid==0) {

        ?>

          <!-- tabel -->
          <table class="table table-striped responsive-utilities jambo_table" border="1" id="list">
              <thead>
                  <tr>
                      <th rowspan="2" width="10%"><center>Shipment Date<center></th>
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
      $th=$pil_th;
      $shipment=$conn->query("select * from t4t_shipment where wkt_shipment like '%$th%' and id_comp='$kode' and acc_paid='$sts_paid' order by wkt_shipment desc");
      while ($load_shipment=$shipment->fetch()) {


      ?>
                  <tr>
                      <td align="center" width="10%"><?php echo date("Y-m-d", strtotime($load_shipment['wkt_shipment']))  ?></td>

                      <td align="center">
                        <a href="#" data-toggle="modal" data-target="#detail<?php echo $load_shipment['no'] ?>">
                              <?php echo $load_shipment['no_shipment'] ?>
                        </a>
                      </td>
                      <td align="">
                        <?php
                        if ($load_shipment['no_order']!="") {
                          echo $load_shipment['no_order'];
                        }else{
                          echo "-";
                        }

                        ?>
                      </td>
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
                              <a href="#" data-toggle="modal" data-target="#unpaid<?php echo $load_shipment['no'] ?>"><div class="font-15 red">&empty;</div></a>
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
          <!-- tabel -->
          <?php }else{ ?>
          <!-- tabel 2 -->
          <table class="table table-striped responsive-utilities jambo_table" border="1" id="list">
              <thead>
                  <tr>
                      <th rowspan="2" width="10%"><center>Shipment Date<center></th>
                      <th rowspan="2"><center>Shipment No.</center></th>
                      <th rowspan="2"><center>Order No.</center></th>
                      <th colspan="5"><center>Container Size</center></th>
                      <th rowspan="2"><center>Dest. City</center></th>
                      <th rowspan="2"><center>Fee</center></th>
                      <th rowspan="2"><center>Payment Date</center></th>
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
      $th=$pil_th;

      $shipment=$conn->query("select * from t4t_shipment where wkt_shipment like '%$th%' and id_comp='$kode' and acc_paid='$sts_paid' order by wkt_shipment desc");
      while ($load_shipment=$shipment->fetch()) {


      ?>
                  <tr>
                      <td align="center" width="10%"><?php echo date("Y-m-d", strtotime($load_shipment['wkt_shipment']))  ?></td>
                      <td align="center">
                        <a href="#" data-toggle="modal" data-target="#detail<?php echo $load_shipment['no'] ?>">
                              <?php echo $load_shipment['no_shipment'] ?>
                        </a>
                      </td>
                      <td align="">
                        <?php
                        if ($load_shipment['no_order']!="") {
                          echo $load_shipment['no_order'];
                        }else{
                          echo "-";
                        }

                        ?>
                      </td>
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
                          if ($load_shipment['tgl_paid']=='0000-00-00') {
                            ?>
                            <a href="#" data-toggle="modal" data-target="#paydate<?php echo $load_shipment['no'] ?>">
                            <?php
                            echo '<font color="red">'.$load_shipment['tgl_paid'].'</font>';
                            ?>
                            </a>
                            <?php
                          }else{
                            ?>
                            <a href="#" data-toggle="modal" data-target="#paydate<?php echo $load_shipment['no'] ?>">
                            <?php
                            echo $load_shipment['tgl_paid'];
                            ?>
                            </a>
                            <?php
                        } ?>
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
include 'modal/fin-payment-date.php';

?>
<!-- end modal Paid -->
      <?php
      }
      ?>
              </tbody>

          </table>
          <!-- tabel 2 -->
          <?php } ?>


            </div>

    </div>
</div>

<!-- js -->
                  </div>

    </div>
    <!-- Datatables -->
    <script src="../js/datatables/js/jquery.dataTables.js"></script>
    <script src="../js/datatables/tools/js/dataTables.tableTools.js"></script>

     <script>
      $(function() {
          $('#list').DataTable( {
                    // "bJQueryUI":true,
                  "bPaginate":true,
                  "sPaginationType": "full_numbers",
                  "iDisplayLength":10
          } );

      } );
    </script>
    <!-- end datatable -->
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
