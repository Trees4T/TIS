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


        <?php
        if ($_SESSION['level']=="part") {
          $cek_customer=$office->cek_relation($kode); //t4t_retailer
        }


        if ($cek_customer->repeat_id == true) {
        ?>

                    <div class="form-group col-md-12">
                      <label class="control-label col-md-4" for="first-name">Customer Code <span class="required"></span>
                      </label>
                      <div class="col-md-8">

                          <?php
                          $cek_buyer = $office->cek_ship_relation_buyer($load_shipment['no_shipment']);
                          $nama_buyer= $office->nama_relation_buyer($kode,$cek_buyer->buyer);

                          if ($cek_buyer->buyer==true): ?>
                            <input type="text" class="form-control" value="<?php echo $cek_buyer->buyer; echo " (".$nama_buyer->name.")"; ?>" readonly>
                            <?php else: ?>
                              <input type="text" class="form-control" value="-" readonly>
                          <?php endif; ?>

                      </div>
                    </div>

                    <div class="form-group col-md-12">
                      <label class="control-label col-md-4" for="first-name">WIN Owner <span class="required"></span>
                      </label>
                      <div class="col-md-8">
                        <?php
                        if ($cek_buyer->relation==1): ?>
                          <input type="text" class="form-control"  value="<?php echo $cek_buyer->buyer; echo " (".$nama_buyer->name.")"; ?>" readonly>
                          <?php else: ?>
                          <input type="text" class="form-control"  value="<?php $member=$office->data_member($kode); echo $member->name; ?> <i>(default)</i>" readonly>
                        <?php endif; ?>


                      </div>
                    </div>

        <?php
        }
        ?>


<form class="" action="" method="post">

</form>

</div>
<div class="modal-footer">



<a href="?<?php echo paramEncrypt('hal=member-shipment-pending-edit&id_ship='.$load_shipment['no'].'&edit=1')?>" type="button" class="btn btn-warning">Update</a>
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

</div>
</div>

</div>
</div>
<!-- end modal -->

<!-- <script type="text/javascript">
 function form_submit() {
   document.getElementById("form-special").submit();
  }
 </script> -->
