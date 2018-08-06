<?php
session_start();
include '../../koneksi/koneksi.php';
include '../../action/function/class.office.php';
$office = new office();

$first_shipment = $office->first_shipment();
$first_ship = date("M d, Y", strtotime($first_shipment->wkt_shipment));
$date = $_SESSION['date12'];
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
   <h2>Linked Participants</h2>
     <br><br>
     <ul class="nav navbar-left panel_toolbox">
       <div id="reportrange12" class="pull">
           <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
           <span></span> <b class="caret"></b>
           <form class="" action="../pages/marketing-dash/link.php" method="post">
             <input type="hidden" name="datetop12" value="" class="" id="date">
             <noscript><input type="submit" value="datetop12"></noscript>
             <div class="" >
               <button type="submit" class="btn btn- red" name="button">Confirm</button>
             </div>

           </form>
       </div>
     </ul>
     <script type="text/javascript">
     $(function() {
       <?php

       if ($_SESSION['date12']!='') {
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
             $('#reportrange12 input').val(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
             $('#reportrange12 span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
         }
         $('#reportrange12').daterangepicker({
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
                <th>Approved</th>
                <th>Unapproved</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Links submitted</td>
                <td><?php $acc = $office->linked_participant_count('acc',$date); echo $acc->jml ?></td>
                <td><?php $rej = $office->linked_participant_count('reject',$date); echo $rej->jml ?></td>
            </tr>
        </tbody>
    </table>
 </div>
</div>
