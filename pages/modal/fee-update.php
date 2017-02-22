 <!-- Modal fee -->
  <div class="modal fade" id="fee<?php echo $load_shipment['no'] ?>" role="dialog">
    <div class="modal-dialog ">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">

          <i class="fa fa-dollar"> </i> Fee Update

          </h4>
        </div>
        <div class="modal-body">

        <div class="form-group col-lg-12">
          <label class="control-label col-md-4 ">Company Name
          </label>
          <div class="col-md-8 font-hijau">
            <?php
            $kode=$load_shipment['id_comp'];
            $comp_name=$conn->query("select nama from t4t_partisipan where id='$kode'")->fetch();
            echo $comp_name[0];
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
             <input type="hidden" name="no_shipment" value="<?php echo $load_shipment['no_shipment']; ?>" >
          </div>
        </div>
        <br>

        <div class="form-group col-lg-12">
          <label class="control-label col-md-4">BL No.
          </label>
          <div class="col-md-8 font-hijau">
            <?php
            echo $load_shipment['bl'];
             ?>
             <input type="hidden" name="bl" value="<?php echo $load_shipment['bl']; ?>" >
          </div>
        </div>
        <br><br>




        </div>
        <div class="modal-footer">
          <form method="get" action="../action/finance-paid-unpaid.php">
            <div class="form-group col-lg-12">
                <label class="control-label col-md-4 ">Fee
                </label>
                <div class="col-md-4 font-hijau">
                  <input type="number" step="0.01" class="form-control" name="fee" value="<?php echo $load_shipment['fee'] ?>">
                </div>

            </div>
            <input type="hidden" name="link" value="<?php echo $actual_link ?>">
            <input type="hidden" name="bl" value="<?php echo $load_shipment['bl'] ?>">
            <input type="hidden" name="id_member" value="<?php echo $load_shipment['id_comp'] ?>">

            <button type="submit" name="btn_save_fee" class="btn btn-success">Save Changes</button>
            <a href="?<?php echo $actual_link ?>" type="submit" class="btn btn-primary" >OK</a>
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button> -->
          </form>
        <br>

        </div>
      </div>

    </div>
  </div>
  <!-- end modal FEE -->
