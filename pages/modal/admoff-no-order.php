<!-- Modal -->
  <div class="modal fade" id="myModal<?php echo $load_order['no'] ?>" role="dialog">
    <div class="modal-dialog ">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">
          <?php  
          if ($load_order['acc']==1) {
          ?>
            <div class="font-hijau">
               <i class="fa fa-check-circle-o "> </i> Approved
            </div>
          <?php
          }else{
          ?>
            <div class="font-kuning">
               <i class="fa fa-circle-o "> </i> Pending
            </div>
          <?php 
          } ?>
            

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
             
              $comp_name=$conn->query("select nama from t4t_partisipan where id='$kode'")->fetch();
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
          $jml_cont=$conn->query("select count(no) from t4t_ordercontainer where no_order='$no_order'")->fetch();
          $i=1;
          $container=$conn->query("select * from t4t_ordercontainer where no_order='$no_order' group by tgl_stuf");
          while ($load_cont=$container->fetch()) {
            $ii=$i-1;

            $tgl_stuf=$load_cont['tgl_stuf'];
            $ex_tgl=explode("-", $tgl_stuf);
            $tanggal_stf=$ex_tgl[2]."-".$ex_tgl[1]."-".$ex_tgl[0];  

            $container1=$conn->query("select jml from t4t_ordercontainer where no_cont=1 and no_order='$no_order' limit $ii,1")->fetch(); 
            $container2=$conn->query("select jml from t4t_ordercontainer where no_cont=2 and no_order='$no_order' limit $ii,1")->fetch(); 
            $container3=$conn->query("select jml from t4t_ordercontainer where no_cont=3 and no_order='$no_order' limit $ii,1")->fetch(); 
            $container4=$conn->query("select jml from t4t_ordercontainer where no_cont=4 and no_order='$no_order' limit $ii,1")->fetch(); 
            $container5=$conn->query("select jml from t4t_ordercontainer where no_cont=5 and no_order='$no_order' limit $ii,1")->fetch();                        
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
                $wood=$conn->query("select * from t4t_pohonen");

                while ($data_pohon=$wood->fetch()) {
                  $id_pohon=$data_pohon[0];
                  $pohon=$conn->query("select a.id_pohon,b.no from t4t_pohonen a, t4t_orderphn b where a.id_pohon=b.no_phnen2 and no_order='$no_order' and a.id_pohon=$id_pohon")->fetch();
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
              <?php $jml_tag=$conn->query("select jml_wins from t4t_order where no_order='$no_order'")->fetch();
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
                $other=$conn->query("select * from t4t_req");
                while ($data_other=$other->fetch()) {
                  
                  $no_req=$data_other[0];
                  $request=$conn->query("select a.jml,b.no from t4t_orderrequest a, t4t_req b where a.no_req=b.no and a.no_order='$no_order' and a.no_req=$no_req ")->fetch();

                 ?>
                    <li>
                   
                     <?php echo $request[0]; echo " - ".$data_other[1]; ?>
                    
                    </li>
                  <?php } ?>
                </ul>
              </div>
            </div>

            <?php 
               $pic_name=$conn->query("select pic from t4t_partisipan where id='$kode'")->fetch();
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