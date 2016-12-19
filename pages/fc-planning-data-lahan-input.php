<?php 
$ta=$_SESSION['ta'];
  $_ta=mysql_fetch_row(mysql_query("select kab_code,prov_code,nama from t4t_tamaster where kd_ta='$ta'"));
$nama_mu=mysql_fetch_row(mysql_query("select kd_mu,nama from t4t_mu where kab_kode='$_ta[0]' and prov_code='$_ta[1]'"));
 ?>
<div class="">

          <div class="page-title">
            <div class="title_left">
              <h3>Planning <small>Data Lahan</small></h3>
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
                  <h2><i class="fa fa-plus-circle"></i> Input Data Lahan Baru </h2>
                  <!-- <ul class="nav navbar-right panel_toolbox">
                    <a href="?<?php echo paramEncrypt('hal=fc-planning-')?>" data-toggle="tooltip" data-placement="left" title="Lihat data rencana tanam"><i class="fa fa-eye"></i> Lihat Data Rencana Tanam</a>
                  </ul> -->
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
                        <?php  
                          echo $nama_mu[0].' - '.$nama_mu[1];
                        ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Target Area <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12 font-hijau">
                        <?php  
                          echo $ta.' - '.$_ta[2];
                        ?>
                      </div>
                    </div>

                     <?php 

              $_desa=$_REQUEST['desa'];
                $desa2=mysql_fetch_row(mysql_query("select desa,id_kec,kab_code from t4t_desa where id_desa='$_desa'"));
                $nama_kec2=mysql_fetch_row(mysql_query("select kecamatan from t4t_kec where id_kec='$desa2[1]' and id_kab='$desa2[2]'"));
                $nama_kab2=mysql_fetch_row(mysql_query("select nama from t4t_kab where kab_code='$desa2[2]'"));

               ?>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Desa <span class="required">*</span>
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

                    <?php $_nama=$_REQUEST['nama'] ?>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama Partisipan / Institusi<span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" name="nama">
                          <option value="">- Pilih Partisipan / Institusi -</option>
                          <?php 
                          $nama=mysql_query("select kd_petani,nm_petani from t4t_petani where id_desa='$_desa' order by nm_petani");
                          while ($data_nama=mysql_fetch_row($nama)) {
                          ?>
                          <option value="<?php echo $data_nama[0] ?>"><?php echo $data_nama[1] ?></option>
                          <?php 
                          } ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">No. Lahan <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12 font-hijau">
                        <?php  
                        $no_lahan=mysql_fetch_row(mysql_query("select no_lahan from t4t_lahan where id_desa='$_desa' order by no_lahan desc limit 1"));
                        echo $no_lahan[0]+1;
                        ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">No. Doc. Lahan <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="doc">
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
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tipe Silvikultur <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                          <option>- Pilih Tipe Silvikultur -</option>
                          <?php  
                          $silvi=mysql_query("select * from t4t_typelahan");
                          while ($data_silvi=mysql_fetch_row($silvi)) {
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
                        otomatis
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">No. GPS<span class="required"></span>
                      </label>
                      <div class="col-md-3 col-sm-6 col-xs-12">
                        <input type="text" class="form-control" name="gps">
                      </div>
                    </div>

                   <!--  <div class="form-group">
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
                      <div class="col-md-2 font-hijau"> m²</div>
                    </div> -->

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Jenis Tanam <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control">
                          <option>- Pilih Jenis Tanam -</option>
                          <?php  
                          $tanaman=mysql_query("select id_pohon,nama_pohon from t4t_pohon order by nama_pohon");
                          while ( $data_tanaman=mysql_fetch_row($tanaman)) {
                          ?>
                          <option value="<?php echo $data_tanaman[0] ?>"><?php echo $data_tanaman[1] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>

                    <!-- <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Jumlah Usulan <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" name="usulan" class="form-control" min="0">
                      </div>
                    </div> -->

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Umur Tanaman <span class="required"></span>
                      </label>
                      <div class="col-md-3 col-sm-6 col-xs-12">
                        <input type="number" name="umur_tanaman" class="form-control" min="0">
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
