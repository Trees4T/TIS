<?php
session_start();
include '../../koneksi/koneksi.php';
include '../../action/function/class.office.php';
$office = new office();

$first_shipment = $office->first_shipment();
$first_ship = date("M d, Y", strtotime($first_shipment->wkt_shipment)); // jika tanggal awal adalah pertama kali shipment
$date = $_SESSION['top5contrib'];
$ex_date = explode("-", $date);
$date1_format = $ex_date[0];
 $date1 = date("Y-m-d", strtotime($date1_format));
$date2_format = $ex_date[1];
 $date2 = date("Y-m-d", strtotime($date2_format));

 $today          = date("M d, Y");
 $krg30hr        = mktime(0,0,0,date("n"),date("j")-29,date("Y"));
 $last30days     = date("M d, Y", $krg30hr);

  $last30daytoday = $last30days.'-'.$today;

 ?>
<div class="x_panel tile fixed_height_320" >
 <div class="x_title">
     <h2>Top 5 Contributors from
     </h2>
     <br><br>
     <ul class="nav navbar-left panel_toolbox">
       <div id="reportrange" >

           <form class="" action="../pages/marketing-dash/link.php" method="post" id="myform">
             <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
             <span onkeyup="this.form.submit()"></span> <b class="caret"></b>

             <input type="hidden" name="datetop" value="" class="" id="hidden">
             <noscript><input type="submit" value="date"></noscript>
             <div class="" >
               <button type="submit" class="btn btn- red" name="button">Confirm</button>
             </div>

           </form>
       </div>
     </ul>
     <script type="text/javascript">
     function MyClick()
      {
       document.getElementById('myform').submit();
      }



     $(function() {
       <?php

       if ($date!='') {
         ?>
         var start = moment(<?php echo json_encode($date1) ?>);
         var end = moment(<?php echo json_encode($date2) ?>);
         <?php
       }else{
         ?>
         var start = moment(<?php echo json_encode($last30days) ?>);
         var end = moment();
         <?php
       }
        ?>

         function cb(start, end) {
             $('#reportrange input').val(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
             $('#reportrange span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
         }
         $('#reportrange').daterangepicker({
             startDate: start,
             endDate: end,
             ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
             }
         }, cb);
         cb(start, end);
     });
     </script>

     <script type="text/javascript">
     $(function() {
         $('input[name="datefilter"]').daterangepicker({
             autoUpdateInput: false,
             locale: {
                 cancelLabel: 'Clear'
             }
         });
     });
     </script>

     <div class="clearfix"></div>
 </div>

 <div class="x_content">
   <?php
     $hari_ini = date("M d, Y");
     $old_ship = $first_ship.' - '.$hari_ini; // jika yg digunakan adalah pertama kali shipment


     if ($date!='') {
       $data = $office->mkt_dash_top5contrib('5',$_SESSION['top5contrib']);
       $total = $office->mkt_dash_sumfee($_SESSION['top5contrib']);
     }else{
       $data = $office->mkt_dash_top5contrib('5', $last30daytoday);
       $total = $office->mkt_dash_sumfee($last30daytoday);
     }
      if (count($data)==0) {
        echo "No contribution on this selected date.";
      }

     foreach ($data as $datas) {
   ?>
     <div class="widget_summary" id="hasil">
       <!-- <i id="loaderIcon" class="fa fa-spinner fa-spin"></i> -->
       <div class="w_left w_45">
           <span><?php echo $datas->name; ?></span>
       </div>
       <?php
       $presentase = ($datas->fee/$total->fee)*100;
       ?>
       <div class="w_center w_35">
           <div class="progress">
               <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $presentase ?>%; " data-toggle="tooltip" title="<?php echo number_format($presentase,2)  ?>%">
                   <span class="sr-only">60% Complete</span>
               </div>
           </div>
       </div>
       <div class="w_right w_20">
           <small> <font size="2"> <i class="fa fa-dollar"></i> <?php echo number_format($datas->fee, 2); ?> </font></small>
       </div>
       <div class="clearfix"></div>
     </div>
    <?php } ?>

 </div>
</div>
