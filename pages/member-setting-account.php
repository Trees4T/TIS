<?php

$kode=$_SESSION['kode'];



$data=$conn->query("SELECT no,id,type as tipe,name as nama,address as alamat,phone as tlp,fax,director as direktur,pic,

                                      product as prod_utama,outlet_qty as jml_outlet,material as bhn_utama, janjian,date_join as wkt_isi,email,

                                      email1 as email2,email2 as email3,website,introduction,header

                                      FROM t4t_participant where id='$kode'")->fetch();



?>

<div class="">



          <div class="page-title">

            <div class="title_left">

              <h3>Setting <small></small></h3>

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

                    <strong><i class="fa fa-check-circle"></i> Success!</strong> Change successfully saved.

                </div>

                  <?php

                  }



                  unset($_SESSION['success']);

                   ?>





                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="../action/member-setting-account.php">

                    <font size="">





                    <div class="col-sm-12">



                    <div class="form-group">

                      <label class="control-label col-md-4">Company Name <span class="required red">*</span>

                      </label>

                      <div class="col-md-5">

                        <input type="text" class="form-control" name="comp_name" placeholder="Company Name" value="<?php echo $data['nama'] ?>" required>

                      </div>

                    </div>



                    <div class="form-group">

                      <label class="control-label col-md-4">Address <span class="required"></span>

                      </label>

                      <div class="col-md-5">

                        <textarea type="text" class="form-control" name="address" rows="3" placeholder=""><?php echo $data['alamat'] ?></textarea>

                      </div>

                    </div>



                    <div class="form-group">

                      <label class="control-label col-md-4">Telephone <span class="required red">*</span>

                      </label>

                      <div class="col-md-5">

                        <input type="text" class="form-control" name="telp" placeholder="Telephone" value="<?php echo $data['tlp'] ?>" required>

                      </div>

                    </div>



                    <div class="form-group">

                      <label class="control-label col-md-4">Fax <span class="required"></span>

                      </label>

                      <div class="col-md-5">

                        <input type="text" class="form-control" name="fax" id="" placeholder="Fax" value="<?php echo $data['fax'] ?>">

                      </div>

                    </div>



                    <div class="form-group">

                      <label class="control-label col-md-4">E-mail 1 <span class="required red">*</span>

                      </label>

                      <div class="col-md-5">

                        <input type="text" class="form-control" name="email1" placeholder="E-mail 1" value="<?php echo $data['email'] ?>" required>

                      </div>

                    </div>



                    <div class="form-group">

                      <label class="control-label col-md-4">E-mail 2 <span class="required red">*</span>

                      </label>

                      <div class="col-md-5">

                        <input type="text" class="form-control" name="email2" placeholder="E-mail 2" value="<?php echo $data['email2'] ?>" required>

                      </div>

                    </div>



                    <div class="form-group">

                      <label class="control-label col-md-4">E-mail 3 <span class="required"></span>

                      </label>

                      <div class="col-md-5">

                        <input type="text" class="form-control" name="email3" placeholder="E-mail 3" value="<?php echo $data['email3'] ?>">

                      </div>

                    </div>



                    <div class="form-group">

                      <label class="control-label col-md-4">Website <span class="required"></span>

                      </label>

                      <div class="col-md-5">

                        <input type="text" class="form-control" name="website" id="" placeholder="e.g. www.trees4trees.org" value="<?php echo $data['website'] ?>">

                      </div>

                    </div>



                    <div class="form-group">

                      <label class="control-label col-md-4">Name of Company Owner or

Director <span class="required"></span>

                      </label>

                      <div class="col-md-5">

                        <input type="text" class="form-control" name="director" value="<?php echo $data['direktur'] ?>">

                      </div>

                    </div>



                    <div class="form-group">

                      <label class="control-label col-md-4">Person In Contact <span class="required red">*</span>

                      </label>

                      <div class="col-md-5">

                        <input type="text" class="form-control" name="pic" value="<?php echo $data['pic'] ?>" required>

                      </div>

                    </div>



                    <div class="form-group">

                      <label class="control-label col-md-4">Main Materials Used (Please mention wood by species)    <span class="required"></span>

                      </label>

                      <div class="col-md-5">

                        <input type="text" class="form-control" name="wood" value="<?php echo $data['bhn_utama'] ?>">

                      </div>

                    </div>











                    <div class="ln_solid"></div>

                    <div class="form-group">

                      <div class="col-md-5 col-md-offset-5">

                        <a href="?<?php echo paramEncrypt('hal=member-setting-account')?>" class="btn btn-primary">Cancel</a>

                        <button type="submit" name="save_setting" class="btn btn-success">Save Changes</button>

                      </div>

                    </div>

                    </div>



                    </font>

                  </form>





                </div>

              </div>

            </div>

          </div>



          <?php

          include '../js/riojs.php';

         // include '../layout/js.php';



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
