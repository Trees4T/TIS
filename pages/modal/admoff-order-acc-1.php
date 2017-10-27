<!-- Modal acc0 -->
  <div class="modal fade" id="acc0<?php echo $load_order['no'] ?>" role="dialog">
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

            $comp_name=$conn->query("select name from t4t_participant where id='$kode'")->fetch();
            echo $comp_name[0];
            ?>
          </div>
        </div>
        <br><br>




        </div>
        <div class="modal-footer">
          <form method="post" action="../action/admoff-order.php">
            <div class="form-group col-lg-12 font-hijau" align="center">
            <font size="20"><i class="fa fa-check-circle"></i><br></font>
                Change to <b>APPROVED!</b>
            </div>
            <input type="hidden" name="link" value="<?php echo $actual_link ?>">
            <input type="hidden" name="order" value="<?php echo $load_order['no_order'] ?>">
            <input type="hidden" name="comp" value="<?php echo $comp_name[0]; ?>" >
            <input type="hidden" name="type" value="<?php echo $load_order['tipe_prod']; ?>" >
            <input type="hidden" name="tags" value="<?php echo $load_order['jml_wins']; ?>" >

            <button type="submit" name="btn_save_acc0" class="btn btn-success">Save Changes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </form>
        <br>

        </div>
      </div>

    </div>
  </div>
  <!-- end modal acc0 -->
