<?php 
$ta=$_SESSION['ta'];
  $_ta    =$conn->query("select kab_code,prov_code,nama from t4t_tamaster where kd_ta='$ta'")->fetch();
  $nama_mu=$conn->query("select kd_mu,nama from t4t_mu where kab_kode='$_ta[0]' and prov_code='$_ta[1]'")->fetch(PDO::FETCH_OBJ);
 ?>
<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>Planning <small>Rencana Tanam</small></h3>
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
                  <h2><i class="fa fa-plus-circle"></i> Input Data Rencana Tanam Baru </h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <a href="?<?php echo paramEncrypt('hal=fc-planning-lihat-rencana-tanam')?>" data-toggle="tooltip" data-placement="left" title="Lihat data rencana tanam"><i class="fa fa-eye"></i> Lihat Data Rencana Tanam</a>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <br />
                  <form class="form-horizontal form-label-left" action="" method="post">
                    <font size="">
                    <div class="col-sm-2">
                                
                    </div>

                    <div class="col-sm-10">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Management Unit <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12 font-hijau">
                      <label class="control-label">
                        <?php  
                          echo $nama_mu->kd_mu.' - '.$nama_mu->nama;
                        ?>
                      </label>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Target Area <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12 font-hijau">
                      <label class="control-label">
                        <?php  
                          echo $ta.' - '.$_ta[2];
                        ?>
                      <label class="control-label">
                      </div>
                    </div>

                     <?php 

              $_desa=$_REQUEST['desa'];
                $desa2=$conn->query("SELECT desa,id_kec,kab_code from t4t_desa where id_desa='$_desa'")->fetch(PDO::FETCH_OBJ);
                $nama_kec2=$conn->query("SELECT kecamatan from t4t_kec where id_kec='$desa2->id_kec' and id_kab='$desa2->kab_code'")->fetch(PDO::FETCH_OBJ);
                $nama_kab2=$conn->query("SELECT nama from t4t_kab where kab_code='$desa2->kab_code'")->fetch(PDO::FETCH_OBJ);

               ?>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Desa <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="desa" onchange="this.form.submit()">
                        <option value="<?php echo $_desa ?>"><?php 
                        if ($_desa=="") {
                          echo "- Pilih Desa -";
                        }else{
                        echo $desa2->desa.' Kec.'.$nama_kec2->kecamatan.' Kab.'.$nama_kab2->nama;
                        }
                        ?></option>
              <?php  
              $sel_desa=$conn->query("SELECT det.id_desa, ta.kab_code, ta.prov_code, det.id_kec 
                from t4t_tamaster ta join t4t_tadetail det where ta.kd_ta=det.kd_ta and ta.kd_ta='$ta'");
              while ($data_desa=$sel_desa->fetch()) {
                  $id_desa=$data_desa[0];
                $desa=$conn->query("SELECT desa,id_kec,kab_code from t4t_desa where id_desa='$data_desa[0]'")->fetch();
                  $id_kec=$desa[1];
                  $id_kab=$desa[2];

                $nama_kec=$conn->query("SELECT kecamatan from t4t_kec where id_kec='$id_kec' and id_kab='$id_kab'")->fetch();
                $nama_kab=$conn->query("SELECT nama from t4t_kab where kab_code='$id_kab'")->fetch();

              ?>
                    <option value="<?php echo $id_desa ?>"><?php echo $desa[0].' Kec.'.$nama_kec[0].' Kab.'.$nama_kab[0] ?></option>
              <?php 
              }
              ?>
                        </select>
                        <noscript><input type="submit" value="desa"></noscript>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">No. Doc <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="doc">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">No. Lahan <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12 font-hijau">
                      <label class="control-label">
                        <?php  
                        $no_lahan=$conn->query("select no_lahan from t4t_lahan where id_desa='$_desa' order by no_lahan desc limit 1")->fetch();
                        echo $no_lahan[0]+1;
                        ?>
                      </label>
                      </div>
                    </div>
                    
                    <?php $_nama=$_REQUEST['nama'] ?>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama Partisipan / Institusi<span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="nama">
                          <option value="">- Pilih Partisipan / Institusi -</option>
                          <?php 
                          $nama=$conn->query("SELECT kd_petani,nm_petani from t4t_petani where id_desa='$_desa' order by nm_petani");
                          while ($data_nama=$nama->fetch()) {
                          ?>
                          <option value="<?php echo $data_nama[0] ?>"><?php echo $data_nama[1] ?></option>
                          <?php 
                          } ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Status Lahan <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                          <option>- Pilih Status -</option>
                          <option value="Pribadi">Pribadi</option>
                          <option value="Umum">Umum</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">No. GPS<span class="required"></span>
                      </label>
                      <div class="col-md-3 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="gps">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tipe Silvikultur <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                          <option>- Pilih Tipe Silvikultur -</option>
                          <?php  
                          $silvi=$conn->query("SELECT * from t4t_typelahan");
                          while ($data_silvi=$silvi->fetch()) {
                          ?>
                          <option value="<?php echo $data_silvi[0] ?>"><?php echo $data_silvi[1] ?></option>
                          <?php 
                          } ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Luas Lahan <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12 font-hijau">
                      <label class="control-label">
                        otomatis
                      </label>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Penutupan Lahan <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                          <option>- Pilih Penutupan Lahan -</option>
                          <option value="0% s/d 25%">0% s/d 25%</option>
                          <option value="25% s/d 50%">25% s/d 50%</option>
                          <option value="50% s/d 75%">50% s/d 75%</option>
                          <option value="75% s/d 100%">75% s/d 100%</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Luas Tanam <span class="required"></span>
                      </label>
                      <div class="col-md-4">
                        <input type="number" class="form-control" name="luas_tanam" min="0">
                      </div>
                      <div class="col-md-2 font-hijau"><label class="control-label"> m²</label></div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Jenis Tanam <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                          <option>- Pilih Jenis Tanam -</option>
                          <?php  
                          $tanaman=$conn->query("SELECT id_pohon,nama_pohon from t4t_pohon order by nama_pohon");
                          while ( $data_tanaman=$tanaman->fetch()) {
                          ?>
                          <option value="<?php echo $data_tanaman[0] ?>"><?php echo $data_tanaman[1] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Jumlah Usulan <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" name="usulan" class="form-control" min="0">
                      </div>
                    </div>
                     

                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-primary">Cancel</button>
                        <button type="submit" class="btn btn-success">Submit</button>
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
             <script src="../js/bootstrap.min.js"></script>


    <!-- bootstrap progress js -->
    <script src="../js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="../js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="../js/icheck/icheck.min.js"></script>
    <script src="../js/custom.js"></script>
    <!-- daterangepicker -->
    <script type="text/javascript" src="../js/moment/moment.min.js"></script>
    <script type="text/javascript" src="../js/datepicker/daterangepicker.js"></script>
    <!-- input mask -->
    <script src="../js/input_mask/jquery.inputmask.js"></script>
    <!-- knob -->
    <script src="../js/knob/jquery.knob.min.js"></script>
    <!-- range slider -->
    <script src="../js/ion_range/ion.rangeSlider.min.js"></script>
    <!-- color picker -->
    <script src="../js/colorpicker/bootstrap-colorpicker.min.js"></script>
    <script src="../js/colorpicker/docs.js"></script>

    <!-- image cropping -->
    <script src="../js/cropping/cropper.min.js"></script>
    <script src="../js/cropping/main2.js"></script>
    <!-- pace -->
    <script src="../js/pace/pace.min.js"></script>

    <!-- input_mask -->
    <script>
        $(document).ready(function () {
            $("input").inputmask();
        });
    </script>
    <!-- /input mask -->

   
</body>

</html>
