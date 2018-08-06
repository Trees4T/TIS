<?php
session_start();
include '../../koneksi/koneksi.php';
include '../../action/function/class.office.php';
$office = new office();

$first_shipment = $office->first_shipment();
$first_ship = date("M d, Y", strtotime($first_shipment->wkt_shipment));
$date = $_SESSION['date8'];
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

  $order_rec  = $office->mkt_order_jml_order('recieved',$date);
  $wins_rec   = $office->mkt_order_jml_wins('recieved',$date);
  $order_ship = $office->mkt_order_jml_order('shipped',$date);
  $wins_ship  = $office->mkt_order_jml_wins('shipped',$date);




 ?>
<div class="x_panel tile" >
 <div class="x_title">
     <h2>Orders from
     </h2>
     <br><br>
     <ul class="nav navbar-left panel_toolbox">
       <div id="reportrange8" >
           <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
           <span></span> <b class="caret"></b>
           <form class="" action="../pages/marketing-dash/link.php" method="post">
             <input type="hidden" name="datetop8" value="" class="" id="date">
             <noscript><input type="submit" value="datetop8"></noscript>
             <div class="" >
               <button type="submit" class="btn btn- red" name="button">Confirm</button>
             </div>

           </form>
       </div>
     </ul>
     <script type="text/javascript">
     $(function() {
       <?php

       if ($_SESSION['date8']!='') {
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
             $('#reportrange8 input').val(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
             $('#reportrange8 span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
         }
         $('#reportrange8').daterangepicker({
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
                <th></th>
                <th><center>Qty Orders</center></th>
                <th><center>Qty WINs</center></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Order Recieved</td>
                <td align="center"><?php echo number_format($order_rec->jml_order) ?></td>
                <td align="center"><?php echo number_format($wins_rec->win) ?></td>
            </tr>
            <tr>
                <td>Order Shipped</td>
                <td align="center"><?php echo number_format($order_ship->jml_order) ?></td>
                <td align="center"><?php echo number_format($wins_ship->win) ?></td>
            </tr>

        </tbody>
    </table>
 </div>
</div>
