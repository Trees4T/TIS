<?php

$actual_link0 = "$_SERVER[REQUEST_URI]";
$actual_link1 = explode("?", $actual_link0);
$actual_link  = $actual_link1[1];
?>
<div class="">
<div class="page-title">
            <div class="title_left">
              <h3>Order<small></small></h3>
            </div>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

              </div>
            </div>
          </div>
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-folder-open"></i> Unapproved Order <i>(All)</i> <small></small></h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
        <?php
        if ($_SESSION['success']==1) {
        ?>
          <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong><i class="fa fa-check-circle"></i> Success!</strong> WINS Number <?php echo $_SESSION['order'] ?> has been updated.
          </div>
        <?php
        }
        if ($_SESSION['success']==3) {
        ?>
          <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong><i class="fa fa-check-circle"></i> Success!</strong> <?php echo $_SESSION['order'] ?> has been unapproved.
          </div>
        <?php
        }
        if ($_SESSION['success']==5) {
        ?>
          <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong><i class="fa fa-check-circle"></i> Success!</strong> <?php echo $_SESSION['order'] ?> has been approved.
          </div>
        <?php
        }
        if ($_SESSION['success']==2) {
        ?>
          <div class="alert alert-danger alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong><i class="fa fa-ban"></i> Warning!</strong> WINS Number <?php echo $_SESSION['order'] ?> failed to update.
          </div>
        <?php
        }

        unset($_SESSION['success']);
        unset($_SESSION['order']);
        ?>
        <table class="table table-striped responsive-utilities jambo_table" border="1" id="unorder">
                                <thead>
                                    <tr>
                                        <th><center>Order Date<center></th>
                                        <th><center>No. Order</center></th>
                                        <th><center>Hang Tags Requested</center></th>
                                        <th><center>WINS Number</center></th>
                                        <th><center>Company name</center></th>
                                        <th><center>Approved</center></th>
                                    </tr>
                                </thead>

                                <tbody>
                        <?php
                        $bulan = date("m");

                        $order=$conn->query("SELECT a.no, a.wkt_order, a.no_order, a.jml_wins, a.acc, a.tipe_prod, a.wins1, a.wins2, a.kota_tujuan, a.id_comp, b.name
                        FROM t4t_order a JOIN t4t_participant b
                        ON a.id_comp=b.id
                        WHERE a.acc=0 ");

                        while ($load_order=$order->fetch()) {
                            $id_order=$load_order['no'];
                            $kode    =$load_order['id_comp'];

                        ?>
                                    <tr>
                                        <td align="center"><?php echo $load_order['wkt_order'] ?></td>

                                         <td align="center"><a href="#" data-toggle="modal" data-target="#myModal<?php echo $load_order['no'] ?>"><?php echo $load_order['no_order'] ?></a></td>
                                        <td align="center">
                                            <?php
                                            $no_order=$load_order['no_order']; //definisi no order
                                            $htag=$conn->query("select jml_wins from t4t_order where no_order='$no_order'")->fetch();
                                            echo $htag[0];
                                            ?>
                                        </td>
                                        <td align="center">
                                            <a href="#" data-toggle="modal" data-target="#win<?php echo $load_order['no'] ?>"><?php echo $load_order['wins1'].' to '.$load_order['wins2'] ?></a>
                                        </td>
                                        <td align="center">
                                            <?php
                                            echo $load_order['name']
                                            ?>
                                        </td>

                                        <td align="center">
                                            <?php
                                            $approve=$conn->query("select acc from t4t_order where no_order='$no_order'")->fetch();
                                            if ($approve[0]=="1") {
                                                ?>
                                                <a href="#" data-toggle="modal" data-target="#acc1<?php echo $load_order['no'] ?>"><i class="fa fa-check-square-o"></i></a>
                                                <?php
                                            }else{
                                                ?>
                                                <a href="#" data-toggle="modal" data-target="#acc0<?php echo $load_order['no'] ?>"><i class="fa fa-square-o"></i></a>
                                                <?php
                                            }

                                            ?>
                                        </td>
                                    </tr>

 <?php
 include 'modal/admoff-no-order.php';
 include 'modal/admoff-win-range.php';
 include 'modal/admoff-order-acc-0.php';
 include 'modal/admoff-order-acc-1.php';
 ?>

 <script>
 function wins_range<?php echo $id_order ?>(){
   var x = $(".x<?php echo $id_order ?>").val();
   var y = $(".y<?php echo $id_order ?>").val();
   z= parseInt(x)+parseInt(y)-1;
   $(".z<?php echo $id_order ?>").val(z);
 }
 </script>

                        <?php
                        }
                        ?>
                                </tbody>

                            </table>

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

        <!-- chart js -->
        <script src="../js/chartjs/chart.min.js"></script>
        <!-- bootstrap progress js -->
        <script src="../js/progressbar/bootstrap-progressbar.min.js"></script>
        <script src="../js/nicescroll/jquery.nicescroll.min.js"></script>
        <!-- icheck -->
        <script src="../js/icheck/icheck.min.js"></script>

        <script src="../js/custom.js"></script>

        <!-- pace -->
        <script src="../js/pace/pace.min.js"></script>
        <!-- Datatables -->
        <script src="../js/datatables/js/jquery.dataTables.js"></script>
        <script src="../js/datatables/tools/js/dataTables.tableTools.js"></script>

         <script>
          $(function() {
              $('#unorder').DataTable( {
                        // "bJQueryUI":true,
                      "bPaginate":true,
                      "sPaginationType": "full_numbers",
                      "iDisplayLength":10
              } );

          } );
        </script>
        <!-- end datatable -->
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
    <!-- wins range js -->

</body>

</html>
