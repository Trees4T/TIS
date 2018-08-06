<?php

$data = $office->data_member($kode);
if ($up_member=="1") {
  $status = "Update Participant";
}else{
  $status = "Create New Participant";
}


?>
<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3><?php echo $status ?> <small></small></h3>
            </div>
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><i class="fa "></i> Account </h2>
                  <?php if ($up_member=="1"): ?>
                      <span class="right"><h5><a href="?<?php echo paramEncrypt('hal=marketing-member-list') ?>">
                        <br>
                      <i class="fa fa-arrow-circle-left"></i> Back</a> </h5></span>
                  <?php endif; ?>

                  <div class="clearfix"></div>

                </div>
                <div class="x_content">
                  <br />
                  <?php
                  if ($_SESSION['success']==true) {

                    if ($_SESSION['succes']==1) {
                      $notif = "New member";
                    }elseif ($_SESSION['success']==2) {
                      $notif = "Changes";
                    }
                    ?>
                <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong><i class="fa fa-check-circle"></i> Success!</strong> <?php echo $notif ?> successfully saved.
                </div>
                  <?php
                  }

                  unset($_SESSION['success']);
                   ?>

                   <?php  $tipe_part = $_REQUEST['type']; ?>

                   <?php// if ($up_member=="1") { }else{ ?>
                   <form class="form-horizontal form-label-left" action="" method="post">
                     <div class="col-sm-12">
                     <div class="form-group">
                       <label class="control-label col-md-4">Participant Type <span class="required red">*</span>
                       </label>
                       <div class="col-md-5">
                       <select class="form-control selectpicker" name="type" onchange='this.form.submit()' data-live-search="true">
                         <?php if ($tipe_part==true): ?>

                                 <?php if ($tipe_part=="Manufacturer"): ?>
                                   <option value="Manufacturer">Manufacturer</option>
                                 <?php elseif($tipe_part=="Retailer"): ?>
                                   <option value="Retailer">Retailer</option>
                                 <?php elseif($tipe_part=="Donor"): ?>
                                   <option value="Donor">Donor</option>
                                 <?php elseif($tipe_part=="Merchant"): ?>
                                   <option value="Merchant">Merchant</option>
                                 <?php elseif($tipe_part=="Recipient"): ?>
                                   <option value="Recipient">Recipient</option>
                                 <?php elseif($tipe_part=="Sponsor"): ?>
                                   <option value="Sponsor">Sponsor</option>
                                 <?php endif; ?>
                         <?php elseif($tipe_part==false && $up_member=="1" ): ?>
                                 <option data-tokens="<?php echo $data->type ?>" value="<?php echo $data->type ?>"><?php echo $data->type ?></option>
                         <?php else: ?>
                           <option value="">- Choose Type -</option>
                         <?php endif; ?>

                        <?php
                          $type_list = $office->type_part_list();
                         ?>
                         <?php foreach ($type_list as $type_lists): ?>
                        <option value="<?php echo $type_lists->type ?>"><?php echo $type_lists->type ?></option>
                         <?php endforeach; ?>
                         <!-- <option value="Manufacturer">Manufacturer</option>
                         <option value="Retailer">Retailer</option>
                         <option value="Donor">Donor</option> -->
                       </select>
                       </div>
                     </div>
                     </div>
                    <noscript><input type="submit" value="type"></noscript>
                   </form>
                   <?php// } ?>

              <?php
              if ($tipe_part=="Retailer") {
                $tipe_part='RT';
              }else{
                $tipe_part='MF';
              }
              ?>

              <?php if ($tipe_part=="") {
                # code...
              }elseif($tipe_part!="" or $up_member=="1"){

              ?>
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="../action/office.php">
                    <font size="">


                    <div class="col-sm-12">

                    <div class="form-group">
                      <?php
                      if ($tipe_part=='DN') {
                        $tipe_part='MF';
                      }
                      $no_id_comp = $office->cek_id_comp($tipe_part);
                      ?>
                      <label class="control-label col-md-4">ID Company <span class="required red">*</span>
                      </label>
                      <div class="col-md-4 font-hijau">
                      <label class="control-label">
                        <?php
                          if ($up_member=="1"){
                            echo  $data->id;
                          }else{
                            $nomor = intval($no_id_comp->nomor+1);
                            echo $tipe_part.''.sprintf("%03d", $nomor);
                          }

                        ?>
                      </label>
                        <?php if ($up_member=="1"): ?>
                          <input type="hidden" name="id_comp" value="<?php echo  $data->id ?>">
                          <?php else: ?>
                          <input type="hidden" name="id_comp" value="<?php echo  $tipe_part.''.sprintf("%03d", $nomor); ?>">
                        <?php endif; ?>

                         <input type="hidden" name="tipe" value="<?php if($tipe_part=="MF"){ echo "Manufacturer"; }else{ echo "Retailer"; } ?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-4">Participant Name / Company Name <span class="required red">*</span>
                      </label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" name="comp_name" placeholder="Participant Name / Company Name" value="<?php echo $data->name ?>" required>
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
                      <label class="control-label col-md-4">E-mail 2
                      </label>
                      <div class="col-md-5">
                        <input type="text" class="form-control" name="email2" placeholder="E-mail 2" value="<?php echo $data->email1 ?>">
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
                      if ($tipe_part=="RT") {
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
                      <!-- <label class="control-label col-md-4">Header <span class="required"></span>
                      </label> -->
                      <div class="col-md-5">
                        <textarea name="header" class="form-control" rows="2" cols="80" style="display:none;"><?php echo $data->header ?></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <!-- <label class="control-label col-md-4">Introduction	: <span class="required"></span>
                      </label> -->
                      <div class="col-md-8">
                        <textarea name="intro" class="form-control" rows="12" cols="80" style="display:none;"><?php if ($up_member==1): ?><?php echo $data->introduction ?>
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


                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-5 col-md-offset-5">
                        <a href="?<?php echo paramEncrypt('hal=marketing-member-input')?>" class="btn btn-primary">Cancel</a>
                        <?php if ($up_member=="1") { ?>
                        <button type="submit" name="btn_edit_member" class="btn btn-success">Save Changes</button>
                        <?php }else{ ?>
                        <button type="submit" name="btn_input_member" class="btn btn-success">Submit</button>
                      <?php } ?>
                      </div>
                    </div>
                    </div>

                    <!-- $actual_link -->
                    <?php $actual_link = $office->current_link(); ?>
                    <input type="hidden" name="tipe" value="<?php echo $_REQUEST['type'] ?>">
                    <input type="hidden" name="actual_link" value="<?php echo $actual_link ?>">
                    </font>
                  </form>
                <?php } ?>

                </div>
              </div>
            </div>
          </div>

          <?php
          include '../js/riojs.php';
          ?>
                     <!-- js -->
                  </div>

    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <script src="../js/bootstrap.min.js"></script>

    <!-- icheck -->
    <script src="../js/icheck/icheck.min.js"></script>
    <script src="../js/custom.js"></script>
    <!-- bootstrap progress js -->
    <script src="../js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="../js/nicescroll/jquery.nicescroll.min.js"></script>

    <!-- pace -->
    <script src="../js/pace/pace.min.js"></script>



</body>

</html>
