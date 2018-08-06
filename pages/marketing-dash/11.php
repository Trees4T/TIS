<?php
session_start();
include '../../koneksi/koneksi.php';
include '../../action/function/class.office.php';
$office = new office();

$first_shipment = $office->first_shipment();
$first_ship = date("M d, Y", strtotime($first_shipment->wkt_shipment));
$date = $_SESSION['date11'];
$ex_date = explode("-", $date);
$date1_format = $ex_date[0];
 $date1 = date("Y-m-d", strtotime($date1_format));
$date2_format = $ex_date[1];
 $date2 = date("Y-m-d", strtotime($date2_format));

 $today          = date("M d, Y");
 $krg30hr        = mktime(0,0,0,date("n"),date("j")-29,date("Y"));
 $last30days     = date("M d, Y", $krg30hr);

  $last30daytoday = $last30days.'-'.$today;
if ($date=="") {
  $date=$last30daytoday;
}



 ?>
<div class="x_panel tile" >
 <div class="x_title">
   <h2>AR Status (TOP 5)</h2>
     <br><br>
     <ul class="nav navbar-left panel_toolbox">
       <div id="reportrange11" class="pull-right">
           <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
           <span></span> <b class="caret"></b>
           <form class="" action="../pages/marketing-dash/link.php" method="post">
             <input type="hidden" name="datetop11" value="" class="" id="date">
             <noscript><input type="submit" value="datetop11"></noscript>
             <div class="" >
               <button type="submit" class="btn btn- red" name="button">Confirm</button>
             </div>

           </form>
       </div>
     </ul>
     <script type="text/javascript">
     $(function() {
       <?php

       if ($_SESSION['date11']!='') {
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
             $('#reportrange11 input').val(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
             $('#reportrange11 span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
         }
         $('#reportrange11').daterangepicker({
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
   <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Participant</th>
                <th><center>30</center></th>
                <th><center>60</center></th>
                <th><center>&gt;90</center></th>
                <th><center>Total</center></th>
            </tr>
        </thead>
        <tbody>
          <?php

          $data= $office->mkt_ar_status('5',$date);
          $total = $office->mkt_ar_status_total($date);
          $no=1;
          foreach ($data as $datas) {
            ${'_30'.$no} = $office->mkt_ar_status_jumlah('5','30',$datas->id_comp,$date);
            ${'_60'.$no} = $office->mkt_ar_status_jumlah('5','60',$datas->id_comp,$date);
            ${'_90'.$no} = $office->mkt_ar_status_jumlah('5','90',$datas->id_comp,$date);
          ?>
            <tr>
                <td><?php echo $no ?></td>
                <td><?php echo $datas->name ?></td>
                <td align="center"><?php echo number_format(${'_30'.$no}->jml) ?></td>
                <td align="center"><?php echo number_format(${'_60'.$no}->jml) ?></td>
                <td align="center"><?php echo number_format(${'_90'.$no}->jml) ?></td>
                <td align="right"><?php echo number_format($datas->jml) ?></td>
            </tr>
          <?php $no++; } ?>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td align="right"><b><?php echo number_format($total->total) ?></b></td>
          </tr>
        </tbody>
    </table>
 </div>
</div>
