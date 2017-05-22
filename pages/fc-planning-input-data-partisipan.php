<?php
$ta_master      = $fc->ta_master($kode_ta);
$kode_kabupaten = $ta_master->kab_code;
$kode_provinsi  = $ta_master->prov_code;
$mu             = $fc->nama_mu($kode_kabupaten,$kode_provinsi);
$kd_mu          = $mu->kd_mu;
$kode_ta;
 ?>
<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>Planning <small>Data Partisipan</small></h3>
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
                  <h2><i class="fa fa-plus-circle"></i> Input Data Partisipan baru </h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <a href="?<?php echo paramEncrypt('hal=fc-planning-lihat-data-partisipan')?>" data-toggle="tooltip" data-placement="left" title="Lihat data partisipan"><i class="fa fa-eye"></i> Lihat Data Partisipan</a>
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
                    <!-- desa -->
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
                    <!-- no partisipan -->
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">No. Partisipan <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12 font-hijau">
                       <label class="control-label">
                        <?php
                          $no_part = $fc->no_part($_desa);
                          echo $no_part->no+1;
                        ?>
                        </label>
                      </div>
                    </div>
                    <!-- nama partisipan -->
                    <?php $nama = $_REQUEST['nama']; ?>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama Partisipan <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" required="required" class="form-control col-md-7 col-xs-12" name="nama" onchange="this.form.submit()" value="<?php echo $nama ?>">
                      </div>
                    </div>
                    <!-- no ktp -->
                    <?php $ktp = $_REQUEST['ktp']; ?>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">No. KTP <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control input" data-inputmask="'mask' : '999999-999999-9999'" name="ktp" onchange="this.form.submit()" value="<?php echo $ktp ?>" minlength="18">
                        <span class="fa fa-credit-card form-control-feedback right" aria-hidden="true"></span>
                      </div>
                    </div>
                    <!-- alamat partisipan -->
                    <?php $alamat = $_REQUEST['alamat']; ?>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Alamat Partisipan <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea type="text" required="required" class="form-control col-md-7 col-xs-12" name="alamat" onchange="this.form.submit()" ><?php echo $alamat ?></textarea>
                      </div>
                    </div>
                    <!-- kelompok tani -->
                    <?php $kelompok_tani = $_REQUEST['kelompok_tani']; ?>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kelompok Tani <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" onchange="this.form.submit()" name="kelompok_tani">
                          <option><?php
                                  if ($kelompok_tani=='') {
                                    echo "- Kelompok Tani -";
                                  }else{
                                  echo $kelompok_tani; }
                                  ?>
                          </option>

                          <?php
                            $nm_kel_tani = $fc->kel_tani($kd_mu);
                            foreach ($nm_kel_tani as $data_keltani) {

                           ?>
                          <option><?php echo $data_keltani->nama_kel_tani ?></option>
                          <?php
                          }
                           ?>
                        </select>
                        <noscript><input type="submit" value="kelompok_tani"></noscript>
                      </div>
                    </div>
                    <!-- keanggotaan dalam kelompok -->
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Keanggotaan Dalam Kelompok <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" readonly="">
                          <option></option>
                        </select>
                      </div>
                    </div>
                    <!-- jenis kelamin -->
                    <?php $jenis_kel = $_REQUEST['jenis_kel']; ?>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Jenis Kelamin <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="jenis_kel" onchange="this.form.submit()" readonly="">
                          <option><?php
                                  if ($jenis_kel=='') {
                                    echo "- Pilih Jenis Kelamin -";
                                  }else{
                                  echo $jenis_kel; }
                                  ?>
                          </option>
                          <option>Laki-laki</option>
                          <option>Perempuan</option>
                        </select>
                        <noscript><input type="submit" value="jenis_kel"></noscript>
                      </div>
                    </div>
                    <!-- umur -->
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Umur <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" readonly="">
                      </div>
                    </div>
                    <!-- profesi -->
                    <?php $profesi = $_REQUEST['profesi']; ?>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Profesi <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" onchange="this.form.submit()" name="profesi">
                          <option><?php
                                  if ($profesi=='') {
                                    echo "- Pilih Profesi -";
                                  }else{
                                  echo $profesi; }
                                  ?>
                          </option>
                          <option>Petani</option>
                          <option>Karyawan / Pegawai</option>
                          <option>Wiraswasta / Pedagang</option>
                          <option>Lain-lain</option>

                        </select>
                        <noscript><input type="submit" value="profesi"></noscript>
                      </div>
                    </div>
                    <!-- tujuan menanam pohon -->
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tujuan Menanam Pohon <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" readonly="">
                          <option></option>
                        </select>
                      </div>
                    </div>
                    <!-- rencana penebangan -->
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Rencana Penebangan <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" readonly=" ">
                          <option></option>
                        </select>
                      </div>
                    </div>
                    <!-- pendapatan / tahun -->
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pendapatan / Tahun <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <!-- persepsi tentang t4t -->
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Persepsi Tentang T4T <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <!-- foto -->
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Foto <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="file" class="form-control" readonly="">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                    </form>

                    <div class="ln_solid"></div>
                    <form class="" action="../action/fc-part-input.php" method="post">
                      <input type="" name="" value="<?php echo $id_desa ?>"><br>
                      <input type="" name="" value="<?php echo $no_part->no+1; ?>"><br>
                      <input type="" name="" value="<?php echo $nama ?>"><br>
                      <input type="" name="" value="<?php echo $ktp ?>"><br>
                      <input type="" name="" value="<?php echo $alamat ?>"><br>
                      <input type="" name="" value="<?php echo $kelompok_tani ?>"><br>
                      <input type="" name="" value="<?php  ?>"><br>
                      <input type="" name="" value="<?php echo $jenis_kel ?>"><br>
                      <input type="" name="" value="<?php  ?>"><br>
                      <input type="" name="" value="<?php  ?>"><br>
                      <input type="" name="" value="<?php  ?>"><br>
                      <input type="" name="" value="<?php  ?>"><br>
                      <input type="" name="" value="<?php  ?>"><br>
                      <input type="" name="" value="<?php  ?>"><br>
                      <input type="" name="" value="<?php  ?>"><br>

                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a href="" class="btn btn-primary">Cancel</a>
                        <button type="submit" class="btn btn-success">Submit</button>
                      </div>
                    </div>

                    </form>
                    </div>

                    </font>

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
