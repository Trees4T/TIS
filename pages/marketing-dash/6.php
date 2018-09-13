<?php
session_start();
include '../../koneksi/koneksi.php';
include '../../action/function/class.office.php';
$office = new office();
$today          = date("Y-m-d");
$krg30hr        = mktime(0,0,0,date("n"),date("j")-29,date("Y"));
$last30days     = date("Y-m-d", $krg30hr);

$date = $_SESSION['date6'];
$ex_date = explode("-", $date);
$date1_format = $ex_date[0];
 $date1 = date("Y-m-d", strtotime($date1_format));
$date2_format = $ex_date[1];
 $date2 = date("Y-m-d", strtotime($date2_format));


  if ($date=='') {
    $start    = (new DateTime($last30days))->modify('first day of this month');
    $end      = (new DateTime($today))->modify('first day of next month');
    $month1 = date("F Y", strtotime($last30days));
    $month2 = date("F Y", strtotime($today));
    $m1 = date("m", strtotime($last30days));
    $m2 = date("m", strtotime($today));
    $y1 = date("Y", strtotime($last30days));
    $y2 = date("Y", strtotime($today));
  }else{
    $start    = (new DateTime($date1))->modify('first day of this month');
    $end      = (new DateTime($date2))->modify('first day of next month');
    $month1 = date("F Y", strtotime($date1));
    $month2 = date("F Y", strtotime($date2));
    $m1 = date("m", strtotime($date1));
    $m2 = date("m", strtotime($date2));
    $y1 = date("Y", strtotime($date1));
    $y2 = date("Y", strtotime($date2));
  }

  $interval = DateInterval::createFromDateString('1 month');
  $period   = new DatePeriod($start, $interval, $end);

  $i=1;
  foreach ($period as $dt) {
       ${'bulan'.$i} = $dt->format("M-y");
       $tanggal = date("Y-m", strtotime($dt->format("M Y")) );
       ${'win'.$i}   = $office->mkt_dash_wins_ordered($tanggal);
      $i++;
  }


  //jumlah bar berdasarkan bulan
   $year_dif = ($y2-$y1);
    if ($year_dif==0) {
      $selisih_month = ($m2-$m1)+1;
    }else{
      $selisih_month = (12*$year_dif)+(($m2-$m1)+1);
    }


?>

<div class="x_panel tile fixed_height_390">
    <div class="x_title">
        <h2>WINs Ordered 
        </h2>
        <br><br>
        <ul class="nav navbar-left panel_toolbox">
          <div id="reportrange6" class="pull-right">
              <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
              <span></span> <b class="caret"></b>
              <form class="" action="../pages/marketing-dash/link.php" method="post">
                <input type="hidden" name="datetop6" value="" class="" id="date">
                <noscript><input type="submit" value="datetop6"></noscript>
                <div class="" >
                  <button type="submit" class="btn btn- red" name="button">Confirm</button>
                </div>

              </form>
          </div>
        </ul>
        <script type="text/javascript">
        $(function() {
          <?php

          if ($_SESSION['date6']!='') {
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
                $('#reportrange6 input').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                $('#reportrange6 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
            $('#reportrange6').daterangepicker({
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
      <canvas id="mybarChart" class="fixed_height_390"></canvas>

    </div>
</div>

<script type="text/javascript">
var ctx = document.getElementById("mybarChart");
var mybarChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [
        <?php
          for ($i=1; $i <= $selisih_month ; $i++) {
            echo "'".${'bulan' . $i}."',";
          }
        ?>
    ],
      datasets: [
        {
          label: 'Qty of WINs',
          backgroundColor: "#26B99A",
          data: [
            <?php
              for ($i=1; $i <= $selisih_month ; $i++) {
                $a=${'win'.$i}->win;

                echo "'".$a."',";
              }
            ?>
          ]
        },
       ]
      },

    options:{
      scales:{
        yAxes:[{
          ticks:{
              beginAtZero:true
          }
        }]
      }
    }
});
</script>
