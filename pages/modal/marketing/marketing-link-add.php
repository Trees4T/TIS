<?php
include '../../../action/function/class.office.php';
$office = new office();

$split = explode("-",$_POST['id']);

$id_part = $split[0];
$link = $split[1];

$data = $office->data_member($id_part);
?>

<form class="form-horizontal form-label-left" action="../action/office.php" method="post">
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Participant Name <span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <label class="control-label green" for="first-name"><?php echo $data->name ?> <span class="required"></span>
      </label>
    </div>
  </div>

  <input type="hidden" name="id_part" value="<?php echo $id_part ?>">
  <input type="hidden" name="link" value="<?php echo $link ?>">


  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">New Buyer <span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <select class="form-control " name="buyer" style="">
        <option value="">- Select Participant -</option>
        <?php
        $member_list = $office->data_member_list();
        foreach ($member_list as $member_lists):
        ?>
          <option value="<?php echo $member_lists->id ?>"><?php echo $member_lists->name.' ['.$member_lists->id.']' ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>


  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Repeat ID <span class="required"></span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" class="form-control" name="repeat_id" value="" required>
    </div>
  </div>


  <div class="" align="center">
    <button type="submit" class="btn btn-primary" name="button_link_add"> Save</button>
  </div>

</form>
