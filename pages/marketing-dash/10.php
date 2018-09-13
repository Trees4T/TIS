<?php
session_start();
include '../../koneksi/koneksi.php';
include '../../action/function/class.office.php';
$office = new office();

$first_shipment = $office->first_shipment();
$first_ship = date("M d, Y", strtotime($first_shipment->wkt_shipment));
$date = $_SESSION['date10'];
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

$pay_shipment = $office->mkt_dash_contrib('shipment','payment',$date);
$pay_donation = $office->mkt_dash_contrib('donation2','payment',$date);
$pay_donation2 = $office->mkt_dash_contrib('donation3','payment',$date);
$pay_sponsor  = $office->mkt_dash_contrib('sponsor','payment',$date);

$ship_shipment = $office->mkt_dash_contrib('shipment','shipment',$date);
$ship_donation = $office->mkt_dash_contrib('donation2','shipment',$date);
$ship_donation2 = $office->mkt_dash_contrib('donation3','shipment',$date);
$ship_sponsor  = $office->mkt_dash_contrib('sponsor','shipment',$date);

$pay_total    = $office->mkt_dash_contrib_total('payment',$date);
$ship_total   = $office->mkt_dash_contrib_total('shipment',$date);

//  $jml_pohon    = $office->mkt_shipments('tree',$date);

 ?>
<div class="x_panel tile" >
 <div class="x_title">
   <h2>Contributions 
   </h2>
     <br><br>
     <ul class="nav navbar-left panel_toolbox">
       <div id="reportrange10" >
           <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
           <span></span> <b class="caret"></b>
           <form class="" action="../pages/marketing-dash/link.php" method="post">
             <input type="hidden" name="datetop10" value="" class="" id="date">
             <noscript><input type="submit" value="datetop10"></noscript>
             <div class="" >
               <button type="submit" class="btn btn- red" name="button">Confirm</button>
             </div>

           </form>
       </div>
     </ul>
     <script type="text/javascript">
     $(function() {
       <?php

       if ($_SESSION['date10']!='') {
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
             $('#reportrange10 input').val(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
             $('#reportrange10 span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
         }
         $('#reportrange10').daterangepicker({
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
                <th><center>Qty Pmts</center></th>
                <th><center>Total Pmts</center></th>

            </tr>
        </thead>
        <tbody>
          <tr>
              <td>Shipments</td>
              <td align="center"><?php echo $ship_shipment->count ?></td>
              <td align="right"><?php echo $pay_shipment->fee ?></td>
          </tr>
          <tr>
              <td>Donations</td>
              <td align="center"><?php echo ($ship_donation->count)+($ship_donation2->count) ?></td>
              <td align="right"><?php echo ($pay_donation->fee)+($pay_donation2->fee) ?></td>
          </tr>
          <tr>
              <td>Sponsorships</td>
              <td align="center"><?php echo $ship_sponsor->count ?></td>
              <td align="right"><?php echo $pay_sponsor->fee ?></td>
          </tr>
          <tr class="red">
              <td>Not yet allocated</td>
              <td align="center"><?php
                        echo number_format($ship_total->count-
                                          $ship_shipment->count-
                                          $ship_donation->count-
                                          $ship_donation2->count-
                                          $ship_sponsor->count)
              ?></td>
              <td align="right"><?php
                        echo number_format($pay_total->totfee-
                                          $pay_shipment->fee-
                                          $pay_donation->fee-
                                          $pay_donation2->fee-
                                          $pay_sponsor->fee ,2)
              ?></td>
          </tr>
        </tbody>
    </table>
 </div>
</div>
