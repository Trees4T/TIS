<div class="">
<div class="page-title">
            <div class="title_left">
              <h3>Shipment <small></small></h3>
            </div>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                
              </div>
            </div>
          </div>
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-folder-open"></i> Shipment List <small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <a href="?<?php echo paramEncrypt('hal=member-shipment-input')?>" data-toggle="tooltip" data-placement="left" title="Add new shipments"><i class="fa fa-plus-circle"></i> Input Shipments</a>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <!-- start accordion -->
            <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                <?php 
                $kode=$_SESSION['kode'];
                $tahun=mysql_query("select substr(bl_tgl,1,4) as th,bl_tgl,bl,kota_tujuan,fee,acc from t4t_shipment where id_comp='$kode' group by th order by th desc");
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
                            <table class="table table-striped responsive-utilities jambo_table" border="1" id="shipment_list<?php echo $load_tahun['th'] ?>">
                                <thead>
                                    <tr>
                                        <th rowspan="2"><center>BL Date<center></th>
                                        <th rowspan="2"><center>No. BL</center></th>
                                        <th rowspan="2"><center>Dest. City</center></th>
                                        <th colspan="5"><center>Container Size</center></th>
                                        <th rowspan="2"><center>Contribution Fee ($USD)</center></th>
                                        <th rowspan="2"><center>Approved</center></th>
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
                        
                        $shipment=mysql_query("select * from t4t_shipment where bl_tgl like '%$th%' and id_comp='$kode' order by bl_tgl desc");
                        while ($load_shipment=mysql_fetch_array($shipment)) {
                             
                         
                        ?>
                                    <tr>
                                        <td align="center"><?php echo $load_shipment['bl_tgl'] ?></td>

                                         <?php 
                                        if ($load_shipment['acc']==0) {
                                        ?>
                                         <td align="center"><a href="?<?php echo paramEncrypt('hal=member-shipment-pending-edit&id_ship='.$load_shipment['no'].'')?>"><?php echo $load_shipment['bl'] ?></a></td>
                                        <?php
                                        }elseif ($load_shipment['acc']==1) {
                                        ?>
                                        <td align="center"><a href="#" data-toggle="modal" data-target="#myModal<?php echo $load_shipment['no'] ?>"> <?php echo $load_shipment['bl'] ?></a></td>
                                        <?php } ?>

                                        <td align="center"><?php echo $load_shipment['kota_tujuan'] ?></td>
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
                                        <td align="center"><?php echo $load_shipment['fee'] ?></td>
                                        <td align="center">
                                            <?php 
                                            $approve=mysql_fetch_array(mysql_query("select acc from t4t_shipment where no_shipment='$no_shipment'"));
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
  <div class="modal fade" id="myModal<?php echo $load_shipment['no'] ?>" role="dialog">
    <div class="modal-dialog modal-lg">
    
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

                    <div class="form-group col-sm-12">
                      <label class="control-label col-md-4" for="first-name">Shipment Report No.
                      </label>
                      <div class="col-md-8 font-hijau">
                       <?php echo $load_shipment['no_shipment'] ?>
                      </div>
                    </div>

                    <div class="form-group col-sm-12">
                      <label class="control-label col-md-4" for="first-name">Bill of Lading No. <span class="required"></span>
                      </label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" name="bl" readonly="" value="<?php echo $load_shipment['bl'] ?>">
                        
                      </div>
                    </div>

                    <div class="form-group col-sm-12">
                      <label class="control-label col-md-4" for="first-name">Bill of Lading Date <span class="required"></span>
                      </label>
                      <div class="col-md-4">
                    <?php 
                    $tanggal=$load_shipment['bl_tgl'];
                    $ex_tgl=explode("-", $tanggal);
                    $tanggal_bl=$ex_tgl[2]."/".$ex_tgl[1]."/".$ex_tgl[0];  
                    ?>
                        <input type="text" class="form-control" id="single_cal2" name="tglbl" readonly="" value="<?php echo $tanggal_bl ?>">
                        <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                      </div>
                    </div>

                    <div class="form-group col-sm-12">
                      <label class="control-label col-md-4" for="first-name">Order No. <span class="required"></span>
                      </label>
                      <div class="col-md-8">
                      <textarea disabled="" class="form-control"><?php echo $load_shipment['no_order'] ?></textarea>
                        
                      </div>

                    </div>

                    <div class="form-group col-sm-12">
                      <label class="control-label col-md-4" for="first-name">Hang Tag numbers used <span class="required"></span>
                      </label>
                      <div class="col-md-8">
                        <textarea type="text" class="form-control" name="wins_used" readonly=""><?php echo $load_shipment['wins_used'] ?></textarea>
                      
                        
                      </div>
                    </div>

                    <div class="form-group col-sm-12">
                      <label class="control-label col-md-4" for="first-name">Company Name <span class="required"></span>
                      </label>
                      <div class="col-md-8 font-hijau">
                        <?php 
                  
                        $company=mysql_fetch_array(mysql_query("select nama from t4t_partisipan where id='$kode'"));
                        echo $company[0];
                         ?>
                          <input type="hidden" name="id_comp" value="<?php echo $kode; ?>" >
                      </div>
                    </div>
                    
                      <div class="form-group col-md-12">
                      <label class="control-label col-md-4" for="first-name">Container Size <span class="required"></span>
                      </label>
                      <div class="col-md-4">
                      <label class="col-md-6">Container</label>
                      <label class="col-md-6">QTY</label>
                      <?php 
                      $no=1;
                      $kontainer=mysql_query("select * from t4t_container");

                      while ($data_kont=mysql_fetch_array($kontainer)) {

                      $no_sh=$load_shipment['no_shipment'];
                      $cont=mysql_fetch_array(mysql_query("select jml from t4t_ordercontainer where no_order='$no_sh' and no_cont='$no'"));
                      ?>
                      <div class="font-hijau">
                      <label class="col-md-6"><?php echo $data_kont['cont'] ?></label>
                      <label class="col-md-6"><?php echo $cont[0] ?></label>
                      </div>
                      <?php  
                      $no++;
                      }
                       ?>
                      </div>
                    </div>

                    <div class="form-group col-sm-12">
                      <label class="control-label col-md-4" for="first-name"> Items QTY  <span class="required"></span>
                      </label>
                      <div class="col-md-2">
                        <input type="number" class="form-control" min="0" name="item_qty" readonly="" value="<?php echo $load_shipment['item_qty'] ?>">
                      </div>
                    </div>

                    <?php 
                        $pic_name=mysql_fetch_array(mysql_query("select pic from t4t_partisipan where id='$kode'"));
                         if ($pic_name[0]=="") {
                          
                         }else{
                         ?>
                    <div class="form-group col-sm-12">
                      <label class="control-label col-md-4" for="first-name">PIC <span class="required"></span>
                      </label>
                      <div class="col-md-8 font-hijau">
                        <?php echo $pic_name[0]; ?>
                         <input type="hidden" name="pic" value="<?php echo $pic_name[0]; ?>">
                      </div>
                    </div>
                    <?php } ?>

                    <div class="form-group col-sm-12">
                      <label class="control-label col-md-4" for="first-name">Destination City <span class="required"></span>
                      </label>
                      <div class="col-md-8">
                        <input type="text" class="form-control col-md-7 col-xs-12" name="destination" readonly="" value="<?php echo $load_shipment['kota_tujuan'] ?>">
                      </div>
                    </div>

                    <div class="form-group col-sm-12">
                      <label class="control-label col-md-4" for="first-name">Note <span class="required"></span>
                      </label>
                      <div class="col-md-8">
                        <textarea type="text" class="form-control" name="note" disabled=""><?php echo $load_shipment['note'] ?></textarea>
                        
                      </div>
                    </div>
<?php 
$no_id=mysql_fetch_array(mysql_query("select no from t4t_partisipan where id='$kode'"));
$kode_buyer=$load_shipment['buyer'];
$cek_customer=mysql_fetch_row(mysql_query("select kode_retailer,retailer_name from t4t_retailer where id_partisipan='$no_id[0]' and kode_retailer='$kode_buyer'"));
echo mysql_error();
if ($cek_customer==true) {
  
 ?>
                    <div class="form-group col-sm-12">
                      <label class="control-label col-md-4" for="first-name">Customer Code <span class="required"></span>
                      </label>
                      <div class="col-md-8 font-hijau">
                        <?php if ($load_shipment['buyer']==true) {

                          echo $load_shipment['buyer']." - "; 
                          echo $cek_customer[1];
                        }else{
                          echo "-";
                          } ?>
                        
                      </div>
                    </div>

<?php 
} 
?>             

                    <div class="form-group col-sm-12">
                      <label class="control-label col-md-4" for="first-name">Bill of Lading copy attached <span class="required"></span>
                      </label>
                      <div class="col-md-8 font-hijau">
                        <p class=""><?php
                        if ($load_shipment['foto']=="") {
                          echo "-";
                        }else{
                         echo $load_shipment['foto']; 
                        }?></p>
                        
                      </div>
                    </div>



                    

        
         <br><br><br><br><br><br><br><br>
         <br><br><br><br><br><br><br><br>    
         <br><br><br><br><br><br><br><br>  
         <br><br><br><br><br><br><br><br>  
         <br><br><br><br><br><br><br><br>    
         <br><br><br>
        
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
          $('#shipment_list<?php echo $load_tahun['th'] ?>').DataTable( {
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

<?php include '../layout/js.php'; ?>