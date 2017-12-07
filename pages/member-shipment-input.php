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

       <!-- ##### Link Shipment List #####   -->
       <?php if ($_SESSION['level'] == "mkt"): ?>

         <ul class="nav navbar-right panel_toolbox"><b>
           <a href="?<?php echo paramEncrypt('hal=admoff-shipment-list')?>" data-toggle="tooltip" data-placement="left" title="Go to shipment list"><i class="fa fa-eye"></i> Go to Shipment Lists</a></b>
         </ul>

       <?php elseif($_SESSION['level'] == "part"): ?>

         <ul class="nav navbar-right panel_toolbox"><b>
           <a href="?<?php echo paramEncrypt('hal=member-shipment-list')?>" data-toggle="tooltip" data-placement="left" title="Go to shipment list"><i class="fa fa-eye"></i> Go to Shipment Lists</a></b>
         </ul>

       <?php endif; ?>
       <!-- ##### Link Shipment List #####   -->

          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
            <?php

            if ($_SESSION['success']==1) {
              $symbol ='success';
              $text   ='<strong><i class="fa fa-check-circle"></i> Success!</strong> Your shipment successfully processed.';
            }elseif ($_SESSION['success']==2) {
              $symbol ='danger';
              $text   ='<strong><i class="fa fa-warning"></i> Warning!</strong> Please input the container size. <a href="javascript:history.back()"><font color="white">UNDO <i class="fa fa-reply"></i></font></a>';
            }elseif ($_SESSION['success']==3) {
              $symbol ='danger';
              $text   ='<strong><i class="fa fa-warning"></i> Warning!</strong> Bill of Lading No. has already been taken. <a href="javascript:history.back()"><font color="white">UNDO <i class="fa fa-reply"></i></font></a>';
            }elseif ($_SESSION['success']==4) {
              $symbol ='danger';
              $text   ='<strong><i class="fa fa-warning"></i> Warning!</strong> Hang tags numbers is not valid, please check again. <a href="javascript:history.back()"><font color="white">UNDO <i class="fa fa-reply"></i></font></a>';
            }elseif ($_SESSION['success']==5) {
              $symbol ='danger';
              $text   ='<strong><i class="fa fa-warning"></i> Warning!</strong> Customer code is not filled or select another WIN Owner, please check again. <a href="javascript:history.back()"><font color="white">UNDO <i class="fa fa-reply"></i></font></a>';
            }



            if ($_SESSION['success']==true) {

            ?>
        <div class="alert alert-<?php echo $symbol ?> alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <?php echo $text ?>
        </div>
          <?php

          }


          unset($_SESSION['success']);
           ?>
          <center><h2><strong>SHIPMENT REPORT</strong></h2></center>
          <div class="ln_solid"></div>

<?php
$kode=$_SESSION['kode'];
?>

<form class="form-horizontal form-label-left" action="" method="post">
<div class="col-sm-12">
<div class="form-group">
<label class="control-label col-md-5" for="first-name">Company Name <span class="required"></span>
</label>

<!-- ##### CONDITION #####   -->
<?php if ($_SESSION['level']=="part"): ?>

<div class="col-md-4 font-hijau">
  <?php
  $company=$office->data_member($kode); //t4t_partisipan
   ?>
<label class="control-label"><?php echo $company->name ?></label>
  <input type="hidden" name="id_comp" value="<?php echo $kode; ?>" id="comp">
</div>

<?php elseif($_SESSION['level']=="mkt"): ?>

<?php $kode_comp = $_REQUEST['id_comp']; ?>
<input type="hidden" name="id_comp" value="<?php echo $kode_comp; ?>" id="comp">
<div class="col-md-4">
  <select class="form-control" name="id_comp" onchange='this.form.submit()'>
    <?php
      if ($kode_comp!="") {
      $nama_company = $office->data_member($kode_comp);//t4t_partisipan
    ?>
    <option value="<?php echo $kode_comp ?>"><?php echo $nama_company->name ?></option>
    <?php
      }else{
    ?>
    <option value="">- Choose -</option>
    <?php
      }
    ?>

    <?php
    $list_comp = $office->data_member_list();//t4t_partisipan
    ?>

    <?php
    foreach ($list_comp as $nama_comp) {
    ?>
    <option value="<?php echo $nama_comp->id ?>"><?php echo $nama_comp->name ?></option>
    <?php
    }
    ?>

  </select>
  <noscript><input type="submit" value="id_comp"></noscript>
</div>


<?php endif; ?>
<!-- ##### CONDITION #####   -->

