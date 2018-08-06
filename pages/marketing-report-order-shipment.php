<?php
$actual_link0 = "$_SERVER[REQUEST_URI]";
$actual_link1 = explode("?", $actual_link0);
$actual_link  = $actual_link1[1];

$tipe_part_list = $office->type_part_list();
$kd_part        = $_REQUEST['kd_part'];
$category       = $_REQUEST['category'];
$search         = $_REQUEST['search'];

$data_part = $office->data_member($kd_part);

$tanggal=$_POST['range_tanggal'];
  $exp_tanggal=explode("-", $tanggal);
  $tanggal_awal=$exp_tanggal[0];
  $tanggal_akhir=$exp_tanggal[1];

  $tanggal_awal2  = explode("/", $tanggal_awal);
  $tanggal_akhir2 = explode("/", $tanggal_akhir);
  $date_awal  = trim($tanggal_awal2[2]).'-'.trim($tanggal_awal2[1]).'-'.trim($tanggal_awal2[0]);
  $date_akhir = trim($tanggal_akhir2[2]).'-'.trim($tanggal_akhir2[1]).'-'.trim($tanggal_akhir2[0]);
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
                  <h2> Order & Shipment Report </h2>
                  <div class="clearfix"></div>

                </div>
                <div class="x_content">
                  <?php if (isset($_POST['btn_submit'])): ?>
                    <h3 class="green"><?php echo $data_part->name.' ' ?></h3>
                    <?php echo $tanggal ?>
                  <?php endif; ?>


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
<?php if (isset($_POST['btn_submit'])): ?>
<?php else: ?>
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


          </form>

          <form class="" action="" method="post">

            <input type="hidden" name="kd_part" value="<?php echo $kd_part ?>">
            <input type="hidden" name="link" value="<?php echo $actual_link ?>">
            <input type="hidden" name="category" value="<?php echo $category ?>">


            <!-- Kolom 2 -->
            <div class="col-md-6">
              <div class="col-md-6">
                <label class="control-label">Search by:</label>
                <select class="form-control" name="search" onchange="this.form.submit()">
                  <?php if ($search!=''): ?>
                  <option value="<?php echo $search ?>"><?php echo $search ?></option>
                  <option value="">------------------------</option>
                    <?php else: ?>
                    <option value="">- Select -</option>
                  <?php endif; ?>
                  <option value="Order No.">Orders</option>
                  <option value="Shipment No.">Shipments</option>
                  <option value="BL No.">BL</option>
                </select>
              </div>
              <label class="control-label">&nbsp;</label>
              <div class="col-md-6">
                <input type="text" name="nomor" class="form-control" value="" placeholder="Enter <?php echo $search ?>" required <?php if ($search=='') {
                  echo "disabled";
                } ?>>
              </div>
            </div>
            <div class="col-md-6">
              <label class="control-label">&nbsp;</label>
            </div>
            <!--  -->
            <?php if ($search=="Shipment No."): ?>
              <?php else: ?>
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
                    <label class="control-label">Date Range <span class="required red">*</span>
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
            <?php endif; ?>


            <div class="form-group">
              <div class="col-md-5 col-md-offset-5"><br><br><br><br><br><br><br>
                <a href="?<?php echo $actual_link ?>" class="btn btn-primary">Reset</a>
                <?php if ($kd_part): ?>
                  <button type="submit" name="btn_submit" class="btn btn-success">Submit</button>
                <?php endif; ?>

              </div>
            </div>
          </form>
      </div>
