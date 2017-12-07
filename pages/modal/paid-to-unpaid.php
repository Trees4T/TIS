<div class="modal fade" id="paid<?php echo $load_shipment['no'] ?>" role="dialog">
    <div class="modal-dialog ">
<?php
if ($load_shipment['acc_paid']==1) {
  $btn = 'Unpaid';
}else{
  $btn = 'Paid';
}
?>
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">
          <?php
          if ($load_shipment['acc']==1) {

          ?>
            <div class="font-hijau">
               <i class="fa fa-check-circle-o "> </i> Paid
            </div>
          <?php
          }else{

          ?>
            <div class="red font-bold">
               &empty; Unpaid
            </div>
          <?php
          } ?>


          </h4>
        </div>
        <div class="modal-body">

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
          <form method="post" action="../action/finance-paid-unpaid.php">
            <div class="form-group col-lg-12 font-bold red" align="center">
            <font size="20">&empty;<br></font>
                Change to <b>UNPAID!</b>
            </div>
            <input type="hidden" name="link" value="<?php echo $actual_link ?>">
            <input type="hidden" name="bl" value="<?php echo $load_shipment['bl'] ?>">
            <input type="hidden" name="shipment" value="<?php echo $load_shipment['no_shipment'] ?>">

            <button type="submit" name="btn_save_unpaid" class="btn btn-success"><?php echo $btn ?></button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </form>
        <br>

        </div>
      </div>

    </div>
  </div>
