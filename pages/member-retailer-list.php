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
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-folder-open"></i> Retailer List <small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <a href="?<?php echo paramEncrypt('hal=member-retailer-input')?>" data-toggle="tooltip" data-placement="left" title="Add new retailers"><i class="fa fa-plus-circle"></i> Input Retailers</a>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
                    <?php 
                  if ($_SESSION['success']==1) {
                    ?>
                <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong><i class="fa fa-check-circle"></i> Success!</strong> <?php echo strtoupper($_SESSION['message']) ?> successfully updated.
                </div>
                  <?php
                  }

                  if ($_SESSION['success']==2) {
                   ?>
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong><i class="fa fa-warning"></i> Warning!</strong> Sorry we failed to update. Duplicate Entry for Retailer Code. 
                </div>
                   <?php
                  }

                  if ($_SESSION['success']==3) {
                   ?>
                <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong><i class="fa fa-check-circle"></i> Success!</strong> <?php echo strtoupper($_SESSION['message']) ?> successfully deleted.
                </div>
                   <?php
                  }

                  if ($_SESSION['success']==4) {
                   ?>
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong><i class="fa fa-warning"></i> Warning!</strong> Sorry we failed to delete.
                </div>
                   <?php
                  }

                  unset($_SESSION['success']);
                  unset($_SESSION['message']);
                   ?>
        <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th width="5%"><center>No<center> </th>
                                                <th width="15%"><center>Code<center> </th>
                                                <th width="25%"><center>Retailer</center> </th>
                                                <th width="15%"><center>Phone</center> </th>
                                                <th width="15%"><center>CP</center> </th>
                                                <th width="15%"><center>Action</center> </th>
                                            </tr>

                                        </thead>

                                        <tbody>
                            <?php
          
                            
                            $no=1;
                            $id_part=$_SESSION['id_part'];
                            $retailers=$conn->query("select * from t4t_retailer where id_partisipan='$id_part' order by id_retailer desc");
                            while ($data=$retailers->fetch()) {
                                
                            
                             ?>

                                <tr class="even pointer">
                                    <td align="center"><?php echo $no ?></td>
                                    <td><?php echo $data['kode_retailer'] ?></td>
                                    <td><?php echo $data['retailer_name'] ?></td>
                                    <td><?php echo $data['phone'] ?></td>
                                    <td><?php echo $data['contact_person'] ?></td>
                                    <td align="center">
                <a href="#" data-toggle="modal" data-target="#ModalEdit<?php echo $data[0] ?>">Edit <i class="fa fa-edit"></i></a> 
                | 
                <a href="#" data-toggle="modal" data-target="#ModalHapus<?php echo $data[0] ?>">Delete <i class="fa fa-trash"></i></a>
                                    </td>                                                                  
                                </tr>

 <!-- Modal Edit-->
  <div class="modal fade" id="ModalEdit<?php echo $data[0] ?>" role="dialog">
    <div class="modal-dialog ">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title font-kuning">
          <i class="fa fa-edit"></i> Edit <strong><?php echo strtoupper($data['retailer_name']) ?></strong>
          </h4>
        </div>
 
  
        <div class="modal-footer">
                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="../action/member-retailer-input.php">                 

                    <div class="col-sm-12"><br>
                    <div class="form-group">
                      <label class="control-label col-md-3" for="first-name">Retailer Code <span class="required">*</span>
                      </label>
                      <div class="col-md-6">
                        <input type="text" class="form-control" name="code" required value="<?php echo $data[1] ?>">
                        
                      </div>
                    </div>
                    </div>

                    <div class="col-sm-12">
                    <div class="form-group">
                      <label class="control-label col-md-3" for="first-name">Retailer Name <span class="required">*</span>
                      </label>
                      <div class="col-md-6">
                        <input type="text" class="form-control" name="nama" required value="<?php echo $data[3] ?>">
                        
                      </div>
                    </div>
                    </div>

                    <div class="col-sm-12">
                    <div class="form-group">
                      <label class="control-label col-md-3" for="first-name">Address <span class="required">*</span>
                      </label>
                      <div class="col-md-6">
                        <input type="text" class="form-control" name="alamat" required value="<?php echo $data[4] ?>">
                        
                      </div>
                    </div>
                    </div>

                    <div class="col-sm-12">
                    <div class="form-group">
                      <label class="control-label col-md-3" for="first-name">City <span class="required">*</span>
                      </label>
                      <div class="col-md-6">
                        <input type="text" class="form-control" name="kota" required value="<?php echo $data['city'] ?>">
                        
                      </div>
                    </div>
                    </div>

                    <div class="col-sm-12">
                    <div class="form-group">
                      <label class="control-label col-md-3" for="first-name">Country <span class="required">*</span>
                      </label>
                      <div class="col-md-6">
                        <input type="text" class="form-control" name="negara" required value="<?php echo $data['country'] ?>">
                        
                      </div>
                    </div>
                    </div>

                    <div class="col-sm-12">
                    <div class="form-group">
                      <label class="control-label col-md-3" for="first-name">Email <span class="required">*</span>
                      </label>
                      <div class="col-md-6">
                        <input type="email" class="form-control" name="email" required value="<?php echo $data['retailer_email'] ?>">
                        
                      </div>
                    </div>
                    </div>
                    
                    <div class="col-sm-12">
                    <div class="form-group">
                      <label class="control-label col-md-3" for="first-name">Phone <span class="required"></span>
                      </label>
                      <div class="col-md-6">
                        <input type="text" class="form-control" name="phone" value="<?php echo $data['phone'] ?>">
                        
                      </div>
                    </div>
                    </div>

                    <div class="col-sm-12">
                    <div class="form-group">
                      <label class="control-label col-md-3" for="first-name">Fax <span class="required"></span>
                      </label>
                      <div class="col-md-6">
                        <input type="text" class="form-control" name="fax" value="<?php echo $data['fax'] ?>">
                        
                      </div>
                    </div>
                    </div>

                    <div class="col-sm-12">
                    <div class="form-group">
                      <label class="control-label col-md-3" for="first-name">Website <span class="required"></span>
                      </label>
                      <div class="col-md-6">
                        <input type="text" class="form-control" name="web" value="<?php echo $data['retailer_website'] ?>">
                        
                      </div>
                    </div>
                    </div>

                    <div class="col-sm-12">
                    <div class="form-group">
                      <label class="control-label col-md-3" for="first-name">Contact Person <span class="required">*</span>
                      </label>
                      <div class="col-md-6">
                        <input type="text" class="form-control" name="cp" required value="<?php echo $data['contact_person'] ?>">
                        
                      </div>
                    </div>
                    </div>

                    <div class="col-sm-12">
                    <div class="form-group">
                      <label class="control-label col-md-3" for="first-name">Director <span class="required"></span>
                      </label>
                      <div class="col-md-6">
                        <input type="text" class="form-control" name="director" value="<?php echo $data['director'] ?>">
                        
                      </div>
                    </div>
                    </div>

                    <input type="hidden" name="id_ret" value="<?php echo $data[0] ?>">
                    <div class="form-group">
                      <div class="col-md-5 col-md-offset-5"> <br>
                       
                        <button type="submit" name="edit" value="edit" class="btn btn-success">Submit</button>
                      </div>
                    </div>

                  </form>

        </div>
      </div>
      
    </div>
  </div>
  <!-- end modal -->
   <!-- Modal Hapus-->
  <div class="modal fade" id="ModalHapus<?php echo $data[0] ?>" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title red">
          <i class="fa fa-trash"></i> Delete Retailer
          </h4>
        </div>
        <div class="modal-body">
        <strong>
            <div align="center">
              <?php echo strtoupper($data['retailer_name']) ?></strong><br><br>
              <font size="20"><i class="fa fa-exclamation red"></i></font><br>
            You will not be able to recover this record data! <b>Are you sure want to delete this Retailer?</b>
            </div>
        

        </div>
        <div class="modal-footer">
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="../action/member-retailer-input.php">
          <input type="hidden" name="code" required value="<?php echo $data[1] ?>">
          <input type="hidden" name="nama" required value="<?php echo $data['retailer_name'] ?>">
          <input type="hidden" name="id_ret" value="<?php echo $data[0] ?>">
          <button type="submit" class="btn btn-danger" name="delete" value="delete">Yes sure.</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </form>
        </div>
      </div>
      
    </div>
  </div>
  <!-- end modal -->                                
                            <?php 
                              $no++;  }
                             ?>      
                                            
                                        </tbody>

                                    </table>
            


        </div>
    </div>
</div>

  </div>

        </div>

        <div id="custom_notifications" class="custom-notifications dsp_none">
            <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
            </ul>
            <div class="clearfix"></div>
            <div id="notif-group" class="tabbed_notifications"></div>
        </div>

        <script src="../js/bootstrap.min.js"></script>

        <!-- chart js -->
        <script src="../js/chartjs/chart.min.js"></script>
        <!-- bootstrap progress js -->
        <script src="../js/progressbar/bootstrap-progressbar.min.js"></script>
        <script src="../js/nicescroll/jquery.nicescroll.min.js"></script>
        <!-- icheck -->
        <script src="../js/icheck/icheck.min.js"></script>

        <script src="../js/custom.js"></script>
        
        <!-- pace -->
        <script src="../js/pace/pace.min.js"></script>

        <!-- Datatables -->

        <script src="../js/datatables/js/jquery.dataTables.js"></script>
        <script src="../js/datatables/tools/js/dataTables.tableTools.js"></script>

        <script>
          $(function() {
              $('#example').DataTable( {
                        // "bJQueryUI":true,
                      "bPaginate":true,
                      "sPaginationType": "full_numbers",
                      "iDisplayLength":10
              } );

          } );
        </script>
</body>

</html>