</div>
</div>
</form>



          <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="../action/member-shipment-input.php" enctype="multipart/form-data" name="hasil">
            <font size="">

            <div class="col-sm-12">

              <input type="hidden" name="id_comp" value="<?php if($_SESSION['level']=="part"){ echo $kode; }elseif($_SESSION['level']=="mkt"){ echo $kode_comp; }  ?>" id="comp">

            <div class="form-group">
              <label class="control-label col-md-5" for="first-name">Shipment Report No.
              </label>
              <div class="col-md-4 font-hijau">

          <?php
          $tgl=date("dmy");
          if ($_SESSION['level']=="part") {
            $cek_nosh=$office->cek_nosh($kode,$tgl);
          }elseif ($_SESSION['level']=="mkt") {
            $cek_nosh=$office->cek_nosh($kode_comp,$tgl);
          }
          $no_sh=$cek_nosh->no_sh+1;
          ?>

          <?php if ($_SESSION['level']=="part"): ?>

            <label class="control-label"><?php echo $_SESSION['kode']."".$tgl."".$no_sh; ?></label>
               <input type="hidden" name="no_ship" value="<?php echo $_SESSION['kode']."".$tgl."".$no_sh ?>" >

          <?php elseif($_SESSION['level']=="mkt"): ?>
                  <?php if ($kode_comp!=""): ?>
                    <label class="control-label"><?php echo $kode_comp."".$tgl."".$no_sh; ?></label>
                       <input type="hidden" name="no_ship" value="<?php echo $kode_comp."".$tgl."".$no_sh ?>" >
                  <?php else: ?>
                    <label class="control-label red">Please choose the company name first.</label>
                  <?php endif; ?>

          <?php endif; ?>


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
                <input type="text" class="form-control" id="single_cal2" name="tglbl" required onkeydown="return false">
                <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
              </div>
            </div>



            <div class="form-group">
              <label class="control-label col-md-5" for="first-name">Order No. <span class="required red">*</span>
              </label>
              <div class="col-md-4">
                <select multiple="" class="form-control" name="order[]" id="order" required>
                <?php
                if ($_SESSION['level']=="part") {
                  $no_order=$office->order_list($kode);
                }elseif($_SESSION['level']=="mkt"){
                  $no_order=$office->order_list($kode_comp);
                }

                foreach ($no_order as $data_order) {
                ?>
                  <option><?php echo $data_order->no_order ?></option>
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
                $container = $office->container_list();
                foreach ($container as $data_container) {
                ?>
                    <tr>
                      <td><?php echo $data_container->cont ?></td>
                      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                      <td width="90px"><input type="number" class="form-control" name="cont<?php echo $data_container->no ?>" min="0"></td>
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
            // if ($_SESSION['level']=="part") {
            // $no_id=$office->data_member($kode); //t4t_partisipan
            // }elseif ($_SESSION['level']=="mkt") {
            // $no_id=$office->data_member($kode_comp); //t4t_partisipan
            // }

            if ($_SESSION['level']=="part") {
              $cek_customer=$office->cek_relation($kode); //t4t_retailer
            }elseif ($_SESSION['level']=="mkt") {
              $cek_customer=$office->cek_relation($kode_comp); //t4t_retailer
            }


            if ($cek_customer->repeat_id == true) {
            ?>

                        <div class="form-group">
                          <label class="control-label col-md-5" for="first-name">WIN Owner <span class="required"></span>
                          </label>
                          <div class="col-md-4">
                            <select class="form-control" name="relation" id="owner" onchange="win_ownerValidasi()">
                              <option value="1">Customer <i>(default)</i></option>
                              <option value="0"><?php $member=$office->data_member($kode); echo $member->name; ?> </option>
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-5" for="first-name">Customer Code <span class="required"></span>
                          </label>
                          <div class="col-md-4">
                            <select class="form-control" name="c_code" onchange="win_ownerValidasi()" id="c_code">
                              <option value="">- Choose -</option>
                              <?php
                              if ($_SESSION['level']=="part") {
                                $customer=$office->retailer_list2($kode);//t4t_retailer
                              }elseif ($_SESSION['level']=="mkt") {
                                $customer=$office->retailer_list2($kode_comp);//t4t_retailer
                              }
                              foreach ($customer as $data_customer) {
                              ?>
                              <option value="<?php echo $data_customer->repeat_id ?>"><?php echo $data_customer->repeat_id; echo " (".$data_customer->name.")"; ?></option>
                              <?php
                              } ?>
                            </select>
                          </div>
                          <span id="hasil"></span>
                        </div>



            <?php
            }
            ?>

            <?php

            if ($_SESSION['level']=="part") {
              $pic_name=$office->data_member($kode); //t4t_partisipan
            }elseif($_SESSION['level']=="mkt"){
              $pic_name=$office->data_member($kode_comp); //t4t_partisipan
            }
                 if ($pic_name->pic=="") {
                   #
                 }else{
                 ?>
            <div class="form-group">
              <label class="control-label col-md-5" for="first-name">PIC <span class="required"></span>
              </label>
              <div class="col-md-4 font-hijau">
              <label class="control-label">
                <?php echo $pic_name->pic; ?>
              </label>
                 <input type="hidden" name="pic" value="<?php echo $pic_name->pic; ?>">
              </div>
            </div>
                <?php
                }
                ?>

            <div class="form-group">
              <label class="control-label col-md-5" for="first-name">Destination City <span class="required red">*</span>
              </label>
              <div class="col-md-4">
                <input type="text" class="form-control col-md-7 col-xs-12" name="destination" onblur="win_ownerValidasi()" id="pemicu" required>
              </div>
            </div>


            <div class="form-group">
              <label class="control-label col-md-5" for="first-name">Note <span class="required"></span>
              </label>
              <div class="col-md-4">
                <textarea type="text" class="form-control" name="note"></textarea>

              </div>
            </div>

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
  <!-- end row -->

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
    <script>
    function win_ownerValidasi() {
    	$("#loaderIcon").show();
    	jQuery.ajax({
    	url: "../action/validasi_win_owner.php",
    	data:'ret='+$("#c_code").val()+'&owner='+$("#owner").val(),
    	type: "POST",
      success:function(data){
        $("#hasil").html(data);
    	},
    	error:function (){}
    	});
    }
    </script>


</body>

</html>
