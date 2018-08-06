<?php
$actual_link0 = "$_SERVER[REQUEST_URI]";
$actual_link1 = explode("?", $actual_link0);
$actual_link  = $actual_link1[1];

$tipe_part_list = $office->type_part_list();
$kd_part        = $_REQUEST['kd_part'];
$category       = $_REQUEST['category'];
$search         = $_REQUEST['search'];

$data_part = $office->data_member($kd_part);
?>
<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3> <small></small></h3>
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
                  <h2> Order & Shipment Report</h2>

                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />


                    <font size="">


<div class="col-sm-12">
<div class="x_content">

<?php
if ($_SESSION['message']==2) {
?>
  <div class="alert alert-danger alert-dismissible fade in" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
  </button>
  <b><i class="fa fa-ban"></i></b> Please choose the payment status.
  </div>
<?php
}

if ($_SESSION['message']==3) {
?>
  <div class="alert alert-danger alert-dismissible fade in" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
  </button>
  <b><i class="fa fa-ban"></i></b> Please choose member.
  </div>
<?php
}

unset($_SESSION['message']);
?>

      <div class="well">
          <form class="form-horizontal" method="post" action="">
            <!-- Kolom 1 -->
            <div class="col-md-12">
              <!-- Kolom 1a -->
              <div class="col-md-3">

                <label class="control-label">Category</label>
                <select class="form-control" name="category" onchange="this.form.submit()">

                  <?php if ($category!=''): ?>
                    <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
                    <option value="">------------------------</option>
                    <?php else: ?>
                      <option value="">- Select -</option>
                  <?php endif; ?>

                  <?php
                  foreach ($tipe_part_list as $tipe_part_lists) {
                  ?>
                    <option value="<?php echo $tipe_part_lists->type; ?>"><?php echo $tipe_part_lists->type; ?></option>
                  <?php
                  }
                  ?>
                </select>
                <!-- <noscript><input type="submit" value="category"></noscript> -->
                <label class="control-label">Director</label><br>
                <?php if ($data_part->director==''): ?>
                  <?php echo "-"; ?>
                  <?php else: ?>
                  <p class="green"><?php echo $data_part->director ?></p>
                <?php endif; ?>
              </div>
              <!-- Kolom 1b -->
              <div class="col-md-4">


                <label class="control-label">Participant Name</label>
                <select class="form-control" name="kd_part" onchange="this.form.submit()">
                  <?php if ($kd_part!=''): ?>

                    <option value="<?php echo $kd_part; ?>"><?php echo $data_part->name; ?></option>
                    <option value="">------------------------</option>
                  <?php else: ?>
                      <option value="">- Select -</option>
                  <?php endif; ?>

                  <?php
                  $data_member_list = $office->data_member_list_tipe($category);
                  foreach ($data_member_list as $data_member_lists) {
                  ?>
                  <option value="<?php echo $data_member_lists->id; ?>"><?php echo $data_member_lists->name; ?></option>
                  <?php
                  }
                  ?>
                </select>
                <!-- <noscript><input type="submit" value="kd_part"></noscript> -->
                <label class="control-label">Address</label><br>
                <?php if ($data_part->address==''): ?>
                  <?php echo "-"; ?>
                  <?php else: ?>
                  <p class="green"><?php echo $data_part->address ?></p>
                <?php endif; ?>
              </div>
              <!-- Kolom 1c -->
              <div class="col-md-5">
                <label class="control-label">Part ID</label>
                <input type="text" class="form-control" name="" value="<?php echo $data_part->id ?>" disabled style="width:90px;">

                <table>
                  <tr>
                    <td><label class="control-label">Tel</label><br>
                      <?php if ($data_part->phone==''): ?>
                        <?php echo "-"; ?>
                        <?php else: ?>
                        <p class="green"><?php echo $data_part->phone ?></p>
                      <?php endif; ?>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><label class="control-label">Email</label><br>
                      <?php if ($data_part->email==''): ?>
                        <?php echo "-"; ?>
                        <?php else: ?>
                        <p class="green"><?php echo $data_part->email ?></p>
                      <?php endif; ?>
                  </tr>
                </table>
              </div>

            </div>

            <div class="col-md-12">
              <div class="col-md-6">

              <fieldset>
                  <div class="control-group">
                  <?php
                  date_default_timezone_set('Asia/Jakarta');
                  $waktu    = date("d/m/Y");
                  $tahun    = date("Y");
                  $bln_lalu = date("m")-1;
                      if ($bln_lalu=='0') {
                          $bln_lalu='12';
                          $tahun=$tahun-1;
                      }

                   ?>
                <label class="control-label">Date Range BL <span class="required red">*</span>
                </label><br>
                      <div class="controls">
                          <div class="input-prepend input-group">
                              <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                              <input type="text" style="width: 200px" name="range_tanggal" id="reservation" class="form-control" value="01/<?php echo $bln_lalu."/".$tahun; ?> - <?php echo $waktu ?>" />
                          </div>
                      </div>
                  </div>
              </fieldset>
              </div>
            </div>

            <!-- Kolom 2 -->
            <div class="col-md-6">
              <div class="col-md-6">
                <label class="control-label">Search by:</label>
                <select class="form-control" name="search" onchange="this.form.submit()">
                  <?php if ($search!=''): ?>
                  <option value="<?php echo $search ?>"><?php echo $search ?></option>
                  <?php endif; ?>
                  <option value="Orders">Orders</option>
                  <option value="Shipments">Shipments</option>
                  <option value="BL">BL</option>
                </select>
              </div>
              <label class="control-label">&nbsp;</label>
              <div class="col-md-6">
                <input type="text" name="" class="form-control" value="" placeholder="Enter <?php echo $search ?>" required>
              </div>
            </div>
            <div class="col-md-6">
              <label class="control-label">&nbsp;</label>
            </div>





          </form>

          <form class="" action="" method="post">
            <br>
            <br>
            <br>
            <br>
            <input type="hidden" name="link" value="<?php echo $actual_link ?>">

            <div class="form-group">
              <div class="col-md-5 col-md-offset-5">
                <a href="?<?php echo paramEncrypt('hal=member-report-outstanding-payment')?>" class="btn btn-primary">Reset</a>
                <button type="submit" class="btn btn-success">Submit</button>
              </div>
            </div>
          </form>
      </div>
  </div>

  <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                EXPORTABLE TABLE
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>2011/04/25</td>
                                            <td>$320,800</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->

