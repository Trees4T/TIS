<?php
$kode=$id_member;
$nama_member=$conn->query("select name from t4t_participant where id='$kode'")->fetch();

$actual_link0 = "$_SERVER[REQUEST_URI]";
$actual_link1 = explode("?", $actual_link0);
$actual_link  = $actual_link1[1];


?>
<div class="">
<div class="page-title">
            <div class="title_left">
              <h3>Shipment List <span class='badge bg-green'><font color='white'> <?php echo $pil_th ?></font></span>
                <br>
                <small>
                <a href="?<?php echo paramEncrypt('hal=member-shipment-list&id_member='.$kode.'') ?>" data-toggle="tooltip" data-placement="bottom" title="Go to <?php echo $nama_member[0] ?> shipment list">
                  <br>
                <i class="fa fa-arrow-circle-left"></i> Back</a></small>

              </h3>
            </div>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

              </div>
            </div>
          </div>


    <div class="x_panel">
      <?php

      if ($_SESSION['success']==1) {
        $symbol ='success';
        $text   ="<strong><i class='fa fa-check-circle'></i> Success!</strong> Your shipment with BL. No <b>".$_SESSION['bl']."</b> successfully updated.";
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
      }elseif ($_SESSION['success']==6) {
        $symbol ='danger';
        $text   ="<strong><i class='fa fa-warning'></i> Warning!</strong> Failed to update shipment with BL. No <b>".$_SESSION['bl']."</b>. Customer code is not filled or select another WIN Owner, please check again. ";
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

      unset($_SESSION['bl']);
      unset($_SESSION['success']);
      ?>
          <div class="x_content">

          <!-- tabel -->
          <table class="table table-striped responsive-utilities jambo_table" border="1" id="list">
              <thead>
                  <tr>
                      <th rowspan="2" width="100px"><center>BL Date<center></th>
                      <th rowspan="2"><center>No. BL</center></th>
                      <th rowspan="2"><center>Dest. City</center></th>
                      <th colspan="5"><center>Container Size</center></th>
                      <th rowspan="2"><center>Contribution Fee ($USD)</center></th>
                      <th rowspan="2"><center>Approved</center></th>
                      <th rowspan="2"><center>Retailer</center></th>
                      <th rowspan="2"><center>Payment</center></th>
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

      $shipment=$conn->query("select * from t4t_shipment where bl_tgl like '%$pil_th%' and id_comp='$kode' order by bl_tgl desc");
      while ($load_shipment=$shipment->fetch()) {
      ?>
                  <tr>
                      <td align="center"><?php echo $load_shipment['bl_tgl'] ?></td>

                       <?php
                      if ($load_shipment['acc']==0) {
                      ?>
                       <!-- <td align="center"><a href="?<?php //echo paramEncrypt('hal=member-shipment-pending-edit&id_ship='.$load_shipment['no'].'')?>"><?php //echo $load_shipment['bl'] ?></a></td> -->
                       <td align="center"><a href="#" data-toggle="modal" data-target="#myModal<?php echo $load_shipment['no'] ?>"> <?php echo $load_shipment['bl'] ?></a></td>
                      <?php
                      }elseif ($load_shipment['acc']==1) {
                      ?>
                      <td align="center"><a href="#" data-toggle="modal" data-target="#myModal<?php echo $load_shipment['no'] ?>"> <?php echo $load_shipment['bl'] ?></a></td>
                      <?php
                      }
                      ?>

                      <td align="center"><?php echo $load_shipment['kota_tujuan'] ?></td>
                      <td align="center">
                          <?php
                          $no_shipment=$load_shipment['no_shipment']; //definisi no shipment
                          $a=$conn->query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='1'")->fetch();
                          if ($a[0]==true) {
                            echo $a[0];
                          }else{
                            echo "0";
                          }
                          ?>
                      </td>
                      <td align="center">
                          <?php
                          $b=$conn->query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='2'")->fetch();
                          if ($b[0]==true) {
                            echo $b[0];
                          }else{
                            echo "0";
                          }
                          ?>
                      </td>
                      <td align="center">
                          <?php
                          $c=$conn->query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='3'")->fetch();
                          if ($c[0]==true) {
                            echo $c[0];
                          }else{
                            echo "0";
                          }
                          ?>
                      </td>
                      <td align="center">
                          <?php
                          $d=$conn->query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='4'")->fetch();
                          if ($d[0]==true) {
                            echo $d[0];
                          }else{
                            echo "0";
                          }
                          ?>
                      </td>
                      <td align="center">
                          <?php
                          $e=$conn->query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='5'")->fetch();
                          if ($e[0]==true) {
                            echo $e[0];
                          }else{
                            echo "0";
                          }
                          ?>
                      </td>
                      <td align="center"><?php echo $load_shipment['fee'] ?></td>
                      <td align="center">
                          <?php
                          $approve=$conn->query("select acc from t4t_shipment where no_shipment='$no_shipment'")->fetch();
                          if ($approve[0]=="1") {
                              ?>
                              <i class="fa fa-check-square-o"></i>
                              <?php
                          }else{
                              ?>
                              <i class="fa fa-square-o"></i>
                              <?php
                          }

                          ?>
                      </td>
                      <td align="center"><?php
                          $nama_buyer = $office->nama_relation_buyer($kode,$load_shipment['buyer']);
                          if ($nama_buyer->name=="") {
                            echo "-";
                          }else{
                            echo $nama_buyer->name;
                          }

                      ?></td>
                      <td align="center"><?php
                          if ($load_shipment['acc_paid']=="1") {
                              ?>
                              <i class="fa fa-check-square-o"></i>
                              <?php
                          }else{
                              ?>
                              <div class="font-15 red">&empty;</div>
                              <?php
                          }
                      ?></td>
                  </tr>


      <?php
  //modal
  include 'modal/member-bl-detail.php';


      }
      ?>
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
              </tbody>

          </table>
          <!-- tabel -->



            </div>

    </div>
</div>

<!-- js -->
                  </div>

    </div>
    <!-- Datatables -->
    <script src="../js/datatables/js/jquery.dataTables.js"></script>
    <script src="../js/datatables/tools/js/dataTables.tableTools.js"></script>

     <script>
      $(function() {
          $('#list').DataTable( {
                    // "bJQueryUI":true,
                  "bPaginate":true,
                  "sPaginationType": "full_numbers",
                  "iDisplayLength":10
          } );

      } );
    </script>
    <!-- end datatable -->
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
</body>

</html>
