<?php
  include '../../../../action/function/class.office.php';
  $office = new office();
?>

<div style="font-size:20px">
  Shipment No. <b class="green"><?php echo $_POST['id'] ?></b>
</div>

<?php
  $shipment = $office->cek_ship_relation_buyer($_POST['id']);
  $details  = $office->shipment_detail($_POST['id']);
?>
<form class="" action="#" method="post">


<div class="col-sm-12">
  <div class="col-sm-3">
    Shipment Time
  </div>
  <div class="col-sm-9">
    <input type="text" class="form-control" name="" value="<?php echo $details->wkt_shipment ?>" readonly>
  </div>
</div>

<div class="col-sm-12">
  <div class="col-sm-3">
    BL No.
  </div>
  <div class="col-sm-9">
    <input type="text" class="form-control" name="" value="<?php echo $details->bl ?>" readonly>
  </div>
</div>

<div class="col-sm-12">
  <div class="col-sm-3">
    BL Date
  </div>
  <div class="col-sm-9">
    <input type="text" class="form-control" name="" value="<?php echo $details->bl_tgl ?>" readonly>
  </div>
</div>

<div class="col-sm-12">
  <div class="col-sm-3">
    Wins Used
  </div>
  <div class="col-sm-9">
    <textarea name="name" rows="3" cols="" class="form-control" readonly><?php echo $shipment->wins_used ?></textarea>
  </div>
</div>

<div class="col-sm-12">
  <div class="col-sm-3">
    Order No.
  </div>
  <div class="col-sm-9">
    <input type="text" class="form-control" name="" value="<?php echo $details->no_order ?>" readonly>
  </div>
</div>

<div class="col-sm-12">
  <div class="col-sm-3">
    Paid Status
  </div>
  <div class="col-sm-9">
    <?php
    if ($details->acc_paid==1) {
      ?>
      <i class="fa fa-check-square-o"></i>
      <?php
    }else {
      ?>
      <i class="fa fa-minus"></i>
      <?php
    }
    ?>
  </div>
</div>

<div class="col-sm-12">
  <div class="col-sm-3">
    Fee
  </div>
  <div class="col-sm-9">
    <input type="text" class="form-control" name="" value="<?php echo $details->fee ?>" readonly>
  </div>
</div>

<div class="col-sm-12">
  <div class="col-sm-3">
    Buyer/Customer
  </div>
  <div class="col-sm-9">
    <input type="text" class="form-control" name="" value="<?php echo $details->buyer ?>" readonly>
  </div>
</div>

</form>
