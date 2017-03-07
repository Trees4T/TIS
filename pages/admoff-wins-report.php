<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>Report <small></small></h3>
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
                  <h2> WINS Report </h2>

                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />


                    <font size="">


                    <div class="col-sm-12">



                                <div class="x_content">


                                    <div class="well">

                                        <form class="form-horizontal" method="post" action="">
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
                                                            <input type="text" style="width: 200px" name="range_tanggal" id="reservation" class="form-control" value="<?php
                                                            if ($_POST['range_tanggal']=="") {
                                                               echo "01/".$bln_lalu."/".$tahun." - ";  echo $waktu;
                                                            }else{
                                                                echo $_POST['range_tanggal'];
                                                            } ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <fieldset>
                                            <div class="control-group">
                                              <label class="control-label">Status <span class="required red">*</span>
                                              </label><br>
                                              <div class="controls col-sm-3">
                                                <select class="form-control" name="status">
                                                <?php
                                                $nm_status=$_POST['status'];
                                                if ($nm_status==0) {
                                                    $nm_status="Unapproved";
                                                }elseif ($nm_status==1) {
                                                    $nm_status="Approved";
                                                }elseif ($nm_status==2) {
                                                    $nm_status="All";
                                                }

                                                    if (isset($_POST['status'])) {
                                                ?>
                                                    <option value="<?php echo $_POST['status'] ?>"> <?php echo $nm_status ?></option>
                                                <?php
                                                    }
                                                ?>
                                                <option value="1">Approved</option>
                                                <option value="0">Unapproved</option>
                                                <option value="2">All</option>

                                                </select>
                                              </div>
                                            </div>
                                            </fieldset>



                                            <br>
                                            <div class="ln_solid"></div>
                                            <div class="form-group">
                                              <div class="col-md-5 col-md-offset-5">
                                                <a href="?<?php echo paramEncrypt('hal=admoff-wins-report')?>" class="btn btn-primary">Reset</a>
                                                <button type="submit" class="btn btn-success">Submit</button>
                                              </div>
                                            </div>
                                        </form>



                                    </div>
<?php
if ($_POST['range_tanggal']==true) {



    #get tanggal
    $tanggal=$_POST['range_tanggal'];
        $exp_tanggal=explode("-", $tanggal);
        $tanggal_awal=$exp_tanggal[0];
        $tanggal_akhir=$exp_tanggal[1];

            $exp_t_awal=explode("/", $tanggal_awal);
            $nilai_t_awal=trim($exp_t_awal[2])."-".$exp_t_awal[1]."-".$exp_t_awal[0];

            $exp_t_akhir=explode("/", $tanggal_akhir);
            $nilai_t_akhir=trim($exp_t_akhir[2])."-".$exp_t_akhir[1]."-".trim($exp_t_akhir[0]);
    #end

?>
<div align="center">
<!-- <form method="post" action="../action/report/excel-tree-report.php">
<input type="hidden" name="awal" value="<?php echo $nilai_t_awal ?>">
<input type="hidden" name="akhir" value="<?php echo $nilai_t_akhir ?>">
<input type="hidden" name="member" value="<?php echo $_POST['member'] ?>">
<button type="submit" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export to Excel</button>
</form> -->
</div>
                   <table id="example" class="table table-striped responsive-utilities jambo_table" border="1" >
                                        <thead>
                                            <tr class="headings">
                                                <th><center>Participants</center> </th>
                                                <th><center>Ship Report Date</center> </th>
                                                <th><center>Shipment No.</center> </th>
                                                <!-- <th><center>BL No.</center> </th> -->
                                                <th><center>Order No.</center></th>
                                                <th><center>Wins Number</center></th>
                                                <th><center>Status Approve</center></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                            <?php
                            $sts=$_POST['status'];

                            $no=1;
                            if ($sts==1 or $sts==0) {
                                $wins_rep=$conn->query("select id_comp,wkt_shipment,no_shipment,bl,no_order,wins_used,acc,
                                    no,no,bl_tgl,item_qty,kota_tujuan,note,buyer,foto
                                     from t4t_shipment where wkt_shipment BETWEEN '$nilai_t_awal' and '$nilai_t_akhir' and acc='$sts'");
                            }elseif ($sts==2) {
                                $wins_rep=$conn->query("select id_comp,wkt_shipment,no_shipment,bl,no_order,wins_used,acc,
                                no,no,bl_tgl,item_qty,kota_tujuan,note,buyer,foto
                                 from t4t_shipment where wkt_shipment BETWEEN '$nilai_t_awal' and '$nilai_t_akhir'");
                            }

                            while ($load_shipment=$wins_rep->fetch()) {
                            //echo mysql_error();
                            $id_comp=$load_shipment[0];
                             ?>

                                <tr class="even pointer">
                                    <td align="center" width="12.5%">
                                        <?php
                                        $nama=$conn->query("select nama from t4t_partisipan where id='$id_comp'")->fetch();
                                        echo $nama[0];
                                        ?></td>
                                    <td align="center" width="7.5%"><?php echo $load_shipment[1] ?></td>
                                    <td align="center" width="7.5%"><a href="#" data-toggle="modal" data-target="#myModal<?php echo $load_shipment['no'] ?>"><?php echo $load_shipment[2] ?></a></td>
                                    <!-- <td align="center" width="7.5%"><?php echo $data[3] ?></td> -->
                                    <td align="center" width="7.5%"><textarea readonly=""><?php echo $load_shipment[4] ?></textarea></td>
                                    <td align="center" width="15%"><textarea readonly=""><?php echo $load_shipment[5] ?></textarea></td>
                                    <td align="center" width="5%"><?php
                                        if ($load_shipment[6]==1) {
                                            ?>
                                            <i class="fa fa-check-square-o"></i>
                                            <?php
                                        }else{
                                            ?>
                                            <i class="fa fa-square-o"></i>
                                            <?php
                                        }

                                    ?></td>

                                </tr>
    <!-- Modal -->
  <?php
  include 'modal/bl-detail.php';
  ?>
  <!-- end modal -->
                            <?php
                              $no++;


                            }
                             ?>

                                        </tbody>

                                    </table>
<?php
}
 ?>
                                </div>



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
                      "iDisplayLength":10
              } );

          } );
        </script>
</body>

</html>
