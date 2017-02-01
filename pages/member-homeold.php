<div class="">
<?php 
$kode=$_SESSION['kode'];

 ?>
                  <!-- top tiles -->
                <div class="row tile_count">
                    <div class="animated flipInY col-md-3 col-sm-4 col-xs-4 tile_stats_count" id="dashboard1">
                        
                    </div>
                    <!-- <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <div class="left"></div>
                        <div class="center">
                            <span class="count_top"><i class="fa fa-clock-o"></i> Pending Order</span>
                            <div class="count <?php if ($p_order[0]>=1) {
                                echo "font-kuning";
                            }else{
                                echo "green";
                            } ?>" align="center"><?php echo $p_order[0] ?></div>
                           <a href="?<?php echo paramEncrypt('hal=member-order-list')?>"><span>go to order lists <i class="fa fa-angle-double-right"></i></span></a>
                        </div>
                    </div> -->
                    <!-- <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                        <div class="left"></div>
                        <div class="center">
                            <span class="count_top"><i class="fa fa-tags"></i> Total Hang Tags</span>
                            <div class="count" align="right">200,500</div>
                          
                        </div>
                    </div> -->
                    <div class="animated flipInY col-md-3 col-sm-4 col-xs-4 tile_stats_count" id="dashboard2">
                       
                    </div>
                    <div class="animated flipInY col-md-3 col-sm-4 col-xs-4 tile_stats_count" id="dashboard3">
                        
                    </div>
                    <!-- <div class="animated flipInY col-md-3 col-sm-4 col-xs-4 tile_stats_count" id="dashboard4"> -->
                        
                    </div>

                </div>
                <!-- /top tiles -->

                    <div class="clearfix"></div>

                    <div class="row">

                        <!-- graph area -->
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h1>Shipments Activities </h1>
                                 
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content2">
                                    <div id="graph_area2" style="width:100%; height:300px;"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /graph area -->

                        <!-- graph area -->
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h1>Orders Activities </h1>
                                 
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content2">
                                    <div id="graph_area" style="width:100%; height:300px;"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /graph area -->

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
    <script src="../js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="../js/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="../js/icheck/icheck.min.js"></script>
    <script src="../js/custom.js"></script>
    <!-- pace -->
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
                $.get("../pages/member-dash/"+id+".php",function(html_widget) {
                    $("#dashboard_"+id).replaceWith(html_widget);
                })
            }) 
          })
    <?php     
    } ?>  
    </script>


    <script src="../js/moris/member-grafik-order.php"></script>
    <script src="../js/moris/member-grafik-shipment.php"></script>

 



</body>

</html>
