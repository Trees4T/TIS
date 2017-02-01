<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>Retailer <small></small></h3>
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
                  <h2><i class="fa fa-plus-circle"></i> New Retailer </h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <a href="?<?php echo paramEncrypt('hal=member-retailer-list')?>" data-toggle="tooltip" data-placement="left" title="See retailer list"><i class="fa fa-eye"></i> Retailer Lists</a>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                    <?php 
                  if ($_SESSION['success']==1) {
                    ?>
                <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong><i class="fa fa-check-circle"></i> Success!</strong> Your new retailer successfully added.
                </div>
                  <?php
                  }

                  if ($_SESSION['success']==2) {
                   ?>
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong><i class="fa fa-warning"></i> Warning!</strong> Sorry we failed to add new retailer. Duplicate Entry for Retailer Code. <a href="javascript:history.back()"><font color="white">UNDO <i class="fa fa-reply"></i></font></a>
                </div>
                   <?php
                  }

                  unset($_SESSION['success']);
                  unset($_SESSION['message']);
                   ?>
                  <center><h2><strong>RETAILER FORM</strong></h2></center>
                  <div class="ln_solid"></div>
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="../action/member-retailer-input.php">
                    <font size="">
                   

                    <div class="col-sm-12">
                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Retailer Code <span class="required">*</span>
                      </label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="code" required>
                        
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Retailer Name <span class="required">*</span>
                      </label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="nama" required>
                        
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Address <span class="required">*</span>
                      </label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="alamat" required>
                        
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">City <span class="required">*</span>
                      </label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="kota" required>
                        
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Country <span class="required">*</span>
                      </label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="negara" required>
                        
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Email <span class="required">*</span>
                      </label>
                      <div class="col-md-4">
                        <input type="email" class="form-control" name="email" required>
                        
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Phone <span class="required"></span>
                      </label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="phone">
                        
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Fax <span class="required"></span>
                      </label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="fax">
                        
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Website <span class="required"></span>
                      </label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="web">
                        
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Contact Person <span class="required">*</span>
                      </label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="cp" required>
                        
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-5" for="first-name">Director <span class="required"></span>
                      </label>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="director">
                        
                      </div>
                    </div>


                    
                    
  

                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-5 col-md-offset-5">
                        <a href="?<?php echo paramEncrypt('hal=member-retailer-input')?>" type="submit" class="btn btn-primary">Reset</a>
                        <button type="submit" value="save" name="save" class="btn btn-success">Submit</button>
                      </div>
                    </div>
                    </div>

                    </font>
                  </form>
                </div>
              </div>
            </div>
          </div>

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

    <!-- bootstrap progress js -->
    <script src="../js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="../js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="../js/icheck/icheck.min.js"></script>
    <script src="../js/custom.js"></script>

    <!-- pace -->
    <script src="../js/pace/pace.min.js"></script>





</body>

</html>
