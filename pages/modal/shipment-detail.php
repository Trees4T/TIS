<!-- Modal -->
  <div class="modal fade" id="detail<?php echo $load_shipment['no'] ?>" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">

            <?php
          if ($load_shipment['acc_paid']==1) {
          ?>
            <div class="font-hijau">
               <i class="fa fa-check-circle-o "> </i> Paid
            </div>
          <?php
          }else{
          ?>
            <div class="red">
               &empty; Unpaid
            </div>
          <?php
          } ?>

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
                        $kode=$load_shipment['id_comp'];
                        $company=$conn->query("select name from t4t_participant where id='$kode'")->fetch();
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
                      $kontainer=$conn->query("select * from t4t_container");

                      while ($data_kont=$kontainer->fetch()) {

                      $no_sh=$load_shipment['no_shipment'];
                      $cont=$conn->query("select jml from t4t_ordercontainer where no_order='$no_sh' and no_cont='$no'")->fetch();
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
                        $pic_name=$conn->query("select pic from t4t_participant where id='$kode'")->fetch();
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
$no_id=$conn->query("select no from t4t_participant where id='$kode'")->fetch();
$kode_buyer=$load_shipment['buyer'];
$cek_customer=$conn->query("select kode_retailer,retailer_name from t4t_retailer where id_partisipan='$no_id[0]' and kode_retailer='$kode_buyer'")->fetch();
//echo mysql_error();
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
                          ?>
                          <a href="../../management_t4t/gbr/shipment/<?php echo $load_shipment['foto']; ?>" target="_blank">
                          <?php
                         echo $load_shipment['foto'];
                          ?>
                          </a>
                          <?php
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
