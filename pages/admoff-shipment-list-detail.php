<?php
$kode="MF004";
$nama_member=$conn->query("SELECT name from t4t_participant where id='$kode'")->fetch();

$actual_link0 = "$_SERVER[REQUEST_URI]";
$actual_link1 = explode("?", $actual_link0);
$actual_link  = $actual_link1[1];

?>
<div class="">
<div class="page-title">
            <div class="title_left">
              <h3>Shipment <small></small></h3>
            </div>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

              </div>
            </div>
</div>

    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-folder-open"></i> Shipment List <?php echo $kode ?>
            <small> <a href="?<?php echo paramEncrypt('hal=admoff-shipment-list-2&id_member='.$kode.'') ?>"> <?php echo $nama_member[0] ?></a>
               <span class='badge bg-green'><font color='white'> <?php echo $pil_th ?></font></span>
            </small></h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
         <?php
        if ($_SESSION['success']==1) {
        ?>
          <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong><i class="fa fa-check-circle"></i> Success!</strong> WINS Number <b><?php echo $_SESSION['bl'] ?></b> has been updated.
          </div>
        <?php
        }
        if ($_SESSION['success']==3) {
        ?>
          <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong><i class="fa fa-check-circle"></i> Success!</strong> <b><?php echo $_SESSION['bl'] ?></b> has been unapproved.
          </div>
        <?php
        }
        if ($_SESSION['success']==5) {
        ?>
          <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong><i class="fa fa-check-circle"></i> Success!</strong> <b><?php echo $_SESSION['bl'] ?></b> has been approved.
          </div>
        <?php
        }
        if ($_SESSION['success']==2) {
        ?>
          <div class="alert alert-danger alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <strong><i class="fa fa-ban"></i> Warning!</strong> WINS Number <b><?php echo $_SESSION['bl'] ?></b> failed to update.
          </div>
        <?php
        }

        unset($_SESSION['success']);
        unset($_SESSION['bl']);
        ?>

        <div class="panel-body">
            <table class="table table-striped responsive-utilities jambo_table" border="1" id="shipment_list<?php echo $load_tahun['th'] ?>">
                <thead>
                    <tr>
                        <th rowspan="2"><center>Shipping Report Date<center></th>
                        <th rowspan="2"><center>Participant Name<center></th>
                        <th rowspan="2"><center>Shipping Report No.</center></th>
                        <th rowspan="2"><center>BL No.</center></th>
                        <th colspan="5"><center>Container Size</center></th>
                        <th rowspan="2"><center>WINS Number</center></th>
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

        $shipment=$conn->query("SELECT * from t4t_shipment where wkt_shipment like '%$th%' and id_comp='$kode' and wkt_shipment like '%$pil_th%' order by wkt_shipment desc");
        while ($load_shipment=$shipment->fetch()) {

          $participant = $conn->query("SELECT name from t4t_participant where id='$kode'")->fetch();
        ?>
                    <tr>
                      <td align="center"><?php echo date("Y-m-d", strtotime($load_shipment['wkt_shipment']))  ?></td>

                      <td align="center"><?php echo $participant[0] ?></td>

                      <td align="center"><?php echo $load_shipment['no_shipment'] ?></td>

                      <td align="center"><a href="#" data-toggle="modal" data-target="#myModal<?php echo $load_shipment['no'] ?>"> <?php echo $load_shipment['bl'] ?></a></td>

                      <!-- <td align="center"><?php echo $load_shipment['kota_tujuan'] ?></td> -->
                        <td align="center">
                            <?php
                            $no_shipment=$load_shipment['no_shipment']; //definisi no shipment
                            $a=$conn->query("SELECT jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='1'")->fetch();
                            echo $a[0];
                            ?>
                        </td>
                        <td align="center">
                            <?php
                            $b=$conn->query("SELECT jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='2'")->fetch();
                            echo $b[0];
                            ?>
                        </td>
                        <td align="center">
                            <?php
                            $b=$conn->query("SELECT jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='3'")->fetch();
                            echo $b[0];
                            ?>
                        </td>
                        <td align="center">
                            <?php
                            $c=$conn->query("SELECT jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='4'")->fetch();
                            echo $c[0];
                            ?>
                        </td>
                        <td align="center">
                            <?php
                            $d=$conn->query("SELECT jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='5'")->fetch();
                            echo $d[0];
                            ?>
                        </td>
                        <td align="center"><a href="#" data-toggle="modal" data-target="#win<?php echo $load_shipment['no'] ?>"><i class="fa fa-search-plus"></i>View and Edit</a> </td>
                        <td align="center">
                            <?php
                            $approve=$conn->query("SELECT acc from t4t_shipment where no_shipment='$no_shipment'")->fetch();
                            if ($approve[0]=="1") {
                                ?>
                                <a href="#" data-toggle="modal" data-target="#acc1<?php echo $load_shipment['no'] ?>"><i class="fa fa-check-square-o"></i></a>
                                <?php
                            }else{
                                ?>
                                <a href="#"  data-toggle="modal" data-target="#acc0<?php echo $load_shipment['no'] ?>"><i class="fa fa-square-o"></i></a>
                                <?php
                            }

                            ?>
                        </td>
                    </tr>

<!-- Modal -->
<?php
include 'modal/admoff-bl-detail.php';

if ($_SESSION['level']=='admoff') {
  include 'modal/admoff-win-edit.php';
  include 'modal/admoff-acc-to-unacc.php';
  include 'modal/admoff-unacc-to-acc.php';
}elseif ($_SESSION['level']=='mkt') {
  # code...
}

?>
<!-- end modal -->






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
              $('#shipment_list<?php echo $load_tahun['th'] ?>').DataTable( {
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
    <!-- textarea resize -->
    <script src="../js/textarea/autosize.min.js"></script>
    <script>
      autosize($('.resizable_textarea'));
    </script>
    <!-- daterangepicker -->
    <script type="text/javascript" src="../js/moment/moment.min.js"></script>
    <script type="text/javascript" src="../js/datepicker/daterangepicker.js"></script>
    <!-- pace -->
    <script src="../js/pace/pace.min.js"></script>

    <!-- datepicker -->
    <script type="text/javascript">
        $(document).ready(function () {

            var cb = function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange_right span').html(start.format('D MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY'));
                //alert("Callback has fired: [" + start.format('D MMMM, YYYY') + " to " + end.format('D MMMM, YYYY') + ", label = " + label + "]");
            }

            var optionSet1 = {
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: '12/31/2015',
                dateLimit: {
                    days: 60
                },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'right',
                buttonClasses: ['btn btn-default'],
                applyClass: 'btn-small btn-primary',
                cancelClass: 'btn-small',
                format: 'DD/MM/YYYY',
                separator: ' to ',
                locale: {
                    applyLabel: 'Submit',
                    cancelLabel: 'Clear',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            };

            $('#reportrange_right span').html(moment().subtract(29, 'days').format('D MMMM, YYYY') + ' - ' + moment().format('D MMMM, YYYY'));

            $('#reportrange_right').daterangepicker(optionSet1, cb);

            $('#reportrange_right').on('show.daterangepicker', function () {
                console.log("show event fired");
            });
            $('#reportrange_right').on('hide.daterangepicker', function () {
                console.log("hide event fired");
            });
            $('#reportrange_right').on('apply.daterangepicker', function (ev, picker) {
                console.log("apply event fired, start/end dates are " + picker.startDate.format('D MMMM, YYYY') + " to " + picker.endDate.format('D MMMM, YYYY'));
            });
            $('#reportrange_right').on('cancel.daterangepicker', function (ev, picker) {
                console.log("cancel event fired");
            });

            $('#options1').click(function () {
                $('#reportrange_right').data('daterangepicker').setOptions(optionSet1, cb);
            });

            $('#options2').click(function () {
                $('#reportrange_right').data('daterangepicker').setOptions(optionSet2, cb);
            });

            $('#destroy').click(function () {
                $('#reportrange_right').data('daterangepicker').remove();
            });

        });
    </script>
    <!-- datepicker -->
    <script type="text/javascript">
        $(document).ready(function () {

            var cb = function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange span').html(start.format('D MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY'));
                //alert("Callback has fired: [" + start.format('D MMMM, YYYY') + " to " + end.format('D MMMM, YYYY') + ", label = " + label + "]");
            }

            var optionSet1 = {
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: '12/31/2015',
                dateLimit: {
                    days: 60
                },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'left',
                buttonClasses: ['btn btn-default'],
                applyClass: 'btn-small btn-primary',
                cancelClass: 'btn-small',
                format: 'DD/MM/YYYY',
                separator: ' to ',
                locale: {
                    applyLabel: 'Submit',
                    cancelLabel: 'Clear',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            };
            $('#reportrange span').html(moment().subtract(29, 'days').format('D MMMM, YYYY') + ' - ' + moment().format('D MMMM, YYYY'));
            $('#reportrange').daterangepicker(optionSet1, cb);
            $('#reportrange').on('show.daterangepicker', function () {
                console.log("show event fired");
            });
            $('#reportrange').on('hide.daterangepicker', function () {
                console.log("hide event fired");
            });
            $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
                console.log("apply event fired, start/end dates are " + picker.startDate.format('D MMMM, YYYY') + " to " + picker.endDate.format('D MMMM, YYYY'));
            });
            $('#reportrange').on('cancel.daterangepicker', function (ev, picker) {
                console.log("cancel event fired");
            });
            $('#options1').click(function () {
                $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
            });
            $('#options2').click(function () {
                $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
            });
            $('#destroy').click(function () {
                $('#reportrange').data('daterangepicker').remove();
            });
        });
    </script>
    <!-- /datepicker -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#single_cal1').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_1"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
            $('#single_cal2').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_2"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
            $('#single_cal3').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_3"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
            $('#single_cal4').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_4"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#reservation').daterangepicker(null, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
            });
        });
    </script>
    <!-- /datepicker -->
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
