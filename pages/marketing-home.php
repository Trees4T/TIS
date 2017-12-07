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
                   <!-- statistic -->
                    <!-- top tiles -->
               <div class="row tile_count">
                   <div class="animated flipInY col-md-3 col-sm-4 col-xs-4 tile_stats_count" id="dashboard1">

                   </div>

                   <div class="animated flipInY col-md-3 col-sm-4 col-xs-4 tile_stats_count" id="dashboard3">

                   </div>
                   <div class="animated flipInY col-md-3 col-sm-4 col-xs-4 tile_stats_count" id="dashboard2">

                   </div>
                   <div class="animated flipInY col-md-3 col-sm-4 col-xs-4 tile_stats_count" id="dashboard4">

                   </div>

               </div>
               <!-- /top tiles -->

                   <div class="row">





                   </div>


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
   <script src="../js/chartjs/chart.min.js"></script>
   <script src="../js/progressbar/bootstrap-progressbar.min.js"></script>
   <script src="../js/nicescroll/jquery.nicescroll.min.js"></script>
   <script src="../js/icheck/icheck.min.js"></script>
   <script src="../js/custom.js"></script>
   <script src="../js/pace/pace.min.js"></script>
   <!-- moris js -->
   <script src="../js/moris/raphael-min.js"></script>
   <script src="../js/moris/morris.min.js"></script>
   <script type="text/javascript">
   <?php for ($i=1; $i <= 4 ; $i++) {
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
   </script>

</body>

</html>
