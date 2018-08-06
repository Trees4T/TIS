<?php
include '../../action/function/class.office.php';
$office = new office();

$up_member="1"; //for update

$id_part = $_POST['id'];
$data = $office->data_member($id_part);
 ?>


<form class="form-horizontal form-label-left input_mask" action="" method="post">
  <div class="col-md-12">
  <div class="form-group">
    <label class="control-label col-md-4">Participant Type <span class="required red">*</span></label>
    <div class="col-md-5">
    <label class="control-label font-hijau"><?php echo $data->type ?></label>
    </div>
  </div>
  </div>
</form>

<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="../action/office.php">
  <div class="col-sm-12">

  <div class="form-group">

    <label class="control-label col-md-4">ID Company <span class="required red">*</span>
    </label>
    <div class="col-md-4 font-hijau">
    <label class="control-label">
      <?php echo  $data->id; ?>
    </label>
      <?php if ($up_member=="1"): ?>
        <input type="hidden" name="id_comp" value="<?php echo  $data->id ?>">
      <?php endif; ?>

       <input type="hidden" name="tipe" value="<?php $data->id ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-4">Company Name <span class="required red">*</span>
    </label>
    <div class="col-md-5">
      <input type="text" class="form-control" name="comp_name" placeholder="Company Name" value="<?php echo $data->name ?>" required>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-4">Address <span class="required"></span>
    </label>
    <div class="col-md-5">
      <textarea type="text" class="form-control" name="address" rows="3" placeholder=""><?php echo $data->address ?></textarea>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-4">Telephone <span class="required red">*</span>
    </label>
    <div class="col-md-5">
      <input type="text" class="form-control" name="telp" placeholder="Telephone" value="<?php echo $data->phone ?>" required>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-4">Fax <span class="required"></span>
    </label>
    <div class="col-md-5">
      <input type="text" class="form-control" name="fax" id="" placeholder="Fax" value="<?php echo $data->fax ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-4">E-mail 1 <span class="required red">*</span>
    </label>
    <div class="col-md-5">
      <input type="text" class="form-control" name="email1" placeholder="E-mail 1" value="<?php echo $data->email ?>" required>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-4">E-mail 2 <span class="required red">*</span>
    </label>
    <div class="col-md-5">
      <input type="text" class="form-control" name="email2" placeholder="E-mail 2" value="<?php echo $data->email1 ?>" required>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-4">E-mail 3 <span class="required"></span>
    </label>
    <div class="col-md-5">
      <input type="text" class="form-control" name="email3" placeholder="E-mail 3" value="<?php echo $data->email2 ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-4">Website <span class="required"></span>
    </label>
    <div class="col-md-5">
      <input type="text" class="form-control" name="website" id="" placeholder="e.g. www.trees4trees.org" value="<?php echo $data->website ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-4">Name of Company Owner or Director <span class="required"></span>
    </label>
    <div class="col-md-5">
      <input type="text" class="form-control" name="director" value="<?php echo $data->director ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-4">Person In Contact <span class="required red">*</span>
    </label>
    <div class="col-md-5">
      <input type="text" class="form-control" name="pic" value="<?php echo $data->pic ?>" required>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-4">Main Materials Used (Please mention wood by species)    <span class="required"></span>
    </label>
    <div class="col-md-5">
      <input type="text" class="form-control" name="wood" value="<?php echo $data->material ?>">
    </div>
  </div>

  <?php
    if ($data->type=="Retailer" or $data->outlet_qty!='') {
  ?>
  <div class="form-group">
    <label class="control-label col-md-4">Number of Outlets    <span class="required"></span>
    </label>
    <div class="col-md-2">
      <input type="number" class="form-control" name="outlet" value="<?php echo $data->outlet_qty ?>">
    </div>
  </div>
  <?php } ?>

  <div class="form-group">
    <label class="control-label col-md-4">Header <span class="required"></span>
    </label>
    <div class="col-md-5">
      <textarea name="header" class="form-control" rows="2" cols="80"><?php echo $data->header ?></textarea>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-4">Introduction	: <span class="required"></span>
    </label>
    <div class="col-md-8">
      <textarea name="intro" class="form-control" rows="12" cols="80"><?php if ($up_member==1): ?><?php echo $data->introduction ?>
      <?php else: ?>Dear {name},

Congratulations and thank you.



Your purchase with WIN number {win} has made a positive difference to local communities and the environment in Indonesia where your product was manufactured.

Trees have been planted at the locations listed below to replace the timber used in the making of your furniture. Through the the Trees4Trees program the farmers growing the trees are provided with training and resources to maximise the value of their trees.

To view a map showing the location of the plantings double click on the Geo Position coordinates listed below or click trees locations on map. For further information regarding the Trees4Trees program please send an email request to info@trees4trees.org



Thank you.
      <?php endif; ?>
</textarea>
    </div>
  </div>

  <?php if ($_GET['edit']=='yes'): ?>
    <div class="ln_solid"></div>
    <div class="form-group">
      <div class="col-md-5 col-md-offset-5">
        <button type="submit" name="btn_edit_member" class="btn btn-success">Save Changes</button>
      </div>
    </div>
  <?php endif; ?>

  </div>


  <input type="hidden" name="tipe" value="<?php echo $data->type ?>">
  <input type="hidden" name="actual_link" value="66ae5d02d28f296edc7e1f575dd45c1c3f62b38bf984704d1d947b14a81b7abf">
</form>
