<?php
$id_ship=$_SESSION['id_ship'];
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
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><i class="fa fa-edit"></i> Edit Shipment </h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <a href="?<?php echo paramEncrypt('hal=member-shipment-list')?>" data-toggle="tooltip" data-placement="left" title="See shipment list"><i class="fa fa-eye"></i> Shipment Lists</a>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                    <?php
                  if ($_SESSION['success']==1) {
                    ?>
                <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong><i class="fa fa-check-circle"></i> Success!</strong> Your shipment <?php echo $_SESSION['no_shipment'] ?> successfully updated.
                </div>
                  <?php
                  }

                  if($_SESSION['success']==2){
                  ?>
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong><i class="fa fa-warning"></i> Warning!</strong> Sorry maximum upload size 200kb. <a href="javascript:history.back()"><font color="white">UNDO <i class="fa fa-reply"></i></font></a>
                </div>
                  <?php
                  }
                  if($_SESSION['success']==3){
                  ?>
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong><i class="fa fa-warning"></i> Warning!</strong> Bill of Lading No. has already been taken. <a href="javascript:history.back()"><font color="white">UNDO <i class="fa fa-reply"></i></font></a>
                </div>
                  <?php
                  }

                  unset($_SESSION['success']);
                  unset($_SESSION['no_shipment']);
                   ?>
                  <center><h2><strong>SHIPMENT REPORT</strong></h2></center>
                  <div class="ln_solid"></div>
                  <?php if ($edit==1): ?>
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="../action/edit-buyer-shipment.php" enctype="multipart/form-data">
                      <font size="">
                    <?php else: ?>
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="../action/member-shipment-edit.php" enctype="multipart/form-data">
                      <font size="">
                  <?php endif; ?>
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="../action/member-shipment-edit.php" enctype="multipart/form-data">
                    <font size="">


                    <div class="col-sm-12">
                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Shipment Report No.
                      </label>
                      <div class="col-md-4 font-hijau">
<?php
$kode=$_SESSION['kode'];
$data=$conn->query("select * from t4t_shipment where no='$id_ship'")->fetch();

?>
                      <label class="control-label"><?php echo $data['no_shipment']; ?></label>
                       <input type="hidden" name="no_ship" value="<?php echo $data['no_shipment']; ?>" >
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Bill of Lading No. <span class="required red">*</span>
                      </label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="bl" value="<?php echo $data['bl'] ?>" required <?php if ($edit==1) {
                          echo "readonly"; } ?>>

                      </div>
                    </div>

                    <?php
                    $tanggal=$data['bl_tgl'];
                    $ex_tgl=explode("-", $tanggal);
                    $tanggal_bl=$ex_tgl[2]."/".$ex_tgl[1]."/".$ex_tgl[0];
                     ?>

                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Bill of Lading Date <span class="required red">*</span>
                      </label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="single_cal2" name="tglbl" value="<?php echo $tanggal_bl ?>" required <?php if ($edit==1) {
                          echo "readonly"; } ?>>
                        <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Order No. <span class="required"></span>
                      </label>
                      <div class="col-md-4">
                      <div class="font-hijau">
                      <?php
                       $no_ordership=$conn->query("select no_order from t4t_shipment where no='$id_ship'")->fetch();

                       ?>
                       <label class="control-label"><?php echo $no_ordership[0]; ?></label>
                       </div>

                        <select multiple="" class="form-control" name="order[]" <?php if ($edit==1) { echo "readonly"; } ?>>
<?php

