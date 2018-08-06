<?php
$actual_link0 = "$_SERVER[REQUEST_URI]";
$actual_link1 = explode("?", $actual_link0);
$actual_link  = $actual_link1[1];

if ($load_shipment['acc']==1) {
  $acc = 1;
  $readonly = 'readonly';
  $status = 'Approved';
  $symbol_status = "<i class='fa fa-check-circle-o'> </i>";
  $warna_status = "hijau";
  $action = "../action/edit-buyer-shipment.php";
}else{
  $acc = 0;
  $readonly = '';
  $status = 'Pending';
  $symbol_status = "<i class='fa fa-circle-o'> </i>";
  $warna_status = "kuning";
  $action = "../action/member-shipment-edit.php";
}

?>

<!-- Modal -->
<div class="modal fade" id="myModal<?php echo $load_shipment['no'] ?>" role="dialog">
<div class="modal-dialog modal-lg">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">

<div class="font-<?php echo $warna_status ?>">
   <?php echo $symbol_status ?> <?php echo $status ?>
</div>

</h4>
</div>
<div class="modal-body">

    <form class="" action="<?php echo $action ?>" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="link" value="<?php echo $actual_link ?>">
      <!-- no shipment -->
        <div class="form-group col-sm-12">
          <label class="control-label col-md-4" for="first-name">Shipment Report No.
          </label>
          <div class="col-md-8 font-hijau">
           <?php echo $load_shipment['no_shipment'] ?>
          </div>
        </div>
        <input type="hidden" name="no_ship" value="<?php echo $load_shipment['no_shipment'] ?>">
      <!-- no bl -->
        <div class="form-group col-sm-12">
          <label class="control-label col-md-4" for="first-name">Bill of Lading No. <span class="required"></span>
          </label>
          <div class="col-md-8">
            <input type="text" class="form-control" name="bl" <?php echo $readonly ?> value="<?php echo $load_shipment['bl'] ?>">

          </div>
        </div>
      <!-- tgl bl -->
        <div class="form-group col-sm-12">
          <label class="control-label col-md-4" for="first-name">Bill of Lading Date <span class="required"></span>
          </label>
          <div class="col-md-4">
        <?php
        $tanggal=$load_shipment['bl_tgl'];
        $ex_tgl=explode("-", $tanggal);
        $tanggal_bl=$ex_tgl[2]."/".$ex_tgl[1]."/".$ex_tgl[0];
        ?>
            <input type="text" class="form-control" id="single_cal2" name="tglbl" <?php echo $readonly ?> value="<?php echo $tanggal_bl ?>">
            <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
          </div>
        </div>
      <!-- no order -->
      <?php if ($acc==1): ?>
            <div class="form-group col-sm-12">
              <label class="control-label col-md-4" for="first-name">Order No. <span class="required"></span>
              </label>
              <div class="col-md-8">
              <textarea disabled="" class="form-control"><?php echo $load_shipment['no_order'] ?></textarea>

              </div>

            </div>
        <?php else: ?>
            <div class="form-group col-sm-12">
              <label class="control-label col-md-4" for="first-name">Order No. <span class="required"></span>
              </label>
              <div class="col-md-3">
              <div class="font-hijau">
              <?php
               $no_ordership=$conn->query("select no_order from t4t_shipment where no='$id_ship'")->fetch();

               ?>
               <label class="control-label"><?php echo $load_shipment['no_order'] ?></label>
               </div>

                <select multiple="" class="form-control" name="order[]" id="order" <?php if ($edit==1) { echo "readonly"; } ?>>
                <?php

                $no_order=$conn->query("select no_order from t4t_order where id_comp='$kode' and acc=1 order by no desc");
                while ($data_order=$no_order->fetch()) {
                ?>
                  <option><?php echo $data_order[0] ?></option>
                <?php
                }
                ?>
                </select>

              </div><br>
              <p>Select the option if you want to change Order No.</p>
              <p>To select multiple options, press Ctrl (windows) / Command (Mac) button while selecting the Order.</p>
            </div>
      <?php endif; ?>

      <!-- no wins -->
        <div class="form-group col-sm-12">
          <label class="control-label col-md-4" for="first-name">Hang Tag numbers used <span class="required"></span>
          </label>
          <div class="col-md-8">
            <textarea type="text" class="form-control" name="wins_used" <?php echo $readonly ?>><?php echo $load_shipment['wins_used'] ?></textarea>


          </div>
        </div>
      <!-- nama company -->
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
      <!-- container size -->
      <?php if ($acc==1): ?>
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
        <?php else: ?>
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
          <label class="col-md-1"><input type="number" value="<?php echo $cont[0] ?>" name="cont<?php echo $no ?>" min="0"></input></label>
          <label class="col-md-4"></label>
          </div>
          <?php
          $no++;
          }
           ?>
          </div>
        </div>
      <?php endif; ?>

      <!-- jml itme -->
        <div class="form-group col-sm-12">
          <label class="control-label col-md-4" for="first-name"> Items QTY  <span class="required"></span>
          </label>
          <div class="col-md-2">
            <input type="number" class="form-control" min="0" name="item_qty" <?php echo $readonly ?> value="<?php echo $load_shipment['item_qty'] ?>">
          </div>
        </div>
      <!-- pic -->
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
      <!-- destination -->
        <div class="form-group col-sm-12">
          <label class="control-label col-md-4" for="first-name">Destination City <span class="required"></span>
          </label>
          <div class="col-md-8">
            <input type="text" class="form-control col-md-7 col-xs-12" name="destination" <?php echo $readonly ?> value="<?php echo $load_shipment['kota_tujuan'] ?>">
          </div>
        </div>
      <!-- note -->
        <div class="form-group col-sm-12">
          <label class="control-label col-md-4" for="first-name">Note <span class="required"></span>
          </label>
          <div class="col-md-8">
            <textarea type="text" class="form-control" name="note" <?php echo $readonly ?>><?php echo $load_shipment['note'] ?></textarea>

          </div>
        </div>

      <!-- attach -->
      <?php if ($acc==1): ?>
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
        <?php else: ?>
          <div class="form-group col-sm-12">
            <label class="control-label col-md-4" for="first-name">Bill of Lading copy attached <span class="required"></span>
            </label>
            <div class="col-md-8">
              <input type="file" class="form-control col-md-7 col-xs-12" name="bl_files">
              <?php
              $foto=$load_shipment['foto'];
              $ex_foto=explode("-", $foto);
              ?>
              <a href="" data-toggle="modal" data-target="#img-bl-attatch"><?php  echo $ex_foto[2] ?></a>
              <?php
              if ($foto=="") {
                  echo "no attached file found.";
                }
              ?><br>
              <!-- <p class="red">*maximum upload size 200kb.</p> -->
            </div>
          </div>
      <?php endif; ?>



        <!-- kepemilikan win -->

        <?php
        if ($_SESSION['level']=="part") {
          $cek_customer=$office->cek_relation($kode); //t4t_retailer
        }
        $cek_buyer = $office->cek_ship_relation_buyer($load_shipment['no_shipment']);
        $nama_buyer= $office->nama_relation_buyer($kode,$cek_buyer->buyer);

        if ($cek_customer->repeat_id == true) {
        ?>
          <div class="form-group col-md-12">
            <label class="control-label col-md-4" for="first-name">WIN Owner <span class="required"></span>
            </label>
            <div class="col-md-8">
              <select class="form-control" name="relation" id="owner" onchange="win_ownerValidasi()">
                <?php

                if ($cek_buyer->relation==1): ?>
                    <option value="1"><?php echo $cek_buyer->buyer; echo " (".$nama_buyer->name.")"; ?></option>
                  <?php else: ?>
                    <option value="0"><?php $member=$office->data_member($kode); echo $member->name; ?> </option>
                <?php endif; ?>
                <option value="0"><?php $member=$office->data_member($kode); echo $member->name; ?> </option>
                <option value="1">Customer (new update)</option>
              </select>
            </div>
          </div>

          <div class="form-group col-md-12">
            <label class="control-label col-md-4" for="first-name">Customer Code <span class="required"></span>
            </label>
            <div class="col-md-8">
              <select class="form-control" name="c_code" id="c_code" onchange="win_ownerValidasi()">
                <?php


                if ($cek_buyer->buyer==true): ?>
                    <option value="<?php echo $cek_buyer->buyer ?>"><?php echo $cek_buyer->buyer; echo " (".$nama_buyer->name.")"; ?></option>
                  <?php else: ?>
                    <option value="">- Choose -</option>
                <?php endif; ?>

                <?php
                if ($_SESSION['level']=="part") {
                  $customer=$office->retailer_list2($kode);//t4t_retailer
                }
                foreach ($customer as $data_customer) {
                ?>
                <option value="<?php echo $data_customer->repeat_id ?>"><?php echo $data_customer->repeat_id; echo " (".$data_customer->name.")"; ?></option>
                <?php
                } ?>
              </select>

            </div>
            <span id="hasil"></span>
          </div>


        <?php
        }
        ?>
        <?php if ($_SESSION['level']=='part'): ?>
          <div class="" align="center">
            <input type="hidden" name="link" value="<?php echo $actual_link ?>">

            <button type="submit" name="btn-update" class="btn btn-warning"> Update</button>
          </div>

        <?php endif; ?>

        </form>




</div>
<!-- end body -->
<div class="modal-footer">

<?php
//if ($_SESSION['level']=='part') {
?>
<!-- <a href="?<?php //echo paramEncrypt('hal=member-shipment-pending-edit&id_ship='.$load_shipment['no'].'&edit=1')?>" type="button" class="btn btn-warning">Update</a> -->
<?php
//}
?>




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
