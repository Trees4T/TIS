<div class="">
<div class="page-title">
            <div class="title_left">
              <h3>Paid & Unpaid <small></small></h3>
            </div>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                
              </div>
            </div>
          </div>


    <div class="x_panel">
    <div class="col-md-12">
        <div class="x_panel">
            <!-- <div class="x_title">
                
                <ul class="nav navbar-right panel_toolbox">
                    
                </ul>
                <div class="clearfix"></div>
            </div> -->
            <div class="x_content">


                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Unpaid</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab"  aria-expanded="false">Paid</a>
                        </li>
                       
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                            <!-- start accordion -->
                            <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                <?php 
                                $kode=$_SESSION['kode'];
                                $tahun_cek=mysql_query("select substr(bl_tgl,1,4) as th,bl_tgl,bl,kota_tujuan,fee,acc from t4t_shipment where id_comp='$kode' and acc_paid=0 group by th order by th desc");
                                echo mysql_error();

                                if ($cek=mysql_fetch_array($tahun_cek)=="") {
                                    echo "No result found.";
                                }else{
                                    $tahun=mysql_query("select substr(bl_tgl,1,4) as th,bl_tgl,bl,kota_tujuan,fee,acc from t4t_shipment where id_comp='$kode' and acc_paid=0 group by th order by th desc");
                                while ($load_tahun=mysql_fetch_array($tahun)) {
                                    
                                ?>

                                <div class="panel">
                                    <a class="panel-heading" role="tab" id="heading<?php echo $load_tahun['th'] ?>" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $load_tahun['th'] ?>" aria-expanded="true" aria-controls="collapse<?php echo $load_tahun['th'] ?>">
                                        <h4 class="panel-title">
                                        <i class="fa fa-caret-square-o-down"></i>
                                        <?php 
                                        echo $load_tahun[0];
                                        ?>
                                        </h4>
                                    </a>
                                    <div id="collapse<?php echo $load_tahun['th'] ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading<?php echo $load_tahun['th'] ?>">
                                        <div class="panel-body">
                                            <table class="table table-striped responsive-utilities jambo_table" border="1" id="unpaid_list<?php echo $load_tahun['th'] ?>">
                                                <thead>
                                                    <tr>
                                                        <th rowspan="2" width="10%"><center>BL Date<center></th>
                                                        <th rowspan="2"><center>BL</center></th>
                                                        <th rowspan="2"><center>Shipment No.</center></th>
                                                        <th rowspan="2"><center>Order No.</center></th>
                                                        <th colspan="5"><center>Container Size</center></th>
                                                        <th rowspan="2"><center>Dest. City</center></th>
                                                        <th rowspan="2"><center>Paid</center></th>
                                                    </tr>
                                                    <tr>   
                                                        <th width="5%"><center>20'</center></th>
                                                        <th width="5%"><center>40'</center></th>
                                                        <th width="5%"><center>40' HC</center></th>
                                                        <th width="5%"><center>45'</center></th>
                                                        <th width="5%"><center>60'</center></th>
                                                    </tr>
                                                </thead>
                                        
                                                <tbody>
                                        <?php 
                                        $th=$load_tahun['th'];
                                        
                                        $shipment=mysql_query("select * from t4t_shipment where bl_tgl like '%$th%' and id_comp='$kode' and acc_paid=0 order by bl_tgl desc");
                                        while ($load_shipment=mysql_fetch_array($shipment)) {
                                             
                                         
                                        ?>
                                                    <tr>
                                                        <td align="center"><?php echo $load_shipment['bl_tgl'] ?></td>
                                                        <td align="center"><?php echo $load_shipment['bl'] ?></td>
                                                        <td align="center"><?php echo $load_shipment['no_shipment'] ?></td>
                                                        <td align=""><?php echo $load_shipment['no_order'] ?></td>
                                                        <td align="center">
                                                            <?php 
                                                            $no_shipment=$load_shipment['no_shipment']; //definisi no shipment
                                                            $a=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='1'"));
                                                            echo $a[0];
                                                            ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php 
                                                            $b=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='2'")); 
                                                            echo $b[0];
                                                            ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php 
                                                            $b=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='3'")); 
                                                            echo $b[0];
                                                            ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php 
                                                            $c=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='4'")); 
                                                            echo $c[0];
                                                            ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php 
                                                            $d=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='5'")); 
                                                            echo $d[0];
                                                            ?>
                                                        </td>
                                                        <td align="center"><?php echo $load_shipment['kota_tujuan'] ?></td>
                                                        <td align="center">
                                                            <?php 
                                                            $approve=mysql_fetch_array(mysql_query("select acc_paid from t4t_shipment where no_shipment='$no_shipment'"));
                                                            if ($approve[0]=="1") {
                                                                ?>
                                                                <i class="fa fa-check-square-o"></i>
                                                                <?php 
                                                            }else{
                                                                ?>
                                                                <div class="font-15">&empty;</div>
                                                                <?php
                                                            }
                                                            
                                                            ?>
                                                        </td>
                                                    </tr>
                                        <?php 
                                        }
                                        ?>
                                                </tbody>
                                        
                                            </table>
                                        </div>
                                    </div>
                                </div>  

                                                                   
    <!-- Datatables -->
    <script src="../js/datatables/js/jquery.dataTables.js"></script>
    <script src="../js/datatables/tools/js/dataTables.tableTools.js"></script>

     <script>
      $(function() {
          $('#unpaid_list<?php echo $load_tahun['th'] ?>').DataTable( {
                    // "bJQueryUI":true,
                  "bPaginate":true,
                  "sPaginationType": "full_numbers",
                  "iDisplayLength":10
          } );

      } );
    </script>
    <!-- end datatable -->
                            
                                    <?php } 
                                    
                                    }
                                    ?>       
                            </div>
                            <!-- end of accordion -->
                        </div>


                        <div role="tabpanel2" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                            <!-- start accordion -->
                            <div class="accordion" id="accordion2" role="tablist" aria-multiselectable="true">
                                <?php 
                                $kode=$_SESSION['kode'];
                                $tahun2_cek=mysql_query("select substr(bl_tgl,1,4) as th,bl_tgl,bl,kota_tujuan,fee,acc from t4t_shipment where id_comp='$kode' and acc_paid=1 group by th order by th desc");
                                
                                if ($cek3=mysql_fetch_array($tahun2_cek)=="") {
                                    echo "No result found.";
                                }else{
                                $tahun2=mysql_query("select substr(bl_tgl,1,4) as th,bl_tgl,bl,kota_tujuan,fee,acc from t4t_shipment where id_comp='$kode' and acc_paid=1 group by th order by th desc");
                                while ($load_tahun2=mysql_fetch_array($tahun2)) {
                                   
                                ?>

                                <div class="panel">
                                    <a class="panel-heading" role="tab" id="heading2<?php echo $load_tahun2['th'] ?>" data-toggle="collapse" data-parent="#accordion2" href="#collapse2<?php echo $load_tahun2['th'] ?>" aria-expanded="true" aria-controls="collapse2<?php echo $load_tahun2['th'] ?>">
                                        <h4 class="panel-title">
                                        <i class="fa fa-caret-square-o-down"></i>
                                        <?php 
                                        echo $load_tahun2['th'];
                                        ?>
                                        </h4>
                                    </a>
                                    <div id="collapse2<?php echo $load_tahun2['th'] ?>" class="panel-collapse collapse " role="tabpanel2" aria-labelledby="heading2<?php echo $load_tahun2['th'] ?>">
                                        <div class="panel-body">
                                            <table class="table table-striped responsive-utilities jambo_table" border="1" id="paid_list<?php echo $load_tahun2['th'] ?>">
                                                <thead>
                                                    <tr>
                                                        <th rowspan="2" width="10%"><center>BL Date<center></th>
                                                        <th rowspan="2"><center>BL</center></th>
                                                        <th rowspan="2"><center>Shipment No.</center></th>
                                                        <th rowspan="2"><center>Order No.</center></th>
                                                        <th colspan="5"><center>Container Size</center></th>
                                                        <th rowspan="2"><center>Dest. City</center></th>
                                                        <th rowspan="2"><center>Paid</center></th>
                                                    </tr>
                                                    <tr>   
                                                        <th width="5%"><center>20'</center></th>
                                                        <th width="5%"><center>40'</center></th>
                                                        <th width="5%"><center>40' HC</center></th>
                                                        <th width="5%"><center>45'</center></th>
                                                        <th width="5%"><center>60'</center></th>
                                                    </tr>
                                                </thead>
                                        
                                                <tbody>
                                        <?php 
                                        $th=$load_tahun2['th'];
                                        
                                        $shipment=mysql_query("select * from t4t_shipment where bl_tgl like '%$th%' and id_comp='$kode' and acc_paid=1 order by bl_tgl desc");
                                        while ($load_shipment=mysql_fetch_array($shipment)) {
                                             
                                         
                                        ?>
                                                    <tr>
                                                        <td align="center"><?php echo $load_shipment['bl_tgl'] ?></td>
                                                        <td align="center"><?php echo $load_shipment['bl'] ?></td>
                                                        <td align="center"><?php echo $load_shipment['no_shipment'] ?></td>
                                                        <td align=""><?php echo $load_shipment['no_order'] ?></td>
                                                        <td align="center">
                                                            <?php 
                                                            $no_shipment=$load_shipment['no_shipment']; //definisi no shipment
                                                            $a=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='1'"));
                                                            echo $a[0];
                                                            ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php 
                                                            $b=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='2'")); 
                                                            echo $b[0];
                                                            ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php 
                                                            $b=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='3'")); 
                                                            echo $b[0];
                                                            ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php 
                                                            $c=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='4'")); 
                                                            echo $c[0];
                                                            ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php 
                                                            $d=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_order='$no_shipment' and no_cont='5'")); 
                                                            echo $d[0];
                                                            ?>
                                                        </td>
                                                        <td align="center"><?php echo $load_shipment['kota_tujuan'] ?></td>
                                                        <td align="center">
                                                            <?php 
                                                            $approve=mysql_fetch_array(mysql_query("select acc_paid from t4t_shipment where no_shipment='$no_shipment'"));
                                                            if ($approve[0]=="1") {
                                                                ?>
                                                                <i class="fa fa-check-square-o"></i>
                                                                <?php 
                                                            }else{
                                                                ?>
                                                                <i class="fa fa-minus"></i>
                                                                <?php
                                                            }
                                                            
                                                            ?>
                                                        </td>
                                                    </tr>
                                        <?php 
                                        }
                                        ?>
                                                </tbody>
                                        
                                            </table>
                                        </div>
                                    </div>
                                </div>  

    <!-- Datatables -->
    <script src="../js/datatables/js/jquery.dataTables.js"></script>
    <script src="../js/datatables/tools/js/dataTables.tableTools.js"></script>

     <script>
      $(function() {
          $('#paid_list<?php echo $load_tahun2['th'] ?>').DataTable( {
                    // "bJQueryUI":true,
                  "bPaginate":true,
                  "sPaginationType": "full_numbers",
                  "iDisplayLength":10
          } );

      } );
    </script>
    <!-- end datatable -->
                                    <?php } 
                                }
                                     ?>       
                            </div>
                            <!-- end of accordion -->
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>
       </div>

    </div>
</div>

<?php include '../layout/js.php'; ?>