$no_order=$conn->query("select no_order from t4t_order where id_comp='$kode' and acc=1 order by no desc");
while ($data_order=$no_order->fetch()) {

?>

                          <option><?php echo $data_order[0] ?></option>

<?php
}
 ?>
                        </select>

                      </div><br>
                      <p>Select the option if you want to change Order No.</p>
                      <p>To select multiple options, press Ctrl (windows) / Command (Mac) button while selecting the Order.</p>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Hang Tag numbers used <span class="required red">*</span>
                      </label>ex : 2,100,5-10,11-30
                      <div class="col-md-4">
                        <textarea type="text" class="form-control" name="wins_used" required <?php if ($edit==1) { echo "readonly"; } ?>><?php echo $data['wins_used'] ?></textarea>
                        <br>

                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Company Name <span class="required"></span>
                      </label>
                      <div class="col-md-4 font-hijau">
                        <?php

                        $company=$conn->query("select name from t4t_participant where id='$kode'")->fetch();

                         ?>
                         <label class="control-label"><?php echo $company[0]; ?></label>
                          <input type="hidden" name="id_comp" value="<?php echo $kode; ?>" >
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Required <span class="required"></span>
                      </label>
                      <div class="col-md-4">
                        <table>
                          <thead>
                            <th>Container</th>
                            <th></th>
                            <th>Qty</th>
                          </thead>
                          <tbody>