</div>







                    </div>

                    </font>

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
    <!-- daterangepicker -->
    <script type="text/javascript" src="../js/moment/moment.min.js"></script>
    <script type="text/javascript" src="../js/datepicker/daterangepicker.js"></script>
    <!-- range slider -->
    <script src="../js/ion_range/ion.rangeSlider.min.js"></script>
    <!-- color picker -->
    <script src="../js/colorpicker/bootstrap-colorpicker.min.js"></script>
    <script src="../js/colorpicker/docs.js"></script>
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
    <!-- Jquery DataTable Plugin Js -->
    <script src="../js/datatableAdminBSB/jquery.dataTables.js"></script>
    <script src="../js/datatableAdminBSB/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../js/datatableAdminBSB/extensions/export/dataTables.buttons.min.js"></script>
    <script src="../js/datatableAdminBSB/extensions/export/buttons.flash.min.js"></script>
    <script src="../js/datatableAdminBSB/extensions/export/jszip.min.js"></script>
    <script src="../js/datatableAdminBSB/extensions/export/pdfmake.min.js"></script>
    <script src="../js/datatableAdminBSB/extensions/export/vfs_fonts.js"></script>
    <script src="../js/datatableAdminBSB/extensions/export/buttons.html5.min.js"></script>
    <script src="../js/datatableAdminBSB/extensions/export/buttons.print.min.js"></script>
    <script src="../js/datatableAdminBSB/tables/jquery-datatable.js"></script>
</body>

</html>
