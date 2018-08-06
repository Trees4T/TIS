<!-- Modal -->
  <div class="modal fade" id="myModal<?php echo $load_order['no'] ?>" role="dialog">
    <div class="modal-dialog modal-lg">

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
          <form class="" action="../action/office.php" method="post">
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

              $comp_name=$conn->query("select name from t4t_participant where id='$kode'")->fetch();
              echo $comp_name[0];
              ?>
              <input type="hidden" name="comp" value="<?php echo $comp_name[0]; ?>" >
            </div>
          </div>
          <br>
          <br>


          <!-- table container -->
          <div class="form-group col-lg-12">
          <div class="col-md-4"></div>
          <label class="col-md-5"><center>Container</center></label>
          <label class="col-md-3"> Stuffing </label>

          <div class="col-md-4"></div>
          <label class="col-md-1">20'</label>
          <label class="col-md-1">40'</label>
          <label class="col-md-1">40' HC</label>
          <label class="col-md-1">45'</label>
          <label class="col-md-1">60'</label>
          <label class="col-md-3">Date</label>

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
           <div class="col-md-4">

           </div>
           <label class="col-md-1 font-hijau">
             <?php if ($load_order['acc']==1) {
               echo $container1[0];
             }elseif ($load_order['acc']==0) {
               ?>
               <input type="number" min="0" name="cont1" value="<?php echo $container1[0];?>" class="form-control" required width="20">
               <?php
             } ?></label>
           <label class="col-md-1 font-hijau">
             <?php if ($load_order['acc']==1) {
               echo $container2[0];
             }elseif ($load_order['acc']==0) {
               ?>
               <input type="number" min="0" name="cont2" value="<?php echo $container2[0];?>" class="form-control" required>
               <?php
             } ?></label>
           <label class="col-md-1 font-hijau">
             <?php if ($load_order['acc']==1) {
               echo $container3[0];
             }elseif ($load_order['acc']==0) {
               ?>
               <input type="number" min="0" name="cont3" value="<?php echo $container3[0];?>" class="form-control" required>
               <?php
             } ?></label>
           <label class="col-md-1 font-hijau">
             <?php if ($load_order['acc']==1) {
               echo $container4[0];
             }elseif ($load_order['acc']==0) {
               ?>
               <input type="number" min="0" name="cont4" value="<?php echo $container4[0];?>" class="form-control" required>
               <?php
             } ?></label>
           <label class="col-md-1 font-hijau">
             <?php if ($load_order['acc']==1) {
               echo $container5[0];
             }elseif ($load_order['acc']==0) {
               ?>
               <input type="number" min="0" name="cont5" value="<?php echo $container5[0];?>" class="form-control" required>
               <?php
             } ?></label>
          <label class="col-md-3 font-hijau">
            <?php if ($load_order['acc']==1) {
              echo $tanggal_stf;
            }elseif ($load_order['acc']==0) {
              ?>
              <input type="date" name="tgl_stuf" value="<?php  echo date("Y-m-d",strtotime($tanggal_stf)); ?>" class="form-control" required>
              <?php
            } ?></label>


                          <?php
                          $i++;
                         }
                           ?>


          </div>


           <div class="form-group col-lg-12">
              <label class="control-label col-md-4" for="first-name">Type of Product <span class="required"></span>
              </label>
              <div class="col-md-8 font-hijau">
                <?php if ($load_order['acc']==1) {
                  echo $load_order['tipe_prod'];
                }elseif ($load_order['acc']==0) {
                  ?>
                  <input type="text" name="type" value="<?php echo $load_order['tipe_prod']; ?>" class="form-control">
                  <?php
                }
                ?>

              </div>
            </div>
            <br><br><br>

            <div class="form-group col-lg-12">
              <label class="control-label col-md-4" for="first-name">Wood Species <span class="required"></span>
              </label>
              <div class="col-md-8">
                <ul class="to_do">
                  <?php
                  if ($load_order['acc']==1) {
                    $wood=$conn->query("select * from t4t_pohonen");
                    while ($data_pohon=$wood->fetch()) {
                      $id_pohon=$data_pohon[0];
                      $pohon=$conn->query("select a.id_pohon,b.no from t4t_pohonen a, t4t_orderphn b where a.id_pohon=b.no_phnen2 and no_order='$no_order' and a.id_pohon=$id_pohon")->fetch();
                     ?>
                      <?php
                        if ($pohon[0]!="") {
                         ?>
                        <li>
                         <p><input type="checkbox" class="flat" name="item[]" value="<?php echo $data_pohon[0] ?>" checked disabled="disabled"> <?php echo $data_pohon[1] ?> </p>
                        </li>
                         <?php
                        }else{

                       }
                    } //end while

                  }else{
                    $wood=$office->pohon_list();
                    foreach ($wood as $data_pohon) {
                      $detail = $office->wood_species_detail($data_pohon->id_pohon,$load_order['no_order']);
                     ?>
                        <li>
                          <?php
                          if ($detail[0]->id_pohon==true) {
                            ?>
                            <p><input type="checkbox" class="icheckbox_flat-green" name="item[]"
                              value="<?php echo $data_pohon->id_pohon ?>" <?php echo checked ?>>
                              <?php echo $data_pohon->nama_pohon ?> </p>
                            <?php
                          }else {
                            ?>
                            <p><input type="checkbox" class="icheckbox_flat-green" name="item[]"
                              value="<?php echo $data_pohon->id_pohon ?>">
                              <?php echo $data_pohon->nama_pohon ?> </p>
                            <?php
                          }
                          ?>

                        </li>
                    <?php
                  } //end foreach

                  } //end else
                  ?>
                </ul>
              </div>
            </div>
            <br><br>

            <div class="form-group col-lg-12">
              <label class="control-label col-md-4" for="first-name"> Quantity WINS <span class="required"></span>
              </label>
              <div class="col-md-8 font-hijau">
              <?php $jml_tag=$conn->query("select jml_wins from t4t_order where no_order='$no_order'")->fetch(); ?>
               <?php if ($load_order['acc']==1) {
                 echo $jml_tag[0];
               }elseif ($load_order['acc']==0) {
                 ?>
                 <input type="number" name="tag" value="<?php echo $jml_tag[0]; ?>" class="form-control">
                 <?php
               }
               ?>
              </div>
            </div>
            <br><br><br>

            <div class="form-group col-lg-12">
              <label class="control-label col-md-4" for="first-name"> WINS Range <span class="required"></span>
              </label>
              <div class="col-md-8 font-hijau">
              <?php $wins=$conn->query("select wins1,wins2 from t4t_order where no_order='$no_order'")->fetch(); ?>

                <?php if ($load_order['acc']==1) {
                  echo $wins[0].' - '.$wins[1];
                }elseif ($load_order['acc']==0) {
                  ?>

                    <div class="col-md-5">
                      <input type="number" class="form-control" min=0 name="wins1" value="<?php echo $wins[0] ?>">
                    </div>
                    <div class="col-md-2">
                      to
                    </div>
                    <div class="col-md-5">
                      <input type="number" class="form-control" min=0 name="wins2" value="<?php echo $wins[1] ?>">
                    </div>

                <?php
                }
                ?>
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
                      <?php if ($load_order['acc']==1): ?>
                        <?php echo $request[0]; echo " - ".$data_other[1]; ?>
                        <?php else: ?>
                            <input type="number" name="req[]" value="<?php echo $request[0]; ?>" style="width:40px" min="0">
                         <?php echo " - ".$data_other[1]; ?>
                      <?php endif; ?>

                    </li>
                  <?php } ?>
                </ul>
              </div>
            </div>
            <div class="form-group col-lg-12">
              <label class="control-label col-md-4" for="first-name">Destination City<span class="required"></span>
              </label>
              <div class="col-md-8 font">
                <?php if ($load_order['acc']==1) {
                  if ($load_order['kota_tujuan']!=''):
                   echo $load_order['kota_tujuan'];
                   else:
                   echo '-';
                   endif;
                }elseif ($load_order['acc']==0) {
                  ?>
                  <input type="text" name="destination" value="<?php echo $load_order['kota_tujuan']; ?>" class="form-control">
                  <?php
                }
                ?>


              </div>
            </div>
            <?php
               $pic_name=$conn->query("select pic from t4t_participant where id='$kode'")->fetch();
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

            <?php if ($load_order['acc']==0): ?>
              <div class="" align="center">
                <button type="submit" name="btn-edit-order" class="btn btn-warning">Update</button>
              </div>
            <?php endif; ?>

            <div class="">
              &nbsp;
            </div>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
  <!-- end modal -->
