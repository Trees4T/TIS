<?php

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
                  <h2><i class="fa fa-plus-circle"></i> New Shipment </h2>
                  <ul class="nav navbar-right panel_toolbox"><b>
                    <a href="?<?php echo paramEncrypt('hal=member-shipment-list')?>" data-toggle="tooltip" data-placement="left" title="Go to shipment list"><i class="fa fa-eye"></i> Go to Shipment Lists</a></b>
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
                    <strong><i class="fa fa-check-circle"></i> Success!</strong> Your shipment successfully processed.
                </div>
                  <?php
                  }

                  if($_SESSION['success']==2){
                  ?>
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong><i class="fa fa-warning"></i> Warning!</strong> Please input the container size. <a href="javascript:history.back()"><font color="white">UNDO <i class="fa fa-reply"></i></font></a>
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

                  if($_SESSION['success']==4){
                  ?>
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong><i class="fa fa-warning"></i> Warning!</strong> Hang tags numbers is not valid, please check again. <a href="javascript:history.back()"><font color="white">UNDO <i class="fa fa-reply"></i></font></a>
                </div>
                  <?php
                  }

                  unset($_SESSION['success']);
                   ?>
                  <center><h2><strong>SHIPMENT REPORT</strong></h2></center>
                  <div class="ln_solid"></div>
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="../action/member-shipment-input.php" enctype="multipart/form-data">
                    <font size="">


                    <div class="col-sm-12">
                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Shipment Report No.
                      </label>
                      <div class="col-md-4 font-hijau">
<?php
$kode=$_SESSION['kode'];

$tgl=date("dmy");
$cek_nosh=$conn->query("select floor(substr(no_shipment,12,10)) as no_sh from t4t_shipment where id_comp='$kode' and no_shipment like '%$tgl%' order by no_sh desc limit 1")->fetch();
$no_sh=$cek_nosh[0]+1;
?>
                    <label class="control-label"><?php echo $_SESSION['kode']."".$tgl."".$no_sh; ?></label>
                       <input type="hidden" name="no_ship" value="<?php echo $_SESSION['kode']."".$tgl."".$no_sh ?>" >
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Bill of Lading No. <span class="required red">*</span>
                      </label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="bl" required>

                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Bill of Lading Date <span class="required red">*</span>
                      </label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" id="single_cal2" name="tglbl" required>
                        <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Company Name <span class="required"></span>
                      </label>
                      <div class="col-md-4 font-hijau">
                        <?php

                        $company=$conn->query("select nama from t4t_partisipan where id='$kode'")->fetch();
                         ?>
                      <label class="control-label"><?php echo $company[0]; ?></label>
                          <input type="hidden" name="id_comp" value="<?php echo $kode; ?>" id="comp">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Order No. <span class="required red">*</span>
                      </label>
                      <div class="col-md-4">
                        <select multiple="" class="form-control" name="order[]" id="order" required>
<?php

$no_order=$conn->query("select no_order from t4t_order where id_comp='$kode' and acc=1 order by no desc");
while ($data_order=$no_order->fetch()) {

?>
                          <option><?php echo $data_order[0] ?></option>
<?php
}
 ?>
                        </select>

                      </div>
                      <p>To select multiple options, press Ctrl (windows) / Command (Mac) button while selecting the Order.</p>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Hang Tag Numbers Used <span class="required red">*</span>
                      <br>
                      </label>ex : 2,100,5-10,11-30
                      <!-- <i id="loaderIcon" class="fa fa-spinner fa-spin"></i> -->
                      <div class="col-md-4">
                        <textarea type="text" class="form-control" name="wins_used" id="wins_used" onBlur="cekValidasi()" required></textarea>
                      <span id="status"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-5">Required <span class="required red">*</span>
                      </label>
                      <div class="col-md-4 control-label">
                        <table>
                          <thead>
                            <th><center>Container</center></th>
                            <th></th>
                            <th><center>Qty</center></th>
                          </thead>
                          <tbody>


<?php
$container=$conn->query("select * from t4t_container");
while ($data_container=$container->fetch()) {
 ?>
                            <tr>
                              <td><?php echo $data_container[1] ?></td>
                              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                              <td width="90px"><input type="number" class="form-control" name="cont<?php echo $data_container[0] ?>" min="0"></td>
                            </tr>
<?php
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
                        <input type="number" class="form-control" min="0" name="item_qty" required>
                      </div>
                    </div>

                    <?php
                        $pic_name=$conn->query("select pic from t4t_partisipan where id='$kode'")->fetch();
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
                        <input type="text" class="form-control col-md-7 col-xs-12" name="destination" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Note <span class="required"></span>
                      </label>
                      <div class="col-md-4">
                        <textarea type="text" class="form-control" name="note"></textarea>

                      </div>
                    </div>
<?php
$no_id=$conn->query("select no from t4t_partisipan where id='$kode'")->fetch();
$cek_customer=$conn->query("select kode_retailer from t4t_retailer where id_partisipan='$no_id[0]'");

if ($cek=$cek_customer->fetch()==true) {


 ?>
                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Customer Code <span class="required"></span>
                      </label>
                      <div class="col-md-4">
                        <select class="form-control" name="c_code">
                          <option value="">- Choose -</option>
      <?php
      $customer=$conn->query("select kode_retailer,retailer_name from t4t_retailer where id_partisipan='$no_id[0]'");
      while ( $data_customer=$customer->fetch()) {
      ?>
                          <option value="<?php echo $data_customer[0] ?>"><?php echo $data_customer[0]; echo " (".$data_customer[1].")"; ?></option>
    <?php
    } ?>
                        </select>

                      </div>
                    </div>

<?php
}
?>

                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Bill of Lading copy attached <span class="required red">*</span>
                      </label>
                      <div class="col-md-4">
                        <input type="file" class="form-control col-md-7 col-xs-12" name="bl_files" required>
                       <!--  <p class="red">*maximum upload size 200kb.</p> -->
                      </div>
                    </div>





                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-5 col-md-offset-5">
                        <a href="?<?php echo paramEncrypt('hal=member-shipment-input')?>" class="btn btn-primary">Reset</a>
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
    <script>
    function cekValidasi() {
    	$("#loaderIcon").show();
    	jQuery.ajax({
    	url: "../action/check_validity.php",
    	data:'wins_used='+$("#wins_used").val()+'&order='+$("#order").val()+'&comp='+$("#comp").val(),
    	type: "POST",
    	success:function(data){
    		$("#status").html(data);
    		$("#loaderIcon").hide();
    	},
    	error:function (){}
    	});
    }
    </script>


</body>

</html>