<?php
$no=1;
$container=$conn->query("select * from t4t_container");
while ($data_container=$container->fetch()) {
  $no_sh=$data['no_shipment'];
  $cont=$conn->query("select jml from t4t_ordercontainer where no_order='$no_sh' and no_cont='$no'")->fetch();

 ?>
                            <tr>
                              <td><?php echo $data_container[1] ?></td>
                              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                              <td width="90px"><input type="number" class="form-control" name="cont<?php echo $data_container[0] ?>" min="0" value="<?php echo $cont[0] ?>" <?php if ($edit==1) { echo "readonly"; } ?>></td>
                            </tr>
<?php
$no++;
}
 ?>
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name"> Items QTY  <span class="required red">*</span>
                      </label>
                      <div class="col-md-2">
                        <input type="number" class="form-control" min="0" name="item_qty" value="<?php echo $data['item_qty'] ?>" required <?php if ($edit==1) { echo "readonly"; } ?>>
                      </div>
                    </div>

                    <?php
                        $pic_name=$conn->query("select pic from t4t_participant where id='$kode'")->fetch();
                         if ($pic_name[0]=="") {
                           #
                         }else{
                         ?>
                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">PIC <span class="required"></span>
                      </label>
                      <div class="col-md-4 font-hijau">
                      <label class="control-label">
                        <?php echo $pic_name[0]; ?>
                      </label>
                         <input type="hidden" name="pic" value="<?php echo $pic_name[0]; ?>">
                      </div>
                    </div>
                    <?php
                    }
                    ?>

                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Destination City <span class="required red">*</span>
                      </label>
                      <div class="col-md-4">
                        <input type="text" class="form-control col-md-7 col-xs-12" name="destination" value="<?php echo $data['kota_tujuan'] ?>" required <?php if ($edit==1) { echo "readonly"; } ?>>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Note <span class="required"></span>
                      </label>
                      <div class="col-md-4">
                        <textarea type="text" class="form-control" name="note" <?php if ($edit==1) { echo "readonly"; } ?>><?php echo $data['note'] ?></textarea>

                      </div>
                    </div>
                    <?php
                    if ($_SESSION['level']=="part") {
                      $cek_customer=$office->cek_relation($kode); //t4t_retailer
                    }


                    if ($cek_customer->repeat_id == true) {
                    ?>

                                <div class="form-group">
                                  <label class="control-label col-md-5" for="first-name">Customer Code <span class="required"></span>
                                  </label>
                                  <div class="col-md-4">
                                    <select class="form-control" name="c_code">
                                      <?php
                                      $cek_buyer = $office->cek_ship_relation_buyer($data['no_shipment']);
                                      $nama_buyer= $office->nama_relation_buyer($kode,$cek_buyer->buyer);

                                      if ($cek_buyer->buyer==true): ?>
                                          <option value="<?php echo $cek_buyer->buyer ?>"><?php echo $cek_buyer->buyer; echo " (".$nama_buyer->name.")"; ?></option>
                                        <?php else: ?>
                                          <option value="">- Choose -</option>
                                      <?php endif; ?>

                                      <?php
                                      if ($_SESSION['level']=="part") {
                                        $customer=$office->retailer_list2($kode);//t4t_retailer
                                      }
                                      foreach ($customer as $data_customer) {
                                      ?>
                                      <option value="<?php echo $data_customer->repeat_id ?>"><?php echo $data_customer->repeat_id; echo " (".$data_customer->name.")"; ?></option>
                                      <?php
                                      } ?>
                                    </select>

                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-5" for="first-name">WIN Owner <span class="required"></span>
                                  </label>
                                  <div class="col-md-4">
                                    <select class="form-control" name="relation">
                                      <?php

                                      if ($cek_buyer->relation==1): ?>
                                          <option value="1"><?php echo $cek_buyer->buyer; echo " (".$nama_buyer->name.")"; ?></option>
                                        <?php else: ?>
                                          <option value="0"><?php $member=$office->data_member($kode); echo $member->name; ?> <i>(default)</i></option>
                                      <?php endif; ?>
                                      <option value="0"><?php $member=$office->data_member($kode); echo $member->name; ?> <i>(default)</i></option>
                                      <option value="1">Customer (new update)</option>
                                    </select>
                                  </div>
                                </div>

                    <?php
                    }
                    ?>


                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Bill of Lading copy attached <span class="required"></span>
                      </label>
                      <div class="col-md-4">
                        <input type="file" class="form-control col-md-7 col-xs-12" name="bl_files" <?php if ($edit==1) { echo "readonly"; } ?>>
                        <?php
                        $foto=$data['foto'];
                        $ex_foto=explode("-", $foto);
                        ?>
                        <a href="" data-toggle="modal" data-target="#img-bl-attatch"><?php  echo $ex_foto[2] ?></a>
                        <?php
                        if ($foto=="") {
                            echo "no attached file found.";
                          }
                        ?><br>
                        <!-- <p class="red">*maximum upload size 200kb.</p> -->
                      </div>
                    </div>

                    <?php include 'modal/img-bl-attatch.php'; ?>



                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <?php if ($edit==1): ?>
                          <div class="col-md-5 col-md-offset-5">

                            <button type="submit" name="edit-buyer" class="btn btn-warning">Update</button>
                          </div>
                        <?php else: ?>
                          <div class="col-md-5 col-md-offset-5">
                            <a href="?<?php echo paramEncrypt('hal=member-shipment-pending-edit')?>" class="btn btn-primary">Reset</a>
                            <button type="submit" class="btn btn-success">Submit</button>
                          </div>
                      <?php endif; ?>

                    </div>
                    </div>

                    </font>
                  </form>
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

    <!-- chart js -->
    <script src="../js/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="../js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="../js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="../js/icheck/icheck.min.js"></script>
    <script src="../js/custom.js"></script>
    <!-- daterangepicker -->
    <script type="text/javascript" src="../js/moment/moment.min.js"></script>
    <script type="text/javascript" src="../js/datepicker/daterangepicker.js"></script>
    <!-- input mask -->
    <script src="../js/input_mask/jquery.inputmask.js"></script>
    <!-- pace -->
    <script src="../js/pace/pace.min.js"></script>
     <!-- PNotify -->
    <script type="text/javascript" src="../js/notify/pnotify.core.js"></script>
    <script type="text/javascript" src="../js/notify/pnotify.buttons.js"></script>
    <script type="text/javascript" src="../js/notify/pnotify.nonblock.js"></script>

    <script type="text/javascript">
        var permanotice, tooltip, _alert;
        $(function () {
            new PNotify({
                title: "Info",
                type: "info",
                text: " <font color='red'>*</font> is required field.",
                addclass: "stack-bottomright",
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
    <!-- input_mask -->
    <script>
        $(document).ready(function () {
            $(":input").inputmask();
        });
    </script>
    <!-- /input mask -->
    <!-- ion_range -->
    <script>
        $(function () {
            $("#range_27").ionRangeSlider({
                type: "double",
                min: 1000000,
                max: 2000000,
                grid: true,
                force_edges: true
            });
            $("#range").ionRangeSlider({
                hide_min_max: true,
                keyboard: true,
                min: 0,
                max: 5000,
                from: 1000,
                to: 4000,
                type: 'double',
                step: 1,
                prefix: "$",
                grid: true
            });
            $("#range_25").ionRangeSlider({
                type: "double",
                min: 1000000,
                max: 2000000,
                grid: true
            });
            $("#range_26").ionRangeSlider({
                type: "double",
                min: 0,
                max: 10000,
                step: 500,
                grid: true,
                grid_snap: true
            });
            $("#range_31").ionRangeSlider({
                type: "double",
                min: 0,
                max: 100,
                from: 30,
                to: 70,
                from_fixed: true
            });
            $(".range_min_max").ionRangeSlider({
                type: "double",
                min: 0,
                max: 100,
                from: 30,
                to: 70,
                max_interval: 50
            });
            $(".range_time24").ionRangeSlider({
                min: +moment().subtract(12, "hours").format("X"),
                max: +moment().format("X"),
                from: +moment().subtract(6, "hours").format("X"),
                grid: true,
                force_edges: true,
                prettify: function (num) {
                    var m = moment(num, "X");
                    return m.format("Do MMMM, HH:mm");
                }
            });
        });
    </script>
    <!-- /ion_range -->
    <!-- knob -->
    <script>
        $(function ($) {

            $(".knob").knob({
                change: function (value) {
                    //console.log("change : " + value);
                },
                release: function (value) {
                    //console.log(this.$.attr('value'));
                    console.log("release : " + value);
                },
                cancel: function () {
                    console.log("cancel : ", this);
                },
                /*format : function (value) {
                 return value + '%';
                 },*/
                draw: function () {

                    // "tron" case
                    if (this.$.data('skin') == 'tron') {

                        this.cursorExt = 0.3;

                        var a = this.arc(this.cv) // Arc
                            ,
                            pa // Previous arc
                            , r = 1;

                        this.g.lineWidth = this.lineWidth;

                        if (this.o.displayPrevious) {
                            pa = this.arc(this.v);
                            this.g.beginPath();
                            this.g.strokeStyle = this.pColor;
                            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, pa.s, pa.e, pa.d);
                            this.g.stroke();
                        }

                        this.g.beginPath();
                        this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, a.s, a.e, a.d);
                        this.g.stroke();

                        this.g.lineWidth = 2;
                        this.g.beginPath();
                        this.g.strokeStyle = this.o.fgColor;
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                        this.g.stroke();

                        return false;
                    }
                }
            });

            // Example of infinite knob, iPod click wheel
            var v, up = 0,
                down = 0,
                i = 0,
                $idir = $("div.idir"),
                $ival = $("div.ival"),
                incr = function () {
                    i++;
                    $idir.show().html("+").fadeOut();
                    $ival.html(i);
                },
                decr = function () {
                    i--;
                    $idir.show().html("-").fadeOut();
                    $ival.html(i);
                };
            $("input.infinite").knob({
                min: 0,
                max: 20,
                stopper: false,
                change: function () {
                    if (v > this.cv) {
                        if (up) {
                            decr();
                            up = 0;
                        } else {
                            up = 1;
                            down = 0;
                        }
                    } else {
                        if (v < this.cv) {
                            if (down) {
                                incr();
                                down = 0;
                            } else {
                                down = 1;
                                up = 0;
                            }
                        }
                    }
                    v = this.cv;
                }
            });
        });
    </script>
    <!-- /knob -->

</body>

</html>
