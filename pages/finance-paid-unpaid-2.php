<?php
$kode=$id_member;
$nama_member=$conn->query("select nama from t4t_partisipan where id='$kode'")->fetch();

$actual_link0 = "$_SERVER[REQUEST_URI]";
$actual_link1 = explode("?", $actual_link0);
$actual_link  = $actual_link1[1];
?>
<div class="">
<div class="page-title">
            <div class="title_left">
              <h3>Paid & Unpaid <small><br><?php echo $nama_member[0] ?></small></h3>
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
        ?>

                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Unpaid</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">Paid</a>
                        </li>

                    </ul>
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
                                    <a href="?<?php echo paramEncrypt('hal=finance-paid-unpaid-detail&id_member='.$kode.'&pilih_tahun='.$load_tahun['th'].'&sts_paid=0') ?>" class="panel-heading" role="tab" id="heading<?php echo $load_tahun['th'] ?>" aria-expanded="true" aria-controls="collapse<?php echo $load_tahun['th'] ?>">
                                        <h4 class="panel-title">
                                        <i class="fa fa-caret-square-o-down"></i>

                                        <?php
                                        echo $load_tahun[0];
                                        ?>

                                        </h4>
                                    </a>

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

<!-- TAB 2 -->
<!-- TAB 2 -->
<!-- TAB 2 -->

                        <div role="tabpanel2" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                            <!-- start accordion -->
                            <div class="accordion" id="accordion2" role="tablist" aria-multiselectable="true">
                                <?php
                                $tahun2_cek=$conn->query("select substr(wkt_shipment,1,4) as th,bl_tgl,bl,kota_tujuan,fee,acc from t4t_shipment where id_comp='$kode' and acc_paid=1 and acc=1  group by th order by th desc");

                                if ($cek3=$tahun2_cek->fetch()=="") {
                                    echo "No result found.";
                                }else{
                                $tahun2=$conn->query("select substr(wkt_shipment,1,4) as th,bl_tgl,bl,kota_tujuan,fee,acc from t4t_shipment where id_comp='$kode' and acc_paid=1 and acc=1  group by th order by th desc");
                                while ($load_tahun2=$tahun2->fetch()) {

                                ?>

                                <div class="panel">
                                    <a class="panel-heading" role="tab" id="heading2<?php echo $load_tahun2['th'] ?>" href="?<?php echo paramEncrypt('hal=finance-paid-unpaid-detail&id_member='.$kode.'&pilih_tahun='.$load_tahun2['th'].'&sts_paid=1') ?>" aria-expanded="true" aria-controls="collapse2<?php echo $load_tahun2['th'] ?>">
                                        <h4 class="panel-title">
                                        <i class="fa fa-caret-square-o-down"></i>
                                        <?php
                                        echo $load_tahun2['th'];
                                        ?>
                                        </h4>
                                    </a>

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
