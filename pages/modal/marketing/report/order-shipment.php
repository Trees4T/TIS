<?php
  include '../../../../action/function/class.office.php';
  $office = new office();
?>

<div style="font-size:20px">
  Shipment No. <b class="green"><?php echo $_POST['id'] ?></b>
</div>

<?php
  $shipment = $office->cek_ship_relation_buyer($_POST['id']);
?>
<div class="">
  <textarea name="name" rows="8" cols="" class="form-control"><?php echo $shipment->wins_used ?></textarea>
</div>
