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
                  <h2> Trees Planted </h2>

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
                                            <?php
                                            if ($_SESSION['level']=='fin') {
                                            ?>
                                            <fieldset>
                                            <div class="control-group">
                                              <label class="control-label">Member <span class="required red">*</span>
                                              </label><br>
                                              <div class="controls col-sm-5">
                                                <select class="form-control" name="member">
                                                <?php
                                                if (isset($_POST['member'])) {
                                                    $id_member = $_POST['member'];
                                                    $nama0=$conn->query("select id,name from t4t_participant where id='$id_member'")->fetch();
                                                ?>
                                                   <option value="<?php echo $nama0[0] ?>"> <?php echo $nama0[1] ?></option>
                                                <?php
                                                }
                                                 ?>
                                                  <option value="null"> - Choose -</option>
                                               <?php
                                               $nama = $conn->query("select id,name from t4t_participant order by name");
                                               while ($data_nama=$nama->fetch()) {
                                               ?>
                                                  <option value="<?php echo $data_nama[0] ?>"><?php echo $data_nama[1] ?></option>
                                                <?php
                                                } ?>

                                                </select>
                                              </div>
                                            </div>
                                            </fieldset>
                                            <?php } ?>


                                            <br>
                                            <div class="ln_solid"></div>
                                            <div class="form-group">
                                              <div class="col-md-5 col-md-offset-5">
                                                <a href="?<?php echo paramEncrypt('hal=member-report-trees-planted')?>" class="btn btn-primary">Reset</a>
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
<form method="post" action="../action/report/excel-tree-report.php">
<input type="hidden" name="awal" value="<?php echo $nilai_t_awal ?>">
<input type="hidden" name="akhir" value="<?php echo $nilai_t_akhir ?>">
<input type="hidden" name="member" value="<?php echo $_POST['member'] ?>">
<button type="submit" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export to Excel</button>
</form>
</div>
                   <table id="example" class="table table-striped responsive-utilities jambo_table" border="1">
                                        <thead>
                                            <tr class="headings">
                                                <th><center>Ship Report Date</center> </th>
                                                <th><center>Shipment</center> </th>
                                                <th><center>BL Date</center> </th>
                                                <th><center>BL</center> </th>
                                                <th><center>Farmer</center></th>
                                                <th><center>Village</center></th>
                                                <!-- <th><center>Target Area</center></th>
                                                <th><center>M. Unit</center></th> -->
                                                <th><center>Trees QTY</center></th>
                                                <th><center>Retailer</center> </th>

                                            </tr>
                                        </thead>

                                        <tbody>
                            <?php
                            if ($_SESSION['level']=='fin') {
                                $kode=$_POST['member'];
                            }else{
                                $kode=$_SESSION['kode'];
                            }

                            $no=1;
                            $tree_planted=$conn->query("SELECT s.wkt_shipment,s.bl,s.id_comp,s.no,h.bl,h.jml_phn,s.bl_tgl,h.petani,h.desa,h.ta,h.mu,s.buyer,s.no_shipment from t4t_shipment s join t4t_htc h on s.bl=h.bl AND s.id_comp='$kode' and s.tgl_paid between '$nilai_t_awal' and '$nilai_t_akhir' order by h.no desc");
                            while ($data=$tree_planted->fetch()) {

                            //echo mysql_error();
                             ?>

                                <tr class="even pointer">
                                    <td class=" " align="center" width="12.5%"><?php echo date("Y-m-d", strtotime($data[0])) ?></td>
                                    <td class=" " align="center" width="12.5%"><?php echo $data[12] ?></td>
                                    <td class=" " align="center" width="12.5%"><?php echo $data[6] ?></td>
                                    <td class=" " width="12.5%"><?php echo $data[1] ?></td>
                                    <td class=" " align="center" width="12.5%"><?php echo $data[7] ?></td>
                                    <td class=" " align="center" width="12.5%"><?php echo $data[8] ?></td>
                                    <!-- <td class=" " align="center" width="12.5%"><?php echo $data[9] ?></td>
                                    <td class=" " align="center" width="12.5%"><?php echo $data[10] ?></td> -->
                                    <td class=" " align="center" width="5%"><?php echo $data[5] ?></td>
                                    <td class=" " align="center" width="5%"><?php
                                    if ($data[11]!='') {
                                        $ret=$data[11];

                                        $nama_retailer = $office->nama_retailer($_SESSION['kode'],$ret);
                                        //$nama_ret=$conn->query("SELECT retailer_name from t4t_retailer where kode_retailer='$ret'")->fetch();
                                        if ($nama_retailer->name==true) {
                                            echo $nama_retailer->name;
                                        }else{
                                            echo $ret;
                                        }

                                    }else{
                                        echo "-";
                                        } ?></td>

                                </tr>

                            <?php
                              $no++;

                              $total_tree[]=$data[5];
                            }
                             ?>
                                <tfoot>
                                    <tr class="font-hijau">
                                        <td colspan="6">TOTAL</td>
                                        <td align="center" class="font-hijau"><b><?php echo $tot_tree=number_format(array_sum($total_tree)) ?></b></td>
                                    </tr>
                                </tfoot>
                                        </tbody>
                                    <?php $_SESSION['tot_tree']=$tot_tree ?>
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
