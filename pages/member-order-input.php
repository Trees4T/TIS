<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>Order <small></small></h3>
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
                  <h2><i class="fa fa-plus-circle"></i> New Order </h2>

          <!-- ##### CONDITION #####   -->
           <?php if ($_SESSION['level'] == "mkt"): ?>

            <ul class="nav navbar-right panel_toolbox"><b>
              <a href="?<?php echo paramEncrypt('hal=admoff-order-list')?>" data-toggle="tooltip" data-placement="left" title="Go to order lists"><i class="fa fa-eye"></i> Go to Order Lists</a></b>
            </ul>

          <?php else: ?>

            <ul class="nav navbar-right panel_toolbox"><b>
              <a href="?<?php echo paramEncrypt('hal=member-order-list')?>" data-toggle="tooltip" data-placement="left" title="Go to order lists"><i class="fa fa-eye"></i> Go to Order Lists</a></b>
            </ul>

          <?php endif; ?>
          <!-- ##### CONDITION #####   -->

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
                    <strong><i class="fa fa-check-circle"></i> Success!</strong> Thank you for your order.
                </div>
                  <?php
                  }

                  unset($_SESSION['success']);
                   ?>

                  <center><h2><strong>ORDER HANG TAGS / WINS </strong></h2></center>
                  <div class="ln_solid"></div>
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="../action/member-order-input.php">
                    <font size="">


                    <div class="col-sm-12">
                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Order No.
                      </label>
                      <div class="col-md-4 font-hijau">
                        <?php
                        date_default_timezone_set('Asia/Jakarta');
                        $bln=date("m");
                        $thn=date("Y");

                        $order_no=$office->cek_no_order($bln,$thn);

                        $ex_order=explode("/", $order_no->no_order);
                        $gen_order=$ex_order[0]+1;

                         ?>
                         <label class="control-label"><?php  echo $gen_order."/T4T-E/".$bln."/".$thn; ?></label>
                         <input type="hidden" name="no_order" value="<?php echo $gen_order."/T4T-E/".$bln."/".$thn; ?>" >
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-5 " for="first-name">Company Name <span class="required"></span>
                      </label>

                      <!-- ##### CONDITION #####   -->
                      <?php if ($_SESSION['level']=="part"): ?>

                        <div class="col-md-4 font-hijau">
                          <?php
                          $kode=$_SESSION['kode'];
                          $comp_name=$office->data_member($kode); //t4t_partisipan
                          ?>
                          <label class="control-label"><?php echo $comp_name->name; ?></label>
                          <input type="hidden" name="comp" value="<?php echo $comp_name->name; ?>" >
                        </div>

                      <?php elseif($_SESSION['level']=="mkt"): ?>

                        <div class="col-md-4">
                          <select class="form-control" name="comp">
                            <option value="">- Choose -</option>
                            <?php
                            $list_comp = $office->data_member_list();//t4t_partisipan
                            ?>

                            <?php
                            foreach ($list_comp as $nama_comp) {
                            ?>
                            <option value="<?php echo $nama_comp->id?>"><?php echo $nama_comp->name ?></option>
                            <?php
                            }
                            ?>

                          </select>
                        </div>

                      <?php endif; ?>
                      <!-- ##### CONDITION #####   -->



                    </div>

                    <div class="col-md-2"></div>
                    <div class="form-group col-md-8" align="center">
                      <table id="table-container">
                        <thead>
                        <tr>
                          <th rowspan="2"></th>
                          <th colspan="5" width="50%"><center>Container Size</center></th>
                          <th rowspan="2"><center>Planned Stuffing Date</center></th>
                        </tr>
                        <tr>
                          <th><center>20'</center></th>
                          <th><center>40'</center></th>
                          <th><center>40' HC</center></th>
                          <th><center>45'</center></th>
                          <th><center>60'</center></th>
                        </tr>
                        </thead>
                        <tbody>
                          <td><input type="" name="qty" value="QTY" class="form-control" readonly=""></td>
                          <td><input type="number" name="n201" class="form-control" min="0"></td>
                          <td><input type="number" name="n401" class="form-control" min="0"></td>
                          <td><input type="number" name="n40hc1" class="form-control" min="0"></td>
                          <td><input type="number" name="n451" class="form-control" min="0"></td>
                          <td><input type="number" name="n601" class="form-control" min="0"></td>
                          <td><input type="text" name="tgl1" class="form-control" id="datepicker" required=""></td>
                          <td><a class="btn btn-danger" onclick="deleteRow1(this)" value="delete" id="delete1" data-toggle="" data-placement="right" title="Delete"><i class="fa fa-times"></i></a></td>

                        </tbody>
                      </table>
                      <div align="right">
                     <!-- ADD -->
                      <!-- <a class="btn btn-success" onclick="addField()"><i class="fa fa-plus"></i> Add</a> -->
                      <input type="hidden" id="forinput" name="forinput" value="1" >

                      </div>
                    </div>
                    <div class="col-md-2"></div>

                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Type of Product <span class="required red">*</span>
                      </label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="type_prod" id="" required>

                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Wood Species <span class="required"></span>
                      </label>
                      <div class="col-md-4">
                        <ul class="to_do">
                        <?php
                        $wood=$office->pohon_list();
                        foreach ($wood as $data_pohon) {

                         ?>
                            <li>
                                <p><input type="checkbox" class="flat" name="item[]" value="<?php echo $data_pohon->id_pohon ?>"> <?php echo $data_pohon->nama_pohon ?> </p>
                            </li>
                        <?php
                        }
                         ?>
                        </ul>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name"> Quantity Hang Tags Requested <span class="required red">*</span>
                      </label>
                      <div class="col-md-2">
                        <input type="number" class="form-control" min="1" name="tags" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Other Requests <span class="required"></span>
                      </label>
                      <div class="col-md-4 control-label">
                        <table>
                          <thead>
                            <th>Request</th>
                            <th></th>
                            <th>Qty</th>
                          </thead>
                          <tbody>
                          <?php
                          $other=$office->req_list();

                          foreach ($other as $data_other) {
                           ?>
                            <tr>
                              <td><?php echo $data_other->item ?></td>
                              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                              <td width="80px"><input type="number" class="form-control" name="req<?php echo $data_other->no ?>" min="0"></td>
                            </tr>
                          <?php
                           }
                           ?>
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Destination City <span class="required"></span>
                      </label>
                      <div class="col-md-4">
                        <input type="text" class="form-control col-md-7 col-xs-12" name="destination" >
                      </div>
                    </div>

                    <?php
                      $pic_name=$office->data_member($kode);  //t4t_partisipan
                       if ($pic_name->pic=="") {
                         #none
                       }else{
                       ?>
                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">PIC <span class="required"></span>
                      </label>
                      <div class="col-md-4 font-hijau">

                      <label class="control-label">
                        <?php echo $pic_name->pic ?>
                      </label>

                         <input type="hidden" name="pic" value="<?php echo $pic_name->pic; ?>">
                      </div>
                    </div>
                    <?php
                        } ?>



                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-5 col-md-offset-5">
                        <a href="?<?php echo paramEncrypt('hal=member-order-input')?>" class="btn btn-primary">Reset</a>
                        <button type="submit" class="btn btn-success">Submit</button>
                      </div>
                    </div>
                    </div>

                    </font>
                  </form>


                </div>
              </div>
            </div>
          </div>

          <?php
          include '../js/riojs.php';
         // include '../layout/js.php';

           ?>
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
    <!-- knob -->
    <script src="../js/knob/jquery.knob.min.js"></script>
    <!-- range slider -->
    <script src="../js/ion_range/ion.rangeSlider.min.js"></script>
    <!-- color picker -->
    <script src="../js/colorpicker/bootstrap-colorpicker.min.js"></script>
    <script src="../js/colorpicker/docs.js"></script>

    <!-- image cropping -->
    <script src="../js/cropping/cropper.min.js"></script>
    <script src="../js/cropping/main2.js"></script>
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

</body>

</html>