<?php endif; ?>
  </div>

  <?php if (isset($_POST['btn_submit'])): ?>

    <form class="" action="../action/report/excel-report-mkt-supplier.php" method="post">
      <div class="" align="center">
        <input type="hidden" name="kd_part" value="<?php echo $kd_part ?>">
        <input type="hidden" name="date_awal" value="<?php echo $date_awal ?>">
        <input type="hidden" name="date_akhir" value="<?php echo $date_akhir ?>">
        <input type="hidden" name="alamat" value="<?php echo $data_part->address ?>">
        <input type="hidden" name="part" value="<?php echo $data_part->name ?>">
        <input type="hidden" name="search" value="<?php echo $_POST[search] ?>">
        <input type="hidden" name="nomor" value="<?php echo $_POST[nomor] ?>">

        <button type="submit" class="btn btn-success" name="button"><i class="fa fa-file-excel-o"></i> Export to Excel</button>
      </div>
    </form>

  <!-- Table -->
  <table id="example" class="table table-striped responsive-utilities jambo_table" width='100%'>
      <thead>
          <tr class="headings">
              <th><center>Order No.</center></th>
              <th><center>Order Date</center> </th>
              <th><center>Stuffing Date</center> </th>
              <th><center>Hang Tags</center></th>
              <th><center><?php if ($search=="Shipment No." or $search=="BL No."): ?>
                WIN Used
                <?php else: ?>
                WIN
              <?php endif; ?></center></th>
              <th><center>Shipment Date</th>
              <th><center>Shipment No.</th>
              <th><center>BL No.</th>
          </tr>
      </thead>

      <tbody>
      <?php
      $nomor = $_POST[nomor];
      $no=1;
      $mkt_report = $office->mkt_rep_order_ship($kd_part,$date_awal,$date_akhir,$search,$nomor);
      foreach ($mkt_report as $mkt_reports) {
      ?>
      <tr class="even pointer">
        <td width='15%'><?php
        ## no order
          if ($search=='Shipment No.') {
            $ex_order = explode(",", $mkt_reports->no_order);
            $count    = count($ex_order);
            for ($i=0; $i < $count ; $i++) {
              if ($i==0) {
                # code...
              }else{
                echo "<hr>";
              }

              echo $ex_order[$i];

            }
          }else{
            echo $mkt_reports->no_order;
          }

          ?></td>
        <td width='10%'>
          <?php
          ## wkt order
          if ($search=='Shipment No.') {
            for ($i=0; $i < $count ; $i++) {

              ${'detail_order'.$i} = $office->report_ordership_detail($kd_part,$search,trim($ex_order[$i]));
                if ($i==0) {
                  # code...
                }else{
                  echo "<hr>";
                }
                echo ${'detail_order'.$i}->wkt_order;
            }

          }else{
            echo $mkt_reports->wkt_order;
          }

          ?></td>
        <td width='10%'>
          <?php
          ### stuffing date
          if ($search=='Shipment No.') {
            for ($i=0; $i < $count ; $i++) {
              ${"stuffing".$i} = $office->report_ordership_orderwkt(trim($ex_order[$i]));
              if ($i==0) {
                # code...
              }else{
                if (${"stuffing".$i}->wkt_kirim==false) {
                  # code...
                }else{
                echo "<hr>";
                }
              }
              echo ${"stuffing".$i}->wkt_kirim;
            }
          }else{
            echo $mkt_reports->wkt_kirim;
           }
          ?></td>
        <td width='8%' align='right'>
          <?php
          ## Hang Tags
          if ($search=='Shipment No.') {
            for ($i=0; $i < $count ; $i++) {
              ${"hangtags".$i} = $office->report_ordership_hangtags(trim($ex_order[$i]));
              if ($i==0) {
                # code...
              }else{
                if (${"hangtags".$i}->jml_wins==false) {
                  # code...
                }else{
                echo "<hr>";
                }
              }
              echo ${"hangtags".$i}->jml_wins;
            }
          }else{
            echo $mkt_reports->jml_wins;
          }


          ?></td>
        <td width='12%'>
          <?php
          if ($search=='Shipment No.') {
            echo '<textarea readonly style="width:100%" rows="8">'.$mkt_reports->wins_used.'</textarea>';
          }else{
            echo $mkt_reports->wins1.' to '.$mkt_reports->wins2;
          }

          ?>
        </td>

        <?php
        if ($search=='Shipment No.') {
          # code...
        }else{
          $count=0;
          $count2=0;
          $count3=0;

          $ship_detail = $office->report_ordership_detail($kd_part,$search,$mkt_reports->no_order);
        }

        ?>
        <td width='12%'>
          <?php
          //wkt_shipment
          if ($search=='Shipment No.') {
            echo $mkt_reports->wkt_shipment;
          }else{
            if ($ship_detail==true) {
              foreach ($ship_detail as $ship_details) {
                $count=$count+1;
                if ($count=='1') {
                  echo $ship_details->wkt_shipment;
                }else{
                  echo "<hr>";
                  echo $ship_details->wkt_shipment;
                }

              }
            }else{
              echo "<center>-</center>";
            }
          }



          ?>
        </td>

        <td width='17%'>
        <?php
        //no shipment
        if ($search=='Shipment No.') {
          echo $mkt_reports->no_shipment;
        }else{
          if ($ship_detail==true) {
            foreach ($ship_detail as $ship_details) {
              $count2=$count2+1;
              if ($count2=='1') {
                echo $ship_details->no_shipment.'<br>';
              }else{
                echo "<br><hr>";
                echo $ship_details->no_shipment.'<br>';
              }

            }

          }else{
            echo "<center>-</center>";
          }
        }
        ?>
        </td>
        <td width='16%'>
          <?php
          //bl
          if ($search=='Shipment No.') {
            echo $mkt_reports->bl;
          }else{
            if ($ship_detail==true) {
              foreach ($ship_detail as $ship_details) {
                $count3=$count3+1;
                if ($count3=='1') {
                  echo $ship_details->bl.'<br>';
                }else{
                  echo "<br><hr>";
                  echo $ship_details->bl.'<br>';
                }

              }

            }else{
              echo "<center>-</center>";
            }
          }
          ?>
        </td>
      </tr>

      <?php
      $no++;
      if ($search=="Shipment No.") {
        // $total_hang = $office-
        # code...
      }else{
        $total_hang[]=$mkt_reports->jml_wins;
      }

      }
      ?>
    </tbody>
    <tfoot>
       <tr class="font-hijau">
           <td colspan="3">TOTAL</td>
           <td align="right" class="font-hijau"><b><?php echo $total_win=number_format(array_sum($total_win),0) ?></b></td>
           <td colspan="5"></td>
  <?php $_SESSION['total_phn']=$total_win ?>
       </tr>
   </tfoot>
  </table>
<?php endif; ?>
            <!-- #END# Table -->

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

    <!-- Datatables -->

    <script src="../js/datatables/js/jquery.dataTables.js"></script>
    <script src="../js/datatables/tools/js/dataTables.tableTools.js"></script>

    <script>
      $(function() {
          $('#example').DataTable( {
                    // "bJQueryUI":true,
                  "bPaginate":true,
                  "sPaginationType": "full_numbers",
                  "iDisplayLength":10,
                  "aaSorting": [[1, "asc"]]
          } );

      } );
    </script>
</body>

</html>
