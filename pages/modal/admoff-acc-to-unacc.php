 <!-- Modal acc1 -->
  <div class="modal fade" id="acc1<?php echo $load_shipment['no'] ?>" role="dialog">
    <div class="modal-dialog ">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">
          <?php
          if ($load_shipment['acc']==1) {
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
          <label class="control-label col-md-4">BL No.
          </label>
          <div class="col-md-8 font-hijau">
            <?php
            echo $load_shipment['bl'];
             ?>
          </div>
        </div>
        <br>

        <div class="form-group col-lg-12">
          <label class="control-label col-md-4">Shipment No.
          </label>
          <div class="col-md-8 font-hijau">
            <?php
            echo $load_shipment['no_shipment'];
             ?>
          </div>
        </div>
        <br>

        <div class="form-group col-lg-12">
          <label class="control-label col-md-4 ">Company Name
          </label>
          <div class="col-md-8 font-hijau">
            <?php

            $comp_name=$conn->query("SELECT name as nama from t4t_participant where id='$kode'")->fetch();
            echo $comp_name[0];
            ?>
          </div>
        </div>
        <br><br>




        </div>
        <div class="modal-footer">
          <form method="post" action="../action/admoff-shipment.php">
            <div class="form-group col-lg-12 red" align="center">
            <font size="20"><i class="fa fa-exclamation-circle"></i><br></font>
                Change to <b>UNAPPROVED!</b>
            </div>

            <input type="hidden" name="link" value="<?php echo $actual_link ?>">
            <input type="hidden" name="bl" value="<?php echo $load_shipment['bl'] ?>">

            <button type="submit" name="btn_save_acc1" class="btn btn-success">Save Changes</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </form>
        <br>

        </div>
      </div>

    </div>
  </div>
  <!-- end modal acc1 -->
