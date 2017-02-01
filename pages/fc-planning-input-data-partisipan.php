<?php 
$ta=$_SESSION['ta'];
$ta_master=mysql_fetch_row(mysql_query("select kab_code,prov_code from t4t_tamaster where kd_ta='$ta'"));
$mu=mysql_fetch_row(mysql_query("select kd_mu, nama from t4t_mu where kab_kode='$ta_master[0]' and prov_code='$ta_master[1]'"));
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

              <?php 
              $_desa=$_REQUEST['desa'];
                $desa2=mysql_fetch_row(mysql_query("select desa,id_kec,kab_code from t4t_desa where id_desa='$_desa'"));
                $nama_kec2=mysql_fetch_row(mysql_query("select kecamatan from t4t_kec where id_kec='$desa2[1]' and id_kab='$desa2[2]'"));
                $nama_kab2=mysql_fetch_row(mysql_query("select nama from t4t_kab where kab_code='$desa2[2]'"));

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
                        echo $desa2[0].' Kec.'.$nama_kec2[0].' Kab.'.$nama_kab2[0];
                        }
                        ?></option>
              <?php  
              $sel_desa=mysql_query("select det.id_desa,ta.kab_code,ta.prov_code,det.id_kec from t4t_tamaster ta
 join t4t_tadetail det where ta.kd_ta=det.kd_ta and ta.kd_ta='$ta'");
              while ($data_desa=mysql_fetch_row($sel_desa)) {
                  $id_desa=$data_desa[0];
                $desa=mysql_fetch_row(mysql_query("select desa,id_kec,kab_code from t4t_desa where id_desa='$data_desa[0]'"));
                  $id_kec=$desa[1];
                  $id_kab=$desa[2];

                $nama_kec=mysql_fetch_row(mysql_query("select kecamatan from t4t_kec where id_kec='$id_kec' and id_kab='$id_kab'"));
                $nama_kab=mysql_fetch_row(mysql_query("select nama from t4t_kab where kab_code='$id_kab'"));

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
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">No. Partisipan <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12 font-hijau">
                       <label class="control-label">
                        <?php  
                          $no_part=mysql_fetch_row(mysql_query("select kd_petani from t4t_petani where id_desa='$_desa' order by kd_petani desc limit 1"));
                          echo $no_part[0]+1;
                        ?>
                        </label>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama Partisipan <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">No. KTP <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control input" data-inputmask="'mask' : '99-99-99-999999-9999'">
                        <span class="fa fa-newspaper-o form-control-feedback right" aria-hidden="true"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Alamat Partisipan <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea type="text" required="required" class="form-control col-md-7 col-xs-12"></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kelompok Tani <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                          <option>- Pilih Kelompok Tani -</option>

                          <?php 
                          $nama_kel_tani=mysql_query("select nama_kel_tani from kel_tani where kd_mu='$mu[0]' and aktif=1");
                          while ($data_keltani=mysql_fetch_row($nama_kel_tani)) {
                            
                           ?>
                          <option><?php echo $data_keltani[0] ?></option>
                          <?php 
                          }
                           ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Keanggotaan Dalam Kelompok <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                          <option></option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Jenis Kelamin <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                          <option>- Pilih Jenis Kelamin -</option>
                          <option>Laki-laki</option>
                          <option>Perempuan</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Umur <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Profesi <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                          <option>- Pilih Profesi -</option>
                          <option>Petani</option>
                          <option>Karyawan / Pegawai</option>
                          <option>Wiraswasta / Pedagang</option>
                          <option>Lain-lain</option>

                        </select>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tujuan Menanam Pohon <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                          <option></option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Rencana Penebangan <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                          <option></option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pendapatan / Tahun <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Persepsi Tentang T4T <span class="required red">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Foto <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="file" class="form-control"> 
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
