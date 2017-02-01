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

                    <div class="row">

                        <form method="post">
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Shipments Activities
<?php  
    $kode=$_SESSION['kode'];
    $wkt_shipment=$conn->query("select wkt_shipment from t4t_shipment where id_comp='$kode' and acc=1 order by wkt_shipment limit 1")->fetch();

    $ex_wkt_ship=explode("-", $wkt_shipment[0]);
    $th=date("Y");

    $jarak_th=$th-$ex_wkt_ship[0];
    $select_year=$_REQUEST['select_year'];
    $_SESSION['ship_act_year']=$select_year;
?> 
                                    
<select class="form-control" onchange="this.form.submit()" name="select_year">
    <option><?php  
                if ($select_year=="") {
                    echo "This Year (".$th.")";
                }else{
                    echo $select_year;
                }
            ?>
    </option>
    <option>------------------------------</option>
<?php for ($i=0; $i <= $jarak_th ; $i++) { 
    $tahun_select=$th-$i;
?>
    <option value="<?php echo $tahun_select ?>"><?php echo $tahun_select ?></option>  
<?php 
} ?>
</select>
<noscript><input type="submit" value='select_year'></noscript>

                                    </h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <canvas id="this_year_shipment" style="height:300px;"></canvas>
                                </div>
                            </div>
                        </div>
                        </form>

                        <!-- graph area -->
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title">
                                <?php 
                                $cek_order_pertama=$conn->query("select substr(wkt_order,1,4) as th from t4t_order where id_comp='$kode' order by th limit 1")->fetch();
                                $jarak=$th-$cek_order_pertama[0]+1; 
                                ?>
                                    <h2>Orders Activities<small><?php if ($jarak>0) {
                                        echo $cek_order_pertama[0]."-".$th;
                                    }else{
                                        echo $jarak;
                                        } ?></small></h2>
                                 
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content2">
                                    <div id="graph_line" style="width:100%; height:300px;"></div>
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
                $.get("../pages/member-dash/"+id+".php",function(html_widget) {
                    $("#dashboard_"+id).replaceWith(html_widget);
                })
            }) 
          })
    <?php     
    } ?>  
    </script>
    <script src="../js/moris/member-grafik-shipment-year-to-year.php"></script>
    <script src="../js/moris/member-grafik-order.php"></script>
  <!--   <script src="../js/moris/member-grafik-order.php"></script> -->
</body>

</html>
