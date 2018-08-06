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
               <!-- <div class="row tile_count">
                   <div class="animated flipInY col-md-3 col-sm-4 col-xs-4 tile_stats_count" id="dashboard1">
                   </div>
                   <div class="animated flipInY col-md-3 col-sm-4 col-xs-4 tile_stats_count" id="dashboard3">
                   </div>
                   <div class="animated flipInY col-md-3 col-sm-4 col-xs-4 tile_stats_count" id="dashboard2">
                   </div>
                   <div class="animated flipInY col-md-3 col-sm-4 col-xs-4 tile_stats_count" id="dashboard4">
                   </div>
               </div> -->


               <div class="col-md-6 col-sm-6 col-xs-12">
                  <!-- top 5 contrib -->
                  <div class="" id="dashboard5">
                    <!-- isi top 5 contrib -->
                  </div>
                  <!-- Order -->
                  <div class="" id="dashboard8">
                    <!-- isi orders -->
                  </div>
                  <!-- Shipments -->
                  <div class="" id="dashboard9">
                    <!-- isi shipments -->
                  </div>
                  <!-- contribution -->
                  <div class="" id="dashboard10">
                    <!-- isi shipments -->
                  </div>
                  <!-- end Contributions -->

               </div>


               <div class="col-md-6 col-sm-6 col-xs-12">
                 <!-- wins ordered -->
                 <div class="" id="dashboard6"><!-- isi winsordered --></div>
                 <!-- shipment tree -->
                 <div class="" id="dashboard7"><!-- isi shipment tree --></div>
                 <!-- AR Status -->
                 <div class="" id="dashboard11"><!-- isi AR --></div>
               </div>


                   <!-- row -->
                   <!-- ## -->
                  <div class="row">


                    <!-- Invoices -->
                    <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel tile ">
                            <div class="x_title">
                                <h2>Invoices
                                </h2>
                                <br><br>
                                <ul class="nav navbar-left panel_toolbox">
                                  <div id="reportrange" >
                                      <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                      <span></span> <b class="caret"></b>
                                      <form class="" action="" method="post">
                                        <input type="hidden" name="date" value="" class="form-control" id="date" onchange='this.form.submit()'>
                                        <noscript><input type="submit" value="date"></noscript>
                                      </form>
                                  </div>
                                </ul>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                              <table class="table table-striped">
                                   <thead>
                                       <tr>
                                           <th></th>
                                           <th>Qty Invoices</th>
                                           <th>Amt Invoiced</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                       <tr>
                                           <td>Shipments</td>
                                           <td>Otto</td>
                                           <td>@mdo</td>
                                       </tr>
                                       <tr>
                                           <td>Donations</td>
                                           <td>Otto</td>
                                           <td>@mdo</td>
                                       </tr>
                                       <tr>
                                           <td>Sponsorships</td>
                                           <td>Otto</td>
                                           <td>@mdo</td>
                                       </tr>
                                   </tbody>
                               </table>
                            </div>
                        </div>
                    </div> -->
                    <!-- end invoice -->

                  </div>


               </div>

                   <div class="row">

                     <!-- linking part -->
                     <div class="col-md-12 col-sm-12 col-xs-12" id="dashboard12"><!-- isi AR --></div>

                     <!-- end linking part -->
                   </div>


               <!-- /top tiles -->
                   <div class="row">
                     <br><br><br><br><br><br><br><br><br><br><br><br>
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
   </script>



</body>

</html>
