<div class="">
<div class="page-title">
   <div class="title_left">
       <h3>
<!--    Chart Js
<small>
   Some examples to get you started
</small> -->
</h3>
   </div>
</div>
<div class="clearfix"></div>



<table id="sponsor" class="display" cellspacing="0" width="100%">
 <thead>
   <tr>
     <th>wins</th>
     <th>petani</th>
     <th>jml_phn</th>
     <th>nama_pohon</th>
     <th>wkt_shipment</th>
     <!-- <th>id_comp</th> -->
   </tr>
 </thead>
</table>






</div>

</div>
<!-- /page content -->

</div>

</div>

   <div id="custom_notifications" class="custom-notifications dsp_none">
       <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
       </ul>
       <div class="clearfix"></div>
       <div id="notif-group" class="tabbed_notifications"></div>
   </div>

   <script src="../js/bootstrap.min.js"></script>
   <script src="../js/moment/moment.min.js"></script>
   <script type="text/javascript" src="../js/datepicker/daterangepicker.js"></script>
   <script src="../js/chartjs/chart.min.js"></script>
   <script src="../js/progressbar/bootstrap-progressbar.min.js"></script>
   <script src="../js/nicescroll/jquery.nicescroll.min.js"></script>
   <script src="../js/icheck/icheck.min.js"></script>
   <script src="../js/custom.js"></script>
   <script src="../js/pace/pace.min.js"></script>
   <!-- moris js -->
   <script src="../js/moris/raphael-min.js"></script>
   <script src="../js/moris/morris.min.js"></script>
   <!-- Datatables -->
   <!-- <script type="text/javascript" language="javascript" src="../assets/datatable/media/js/jquery.js"></script> -->

   <!-- <script src="../js/datatables/js/jquery.dataTables.js"></script>
   <script src="../js/datatables/tools/js/dataTables.tableTools.js"></script> -->
   <link rel="stylesheet" type="text/css" href="../assets/datatable/media/css/jquery.dataTables.css">
	 <script type="text/javascript" language="javascript" src="../assets/datatable/media/js/jquery.dataTables.js"></script>

   <script type="text/javascript">
   <?php for ($i=1; $i <= 12 ; $i++) {
   ?>
       $(function dashboard() {
           var dataid = [<?php echo $i ?>];
           $.each(dataid,function(i,id) {
               $("#dashboard<?php echo $i ?>").append("<div id='dashboard_"+id+"' <div class='inner'><i class='fa fa-spinner fa-spin'></i> Loading...</div>");
               $.get("../pages/marketing-dash/"+id+".php",function(html_widget) {
                   $("#dashboard_"+id).replaceWith(html_widget);
               })
           })
         })
   <?php
   } ?>


   $(document).ready(function() {
  	$('#sponsor').dataTable( {
  		"processing": true,
  		"serverSide": true,
  		"ajax": "http://rio-bhl.org/github/TIS/assets/datatable/scripts/mkt-rep-sponsor.php"
  	} );
  } );
   </script>



</body>

</html>
