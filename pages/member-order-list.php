<div class="">
<div class="page-title">
            <div class="title_left">
              <h3>Order <small></small></h3>
            </div>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                
              </div>
            </div>
          </div>
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-folder-open"></i> Order List <small></small></h2>
            <ul class="nav navbar-right panel_toolbox"><b>
                <a href="?<?php echo paramEncrypt('hal=member-order-input')?>" data-toggle="tooltip" data-placement="left" title="Add new orders"><i class="fa fa-plus-circle"></i> Go to Input Orders</a></b>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <!-- start accordion -->
            <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                <?php 
                $kode=$_SESSION['kode'];
                $tahun=mysql_query("select substr(t4t_order.wkt_order,1,4) AS `th`,no_order,wkt_order from t4t_order where id_comp='$kode' group by th order by th desc");
                echo mysql_error();
                while ($load_tahun=mysql_fetch_array($tahun)) {
                   
                ?>

                <div class="panel">
                    <a class="panel-heading" role="tab" id="heading<?php echo $load_tahun['th'] ?>" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $load_tahun['th'] ?>" aria-expanded="true" aria-controls="collapse<?php echo $load_tahun['th'] ?>">
                        <h4 class="panel-title">
                        <i class="fa fa-caret-square-o-down"></i>
                        <?php 
                        echo $load_tahun['th'];
                        ?>
                        </h4>
                    </a>
                    <div id="collapse<?php echo $load_tahun['th'] ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading<?php echo $load_tahun['th'] ?>">
                        <div class="panel-body">
                            <table class="table table-striped responsive-utilities jambo_table" border="1" id="order_list<?php echo $load_tahun['th'] ?>">
                                <thead>
                                    <tr>
                                        <th rowspan="2"><center>Order Date<center></th>
                                        <th rowspan="2"><center>No. Order</center></th>
                                        <th colspan="4"><center>Qty</center></th>
                                        <th rowspan="2"><center>Approved</center></th>
                                    </tr>
                                    <tr>
                                        <th><center>Hang Tag</center></th>
                                        <th><center>Table Tent</center></th>
                                        <th><center>Poster A1</center></th>
                                        <th><center>Poster A4</center></th>
                                    </tr>
                                </thead>
                        
                                <tbody>
                        <?php 
                        $th=$load_tahun['th'];
                        
                        $order=mysql_query("select no,wkt_order,no_order,jml_wins,acc,tipe_prod from t4t_order where wkt_order like '%$th%' and id_comp='$kode'");
                        while ($load_order=mysql_fetch_array($order)) {
                            $id_order=$load_order['no'];
                         
                        ?>
                                    <tr>
                                        <td align="center"><?php echo $load_order['wkt_order'] ?></td>
                           
                                        <?php 
                                        if ($load_order['acc']==0) {
                                        ?>
                                         <td align="center"><a href="?<?php echo paramEncrypt('hal=member-order-pending-edit&id_order='.$load_order['no'].'')?>"><?php echo $load_order['no_order'] ?></a></td>
                                        <?php
                                        }elseif ($load_order['acc']==1) {
                                        ?>
                                         <td align="center"><a href="#" data-toggle="modal" data-target="#myModal<?php echo $load_order['no'] ?>"><?php echo $load_order['no_order'] ?></a></td>
                                        <?php
                                        }
                                         ?>

                                        
                           
                                        <td align="center">
                                            <?php 
                                            $no_order=$load_order['no_order']; //definisi no order
                                            $htag=mysql_fetch_array(mysql_query("select jml_wins from t4t_order where no_order='$no_order'"));
                                            echo $htag[0];
                                            ?>
                                        </td>
                                        <td align="center">
                                            <?php 
                                            $ttent=mysql_fetch_array(mysql_query("select jml from t4t_orderrequest where no_order='$no_order' and no_req='1'")); 
                                            echo $ttent[0];
                                            ?>
                                        </td>
                                        <td align="center">
                                            <?php 
                                            $ttent=mysql_fetch_array(mysql_query("select jml from t4t_orderrequest where no_order='$no_order' and no_req='2'")); 
                                            echo $ttent[0];
                                            ?>
                                        </td>
                                        <td align="center">
                                            <?php 
                                            $ttent=mysql_fetch_array(mysql_query("select jml from t4t_orderrequest where no_order='$no_order' and no_req='3'")); 
                                            echo $ttent[0];
                                            ?>
                                        </td>
                                        <td align="center">
                                            <?php 
                                            $approve=mysql_fetch_array(mysql_query("select acc from t4t_order where no_order='$no_order'"));
                                            if ($approve[0]=="1") {
                                                ?>
                                                <i class="fa fa-check-square-o"></i>
                                                <?php 
                                            }else{
                                                ?>
                                                <i class="fa fa-square-o"></i>
                                                <?php
                                            }
                                            
                                            ?>
                                        </td>
                                    </tr>

 <!-- Modal -->
  <div class="modal fade" id="myModal<?php echo $load_order['no'] ?>" role="dialog">
    <div class="modal-dialog ">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">
 
            <div class="font-hijau">
               <i class="fa fa-check-circle-o "> </i> Approved
            </div>

          </h4>
        </div>
        <div class="modal-body">

          <div class="form-group col-lg-12">
            <label class="control-label col-md-4">Order No.
            </label>
            <div class="col-md-8 font-hijau">
              <?php 
              echo $load_order['no_order'];
               ?>
               <input type="hidden" name="no_order" value="<?php echo $load_order['no_order']; ?>" >
            </div>
          </div>
          <br>

          <div class="form-group col-lg-12">
            <label class="control-label col-md-4 ">Company Name
            </label>
            <div class="col-md-8 font-hijau">
              <?php 
              $kode=$_SESSION['kode'];
              $comp_name=mysql_fetch_array(mysql_query("select nama from t4t_partisipan where id='$kode'"));
              echo $comp_name[0];
              ?>
              <input type="hidden" name="comp" value="<?php echo $comp_name[0]; ?>" >
            </div>
          </div>
          <br>
          <br>

          <!-- table container -->
          <div class="form-group col-lg-12">
          <label class="col-md-10"><center>Container</center></label>
          <label class="col-md-2"> Stuffing </label>
          <label class="col-md-2">20'</label>
          <label class="col-md-2">40'</label>
          <label class="col-md-2">40' HC</label>
          <label class="col-md-2">45'</label>
          <label class="col-md-2">60'</label>
          <label class="col-md-2">Date</label>

            <?php 
          $no_order=$load_order['no_order'];
          $jml_cont=mysql_fetch_array(mysql_query("select count(no) from t4t_ordercontainer where no_order='$no_order'"));
          $i=1;
          $container=mysql_query("select * from t4t_ordercontainer where no_order='$no_order' group by tgl_stuf");
          while ($load_cont=mysql_fetch_array($container)) {
            $ii=$i-1;

            $tgl_stuf=$load_cont['tgl_stuf'];
            $ex_tgl=explode("-", $tgl_stuf);
            $tanggal_stf=$ex_tgl[2]."-".$ex_tgl[1]."-".$ex_tgl[0];  

            $container1=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_cont=1 and no_order='$no_order' limit $ii,1")); 
            $container2=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_cont=2 and no_order='$no_order' limit $ii,1")); 
            $container3=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_cont=3 and no_order='$no_order' limit $ii,1")); 
            $container4=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_cont=4 and no_order='$no_order' limit $ii,1")); 
            $container5=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_cont=5 and no_order='$no_order' limit $ii,1"));                        
           ?>

          <label class="col-md-2 font-hijau"><?php echo $container1[0] ?></label>
          <label class="col-md-2 font-hijau"><?php echo $container2[0] ?></label>
          <label class="col-md-2 font-hijau"><?php echo $container3[0] ?></label>
          <label class="col-md-2 font-hijau"><?php echo $container4[0] ?></label>
          <label class="col-md-2 font-hijau"><?php echo $container5[0] ?></label>
          <label class="col-md-2 font-hijau"><?php echo $tanggal_stf ?></label>
       
                 
                          <?php 
                          $i++;
                         }
                           ?>


          </div>
          <br><br><br><br><br><br>
        
           <div class="form-group col-lg-12">
              <label class="control-label col-md-4" for="first-name">Type of Product <span class="required"></span>
              </label>
              <div class="col-md-8 font-hijau">
                <?php echo $load_order['tipe_prod'] ?>
                
              </div>
            </div>
            <br><br><br>

            <div class="form-group col-lg-12">
              <label class="control-label col-md-4" for="first-name">Wood Species <span class="required"></span>
              </label>
              <div class="col-md-8">
                <ul class="to_do">
                <?php 
                $wood=mysql_query("select * from t4t_pohonen");

                while ($data_pohon=mysql_fetch_array($wood)) {
                  $id_pohon=$data_pohon[0];
                  $pohon=mysql_fetch_array(mysql_query("select a.id_pohon,b.no from t4t_pohonen a, t4t_orderphn b where a.id_pohon=b.no_phnen2 and no_order='$no_order' and a.id_pohon=$id_pohon"));
                 ?>
                  <?php 
                    if ($pohon[0]!="") {
                     ?>
                    <li>
                   
                     <p class="font-hijau"><input type="checkbox" class="flat" name="item[]" value="<?php echo $data_pohon[0] ?>" checked disabled="disabled"> <?php echo $data_pohon[1] ?> </p> 
                    
                    </li>
                     <?php
                    }else{
                     ?>
                       <!--  <p><input type="checkbox" class="flat" name="item[]" value="<?php echo $data_pohon[0] ?>" disabled="disabled"> <?php echo $data_pohon[1] ?> </p>  -->
                      <?php } ?>

                <?php

                }
                 ?>    
                </ul>
              </div>
            </div>
            <br><br>

            <div class="form-group col-lg-12">
              <label class="control-label col-md-4" for="first-name"> Quantity Hang Tags Requested <span class="required"></span>
              </label>
              <div class="col-md-8 font-hijau">
              <?php $jml_tag=mysql_fetch_array(mysql_query("select jml_wins from t4t_order where no_order='$no_order'"));
               echo $jml_tag[0] ?>
              </div>
            </div>
            <br><br><br>

            <!-- other request -->
            <div class="form-group col-lg-12">
              <label class="control-label col-md-4" for="first-name">Other Request <span class="required"></span>
              </label>
              <div class="col-md-8">
                <ul class="to_do">
                <?php 
                $other=mysql_query("select * from t4t_req");
                while ($data_other=mysql_fetch_array($other)) {
                  
                  $no_req=$data_other[0];
                  $request=mysql_fetch_array(mysql_query("select a.jml,b.no from t4t_orderrequest a, t4t_req b where a.no_req=b.no and a.no_order='$no_order' and a.no_req=$no_req "));

                 ?>
                    <li>
                   
                     <?php echo $request[0]; echo " - ".$data_other[1]; ?>
                    
                    </li>
                  <?php } ?>
                </ul>
              </div>
            </div>

            <?php 
               $pic_name=mysql_fetch_array(mysql_query("select pic from t4t_partisipan where id='$kode'"));
               if ($pic_name[0]=="") {
                 
               }else{
               
            ?>
            <div class="form-group col-lg-12">
              <label class="control-label col-md-4" for="first-name">PIC <span class="required"></span>
              </label>
              <div class="col-md-8 font-hijau">
                <?php echo $pic_name[0]; ?>                
              </div>
            </div>
            <?php } ?>


<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!-- end modal -->


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
          $('#order_list<?php echo $load_tahun['th'] ?>').DataTable( {
                    // "bJQueryUI":true,
                  "bPaginate":true,
                  "sPaginationType": "full_numbers",
                  "iDisplayLength":10
          } );

      } );
    </script>
    <!-- end datatable -->

                    <?php } ?>       
            </div>
            <!-- end of accordion -->


        </div>
    </div>
</div>


<!-- js -->
         </div>

        </div>

        <div id="custom_notifications" class="custom-notifications dsp_none">
            <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
            </ul>
            <div class="clearfix"></div>
            <div id="notif-group" class="tabbed_notifications"></div>
        </div>

        <script src="../js/bootstrap.min.js"></script>

        <!-- chart js -->
        <script src="../js/chartjs/chart.min.js"></script>
        <!-- bootstrap progress js -->
        <script src="../js/progressbar/bootstrap-progressbar.min.js"></script>
        <script src="../js/nicescroll/jquery.nicescroll.min.js"></script>
        <!-- icheck -->
        <script src="../js/icheck/icheck.min.js"></script>

        <script src="../js/custom.js"></script>
        
        <!-- pace -->
        <script src="../js/pace/pace.min.js"></script>

       
</body>

</html>