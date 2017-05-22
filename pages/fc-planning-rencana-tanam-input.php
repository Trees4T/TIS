<?php
  $_ta = $fc->ta_master($kode_ta);
  $kode_kabupaten = $_ta->kab_code;
  $kode_provinsi = $_ta->prov_code;
  $nama_mu = $fc->nama_mu($kode_kabupaten,$kode_provinsi);
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
                          echo $kode_ta.' - '.$_ta->nama;
                        ?>
                      <label class="control-label">
                      </div>
                    </div>

                     <?php

                     $_desa=$_REQUEST['desa'];
                       $desa2     = $fc->nama_desa($_desa);
                       $nama_kec2 = $fc->nama_kec($desa2->id_kec);
                       $nama_kab2 = $fc->nama_kab($desa2->kab_code);

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
              $sel_desa= $fc->list_desa($kode_fc);

                foreach ($sel_desa as $data_desa) {
                  $id_desa   = $data_desa->id_desa;
                  $nama_desa = $fc->nama_desa($id_desa);

                  $id_kec    = $nama_desa->id_kec;
                  $nama_kec  = $fc->nama_kec($id_kec);

                  $id_kab    = $nama_desa->kab_code;
                  $nama_kab  = $fc->nama_kab($id_kab);


              ?>
                    <option value="<?php echo $id_desa ?>"><?php echo $nama_desa->desa.' Kec.'.$nama_kec->kecamatan.' Kab.'.$nama_kab->nama ?></option>
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
                        $no_lahan = $fc->no_lahan($_desa);
                        echo $no_lahan->no+1;

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
                          $nama= $fc->list_nama_part($_desa);
                          foreach ($nama as $data_nama) {
                          ?>
                          <option value="<?php echo $data_nama->kd_petani ?>"><?php echo $data_nama->nm_petani ?></option>
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
                          $silvi=$fc->list_silvil();
                          foreach ($silvi as $data_silvi) {
                          ?>
                          <option value="<?php echo $data_silvi->id_lahan ?>"><?php echo $data_silvi->jenis_lahan ?></option>
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
                          $tanaman=$fc->list_pohon();
                          foreach ($tanaman as $data_tanaman) {
                          ?>
                          <option value="<?php echo $data_tanaman->id_pohon ?>"><?php echo $data_tanaman->nama_pohon.' <i>('.$data_tanaman->nama_latin.')</i>' ?></option>
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
