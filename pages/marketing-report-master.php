<?php
  $url = $office->get_actual_link();
?>
<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3> <small></small></h3>
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
            <h2> <?php echo $report ?> </h2>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">
            <?php

            $actual_link0 = "$_SERVER[REQUEST_URI]";
            $actual_link1 = explode("?", $actual_link0);
            $actual_link  = $actual_link1[1];

            $tipe_part_list = $office->type_part_list();
            $kd_part        = $_REQUEST['kd_part'];
            $category       = $_REQUEST['category'];
            $search         = $_REQUEST['search'];

            $data_part = $office->data_member($kd_part);

            $tanggal=$_POST['range_tanggal'];
              $exp_tanggal=explode("-", $tanggal);
              $tanggal_awal=$exp_tanggal[0];
              $tanggal_akhir=$exp_tanggal[1];

              $tanggal_awal2  = explode("/", $tanggal_awal);
              $tanggal_akhir2 = explode("/", $tanggal_akhir);
              $date_awal  = trim($tanggal_awal2[2]).'-'.trim($tanggal_awal2[1]).'-'.trim($tanggal_awal2[0]);
              $date_akhir = trim($tanggal_akhir2[2]).'-'.trim($tanggal_akhir2[1]).'-'.trim($tanggal_akhir2[0]);



              if ($report=="Order & Shipment Report") {
                include 'marketing-report/order-shipment.php';
              }elseif ($report=="Contribution Report") {
                include 'marketing-report/contribution.php';
              }elseif ($report=="Sponsor Report") {
                include 'marketing-report/sponsor.php';
              }elseif ($report=="Supplier Report") {
                include 'marketing-report/supplier.php';
              }elseif ($report=="Wincheck Report") {
                include 'marketing-report/wincheck.php';
              }
            ?>

          </div>
          <!-- end x content -->
        </div>
      </div>
    </div>
</div>

<!-- js -->
</div>

</div>
  <script type="text/javascript">
  $(function() {

    <?php

    if ($_POST['range_tanggal']!='') {
      ?>
      var start = moment(<?php echo json_encode($date_awal) ?>);
      var end = moment(<?php echo json_encode($date_akhir) ?>);
      <?php
    }else{
      ?>
      var start = moment(<?php echo json_encode($office->last30days()) ?>);
      var end = moment();
      <?php
    }
     ?>

      function cb(start, end) {
        $('#reportrange input').val(start.format('D/M/YYYY') + ' - ' + end.format('D/M/YYYY'));
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


  <script src="../js/bootstrap.min.js"></script>
  <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> -->
  <script src="../js/moment/moment.min.js"></script>
   <script type="text/javascript" src="../js/datepicker/daterangepicker.js"></script>

  <!-- bootstrap progress js -->
  <script src="../js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="../js/nicescroll/jquery.nicescroll.min.js"></script>
  <!-- icheck -->
  <script src="../js/icheck/icheck.min.js"></script>
  <script src="../js/custom.js"></script>
  <!-- range slider -->
  <script src="../js/ion_range/ion.rangeSlider.min.js"></script>

  <!-- pace -->
  <script src="../js/pace/pace.min.js"></script>
  <!-- Datatables -->
  <?php if ($url=='03cc14d860d9cad2c68fb2074f3e89f44a37a4b1978a59bcb78d16809720bfa6' or
  $url=='03cc14d860d9cad2c68fb2074f3e89f484508b59e34966b384f0a9fadc06f8ad'): ?>
    <link rel="stylesheet" type="text/css" href="../assets/datatable/media/css/jquery.dataTables.css">
    <script type="text/javascript" language="javascript" src="../assets/datatable/media/js/jquery.dataTables.js"></script>
    <?php else: ?>
    <script src="../js/datatables/js/jquery.dataTables.js"></script>
    <script src="../js/datatables/tools/js/dataTables.tableTools.js"></script>
  <?php endif; ?>


  <script type="text/javascript">
  <?php for ($i=1; $i <= 2 ; $i++) {
  ?>
      $(function dashboard() {
          var dataid = [<?php echo $i ?>];
          $.each(dataid,function(i,id) {
              $("#table<?php echo $i ?>").append("<div id='table_"+id+"' <div class='inner'><i class='fa fa-spinner fa-spin'></i> Loading...</div>");
              $.get("../pages/marketing-report/table"+id+".php?kd_part=<?php echo $kd_part ?>&awal=<?php echo $date_awal ?>&akhir=<?php echo $date_akhir ?>",function(html_widget) {
                  $("#table_"+id).replaceWith(html_widget);
              })
          })
        })
  <?php
  } ?>
  </script>



</body>

</html>
